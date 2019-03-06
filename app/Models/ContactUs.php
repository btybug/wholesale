<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 1/24/2019
 * Time: 3:12 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';
    protected $guarded = ['id'];

    public function children()
    {
        return $this->hasMany(ContactUs::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(ContactUs::class, 'parent_id');
    }

    public function recipients()
    {
        return $this->hasMany(ContactRecipients::class, 'contact_us_id');
    }
}