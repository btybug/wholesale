<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Settings;
use App\Models\Stickers;
use App\Models\Stock;
use App\Models\StockCategories;
use Illuminate\Http\Request;

class StickersController extends Controller
{


    protected $view = 'frontend.stickers';

    public function index($slug = null)
    {
        $stickers = Stickers::get();
        $current = ($slug) ? Stickers::where('slug',$slug)->first() : $stickers->first();
        $products=($current)?$current->products():collect([]);
        $stockCategories = StockCategories::
        leftJoin('categories', 'stock_categories.categories_id', '=', 'categories.id')
            ->leftJoin('categories_translations', 'categories_translations.category_id', '=', 'categories.id')
            ->where('categories_translations.locale', app()->getLocale())
            ->whereIn('stock_categories.stock_id', $products->pluck('id'))
            ->groupBy('stock_categories.categories_id')->select('categories.slug', 'categories_translations.name')->pluck('name', 'slug');
        $f = ($stockCategories->count())?(array_keys($stockCategories->toArray())[0]):false;
        $products = $products->leftJoin('stock_categories', 'stock_categories.stock_id', '=', 'stocks.id')
            ->leftJoin('categories', 'stock_categories.categories_id', '=', 'categories.id')
            ->where('categories.slug', $f)->select('stocks.*')->groupBy('stocks.id')->get();
        $settings = new Settings();
        $sliders = $settings->getEditableData('stickers');

        return $this->view('index', compact('stickers', 'slug', 'current','products','stockCategories','f','sliders'));
    }

    public function postSticker(Request $request)
    {
        $current = Stickers::where('slug',$request->id)->first();
        if($current){
            $products=$current->products();
            $stockCategories = StockCategories::
            leftJoin('categories', 'stock_categories.categories_id', '=', 'categories.id')
                ->leftJoin('categories_translations', 'categories_translations.category_id', '=', 'categories.id')
                ->where('categories_translations.locale', app()->getLocale())
                ->whereIn('stock_categories.stock_id', $products->pluck('id'))
                ->groupBy('stock_categories.categories_id')->select('categories.slug', 'categories_translations.name')->pluck('name', 'slug');
            $f = ($stockCategories->count())?(array_keys($stockCategories->toArray())[0]):false;

            $products = ($f)?$products->leftJoin('stock_categories', 'stock_categories.stock_id', '=', 'stocks.id')
                ->leftJoin('categories', 'stock_categories.categories_id', '=', 'categories.id')
                ->where('categories.slug', $f)->select('stocks.*')->groupBy('stocks.id')->get():$products->get();

            $html = view("frontend.stickers._partials.current",compact('current','products','stockCategories','f'))->render();
            return response()->json(['error' => false,'html' => $html]);
        }

        return response()->json(['error' => true]);
    }
    public function postCategoryProducts(Request $request)
    {
        $current = Stickers::findOrFail($request->id);
        if ($current) {
            $products=$current->products();
            $stockCategories = StockCategories::
            leftJoin('categories', 'stock_categories.categories_id', '=', 'categories.id')
                ->leftJoin('categories_translations', 'categories_translations.category_id', '=', 'categories.id')
                ->where('categories_translations.locale', app()->getLocale())
                ->whereIn('stock_categories.stock_id', $products->pluck('id'))
                ->groupBy('stock_categories.categories_id')->select('categories.slug', 'categories_translations.name')->pluck('name', 'slug');
            $f = isset($stockCategories[$request->slug])?$request->slug:false;
            $products = ($f)?$products
                ->leftJoin('stock_categories', 'stock_categories.stock_id', '=', 'stocks.id')
                ->leftJoin('categories', 'stock_categories.categories_id', '=', 'categories.id')
                ->where('categories.slug', $f)->select('stocks.*')
                ->groupBy('stocks.id')->get():$products->get();
//            dd($stockCategories,$f);
            $html = view('frontend.stickers._partials.products', compact('current', 'products', 'stockCategories','f'))->render();
            return response()->json(['error' => false, 'html' => $html]);
        }

        return response()->json(['error' => true]);
    }

}

