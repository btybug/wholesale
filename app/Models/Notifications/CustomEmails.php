<?php

namespace App\Models\Notifications;

use App\Models\Category;
use App\Models\Common\Translatable;
use App\Models\Translations\CustomEmailsTranslations;
use App\User;

/**
 * Created by PhpStorm.
 * 
 * User: sahak
 * Date: 12/26/2018
 * Time: 1:27 PM
 *
 * @property int $id
 * @property string $from
 * @property string $type
 * @property int $status
 * @property int|null $category_id
 * @property int|null $coupon_id
 * @property int $is_for_admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Notifications\CustomEmails $admin
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Notifications\CustomEmailUser[] $custom_email_users
 * @property-read int|null $custom_email_users_count
 * @property-read mixed $object
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\CustomEmailsTranslations[] $languages
 * @property-read int|null $languages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\CustomEmailsTranslations[] $translations
 * @property-read int|null $translations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails whereIsForAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class CustomEmails extends Translatable
{

    protected $table='custom_emails';

    protected $guarded = ['id'];
    public $translationModel = CustomEmailsTranslations::class;
    public $translatedAttributes = ['subject', 'content'];
    protected $appends = array('object');

    public function getObjectAttribute()
    {
       return 'custom_emails';
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'custom_email_user','custom_email_id');
    }

    public function languages()
    {
        return $this->hasMany(CustomEmailsTranslations::class,'custom_emails_id');
    }

    public function custom_email_users()
    {
        return $this->hasMany(CustomEmailUser::class,'custom_email_id');
    }

    public function admin()
    {
        return $this->hasOne(CustomEmails::class,'parent_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
}