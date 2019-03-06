<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

class FooterLinkTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'footer_links_translations';
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['title','footer_links_id','locale'];
}