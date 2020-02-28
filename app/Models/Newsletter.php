<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Newsletter
 *
 * @property int $id
 * @property string $email
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $category_id
 * @property-read \App\Models\Category|null $category
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Newsletter whereUserId($value)
 * @mixin \Eloquent
 */
class Newsletter extends Model
{
    /**
     * @var string
     */
    protected $table = 'newsletters';
    /**
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}