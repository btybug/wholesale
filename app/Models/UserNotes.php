<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserNotes
 *
 * @property int $id
 * @property int $user_id
 * @property int $author_id
 * @property string $title
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $author
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotes whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotes whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotes whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserNotes whereUserId($value)
 * @mixin \Eloquent
 */
class UserNotes extends Model
{
    /**
     * @var string
     */
    protected $table = 'user_notes';
    /**
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

}
