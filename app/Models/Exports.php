<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Exports
 *
 * @property int $id
 * @property int $customer_id
 * @property int $status
 * @property string $site_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $delivery_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ExportsItems[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exports newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exports newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exports query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exports whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exports whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exports whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exports whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exports whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exports whereSiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exports whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exports whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Exports extends Model
{
    protected $table = 'exports';
    protected $fillable = ['shop_id', 'status', 'site_id','notes','delivery_date'];
    protected $dates = ['created_at', 'updated_at', 'delivery_date'];
    public static $status = [
        'Pending','Shipped','Delivered','Canceled','lost'
    ];


    public function items()
    {
        return $this->hasMany(ExportsItems::class, 'export_id');

    }

    public function getPrice()
    {
        $sum=0;
        foreach ($this->items as $item){
            $sum+= $item->qty*$item->price;
        }
        return $sum;
    }

}
