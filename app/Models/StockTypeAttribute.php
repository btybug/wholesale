<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StockTypeAttribute
 *
 * @property int $id
 * @property int $stock_id
 * @property int $attributes_id
 * @property int|null $sticker_id
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Attributes $attr
 * @property-read \App\Models\Stickers|null $sticker
 * @property-read \App\Models\Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockTypeAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockTypeAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockTypeAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockTypeAttribute whereAttributesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockTypeAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockTypeAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockTypeAttribute whereStickerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockTypeAttribute whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockTypeAttribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockTypeAttribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StockTypeAttribute extends Model
{
    protected $table = 'stock_type_attributes';

    protected $fillable = ['stock_id','attributes_id', 'sticker_id','type'];

    protected $dates = ['created_at','updated_at'];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function attr()
    {
        return $this->belongsTo(Attributes::class, 'attributes_id');
    }

    public function sticker()
    {
        return $this->belongsTo(Stickers::class, 'sticker_id');
    }
}