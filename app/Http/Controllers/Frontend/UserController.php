<?php

namespace App\Http\Controllers\Frontend;

use App\Events\Tickets;
use App\Http\Controllers\Admin\Requests\UserAvaratRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Requests\ChangePasswordRequest;
use App\Http\Controllers\Frontend\Requests\MyAccountContactRequest;
use App\Http\Controllers\Frontend\Requests\MyAccountRequest;
use App\Http\Controllers\Frontend\Requests\VerificationRequest;
use App\Http\Requests\AddressesRequest;
use App\Http\Requests\ReviewRequest;
use App\Models\Addresses;
use App\Models\Category;
use App\Models\GeoZones;
use App\Models\MailJob;
use App\Models\Media\Folders;
use App\Models\Media\Items;
use App\Models\Newsletter;
use App\Models\Notifications\CustomEmails;
use App\Models\Notifications\CustomEmailUser;
use App\Models\Orders;
use App\Models\Review;
use App\Models\Statuses;
use App\Models\Ticket;
use App\Models\Settings;
use App\Models\ZoneCountries;
use App\Services\FileService;
use App\Services\UserService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

class UserController extends Controller
{
    private $countries;
    private $geoZones;
    private $statuses;
    private $category;
    private $user;
    private $fileService;
    private $settings;

    protected $view = 'frontend.my_account';

    public function __construct(
        Countries $countries,
        GeoZones $geoZones,
        Statuses $statuses,
        Category $category,
        User $user,
        FileService $fileService,
        Settings $settings
    )
    {
        $this->countries = $countries;
        $this->geoZones = $geoZones;
        $this->statuses = $statuses;
        $this->category = $category;
        $this->user = $user;
        $this->fileService = $fileService;
        $this->settings = $settings;
    }

    public function index()
    {
        $user = \Auth::user();
        $categories = Category::where('type', 'notifications')->get();
        $newsletters = Newsletter::where('user_id', \Auth::id())->pluck('category_id', 'category_id')->all();
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        return $this->view('index', compact('user', 'categories', 'newsletters','countriesShipping'));
    }

    public function getFavourites()
    {
        $user = \Auth::user();
        return $this->view('favourites', compact('user'));
    }

    public function saveMyAccount(MyAccountRequest $request)
    {
        $data = $request->except('_token');
        $user = \Auth::user();
        $user->update($data);
        return redirect()->back();
    }

