<?php

namespace App\OrdersSearch\Filters;

use App\ProductSearch\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\Boolean;

class Status implements Filter
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
        $value= ($value==3)?0:$value;
        return $builder->where('stocks.status',(bool)$value);
    }
}
