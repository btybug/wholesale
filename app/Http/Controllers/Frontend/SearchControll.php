<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Stock;
use App\ProductSearch\ProductSearch;
use Illuminate\Http\Request;

class SearchControll extends Controller
{
    public function postSearch(Request $request)
    {
        $category = $request->get('category');
        $name = $request->get('name');

        $query = Stock::leftJoin('stock_translations', 'stocks.id', '=', 'stock_translations.stock_id');
            $query->leftJoin('stock_categories', 'stocks.id', '=', 'stock_categories.stock_id')
                ->leftJoin('categories', 'stock_categories.categories_id', '=', 'categories.id');

       $query->select(
            'stocks.image',
            'stocks.slug',
            'stock_translations.*',
            'categories.slug as category'
        );
        if ($category) {
            $query->where('categories.slug', $category);
        }
        $result=$query->where('stock_translations.locale', app()->getLocale())
            ->where('stocks.status', true)
            ->where('stocks.is_offer', false)
            ->where('stock_translations.name', 'LIKE', '%' . $name . '%')
            ->get();
        return response()->json(['data' => $result->toArray(), 'code' => 200,'category'=>$category]);
    }

}
