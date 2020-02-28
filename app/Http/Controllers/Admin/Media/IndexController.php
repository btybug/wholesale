<?php namespace App\Http\Controllers\Admin\Media;

/**
 * Created by PhpStorm.
 * User: Comp1
 * Date: 12/19/2016
 * Time: 2:58 PM
 */

use App\Http\Controllers\Controller;
use App\Models\Media\Folders;
use App\Models\Media\Items;
use App\Models\Media\Settings;
use App\Modules\Media\Plugins\Drive\Autoload;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function index($name='drive')
    {
        $folder=Folders::where('name',$name)->where('parent_id',0)->first(['id','name']);
        $settings = [];
        return view('media.index', compact('settings','folder'));
    }

    public function fixfiles()
    {
        $root = public_path('media/drive');
        $files = \File::allFiles($root);
        $chunk = (array_chunk($files, 50, true));
        foreach ($chunk as $key => $files) {
            $key = $key + 1;
            \File::makeDirectory(public_path('media/drive/' . $key));
            foreach ($files as $file) {
                $filename = $file->getFilename();
                $item = Items::where('original_name', $filename)->update(['original_folder' => $key]);
                \File::move($file->getPath() . DS . $filename, public_path('media/drive/' . $key . DS . $filename));
            }
        }
        dd('done');
    }

    public function cleanMedia()
    {
        $items=Items::all();
        $mediaPath=public_path('media'.DS.'drive');
        $mediaPathTmb=public_path('media'.DS.'tmp');
        $mediaPathOld=public_path('media_old'.DS.'drive');
        $mediaPathOldTmb=public_path('media_old'.DS.'tmp');
        foreach ($items as $item){
            if($item->original_folder){
                if(!\File::isDirectory($mediaPath.DS.$item->original_folder)){
                    \File::makeDirectory($mediaPath.DS.$item->original_folder);
                }

                if (\File::exists($mediaPathOld.DS.$item->original_folder.DS.$item->original_name)){
                    \File::copy($mediaPathOld.DS.$item->original_folder.DS.$item->original_name,$mediaPath.DS.$item->original_folder.DS.$item->original_name);
                    if (\File::exists($mediaPathOldTmb.DS.$item->original_name)){
                        \File::copy($mediaPathOldTmb.DS.$item->original_name,$mediaPathTmb.DS.$item->original_name);
                    }

                }
            }else{
                $item->delete();
            }
        }
        dd('done');
    }

    public function fixDb()
    {

        $tables = \DB::select('SHOW TABLES');
        $property = 'Tables_in_' . env('DB_DATABASE');
        foreach ($tables as $table) {
            $tableName = $table->$property;
            $columns = \DB::getSchemaBuilder()->getColumnListing($tableName);
            $index = array_search('image', $columns);
            if ($index) {
              $objects=  \DB::table($tableName)->whereNotNull('image')->get();
             foreach ($objects as $object){
                 $originalName=(collect(explode('/',$object->image))->last());
                 $image=Items::where('original_name',$originalName)->first();
                 if($image){
                     \DB::table($tableName)->where('id',$object->id)->update(['image'=> $image->url]);
                 }
             }
           };
        }
        dd('done');

    }
    public function fixDbAgain()
    {

        $tables = \DB::select('SHOW TABLES');
        $property = 'Tables_in_' . env('DB_DATABASE');
        foreach ($tables as $table) {
            $tableName = $table->$property;
            $columns = \DB::getSchemaBuilder()->getColumnListing($tableName);
            $index = array_search('image', $columns);
            if ($index) {
              $objects=  \DB::table($tableName)->whereNotNull('image')->get();
             foreach ($objects as $object){
                 \DB::table($tableName)->where('id',$object->id)->update(['image'=>str_replace('https://kaliony.bootydev.co.uk','',$object->image)]);

             }
           };
        }
        dd('done');

    }

    public function html()
    {
        $settings = [];
        return view('media.html', compact('settings'));
    }

    public function trash()
    {
        $settings = [];
        return view('media.trash', compact('settings'));
    }

    public function getSettings()
    {
        $uploaders = CmsItemReader::getAllGearsByType('units')
            ->where('place', 'backend')
            ->where('type', 'media')
            ->run();
        $uploaders = $uploaders ? $uploaders->pluck('title', 'slug') : NULL;
        $settings = $this->settings->getSettingsBySection('folder_settings')
            ? $this->settings->getSettingsBySection('folder_settings')->pluck('val', 'settingkey')
            : null;
        return view('Drive::settings', compact(['uploaders', 'settings']));
    }

    public function postSettings(Request $request)
    {
        $validator = \Validator::make($request->except('_token'), [
            'directory_default_max_size' => 'required',
            'directory_default_extension' => 'required',
            'directory_default_uploader' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }

        $this->settings->updateSystemSettings($request->except('_token'), 'folder_settings');
        return redirect()->back()->with('message', 'Settings has been stored successfully.');
    }


    public function getMigrate()
    {
        $autoload = new Autoload();
        $autoload->up([]);
    }
}
