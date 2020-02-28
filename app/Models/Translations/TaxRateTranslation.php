<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\TaxRateTranslation
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $tax_rates_id
 * @property string $locale
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\TaxRateTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\TaxRateTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\TaxRateTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\TaxRateTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\TaxRateTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\TaxRateTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\TaxRateTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\TaxRateTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\TaxRateTranslation whereTaxRatesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\TaxRateTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TaxRateTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'tax_rate_translations';
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['name','description'];
}