<?php

namespace App\Models;
use App\Models\Common\Translatable;
use App\Models\Translations\CategoryTranslation;
use App\Models\Translations\CommonTranslations;

class Common extends Translatable
{
    /**
     * @var string
     */
    protected $table = 'common';

    public $translationModel = CommonTranslations::class;

    public $translatedAttributes = ['description'];
    /**
     * @var array
     */
    protected $guarded = ['id'];
}