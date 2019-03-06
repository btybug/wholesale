<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class FaqTranslations extends Model
{
    public $timestamps = false;

    protected $table = 'faq_translations';

    protected $fillable = ['answer', 'question'];
}
