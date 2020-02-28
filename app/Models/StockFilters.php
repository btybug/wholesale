<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StockFilters
 *
 * @property int $stock_id
 * @property int $categories_id
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockFilters[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\StockFilters|null $parent
 * @property-read \App\Models\Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockFilters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockFilters newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockFilters query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockFilters whereCategoriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockFilters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockFilters whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockFilters whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockFilters whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StockFilters extends Model
{
    protected $table = 'stock_filters';

    protected $fillable = ['stock_id','categories_id','parent_id'];

    protected $dates = ['created_at','updated_at'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}
