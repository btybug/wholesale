<?php namespace App\Http\Controllers\Admin\Media;

/**
 * Created by PhpStorm.
 * User: Comp1
 * Date: 12/19/2016
 * Time: 2:58 PM
 */

use App\Http\Controllers\Controller;
use App\Models\Media\Folders;
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
