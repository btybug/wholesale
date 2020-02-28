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

/**
 * App\Models\FooterLinks
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FooterLinks[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\FooterLinkTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FooterLinks newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FooterLinks newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FooterLinks query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FooterLinks whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FooterLinks whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FooterLinks whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FooterLinks whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FooterLinks whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
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