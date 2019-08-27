<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ExportsItems extends Model
{
    protected $table='export_items';
    protected $fillable = ['item_id','qty','export_id','status','price','note'];

    public function import()
    {
        return $this->belongsTo(Exports::class,'export_id');
    }
    public function parent()
    {
        return $this->belongsTo(Items::class,'item_id');
    }



}
