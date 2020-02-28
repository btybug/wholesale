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
 * App\Models\Roles
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $type
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permissions[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Roles whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Roles extends Model
{
    /**
     * @var string
     */
    protected $table = 'roles';
    /**
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'type', 'description'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'role_permission', 'permission_id', 'role_id');
    }

    public function can($route)
    {
        if ($route=='admin_dashboard') return true;
        $permissions=$this->permissions()->pluck('slug');
        foreach ($permissions as $permission){
            $config=config('permissions.'.$permission,[]);
            if(in_array($route,$config))return true;
        }
       return false;
    }

    public function hasAccess($slug)
    {
        return $this->permissions()->where('type','has_access')->where('slug',$slug)->exists();
    }

    public function users()
    {
        return $this->hasMany(User::class,'role_id');
    }
}
