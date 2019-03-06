<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/28/2018
 * Time: 10:24 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Others extends Model
{
    protected $table = 'others';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function item()
    {
       return $this->belongsTo(Items::class,'item_id');
    }

    public function parent()
    {
        return $this->belongsTo(Others::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Others::class,'parent_id');
    }
}