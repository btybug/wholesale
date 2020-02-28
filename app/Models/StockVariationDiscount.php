<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StockVariationDiscount
 *
 * @property int $id
 * @property int $variation_id
 * @property float|null $price
 * @property int|null $qty
 * @property int|null $from
 * @property int|null $to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StockVariation $variation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationDiscount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationDiscount whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationDiscount wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationDiscount whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationDiscount whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationDiscount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariationDiscount whereVariationId($value)
 * @mixin \Eloquent
 */
class StockVariationDiscount extends Model
{
    protected $table = 'stock_variation_discounts';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];

    public function variation()
    {
        return $this->belongsTo(StockVariation::class, 'variation_id');
    }
}
