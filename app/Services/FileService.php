<?php namespace App\Services;

use Illuminate\Support\Facades\Storage;
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/18/2018
 * Time: 1:01 PM
 */
class FileService
{
    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    private $audio_ext = ['mp3', 'ogg', 'mpga'];
    private $video_ext = ['mp4', 'mpeg'];
    private $document_ext = ['doc', 'docx', 'pdf', 'odt'];

    public function validate($data,$rules)
    {
        $validator = validator($data,$rules);

        if($validator->fails()){
            return $validator->errors();
        }else{
            return false;
        }
    }

    public function saveFiles($model,$file){
        $ext = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $type = $this->getType($ext);
        $name = uniqid();
        $path = '/public/' . \Auth::id() . '/' . $type;

        if (Storage::putFileAs('/public/' . \Auth::id() . '/' . $type . '/', $file, $name . '.' . $ext)) {
            return $model->create([
                'name' => $name,
                'original_name' => $originalName,
                'path' => $path,
                'type' => $type,
                'extension' => $ext,
                'user_id' => \Auth::id()
            ]);
        }
    }

    public function getType($ext)
    {
        if (in_array($ext, $this->image_ext)) {
            return 'image';
        }

        if (in_array($ext, $this->audio_ext)) {
            return 'audio';
        }

        if (in_array($ext, $this->video_ext)) {
            return 'video';
        }

        if (in_array($ext, $this->document_ext)) {
            return 'document';
        }
    }

    public function allExtensions()
    {
        return array_merge($this->image_ext, $this->audio_ext, $this->video_ext, $this->document_ext);
    }
}