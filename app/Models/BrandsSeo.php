<?php


namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\BrandsSeoTranslations;


class BrandsSeo extends Translatable
{
    protected $table = 'brands_seo';

    public $translatedAttributes = ['keyword', 'title', 'description','image','fb_title','fb_description','fb_image','twitter_title','twitter_description','twitter_image'];

    protected $guarded = ['id'];

    public $translationModel = BrandsSeoTranslations::class;
}
