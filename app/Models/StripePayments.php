<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/31/2018
 * Time: 9:48 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StripePayments
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $transaction_id
 * @property int $amount
 * @property string $currency_code
 * @property string $payment_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StripePayments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StripePayments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StripePayments query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StripePayments whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StripePayments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StripePayments whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StripePayments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StripePayments wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StripePayments whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StripePayments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StripePayments whereUserId($value)
 * @mixin \Eloquent
 */
class StripePayments extends Model
{
    /**
     * @var string
     */
    protected $table = 'stripe_payments';
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'transaction_id', 'amount', 'currency_code', 'payment_status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}