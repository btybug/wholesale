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
