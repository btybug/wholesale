<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/12/2018
 * Time: 11:08 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

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