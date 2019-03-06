<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SiteLanguages extends Model
{
    protected $table = 'site_languages';
    public $timestamps = false;

    protected $guarded = ['id'];

    public function getTranslations(){

        if(! \File::exists("resources/lang/$this->code.json")){
            \File::put("resources/lang/$this->code.json",json_encode([]));
        }

        $data = json_decode( \File::get("resources/lang/$this->code.json"),true);
        return $data;
    }
}