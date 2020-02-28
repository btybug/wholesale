<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\MailTemplatesTranslations;

/**
 * App\Models\MailTemplates
 *
 * @property int $id
 * @property string $slug
 * @property string $from
 * @property string|null $to
 * @property string|null $cc
 * @property string|null $module
 * @property int $is_active
 * @property int|null $category_id
 * @property int $is_for_admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\MailTemplatesTranslations[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates whereCc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates whereIsForAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailTemplates whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class MailTemplates extends Translatable
{
    /**
     * @var string
     */
    protected $table = 'mail_templates';
    /**
     * @var array
     */
    public $translationModel = MailTemplatesTranslations::class;
    protected $fillable = ['from','to','cc','module','subject','is_active','slug','is_for_admin'];
    public $translatedAttributes = ['title', 'subject', 'content'];
    public static $types=[
        'registration'=>'Registration',
        'email_confirmation'=>'Email Confirmation',
        'new_post'=>'New Post',
        'order'=>'Order'];
}
