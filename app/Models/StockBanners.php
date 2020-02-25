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
 * App\Models\StockAds
 *
 * @property int $id
 * @property int $stock_id
 * @property string $image
 * @property string $url
 * @property string $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAds newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAds newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAds query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAds whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAds whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAds whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAds whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAds whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAds whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockAds whereUrl($value)
 * @mixin \Eloquent
 */
class StockBanners extends Model
{
    /**
     * @var string
     */
    protected $table = 'stock_banners';
    /**
     * @var array
     */
    protected $fillable = [
        'stock_id', 'image', 'url', 'tags', 'alt'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}
