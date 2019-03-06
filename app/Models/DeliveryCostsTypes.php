<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/20/2018
 * Time: 8:53 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DeliveryCostsTypes extends Model
{
    protected $table = 'delivery_cost_types';
    protected $fillable = ['title'];
}