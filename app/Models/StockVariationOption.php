<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockVariationOption extends Model
{
    protected $table = 'stock_variation_options';

    protected $fillable = ['variation_id','attribute_sticker_id'];

    protected $dates = ['created_at','updated_at'];

    public function variation()
    {
        return $this->belongsTo(StockVariation::class, 'variation_id');
    }

    public function attribute_sticker()
    {
        return $this->belongsTo(AttributeStickers::class, 'attribute_sticker_id');
    }
}