<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderCollection
 *
 * @property int $id
 * @property int $order_id
 * @property int $variation_id
 * @property int $item_id
 * @property string $unique_id
 * @property string|null $warehouse
 * @property string|null $rack
 * @property string|null $shelve
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection whereRack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection whereShelve($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection whereUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection whereVariationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCollection whereWarehouse($value)
 * @mixin \Eloquent
 */
class OrderCollection extends Model
{
    protected $table = 'order_collection';
    protected $guarded=['id'];

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }
}
