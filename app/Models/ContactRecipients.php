<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 1/28/2019
 * Time: 9:20 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ContactRecipients extends Model
{
    protected $table = 'contact_recipients';
    protected $guarded = ['id'];

    public function mail()
    {
        return $this->belongsTo(ContactUs::class,'contact_us_id');
    }
}