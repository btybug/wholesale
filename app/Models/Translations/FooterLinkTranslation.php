<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\FooterLinkTranslation
 *
 * @property int $id
 * @property int $footer_links_id
 * @property string|null $title
 * @property string $locale
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FooterLinkTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FooterLinkTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FooterLinkTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FooterLinkTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FooterLinkTranslation whereFooterLinksId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FooterLinkTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FooterLinkTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FooterLinkTranslation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FooterLinkTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FooterLinkTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'footer_links_translations';
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['title','footer_links_id','locale'];
}