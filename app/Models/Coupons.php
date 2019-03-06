<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class Coupons extends Model
{
    /**
     * @var string
     */
    protected $table = 'coupons';
    /**
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'variations' => "json",
        'users' => "json",
    ];
    protected $appends = array('availability');

    public function getAvailabilityAttribute()
    {
        return $this->calculateActivity($this->start_date,$this->end_date,$this->status);
    }

    private function calculateActivity($start,$end,$status){
        $result = null;
        $now = strtotime(today()->toDateString());

        if($status == 0) {
            $result = 'canceled';
        }else{
            if($now >= $start && $now <= $end){
                $result = 'active';
            }elseif ($now < $start){
                $result = 'coming';
            }elseif ($now > $end){
                $result = 'expired';
            }
        }


        return $result;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = strtotime($value);
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = strtotime($value);
    }

    public static function updateOrCreate(int $id = null, array $data)
    {
        $model = self::find($id)??new static();
        (isset($model->id)) ? $model->update($data) : $model->fill($data);
        $model->save();
        return $model;
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class,'product');
    }

    public function renderVoucher(){
        $html = '';
        if(\View::exists("admin.store.coupon_themes.$this->theme")){
            $html = \View("admin.store.coupon_themes.$this->theme")->with('model',$this)->with('data',[])->render();
        }

        return $html;
    }
}
