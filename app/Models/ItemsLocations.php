<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/26/2018
 * Time: 10:39 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemsLocations
 *
 * @property int $id
 * @property int|null $item_id
 * @property int|null $warehouse_id
 * @property int|null $rack_id
 * @property int|null $shelve_id
 * @property int|null $qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $transfer_location
 * @property-read \App\Models\Items|null $item
 * @property-read \App\Models\WarehouseRacks $rack
 * @property-read \App\Models\WarehouseRacks $shelve
 * @property-read \App\Models\Warehouse $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsLocations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsLocations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsLocations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsLocations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsLocations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsLocations whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsLocations whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsLocations whereRackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsLocations whereShelveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsLocations whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsLocations whereWarehouseId($value)
 * @mixin \Eloquent
 */
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
