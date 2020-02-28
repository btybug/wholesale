<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\ItemTranslations
 *
 * @property int $id
 * @property string $name
 * @property string|null $short_description
 * @property string|null $long_description
 * @property int $items_id
 * @property string $locale
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ItemTranslations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ItemTranslations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ItemTranslations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ItemTranslations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ItemTranslations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ItemTranslations whereItemsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ItemTranslations whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ItemTranslations whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ItemTranslations whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ItemTranslations whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\ItemTranslations whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemTranslations extends Model
{
    public $timestamps = false;

    protected $table = 'item_translations';

    protected $fillable = ['name','short_name', 'short_description', 'long_description','item_id'];
}
