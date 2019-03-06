<?php
namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $guarded=['id'];

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}