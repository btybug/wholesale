<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Barcodes extends Model
{
    protected $table = 'barcodes';
    protected $fillable=['code'];

    public function item()
    {
        return $this->hasOne(Items::class,'barcode_id');
    }
}
