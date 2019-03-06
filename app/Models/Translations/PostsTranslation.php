<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class PostsTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'posts_translations';

    protected $fillable = ['title', 'short_description', 'long_description'];
}
