<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/18/2018
 * Time: 5:03 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'bty_settings';
    protected $fillable = ['sub_id','section', 'key', 'val'];

    public function updateOrCreateSettings($section, array $data,$subId=null)
    {
        $result=[];
        foreach ($data as $key=>$val){
            $val=(is_array($val))?json_encode($val,true):$val;
           if($this->where('section',$section)->where('key',$key)->where('sub_id',$subId)->exists()){
               $result[]=  $this->where('section',$section)->where('key',$key)->update(['val'=>$val]);
           }else{
               $result[]=  $this->create(['section'=>$section,'key'=>$key,'val'=>$val,'sub_id'=>$subId]);
           };
        }
        return collect($result);
    }

    public function getEditableData($section,$subId=null)
    {
        $_this = new self();
        $result=['attributes'];
        $settings=$_this->where('section',$section)->where('sub_id',$subId)->get();
        foreach ($settings as $setting){
            $_this->setAttribute($setting->key,$setting->val);
        }
        return $_this;
    }

    public function getData ($section,$key)
    {
        return $this->where('section',$section)->where('key',$key)->first();
    }
}
