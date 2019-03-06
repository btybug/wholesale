<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

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