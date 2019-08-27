<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockVariation extends Model
{
    protected $table = 'stock_variations';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];

    public function scopeRequired($query)
    {
        return $query->where('is_required', 1);
    }

    public function scopeExtra($query)
    {
        return $query->where('is_required', 0);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function options()
    {
        return $this->hasMany(StockVariationOption::class, 'variation_id');
    }

    public function discounts()
    {
        return $this->hasMany(StockVariationDiscount::class, 'variation_id');
    }

    public function sale()
    {
        return $this->hasOne(StockSales::class, 'variation_id');
    }

    public function filter()
    {
        return $this->hasOne(Category::class, 'id','filter_category_id');
    }

    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }
}
