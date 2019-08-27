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
use App\Models\Attributes;
use App\Models\Category;
use App\Models\Filters;
use App\Models\Items;
use App\Models\Settings;
use App\Models\Stickers;
use App\Models\Stock;
use App\Models\StockAttribute;
use App\Models\StockOfferProducts;
use App\Models\StockSales;
use App\Models\StockSeo;
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

        $data = Category::recursiveItems($categories);
        $dataOffers = Category::recursiveItems($offers);

        $allAttrs = Attributes::with('children')->whereNull('parent_id')->get();
        $stockItems = Items::active()->get()->pluck('name', 'id')->all();
        $filters = Category::where('type', 'filter')->whereNull('parent_id')->get()->pluck('name', 'id')->all();

        $general = $this->settings->getEditableData('seo_stocks')->toArray();
        $twitterSeo = $this->settings->getEditableData('seo_twitter_stocks')->toArray();
        $fbSeo = $this->settings->getEditableData('seo_fb_stocks')->toArray();
        $robot = $this->settings->getEditableData('seo_robot_stocks');

        return $this->view('stock_new', compact(['model', 'data', 'brands', 'categories', 'general', 'allAttrs','offers','dataOffers',
            'twitterSeo', 'fbSeo', 'robot', 'stockItems', 'filters']));
    }

    public function getStockEdit($id)
    {
        $model = Stock::findOrFail($id);
        $variations = collect($model->variations()->where('is_required', true)->get())->groupBy('variation_id');
        $extraVariations = collect($model->variations()->where('is_required', false)->get())->groupBy('variation_id');

        $categories = Category::with('children')->where('type', 'stocks')->whereNull('parent_id')->get();
        $brands = Category::with('children')->where('type', 'brands')->whereNull('parent_id')->get();
        $offers = Category::with('children')->where('type', 'offers')->whereNull('parent_id')->get();
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

        return $this->view('stock_new', compact(['model', 'variations', 'extraVariations', 'brands','offers','dataOffers',
            'checkedCategories', 'categories', 'allAttrs', 'general', 'stockItems', 'twitterSeo', 'fbSeo', 'robot', 'data', 'filters']));
    }

    public function postStock(ProductsRequest $request)
    {
        $data = $request->except('_token', 'translatable', 'options', 'promotions', 'specifications','offer_products',
            'variations', 'variation_single', 'package_variation_price', 'package_variation_count_limit', 'package_variation',
            'extra_product', 'promotion_prices', 'promotion_type','categories', 'offers', 'general', 'related_products',
            'stickers', 'fb', 'twitter', 'general', 'robot', 'type_attributes', 'type_attributes_options', 'ads');
        $data['user_id'] = \Auth::id();
        $data['price'] = ($data['price']) ?? 0;
        $stock = Stock::updateOrCreate($request->id, $data);

        $this->stockService->savePackageVariation($stock, $request->get('variations', []));

        $this->stockService->makeTypeOptions($stock, $request->get('type_attributes', []));
        $stock->specifications()->sync($request->get('specifications'));
        $options = $this->stockService->makeOptions($stock, $request->get('options', []));
//        dd($options);
        if($options && count($options)){
            foreach ($options as $option){
                StockAttribute::create([
                    'attributes_id' => $option['attributes_id'],
                    'sticker_id' => $option['sticker_id'],
                    'parent_id' => $option['parent_id'],
                    'stock_id' => $stock->id,
                ]);
            }
        }

        $offer_products = $request->get('offer_products',[]);

        if($stock->is_offer){
            if($stock->offer_type){
                $notDeletableProducts = [];
                if($offer_products && count($offer_products)){
                    foreach ($offer_products as $offer_product){
                        $product = StockOfferProducts::where('stock_id',$offer_product)
                        ->where('offer_id',$stock->id)->first();
                        if(! $product){
                            StockOfferProducts::create([
                               'stock_id' =>  $offer_product,
                               'offer_id' =>  $stock->id,
                            ]);
                        }
                        $notDeletableProducts[] = $offer_product;
                    }
                }

                StockOfferProducts::where('offer_id',$stock->id)->whereNotIn('stock_id',$notDeletableProducts)->delete();
                $stock->offers()->detach();
            }else{
                $categories = json_decode($request->get('offers', []), true);
                $stock->offers()->sync($categories);

                StockOfferProducts::where('offer_id',$stock->id)->delete();
            }

        }else{
            $categories = json_decode($request->get('categories', []), true);
            $stock->categories()->sync($categories);
            $stock->special_offers()->sync($offer_products);
        }

        $stock->related_products()->sync($request->get('related_products'));
        $stock->stickers()->sync($request->get('stickers'));
        $this->createOrUpdateSeo($request, $stock->id);

        return redirect()->back();
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

        $general = $this->settings->getEditableData('seo_stocks')->toArray();
        $twitterSeo = $this->settings->getEditableData('seo_twitter_stocks')->toArray();
        $fbSeo = $this->settings->getEditableData('seo_fb_stocks')->toArray();
        $robot = $this->settings->getEditableData('seo_robot_stocks');

        return $this->view('stock_new', compact(['model','brands', 'general','offers','dataOffers',
            'twitterSeo', 'fbSeo', 'robot','offer']));
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

        $filters = Category::where('type', 'filter')->whereNull('parent_id')->get()->pluck('name', 'id')->all();
        $allAttrs = Attributes::with('children')->whereNull('parent_id')->get();
        $stockItems = Items::active()->get()->pluck('name', 'id')->all();

        $general = $this->settings->getEditableData('seo_stocks')->toArray();
        $twitterSeo = $this->settings->getEditableData('seo_twitter_stocks')->toArray();
        $fbSeo = $this->settings->getEditableData('seo_fb_stocks')->toArray();
        $robot = $this->settings->getEditableData('seo_robot_stocks');
//dd($model->offer_products);

        return $this->view('stock_new', compact(['model', 'variations','brands','offers','dataOffers','offer','checkedOffers',
            'filters','stockItems',
            'general', 'allAttrs', 'twitterSeo', 'fbSeo', 'robot']));
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
        $package_variation = null;
        $main = null;
        $html = \View("admin.items._partials.variation_package_item", compact(['package_variation', 'stockItems', 'main_unique', 'main', 'items']))->render();

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
        $attr = Stock::where('is_offer',false)->whereNotIn('id', $request->get('arr', []))->get();

        return \Response::json(['error' => false, 'data' => $attr]);
    }

    public function getSpecialOffers(Request $request)
    {
        $promotion = ($request->get("promotion")) ? true : false;
        $attr = Stock::where('is_offer',true)->where('offer_type',true)->whereNotIn('id', $request->get('arr', []))->get();

        return \Response::json(['error' => false, 'data' => $attr]);
    }

    public function addSpecialOffers(Request $request)
    {
        $error = true;
        $html = '';
        $offer = Stock::where('is_offer',true)->where('offer_type',true)->where('id', $request->get('id'))->first();
        if($offer){
            $error = false;
            $html = view("admin.stock._partials.special_offer_item",compact(['offer']))->render();
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
        $items = Items::whereNotIn('id', $request->get('items', []))->where('status', Items::ACTIVE)->get();
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
        $category = Filters::with(['children', 'items'])->whereNotNull('category_id')->where('category_id', $request->get('id', 0))->get();
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

        $html = view("admin.stock._partials.discount_data",compact(['data','type','main_unique','uniqueID']))->render();

        return response()->json(['error' => false,'html' => $html]);
    }
}
