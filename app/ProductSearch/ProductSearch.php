<?php

namespace App\ProductSearch;

use App\Models\Category;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductSearch
{
    public static function apply(Request $filters, $category = null, $sql = false)
    {
        $query = static::applyDecoratorsFromRequest(
            $filters, static::createObject($category, $filters)
        );

        return static::getResults($query, $sql, $filters);
    }

    public static function applyQuery(Request $filters, $category = null, $sql = false)
    {
        $query = static::applyDecoratorsFromRequest(
            $filters, static::createObject($category, $filters)
        );

        return $query;
    }

    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach ($request->all() as $filterName => $value) {
            $decorator = static::createFilterDecorator($filterName);
            if (static::isValidDecorator($decorator) && static::isValidValue($value)) {
                $query = $decorator::apply($query, $value);
            }
        }
        return $query;
    }

    private static function createFilterDecorator($name)
    {

        return __NAMESPACE__ . '\\Filters\\' .
            str_replace(' ', '',
                ucwords(str_replace('_', ' ', $name)));
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    private static function isValidValue($value)
    {
        return ($value && $value != '') ? true : false;
    }

    private static function getResults(Builder $query, $sql, $filters)
    {
        $response = static::checkGroupBy($filters, $query);
        return ($sql) ? ['data' => $response, 'sql' => static::getSql($query->toSql(), $query->getBindings())] : $response;
    }

    private static function getSql($sql, $bindings)
    {
        $needle = '?';
        foreach ($bindings as $replace) {
            $pos = strpos($sql, $needle);
            if ($pos !== false) {
                if (gettype($replace) === "string") {
                    $replace = ' "' . addslashes($replace) . '" ';
                }
                $sql = substr_replace($sql, $replace, $pos, strlen($needle));
            }
        }
        return $sql;
    }

    private static function checkGroupBy(Request $request, $query)
    {
        $selectFilters = array_filter($request->get('select_filter', []));
        $orderFilter = static::generateOrderBy($request->get('sort_by', null));
        if (count($selectFilters)) {
            return $query->groupBy('stock_variations.id')->orderBy($orderFilter[0], $orderFilter[1])->get()->keyBy('id')->all();
        } else {
            return $query->groupBy('stocks.id')->orderBy($orderFilter[0], $orderFilter[1])->get();
        }
    }

    private static function generateOrderBy(?string $orderBy)
    {
        switch ($orderBy) {
            case "newest":
                $defaultCol = 'created_at';
                $ordering = 'desc';
                break;
            case "oldest":
                $defaultCol = 'created_at';
                $ordering = 'asc';
                break;
            case "price_desc":
                $defaultCol = 'stock_variations.price';
                $ordering = 'desc';
                break;
            case "price_asc":
                $defaultCol = 'stock_variations.price';
                $ordering = 'asc';
                break;
            default:
                $defaultCol = 'created_at';
                $ordering = 'desc';
        }

        return [$defaultCol, $ordering];
    }

    private static function createObject($category = null, $request)
    {
        $query = Stock::leftJoin('stock_translations', 'stocks.id', '=', 'stock_translations.stock_id');
        $query->leftJoin('stock_categories', 'stocks.id', '=', 'stock_categories.stock_id');

        $subcategory = $request->get('subcategory', null);
        if ($subcategory && $subcategory != 'all') {
            $subcategoryObject = Category::where('slug', $subcategory)->first();
            if ($subcategoryObject)
                $query->where('stock_categories.categories_id', $subcategoryObject->id);

        } else {
            if ($category) {
                $query->where('stock_categories.categories_id', $category->id);
            }
        }

        $query->leftJoin('stock_variations', 'stocks.id', '=', 'stock_variations.stock_id')
            ->leftJoin('stock_variation_options', 'stock_variations.id', '=', 'stock_variation_options.variation_id')
            ->leftJoin('stock_sales', function ($join) {
                $now = strtotime(now());
                $join->on('stock_sales.variation_id', '=', 'stock_variations.id');
                $join->where('stock_sales.canceled', 0);
                $join->whereRaw("stock_sales.start_date <= ? AND stock_sales.end_date >= ?",
                    array($now, $now)
                );
            })
            ->leftJoin('stock_attributes', 'stocks.id', '=', 'stock_attributes.stock_id')
            ->leftJoin('favorites', 'stocks.id', '=', 'favorites.stock_id')
            ->where('stock_translations.locale', app()->getLocale());
        if (!$request->has('status')) {
            $query->where('stocks.status', true);
        }
        $query->where('stocks.is_offer', false);

        return $query->select('stocks.*', 'stock_translations.name',
            'stock_translations.short_description', 'stock_variations.price', 'stock_variations.id as variation_id',
            'favorites.id as is_favorite', 'stock_sales.price as new_price');
    }
//    private static function createObject($category = null,$request) {
//        $query = AttributeStickers::leftJoin('stock_variation_options', 'attributes_stickers.id', '=', 'stock_variation_options.attribute_sticker_id');
//
//
//        $query->leftJoin('stock_variations', 'stock_variation_options.variation_id', '=', 'stock_variations.id')
//            ->leftJoin('stocks', 'stock_variations.stock_id', '=', 'stocks.id')
//            ->leftJoin('stock_translations', 'stocks.id', '=', 'stock_translations.stock_id')
//
//            ->leftJoin('favorites', 'stock_variations.id', '=', 'favorites.variation_id')
//            ->where('stock_translations.locale',app()->getLocale());
////        if($category){
////            $query->leftJoin('stock_categories', 'stocks.id', '=', 'stock_categories.stock_id')
////                ->where('stock_categories.categories_id',$category->id);
////        }
//        return $query->select('stocks.*','attributes_stickers.*','stock_translations.name','stock_translations.short_description','stock_variations.price','stock_variations.id as variation_id','favorites.id as is_favorite');
//    }

}
