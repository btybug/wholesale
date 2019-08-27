<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/26/2018
 * Time: 10:39 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ItemsLocations extends Model
{
    protected $table = 'item_locations';
    protected $guarded=['id'];
    protected $appends=['transfer_location'];

    public function getTransferLocationAttribute() {
        $str = 'Not Correct';
        $warehouse = ($this->warehouse) ? $this->warehouse->name : null;
        if($warehouse){
            $str =  $warehouse;
            $rack = ($this->rack) ? $this->rack->name : null;
            if($rack){
                $str .= " - ".$rack;
                $shelve = ($this->shelve) ? $this->shelve->name : null;
                if($shelve){
                    $str .= " - ".$shelve;
                }
            }
        }
        return $str;
    }

    public function item()
    {
        return $this->belongsTo(Items::class,'item_id');
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class,'id','warehouse_id');
    }

    public function rack()
    {
        return $this->hasOne(WarehouseRacks::class,'id','rack_id');
    }

    public function shelve()
    {
        return $this->hasOne(WarehouseRacks::class,'id','shelve_id');
    }



}
