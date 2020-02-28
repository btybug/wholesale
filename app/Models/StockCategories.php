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
 * App\Models\StockCategories
 *
 * @property int $stock_id
 * @property int $categories_id
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockCategories[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\StockCategories|null $parent
 * @property-read \App\Models\Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockCategories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockCategories whereCategoriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockCategories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockCategories whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockCategories whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockCategories whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StockCategories extends Model
{
    protected $table = 'stock_categories';

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

    public function category()
    {
        return $this->belongsTo(Category::class,'categories_id');
    }
}
