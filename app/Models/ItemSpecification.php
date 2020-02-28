<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemSpecification
 *
 * @property int $id
 * @property int $item_id
 * @property int $attributes_id
 * @property int|null $sticker_id
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Attributes $attr
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemSpecification[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Items $item
 * @property-read \App\Models\ItemSpecification|null $parent
 * @property-read \App\Models\Stickers|null $sticker
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSpecification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSpecification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSpecification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSpecification whereAttributesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSpecification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSpecification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSpecification whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSpecification whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSpecification whereStickerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemSpecification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemSpecification extends Model
{
    protected $table = 'item_specifications';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }

    public function attr()
    {
        return $this->belongsTo(Attributes::class, 'attributes_id');
    }

    public function sticker()
    {
        return $this->belongsTo(Stickers::class, 'sticker_id');
    }
}
