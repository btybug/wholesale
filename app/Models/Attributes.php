<?php

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\AttributeTranslation;
use phpDocumentor\Reflection\Types\Self_;

/**
 * App\Models\Attributes
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int $user_id
 * @property string|null $image
 * @property string|null $icon
 * @property int $filter
 * @property int $is_core
 * @property string $display_as
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attributes[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Attributes|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stickers[] $stickers
 * @property-read int|null $stickers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\AttributeTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes whereDisplayAs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes whereFilter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes whereIsCore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attributes whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class Attributes extends Translatable
{
    /**
     * @var string
     */
    protected $table = 'attributes';

    public $translationModel = AttributeTranslation::class;

    public $translatedAttributes = ['name','description'];
    /**
     * @var array
     */
    protected $guarded = ['id'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public static function getById($id, $col = 'name')
    {
        $attribute = self::find($id);
        return ($attribute && isset($attribute->{$col})) ? $attribute->{$col} : null;
    }

    public function stickers()
    {
        return $this->belongsToMany(Stickers::class, 'attributes_stickers', 'attributes_id', 'sticker_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'attribute_categories', 'attribute_id', 'categories_id')
            ->where('categories.type', 'stocks');
    }

    public static function recursiveItems($iems, $i = 0, $data = [])
    {
        if (count($iems)) {
            $item = $iems[$i];
            $data[$i] = [
                'id' => $item->id,
                'name' => $item->name,
                'parent_id' => $item->parent_id,
                'children' => []
            ];

            if (count($item->children)) {
                $data[$i]['children'] = self::recursiveItems($item->children, 0, $data[$i]['children']);
            }

            $i = $i + 1;
            if ($i != count($iems)) {
                $data = self::recursiveItems($iems, $i, $data);
            }

            return $data;
        }
    }

    public function getFiltersByCategory($slug)
    {
        $lang = \Lang::getLocale();

        $attrs = Attributes::leftJoin('attributes_translations', 'attributes.id', '=', 'attributes_translations.attributes_id')
            ->leftJoin("attribute_categories", 'attributes.id', '=', 'attribute_categories.attribute_id')
            ->leftJoin("categories", 'attribute_categories.categories_id', '=', 'categories.id')
            ->select('attributes.*', 'attributes_translations.name')
            ->where('attributes.filter', true)
            ->where('attributes_translations.locale', $lang)
            ->where('categories.type', 'stocks');
        if ($slug) {
            $attrs = $attrs->where('categories.slug', $slug);
        }

        return $attrs->groupBy('attributes.id')->get();
    }

    public function getFiltersByOffer($slug)
    {
        $lang = \Lang::getLocale();

        $attrs = Attributes::leftJoin('attributes_translations', 'attributes.id', '=', 'attributes_translations.attributes_id')
            ->leftJoin("attribute_categories", 'attributes.id', '=', 'attribute_categories.attribute_id')
            ->leftJoin("categories", 'attribute_categories.categories_id', '=', 'categories.id')
            ->select('attributes.*', 'attributes_translations.name')
            ->where('attributes.filter', true)
            ->where('attributes_translations.locale', $lang)
            ->where('categories.type', 'offers');
        if ($slug) {
            $attrs = $attrs->where('categories.slug', $slug);
        }

        return $attrs->get();
    }
}
