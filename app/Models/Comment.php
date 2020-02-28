<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $post_id
 * @property int|null $parent_id
 * @property int|null $author_id
 * @property string $comment
 * @property int $status
 * @property string|null $guest_name
 * @property string|null $guest_email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $childrenAll
 * @property-read int|null $children_all_count
 * @property-read \App\Models\Comment|null $parent
 * @property-read \App\Models\Posts $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment main()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment mainAll()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereGuestEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereGuestName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    protected $table = 'comments';

    protected $guarded = ['id'];

    public function scopeMain($query){
        return $query->whereNull('parent_id')->where('status', true)->orderBy('created_at','desc');
    }

    public function scopeMainAll($query){
        return $query->whereNull('parent_id')->orderBy('created_at','desc');
    }

    public function post()
    {
        return $this->belongsTo(Posts::class, 'section_id', 'id')->where('section','posts');
    }

    public function faq()
    {
        return $this->belongsTo(Faq::class, 'section_id', 'id')->where('section','faq');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')
            ->where('status', true)->orderBy('created_at','desc');
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
