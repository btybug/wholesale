<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Reply;
use App\Models\Settings;
use App\Models\Statuses;
use App\Models\Ticket;
use App\Models\TicketFiles;
use App\Services\FileService;
use App\User;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    protected $view = 'admin.ticket';

    private $statuses;
    private $category;
    private $user;
    private $fileService;
    private $settings;

    public function __construct(
        Statuses $statuses,
        Category $category,
        User $user,
        FileService $fileService,
        Settings $settings
    )
    {
        $this->statuses = $statuses;
        $this->category = $category;
        $this->user = $user;
        $this->fileService = $fileService;
        $this->settings = $settings;
    }

    public function index()
    {
        return $this->view('index');
    }

    public function getNew()
    {
        $model = null;
        $statuses = $this->statuses->where('type', 'tickets')->get()->pluck('name', 'id')->all();
        $priorities = $this->statuses->where('type', 'ticket_priority')->get()->pluck('name', 'id')->all();
        $categories = $this->category->where('type', 'tickets')->get()->pluck('name', 'id')->all();
        $staff = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->whereNotNull('role_id')
            ->orWhere('roles.type', 'backend')->select('users.*')->get()->pluck('name','id')->all();
        $users = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->whereNull('role_id')
            ->orWhere('roles.type', 'frontend')->select('users.*')->get()->pluck('name','id')->all();

        return $this->view('new', compact(['model', 'statuses', 'priorities', 'categories', 'staff','users']));
    }

    public function postNew(Request $request)
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

        $data['author_id'] = \Auth::id();
        $ticket = Ticket::create($data);

        if ($ticket) {
            if ($request->hasfile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $this->fileService->saveFiles($ticket->attachments(), $file);
                }
            }
        }

        return redirect()->route('admin_tickets');
    }

    public function getEdit($id)
    {
        $model = Ticket::findOrFail($id);
        $statuses = $this->statuses->where('type', 'tickets')->get()->pluck('name', 'id')->all();
        $priorities = $this->statuses->where('type', 'ticket_priority')->get()->pluck('name', 'id')->all();
        $categories = $this->category->where('type', 'tickets')->get()->pluck('name', 'id')->all();
        $staff = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->whereNotNull('role_id')
            ->orWhere('roles.type', 'backend')->select('users.*')->get()->pluck('name','id')->all();
        $users = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->whereNull('role_id')
            ->orWhere('roles.type', 'frontend')->select('users.*')->get()->pluck('name','id')->all();
        $replies = $model->replies()->main()->oldest()->get();

        $data = mergeCollections($replies, $model->history()->oldest()->get());
        return $this->view('edit', compact(['model', 'statuses', 'priorities', 'categories', 'staff', 'data','users']));

    }

    public function postEdit(Request $request, $id)
    {
        $model = Ticket::findOrFail($id);

        $model->update($request->except('_token'));

        return redirect()->back();
    }

    public function reply(Request $request)
    {
        $data = $request->all();
        $max_size = (int)ini_get('upload_max_filesize') * 1000;
        $all_ext = implode(',', $this->fileService->allExtensions());

        $rules = [
            'ticket_id' => 'required|exists:tickets,id',
            'reply' => 'required|min:2|max:1000',
            'attachments.*' => 'sometimes|file|mimes:' . $all_ext . '|max:' . $max_size
        ];

        $result = [
            'ticket_id' => $data['ticket_id'],
            'parent_id' => (isset($data['parent_id'])) ? $data['parent_id'] : null,
            'author_id' => \Auth::id(),
            'reply' => trim(htmlspecialchars($data['reply']))
        ];

        $validator = \Validator::make($data, $rules);

        if ($validator->fails()) {
            return \Response::json(['errors' => $validator->messages(), 'success' => false]);
        }

        $reply = new Reply();
        $reply->create($result);
        $ticket = Ticket::find($data['ticket_id']);
        if ($request->hasfile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $this->fileService->saveFiles($ticket->attachments(), $file);
            }
        }

        $replies = $ticket->replies()->main()->get();
        $data = mergeCollections($replies, $ticket->history);
        $html = \View::make('admin.ticket._partials.comments', compact('data'))->render();
        $attachments = \View::make("admin.ticket._partials.attachments", compact('ticket'))->render();

        return \Response::json(['success' => true, 'message' => 'Success', 'html' => $html,'attachments' =>$attachments]);
    }

    public function getSettings()
    {
        $statuses = $this->statuses->where('type', 'tickets')->get();
        $settings = $this->settings->getEditableData('tickets');

        $categories = Category::whereNull('parent_id')->where('type', 'tickets')->get();
        $allCategories = Category::where('type', 'tickets')->get();
        enableMedia('drive');

        return $this->view('settings', compact(['settings', 'statuses','categories','allCategories']));
    }

    public function statuses($type)
    {
        $statuses=Statuses::where('type',$type)->get();
        return $this->view('statuses',compact('statuses','type'));
    }

    public function postSettings(Request $request)
    {
        $data = $request->except('_token');

        $this->settings->updateOrCreateSettings('tickets', $data);

        return redirect()->back();
    }

    public function getClose(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $status = $this->settings->getData('tickets', 'completed');

        if (!$status) abort(404);
        $ticket->update(['status_id' => $status->val]);

        return redirect()->route('admin_tickets');
    }

}
