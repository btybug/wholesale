<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class StickersTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'stickers_translations';

    protected $fillable = ['name'];
}
