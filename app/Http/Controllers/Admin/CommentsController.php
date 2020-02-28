<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Settings;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CommentsController extends Controller
{
    protected $view = 'admin.comments';

    public $comment;

    public function __construct(
        Comment $comment
    )
    {
        $this->comment = $comment;
    }

    public function index()
    {
        return $this->view('show');
    }

    public function unapprove($id)
    {
        $comment = $this->comment->findOrFail($id);
        $comment->update(['status' => 0]);

        return redirect()->back()->with("message", "Comment Successfully unapproved");
    }

    public function approve($id)
    {
        $comment = $this->comment->findOrFail($id);
        $comment->update(['status' => 1]);

        return redirect()->back()->with("message", "Comment Successfully approved");
    }

    public function edit($id)
    {
        $comment = $this->comment->findOrFail($id);

        return $this->view('edit', compact(['comment']));
    }

    public function postEdit(Request $request, $id)
    {
        $comment = $this->comment->findOrFail($id);
        $comment->update($request->except('_token'));

        return redirect()->route('show_comments')->with("message", "Comment Successfully edited");
    }

    public function reply($id)
    {
        $comment = $this->comment->findOrFail($id);

        return $this->view('reply', compact(['comment']));
    }

    public function postReply(Request $request, $id)
    {
        $comment = $this->comment->findOrFail($id);
        $this->comment->create(['author_id' => \Auth::id(), 'comment' => $request->comment, 'parent_id' => $id, 'post_id' => $comment->post_id, 'status' => 1]);

        return redirect()->route('show_comments')->with("message", "Comment Successfully replied");
    }

    public function delete(Request $request)
    {
        $comment = $this->comment->findOrFail($request->slug);
        $comment->delete();
        return response()->json(['errpr' => false]);
    }

    public function getSettings(Settings $settings)
    {
        $model = $settings->getEditableData('admin_comments_setting');

        return $this->view('settings', compact(['model']));
    }

    public function postSettings(Request $request,Settings $settings)
    {
        $settings->updateOrCreateSettings('admin_comments_setting', $request->except('_token'));

        return redirect()->back();
    }
}
