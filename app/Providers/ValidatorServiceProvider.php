<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class ValidatorServiceProvider extends ServiceProvider {

    public function boot(\Illuminate\Validation\Factory $validator)
    {
//        $this->app['validator']->extend('murad', function ()
//        {
//
//            return false;
//        });
        \Validator::extend(
            'recaptcha',
            'App\\Validators\\ReCaptcha@validate'
        );
        $validator->extend(
            'uniqueWhitColume',
            function ($attribute, $value, $parameters)
            {
                $result=DB::table($parameters[0])
                    ->where($parameters[1],$value)
                    ->where($parameters[2],$parameters[3])->first();
                if($result!=Null){
                    return false;
                }
                return true;

            }
        );
        $validator->extend(
            'uniqueExceptSelf',
            function ($attribute, $value, $parameters)
            {
                $result=DB::table($parameters[0])
                    ->where($parameters[1],$value)
                    ->where($parameters[2],$parameters[3])->first();

                if($result==Null ){
                    return true;
                }
                if($result!=Null && $result->id == $parameters[5]){
                    return true;
                }

                return FALSE;
            }
        );
        $validator->extend(
            'exists_except',
            function ($attribute, $value, $parameters)
            {
               return DB::table($parameters[0])
                    ->where($parameters[1],$value)
                    ->where($parameters[2],'!=',$parameters[3])->exists();
            }
        );
    }

    public function register()
    {
        //
    }

}