<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\CouriersTranslations
 *
 * @property int $id
 * @property int $couriers_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CouriersTranslations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CouriersTranslations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CouriersTranslations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CouriersTranslations whereCouriersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CouriersTranslations whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CouriersTranslations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CouriersTranslations whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CouriersTranslations whereName($value)
 * @mixin \Eloquent
 */
class CouriersTranslations extends Model
{
    protected $table = 'courier_translations';
    public $timestamps = false;
    protected $fillable = ['name', 'description'];
}