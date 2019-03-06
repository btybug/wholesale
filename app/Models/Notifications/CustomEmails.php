<?php

namespace App\Models\Notifications;

use App\Models\Category;
use App\Models\Common\Translatable;
use App\Models\Translations\CustomEmailsTranslations;
use App\User;

/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12/26/2018
 * Time: 1:27 PM
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