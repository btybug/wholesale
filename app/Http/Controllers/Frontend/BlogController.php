<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Posts;
use View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $view='frontend.blog';

    public function index(Request $request)
    {
        $per_page = $request->get('per-page',15);
        $sort = $request->get('sort',"desc");


        $posts = Posts::active()->orderby('created_at',$sort)->paginate($per_page);
//        dd($posts->toArray());
        return $this->view('index',compact('posts'))->with('filterModel',$request->all());
    }

    public function getSingle($post_url)
    {
        $post = Posts::active()->where('url',$post_url)->first();
        if(! $post) abort(404);

        $relatedPosts = Posts::leftJoin('post_categories','posts.id','post_categories.post_id')
            ->where('posts.status',true)
            ->where('posts.id','!=',$post->id)
            ->whereIn('post_categories.categories_post_id',$post->categories()->pluck('id')->all())
            ->orderBy('posts.created_at',"asc")->take(6)->get();

        $comments = $post->comments()->main()->get();
        return $this->view('single_post',compact('post','comments','relatedPosts'));
    }

    public function addComment(Request $request)
    {
        $data = $request->all();

        if(\Auth::check()){
            $rules = [
                'post_id' => 'required|exists:posts,id',
                'comment' => 'required|min:2|max:500'
            ];

            $result = [
                'post_id' => $data['post_id'],
                'status' => 1,
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
                'status' => 1,
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
        $html = \View::make('frontend.blog.single_post_comments',compact('comments'))->render();

        return \Response::json(['success' => true,'message' => 'Success','html' => $html]);
    }
}
