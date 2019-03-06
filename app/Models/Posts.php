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

    public $translatedAttributes = ['title', 'short_description', 'long_description'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function approvedComments()
    {
        return $this->comments()->whereNull('parent_id')->where('status', self::APPROVED)->orderBy('created_at', 'desc')->get();
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
        return $this->hasMany(SeoPosts::class, 'post_id');
    }

    public function getSeoField($name, $type = 'general')
    {
        $seo = $this->seo()->where('name', $name)->where('type', $type)->first();
        return ($seo) ? $seo->content : null;
    }
}
