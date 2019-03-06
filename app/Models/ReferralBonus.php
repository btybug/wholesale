<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 2/6/2019
 * Time: 10:30 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class ReferralBonus extends Model
{
    protected $table = 'referral_bonus';

    protected $guarded=['id'];

    public function recipient()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}