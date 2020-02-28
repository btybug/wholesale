<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Reply
 *
 * @property int $id
 * @property int $ticket_id
 * @property int|null $parent_id
 * @property int|null $author_id
 * @property string $reply
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $childrenAll
 * @property-read int|null $children_all_count
 * @property-read \App\Models\Reply|null $parent
 * @property-read \App\Models\Ticket $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply main()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply mainAll()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Reply extends Model
{
    protected $table = 'replies';

    protected $guarded = ['id'];

    public function scopeMain($query){
        return $query->whereNull('parent_id')->where('status', true);
    }

    public function scopeMainAll($query){
        return $query->whereNull('parent_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->where('status', true)->orderBy('created_at','desc');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function childrenAll()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('created_at','desc');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
