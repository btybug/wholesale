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
 * App\Models\Purchase
 *
 * @property int $id
 * @property int $user_id
 * @property int $item_id
 * @property int $supplier_id
 * @property string|null $invoice_number
 * @property int $qty
 * @property string|null $purchase_date
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $warehouse_id
 * @property int|null $rack_id
 * @property int|null $shelve_id
 * @property-read \App\Models\Items $item
 * @property-read \App\Models\Suppliers $supplier
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereRackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereShelveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Purchase whereWarehouseId($value)
 * @mixin \Eloquent
 */
class Purchase extends Model
{
    /**
     * @var string
     */
    protected $table = 'purchases';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
}
