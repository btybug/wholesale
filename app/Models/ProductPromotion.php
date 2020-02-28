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
 * App\Models\ProductPromotion
 *
 * @property int $id
 * @property int $stock_id
 * @property int $promotion_id
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPromotion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPromotion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPromotion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPromotion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPromotion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPromotion wherePromotionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPromotion whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPromotion whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductPromotion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductPromotion extends Model
{
    protected $table = 'product_promotions';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];


}