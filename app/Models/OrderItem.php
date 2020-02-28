<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderItem
 *
 * @property int $id
 * @property int $order_id
 * @property int|null $parent_id
 * @property int|null $stock_id
 * @property string $name
 * @property string $sku
 * @property string $variation_id
 * @property string|null $type
 * @property float $price
 * @property int $qty
 * @property float $amount
 * @property string|null $image
 * @property array|null $options
 * @property string|null $note
 * @property array|null $additional_data
 * @property int $collected
 * @property int $is_refunded
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $optional_items
 * @property-read int|null $optional_items_count
 * @property-read \App\Models\Orders $order
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $required_items
 * @property-read int|null $required_items_count
 * @property-read \App\Models\Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem main()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereAdditionalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereCollected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereIsRefunded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereVariationId($value)
 * @mixin \Eloquent
 */
class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $guarded=['id'];

    protected $casts = [
        'options' => 'json',
        'additional_data' => 'json',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }

    public function stock()
    {
        return $this->hasOne(Stock::class,'id','stock_id');
    }

    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }

    public function required_items()
    {
        return $this->hasMany(self::class,'parent_id','id')->where('type','required');
    }

    public function optional_items()
    {
        return $this->hasMany(self::class,'parent_id','id')->where('type','optional');
    }
}
