<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/1/2018
 * Time: 1:37 PM
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\FooterLinkTranslation;
use App\Models\Translations\ItemTranslations;

class FooterLinks extends Translatable
{
    protected $table = 'footer_links';
    protected $guarded = ['id'];
    public $translationModel = FooterLinkTranslation::class;
    public $translatedAttributes = ['title'];

    public function children()
    {
        return $this->hasMany(FooterLinks::class, 'parent_id')->leftJoin('footer_links_translations','footer_links.id','=','footer_links_translations.footer_links_id')->
        select('footer_links.*','footer_links_translations.title','footer_links_translations.locale');
    }
}