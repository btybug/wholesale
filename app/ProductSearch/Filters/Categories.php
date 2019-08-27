<?php

namespace App\ProductSearch\Filters;

use App\Models\AttributeStickers;
use App\ProductSearch\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class Categories implements Filter
{

    public static function apply(Builder $builder, $value)
    {
        $builder->where(function ($query) use ($value) {
            $query->whereIn('stock_categories.categories_id', $value);
        });

        return $builder;
    }
}
