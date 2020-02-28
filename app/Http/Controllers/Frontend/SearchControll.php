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
        $name = $request->get('name');

        $query = Stock::leftJoin('stock_translations', 'stocks.id', '=', 'stock_translations.stock_id');
        $query = $query->leftJoin('stock_categories', 'stocks.id', '=', 'stock_categories.stock_id')
                ->leftJoin('categories', 'stock_categories.categories_id', '=', 'categories.id');

        $query = $query->select(
            'stocks.id',
            'stocks.image',
            'stock_translations.slug',
            'stock_translations.name',
            'stock_translations.short_description',
            'categories.slug as category'
        );

        $result=$query->where('stocks.status', true)
            ->where('stocks.is_offer', false)
            ->where('stock_translations.name', 'LIKE', '%' . $name . '%')
            ->where('stock_translations.locale', app()->getLocale())
            ->groupBy("stocks.id")
            ->get();

        return response()->json(['data' => $result->toArray(), 'code' => 200]);
    }

}
