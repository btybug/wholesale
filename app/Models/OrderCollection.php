<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderCollection extends Model
{
    protected $table = 'order_collection';
    protected $guarded=['id'];

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }
}
