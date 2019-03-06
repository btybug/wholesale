<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\GiftsTranslations;
use App\Models\Translations\MailTemplatesTranslations;

class Gifts extends Translatable
{
    /**
     * @var string
     */
    protected $table = 'gifts';
    /**
     * @var array
     */
    public $translationModel = GiftsTranslations::class;
    protected $fillable = ['start_date', 'end_date', 'based_on', 'product_id', 'product_count', 'cart_amount', 'promo_code', 'free_juices_count', 'choice_type'];
    public $translatedAttributes = ['title'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}