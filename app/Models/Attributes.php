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

    public $translatedAttributes = ['name'];
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

    public static function getById($id,$col = 'name')
    {
        $attribute = self::find($id);
        return ($attribute && isset($attribute->{$col})) ? $attribute->{$col} : null;
    }

    public function stickers()
    {
        return $this->belongsToMany(Stickers::class, 'attributes_stickers', 'attributes_id','sticker_id');
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
}