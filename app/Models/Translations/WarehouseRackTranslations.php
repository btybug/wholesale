<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

class WarehouseRackTranslations extends Model
{
    protected $table = 'warehouse_rack_translations';
    public $timestamps = false;
    protected $fillable = ['name','description'];
}
