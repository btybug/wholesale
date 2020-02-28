<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemCategories
 *
 * @property int $item_id
 * @property int $categories_id
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategories whereCategoriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategories whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategories whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCategories whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemCategories extends Model
{
    protected $table = 'item_categories';


    public function category()
    {
       return $this->belongsTo(Category::class,'categories_id');
    }

}
