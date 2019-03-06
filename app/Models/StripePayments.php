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