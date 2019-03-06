<?php

namespace App\Models;


use App\Models\Newsletter;
use App\Models\Notifications\CustomEmails;
use App\User;
use Illuminate\Database\Eloquent\Model;

class NewsletterJob extends Model
{
    protected $table = 'newsletter_jobs';

    protected $guarded=['id'];

    public function email()
    {
        return $this->belongsTo(CustomEmails::class,'custom_email_id','id');
    }

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class,'newsletter_id','id');
    }
}