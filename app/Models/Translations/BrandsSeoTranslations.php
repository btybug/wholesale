<?php


namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;


class BrandsSeoTranslations extends Model
{
    protected $table = 'brands_seo_translations';
    public $timestamps = false;
    protected $fillable = ['keyword', 'title', 'description','image','fb_title','fb_description','fb_image','twitter_title','twitter_description','twitter_image'];

}
