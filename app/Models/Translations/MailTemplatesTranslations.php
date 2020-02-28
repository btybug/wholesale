<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\MailTemplatesTranslations
 *
 * @property int $id
 * @property int $mail_templates_id
 * @property string $subject
 * @property string $content
 * @property string $locale
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MailTemplatesTranslations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MailTemplatesTranslations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MailTemplatesTranslations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MailTemplatesTranslations whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MailTemplatesTranslations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MailTemplatesTranslations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MailTemplatesTranslations whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MailTemplatesTranslations whereMailTemplatesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MailTemplatesTranslations whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\MailTemplatesTranslations whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MailTemplatesTranslations extends Model
{
    protected $table = 'mail_templates_translations';
    public $timestamps = false;
    protected $fillable = ['title', 'subject','content'];
}