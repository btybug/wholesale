<?php

namespace App\Models\Common;


use Illuminate\Database\Eloquent\Model;

class Translatable extends Model
{
    use \Dimsav\Translatable\Translatable;

    public static function updateOrCreate(int $id = null, array $data,array $translations = [])
    {
        $model = self::find($id)??new static();
        $translatableData = (count($translations)) ? $translations :\Request::get('translatable',[]);
        (isset($model->id)) ? $model->update($data) : $model->fill($data) ;

        if ($translatableData && count($translatableData)) {

            foreach ($translatableData as $locale => $translateData) {

                //here need check locales later
                if (count($translateData)) {
                    foreach ($translateData as $column => $translate) {
                        if ($translate) {
                            $model->translateOrNew($locale)->{$column} = ($translate);
                        }
                    }
                }
            }
        }
        $model->save();
        return $model;
    }
}
