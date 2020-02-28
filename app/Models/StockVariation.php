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
 * App\Models\StockVariation
 *
 * @property int $id
 * @property int $stock_id
 * @property int $item_id
 * @property string $variation_id
 * @property string $type
 * @property string|null $title
 * @property int $is_required
 * @property string $name
 * @property string|null $description
 * @property string|null $image
 * @property int $qty
 * @property float $price
 * @property int $count_limit
 * @property int $min_count_limit
 * @property float $common_price
 * @property string|null $display_as
 * @property string|null $price_per
 * @property int $filter_category_id
 * @property string|null $price_type
 * @property string|null $discount_type
 * @property int $ordering
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockVariationDiscount[] $discounts
 * @property-read int|null $discounts_count
 * @property-read \App\Models\Category $filter
 * @property-read \App\Models\Items $item
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockVariationOption[] $options
 * @property-read int|null $options_count
 * @property-read \App\Models\StockSales $sale
 * @property-read \App\Models\Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation extra()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation required()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereCommonPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereCountLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereDisplayAs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereFilterCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereMinCountLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation wherePricePer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation wherePriceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockVariation whereVariationId($value)
 * @mixin \Eloquent
 */
class StockVariation extends Model
{
    protected $table = 'stock_variations';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];

    public function scopeRequired($query)
    {
        return $query->where('is_required', 1);
    }

    public function scopeExtra($query)
    {
        return $query->where('is_required', 0);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function options()
    {
        return $this->hasMany(StockVariationOption::class, 'variation_id');
    }

    public function discounts()
    {
        return $this->hasMany(StockVariationDiscount::class, 'variation_id');
    }

    public function sale()
    {
        return $this->hasOne(StockSales::class, 'variation_id');
    }

    public function filter()
    {
        return $this->hasOne(Category::class, 'id','filter_category_id');
    }

    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }
}
