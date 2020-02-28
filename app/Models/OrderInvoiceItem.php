<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderInvoiceItem
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderInvoiceItem[] $optional_items
 * @property-read int|null $optional_items_count
 * @property-read \App\Models\OrderInvoiceItem $order
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderInvoiceItem[] $required_items
 * @property-read int|null $required_items_count
 * @property-read \App\Models\Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem main()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereAdditionalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereCollected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceItem whereVariationId($value)
 * @mixin \Eloquent
 */
class OrderInvoiceItem extends Model
{
    protected $table = 'order_invoice_items';
    protected $guarded=['id'];

    protected $casts = [
        'options' => 'json',
        'additional_data' => 'json',
    ];

    public function order()
    {
        return $this->belongsTo(OrderInvoiceItem::class,'order_id');
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
