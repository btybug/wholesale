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
use App\Models\Translations\StickersTranslation;
use App\User;

/**
 * App\Models\Stickers
 *
 * @property int $id
 * @property string $slug
 * @property string|null $image
 * @property string|null $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attributes[] $attrs
 * @property-read int|null $attrs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stock[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\StickersTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stickers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stickers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stickers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stickers whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stickers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stickers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stickers whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stickers whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stickers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class Stickers extends Translatable
{
    protected $table = 'stickers';

    public $translationModel = StickersTranslation::class;

    protected $guarded = ['id'];

    public $translatedAttributes = ['name', 'description'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_stickers', 'sticker_id', 'categories_id');
    }

    public function brands()
    {
        return $this->belongsToMany(Brands::class, 'brand_stickers', 'sticker_id', 'brand_id');
    }

    public function attrs()
    {
        return $this->belongsToMany(Attributes::class, 'attributes_stickers', 'sticker_id', 'attributes_id');
    }

    public function products()
    {
        return $this->belongsToMany(Stock::class, 'stock_stickers', 'sticker_id', 'stock_id');
    }

    public static function getById($id, $col = 'name')
    {
        $attribute = self::find($id);
        return ($attribute && isset($attribute->{$col})) ? $attribute->{$col} : null;
    }
}
