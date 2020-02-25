<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\ReviewStatusTypes;
use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\AttributeStickers;
use App\Models\Category;
use App\Models\Items;
use App\Models\Posts;
use App\Models\Products;
use App\Models\Review;
use App\Models\Settings;
use App\Models\Stickers;
use App\Models\Stock;
use App\Models\StockVariation;
use App\Models\StockVariationDiscount;
use App\Models\StockVariationOption;
use App\ProductSearch\ProductSearch;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use View;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $view = 'frontend.products';

    public $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function index(Request $request, $type = null)
    {
        $category = Category::where('type', 'stocks')
            ->where('status',true)->whereNull('parent_id')->where('slug', $type)->first();
        if (!$category && $type != null) abort(404);

        $categories = Category::with('children')
            ->where('status',true)->where('type', 'stocks')->whereNull('parent_id')->get()->pluck('name', 'slug');
        $products = ProductSearch::apply($request, $category);
//        $products = ProductSearch::apply($request,$category,true);
//        dd($products);
        $filters = (new Attributes)->getFiltersByCategory($type);

        $data = $request->except('_token');
        $sc = $request->get('subcategory','all');
        $selecteds = [];
        $selectedBrands = [];
        if (isset($data['select_filter']) && count($data['select_filter'])) {
            foreach ($data['select_filter'] as $k => $v) {
                if ($v && is_array($v)) {
                    foreach ($v as $key => $value) {
                        $attr = Attributes::getById($key);
                        $sticker = Stickers::getById($value);
                        $selecteds[$k . "," . $value] = $sticker;
                    }
                } elseif ($v) {
                    $sticker = Stickers::getById($v);
                    $attr = Attributes::getById($k);
                    $selecteds[$k] = $sticker;
                }
            }
        }

        if(isset($data['brands']) && count($data['brands'])){
            foreach ($data['brands'] as $k => $v) {
                $cat = Category::find($v);
                if($cat){
                    $selectedBrands[$v] = $cat->name;
                }
            }
        }

        if($request->ajax()){
            $html = View('frontend.products._partials.products_render',compact(['products','selectedBrands','selecteds','category']))->with('all_products',true)->render();
           return response()->json(['error' => false, 'html' => $html]);
        }
        return $this->view('index', compact('categories', 'category', 'products', 'filters', 'selecteds', 'type','selectedBrands','sc'))->with('filterModel', $request->all());
    }

    public function getSingle($type, $slug)
    {
//        Cart::clear();
//        $x = Cart::getContent();
        enableFilter();
        $vape = Stock::with(['variations', 'stockAttrs','translations'])->whereTranslation('slug', $slug)->first();
        if (!$vape) abort(404);

        if ($vape->is_offer) abort(404);

        $variations = $vape->variations()->required()->with('options')->get();

        $ads = $this->settings->getEditableData('single_product');
        if($ads && isset($ads['data'])){
            $ads = json_decode($ads['data'],true);
        }
        $reviews = Review::whereIn('item_id',$vape->variations()->pluck('item_id','item_id')->all())->where('status',ReviewStatusTypes::PUBLISHED)->latest()->get();
        return $this->view('single', compact(['vape', 'variations', 'type','ads','reviews']));
    }

    public function getPrice(Request $request)
    {
        $stock = Stock::find($request->uid);
        $attributes = [];
        $options = [];
        $totalCount = 0;
        $subTotal = null;
        if (is_array($request->options)) {
            $attributes = array_keys($request->options);
            $options = array_values($request->options);
            $totalCount = count($request->options);
        }

        if ($stock) {
            $variation = null;
            if ($stock->type == 'variation_product') {
                $option = StockVariationOption::select('stock_variation_options.*', \DB::raw('count(*) as total'))
                    ->leftJoin('attributes_stickers', 'stock_variation_options.attribute_sticker_id', 'attributes_stickers.id')
                    ->whereIn('attributes_stickers.attributes_id', $attributes)
                    ->whereIn('attributes_stickers.sticker_id', $options)
                    ->whereIn('variation_id', $stock->variations()->pluck('id')->all())
                    ->groupBy('variation_id')
                    ->having('total', $totalCount)
                    ->orderBy('total', 'desc')->first();
                $variation = ($option && $option->variation) ? $option->variation : null;
            } elseif ($stock->type == 'simple_product') {
                $variation = $stock->variations->first();
            } elseif ($stock->type == 'package_product') {
                $variation = $stock->variations->first();
            }
            if ($variation) {
                $price = $variation->price;

                if ($request->promotion) {
                    $main = Stock::find($request->stock_id);
                    $promotionPrice = ($main) ? $main->promotion_prices()->where('variation_id', $variation->id)->first() : null;
                    $price = ($promotionPrice) ? $promotionPrice->price : $price;
                } elseif (count($stock->active_sales)) {
                    $promotionPrice = $stock->active_sales()->where('variation_id', $variation->id)->first();
                    $price = ($promotionPrice) ? $promotionPrice->price : $price;
                }
                $isFavorite = false;

                if (\Auth::check()) {
                    $isFavorite = \Auth::user()->favorites()->where('favorites.variation_id', $variation->id)->exists();
                }

                if (!$request->promotion) {
//                    $requriedItems = $stock->promotions()->where('type',true)->pluck('variation_id');
                }

                if ($variation->qty > 0) {
                    return \Response::json(['price' => convert_price($price, get_currency()), 'variation_id' => $variation->id, 'error' => false, 'isFavorite' => $isFavorite]);
                } else {
                    return \Response::json(['message' => 'Out of stock', 'price' => convert_price($price, get_currency()), 'variation_id' => $variation->id, 'error' => false, 'isFavorite' => $isFavorite]);
                }
            }
        }

        return \Response::json(['message' => 'See available options', 'error' => true]);
    }

    public function getPackageTypeLimit(Request $request)
    {
        $variation = StockVariation::findOrFail($request->id);
        return response()->json(['error' => false, 'limit' => $variation->count_limit]);

    }

    public function getSubtotalPrice(Request $request)
    {
        $variation = StockVariation::find($request->uid);




        if ($variation) {
            $promotionPrice = $variation->stock->active_sales()->where('variation_id', $variation->id)->first();
            $price = ($promotionPrice) ? $promotionPrice->price : $variation->price;
            $optionalItems = $request->get('optionalItems');
            if ($optionalItems && count($optionalItems)) {
                foreach ($optionalItems as $opv) {
                    $optpVariation = StockVariation::find($opv);
                    if ($optpVariation) {
                        $promotionPrice = $variation->stock->promotion_prices()->where('variation_id', $optpVariation->id)->first();
                        $reqPrice = ($promotionPrice) ? $promotionPrice->price : $optpVariation->price;
                        $price += $reqPrice;
                    }
                }
            }
            $requiredItems = $request->get('requiredItems');
            if ($requiredItems && count($requiredItems)) {
                foreach ($requiredItems as $opv) {
                    $optpVariation = StockVariation::find($opv);
                    if ($optpVariation) {
                        $promotionPrice = $variation->stock->promotion_prices()->where('variation_id', $optpVariation->id)->first();
                        $reqPrice = ($promotionPrice) ? $promotionPrice->price : $optpVariation->price;
                        $price += $reqPrice;
                    }
                }
            }

            return \Response::json(['price' => convert_price($price, get_currency()), 'error' => false]);
        }

        return \Response::json(['message' => 'See available options', 'error' => true]);
    }


    public function getVariations(Request $request)
    {
        $model = Stock::with(['variations', 'stockAttrs'])->find($request->id);
        if (!$model) return \Response::json(['error' => true]);
        $html = \View('frontend.products._partials.add_to_card_modal_content', compact(['model']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function getVariationMenuRaw(Request $request)
    {
        $id = $request->get("id",null);
        if($id){
            $variation = StockVariation::where('variation_id',$id)->get();
            $selected = $vSettings = $variation->first();
            $html = \view("frontend.products._partials.stock_variation_option_box", compact(['variation', 'selected','vSettings']))->render();
        }else{
            $selected = StockVariation::findOrFail($request->select_element_id);
            $variation = $selected->stock->variations()->where('variation_id',$selected->variation_id)->get();
            $vSettings = $variation->first();
            $html = \view("frontend.products._partials.stock_variation_option", compact(['variation', 'selected','vSettings']))->render();
        }


        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function getOfferMenuRaw(Request $request)
    {
        $id = $request->get("id",null);
        if($id){
            $variation = StockVariation::where('variation_id',$id)->get();
            $selected = $vSettings = $variation->first();
            $html = \view("frontend.products._partials.offer_option_box", compact(['variation', 'selected','vSettings']))->render();
        }else{
            $selected = StockVariation::findOrFail($request->select_element_id);
            $variation = $selected->stock->variations()->where('variation_id',$selected->variation_id)->get();
            $vSettings = $variation->first();
            $html = \view("frontend.products._partials.offer_option", compact(['variation', 'selected','vSettings']))->render();
        }


        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function getVariationMenuRaws(Request $request)
    {
        $variations = StockVariation::whereIn('id', $request->get('ids', []))->get();
        $vSettings = $variations->first();
        $html = \view("frontend.products._partials.render_variations", compact(['variations', 'vSettings']))->render();

        return \Response::json(['error' => false, 'html' => $html, 'items' => $request->get('items', [])]);
    }

    public function getOfferMenuRaws(Request $request)
    {
        $variations = StockVariation::whereIn('id', $request->get('ids', []))->get();
        $vSettings = $variations->first();
        $html = \view("frontend.products._partials.render_offers", compact(['variations', 'vSettings']))->render();

        return \Response::json(['error' => false, 'html' => $html, 'items' => $request->get('items', [])]);
    }

    public function postSelectItems(Request $request)
    {
        $items = StockVariation::where('variation_id', $request->group)->whereNotIn('id',$request->get('ids',[]))->get();
        if (count($items)) {
            $stickers = [];
            $vSettings = $items->first();
            $html = \view("frontend.products._partials.select_popup_items", compact(['items', 'stickers', 'vSettings']))->render();

            return \Response::json(['error' => false, 'html' => $html]);
        }
        return \Response::json(['error' => false, 'message' => "No options for select"]);

    }

    public function postSearchItems(Request $request)
    {
        $items = Items::leftJoin('item_specifications', 'items.id', 'item_specifications.item_id')
            ->whereNotIn('items.id', $request->get('items', []))
            ->whereIn('item_specifications.sticker_id', $request->get('stickers', []))
            ->where('status', Items::ACTIVE)
            ->select('items.*')->get();

        $html = \view("admin.stock._partials.items_render", compact(['items']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postExtraContent(Request $request)
    {
        $product = Stock::findOrFail($request->id);
        $variations = $product->variations()->extra()->with('options')->get();
        $html = \view("frontend.products._partials.extra_modal_content", compact(['variations', 'product']))->render();

        return response()->json(['error' => false, 'html' => $html]);
    }

    public function postExtraItem(Request $request)
    {
        $product = Stock::findOrFail($request->id);
        $variation = $product->variations()->extra()->where('variation_id', $request->group)->get();
        $vSettings = $variation->first();
        $html = \view("frontend.products._partials.extra_section", compact(['vSettings', 'variation']))->with('vape', $product)->render();

        return response()->json(['error' => false, 'html' => $html, 'type' => $vSettings->display_as]);
    }

    public function getDiscountPrice(Request $request)
    {
        $qty = $request->get('qty');
        $discount_id = $request->get('discount_id');
        if($qty != null){
            $variation = StockVariation::findOrFail($request->variation_id);
            $discount = $variation->discounts()->where('from','<=',$qty)->where('to','>=',$qty)->first();

            if($discount){
                $price = $discount->price * $qty;
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                    $price = number_format($price);
                } else {
                    $price = money_format('%(#10n',$price);
                }
                return response()->json(['error' => false,'price' => $price]);
            }
        }elseif($discount_id != null){
            $discount = StockVariationDiscount::findOrFail($discount_id);
            if($discount){
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                    $price = number_format($discount->price);
                } else {
                    $price = money_format('%(#10n',$discount->price);
                }
                return response()->json(['error' => false,'price' => $price]);
            }
        }

        return response()->json(['error' => true]);
    }

    public function addOffer(Request $request)
    {
        $offer = Stock::findOrFail($request->id);
        $price = $request->price;
        $html = view("frontend.products._partials.add_offer",compact(['offer','price']))->render();

        return response()->json(['error' => false,'html' => $html]);
    }
}
