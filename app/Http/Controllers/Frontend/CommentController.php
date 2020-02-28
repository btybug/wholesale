<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Posts;
use App\Models\Settings;
use View;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $view='frontend.comments';

    public $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function addComment(Request $request,Settings $settings)
    {
        $data = $request->all();
        $setting = $settings->getEditableData('admin_comments_setting');

        if($setting->status === null){
            $message = "Something is wrong, please try again later";
            return \Response::json(['success' => false,'message' => $message,'html' => '']);
        }

        if(\Auth::check()){
            $rules = [
                'comment' => 'required|min:2|max:500'
            ];

            $result = [
                'section_id' => $data['section_id'],
                'section' => $data['section'],
                'status' => $setting->status,
                'parent_id' => (isset($data['parent_id'])) ? $data['parent_id'] : null,
                'author_id' => \Auth::id(),
                'comment' => trim(htmlspecialchars($data['comment']))
            ];
        }else{
            $rules = [
                'guest_name' => 'required|max:100|min:2',
                'guest_email' => 'required|max:255|min:2',
                'comment' => 'required|min:2|max:500',
            ];


            $result = [
                'section_id' => $data['section_id'],
                'section' => $data['section'],
                'status' => $setting->status,
                'comment' => trim(htmlspecialchars($data['comment'])),
                'parent_id' => (isset($data['parent_id'])) ? $data['parent_id'] : null,
                'guest_name' => trim(htmlspecialchars($data['guest_name'])),
                'guest_email' => trim(htmlspecialchars($data['guest_email']))
            ];
        }

        $validator = \Validator::make($data, $rules);

        if ($validator->fails()) {
            return \Response::json(['errors' => $validator->messages(),'success' => false]);
        }

        $config = config("comments");

        if(! isset($config[$data['section']])){
            $message = "Something is wrong, please try again later";
            return \Response::json(['success' => false,'message' => $message,'html' => '']);
        }



        $comment = new Comment();
        $comment->create($result);

        $m = $config[$data['section']];
        $model = $m::find($data['section_id']);
       
        if($setting->status == 1){
            $html = \View::make('frontend.comments.list',compact('model'))->render();
            $message = "Success";
            $render = true;
        }else{
            $html = '';
            $message = 'Your comment under admin confirmation..., Thank you for your activity !';
            $render = false;
        }

        return \Response::json(['success' => true,'message' => $message,'html' => $html,'render' => $render]);
    }

    public function deleteComment(Request $request,Settings $settings)
    {
        $setting = $settings->getEditableData('admin_comments_setting');
        $id = $request->get('id');
        if($setting && $setting->user_delete == 1){
           $comment =  Comment::where('id',$id)->where('author_id',\Auth::id())->first();
           if($comment){
               $comment->delete();
               return \Response::json(['success' => true,'message' => "Your comment deleted successfully!!!"]);
           }else{
               return \Response::json(['success' => true,'message' => "You can't delete that comment"]);
           }
        }
        return \Response::json(['success' => false,'message' => "Fails !!!"]);
    }
}
