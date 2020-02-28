<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\CommonTranslations
 *
 * @property int $id
 * @property string $description
 * @property int $common_id
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CommonTranslations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CommonTranslations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CommonTranslations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CommonTranslations whereCommonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CommonTranslations whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CommonTranslations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CommonTranslations whereLocale($value)
 * @mixin \Eloquent
 */
class CommonTranslations extends Model
{
    protected $table = 'common_translations';
    public $timestamps = false;
    protected $fillable = ['description'];
}