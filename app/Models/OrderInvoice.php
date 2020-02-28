<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/1/2018
 * Time: 1:37 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderInvoice
 *
 * @property int $id
 * @property string $code
 * @property int|null $user_id
 * @property float $amount
 * @property int $billing_addresses_id
 * @property int|null $transaction_id
 * @property string $shipping_method
 * @property string $payment_method
 * @property float $shipping_price
 * @property string $currency
 * @property string|null $coupon_code
 * @property string $order_number
 * @property string|null $customer_notes
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Addresses $billingAddress
 * @property-read \App\Models\Coupons $coupon
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderInvoiceHistory[] $history
 * @property-read int|null $history_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderInvoiceItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\OrderInvoiceAddresses $shippingAddress
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereBillingAddressesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereCouponCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereCustomerNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereShippingMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereShippingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoice whereUserId($value)
 * @mixin \Eloquent
 */
class OrderInvoice extends Model
{
    protected $table = 'order_invoices';
    protected $guarded = ['id'];

    const ORDER_NEW_SESSION_ID = 'order_new';


    public function shippingAddress()
    {
        return $this->hasOne(OrderInvoiceAddresses::class, 'order_id');
    }

    public function billingAddress()
    {
        return $this->belongsTo(Addresses::class, 'billing_addresses_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function history()
    {
        return $this->hasMany(OrderInvoiceHistory::class, 'order_id')->orderBy('id', 'DESC')->with('admin');
    }

    public function items()
    {
        return $this->hasMany(OrderInvoiceItem::class, 'order_id');
    }


    public function coupon()
    {
        return $this->hasOne(Coupons::class, 'code','coupon_code');
    }

}
