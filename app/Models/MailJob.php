<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/24/2018
 * Time: 11:07 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MailJob extends Model
{
    protected $table = 'mail_job';
    protected $fillable = ['status', 'to', 'template_id', 'sent_at', 'must_be_done', 'log', 'additional_data'];
    protected $casts = [
        'additional_data' => 'json',
    ];
    protected $appends = array('object');

    public function getObjectAttribute()
    {
        return 'mail_job';
    }

    public function email()
    {
        return $this->belongsTo(MailTemplates::class, 'template_id');
    }
}