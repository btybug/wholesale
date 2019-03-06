<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/6/2018
 * Time: 8:35 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SeoPosts extends Model
{
    protected $table = 'post_seo';
    protected $guarded = ['id'];
}