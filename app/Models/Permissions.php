<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/12/2018
 * Time: 11:08 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Permissions
 *
 * @property int $id
 * @property string $slug
 * @property string $type
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Roles[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permissions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permissions extends Model
{
 protected $table='permissions';

    protected $fillable = [
        'slug', 'type','description'
    ];

    public function roles()
    {
        return $this->belongsToMany(Roles::class,'role_permission','permission_id','role_id');
    }
}