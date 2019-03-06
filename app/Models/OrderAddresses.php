<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/1/2018
 * Time: 1:40 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderAddresses extends Model
{
    protected $table = 'orders_addresses';
    protected $guarded=['id'];

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }
}