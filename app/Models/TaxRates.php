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