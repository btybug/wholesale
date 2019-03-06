<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/15/2018
 * Time: 4:45 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    protected $table = 'favorites';
    protected $fillable = ['user_id', 'variation_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function variation()
    {
        return $this->belongsTo(StockVariation::class,'variation_id');
    }
}