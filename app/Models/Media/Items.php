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

/**
 * App\Models\Media\Items
 *
 * @property int $id
 * @property string $original_name
 * @property string $real_name
 * @property string $extension
 * @property string $size
 * @property int $folder_id
 * @property string|null $seo_keywords
 * @property string|null $seo_caption
 * @property string|null $seo_description
 * @property string|null $seo_alt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $key
 * @property-read mixed $relative_url
 * @property-read mixed $type
 * @property-read mixed $url
 * @property-read \App\Models\Media\Folders $storage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereFolderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereSeoAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereSeoCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Media\Items whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        if (isset($data['trash']) && $data['trash']) {
            $trash = Folders::where('name', 'trash')->first();
            $data['folder_id'] = $trash->id;
            return self::sort($data);
        } else {
            if (is_array($data['item_id'])) {
                foreach ($data['item_id'] as $id){
                    $i=self::find($id);
                    if (\File::exists($i->path()))
                    \File::delete($i->path());

                }
                if (\File::exists(media_image_tmb_path($i->url))){
                    \File::delete(media_image_tmb_path($i->url));
                }

                return self::whereIn('id', $data['item_id'])->delete();
            }
            $i = self::find($data['item_id']);
            if (\File::exists($i->path())) {
                \File::delete($i->path());
            }
            return self::where('id', $data['item_id'])->delete();
        }
    }

    public static function emptyTrash()
    {
        $trash = Folders::where('name', 'trash')->first();
        $items['item_id'] = $trash->items->pluck('id')->toArray();
        return self::removeItem($items);

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
            $folder = Folders::find($item->folder_id);
            $uploadPath=$folder->uploadPath();
            $originalName = md5(uniqid()) . '.' . $item->extension;
            $realName = str_replace('.' . $item->extension, '_copy.' . $item->extension, $item->real_name);
            $newItem = $item->replicate();
            $newItem->original_name = $originalName; // the new project_id
            $newItem->real_name = $realName; // the new project_id
            $newItem->original_folder = $uploadPath['folder'];
            if ($newItem->save()) {
                if ($folder) {
                    if (\File::copy($item->url, $uploadPath['path'] . DS . $originalName))
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
        if ($item && $folder) {
            $item->folder_id = $folder_id;
            if ($item->save()) {
                return $item;
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
        return url('/public/media/drive/' . $this->original_folder . '/' . $this->original_name);
    }

    public function getRelativeUrlAttribute()
    {
        return '/public/media/drive/' . $this->original_folder . '/' . $this->original_name;
    }

    public function storage()
    {
        return $this->belongsTo(Folders::class, 'folder_id');
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

    public function path()
    {
        return public_path('media' . DS . 'drive' . DS . $this->original_folder . DS . $this->original_name);
    }
}
