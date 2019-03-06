<?php

namespace App\ProductSearch\Filters;

use App\ProductSearch\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class MultiSelectFilter implements Filter
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
        if(is_array($value) && count($value)){
            foreach ($value as $attr_id => $stickers){
                if(is_array($stickers) && count($stickers)){
                    $builder = static::recursiveOrWhere($builder,$attr_id,$stickers,0);
                }
            }
        }
        return $builder;
    }

    private static function recursiveOrWhere($builder,$attribute_id,$stickers,$i = 0){
        if(isset($stickers[$i])){
            $builder->where(function ($query) use ($attribute_id,$stickers,$i) {
                $query->where('attributes_id',$attribute_id)
                    ->where('sticker_id',$stickers[$i])
                    ->orWhere(function ($query) use ($attribute_id,$stickers,$i){
                        $i++;
                        static::recursiveOrWhere($query,$attribute_id,$stickers,$i);
                    });

            });
        }

        return $builder;
    }
}