<?php

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\AttributeTranslation;
use phpDocumentor\Reflection\Types\Self_;

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

        return $attrs->get();
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