    public function saveMyAccountContact(MyAccountContactRequest $request)
    {
        $data = $request->except('_token');
        $user = \Auth::user();
        $user->update([
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);
        return redirect()->back();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if (\Hash::check($request->get('current_password'), \Auth::user()->password)) {
            $user = \Auth::user();
            $user->password = \Hash::make($request->get('current_password'));
            $user->save();
            return redirect()->back();
        }
        return redirect()->back()->withErrors(['messages' => 'Current Password is wrong!!!']);
    }

    public function getAddress()
    {
        $user = \Auth::user();
        $billing_address = $user->addresses()->where('type', 'billing_address')->first();
        $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
        $address = $user->addresses()->where(function ($query) {
            $query->where('type', 'address_book')->orWhere('type', 'default_shipping');
        })
            ->pluck('first_line_address', 'id');
        $countries = $this->countries->all()->pluck('name.common', 'name.common')->toArray();
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

//        dd($countriesShipping);

        return $this->view('address', compact('billing_address', 'default_shipping', 'address', 'user', 'countries', 'countriesShipping'));
    }

    public function postAddress(AddressesRequest $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = \Auth::id();
        Addresses::updateOrCreate(['id' => $request->get('id', null), 'user_id' => $data['user_id']], $data);
        return redirect()->back();
    }

    public function postAddressBookForm(Request $request)
    {
        $id = $request->get('id', 0);
        $default = $request->get('default', false);
        $address_book = \Auth::user()->addresses()->find($id);
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        $html = $this->view('_partials.new_address', compact(['address_book', 'countriesShipping', 'default']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postAddressBookSelect(Request $request)
    {
        $address = Addresses::findOrFail($request->id);

        $html = $this->view('_partials.render_address', compact(['address']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postAddressBookSave(AddressesRequest $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = \Auth::id();
        if ($request->get('make_default')) {
            $data['type'] = 'default_shipping';
            \Auth::user()->addresses()->where('type', 'default_shipping')->update(['type' => 'address_book']);
        }
        $address = Addresses::updateOrCreate(['id' => $request->get('id', null), 'user_id' => $data['user_id']], $data);

        return \Response::json(['error' => false, 'data' => $address]);
    }

    public function getOrders()
    {
        $user = \Auth::user();

        return $this->view('orders', compact('user'));
    }

    public function getOrderInvoice($id)
    {
        $order = Orders::where('id', $id)
            ->where('user_id',\Auth::id())
            ->with('items')
            ->with('user')->first();
        if (!$order) abort(404);

        return $this->view('order_invoice', compact('order'));
    }

    public function getOrderReviews($id)
    {
        $order = Orders::where('id', $id)
            ->where('user_id',\Auth::id())
            ->with('items')
            ->with('user')->first();
        if (!$order) abort(404);

        $itemsID = [];
        foreach ($order->items as $item){
            if($item->options && count($item->options)){
                if(isset($item->options['options'])){
                    foreach ($item->options['options'] as $options){
                        if($options && isset($options['options'])){
                            foreach ($options['options'] as $option){
                                if(isset($option['variation'])){
                                    $itemsID[$option['variation']['item_id']] = $option['variation']['item_id'];
                                }
                            }
                        }
                    }
                }

                if(isset($item->options['extras'])){
                    //TODO
                }
            }

        }

        $items = \App\Models\Items::findMany($itemsID);

        return $this->view('order_review', compact('order','items'));
    }

    public function postOrderReviews(ReviewRequest $request,$id)
    {
        $data = $request->except(['_token','id']);
        $data['user_id'] = \Auth::id();
        $data['order_id'] = $id;
        $review = Review::updateOrCreate($request->id,$data);

        return redirect()->back();
    }

    public function getTickets()
    {
        $tickets = \Auth::user()->tickets()->orderByDesc('created_at')->paginate(10);
        return $this->view('tickets', compact(['tickets']));
    }

    public function getTicketsNew()
    {
        $priorities = $this->statuses->where('type', 'ticket_priority')->get()->pluck('name', 'id')->all();
        $categories = $this->category->where('type', 'tickets')->get()->pluck('name', 'id')->all();

        return $this->view('tickets_open', compact(['priorities', 'categories']));
    }

    public function getTicketsView($id)
    {
        $ticket = Ticket::where('id', $id)->where('user_id', \Auth::id())->first();

        if (!$ticket) abort(404);
        $replies = $ticket->replies()->main()->get();

//        dd($replies,$ticket->replies()->main()->oldest()->get());
        $data = mergeCollections($replies, $ticket->history);

        return $this->view('ticket_view', compact(['ticket', 'data']));
    }

    public function postTicketsNew(Request $request)
    {
        $data = $request->except('_token', 'attachments');

        $max_size = (int)ini_get('upload_max_filesize') * 1000;
        $all_ext = implode(',', $this->fileService->allExtensions());

        $validate = $this->fileService->validate($request->all(), [
            'subject' => 'required',
            'summary' => 'required',
            'attachments.*' => 'sometimes|file|mimes:' . $all_ext . '|max:' . $max_size
        ]);

        if ($validate) return redirect()->back()->withErrors($validate);

        $status = $setting = $this->settings->getData('tickets', 'open');
        $statusPriotity = $setting = $this->settings->getData('ticket_priority', 'open');
        $data['user_id'] = \Auth::id();
        $data['author_id'] = \Auth::id();
        $data['status_id'] = ($status) ? $status->val : $this->statuses->where('type', 'tickets')->first()->id;
        $data['priority_id'] = ($statusPriotity) ? $statusPriotity->val : $this->statuses->where('type', 'ticket_priority')->first()->id;

        $ticket = Ticket::create($data);

        if ($ticket) {
            if ($request->hasfile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $this->fileService->saveFiles($ticket->attachments(), $file);
                }
            }
        }
        event(new Tickets(\Auth::user(), $ticket));
        return redirect()->route('my_account_tickets');
    }

    public function ticketMarkCompleted(Request $request, $id)
    {
        $ticket = Ticket::where('id', $id)->where('user_id', \Auth::id())->first();
        $status = $this->settings->getData('tickets', 'completed');

        if (!$ticket or !$status) abort(404);
        $ticket->update(['status_id' => $status->val]);

        return redirect()->route('my_account_tickets');
    }

    public function getLogs()
    {
        return $this->view('logs');
    }

    public function getPassword()
    {
        return $this->view('password');
    }

    public function getVerification()
    {
        if (\Auth::user()->status) abort(404);

        return $this->view('verification');
    }

    public function getPayments()
    {
        return $this->view('payment');
    }

    public function postVerification(VerificationRequest $request)
    {
        $user = \Auth::user();

        if ($user->status) abort(404);

        $item = $request->file('verification_image');
        $folder = Folders::where('name', 'drive')->first();
        if ($folder && \File::isDirectory($folder->path())) {
            $realName = $user->id . '.' . $request->get('verification_type');
            $originalName = md5(uniqid()) . '.' . $item->getClientOriginalExtension();
            if ($item->move($folder->path(), $originalName)) {
                $item = Items::create([
                    'original_name' => $originalName,
                    'real_name' => $realName,
                    'extension' => $item->getClientOriginalExtension(),
                    'size' => \File::size($folder->path() . DIRECTORY_SEPARATOR . $originalName),
                    'folder_id' => $folder->id
                ]);
            }
        }
        $user->verification_image = $item->relativeUrl;
        $user->verification_type = $request->get('verification_type');
        $user->save();
        return redirect()->back();
    }

    public function getNotifications()
    {
        $user = \Auth::getUser();

       $messages =   CustomEmails::leftJoin('categories', 'custom_emails.category_id', '=', 'categories.id')
            ->leftJoin('categories_translations', 'categories_translations.category_id', '=', 'categories.id')
            ->leftJoin('custom_email_user', 'custom_emails.id', '=', 'custom_email_user.custom_email_id')
            ->leftJoin('users', 'custom_email_user.user_id', '=', 'users.id')
            ->where('custom_email_user.user_id', $user->id)
            ->where('custom_emails.status', '>=', 1)
             ->where('categories_translations.locale', app()->getLocale())
            ->select('custom_emails.*', 'categories_translations.name as category', 'custom_email_user.is_read')
            ->get();

//        $mailJob = MailJob::leftJoin('mail_templates', 'mail_job.template_id', '=', 'mail_templates.id')
//            ->leftJoin('mail_templates_translations', 'mail_templates.id', '=', 'mail_templates_translations.mail_templates_id')
//            ->leftJoin('categories', 'mail_templates.category_id', '=', 'categories.id')
//            ->leftJoin('categories_translations', 'categories.id', '=', 'categories_translations.category_id')
//            ->where('mail_job.to', $user->email)
//            ->where('mail_job.must_be_done', '<', Carbon::now())
//            ->select('mail_job.*', 'mail_templates_translations.subject', 'categories_translations.name as category')
//            ->get()->toArray();

//        $messages = collect(array_merge($messages, $mailJob))->sortBy('created_at');

        return $this->view('notifications', compact('messages'));
    }

    public function postDeleteNotifications(Request $request)
    {
        $messages = $request->get('ids');
        $user = \Auth::user();
        foreach ($messages as $key => $message) {
            if ($message['object'] == 'mail_job') {
                $job = $user->mail_job()->find($message['id'])->delete();
                $job->is_read = 1;
                $messages[$key]['success'] = $job->save();
            } elseif ($message['object'] == 'custom_emails') {
                $custom_message = CustomEmails::findOrFail($message['id']);
                $messages[$key]['success'] = $custom_message->users()->detach($user->id);
            }
            $messages[$key]['attr_id'] = '#' . $message['object'] . '_' . $message['id'];
        }

        return \Response::json(['error' => false, 'result' => $messages]);
    }

    public function postMarkReadNotifications(Request $request)
    {
        $messages = $request->get('ids');
        $user = \Auth::user();
        foreach ($messages as $key => $message) {
            if ($message['object'] == 'mail_job') {
                $job = $user->mail_job()->find($message['id']);
                $job->is_read = 1;
                $messages[$key]['success'] = $job->save();
            } elseif ($message['object'] == 'custom_emails') {
                $custom_message = CustomEmails::findOrFail($message['id']);
                $messages[$key]['success'] = $custom_message->users()->updateExistingPivot($user, array('is_read' => 1), false);
            }
            $messages[$key]['attr_id'] = '#' . $message['object'] . '_' . $message['id'];
        }
        return \Response::json(['error' => false, 'result' => $messages]);
    }

    public function postMarkUnreadNotifications(Request $request)
    {
        $messages = $request->get('ids');
        $user = \Auth::user();
        foreach ($messages as $key => $message) {
            if ($message['object'] == 'mail_job') {
                $job = $user->mail_job()->find($message['id']);
                $job->is_read = 0;
                $messages[$key]['success'] = $job->save();
            } elseif ($message['object'] == 'custom_emails') {
                $custom_message = CustomEmails::findOrFail($message['id']);
                $messages[$key]['success'] = $custom_message->users()->updateExistingPivot($user, array('is_read' => 0), false);
            }
            $messages[$key]['attr_id'] = '#' . $message['object'] . '_' . $message['id'];
        }
        return \Response::json(['error' => false, 'result' => $messages]);
    }

    public function getNotificationsContent(Request $request)
    {
        $object = $request->get('object');
        $id = $request->get('id');
        $user = \Auth::user();
        $user = \Auth::user();
        if ($object == 'custom_emails') {
            $messages = CustomEmails::leftJoin('custom_email_user', 'custom_emails.id', '=', 'custom_email_user.custom_email_id')
                ->leftJoin('users', 'custom_email_user.user_id', '=', 'users.id')
                ->leftJoin('custom_emails_translations', 'custom_emails.id', '=', 'custom_emails_translations.custom_emails_id')
                ->where('custom_emails_translations.locale', app()->getLocale())
                ->where('users.id', $user->id)
                ->where('custom_emails.id', $id)
                ->where('custom_emails.status', 1)
                ->select('custom_emails.*', 'users.id as user_id', 'custom_emails_translations.subject', 'custom_emails_translations.content')
                ->first();
            CustomEmailUser::where('user_id', $messages->user_id)->where('custom_email_id', $id)->update(['is_read' => 1]);
        } elseif ($object == 'mail_job') {
            $messages = MailJob::leftJoin('mail_templates', 'mail_job.template_id', '=', 'mail_templates.id')
                ->leftJoin('mail_templates_translations', 'mail_templates.id', '=', 'mail_templates_translations.mail_templates_id')
                ->where('mail_templates_translations.locale', app()->getLocale())
                ->where('mail_job.to', $user->email)
                ->whereNotNull('mail_job.to')
                ->where('mail_job.must_be_done', '<', Carbon::now())
                ->select('mail_job.*', 'mail_templates_translations.subject', 'mail_templates_translations.content')->first();
            $messages->is_read = 1;
            $messages->save();
        }

        $messages->content = sc($messages->content, $user, $messages);
        return response()->json(['error' => false, 'message' => $messages]);
    }

    public function attachFavorite(Request $request)
    {
        $id = $request->get('id');
        $user = \Auth::user();
        $user->favorites()->attach($id);

        return ['error' => false];
    }

    public function detachFavorite(Request $request)
    {
        $id = $request->get('id');
        $user = \Auth::user();
        $user->favorites()->detach($id);

        return ['error' => false];
    }

    public function postTicketsCategory(Request $request)
    {
        $category_id = $request->get('category');
        $user = \Auth::user();
        $category = Category::where('id', $category_id)->where('type', 'tickets')->first();
        if ($category && \View::exists($this->view . '.ticket_categories.' . $category->slug)) {
            $html = \View::make($this->view . '.ticket_categories.' . $category->slug, compact('user', 'category'))->render();
            return response()->json(['error' => false, 'html' => $html]);
        }
        return response()->json(['error' => true]);
    }

    public function postEmailSettings(Request $request)
    {
        $emailSettings = $request->get('email_settings',[]);
        if (count($emailSettings)) {
            foreach ($emailSettings as $category_id) {
                $response = Newsletter::where('user_id', \Auth::id())->where('category_id', $category_id)->first();
                if (!$response) {
                    Newsletter::create([
                        'user_id' => \Auth::id(),
                        'email' => \Auth::user()->email,
                        'category_id' => $category_id,
                    ]);
                }
            }
        }

        Newsletter::whereNotIn('category_id', $emailSettings)->where('user_id', \Auth::id())->delete();

        return redirect()->back();
    }

    public function postProfileImageUpload(UserAvaratRequest $request, UserService $userService)
    {
        $result = $userService->avatarUpload($request->except('_token'));
        return response()->json($result);
    }

    public function postProfileImageDelete(Request $request, UserService $userService)
    {
        $result = $userService->avatarDelete();
        return response()->json($result);
    }
}

