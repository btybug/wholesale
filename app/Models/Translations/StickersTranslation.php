<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\StickersTranslation
 *
 * @property int $id
 * @property int $stickers_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StickersTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StickersTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StickersTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StickersTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StickersTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StickersTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StickersTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StickersTranslation whereStickersId($value)
 * @mixin \Eloquent
 */
class StickersTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'stickers_translations';

    protected $fillable = ['name','description'];
}
