<?php

namespace App\Models;

use App\Models\Common\Translatable;
use App\Models\Translations\WarehouseRackTranslations;
use App\Models\Translations\WarehouseTranslations;

/**
 * App\Models\WarehouseRacks
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $warehouse_id
 * @property string|null $slug
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_default
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WarehouseRacks[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemsLocations[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\WarehouseRacks|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\WarehouseRackTranslations[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WarehouseRacks newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WarehouseRacks newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WarehouseRacks query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WarehouseRacks whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WarehouseRacks whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WarehouseRacks whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WarehouseRacks whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WarehouseRacks whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WarehouseRacks whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WarehouseRacks whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WarehouseRacks whereWarehouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class WarehouseRacks extends Translatable
{
    /**
     * @var string
     */

    protected $table = 'warehouse_racks';

    public $translationModel = WarehouseRackTranslations::class;

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

    public function items()
    {
       return $this->hasMany(ItemsLocations::class,'rack_id');
    }
}
