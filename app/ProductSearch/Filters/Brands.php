<?php

namespace App\ProductSearch\Filters;

use App\Models\AttributeStickers;
use App\ProductSearch\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class Brands implements Filter
{

    public static function apply(Builder $builder, $value)
    {
        $builder->where(function ($query) use ($value) {
            $query->whereIn('stocks.brand_id', $value);
        });

        return $builder;
    }
}
