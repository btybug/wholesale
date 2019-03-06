<?php

namespace App\ProductSearch\Filters;

use App\Models\AttributeStickers;
use App\ProductSearch\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class SelectFilter implements Filter
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
        if(is_array($value) && count(array_filter($value))){
            $value = array_filter($value);
//            $attributeStickerIDs = [];
            $str = '';
//            dd($value);
//            sum(attributes_id = 21 and sticker_id = 16) > 0 and sum((`attributes_id` = 6 and `sticker_id` = "8" ) or (`attributes_id` = 6 and `sticker_id` = "7" ) ) > 0
            foreach ($value as $aID => $sID){
                end($value);         // move the internal pointer to the end of the array
                $key = key($value);
                if($key == $aID){
                    if(is_array($sID)){
                        $str.='sum(';
                        foreach ($sID as $multy_id){
                            if(end($sID) == $multy_id){
                                $str.= '(attributes_id = '.$aID.' and sticker_id = '.$multy_id.')';
                            }else{
                                $str.= '(attributes_id = '.$aID.' and sticker_id = '.$multy_id.') or';
                            }
                        }
                        $str.=') > 0 ';
                    }else{
                        $str.= 'sum(attributes_id = '.$aID.' and sticker_id = '.$sID.') > 0 ';
                    }
                }else{
                    if(is_array($sID)){
                        $str.='sum(';
                        foreach ($sID as $multy_id){
                            if(end($sID) == $multy_id){
                                $str.= '(attributes_id = '.$aID.' and sticker_id = '.$multy_id.')';
                            }else{
                                $str.= '(attributes_id = '.$aID.' and sticker_id = '.$multy_id.') or';
                            }
                        }
                        $str.=') > 0 and ';
                    }else{
                        $str.= 'sum(attributes_id = '.$aID.' and sticker_id = '.$sID.') > 0 and ';
                    }

                }
            }

//            dd($str);
//            foreach ($attributeStickerIDs as $id){
//            having sum(a.aid = 1 and a.val = 'avalue1') > 0 and
//            sum(a.aid = 2 and a.val = 'avalue2') > 0;
//            $str = 'sum(';
//            foreach ($attributeStickerIDs as $id){
//                if(end($attributeStickerIDs) == $id){
//                    $str.= 'stock_variation_options.attribute_sticker_id = '.$id.') > 0';
//                }else{
//                    $str.= 'stock_variation_options.attribute_sticker_id = '.$id.' and ';
//                }
//            }
//            dd($str);

             $builder->havingRaw($str);
//                $builder->havingSum('stock_variation_options.attribute_sticker_id',$attributeStickerIDs);
//            }


//            dd($value);
//
//            $attributes = array_keys($value);
//            $stickers = array_values($value);
////            dd($value,$attributes,$stickers);
//            if(count($attributes) && count($stickers)){
//                $builder->whereIn('attributes_id',$attributes)
//                        ->whereIn('sticker_id',$stickers);
//            }

//            $builder->where('cer1',1)
//                ->where('sticker_id',16);
//            dd($builder);
//            foreach ($value as $attr_id => $sticker_id){
//                $builder->where('attributes_id',$attr_id)
//                        ->where('sticker_id',$sticker_id);
//            }

//            $builder->where(function ($query) use ($builder,$value){
////                dd($builder);
//                static::recursiveOrWhere($query,$value);
//
//            });

        }
        return $builder;
    }

    private static function recursiveOrWhere($builder,$data){
        if(count($data)){
            $builder->where(function ($query) use ($data) {
                $attribute_id = key($data);
                $sticker_id = array_first($data);
                unset($data[$attribute_id]);

                $query->where('attributes_id',$attribute_id)
                    ->where('sticker_id',$sticker_id)
                    ->orWhere(function ($query) use ($data){
                        static::recursiveOrWhere($query,$data);
                    });

            });
        }

        return $builder;
    }
}