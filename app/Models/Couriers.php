<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/20/2018
 * Time: 9:41 PM
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\CouriersTranslations;

/**
 * App\Models\Couriers
 *
 * @property int $id
 * @property string $icon
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\CouriersTranslations[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Couriers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Couriers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Couriers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Couriers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Couriers whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Couriers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Couriers whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Couriers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class Couriers extends Translatable
{
    /**
     * @var string
     */
    protected $table = 'couriers';
    /**
     * @var array
     */
    public $translationModel = CouriersTranslations::class;
    protected $fillable = ['icon', 'image'];
    public $translatedAttributes = ['name', 'description'];
}