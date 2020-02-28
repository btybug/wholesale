<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\PostsTranslation;
use App\User;

/**
 * App\Models\Posts
 *
 * @property int $id
 * @property string|null $url
 * @property int $user_id
 * @property int $status
 * @property string|null $tags
 * @property string|null $image
 * @property array|null $gallery
 * @property int $comment_enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read mixed $keywords
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SeoPosts[] $seo
 * @property-read int|null $seo_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stock[] $stocks
 * @property-read int|null $stocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\PostsTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts whereCommentEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts whereGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class Posts extends Translatable
{
    const APPROVED = 1;

    protected $table = 'posts';

    public $translationModel = PostsTranslation::class;

    protected $guarded = ['id'];

    protected $casts = [
        'gallery' => 'json'
    ];
    protected $appends = array('keywords');

    public function scopeActive($query)
    {
        return $query->where('status', self::APPROVED);
    }

    public function getKeywordsAttribute()
    {
        $keywords = '';
        $tags = @json_decode($this->tags, true);
        if ($tags) {
            $tags = array_filter($tags);
            foreach ($tags as $key => $value) {
                $keywords .= ((count($tags) == ($key)) ? '' : ',') . $value;
            }
        }
        return $keywords;
    }

    public $translatedAttributes = ['title', 'short_description', 'long_description','url'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'section_id', 'id')
            ->where('section','posts');
    }

    public function approvedComments()
    {
        return $this->comments()->whereNull('parent_id')->where('status', self::APPROVED)
            ->orderBy('created_at', 'desc')->where('section','posts')->get();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'categories_post_id')
            ->where('categories.type','posts');
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'post_stocks', 'post_id', 'stock_id');
    }

    public function seo()
    {
        return $this->hasOne(SeoPosts::class, 'post_id');
    }

    public function getSeoField($name, $type = 'general')
    {
        $seo = $this->seo;
        return ($seo) ? $seo->{$name} : null;
    }
}
