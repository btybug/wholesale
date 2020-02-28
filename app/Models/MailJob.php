<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/24/2018
 * Time: 11:07 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MailJob
 *
 * @property int $id
 * @property int $status
 * @property string|null $to
 * @property int $template_id
 * @property string|null $sent_at
 * @property string|null $must_be_done
 * @property string|null $log
 * @property array|null $additional_data
 * @property int $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MailTemplates $email
 * @property-read mixed $object
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob whereAdditionalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob whereMustBeDone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MailJob whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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