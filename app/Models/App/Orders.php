<?php


namespace App\Models\App;


use App\Models\ItemsLocations;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    const IN_PROGRESS=0;
    const PROCESSING=1;
    const DONE=2;
    protected $table = 'basket';
    protected $fillable = ['shop_id', 'status', 'user_id', 'discount', 'order_number', 'additional_data', 'staff_id', 'payment_method', 'tendered', 'changed', 'sub_total', 'total', 'tax','admin_discount'];
    protected $dates = ['created_at','updated_at','finished_at'];
    public function shop()
    {
        return $this->belongsTo(Shops::class,'shop_id');
    }

    public function items()
    {
        return $this->hasMany(OrdersItems::class,'basket_id')->where('type', OrdersItems::SOLD);
    }
    public function gifts()
    {
        return $this->hasMany(OrdersItems::class,'basket_id')->where('type', OrdersItems::GIFT);
    }


    public function basketItems()
    {
        return $this->belongsToMany(ItemsLocations::class,'basket_items','basket_id','item_id','id','id');
    }

    public function status()
    {
        $status='';
        switch ($this->status){
            case 0:$status='in progress';break;
            case 1:$status='processing';break;
            case 2:$status='done';break;
            case 3:$status='canceled';break;
            default:$status='unknown';break;
        }
        return $status;
    }
    public function statusClass()
    {
        $class='';
        switch ($this->status){
            case 0:$class='primary';break;
            case 1:$class='info';break;
            case 2:$class='success';break;
            case 3:$class='warning';break;
            default:$class='danger';break;
        }
        return $class;
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class,'staff_id');
    }

    public function discountOffers()
    {
        return $this->belongsToMany(AppOffersDiscount::class,'app_basket_offer_discounts','basket_id','discount_offer_id');
    }
}
