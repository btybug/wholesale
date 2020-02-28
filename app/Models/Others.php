<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/28/2018
 * Time: 10:24 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Others
 *
 * @property int $id
 * @property int $item_id
 * @property int $user_id
 * @property int|null $parent_id
 * @property int $qty
 * @property string $reason
 * @property string|null $notes
 * @property string $grouped
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Others[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Items $item
 * @property-read \App\Models\Others|null $parent
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others whereGrouped($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Others whereUserId($value)
 * @mixin \Eloquent
 */
class Others extends Model
{
    protected $table = 'others';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function item()
    {
       return $this->belongsTo(Items::class,'item_id');
    }

    public function parent()
    {
        return $this->belongsTo(Others::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Others::class,'parent_id');
    }
}