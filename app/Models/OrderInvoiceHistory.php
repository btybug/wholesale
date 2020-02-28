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
 * App\Models\OrderInvoiceHistory
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
 * @property-read \App\Models\OrderInvoice $order
 * @property-read \App\Models\Statuses $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceHistory whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceHistory whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceHistory whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderInvoiceHistory whereUserId($value)
 * @mixin \Eloquent
 */
class OrderInvoiceHistory extends Model
{
    protected $table = 'order_invoice_history';

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
        return $this->belongsTo(OrderInvoice::class, 'order_id');
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
