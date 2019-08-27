<?php
/**
 * Created by PhpStorm.
 * User: Comp1
 * Date: 12/19/2016
 * Time: 4:33 PM
 */

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Items extends Model
{
    public $types = [
        'image' => ['jpg', 'png', 'jpeg', 'gif'],
        'video' => ['avi', 'mp4'],
        'document' => ['txt', 'xls'],
        'archive' => ['zip', 'rar']
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'drive_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    /**
     * The attributes which using Carbon.
     *
     * @var array
     */
    protected $appends = array('type', 'url', 'relativeUrl', 'key');
    protected $dates = ['created_at', 'updated_at'];

    public function getKeyAttribute()
    {
        return $this->id;
    }

    public static function migrate()
    {
        \Schema::create('drive_items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('original_name')
                ->index('drive_items_original_name');
            $table->string('real_name')
                ->index('drive_items_real_name');
            $table->string('extension')
                ->index('drive_items_extension');
            $table->string('size');
            $table->integer('folder_id')->unsigned();
            $table->timestamps();
            $table->foreign('folder_id')
                ->references('id')
                ->on('drive_folders')
                ->onDelete('cascade');
        });
    }

    public static function removeItem($data)
    {
        if ($data['trash']) {
            $trash = Folders::where('name', 'trash')->first();
            $data['folder_id'] = $trash->id;
            return self::sort($data);
        } else {
            if (is_array($data['item_id'])) {
                return self::whereIn('id', $data['item_id'])->delete();
            }
            return self::find($data['item_id'])->delete();
        }
    }

    public static function sort($data)
    {

        if (is_array($data['item_id'])) {
            $items = self::whereIn('id', $data['item_id'])->get();
            foreach ($items as $item) {
                self::transfer($item->id, $data['folder_id']);

            }
            return $items->toArray();
        }
        $item = self::transfer($data['item_id'], $data['folder_id']);
        if ($item) {
            return $item->toArray();
        }
    }

    public static function copy($item_id)
    {
        $item = self::find($item_id);

        if ($item) {
            $originalName = md5(uniqid()) . '.' . $item->extension;
            $realName = str_replace('.' . $item->extension, '_copy.' . $item->extension, $item->real_name);
            $newItem = $item->replicate();
            $newItem->original_name = $originalName; // the new project_id
            $newItem->real_name = $realName; // the new project_id
            if ($newItem->save()) {
                $folder = Folders::find($item->folder_id);
                if ($folder && \File::isDirectory($folder->path())) {
                    if (\File::copy($item->url, $folder->path() . DS . $originalName))
                        return false;
                }
            }
        }

        return true;
    }

    public static function transfer($item_id, $folder_id)
    {
        $item = self::find($item_id);
        $folder = Folders::find($folder_id);
        if ($item) {
            if ($folder && \File::isDirectory($folder->path())) {
                $oldFolder = $item->storage;
                if (\File::exists($oldFolder->url($item->original_name, false))) {
                    if (\File::copy($oldFolder->url($item->original_name, false), $folder->path() . DS . $item->original_name))
                        $item->folder_id = $folder_id;
                    if ($item->save()) {
                        unlink($oldFolder->url($item->original_name, false));
                        return $item;
                    }
                } else {
                    return $item->delete();
                }

            }
        }

        return false;
    }

    public function getTypeAttribute()
    {
        return $this->typeCheker();
    }

    public function typeCheker()
    {
        $types = $this->typeArrayMaker();
        if (isset($types[$this->extension])) {
            return $types[$this->extension];
        }
        return false;

    }

    public function typeArrayMaker()
    {
        $types = array();
        foreach ($this->types as $key => $value) {
            foreach ($value as $ext) {
                $types[$ext] = $key;
            }
        }
        return $types;
    }

    public function getUrlAttribute()
    {
        return $this->storage->url() . '/' . $this->original_name;
    }

    public function getRelativeUrlAttribute()
    {
        return str_replace('http://' . $_SERVER['SERVER_NAME'], '', $this->storage->url()) . '/' . $this->original_name;
    }

    public function storage()
    {
        return $this->belongsTo('App\Models\Media\Folders', 'folder_id');
    }
//[
//{"title": "Some title 1", "description": "Some desc 1", "content": "My content"},
//{"title": "Confirm email", "description": "Some desc 2", "url": "{!! url('admin/mail-templates/confirm_email') !!}"}
//]
    public static function TinyMceTemplates()
    {
        $templates=self::where('extension','html')->where('folder_id','!=',Folders::where('name','trash')->first()->id)->get();
        $result=[];
        foreach($templates as $template){
            $result[]=["title"=>$template->real_name, "description"=>$template->seo_description, "url"=>$template->url];
        }
        return json_encode($result);
    }
}
