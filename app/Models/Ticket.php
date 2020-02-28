<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property int $user_id
 * @property int $author_id
 * @property int $status_id
 * @property int $category_id
 * @property int $priority_id
 * @property int|null $staff_id
 * @property int|null $product_id
 * @property int|null $order_id
 * @property string $subject
 * @property string $summary
 * @property array|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TicketFiles[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \App\User $author
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\History[] $history
 * @property-read int|null $history_count
 * @property-read \App\Models\Orders $order
 * @property-read \App\Models\Statuses $priority
 * @property-read \App\Models\Stock $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $replies
 * @property-read int|null $replies_count
 * @property-read \App\User|null $staff
 * @property-read \App\Models\Statuses $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket wherePriorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereUserId($value)
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    protected $table = 'tickets';
    /**
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
      'tags' => 'json'
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class, 'ticket_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(TicketFiles::class,  'ticket_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class,'staff_id','id');
    }

    public function status()
    {
        return $this->hasOne(Statuses::class,'id','status_id');
    }

    public function priority()
    {
        return $this->hasOne(Statuses::class,'id','priority_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function history()
    {
        return $this->morphMany(History::class, 'tickets', 'reference_table', 'reference_id');
    }

    public function product()
    {
        return $this->hasOne(Stock::class,'id','product_id');
    }

    public function order()
    {
        return $this->hasOne(Orders::class,'id','order_id');
    }
}
