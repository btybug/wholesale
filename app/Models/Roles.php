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