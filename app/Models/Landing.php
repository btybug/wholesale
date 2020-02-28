<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 1/24/2019
 * Time: 3:12 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Landing
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landing query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landing whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landing whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Landing whereUrl($value)
 * @mixin \Eloquent
 */
class Landing extends Model
{
    protected $table = 'landings';
    protected $guarded = ['id'];
}
