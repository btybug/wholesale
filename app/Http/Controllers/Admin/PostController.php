<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPost;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Comment;
use App\Models\Posts;
use App\Models\SeoPosts;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\User;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class PostController extends Controller
{
    protected $view = 'admin.blog';

    private $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function index()
    {
        return $this->view('index');
    }

    public function create()
    {
        $post = null;
        $categories = Category::with('children')->where('type', 'posts')->whereNull('parent_id')->get();
        $data = Category::recursiveItems($categories);

        $general = $this->settings->getEditableData('seo_posts')->toArray();
        $twitterSeo = $this->settings->getEditableData('seo_twitter_posts')->toArray();
        $fbSeo = $this->settings->getEditableData('seo_fb_posts')->toArray();
        $robot = $this->settings->getEditableData('seo_robot_posts');
        $authors = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.type', 'backend')->select('users.*', 'roles.title')->pluck('users.name', 'users.id')->toArray();

        return $this->view('new', compact('post', 'authors', 'general', 'twitterSeo', 'fbSeo', 'robot', 'data'));
    }

    public function settings()
    {
        $categories = Category::whereNull('parent_id')->where('type', 'posts')->get();
        $allCategories = Category::where('type', 'posts')->get();
        enableMedia('drive');
        return $this->view('settings',compact('categories','allCategories'));
    }

    public function newPost(StoreBlogPost $request, $locale = null)
    {

        $data = $request->except('_token', 'translatable', 'categories', 'stocks', 'fb', 'twitter', 'general', 'robot');

        $post = Posts::updateOrCreate($request->id, $data);
        $post->categories()->sync(json_decode($request->get('categories', [])));
        $post->stocks()->sync($request->get('stocks', []));
        $this->createOrUpdateSeo($request, $post->id);
        return redirect()->route('admin_blog');
    }

    public function getDelete(Request $request)
    {
        $post = Posts::findOrFail($request->slug);
        $post->delete();
        return response()->json(['error' => false]);
    }

    public function edit($id)
    {
        $post = Posts::findOrFail($id);

        $categories = Category::with('children')->where('type', 'posts')->whereNull('parent_id')->get();
        $checkedCategories = $post->categories()->pluck('id')->all();
        $data = Category::recursiveItems($categories, 0, [], $checkedCategories);

        $general = $this->settings->getEditableData('seo_posts')->toArray();
        $twitterSeo = $this->settings->getEditableData('seo_twitter_posts')->toArray();
        $fbSeo = $this->settings->getEditableData('seo_fb_posts')->toArray();
        $robot = $this->settings->getEditableData('seo_robot_posts');


        $authors = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.type', 'backend')->select('users.*', 'roles.title')->pluck('users.name', 'users.id')->toArray();
        return $this->view('new', compact('post', 'authors', 'general', 'twitterSeo', 'fbSeo', 'robot', 'data', 'checkedCategories'));
    }

    public function getComments()
    {
        return $this->view('comments.index');
    }

    public function getCommentSettings()
    {
        return $this->view('comments.settings');
    }

    public function getCommentsEdit($id)
    {
        return $this->view('comments.edit');
    }

    public function getCommentsDelete($id)
    {
//        $post = Posts::findOrFail($id);
//        $post->delete();
//        return redirect()->route('admin_blog');
    }

    private function createOrUpdateSeo($request, $post_id)
    {
        $types = $request->only(['fb', 'general', 'twitter', 'robot']);
        foreach ($types as $type => $data) {
            foreach ($data as $name => $value) {
                $seo = SeoPosts::firstOrNew(['post_id' => $post_id, 'name' => $name, 'type' => $type]);
                if ($value) {
                    $seo->content = $value;
                    $seo->save();
                } else {
                    $seo->delete();
                }
            }
        }
    }

}
