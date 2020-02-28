<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/26/2018
 * Time: 10:39 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemsTransfers
 *
 * @property int $id
 * @property int $user_id
 * @property int $item_id
 * @property int $from_id
 * @property int $to_id
 * @property int $qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ItemsLocations $from
 * @property-read \App\Models\Items $item
 * @property-read \App\Models\ItemsLocations $to
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsTransfers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsTransfers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsTransfers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsTransfers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsTransfers whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsTransfers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsTransfers whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsTransfers whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsTransfers whereToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsTransfers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsTransfers whereUserId($value)
 * @mixin \Eloquent
 */
class ItemsTransfers extends Model
{
    protected $table = 'item_transfers';
    protected $guarded=['id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function item()
    {
        return $this->belongsTo(Items::class,'item_id');
    }

    public function from()
    {
        return $this->belongsTo(ItemsLocations::class,'from_id');
    }

    public function to()
    {
        return $this->belongsTo(ItemsLocations::class,'to_id');
    }

}
