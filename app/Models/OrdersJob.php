<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12/19/2018
 * Time: 2:04 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrdersJob
 *
 * @property int $id
 * @property int $status
 * @property int $order_id
 * @property string|null $sent_at
 * @property string|null $log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrdersJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrdersJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrdersJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrdersJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrdersJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrdersJob whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrdersJob whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrdersJob whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrdersJob whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrdersJob whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrdersJob extends Model
{
    protected $table = 'orders_job';
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
    public static function makeNew(int $order_id){
      return  self::create([
            'order_id'=>$order_id
        ]);
    }
}