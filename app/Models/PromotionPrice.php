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
 * App\Models\PromotionPrice
 *
 * @property int $id
 * @property int $variation_id
 * @property int $promotion_id
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Stock $promotion
 * @property-read \App\Models\StockVariation $variation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PromotionPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PromotionPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PromotionPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PromotionPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PromotionPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PromotionPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PromotionPrice wherePromotionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PromotionPrice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PromotionPrice whereVariationId($value)
 * @mixin \Eloquent
 */
class PromotionPrice extends Model
{
    protected $table = 'promotion_prices';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];

    public function promotion()
    {
        return $this->belongsTo(Stock::class, 'promotion_id');
    }

    public function variation()
    {
        return $this->belongsTo(StockVariation::class, 'variation_id');
    }
}