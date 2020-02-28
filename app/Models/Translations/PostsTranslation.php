<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\PostsTranslation
 *
 * @property int $id
 * @property int $posts_id
 * @property string $locale
 * @property string $title
 * @property string|null $short_description
 * @property string|null $long_description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\PostsTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\PostsTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\PostsTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\PostsTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\PostsTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\PostsTranslation whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\PostsTranslation wherePostsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\PostsTranslation whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\PostsTranslation whereTitle($value)
 * @mixin \Eloquent
 */
class PostsTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'posts_translations';

    protected $fillable = ['title', 'short_description', 'long_description','url'];
}
