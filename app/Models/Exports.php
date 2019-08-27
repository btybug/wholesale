<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Exports extends Model
{
    protected $table = 'exports';
    protected $fillable = ['shop_id', 'status', 'site_id','notes','delivery_date'];
    protected $dates = ['created_at', 'updated_at', 'delivery_date'];
    public static $status = [
        'Pending','Shipped','Delivered','Canceled','lost'
    ];


    public function items()
    {
        return $this->hasMany(ExportsItems::class, 'export_id');

    }

    public function getPrice()
    {
        $sum=0;
        foreach ($this->items as $item){
            $sum+= $item->qty*$item->price;
        }
        return $sum;
    }

}
