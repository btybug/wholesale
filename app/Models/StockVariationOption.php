<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StockVariationOption
 *
 * @property int $id
 * @property int $variation_id
 * @property int $attribute_sticker_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AttributeStickers $attribute_sticker
 * @property-read \App\Models\StockVariation $variation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationOption whereAttributeStickerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationOption whereVariationId($value)
 * @mixin \Eloquent
 */
class StockVariationOption extends Model
{
    protected $table = 'stock_variation_options';

    protected $fillable = ['variation_id','attribute_sticker_id'];

    protected $dates = ['created_at','updated_at'];

    public function variation()
    {
        return $this->belongsTo(StockVariation::class, 'variation_id');
    }

    public function attribute_sticker()
    {
        return $this->belongsTo(AttributeStickers::class, 'attribute_sticker_id');
    }
}