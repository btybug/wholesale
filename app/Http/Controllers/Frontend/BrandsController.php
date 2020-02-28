<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Settings;
use App\Models\Stock;
use App\Models\StockCategories;
use Illuminate\Http\Request;

class BrandsController extends Controller
{


    protected $view = 'frontend.brands';

    public function index($slug = null)
    {
        $brands = Brands::all();
        if(! $brands->count()) abort(404);
        $slug = ($slug) ? $slug : $brands->first()->slug;
        $current = ($slug) ? Brands::where('slug', $slug)->firstOrFail() : null;
        $products = ($current) ? $current->products() : collect([]);
        $categories = Category::where('type', 'stocks')->whereNotNull('parent_id')->get();
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
        $sliders = $settings->getEditableData('brands');

        return $this->view('index', compact('brands', 'slug', 'current', 'products', 'categories', 'stockCategories','f','sliders'));
    }

    public function postBrand(Request $request)
    {
        $current = Brands::findOrFail($request->id);

        $products = $current->products();
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
        $html = view("frontend.brands._partials.current", compact('current', 'products', 'stockCategories','f'))->render();
        return response()->json(['error' => false, 'html' => $html]);

        return response()->json(['error' => true]);
    }
    public function postCategoryProducts(Request $request)
    {
        $current = Brands::findOrFail($request->id);

        $products = $current->products();
        $stockCategories = StockCategories::leftJoin('categories', 'stock_categories.categories_id', '=', 'categories.id')
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
        $html = view('frontend.brands._partials.products', compact('current', 'products', 'stockCategories','f'))->render();
        return response()->json(['error' => false, 'html' => $html]);
    }

    public function postBrandProducts(Request $request)
    {
        $parent = Brands::findOrFail($request->id);

        if ($parent) {
            $stockCategories = $parent->children;
        }else{
            $stockCategories = Brands::all();
        }

        $current = ($stockCategories && count($stockCategories)) ? $stockCategories->first() : null;
        $products = ($current) ? $current->products() : collect([]);
        $f = ($current) ? $current->id : null;
        $html = view('frontend.brands._partials.current', compact('current', 'products','f'))
            ->with('stockCategories',$stockCategories->pluck('name','slug'))->render();
        $list = view("frontend.brands._partials.list",compact(['current']))->with('brands',$stockCategories)->render();

        return response()->json(['error' => false, 'html' => $html,'list' => $list]);
    }

}

