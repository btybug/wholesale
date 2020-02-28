<?php

namespace App\OrdersSearch;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrdersSearch
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
//        $selectFilters = array_filter($request->get('select_filter', []));
//        $orderFilter = static::generateOrderBy($request->get('sort_by', null));
//        if (count($selectFilters)) {
//            return $query->groupBy('stock_variations.id')->orderBy($orderFilter[0], $orderFilter[1])->get()->keyBy('id')->all();
//        } else {
//            return $query->groupBy('stocks.id')->orderBy($orderFilter[0], $orderFilter[1])->get();
//        }
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
            default:
                $defaultCol = 'created_at';
                $ordering = 'desc';
        }

        return [$defaultCol, $ordering];
    }

    private static function createObject($category = null, $request)
    {
        $query = Orders::leftJoin('users','orders.user_id','users.id')
            ->leftJoin('orders_addresses','orders_addresses.id','orders.billing_addresses_id')
            ->leftJoin('order_history','order_history.order_id','orders.id')
            ->select('orders.*','users.name',
                'orders_addresses.country',
                'orders_addresses.city',
                'orders_addresses.region'
            );
        return $query;
    }

}
