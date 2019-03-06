<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class ReferalCoupon extends Model
{
    /**
     * @var string
     */
    protected $table = 'referal_coupons';
    /**
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupons::class, 'coupon_id');
    }
}