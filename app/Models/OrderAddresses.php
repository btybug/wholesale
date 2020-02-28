<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/1/2018
 * Time: 1:40 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderAddresses
 *
 * @property int $id
 * @property int $order_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $company
 * @property string|null $type
 * @property string $first_line_address
 * @property string $second_line_address
 * @property string $city
 * @property string $country
 * @property string $region
 * @property string $post_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereFirstLineAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses wherePostCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereSecondLineAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAddresses whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderAddresses extends Model
{
    protected $table = 'orders_addresses';
    protected $guarded=['id'];

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }
}