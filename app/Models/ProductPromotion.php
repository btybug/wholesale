<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPromotion extends Model
{
    protected $table = 'product_promotions';

    protected $guarded = ['id'];

    protected $dates = ['created_at','updated_at'];


}