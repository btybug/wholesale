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
 * App\Models\Orders
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderCollection[] $collections
 * @property-read int|null $collections_count
 * @property-read \App\Models\Coupons $coupon
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderHistory[] $history
 * @property-read int|null $history_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\OrderAddresses $shippingAddress
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereBillingAddressesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereCouponCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereCustomerNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereShippingMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereShippingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders whereUserId($value)
 * @mixin \Eloquent
 */
class Orders extends Model
{
    protected $table = 'orders';
    protected $guarded = ['id'];

    const ORDER_NEW_SESSION_ID = 'order_new';


    public function shippingAddress()
    {
        return $this->hasOne(OrderAddresses::class, 'order_id');
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
        return $this->hasMany(OrderHistory::class, 'order_id')->orderBy('id', 'DESC')->with('admin');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function collections()
    {
        return $this->hasMany(OrderCollection::class, 'order_id');
    }

    public function coupon()
    {
        return $this->hasOne(Coupons::class, 'code','coupon_code');
    }

    public function reviews()
    {
        return $this->hasOne(Review::class, 'order_id','id');
    }

}
