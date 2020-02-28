<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/22/2018
 * Time: 10:23 PM
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\TaxRateTranslation;

/**
 * App\Models\TaxRates
 *
 * @property int $id
 * @property int $is_active
 * @property string|null $icon
 * @property float $amount
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\TaxRateTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaxRates newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaxRates newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaxRates query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaxRates whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaxRates whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaxRates whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaxRates whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaxRates whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaxRates whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaxRates whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class TaxRates extends Translatable
{
    protected $table = 'tax_rates';

    public $translationModel = TaxRateTranslation::class;

    public $translatedAttributes = ['name', 'description'];
    /**
     * @var array
     */
    protected $guarded = ['id'];
}