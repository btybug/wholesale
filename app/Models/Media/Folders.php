<?php
/**
 * Copyright (c) 2016.
 * *
 *  * Created by PhpStorm.
 *  * User: Sahak
 *  * Date: 10/3/2016
 *  * Time: 10:44 PM
 *
 */

namespace App\Models\Media;

use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class Folders
 * @package App\Models\Media
 */
class Folders extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'drive_folders';
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
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $appends = ['title', 'childrenCount', 'itemsCount', 'text', 'folder', 'url', 'key'];

    /**
     * @return int
     */
    public function getChildrenCountAttribute()
    {
        return $this->children()->count();
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrlAttribute()
    {
        return $this->url();
    }

    /**
     * @return mixed
     */
    public function getKeyAttribute()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTextAttribute()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getFolderAttribute()
    {
        return true;
    }

    /**
     * @return int
     */
    public function getItemsCountAttribute()
    {
        return $this->items()->count();
    }

    /**
     *
     */
    public static function migrate()
    {
        return \Schema::create('drive_folders', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->index('drive_folders_name');
            $table->string('prefix')->nullable();
            $table->integer('parent_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     *
     */
    public static function seed()
    {

        return self::create([
            'id' => 1,
            'name' => 'drive',
            'parent_id' => 0,
        ]);
    }

    /**
     * @return array
     */
    public static function menu()
    {
        $folders = self::where('parent_id', 0)->get();
        $menun = [];
        foreach ($folders as $folder) {
            $menun[] = [
                "title" => $folder->name,
                "custom-link" => "/admin/media/" . $folder->name,
                "icon" => "fa fa-angle-right",
                "is_core" => "yes"
            ];
        }
        return $menun;
    }

    /**
     * @param $data
     * @return bool
     */
    public static function removeFolder($data)
    {
        $id = $data['folder_id'];
        if (!$data['trash']) {
            $folder = self::find($id);
            if (File::isDirectory($folder->path())) File::deleteDirectory($folder->path());
            if ($folder->delete()) {

                return true;
            }
        } else {
            if (self::find($id)->trash()) {
                return true;
            }

        }
        return false;
    }

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();
       return static::deleting(function ($tutorial) {
            foreach ($tutorial->childs as $child) {
                $child->delete();
            }
        });
    }

    /**
     * @return mixed|string
     */
    public function getTitleAttribute()
    {
        $title = $this->name;
        if ($this->prefix) {
            $title = $title . "($this->prefix)";
        }
        return $title;

    }

    public function children()
    {
        return $this->hasMany('App\Models\Media\Folders', 'parent_id')->with('children');
    }

//Api functions

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Media\Folders', 'parent_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Media\Items', 'folder_id');
    }

    //end Api Functions

    public function getChilds($files)
    {
        $result = $this->toArray();
        $result['children'] = array_merge($this->children->toArray(), $this->itemsTmp());
        $result['url'] = $this->url();
        if ($files) {
            $result['items'] = $this->itemsTmp();
        }

        return $result;
    }

    public function itemsTmp()
    {
        $childs = $this->items;
        foreach ($childs as $key => $child) {
            if ($this->ifIsImage($child['original_name'])) {
                $childs[$key]['tmp'] = media_image_tmb($child['original_name']);
            }
        }
        return $childs;
    }

    public function ifIsImage($inage_name)
    {
        $allowed = array('.jpg', '.jpeg', '.gif', '.png', '.flv');
        return (in_array(strtolower(strrchr($inage_name, '.')), $allowed));
    }

    public function getChildren($files)
    {
        $result = $this->toArray();
        $result['children'] = $this->children->toArray();
        $result['url'] = $this->url();
        if ($files) {
            $result['items'] = $this->items->toArray();
        }

        return $result;
    }

    public function createChild($data)
    {
        $count = self::where('name', $data['folder_name'])->where('parent_id', $this->id)->count();
        if ($count) {
            $count++;

        } else {
            $count = null;

        }
        if (!File::isDirectory($this->path())) {
            $this->delete();
            return \Response::json(['error' => true, 'message' => ['invalid dir']]);
        }
        $data['settings']['slug'] = $data['folder_name'] . $this->id;

        $settings_data = $data['settings'];
        unset($data['settings']);
        $self = self::create([
                'name' => $data['folder_name'],
                'parent_id' => $this->id,
                'prefix' => $count,
            ]
        );
        $settings_data['folder_id'] = $self->id;
        $settings = Settings::create($settings_data);
        File::makeDirectory($self->path());
        File::put($self->path('.gitignore'), '');
        return \Response::json(['error' => false, 'data' => $self->toArray()]);

    }

    public function path($file = null)
    {
        $parents = \DB::select('SELECT T2.id, T2.name,T2.prefix FROM (SELECT @r AS _id,(SELECT @r := parent_id FROM drive_folders WHERE id = _id) AS parent_id, @l := @l + 1 AS lvl FROM (SELECT @r := ' . $this->id . ', @l := 0) vars, drive_folders m WHERE @r <> 0) T1 JOIN drive_folders T2 ON T1._id = T2.id ORDER BY T1.lvl DESC;');
        $path = 'media/';
        foreach ($parents as $parent) {
            $prefix = null;
            if ($parent->prefix) $prefix = "($parent->prefix)";
            $path .= $parent->name . $prefix . '/';
        }
        $path = $path . $file;
        return (public_path(rtrim($path, '/')));
    }

    public function url($file = null, $url = true)
    {
        $parents = \DB::select('SELECT T2.id, T2.name,T2.prefix FROM (SELECT @r AS _id,(SELECT @r := parent_id FROM drive_folders WHERE id = _id) AS parent_id, @l := @l + 1 AS lvl FROM (SELECT @r := ' . $this->id . ', @l := 0) vars, drive_folders m WHERE @r <> 0) T1 JOIN drive_folders T2 ON T1._id = T2.id ORDER BY T1.lvl DESC;');
        $path = ($url) ? 'public/media/' : 'public/media/';
        foreach ($parents as $parent) {
            $prefix = null;
            if ($parent->prefix) $prefix = "($parent->prefix)";
            $path .= $parent->name . $prefix . '/';
        }
        $path = $path . $file;
        return ($url == false) ? base_path(rtrim($path, '/')) : (url(rtrim($path, '/')));
    }

    public function editFolder($data)
    {
        if (isset($data['parent_id'])) {
            $parent = self::find($data['parent_id']);
            if (!$parent) return false;
        } else {
            $parent = $this->parent;
        }

        $count = self::where('name', $data['folder_name'])->where('parent_id', $parent->id)->count();
        if ($count) {
            $count++;
            $path = $parent->path . '/' . $data['folder_name'] . "($count)";
        } else {
            $count = null;
            $path = $parent->path . '/' . $data['folder_name'];
        }
        $data['settings']['slug'] = $data['folder_name'] . $parent->id;
        $settings = $this->settings()->update($data['settings']);
        unset($data['settings']);
        $self = $this->update([
            'name' => $data['folder_name'],
            'parent_id' => $this->id,
            'prefix' => $count,
            'settings_id' => $settings->id,
        ]);
        return $self->toArray();
    }

    public function settings()
    {
        return $this->hasOne('App\Models\Media\Settings', 'folder_id');
    }

    public function trash()
    {
        $trash = self::where('name', 'trash')->first();
        return self::sort(['folder_id' => $this->id, 'parent_id' => $trash->id]);
    }

    public static function sort($data)
    {
        $folder = self::find($data['folder_id']);
        $parent = self::find($data['parent_id']);

        $count = self::where('name', $folder->name)->where('parent_id', $data['parent_id'])->count();
        if ($count) {
            $count++;
        } else {
            $count = null;
        }
        $sourceDir = $folder->path();
        $success = File::copyDirectory($sourceDir, $parent->path($folder->title));
        if ($success) {
            File::deleteDirectory($sourceDir);
            $folder->parent_id = $data['parent_id'];
            $folder->prefix = $count;
            $folder->save();
            return \Response::json(['error' => false, 'data' => $folder]);
        }
    }

    public function info()
    {
        $info = $this->toArray();
        unset($info['prefix']);
        unset($info['prefix']);
        unset($info['settings_id']);
        $info['settings'] = $this->settings->toArray();
        return $info;
    }
}
