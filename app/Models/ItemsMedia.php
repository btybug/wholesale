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
 * App\Models\ItemsMedia
 *
 * @property int $id
 * @property int $item_id
 * @property string $type
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Items $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsMedia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsMedia whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsMedia whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsMedia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemsMedia whereUrl($value)
 * @mixin \Eloquent
 */
class ItemsMedia extends Model
{
    protected $table = 'items_media';
    protected $guarded=['id'];

    public function item()
    {
        return $this->belongsTo(Items::class,'item_id');
    }

}