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
 * App\Models\StockOfferProducts
 *
 * @property int $id
 * @property int $stock_id
 * @property int $offer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockOfferProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockOfferProducts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockOfferProducts query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockOfferProducts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockOfferProducts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockOfferProducts whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockOfferProducts whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockOfferProducts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StockOfferProducts extends Model
{
    protected $table = 'stock_offer_products';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}
