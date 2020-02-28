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
/**
 * App\Models\Coupons
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property string|null $type
 * @property int|null $discount
 * @property int|null $total_amount
 * @property string|null $shipping_type
 * @property int|null $product
 * @property array|null $variations
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $user_per_coupon
 * @property string|null $user_per_customer
 * @property string|null $based
 * @property int $status
 * @property int $target
 * @property array|null $users
 * @property string|null $created_by
 * @property string|null $theme
 * @property int $send_email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $availability
 * @property-read \App\Models\Stock|null $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereBased($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereSendEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereShippingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereUserPerCoupon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereUserPerCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereUsers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Coupons whereVariations($value)
 * @mixin \Eloquent
 */
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
