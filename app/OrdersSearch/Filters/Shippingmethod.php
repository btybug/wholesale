<?php


namespace App\OrdersSearch\Filters;


use App\ProductSearch\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class Shippingmethod implements Filter
{

    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->whereIn('orders.shipping_method',$value);
    }
}
