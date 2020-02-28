<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\FaqTranslations
 *
 * @property int $id
 * @property int $faq_id
 * @property string $locale
 * @property string $question
 * @property string|null $answer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FaqTranslations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FaqTranslations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FaqTranslations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FaqTranslations whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FaqTranslations whereFaqId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FaqTranslations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FaqTranslations whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FaqTranslations whereQuestion($value)
 * @mixin \Eloquent
 */
class FaqTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'faq_translations';

    protected $fillable = ['answer', 'question','slug'];
}
