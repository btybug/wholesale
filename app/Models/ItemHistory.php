<?php


namespace App\Models;


use App\Models\Common\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class ItemHistory extends Model
{
    use ModelTrait;

    protected $table = 'item_history';

    public $guarded = ['id'];

    public function to()
    {
        return $this->belongsTo(Shops::class, 'to_id', 'id');
    }

    public function from()
    {
        return $this->belongsTo(Shops::class, 'from_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Items::class,'item_id');
    }
}
