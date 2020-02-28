<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12/26/2018
 * Time: 1:46 PM
 */

namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\CustomEmailsTranslations
 *
 * @property int $id
 * @property int $custom_emails_id
 * @property string $subject
 * @property string $content
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CustomEmailsTranslations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CustomEmailsTranslations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CustomEmailsTranslations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CustomEmailsTranslations whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CustomEmailsTranslations whereCustomEmailsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CustomEmailsTranslations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CustomEmailsTranslations whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\CustomEmailsTranslations whereSubject($value)
 * @mixin \Eloquent
 */
class CustomEmailsTranslations extends Model
{
    protected $table = 'custom_emails_translations';
    public $timestamps = false;
    protected $fillable = ['subject','content','custom_emails_id'];
}