<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12/19/2018
 * Time: 2:04 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

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