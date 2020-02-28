<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 1/28/2019
 * Time: 9:20 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContactRecipients
 *
 * @property int $id
 * @property int $contact_us_id
 * @property string $name
 * @property string $email
 * @property int $is_readed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ContactUs $mail
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactRecipients newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactRecipients newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactRecipients query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactRecipients whereContactUsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactRecipients whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactRecipients whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactRecipients whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactRecipients whereIsReaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactRecipients whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactRecipients whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactRecipients extends Model
{
    protected $table = 'contact_recipients';
    protected $guarded = ['id'];

    public function mail()
    {
        return $this->belongsTo(ContactUs::class,'contact_us_id');
    }
}