<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12/25/2018
 * Time: 5:16 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Requests\MailTemplatesRequest;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Mail\SendSubscriptionEmail;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Coupons;
use App\Models\Emails;
use App\Models\MailTemplates;
use App\Models\Newsletter;
use App\Models\Notifications\CustomEmails;
use App\Models\Notifications\CustomEmailUser;
use App\Models\NewsletterJob;
use App\Services\ShortCodes;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailsNotificationsController extends Controller
{
    protected $view = 'admin.emails_notifications';

    public function sendEmail()
    {
        return $this->view('send.emails');
    }

    public function settings()
    {
        $categories = Category::whereNull('parent_id')->where('type', 'notifications')->get();
        $allCategories = Category::where('type', 'notifications')->get();
        enableMedia('drive');
        $type='notifications';
        return $this->view('settings', compact('categories','allCategories', 'type'));
    }

    public function sendEmailCreate($id = null)
    {
        $model = CustomEmails::find($id);
        $froms = Emails::where('type', 'from')->pluck('email', 'email');
        $shortcodes = new ShortCodes();
        $categories = Category::where('type','notifications')->get()->pluck('name','id');
        $users = User::all()->pluck('name', 'id');
        $campaings = Campaign::all()->pluck('title', 'id');
        $now = strtotime(today()->toDateString());
        $coupons = Coupons::where(function ($q) use ($now){
            $q->where('start_date','<=',$now)->where('end_date','>=',$now)->where('status',true);
        })->orWhere(function ($q) use ($now) {
            $q->where('start_date','>',$now)->where('status',true);
        })->get()->pluck('name', 'id')->all();
//        dd($coupons);

//        dd($this->getSubscribersByType());
        return $this->view('send.email_create', compact('users', 'shortcodes', 'froms', 'model','categories','campaings','coupons'));
    }

    public function sendEmailView($id = null)
    {
        $model = CustomEmails::find($id);
        $admin_model = null;//CustomEmails::where("parent_id", "=", $id)->first();
//        dd($admin_model);
        ($model['status']==0 || $model['is_for_admin']==1) ? abort("404") : "";
        return $this->view('send.email_view', compact( ['model','admin_model']));
    }

    public function postSendEmailCreate(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        $users = $this->getEmailUsers($request->get('users'),$request->get('groups'),$category);

        $data = $request->only('from', 'category_id','coupon_id');
        $data['status'] = 0;

        $translatable = $request->get('translatable');
        $emailCustomer = CustomEmails::updateOrCreate($request->id, $data, $translatable);
        $current_id = $emailCustomer['id'];
        $emailCustomer->users()->attach($users, ['status' => 0]);

        $data['is_for_admin'] = 1;
//        $data['parent_id'] = $current_id;
        $translatable_for_admin = $request->get('admin')["translatable"];
        $email = CustomEmails::updateOrCreate($request->id, $data, $translatable_for_admin);
        $email->users()->attach( [1], ['status' => 0]);

        if($category->slug == 'newsletter'){
            $guestSubscribed = Newsletter::whereNull('user_id')->where('category_id',$category->id)->get();
            if(count($guestSubscribed)){
                foreach ($guestSubscribed as $guest){
                    NewsletterJob::create([
                       'custom_email_id' => $emailCustomer->id,
                       'newsletter_id' => $guest->id
                    ]);
                }
            }
        }

        return redirect()->route('admin_emails_notifications_send_email');
    }

    public function postSendEmailCreateSend(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        $users = $this->getEmailUsers($request->get('users'),$request->get('groups'),$category);

        $data = $request->only('from', 'category_id','coupon_id');
        $data['status'] = 1;

        $translatable = $request->get('translatable');
        $emailCustomer = CustomEmails::updateOrCreate($request->id, $data, $translatable);
        $emailCustomer->users()->attach($users, ['status' => 1]);

        if($category->slug == 'newsletter'){
            $guestSubscribed = Newsletter::whereNull('user_id')->where('category_id',$category->id)->get();
            if(count($guestSubscribed)){
                foreach ($guestSubscribed as $guest){
                    NewsletterJob::create([
                        'custom_email_id' => $emailCustomer->id,
                        'newsletter_id' => $guest->id,
                        'status' => 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin_emails_notifications_send_email');
    }

    public function getEmailUsers($users,$groups,$category)
    {
        if($category->slug == 'newsletter'){
            $users = User::pluck('users.id')->all();
        }
        $result = [];
        if($groups && count($groups)){
            foreach ($groups as $group){
                $capaign = Campaign::find($group);
                if($capaign){
                    $x = collect(\DB::select($capaign->sql_query));
                    $result = array_merge($result,$x->pluck('id')->all());
                }
            }
        }

        $response = array_merge($users,$result);
        return array_unique($response);
    }

    public function emails()
    {
        return $this->view('emails.index');
    }

    public function getCreateMailTemplates($id = null)
    {

        $model = MailTemplates::find($id);
        $froms = Emails::where('type', 'from')->pluck('email', 'email');
        $tos = Emails::where('type', 'to')->pluck('email', 'email');
        $admin_model = MailTemplates::where('slug', 'admin_' . $model->slug)->first();
        $categories = Category::where('type','notifications')->get()->pluck('name','id');
        $shortcodes = new ShortCodes();
        return $this->view('emails.manage', compact('model', 'shortcodes','categories', 'admin_model', 'froms', 'tos'));
    }

    public function postCreateOrUpdate(MailTemplatesRequest $request)
    {
        $mail = MailTemplates::findOrFail($request->id);
        $data = $request->except('admin', 'translatable', '_token');
        $translatable = $request->get('translatable');
        $admin_data = $request->get('admin');
        if(isset($admin_data['cc'])){
        $admin_data['cc']=is_array($admin_data['cc'])?implode(',',$admin_data['cc']):null;
        }
        MailTemplates::updateOrCreate($request->id, $data, $translatable);
        $translatable = $admin_data['translatable'];
        unset($admin_data['translatable']);
        $admin_data['slug'] = 'admin_' . $mail->slug;
        $admin_model = MailTemplates::where('slug', $admin_data['slug'])->first();
        $admin_data['is_for_admin'] = 1;
        $id = ($admin_model) ? $admin_model->id : null;
        MailTemplates::updateOrCreate($id, $admin_data, $translatable);
        return redirect()->route('admin_emails_notifications_emails');
    }

    public function sendEmailSendNow(Request $request)
    {
        $email = CustomEmails::where('id', $request->id)->first();
        $category = Category::find($email->category_id);
        $email->update(['status' => 1]);
        $email->custom_email_users()->update(['custom_email_user.status' => 1,'custom_email_user.updated_at' => Carbon::now()]);

        if($category->slug == 'newsletter'){
            $guestSubscribed = Newsletter::whereNull('user_id')->where('category_id',$category->id)->get();
            if(count($guestSubscribed)){
                foreach ($guestSubscribed as $guest){
                    NewsletterJob::where('newsletter_id',$guest->id)->where('custom_email_id',$email->id)->update(['status'=>1]);
                }
            }
        }

        return response()->json(['error' => false]);
    }

    public function sendEmailCopy(Request $request)
    {
        $email = CustomEmails::find($request->id);
        $new_email = $email->replicate();
        $new_email->status = 0;
        $new_email->push();
        foreach ($email->languages as $language) {
            $new_language = $language->replicate();
            $new_language->custom_emails_id = $new_email->id;
            $new_language->push();
        }
        $new_email->users()->attach($email->users->pluck('id'), ['status' => 0]);
        return response()->json(['error' => false]);
    }

    public function getNewsletters()
    {
        return $this->view('newsletters');
    }

    public function postAddSubscriber(Request $request)
    {
        $email = $request->get('email');
        $newsletter = Newsletter::where('email',$email)->first();
        $category = Category::where('slug','newsletter')->first();
        if(! $newsletter && $category){
            Newsletter::create([
               'email' => $email,
                'category_id' => $category->id
            ]);
        }

        return redirect()->back();
    }

    public function postDeleteNewsletter(Request $request)
    {
        $newsletter = Newsletter::findOrFail($request->slug);

        $newsletter->delete();

        return response()->json(['error'=>false]);
    }

    public function postSendEmailCheckCategroy(Request $request)
    {
        $categeory = Category::where('type','notifications')->where('id',$request->id)->first();

        if($categeory){
            return response()->json(['error' => false,'slug' => $categeory->slug]);
        }

        return response()->json(['error' => true]);
    }

    public function templates($template)
    {
        return view("mail_templates.$template");
    }
}
