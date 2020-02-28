<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StockSales
 *
 * @property int $id
 * @property int $variation_id
 * @property int $stock_id
 * @property string|null $name
 * @property string $slug
 * @property string|null $start_date
 * @property string|null $end_date
 * @property float $price
 * @property int $canceled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $availability
 * @property-read \App\Models\Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales whereCanceled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSales whereVariationId($value)
 * @mixin \Eloquent
 */
class StockSales extends Model
{
    protected $table = 'stock_sales';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];

    protected $appends = array('availability');

    public function getAvailabilityAttribute()
    {
        return $this->calculateActivity($this->start_date,$this->end_date);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = strtotime($value);
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = strtotime($value);
    }

    private function calculateActivity($start,$end){
        $result = null;
        $now = strtotime(today()->toDateString());

        if($now >= $start && $now <= $end){
            $result = 'current';
        }elseif ($now < $start){
            $result = 'coming';
        }elseif ($now > $end){
            $result = 'archive';
        }

        return $result;
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}