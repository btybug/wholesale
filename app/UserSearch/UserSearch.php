<?php

namespace App\UserSearch;

use App\Models\Orders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class UserSearch
{
    public static function apply(Request $filters, $sql = false)
    {
        $query =
            static::applyDecoratorsFromRequest(
                $filters, (new User())->newQuery()
            );

        return static::getResults($query, $sql);
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

    private static function getResults(Builder $query, $sql)
    {
        return ($sql) ? ['data' => $query->get(), 'sql' => static::getSql($query->toSql(),$query->getBindings())] : $query->get();
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

    private static function createObject($category = null, $request)
    {
        $query =User::query();
        return $query;
    }

}
