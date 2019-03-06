<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/27/2018
 * Time: 9:19 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $table = 'suppliers';
    protected $guarded = ['id'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'supplier_id');
    }
}