<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

class AttributeTranslation extends Model
{
    protected $table = 'attributes_translations';
    public $timestamps = false;
    protected $fillable = ['name'];
}