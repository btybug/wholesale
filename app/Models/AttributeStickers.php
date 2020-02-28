<?php

namespace App\Models;


use App\Models\Translations\AttributeTranslation;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AttributeStickers
 *
 * @property int $id
 * @property int $attributes_id
 * @property int $sticker_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Attributes $attr
 * @property-read \App\Models\Stickers $sticker
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttributeStickers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttributeStickers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttributeStickers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttributeStickers whereAttributesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttributeStickers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttributeStickers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttributeStickers whereStickerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttributeStickers whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AttributeStickers extends Model
{
    /**
     * @var string
     */
    protected $table = 'attributes_stickers';
    /**
     * @var array
     */
    protected $guarded = ['id'];

    public function attr()
    {
        return $this->belongsTo(Attributes::class, 'attributes_id');
    }

    public function sticker()
    {
        return $this->belongsTo(Stickers::class, 'sticker_id');
    }
}