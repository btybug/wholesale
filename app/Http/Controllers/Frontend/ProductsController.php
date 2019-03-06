<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\AttributeStickers;
use App\Models\Category;
use App\Models\Posts;
use App\Models\Products;
use App\Models\Stickers;
use App\Models\Stock;
use App\Models\StockVariation;
use App\Models\StockVariationOption;
use App\ProductSearch\ProductSearch;
use View;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $view = 'frontend.products';

    public function index (Request $request,$type = null)
    {
        $category = Category::where('type','stocks')->whereNull('parent_id')->where('slug',$type)->first();
        if(! $category && $type != null) abort(404);

        $categories = Category::with('children')->where('type', 'stocks')->whereNull('parent_id')->get()->pluck('name','slug');
        $products = ProductSearch::apply($request,$category);
//        $products = ProductSearch::apply($request,$category,true);
//        dd($products);
        $filters = Attributes::where('filter',true)->get();

        $data =  $request->except('_token');
        $selecteds = [];
        if(isset($data['select_filter']) && count($data['select_filter'])){
            foreach ($data['select_filter'] as $k => $v){
                if($v && is_array($v)){
                    foreach ($v as $key => $value){
                        $attr = Attributes::getById($key);
                        $sticker = Stickers::getById($value);
                        $selecteds[$k.",".$value] = $sticker;
                    }
                }elseif ($v){
                    $sticker = Stickers::getById($v);
                    $attr = Attributes::getById($k);
                    $selecteds[$k] = $sticker;
                }
            }
        }

        return $this->view('index', compact('categories','category','products','filters','selecteds','type'))->with('filterModel',$request->all());
    }

    public function getSingle ($type, $slug)
    {
        $vape = Stock::with(['variations', 'stockAttrs'])->where('slug', $slug)->first();
        if (! $vape) abort(404);

        $variations = $vape->variations()->with('options')->get();

        return $this->view('single', compact(['vape', 'variations', 'type']));
    }

    public function getPrice (Request $request)
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
                    ->leftJoin('attributes_stickers','stock_variation_options.attribute_sticker_id','attributes_stickers.id')
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
                    $promotionPrice = ($main) ?$main->promotion_prices()->where('variation_id', $variation->id)->first():null;
                    $price = ($promotionPrice) ? $promotionPrice->price : $price;
                } elseif(count($stock->active_sales)) {
                    $promotionPrice = $stock->active_sales()->where('variation_id', $variation->id)->first();
                    $price = ($promotionPrice) ? $promotionPrice->price : $price;
                }
                $isFavorite = false;

                if(\Auth::check()) {
                    $isFavorite = \Auth::user()->favorites()->where('favorites.variation_id',$variation->id)->exists();
                }

                if(! $request->promotion){
//                    $requriedItems = $stock->promotions()->where('type',true)->pluck('variation_id');
                }

                if ($variation->qty > 0) {
                    return \Response::json(['price' => convert_price($price,get_currency()), 'variation_id' => $variation->id, 'error' => false,'isFavorite' => $isFavorite]);
                } else {
                    return \Response::json(['message' => 'Out of stock', 'price' => convert_price($price,get_currency()), 'variation_id' => $variation->id, 'error' => false,'isFavorite' => $isFavorite]);
                }
            }
        }

        return \Response::json(['message' => 'See available options', 'error' => true]);
    }

    public function getSubtotalPrice(Request $request)
    {
        $variation = StockVariation::find($request->uid);

        if($variation){
            $promotionPrice = $variation->stock->active_sales()->where('variation_id', $variation->id)->first();
            $price = ($promotionPrice) ? $promotionPrice->price : $variation->price;
            $optionalItems = $request->get('optionalItems');
            if($optionalItems && count($optionalItems)){
                foreach ($optionalItems as $opv){
                    $optpVariation = StockVariation::find($opv);
                    if($optpVariation){
                        $promotionPrice = $variation->stock->promotion_prices()->where('variation_id', $optpVariation->id)->first();
                        $reqPrice = ($promotionPrice) ? $promotionPrice->price:$optpVariation->price;
                        $price+=$reqPrice;
                    }
                }
            }
            $requiredItems = $request->get('requiredItems');
            if($requiredItems && count($requiredItems)){
                foreach ($requiredItems as $opv){
                    $optpVariation = StockVariation::find($opv);
                    if($optpVariation){
                        $promotionPrice = $variation->stock->promotion_prices()->where('variation_id', $optpVariation->id)->first();
                        $reqPrice = ($promotionPrice) ? $promotionPrice->price:$optpVariation->price;
                        $price+=$reqPrice;
                    }
                }
            }

            return \Response::json(['price' => convert_price($price,get_currency()), 'error' => false]);
        }

        return \Response::json(['message' => 'See available options', 'error' => true]);
    }


    public function getVariations(Request $request)
    {
        $model = Stock::with(['variations', 'stockAttrs'])->find($request->id);

        if (! $model) return \Response::json(['error' => true]);

        $html = \View('frontend.products._partials.add_to_card_modal_content',compact(['model']))->render();

        return \Response::json(['error' => false,'html' => $html]);
    }
}
