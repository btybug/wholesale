<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\StatusesTranslations;

/**
 * App\Models\Statuses
 *
 * @property int $id
 * @property string $icon
 * @property string $color
 * @property string $type
 * @property int $is_default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\StatusesTranslations[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statuses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statuses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statuses query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statuses whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statuses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statuses whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statuses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statuses whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statuses whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statuses whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class Statuses extends Translatable
{
    /**
     * @var string
     */
    protected $table = 'statuses';
    /**
     * @var array
     */
    public $translationModel = StatusesTranslations::class;
    protected $fillable = ['icon', 'color', 'type'];
    public $translatedAttributes = ['name', 'description'];

}