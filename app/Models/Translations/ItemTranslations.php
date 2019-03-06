<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ItemTranslations extends Model
{
    public $timestamps = false;

    protected $table = 'item_translations';

    protected $fillable = ['name', 'short_description', 'long_description','item_id'];
}
