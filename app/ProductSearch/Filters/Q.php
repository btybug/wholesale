<?php

namespace App\ProductSearch\Filters;

use App\Models\AttributeStickers;
use App\ProductSearch\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class Q implements Filter
{

    public static function apply(Builder $builder, $value)
    {
        $builder->where(function ($query) use ($value) {
            $query->where('stock_translations.name',"LIKE","%".$value."%")
                ->orWhere(function ($query) use ($value){
                    $query->where('stock_translations.short_description',"LIKE","%".$value."%")
                        ->orWhere('stock_translations.long_description',"LIKE","%".$value."%");
                });
        });
        return $builder;
    }
}