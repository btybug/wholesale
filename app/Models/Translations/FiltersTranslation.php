<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

class FiltersTranslation extends Model
{
    protected $table = 'filters_translations';
    public $timestamps = false;
    protected $fillable = ['name','first_child_label'];
}
