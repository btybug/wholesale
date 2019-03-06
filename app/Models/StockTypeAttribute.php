<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTypeAttribute extends Model
{
    protected $table = 'stock_type_attributes';

    protected $fillable = ['stock_id','attributes_id', 'sticker_id','type'];

    protected $dates = ['created_at','updated_at'];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function attr()
    {
        return $this->belongsTo(Attributes::class, 'attributes_id');
    }

    public function sticker()
    {
        return $this->belongsTo(Stickers::class, 'sticker_id');
    }
}