<?php

namespace App\Models\Notifications;


use App\User;
use Illuminate\Database\Eloquent\Model;

class CustomEmailUser extends Model
{
    protected $table = 'custom_email_user';

    protected $guarded=['id'];

    public function email()
    {
        return $this->belongsTo(CustomEmails::class,'custom_email_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}