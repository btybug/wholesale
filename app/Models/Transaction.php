<?php
namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property string $payment_method
 * @property string $transaction_id
 * @property string $object
 * @property float $amount
 * @property float $amount_refunded
 * @property string $currency
 * @property string|null $invoice
 * @property int $paid
 * @property string|null $receipt_number
 * @property string $receipt_url
 * @property string $refunds_url
 * @property string $source_id
 * @property string $source_object
 * @property string $source_brand
 * @property string $source_country
 * @property string $source_exp_month
 * @property string $source_exp_year
 * @property string $source_funding
 * @property string $source_last4
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders $order
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereAmountRefunded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereReceiptNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereReceiptUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereRefundsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereSourceBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereSourceCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereSourceExpMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereSourceExpYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereSourceFunding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereSourceLast4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereSourceObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUserId($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    protected $table = 'transactions';

    protected $guarded=['id'];

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}