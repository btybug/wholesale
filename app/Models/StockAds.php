<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class StockAds extends Model
{
    /**
     * @var string
     */
    protected $table = 'stock_ads';
    /**
     * @var array
     */
    protected $fillable = [
        'stock_id', 'image', 'url', 'tags'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}
