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

/**
 * App\Models\ReferalCoupon
 *
 * @property int $id
 * @property int $user_id
 * @property int $coupon_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coupons $coupon
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferalCoupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferalCoupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferalCoupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferalCoupon whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferalCoupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferalCoupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferalCoupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferalCoupon whereUserId($value)
 * @mixin \Eloquent
 */
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