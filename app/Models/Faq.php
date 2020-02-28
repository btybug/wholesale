<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\FaqTranslation;
use App\Models\Translations\FaqTranslations;
use App\User;

/**
 * App\Models\Faq
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string|null $tags
 * @property array|null $gallery
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed $keywords
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SeoPosts[] $seo
 * @property-read int|null $seo_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stock[] $stocks
 * @property-read int|null $stocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\FaqTranslations[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class Faq extends Translatable
{
    protected $table = 'faq';

    public $translationModel = FaqTranslation::class;

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

    public $translatedAttributes = ['question', 'answer','slug'];

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
        return $this->hasOne(SeoPosts::class, 'post_id');
    }

    public function getSeoField($name, $type = 'general')
    {
        $seo = $this->seo;
        return ($seo) ? $seo->{$name} : null;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'section_id', 'id')
            ->where('section','faq');
    }
}
