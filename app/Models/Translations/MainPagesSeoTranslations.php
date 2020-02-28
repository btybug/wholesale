<?php


namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\MainPagesSeoTranslations
 *
 * @property int $id
 * @property int $main_pages_seo_id
 * @property string $locale
 * @property string $image
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations whereMainPagesSeoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MainPagesSeoTranslations whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MainPagesSeoTranslations extends Model
{
    protected $table = 'main_pages_seo_translations';
    public $timestamps = false;
    protected $fillable = ['title', 'description', 'keywords','image'];

}
