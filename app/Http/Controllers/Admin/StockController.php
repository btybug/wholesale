<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 2/18/2019
 * Time: 2:42 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Models\ActivityLogs;
use App\Models\Attributes;
use App\Models\Barcodes;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Filters;
use App\Models\Items;
use App\Models\Settings;
use App\Models\Stickers;
use App\Models\Stock;
use App\Models\StockOfferProducts;
use App\Models\StockSeo;
use App\Models\StockVariation;
use App\Models\Translations\StockTranslation;
use App\Services\PrinterService;
use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected $view = 'admin.stock';

    private $stockService;
    private $settings;

    public function __construct(StockService $stockService, Settings $settings)
    {
        $this->stockService = $stockService;
        $this->settings = $settings;
    }


    public function stock()
    {
//        $stocks = Items::all();
//        foreach ($stocks as $stock){
//            $stock->translate('gb')->short_name = $stock->name;
//            $stock->save();
//        }
//
//        $filters = StockVariation::where('type','filter')->get();
//
//        if(count($filters)){
//            foreach ($filters as $filter){
//                $filter->image = $filter->item->image;
//                $filter->save();
//            }
//        }
//        dd('done');

//        $stocks = Stock::all();
//        foreach ($stocks as $stock){
//            $extra_images = $stock->other_images;
//            $otther_images = [];
//            if($extra_images && count($extra_images)){
//                foreach ($extra_images as $key => $image){
//                    $otther_images[$key] = [
//                        "image" => $image,
//                          "url" => "",
//                          "tags" => "",
//                          "alt" => "",
//                    ];
//                }
//            }
//
//            $stock->other_images = $otther_images;
//            $stock->save();
//        }
//        dd('done');

        return $this->view('stock');
    }

    public function stockOffers()
    {
        return $this->view('offers');
    }

    public function stockNew()
    {
        $model = null;
        $categories = Category::with('children')->where('type', 'stocks')->whereNull('parent_id')->get();
        $brands = Category::with('children')->where('type', 'brands')->whereNull('parent_id')->get();
        $offers = Category::with('children')->where('type', 'offers')->whereNull('parent_id')->get();
        $special_filters = Category::with('children')->where('type', 'special_filter')->whereNull('parent_id')->get();

        $data = Category::recursiveItems($categories);
        $dataOffers = Category::recursiveItems($offers);

        $allAttrs = Attributes::with('children')->whereNull('parent_id')->get();
        $stockItems = Items::active()->get()->pluck('name', 'id')->all();
        $filters = Category::where('type', 'filter')->whereNull('parent_id')->get()->pluck('name', 'id')->all();

        $general = $this->settings->getEditableData('seo_stocks')->toArray();
        $twitterSeo = $this->settings->getEditableData('seo_twitter_stocks')->toArray();
        $fbSeo = $this->settings->getEditableData('seo_fb_stocks')->toArray();
        $robot = $this->settings->getEditableData('seo_robot_stocks');

        return $this->view('stock_new', compact(['model', 'data', 'brands', 'categories', 'general', 'allAttrs', 'offers', 'dataOffers',
            'twitterSeo', 'fbSeo', 'robot', 'stockItems', 'filters', 'special_filters']));
    }

    public function getStockEdit($id)
    {
        $model = Stock::findOrFail($id);
        $variations = collect($model->variations()->where('is_required', true)->orderBy('ordering','asc')->get())->groupBy('variation_id');
        $extraVariations = collect($model->variations()->where('is_required', false)->get())->groupBy('variation_id');

        $categories = Category::with('children')->where('type', 'stocks')->whereNull('parent_id')->get();
        $brands =Brands::all();
        $offers = Category::with('children')->where('type', 'offers')->whereNull('parent_id')->get();
        $special_filters = Category::with('children')->where('type', 'special_filter')->whereNull('parent_id')->get();

        $checkedCategories = $model->categories()->pluck('id')->all();
        $checkedOffers = $model->offers()->pluck('id')->all();
        $data = Category::recursiveItems($categories, 0, [], $checkedCategories);
        $dataOffers = Category::recursiveItems($offers, 0, [], $checkedOffers);

        $allAttrs = Attributes::with('children')->whereNull('parent_id')->get();
        $stockItems = Items::active()->get()->pluck('name', 'id')->all();
        $filters = Category::where('type', 'filter')->whereNull('parent_id')->get()->pluck('name', 'id')->all();

        $general = $this->settings->getEditableData('seo_stocks')->toArray();
        $twitterSeo = $this->settings->getEditableData('seo_twitter_stocks')->toArray();
        $fbSeo = $this->settings->getEditableData('seo_fb_stocks')->toArray();
        $robot = $this->settings->getEditableData('seo_robot_stocks');

        return $this->view('stock_new', compact(['model', 'variations', 'extraVariations', 'brands', 'offers', 'dataOffers',
            'checkedCategories', 'categories', 'allAttrs', 'general', 'stockItems', 'twitterSeo', 'fbSeo', 'robot', 'data', 'filters', 'special_filters']));
    }

    public function postStock(ProductsRequest $request)
    {
        $data = $request->except('_token', 'translatable', 'options', 'promotions', 'specifications', 'offer_products',
            'variations', 'variation_single', 'package_variation_price', 'package_variation_count_limit', 'package_variation',
            'extra_product', 'promotion_prices', 'promotion_type', 'categories', 'offers', 'general', 'related_products',
            'stickers', 'fb', 'twitter', 'general', 'robot', 'type_attributes', 'type_attributes_options', 'ads', 'banners', 'special_filters');
        $data['user_id'] = \Auth::id();
        $data['videos'] = $request->get('videos',[]);

        $translatable=$request->get('translatable');
        foreach ($translatable as $key=>$value){
           $translatable[$key]['slug']=strtolower(str_replace(' ','-',$value['slug']));
        }

        $stock = Stock::updateOrCreate($request->id, $data,$translatable);

        $this->stockService->savePackageVariation($stock, $request->get('variations', []));

        $this->stockService->makeTypeOptions($stock, $request->get('type_attributes', []));
//        $stock->specifications()->sync($request->get('specifications'));
//        $options = $this->stockService->makeOptions($stock, $request->get('options', []));

        $ads = $request->get('ads', []);
        $adNotDeletable = [];
        if (count($ads)) {
            foreach ($ads as $ad) {
                if (isset($ad['id'])) {
                    $stock_ad = $stock->ads()->where('id', $ad['id'])->first();
                    if ($stock_ad) {
                        if ($ad['image']) {
                            $stock_ad->fill($ad);
                            $stock_ad->save();
                            $adNotDeletable[] = $stock_ad->id;
                        }
                    }
                } else {
                    if ($ad['image']) {
                        $stock_ad = $stock->ads()->create($ad);
                        $adNotDeletable[] = $stock_ad->id;
                    }
                }
            }
        }

        $stock->ads()->whereNotIn('id', $adNotDeletable)->delete();

        $banners = $request->get('banners', []);
//        dd($banners);
        $bannerNotDeletable = [];
        if (count($banners)) {
            foreach ($banners as $banner) {
                if (isset($banner['id'])) {
                    $stock_ba = $stock->banners()->where('id', $banner['id'])->first();
                    if ($stock_ba) {
                        if ($banner['image']) {
                            $stock_ba->fill($banner);
                            $stock_ba->save();
                            $bannerNotDeletable[] = $stock_ba->id;
                        }
                    }
                } else {
                    if ($banner['image']) {
                        $stock_ba = $stock->banners()->create($banner);
                        $bannerNotDeletable[] = $stock_ba->id;
                    }
                }
            }
        }

        $stock->banners()->whereNotIn('id', $bannerNotDeletable)->delete();

//        if($options && count($options)){
//            foreach ($options as $option){
//                StockAttribute::create([
//                    'attributes_id' => $option['attributes_id'],
//                    'sticker_id' => $option['sticker_id'],
//                    'parent_id' => $option['parent_id'],
//                    'stock_id' => $stock->id,
//                ]);
//            }
//        }

        $offer_products = $request->get('offer_products', []);

        if ($stock->is_offer) {
            if ($stock->offer_type) {
                $notDeletableProducts = [];
                if ($offer_products && count($offer_products)) {
                    foreach ($offer_products as $offer_product) {
                        $product = StockOfferProducts::where('stock_id', $offer_product)
                            ->where('offer_id', $stock->id)->first();
                        if (!$product) {
                            StockOfferProducts::create([
                                'stock_id' => $offer_product,
                                'offer_id' => $stock->id,
                            ]);
                        }
                        $notDeletableProducts[] = $offer_product;
                    }
                }

                StockOfferProducts::where('offer_id', $stock->id)->whereNotIn('stock_id', $notDeletableProducts)->delete();
                $stock->offers()->detach();
            } else {
                $categories = json_decode($request->get('offers', []), true);
                $stock->offers()->sync($categories);

                StockOfferProducts::where('offer_id', $stock->id)->delete();
            }

        } else {
            $categories = json_decode($request->get('categories', []), true);
            $stock->categories()->sync($categories);
            $stock->special_offers()->sync($offer_products);
        }

        $special_filters = $request->get('special_filters', []);
        $stock->special_filters()->sync($special_filters);

        $stock->related_products()->sync($request->get('related_products'));

        $stock->stickers()->detach();
        $stickers = $request->get('stickers', []);
        if (count($stickers)) {
            foreach ($stickers as $sticker) {
                $stock->stickers()->attach($sticker['id'], [
                    'ordering' => $sticker['ordering']
                ]);
            }
        }
//        $this->createOrUpdateSeo($request, $stock->id);

        ActivityLogs::action('items', (($request->id) ? 'update' : 'create'), $stock->id);
//
        return redirect()->route('admin_stock_edit',$stock->id);
    }

    public function delete(Request $request)
    {
        $stock = Stock::findOrFail($request->slug);
        $stock->delete();

        return response()->json(['error' => false]);
    }

    public function offerNew()
    {
        $model = null;
        $offer = true;
        $brands = Category::with('children')->where('type', 'brands')->whereNull('parent_id')->get();
        $offers = Category::with('children')->where('type', 'offers')->whereNull('parent_id')->get();
        $dataOffers = Category::recursiveItems($offers);
        $special_filters = Category::with('children')->where('type', 'special_filter')->whereNull('parent_id')->get();

        $general = $this->settings->getEditableData('seo_stocks')->toArray();
        $twitterSeo = $this->settings->getEditableData('seo_twitter_stocks')->toArray();
        $fbSeo = $this->settings->getEditableData('seo_fb_stocks')->toArray();
        $robot = $this->settings->getEditableData('seo_robot_stocks');

        return $this->view('stock_new', compact(['model', 'brands', 'general', 'offers', 'dataOffers',
            'twitterSeo', 'fbSeo', 'robot', 'offer', 'special_filters']));
    }

    public function getOfferEdit($id)
    {
        $model = Stock::findOrFail($id);
        $offer = true;
        $variations = collect($model->variations()->where('is_required', true)->get())->groupBy('variation_id');

        $brands = Category::with('children')->where('type', 'brands')->whereNull('parent_id')->get();
        $offers = Category::with('children')->where('type', 'offers')->whereNull('parent_id')->get();
        $checkedOffers = $model->offers()->pluck('id')->all();
        $dataOffers = Category::recursiveItems($offers, 0, [], $checkedOffers);
        $special_filters = Category::with('children')->where('type', 'special_filter')->whereNull('parent_id')->get();

        $filters = Category::where('type', 'filter')->whereNull('parent_id')->get()->pluck('name', 'id')->all();
        $allAttrs = Attributes::with('children')->whereNull('parent_id')->get();
        $stockItems = Items::active()->get()->pluck('name', 'id')->all();

        $general = $this->settings->getEditableData('seo_stocks')->toArray();
        $twitterSeo = $this->settings->getEditableData('seo_twitter_stocks')->toArray();
        $fbSeo = $this->settings->getEditableData('seo_fb_stocks')->toArray();
        $robot = $this->settings->getEditableData('seo_robot_stocks');

        return $this->view('stock_new', compact(['model', 'variations', 'brands', 'offers', 'dataOffers', 'offer', 'checkedOffers',
            'filters', 'stockItems', 'special_filters',
            'general', 'allAttrs', 'twitterSeo', 'fbSeo', 'robot']));
    }

    public function postStockCopy(Request $request)
    {
        $id=$request->get('id');
        $stock=Stock::findOrFail($id);
        $stock->duplicate();
        return response()->json(['error'=>false]);
    }


    private function createOrUpdateSeo($request, $stock_id)
    {
        $types = $request->only(['fb', 'general', 'twitter', 'robot']);
        foreach ($types as $type => $data) {
            foreach ($data as $name => $value) {
                $seo = StockSeo::firstOrNew(['stock_id' => $stock_id, 'name' => $name, 'type' => $type]);
                if ($value) {
                    $seo->content = $value;
                    $seo->save();
                } else {
                    $seo->delete();
                }
            }
        }
    }


    public function linkAll($data)
    {
        $results = [];
        if ($data && count($data)) {
            $firstKeyArray = array_first($data);
            array_shift($data);
            foreach ($data as $i => $v) {
                $notFullCount = count($firstKeyArray);
                foreach ($firstKeyArray as $phrase) {
                    foreach ($data[$i] as $newPart) {
                        $firstKeyArray[] = $phrase . "-" . $newPart;
                    }
                }
                $firstKeyArray = array_slice($firstKeyArray, $notFullCount);
            }


            if (count($firstKeyArray)) {
                foreach ($firstKeyArray as $string) {
                    $results[] = explode('-', $string);
                }
            }
        }

        return $results;
    }

    public function variationForm(Request $request)
    {
        $data = $request->get('data');
        $model = null;
        $html = \View('admin.inventory._partials.variation_form', compact(['model', 'data']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function addVariation(Request $request)
    {
        $item = $request->except('_token');
        $stockItems = Items::active()->get()->pluck('sku', 'sku')->all();
        $html = \View('admin.inventory._partials.variation_item', compact(['item', 'stockItems']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function addPackageVariation(Request $request)
    {
        $items = Items::active()->whereIn('id', $request->items)->get();
        $main_unique = $request->get('main_unique');
        $stockItems = Items::all()->pluck('name', 'id')->all();
        $stock = Stock::find($request->get('stockID'));
        $package_variation = null;
        $main = null;
        $html = \View("admin.items._partials.variation_package_item", compact(['package_variation', 'stockItems', 'main_unique', 'main', 'items','stock']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function duplicatePackageOptions(Request $request)
    {
        $stockItems = Items::active()->get()->pluck('name', 'id')->all();
        $package_variation = null;
        $model = null;
        $html = \View('admin.stock._partials.package_item', compact(['model', 'package_variation', 'stockItems']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function duplicateVOptions(Request $request)
    {
        $stockItems = Items::active()->get()->pluck('name', 'id')->all();
        $package_variation = null;
        $model = null;
        $required = $request->required;
        $filters = Category::where('type', 'filter')->whereNull('parent_id')->get()->pluck('name', 'id')->all();

        $html = \View('admin.stock._partials.variation', compact(['model', 'package_variation', 'stockItems', 'filters', 'required']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function editVariation(Request $request)
    {
        $data = $request->get('data');
        $model = $request->get('model');
        $variationId = $request->get('variationId');
        $html = \View('admin.inventory._partials.variation_form', compact(['model', 'data', 'variationId']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function getOptionById(Request $request)
    {
        $selected = Attributes::find($request->id);
        $allAttrs = Attributes::with('stickers')->whereNull('parent_id')->get();
        $html = \View("admin.inventory._partials.variation_option_item", compact(['selected', 'allAttrs']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function getSpecification(Request $request)
    {
        $selected = Attributes::find($request->id);
        $allAttrs = Attributes::with('stickers')->whereNull('parent_id')->get();
        $html = \View("admin.inventory._partials.specifications", compact(['selected', 'allAttrs']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postRenderVariationNewOptions(Request $request)
    {
        $attributesJson = $request->get('attributesJson');
        $objData = $request->get('objData');
        $variation = $request->get('variation');
        $html = \View("admin.inventory._partials.variation_item_render_new_options", compact(['attributesJson', 'objData', 'variation']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function getById(Request $request)
    {
        $model = Stock::findOrFail($request->id);

        return \Response::json(['error' => false, 'data' => $model]);
    }

    public function getVariationsById(Request $request)
    {
        $model = Stock::find($request->id);

        if (!$model) return \Response::json(['error' => true, 'message' => 'Not found']);

        return \Response::json(['error' => false, 'data' => $model->variations]);
    }

    public function addExtraOption(Request $request)
    {
        $option = $request->except('_token');
        $html = \View("admin.inventory._partials.extra_item", compact(['option']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function saveExtraOptions(Request $request)
    {
        return \Response::json(['error' => false, 'data' => json_encode($request->data, true)]);
    }

    public function getStocks(Request $request)
    {
        $promotion = ($request->get("promotion")) ? true : false;
        $attr = Stock::join('stock_translations','stock_translations.stock_id','stocks.id')
            ->where('locale',app()->getLocale())
            ->where('stocks.is_offer', false)->whereNotIn('stocks.id', $request->get('arr', []))
            ->with('brand')
            ->with('categories')
            ->select('stocks.id','stocks.brand_id','stock_translations.name')
            ->get();
        $brands=Brands::all();
        $categories=Category::where('type','stocks')->get();

        return \Response::json(['error' => false, 'data' => $attr,'brands'=>$brands,'categories'=>$categories]);
    }

    public function getSpecialOffers(Request $request)
    {
        $promotion = ($request->get("promotion")) ? true : false;
        $attr = Stock::where('is_offer', true)->where('offer_type', true)->whereNotIn('id', $request->get('arr', []))->get();

        return \Response::json(['error' => false, 'data' => $attr]);
    }

    public function addSpecialOffers(Request $request)
    {
        $error = true;
        $html = '';
        $offer = Stock::where('is_offer', true)->where('offer_type', true)->where('id', $request->get('id'))->first();
        if ($offer) {
            $error = false;
            $html = view("admin.stock._partials.special_offer_item", compact(['offer']))->render();
        }
        return \Response::json(['error' => $error, 'html' => $html]);
    }

    public function postItemByID(Request $request)
    {
        $item = Items::active()->findOrFail($request->id);

        return \Response::json(['error' => false, 'data' => $item]);
    }

    public function postSelectItems(Request $request)
    {
        $items = Items::whereNotIn('id', $request->get('items', []))->where('status', Items::ACTIVE)->where('is_archive', false)->get();
        $uniqueId = $request->get('uniqueId');
        $stickers = array_filter(Stickers::all()->pluck('name', 'id')->all());

        $html = \view("admin.stock._partials.select_items", compact(['items', 'uniqueId', 'stickers']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postSearchItems(Request $request)
    {
        $items = Items::leftJoin('item_specifications', 'items.id', 'item_specifications.item_id')
            ->whereNotIn('items.id', $request->get('items', []))
            ->whereIn('item_specifications.sticker_id', $request->get('stickers', []))
            ->where('status', Items::ACTIVE)
            ->select('items.*')->get();
//        $items = Items::whereNotIn('id', $request->get('items', []))->get();

        $html = \view("admin.stock._partials.items_render", compact(['items']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postFilterItems(Request $request)
    {
        $category = Filters::with(['children', 'items'])
            ->whereNotNull('category_id')->where('category_id', $request->get('id', 0))->get();
//        var_dump($category);exit;
        $x = Filters::getRecursiveItems($category, 0);
        $items = collect($x)->unique('id');

        $main_unique = $request->get('uniqueId');
        $stockItems = Items::active()->get()->pluck('name', 'id')->all();
        $main = null;
        $package_variation = null;

        $html = \view("admin.items._partials.variation_package_item", compact(['items', 'main_unique', 'stockItems', 'main', 'package_variation']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postVariationOptionsView(Request $request)
    {
        $stockItems = Items::active()->get()->pluck('name', 'id')->all();
        $main_unique = $request->get('uniqueId');
        $main = null;
        $html = '';
        if ($request->type == 'single') {
            $html = \view("admin.stock._partials.simple_item", compact(['stockItems', 'main_unique', 'main']))->render();
        } elseif ($request->type == 'package_product') {
            $html = \view("admin.stock._partials.package_item", compact(['stockItems', 'main_unique', 'main']))->render();
        } elseif ($request->type == 'filter') {
            $html = \view("admin.stock._partials.filter_item", compact(['stockItems', 'main_unique', 'main']))->render();
        }elseif ($request->type == 'filter_discount') {
            $html = \view("admin.stock._partials.filter_discount", compact(['stockItems', 'main_unique', 'main']))->render();
        }


        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postSpecificationByCategory(Request $request)
    {
        $html = '';
        $existingCategories = [];
        $data = Attributes::leftJoin('attributes_translations', 'attributes.id', '=', 'attributes_translations.attributes_id')
            ->leftJoin('attribute_categories', 'attributes.id', '=', 'attribute_categories.attribute_id')
            ->where('attribute_categories.categories_id', $request->id);
        if ($request->selected == "true") {
            $data = $data->whereNotIn('attributes.id', $request->get('attrs', []));
        }
        $data = $data->where('attributes_translations.locale', app()->getLocale())
            ->select('attributes.*', 'attributes_translations.name')->get();
//            dd($data->pluck('id','id')->all());
        if ($request->selected == "true") {
            $allAttrs = Attributes::with('children')->whereNull('parent_id')->get();
            $html = View("admin.inventory._partials.loop_specifications", compact(['data', 'allAttrs']))->with('by_category', true)->render();
        } else {
            $existingCategories = $this->getCategoriesAttrs($request->categories, $request->id)->pluck('id', 'id')->all();
        }

        return \Response::json(['error' => false, 'data' => $data->pluck('id', 'id')->all(), 'existingAttributes' => $existingCategories, 'html' => $html]);
    }

    public function getCategoriesAttrs($categories, $id)
    {
        $categories = json_decode($categories, true);
        $categoryData = [];
        if (count($categories)) {
            foreach ($categories as $category) {
                if ($category != $id) {
                    $categoryData[] = $category;
                }
            }
        }
        $data = Attributes::leftJoin('attributes_translations', 'attributes.id', '=', 'attributes_translations.attributes_id')
            ->leftJoin('attribute_categories', 'attributes.id', '=', 'attribute_categories.attribute_id')
            ->whereIn('attribute_categories.categories_id', $categoryData)
            ->where('attributes_translations.locale', app()->getLocale())
            ->select('attributes.*', 'attributes_translations.name', 'attribute_categories.categories_id as CATEGORY')->get();

        return $data;
    }

    public function applyDiscount(Request $request)
    {
        $type = $request->discount_type;
        $main_unique = $request->main;
        $uniqueID = $request->group;
        $data = $request->get('discount');

        $html = view("admin.stock._partials.discount_data", compact(['data', 'type', 'main_unique', 'uniqueID']))->render();

        return response()->json(['error' => false, 'html' => $html]);
    }

    public function mainItem(Request $request)
    {
        $data = $request->get('items', []);

        $items = Items::whereIn('id', $data)->get()->pluck('name', 'id')->all();

        $html = view("admin.stock._partials.main_items", compact(['items']))->render();

        return response()->json(['error' => false, 'html' => $html]);
    }

    public function postItemRowEdit(Request $request)
    {
        $model = Stock::findOrFail($request->id);
        $categories = Category::where('type', 'stocks')->get()->pluck('name', 'id')->all();
        $brands = Category::where('type', 'brands')->whereNull('parent_id')->get()->pluck('name', 'id')->all();
        $barcodes = Barcodes::all()->pluck('code', 'id');

        $html = \View::make("admin.stock._partials.edit_row", compact(['model', 'categories', 'brands', 'barcodes']))->render();

        return response()->json(['error' => false, 'html' => $html]);
    }

    public function postMultyDelete(Request $request)
    {
        $idS = $request->get('idS');
        Stock::whereIn('id', $idS)->delete();
        foreach ($idS as $id){
            ActivityLogs::action('stock', 'delete',$id);
        }

        return response()->json(['error' => false]);
    }

    public function postItemRowEditSave(Request $request)
    {
        $model = Stock::findOrFail($request->id);

        Stock::updateOrCreate($request->id, $request->except(['name', '_token', 'categories', 'short_description']), ['gb' => [
            'name' => $request->name,
            'short_description' => $request->short_description,
        ]]);
        ActivityLogs::action('stock', 'update', $model->id);
        $model->categories()->sync($request->get('categories', []));

        return response()->json(['error' => false]);
    }

    public function postItemRowsEdit($ids)
    {
        $ids = explode(',', $ids);
        $items = Stock::findMany($ids);
        $categories = Category::where('type', 'stocks')->get()->pluck('name', 'id')->all();
        $brands = Category::where('type', 'brands')->whereNull('parent_id')->get()->pluck('name', 'id')->all();
        $barcodes = Barcodes::all()->pluck('code', 'id');

        return $this->view('rows_edit', compact(['items', 'categories', 'brands', 'barcodes']));
    }

    public function postItemRowsEditSave(Request $request)
    {
        $items = $request->get('items', []);
        if (count($items)) {
            foreach ($items as $id => $item) {
                $model = Stock::findOrFail($id);
                Stock::updateOrCreate($id, array_except($item, ['name', 'categories', 'short_description']), ['gb' => [
                    'name' => $item['name'],
                    'short_description' => $item['short_description']
                ]]);
                $cat = (count($item['categories'])) ? $item['categories'] : [];
                $model->categories()->sync($cat);
                ActivityLogs::action('stock', 'update', $model->id);
            }
            return response()->json(['error' => false]);
        }
        return response()->json(['error' => true]);
    }

    public function stockSettings()
    {
        return $this->view('settings');
    }

    public function stockCategories($type)
    {
        $categories = Category::whereNull('parent_id')->where('type', $type)->get();
        $allCategories = Category::where('type', $type)->get();
        enableMedia('drive');
        return $this->view('categories', compact('categories','allCategories','type'));
    }

}
