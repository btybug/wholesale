<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;


class History extends Model
{
    protected $table = 'history';

    protected $guarded = ['id'];

    public function tickets()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'actor_id','id');
    }
}