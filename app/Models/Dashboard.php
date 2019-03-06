<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/27/2018
 * Time: 9:30 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'dashboard';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}