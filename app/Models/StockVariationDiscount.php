<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockVariationDiscount extends Model
{
    protected $table = 'stock_variation_discounts';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];

    public function variation()
    {
        return $this->belongsTo(StockVariation::class, 'variation_id');
    }
}
