<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

class WarehouseTranslations extends Model
{
    protected $table = 'warehouse_translations';
    public $timestamps = false;
    protected $fillable = ['name','description', 'address'];
}
