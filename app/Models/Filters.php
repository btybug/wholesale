<?php

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\CategoryTranslation;
use App\Models\Translations\FiltersTranslation;

/**
 * App\Models\Filters
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $image
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Filters[] $children
 * @property-read int|null $children_count
 * @property-read mixed $path
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Items[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\FiltersTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filters newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filters query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filters whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filters whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filters whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filters whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filters whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class Filters extends Translatable
{
    /**
     * @var string
     */

    protected $table = 'filters';

    public $translationModel = FiltersTranslation::class;

    public $translatedAttributes = ['name','first_child_label'];

    protected $appends = ['path'];
    /**
     * @var array
     */
    protected $guarded = ['id'];

    public function getPathAttribute()
    {
       $parents=$this->parents();
       $name='';
       foreach ($parents as $parent){
           $name.=$parent['name'].'->';
       }
       $name.=$this->name;
       return $name;
    }

    public function items()
    {
        return $this->belongsToMany(Items::class, 'filter_items', 'filter_id', 'item_id');
    }

    public function children()
    {
        return $this->hasMany(Filters::class, 'parent_id')->with(['items','children']);
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
                'category_id' => $item->category_id,
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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function parents()
    {
        $result = [];
        $parents = \DB::select('SELECT T2.*,filters_translations.name FROM (SELECT @r AS _id,(SELECT @r := parent_id FROM filters WHERE id = _id) AS parent_id, @l := @l AS lvl FROM (SELECT @r := ' . $this->id . ', @l := 0) vars, filters m WHERE @r <> 0) T1  LEFT JOIN filters_translations ON T1._id = filters_translations.filters_id JOIN filters T2 ON T1._id = T2.id  WHERE T1._id !=' . $this->id . ' AND filters_translations.locale="'.app()->getLocale().'"  ORDER BY T1.lvl DESC;');
        foreach ($parents as $parent) {
            $parent = json_decode(json_encode($parent), True);
            $result[] = $parent;
        };
        return collect($result);
    }

    public function getParentItems()
    {
        return \DB::table('filter_items')->whereIn('filter_id', $this->parents()->pluck('id'))->get()->pluck('item_id');
    }

    public function syncChild()
    {
        return \DB::table('filter_items')->whereIn('filter_id', $this->parents()->pluck('id'))->delete();

    }

    public static function fullBrodcrumpsLists($except)
    {
        $_this = new self();
        return $_this->where('id','!=',$except)->get()->pluck('path','id');

    }

    public static function getRecursiveItems($items, $i = 0, $data = [])
    {
        if (count($items)) {
            $item = $items[$i];

            if(count($item->items)){
                foreach ($item->items as $v){
                    $data[] = $v;
                }
            }

            if (count($item->children)) {
                $data = self::getRecursiveItems($item->children, 0, $data);
            }

            $i = $i + 1;

            if ($i != count($items)) {
                $data = self::getRecursiveItems($items, $i, $data);
            }

            return $data;
        }
    }

}
