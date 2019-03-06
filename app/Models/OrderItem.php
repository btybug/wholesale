<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $guarded=['id'];

    protected $casts = [
        'options' => 'json',
        'additional_data' => 'json',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }

    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }

    public function required_items()
    {
        return $this->hasMany(self::class,'parent_id','id')->where('type','required');
    }

    public function optional_items()
    {
        return $this->hasMany(self::class,'parent_id','id')->where('type','optional');
    }
}