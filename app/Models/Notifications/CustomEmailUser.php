<?php

namespace App\Models\Notifications;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Notifications\CustomEmailUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $custom_email_id
 * @property int $status
 * @property int $is_read
 * @property string|null $log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Notifications\CustomEmails $email
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmailUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmailUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmailUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmailUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmailUser whereCustomEmailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmailUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmailUser whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmailUser whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmailUser whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmailUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Notifications\CustomEmailUser whereUserId($value)
 * @mixin \Eloquent
 */
class CustomEmailUser extends Model
{
    protected $table = 'custom_email_user';

    protected $guarded=['id'];

    public function email()
    {
        return $this->belongsTo(CustomEmails::class,'custom_email_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}