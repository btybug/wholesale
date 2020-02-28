<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 1/24/2019
 * Time: 3:12 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContactUs
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $message
 * @property string $category
 * @property string $uniq_id
 * @property string|null $gmail_id
 * @property int $cron_status
 * @property int $is_readed
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContactUs[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\ContactUs|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContactRecipients[] $recipients
 * @property-read int|null $recipients_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereCronStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereGmailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereIsReaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereUniqId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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