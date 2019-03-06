<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/24/2018
 * Time: 11:07 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GiftQuery extends Model
{
    protected $table = 'gift_query';
    protected $fillable = ['gift_id','column', 'condition', 'needle'];

    public function gift()
    {
        return $this->belongsTo(Gifts::class,'gift_id');
    }
}