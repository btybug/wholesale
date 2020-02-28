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
 * App\Models\OrderInvoiceAddresses
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
 * @property-read \App\Models\OrderInvoice $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereFirstLineAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses wherePostCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereSecondLineAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceAddresses whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderInvoiceAddresses extends Model
{
    protected $table = 'order_invoice_addresses';
    protected $guarded=['id'];

    public function order()
    {
        return $this->belongsTo(OrderInvoice::class,'order_id');
    }
}
