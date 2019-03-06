<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/8/2018
 * Time: 4:30 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    protected $table = 'emails';
    protected $guarded = ['id'];
}