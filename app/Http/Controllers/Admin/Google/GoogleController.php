<?php
/**
 * Created by PhpStorm.
 * User: Sahak
 * Date: 8/10/2016
 * Time: 1:57 PM
 */

namespace App\Http\Controllers\Admin\Google;

use App\Services\google\GoogleAnalyticsAPI;
use App\Models\GoogleSettings;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;



class GoogleController extends Controller
{

    public function __construct()
    {
    }

    public function getAnalytics()
    {
        $settings =   $setting = \Config::get('services.google');
        $token=GoogleSettings::refreshToken();
        $setting = [
            'client_id' => 'CLIENT ID',
            'client_secret' => 'CLIENT SECRET',
            'analytics_id' => 'ANALYTICS ID',
            'access_token'=>$token
        ];
        if ($settings) {
            $data = $settings;
            $setting['client_id'] = (!empty($data['client_id'])) ? $data['client_id'] : 'CLIENT ID';
            $setting['client_secret'] = (!empty($data['client_secret'])) ? $data['client_secret'] : 'CLIENT SECRET';
            $setting['analytics_id'] = (!empty($data['analytics_id'])) ? $data['analytics_id'] : 'ANALYTICS ID';

        }
        return view('seo::google.index', compact('setting'));
    }

    public function getAuthorization()
    {
        $setting = \Config::get('services.google');
        $ga = new GoogleAnalyticsAPI();
        $ga->auth->setClientId(env('GOOGLE_CLIENT_ID','client_id'));
        $ga->auth->setClientSecret(env('GOOGLE_CLIENT_SECRET','client_secret'));
        $ga->auth->setRedirectUri(url(env('GOOGLE_REDIRECT_URI')));
        \Session::put('oauth_access_token', null);
        if (isset($_GET['force_oauth'])) {
            \Session::put('oauth_access_token', null);
        }
        /*
         *  Step 1: Check if we have an oAuth access token in our session
         *          If we've got $_GET['code'], move to the next step
         */
        if (!(\Session::has('oauth_access_token')) && !isset($_GET['code'])) {
            // Go get the url of the authentication page, redirect the client and go get that token!
            $url = $ga->auth->buildAuthUrl();
            return redirect($url);
        }
    }

    public function getAnalyticCallBack(Request $request)
    {
        if (!(\Session::has('oauth_access_token')) && $request->get('code')){
            $ga = new GoogleAnalyticsAPI();
            $ga->auth->setClientId(env('GOOGLE_CLIENT_ID','client_id'));
            $ga->auth->setClientSecret(env('GOOGLE_CLIENT_SECRET','client_secret'));
            $ga->auth->setRedirectUri(url(env('GOOGLE_REDIRECT_URI')));
            $auth = $ga->auth->getAccessToken($request->get('code'));

            if ($auth['http_code'] == 200) {
                $ga->accessToken=$accessToken = $auth['access_token'];
                $refreshToken = $auth['refresh_token'];
                $tokenExpires = $auth['expires_in'];
                $tokenCreated = time();
                $data=[
                    'access_token'=>$accessToken,
                    'refresh_token'=>$refreshToken,
                    'expires_in'=>$tokenExpires,
                    'token_created'=>$tokenCreated,
                    'created' => time(),
                    'email'=> $ga->getProfiles()['username'],

                ];
                $client=@json_decode(File::get(storage_path('/app/gmail/tokens/gmail-json.json')),true);
                    File::put(storage_path('/app/gmail/tokens/gmail-json.json'),json_encode($data,true));
                    \Session::put('oauth_access_token', $accessToken);
                // For simplicity of the example we only store the accessToken
                // If it expires use the refreshToken to get a fresh one
//            $_SESSION['oauth_access_token'] = $accessToken;
            } else {
                die("Sorry, something wend wrong retrieving the oAuth tokens");
            }
        }
        return redirect()->route('admin_settings_connections');
    }
    public function getAnalyticsData($id){
        $visits=GoogleSettings::getVisits($id);
        krsort($visits['rows']);
        return view('seo::google.analytic_provisits',compact(['visits']));
    }
    public function getAnalyticProfiles(){
        $profiles=GoogleSettings::getProfiles();
        return view('seo::google.analytic_data',compact(['profiles']));
    }

}