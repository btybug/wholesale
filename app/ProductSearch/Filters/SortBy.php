<?php

namespace App\ProductSearch\Filters;

use App\Models\AttributeStickers;
use App\ProductSearch\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class SortBy implements Filter
{

    public static function apply(Builder $builder, $value)
    {
//        dd($value);
//        $builder->whereBetween('stock_variations.price', explode(',',$value));
//
        return $builder;
    }
}