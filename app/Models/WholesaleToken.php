<?php


namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class WholesaleToken extends Model
{
    protected $table = 'wholesale_token';

    protected $fillable = ['user_id', 'token_type', 'expires_in', 'access_token', 'refresh_token'];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
