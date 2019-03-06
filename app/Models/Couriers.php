<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/20/2018
 * Time: 9:41 PM
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\CouriersTranslations;

class Couriers extends Translatable
{
    /**
     * @var string
     */
    protected $table = 'couriers';
    /**
     * @var array
     */
    public $translationModel = CouriersTranslations::class;
    protected $fillable = ['icon', 'image'];
    public $translatedAttributes = ['name', 'description'];
}