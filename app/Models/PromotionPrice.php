<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionPrice extends Model
{
    protected $table = 'promotion_prices';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];

    public function promotion()
    {
        return $this->belongsTo(Stock::class, 'promotion_id');
    }

    public function variation()
    {
        return $this->belongsTo(StockVariation::class, 'variation_id');
    }
}