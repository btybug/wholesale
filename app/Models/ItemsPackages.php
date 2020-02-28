<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/26/2018
 * Time: 10:39 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemsPackages
 *
 * @property int $id
 * @property int $item_id
 * @property string|null $name
 * @property int $package_item_id
 * @property int|null $qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Items $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsPackages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsPackages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsPackages query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsPackages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsPackages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsPackages whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsPackages whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsPackages wherePackageItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsPackages whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsPackages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemsPackages extends Model
{
    protected $table = 'item_packages';
    protected $guarded=['id'];

    public function item()
    {
        return $this->belongsTo(Items::class,'item_id');
    }

}
