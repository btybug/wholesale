<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 3/19/2019
 * Time: 11:32 AM
 */

namespace App\Services;


use App\Models\Barcodes;

class BarcodesService
{
    public function getUnsedCodes($id=null)
    {
        $query=Barcodes::doesntHave('item');
        if($id){
            $query->orWhere('id',$id);
        }
        return $query->get()->pluck('code','id');
    }

    public function getPluck($id=null)
    {
        return Barcodes::get()->pluck('code','id');
    }
}
