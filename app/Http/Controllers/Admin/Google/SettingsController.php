<?php
namespace App\ExtraModules\seo\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ExtraModules\seo\Repository\Settings;
use Illuminate\Http\Request;


class SettingsController extends Controller
{
    /**
     * SettingsController constructor.
     *
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
        $this->home = '/admin/seo/settings';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $settings = $this->settings->getSettings();

        return view("seo::settings.index", $settings);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postUpdate(Request $request)
    {
        $this->settings->updateSeoSettings($request);

        return redirect($this->home);
    }

    /**
     * Get data from robots and .htaccess and make them change able
     */
    public function getUpdateFiles()
    {
        $files_data = $this->settings->getFilesData();

        return view('seo::settings.files', $files_data);
    }

    /**
     * save files
     * @param Request $request
     */
    public function postUpdateFiles(Request $request){
        $this->settings->postFilesData($request);
        return redirect($this->home."/update-files");
    }


}
