<?php


namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\BrandsTranslation;

class Brands extends Translatable
{
    protected $table = 'brands';

    protected $guarded=['id'];

    public $translationModel = BrandsTranslation::class;

    public $translatedAttributes = ['name', 'description'];

    public function stickers()
    {
        return $this->belongsToMany(Stickers::class,'brand_stickers','brand_id','sticker_id');
    }

    public function products()
    {
        return $this->hasMany(Stock::class,'brand_id');
    }
}
