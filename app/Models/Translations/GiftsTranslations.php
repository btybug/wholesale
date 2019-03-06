<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class GiftsTranslations extends Model
{
    protected $table = 'gifts_translations';
    public $timestamps = false;
    protected $fillable = ['title'];
}