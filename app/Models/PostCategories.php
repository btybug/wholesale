<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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