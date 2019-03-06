<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/2/2018
 * Time: 10:08 PM
 */

namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

class StatusesTranslations extends Model
{
    protected $table = 'statuses_translations';
    public $timestamps = false;
    protected $fillable = ['name','description'];
}