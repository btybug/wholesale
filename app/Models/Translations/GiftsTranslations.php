<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\GiftsTranslations
 *
 * @property int $id
 * @property int $gifts_id
 * @property string $locale
 * @property string $title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GiftsTranslations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GiftsTranslations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GiftsTranslations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GiftsTranslations whereGiftsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GiftsTranslations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GiftsTranslations whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GiftsTranslations whereTitle($value)
 * @mixin \Eloquent
 */
class GiftsTranslations extends Model
{
    protected $table = 'gifts_translations';
    public $timestamps = false;
    protected $fillable = ['title'];
}