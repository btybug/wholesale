<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/20/2018
 * Time: 8:55 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeliveryCostOptions
 *
 * @property int $id
 * @property int $courier_id
 * @property float $cost
 * @property string $time
 * @property int $delivery_cost_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Couriers $courier
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostOptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostOptions whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostOptions whereCourierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostOptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostOptions whereDeliveryCostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostOptions whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostOptions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeliveryCostOptions extends Model
{
    protected $table = 'delivery_cost_options';

    protected $fillable = ['courier_id','cost','time','delivery_cost_id'];

    public function courier()
    {
        return $this->belongsTo(Couriers::class, 'courier_id');
    }
}