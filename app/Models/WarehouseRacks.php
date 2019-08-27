<?php

namespace App\Models;

use App\Models\Common\Translatable;
use App\Models\Translations\WarehouseRackTranslations;
use App\Models\Translations\WarehouseTranslations;

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
}
