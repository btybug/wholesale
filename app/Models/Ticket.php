<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

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
