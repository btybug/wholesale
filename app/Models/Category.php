<?php

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\CategoryTranslation;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int $user_id
 * @property string|null $slug
 * @property string|null $image
 * @property string|null $icon
 * @property string|null $classes
 * @property string $type
 * @property int $is_core
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stock[] $brandProducts
 * @property-read int|null $brand_products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Faq[] $faqs
 * @property-read int|null $faqs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stock[] $filter_products
 * @property-read int|null $filter_products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Filters[] $filters
 * @property-read int|null $filters_count
 * @property-read \App\Models\Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stock[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stickers[] $stickers
 * @property-read int|null $stickers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stock[] $stocks
 * @property-read int|null $stocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\CategoryTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereClasses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereIsCore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class Category extends Translatable
{
    /**
     * @var string
     */
    const JUICE_ID = 3;

    protected $table = 'categories';

    public $translationModel = CategoryTranslation::class;

    public $translatedAttributes = ['name', 'description'];
    /**
     * @var array
     */
    protected $guarded = ['id'];

//    public static function boot()
//    {
//
//        parent::boot();
//        self::callBoot();
//    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function seo()
    {
        return $this->hasOne(BrandsSeo::class);
    }
    public function getSeoField($name, $type = 'general')
    {
        $seo = $this->seo;
        return ($seo) ? $seo->{$name} : null;
    }

    public static function recursiveItems($iems, $i = 0, $data = [], $selected = [])
    {
        if (count($iems)) {
            $item = $iems[$i];
            $data[$i] = [
                'id' => $item->id,
                'name' => $item->name,
                'text' => $item->name,
                'parent_id' => $item->parent_id,
                "state" => false,
                'children' => []
            ];

            if (count($selected) && in_array($item->id, $selected)) {
                $data[$i]['state'] = ['selected' => true];
            }

            if (count($item->children)) {
                $data[$i]['children'] = self::recursiveItems($item->children, 0, $data[$i]['children'], $selected);
            }

            $i = $i + 1;
            if ($i != count($iems)) {
                $data = self::recursiveItems($iems, $i, $data, $selected);
            }

            return $data;
        }
    }

    public function stickers()
    {
        return $this->belongsToMany(Stickers::class, 'category_stickers', 'categories_id', 'sticker_id');
    }

    public function products()
    {
        return $this->belongsToMany(Stock::class, 'stock_categories', 'categories_id', 'stock_id');
    }

    public function filter_products()
    {
        return $this->belongsToMany(Stock::class, 'stock_filters', 'categories_id', 'stock_id');
    }

    public function faqs()
    {
        return $this->belongsToMany(Faq::class, 'faq_categories', 'categories_id', 'faq_id');
    }

    public function filters()
    {
        return $this->hasMany(Filters::class, 'category_id');
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'stock_categories', 'categories_id', 'stock_id');
    }
}
