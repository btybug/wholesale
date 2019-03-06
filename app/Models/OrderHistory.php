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