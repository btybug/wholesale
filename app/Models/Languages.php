<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    protected $table = 'languages';
    public $timestamps = false;

    protected $guarded = ['id'];
}