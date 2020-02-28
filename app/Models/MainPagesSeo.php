<?php


namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\MainPagesSeoTranslations;

/**
 * App\Models\MainPagesSeo
 *
 * @property int $id
 * @property string $page_name
 * @property int $robots
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\MainPagesSeoTranslations[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPagesSeo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPagesSeo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPagesSeo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPagesSeo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPagesSeo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPagesSeo wherePageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPagesSeo whereRobots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPagesSeo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class MainPagesSeo extends Translatable
{
    protected $table = 'main_pages_seo';

    public $translatedAttributes = ['title', 'description', 'keywords','image'];

    protected $guarded = ['id'];

    public $translationModel = MainPagesSeoTranslations::class;
}
