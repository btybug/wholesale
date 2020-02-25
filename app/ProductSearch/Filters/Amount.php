<?php

namespace App\ProductSearch\Filters;

use App\Models\AttributeStickers;
use App\ProductSearch\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class Amount implements Filter
{

    public static function apply(Builder $builder, $value)
    {
        $builder->where(function ($query) use ($value) {
            $currencyCode = get_currency();
            $value[0] = ($value[0]) ?? 0;
            $value[1] = ($value[1]) ?? 1000;

            if($currencyCode != 'USD'){
                $changed = (new \App\Models\SiteCurrencies())->where('code',$currencyCode)->first();
                $value = (is_string($value))?explode(',', $value):$value;
                $value[0] = $value[0] / $changed->rate;
                $value[1] = $value[1] / $changed->rate;
            }elseif (is_string($value)){
                $value = explode(',',$value);
            }

            $query->whereBetween('stock_sales.price', $value)
                ->orWhere(function ($query) use ($value) {
                    $query->whereBetween('stock_variations.price', $value)
                        ->whereNull('stock_sales.price');
                });
        });

        return $builder;
    }
}
