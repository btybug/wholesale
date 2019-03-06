<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\StatusesTranslations;

class Statuses extends Translatable
{
    /**
     * @var string
     */
    protected $table = 'statuses';
    /**
     * @var array
     */
    public $translationModel = StatusesTranslations::class;
    protected $fillable = ['icon', 'color', 'type'];
    public $translatedAttributes = ['name', 'description'];

}