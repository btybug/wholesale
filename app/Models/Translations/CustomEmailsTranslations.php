<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12/26/2018
 * Time: 1:46 PM
 */

namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

class CustomEmailsTranslations extends Model
{
    protected $table = 'custom_emails_translations';
    public $timestamps = false;
    protected $fillable = ['subject','content','custom_emails_id'];
}