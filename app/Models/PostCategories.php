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
 * App\Models\PostCategories
 *
 * @property int $post_id
 * @property int $categories_post_id
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostCategories[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\PostCategories|null $parent
 * @property-read \App\Models\Posts $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategories whereCategoriesPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategories whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategories wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategories whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostCategories extends Model
{
    protected $table = 'post_categories';

    protected $fillable = ['post_id','categories_post_id','parent_id'];

    protected $dates = ['created_at','updated_at'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }
}