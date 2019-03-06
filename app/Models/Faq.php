<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\FaqTranslations;
use App\User;

class Faq extends Translatable
{
    protected $table = 'faq';

    public $translationModel = FaqTranslations::class;

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
            foreach ($tags as $key => $value) {
                $keywords .= ((count($tags) == ($key)) ? '' : ',') . $value;
            }
        }
        return $keywords;
    }

    public $translatedAttributes = ['question', 'answer'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'faq_categories', 'faq_id', 'categories_id')
            ->where('categories.type','faq');
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'faq_stocks', 'faq_id', 'stock_id');
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
