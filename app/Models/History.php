<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\History
 *
 * @property int $id
 * @property string $reference_table
 * @property int $reference_id
 * @property int $actor_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $tickets
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereActorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereReferenceTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class History extends Model
{
    protected $table = 'history';

    protected $guarded = ['id'];

    public function tickets()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'actor_id','id');
    }
}