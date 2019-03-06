<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/20/2018
 * Time: 8:55 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DeliveryCostOptions extends Model
{
    protected $table = 'delivery_cost_options';

    protected $fillable = ['courier_id','cost','time','delivery_cost_id'];

    public function courier()
    {
        return $this->belongsTo(Couriers::class, 'courier_id');
    }
}