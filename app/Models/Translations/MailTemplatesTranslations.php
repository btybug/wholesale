<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class MailTemplatesTranslations extends Model
{
    protected $table = 'mail_templates_translations';
    public $timestamps = false;
    protected $fillable = ['title', 'subject','content'];
}