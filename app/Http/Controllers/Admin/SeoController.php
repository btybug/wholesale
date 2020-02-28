<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/6/2018
 * Time: 10:41 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\BrandsSeo;
use App\Models\Category;
use App\Models\Common;
use App\Models\MainPagesSeo;
use App\Models\Posts;
use App\Models\RIchSnippets\RichProducts;
use App\Models\SeoPosts;
use App\Models\Settings;
use App\Models\Stock;
use App\Models\StockSeo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    protected $view = 'admin.seo';

    public function getPosts(Settings $settings)
    {

        $general = $settings->getEditableData('seo_posts');
        $fb = $settings->getEditableData('seo_fb_posts');
        $twitter = $settings->getEditableData('seo_twitter_posts');
        $robot = $settings->getEditableData('seo_robot_posts');
        return $this->view('posts', compact('general', 'fb', 'twitter', 'robot'));
    }

    public function getStocks(Settings $settings)
    {
        $general = $settings->getEditableData('seo_stocks');
        $fb = $settings->getEditableData('seo_fb_stocks');
        $twitter = $settings->getEditableData('seo_twitter_stocks');
        $robot = $settings->getEditableData('seo_robot_stocks');
        $rich = $settings->getEditableData('rich_stocks')->toArray();
        $richData=(new RichProducts())->properties;
        return $this->view('stocks', compact('general', 'fb', 'twitter', 'robot','rich','richData'));
    }

    public function getBrands(Settings $settings)
    {
        $general = $settings->getEditableData('seo_brand');
        $fb = $settings->getEditableData('seo_fb_brand');
        $twitter = $settings->getEditableData('seo_twitter_brand');
        $robot = $settings->getEditableData('seo_robot_brand');
        return $this->view('brands_general', compact('general', 'fb', 'twitter', 'robot'));
    }

    public function postStocks(Request $request, Settings $settings)
    {
        $general = $request->except(['_token', 'fb', 'twitter', 'robots']);
        $fb = $request->only('fb');
        $twitter = $request->only('twitter');
        $robot = $request->only('robots');
        $rich=$request->get('rich',[]);
        $settings->updateOrCreateSettings('seo_stocks', $general);
        $settings->updateOrCreateSettings('seo_fb_stocks', $fb['fb']);
        $settings->updateOrCreateSettings('seo_twitter_stocks', $twitter['twitter']);
        $settings->updateOrCreateSettings('seo_robot_stocks', $robot);
        $settings->updateOrCreateSettings('rich_stocks', $rich);
        return redirect()->back();
    }
    public function postBrands(Request $request, Settings $settings)
    {
        $general = $request->except(['_token', 'fb', 'twitter', 'robots']);
        $fb = $request->only('fb');
        $twitter = $request->only('twitter');
        $robot = $request->only('robots');
        $settings->updateOrCreateSettings('seo_brand', $general);
        $settings->updateOrCreateSettings('seo_fb_brand', $fb['fb']);
        $settings->updateOrCreateSettings('seo_twitter_brand', $twitter['twitter']);
        $settings->updateOrCreateSettings('seo_robot_brand', $robot);
        return redirect()->back();
    }

    public function getBulk()
    {
        return $this->view('bulk');
    }

    public function postPosts(Request $request, Settings $settings)
    {
        $general = $request->except(['_token', 'fb', 'twitter', 'robots']);
        $fb = $request->only('fb');
        $twitter = $request->only('twitter');
        $robot = $request->only('robots');
        $settings->updateOrCreateSettings('seo_posts', $general);
        $settings->updateOrCreateSettings('seo_fb_posts', $fb['fb']);
        $settings->updateOrCreateSettings('seo_twitter_posts', $twitter['twitter']);
        $settings->updateOrCreateSettings('seo_robot_posts', $robot);
        return redirect()->back();
    }



    public function getBulkProducts()
    {
        return $this->view('products');
    }

    public function getBulkEditPost($id, Settings $settings)
    {
        $post = Posts::findOrFail($id);

        $general = $settings->getEditableData('seo_posts')->toArray();
        $fbSeo = $settings->getEditableData('seo_fb_posts')->toArray();
        $twitterSeo = $settings->getEditableData('seo_twitter_posts')->toArray();
        $robot = $settings->getEditableData('seo_robot_posts');
        $seo = $post->seo;
        $seo=($seo)?$seo:new SeoPosts();
        $seo->robots=(is_null($seo->robots))?$robot->robots:$seo->robots;
        $seo->robots_follow=(is_null($seo->robots_follow))?@$general['robots_follow']:$seo->robots_follow;
        $seo->meta_robots_advanced=(is_null($seo->meta_robots_advanced))?@$general['meta_robots_advanced']:$seo->meta_robots_advanced;
        return $this->view('edit_post', compact('post', 'general', 'fbSeo', 'seo', 'twitterSeo', 'robot'));
    }
    public function getBulkEditBrands($id, Settings $settings)
    {
        $brand = Category::findOrFail($id);

        $general = $settings->getEditableData('seo_brand')->toArray();
        $fbSeo = $settings->getEditableData('seo_fb_brand')->toArray();
        $twitterSeo = $settings->getEditableData('seo_twitter_brand')->toArray();
        $robot = $settings->getEditableData('seo_robot_brand');
        $seo = $brand->seo;
        $seo=($seo)?$seo:new BrandsSeo();
        $seo->robots=(is_null($seo->robots))?$robot->robots:$seo->robots;
        $seo->robots_follow=(is_null($seo->robots_follow))?@$general['robots_follow']:$seo->robots_follow;
        $seo->meta_robots_advanced=(is_null($seo->meta_robots_advanced))?@$general['meta_robots_advanced']:$seo->meta_robots_advanced;
        return $this->view('edit_brand', compact('brand', 'general', 'fbSeo', 'seo', 'twitterSeo', 'robot'));
    }

    public function getBulkEditProduct($id, Settings $settings)
    {

        $stock = Stock::findOrFail($id);

        $general = $settings->getEditableData('seo_stocks')->toArray();

        $fbSeo = $settings->getEditableData('seo_fb_stocks')->toArray();
        $twitterSeo = $settings->getEditableData('seo_twitter_stocks')->toArray();
        $robot = $settings->getEditableData('seo_robot_stocks');
        $seo = $stock->seo;
        $seo=($seo)?$seo:new StockSeo();
        $seo->robots=(is_null($seo->robots))?$robot->robots:$seo->robots;
        $seo->robots_follow=(is_null($seo->robots_follow))?@$general['robots_follow']:$seo->robots_follow;
        $seo->meta_robots_advanced=(is_null($seo->meta_robots_advanced))?@$general['meta_robots_advanced']:$seo->meta_robots_advanced;
        return $this->view('edit_stock', compact('stock', 'general', 'fbSeo', 'twitterSeo', 'robot', 'seo'));
    }

    public function createOrUpdatePostSeo(Request $request, $id)
    {
        $data = $request->except('_token', 'translatable','post');
        SeoPosts::updateOrCreate($request->get('id'), $data);
        Posts::updateOrCreate($request->get('post_id'), [],$request->get('post')['translatable']);
        return redirect()->back();
    }
    public function createOrUpdateBrandsSeo(Request $request, $id)
    {
        $data = $request->except('_token', 'translatable','brand');
        BrandsSeo::updateOrCreate($request->get('id'), $data);
        Category::updateOrCreate($request->get('category_id'), [],$request->get('brand')['translatable']);
        return redirect()->back();
    }

    public function createOrUpdateStockSeo(Request $request, $id)
    {

        $data = $request->except('_token', 'translatable','stock');
        StockSeo::updateOrCreate($request->get('id'), $data,$request->get('translatable'));
        Stock::updateOrCreate($request->get('stock_id'), [],$request->get('stock')['translatable']);
        return redirect()->back();
    }

    public function getMainPages(Settings $settings, Request $request)
    {
        $p = $request->get('p', 'banners');
        $seo = MainPagesSeo::where('page_name', $p)->first();
        if ($p == 'banners' || $p == "single_product" || $p == "single_post" || $p == "my_account" || $p == "stickers") {
            $model = $settings->getEditableData($p);
            $top = $settings->getEditableData('top');

        } else {
            $model = Common::where('type', $p)->first();
        }
        return $this->view('main_pages', compact(['model', 'p', 'seo']));
    }

    public function postMainPagesSeo(Request $request)
    {
        $data = $request->except('_token', 'p', 'translatable');
        $data['page_name'] = $request->get('p', 'banners');
        MainPagesSeo::updateOrCreate($request->id, $data);
        return redirect()->back();
    }

    public function getBulkBrands()
    {
        return $this->view('brands');
    }

    public function postItemRowsEdit($ids, Settings $settings)
    {

        $ids = explode(',', $ids);
        $stocks = Stock::findMany($ids);
        $general = $settings->getEditableData('seo_stocks')->toArray();
        $fbSeo = $settings->getEditableData('seo_fb_stocks')->toArray();
        $twitterSeo = $settings->getEditableData('seo_twitter_stocks')->toArray();
        $robot = $settings->getEditableData('seo_robot_stocks');

        return $this->view('rows_edit', compact('stocks', 'general', 'fbSeo', 'twitterSeo', 'robot'));
    }
    public function postPostsRowsEdit($ids, Settings $settings)
    {

        $ids = explode(',', $ids);
        $posts = Posts::findMany($ids);

        $general = $settings->getEditableData('seo_posts')->toArray();
        $fbSeo = $settings->getEditableData('seo_fb_posts')->toArray();
        $twitterSeo = $settings->getEditableData('seo_twitter_posts')->toArray();
        $robot = $settings->getEditableData('seo_robot_posts');

        return $this->view('posts_rows_edit', compact('posts', 'general', 'fbSeo', 'twitterSeo', 'robot'));
    }

    public function postItemRowsEditSave(Request $request)
    {
        $stocks= $request->except('_token');
        foreach ($stocks as $key=>$stock){
            StockSeo::updateOrCreate($stock['seo_id'], ['stock_id'=>$key],$stock['translatable']);
            Stock::updateOrCreate($key, [],$stock['stock']['translatable']);
        }
        return redirect()->back();
    }
    public function postPostsRowsEditSave(Request $request)
    {
        $stocks= $request->except('_token');
        foreach ($stocks as $key=>$stock){
            SeoPosts::updateOrCreate($stock['seo_id'], ['post_id'=>$key],$stock['translatable']);
            Posts::updateOrCreate($key, [],$stock['post']['translatable']);
        }
        return redirect()->back();
    }

    public function getRichProperties(Request $request)
    {
        $type=$request->get('type');

        switch ($type){
            case "stock":$data=(new RichProducts())->properties  ;break;
            case "post":  ;break;
            default:$data=[];
        }
        return response()->json($data);
    }
}
