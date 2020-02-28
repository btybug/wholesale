<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Posts;
use App\Models\Settings;
use View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $view='frontend.blog';

    public $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function index(Request $request)
    {
        $per_page = $request->get('per-page',8);
        $sort = $request->get('sort',"desc");
        $posts = Posts::active()->orderby('created_at',$sort)->paginate($per_page);

        return $this->view('index',compact('posts'))->with('filterModel',$request->all());
    }

    public function getSingle($post_url)
    {
        $post = Posts::leftJoin('posts_translations','posts.id','posts_translations.posts_id')
            ->where('posts.status',true)
            ->where('posts_translations.url',$post_url)
            ->where('posts_translations.locale','gb')
            ->first();

        if(! $post) abort(404);

        $relatedPosts = Posts::leftJoin('post_categories','posts.id','post_categories.post_id')
            ->where('posts.status',true)
            ->where('posts.id','!=',$post->id)
            ->whereIn('post_categories.categories_post_id',$post->categories()->pluck('id')->all())
            ->orderBy('posts.created_at',"asc")->take(6)->get();

        $comments = $post->comments()->main()->get();
        $ads = $this->settings->getEditableData('single_post');
        if($ads && isset($ads['data'])){
            $ads = json_decode($ads['data'],true);
        }

        return $this->view('single_post',compact('post','comments','relatedPosts','ads'));
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
                'post_id' => 'required|exists:posts,id',
                'comment' => 'required|min:2|max:500'
            ];

            $result = [
                'post_id' => $data['post_id'],
                'status' => $setting->status,
                'parent_id' => (isset($data['parent_id'])) ? $data['parent_id'] : null,
                'author_id' => \Auth::id(),
                'comment' => trim(htmlspecialchars($data['comment']))
            ];
        }else{
            $rules = [
                'guest_name' => 'required|max:100|min:2',
                'guest_email' => 'required|max:255|min:2',
                'post_id' => 'required|exists:posts,id',
                'comment' => 'required|min:2|max:500',
            ];


            $result = [
                'post_id' => $data['post_id'],
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

        $comment = new Comment();
        $comment->create($result);
        $post = Posts::find($data['post_id']);
        $comments = $post->comments()->main()->get();
        if($setting->status == 1){

            $html = \View::make('frontend.blog.single_post_comments',compact('comments'))->render();
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
