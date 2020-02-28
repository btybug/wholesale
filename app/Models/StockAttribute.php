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
 * App\Models\StockAttribute
 *
 * @property int $id
 * @property int $stock_id
 * @property int $attributes_id
 * @property int|null $sticker_id
 * @property int|null $parent_id
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Attributes $attr
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockAttribute[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\StockAttribute|null $parent
 * @property-read \App\Models\Stickers|null $sticker
 * @property-read \App\Models\Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAttribute whereAttributesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAttribute whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAttribute whereStickerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAttribute whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAttribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAttribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StockAttribute extends Model
{
    protected $table = 'stock_attributes';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

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