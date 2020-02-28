<?php

namespace App\Models;


use App\Models\Newsletter;
use App\Models\Notifications\CustomEmails;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NewsletterJob
 *
 * @property int $id
 * @property int $newsletter_id
 * @property int $custom_email_id
 * @property int $status
 * @property string|null $log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Notifications\CustomEmails $email
 * @property-read \App\Models\Newsletter $newsletter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsletterJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsletterJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsletterJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsletterJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsletterJob whereCustomEmailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsletterJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsletterJob whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsletterJob whereNewsletterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsletterJob whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsletterJob whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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