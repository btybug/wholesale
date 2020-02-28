<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\AttributeTranslation
 *
 * @property int $id
 * @property int $attributes_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\AttributeTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\AttributeTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\AttributeTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\AttributeTranslation whereAttributesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\AttributeTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\AttributeTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\AttributeTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\AttributeTranslation whereName($value)
 * @mixin \Eloquent
 */
class AttributeTranslation extends Model
{
    protected $table = 'attributes_translations';
    public $timestamps = false;
    protected $fillable = ['name','description'];
}
