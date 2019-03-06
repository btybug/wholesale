<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/22/2018
 * Time: 5:14 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    protected $table = 'currencies';
    protected $guarded = ['id'];
}