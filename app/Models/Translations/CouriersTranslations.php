<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class CouriersTranslations extends Model
{
    protected $table = 'courier_translations';
    public $timestamps = false;
    protected $fillable = ['name', 'description'];
}