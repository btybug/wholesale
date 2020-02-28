<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 2/6/2019
 * Time: 10:30 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReferralBonus
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $bonus_bringing_user_id
 * @property int|null $referral_coupon_id
 * @property int $status
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $recipient
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralBonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralBonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralBonus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralBonus whereBonusBringingUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralBonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralBonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralBonus whereReferralCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralBonus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralBonus whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralBonus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReferralBonus whereUserId($value)
 * @mixin \Eloquent
 */
class ReferralBonus extends Model
{
    protected $table = 'referral_bonus';

    protected $guarded=['id'];

    public function recipient()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}