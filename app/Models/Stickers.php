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

class Stickers extends Translatable
{
    protected $table = 'stickers';

    public $translationModel = StickersTranslation::class;

    protected $guarded = ['id'];

    public $translatedAttributes = ['name'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_stickers', 'sticker_id', 'categories_id');
    }

    public static function getById($id,$col = 'name')
    {
        $attribute = self::find($id);
        return ($attribute && isset($attribute->{$col})) ? $attribute->{$col} : null;
    }
}
