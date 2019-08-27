<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 1/25/2019
 * Time: 12:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class GmailController extends Controller
{
    protected $view = 'admin.gamil';

    public function index()
    {
        return $this->view('index');
    }

    public function callBack(Request $request)
    {
        dd($request->all());
    }

    public function settings(Settings $settings)
    {
        return $this->view('settings');
    }

    public function postSettings(Request $request, Settings $settings)
    {
        try {
            $data = $request->only(['GOOGLE_PROJECT_ID', 'GOOGLE_CLIENT_ID', 'GOOGLE_CLIENT_SECRET', 'GOOGLE_REDIRECT_URI']);
            $path = base_path('.env');
            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    'GOOGLE_PROJECT_ID=' . env('GOOGLE_PROJECT_ID'), 'GOOGLE_PROJECT_ID=' . $data['GOOGLE_PROJECT_ID'], file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'GOOGLE_CLIENT_ID=' . env('GOOGLE_CLIENT_ID'), 'GOOGLE_CLIENT_ID=' . $data['GOOGLE_CLIENT_ID'], file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'GOOGLE_CLIENT_SECRET=' . env('GOOGLE_CLIENT_SECRET'), 'GOOGLE_CLIENT_SECRET=' . $data['GOOGLE_CLIENT_SECRET'], file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'GOOGLE_REDIRECT_URI=' . env('GOOGLE_REDIRECT_URI'), 'GOOGLE_REDIRECT_URI=' . $data['GOOGLE_REDIRECT_URI'], file_get_contents($path)
                ));
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with(['alert' => ['message' => $exception->getMessage(), 'class' => 'danger']]);
        }
        return redirect()->back();
    }
}
