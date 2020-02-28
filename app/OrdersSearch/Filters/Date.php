<?php

namespace App\OrdersSearch\Filters;

use App\Models\AttributeStickers;
use App\ProductSearch\Filters\Filter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Date implements Filter
{

    public static function apply(Builder $builder, $value)
    {
        $builder->where(function ($query) use ($value) {

            $value = explode(' - ',$value);
            $value[0] = Carbon::parse($value[0])->format('Y-m-d');
            if(Carbon::parse($value[1])->format('d.m.Y') == Carbon::today()->format('d.m.Y') ){
                $value[1] = Carbon::parse($value[1])->addDay(1)->format('Y-m-d');
            }else{
                $value[1] = Carbon::parse($value[1])->format('Y-m-d');
            }

            $query->whereBetween('orders.created_at', $value);
        });

        return $builder;
    }
}
