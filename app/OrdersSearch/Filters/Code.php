<?php

namespace App\OrdersSearch\Filters;

use App\Models\AttributeStickers;
use Illuminate\Database\Eloquent\Builder;

class Code implements Filter
{

    public static function apply(Builder $builder, $value)
    {
        return  $builder->where('orders.code','LIKE' ,"%".$value."%");

    }
}
