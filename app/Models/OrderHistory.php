<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/1/2018
 * Time: 8:48 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderHistory
 *
 * @property int $id
 * @property int $order_id
 * @property int|null $user_id
 * @property int|null $status_id
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $admin
 * @property-read mixed $color
 * @property-read \App\Models\Orders $order
 * @property-read \App\Models\Statuses $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderHistory whereUserId($value)
 * @mixin \Eloquent
 */
class OrderHistory extends Model
{
    protected $table = 'order_history';

    protected $guarded = ['id'];
    protected $appends = array('color');

    public function getColorAttribute()
    {
        $color = '';
        switch ($this->status) {
            case 'submitted':
                $color = 'order-notes_message-status-1';
                break;
            case 'pending':
                $color = 'order-notes_message-status-2';
                break;
            case 'processing':
                $color = 'order-notes_message-status-2';
                break;
        }
        return $color;
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    public function status()
    {
        return $this->hasOne(Statuses::class, 'id','status_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}