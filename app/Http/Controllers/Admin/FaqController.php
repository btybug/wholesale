<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Http\Requests\StoreBlogPost;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Comment;
use App\Models\Faq;
use App\Models\Posts;
use App\Models\SeoPosts;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\User;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class FaqController extends Controller
{
    protected $view = 'admin.faq';

    private $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function index()
    {
//        $stocks = Faq::all();
//        foreach ($stocks as $stock){
//            $stock->translate('gb')->slug = strtolower(str_replace(' ','-',str_replace('?','',$stock->question)));
//            $stock->save();
//        }
//        dd('fsyo');
        return $this->view('index');
    }

    public function create()
    {
        $model = null;
        $categories = Category::with('children')->where('type','faq')->whereNull('parent_id')->get();
        $data = Category::recursiveItems($categories);

        $general = $this->settings->getEditableData('seo_faq')->toArray();
        $twitterSeo = $this->settings->getEditableData('seo_twitter_faq')->toArray();
        $fbSeo = $this->settings->getEditableData('seo_fb_faq')->toArray();
        $robot = $this->settings->getEditableData('seo_robot_faq');

        return $this->view('new', compact('model', 'general', 'twitterSeo', 'fbSeo', 'robot', 'data'));
    }

    public function settings()
    {
        $categories = Category::whereNull('parent_id')->where('type', 'faq')->get();
        $allCategories = Category::where('type', 'faq')->get();
        enableMedia('drive');
        return $this->view('settings', compact('categories','allCategories'));
    }

    public function newPost(FaqRequest $request, $locale = null)
    {
        $data = $request->except('_token', 'translatable', 'categories', 'stocks', 'fb', 'twitter', 'general', 'robot');
        $data['user_id'] = \Auth::id();
        $faq = Faq::updateOrCreate($request->id, $data);
        $faq->categories()->sync(json_decode($request->get('categories', [])));
        $faq->stocks()->sync($request->get('stocks', []));
//        $this->createOrUpdateSeo($request, $faq->id);
        return redirect()->route('admin_faq');
    }

    public function getDelete(Request $request)
    {
        $faq = Faq::findOrFail($request->slug);
        $faq->delete();
        return response()->json(['error' => false]);
    }

    public function edit($id)
    {
        $model = Faq::findOrFail($id);
        $categories = Category::with('children')->where('type','faq')->whereNull('parent_id')->get();
        $checkedCategories = $model->categories()->pluck('id')->all();
        $data = Category::recursiveItems($categories, 0, [], $checkedCategories);

        $general = $this->settings->getEditableData('seo_faq')->toArray();
        $twitterSeo = $this->settings->getEditableData('seo_twitter_faq')->toArray();
        $fbSeo = $this->settings->getEditableData('seo_fb_faq')->toArray();
        $robot = $this->settings->getEditableData('seo_robot_faq');

        return $this->view('new', compact('model', 'general', 'twitterSeo', 'fbSeo', 'robot', 'data', 'checkedCategories'));
    }
}
