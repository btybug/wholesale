<?php
/**
 * Created by PhpStorm.
 * User: Sahak
 * Date: 8/10/2016
 * Time: 5:00 PM
 */

namespace App\Models;


use App\Services\google\GoogleAnalyticsAPI;
use File;


/**
 * App\Models\GoogleSettings
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleSettings query()
 * @mixin \Eloquent
 */
class GoogleSettings extends Settings
{

    protected $table = 'settings';
    protected $guarded = ['_token'];

    public static function getAnalyticsId()
    {
        $settings = self::where('section', 'seo')
            ->where('settingkey', 'googleanalytics')->first();
        if ($settings) {
            $setting = unserialize($settings->val);
            if ($setting and isset($setting['analytics_id'])) {
                return $setting['analytics_id'];
            }
        }
        return 'ANALYTICS ID';
    }

    public static function profiles()
    {
        if (!self::refreshToken()) return [null => 'Not Authorized'];
        if (\Session::has('oauth_access_token')) {
            $ga = new \App\ExtraModules\seo\libs\google\GoogleAnalyticsAPI();
            $ga->setAccessToken(\Session::get('oauth_access_token'));
            $profiles = $ga->getProfiles();
            if (isset($profiles['items'])) {
                $data = array();
                foreach ($profiles['items'] as $key => $profile) {
                    $data[$key] = $profile['websiteUrl'];
                }
            }


        }
        return $data;
    }

    public static function getProfiles()
    {
        if (!self::refreshToken()) return [null => 'Not Authorized'];
        if (\Session::has('oauth_access_token')) {
            $ga = new \App\ExtraModules\seo\libs\google\GoogleAnalyticsAPI();
            $ga->setAccessToken(\Session::get('oauth_access_token'));
            $profiles = $ga->getProfiles();
            return $profiles;

        }
        return [];
    }

    public static function Accounts()
    {
        if (!self::refreshToken()) return [null => 'Not Authorized'];
        if (\Session::has('oauth_access_token')) {
            $ga = new \App\ExtraModules\seo\libs\google\GoogleAnalyticsAPI();
            $ga->setAccessToken(self::refreshToken());
            $profiles = $ga->getAccounts();
            if (isset($profiles['items'])) {
                $data = array();
                foreach ($profiles['items'] as $key => $profile) {
                    $data[$profile['id']] = $profile['name'];
                }
            }


        }
        return $data;
    }

    public static function getVisitsByCities()
    {
        if (\Session::has('oauth_access_token')) {
            $ga = new \App\ExtraModules\seo\libs\google\GoogleAnalyticsAPI();
            $ga->setAccessToken(self::refreshToken());
            $ga->setAccountId('ga:127582734');
            $profiles = $ga->getVisitsByCities();
            return $profiles;
        }
    }

    public static function getVisits($id)
    {
        $ga = new GoogleAnalyticsAPI();
        $ga->setAccessToken(self::refreshToken());
        $ga->setAccountId('ga:' . $id);
// Set the default params. For example the start/end dates and max-results
        $defaults = array(
            'start-date' => date('Y-m-d', strtotime('-1 month')),
            'end-date' => date('Y-m-d'),
        );
        $ga->setDefaultQueryParams($defaults);
        $params = array(
            'metrics' => 'ga:visits',
            'dimensions' => 'ga:date',
        );
        $visits = $ga->query($params);

        return ($visits);
    }

    public static function getVewVisits($id)
    {
        $ga = new GoogleAnalyticsAPI();
        $ga->setAccessToken(self::refreshToken());
        $ga->setAccountId('ga:' . $id);
// Set the default params. For example the start/end dates and max-results
        $defaults = array(
            'start-date' => date('Y-m-d', strtotime('-1 month')),
            'end-date' => date('Y-m-d'),
        );
        $ga->setDefaultQueryParams($defaults);
        $params = array(
            'metrics' => 'ga:newVisits',
            'dimensions' => 'ga:date',
        );
        $visits = $ga->query($params);

        return ($visits);
    }

    public static function getAvgTimeOnPage($id)
    {
        $ga = new GoogleAnalyticsAPI();
        $ga->setAccessToken(self::refreshToken());
        $ga->setAccountId('ga:' . $id);
// Set the default params. For example the start/end dates and max-results
        $defaults = array(
            'start-date' => date('Y-m-d', strtotime('-1 month')),
            'end-date' => date('Y-m-d'),
        );
        $ga->setDefaultQueryParams($defaults);
        $params = array(
            'metrics' => 'ga:avgTimeOnPage',
            'dimensions' => 'ga:date',
        );
        $visits = $ga->query($params);

        return ($visits);
    }
    public static function getPageviewsPerVisit($id)
    {
        $ga = new GoogleAnalyticsAPI();
        $ga->setAccessToken(self::refreshToken());
        $ga->setAccountId('ga:' . $id);
// Set the default params. For example the start/end dates and max-results
        $defaults = array(
            'start-date' => date('Y-m-d', strtotime('-1 month')),
            'end-date' => date('Y-m-d'),
        );
        $ga->setDefaultQueryParams($defaults);
        $params = array(
            'metrics' => 'ga:avgTimeOnPage',
            'dimensions' => 'ga:date',
        );
        $visits = $ga->query($params);

        return ($visits);
    }
    public static function getPageviews($id)
    {
        $ga = new GoogleAnalyticsAPI();
        $ga->setAccessToken(self::refreshToken());
        $ga->setAccountId('ga:' . $id);
// Set the default params. For example the start/end dates and max-results
        $defaults = array(
            'start-date' => date('Y-m-d', strtotime('-1 month')),
            'end-date' => date('Y-m-d'),
        );
        $ga->setDefaultQueryParams($defaults);
        $params = array(
            'metrics' => 'ga:pageviews',
            'dimensions' => 'ga:date',
        );
        $visits = $ga->query($params);

        return ($visits);
    }
    public static function getUniquePageviews($id)
    {
        $ga = new GoogleAnalyticsAPI();
        $ga->setAccessToken(self::refreshToken());
        $ga->setAccountId('ga:' . $id);
// Set the default params. For example the start/end dates and max-results
        $defaults = array(
            'start-date' => date('Y-m-d', strtotime('-1 month')),
            'end-date' => date('Y-m-d'),
        );
        $ga->setDefaultQueryParams($defaults);
        $params = array(
            'metrics' => 'ga:pageviews',
            'dimensions' => 'ga:date',
        );
        $visits = $ga->query($params);

        return ($visits);
    }

    public static function getVisitBounceRate($id)
    {
        $ga = new GoogleAnalyticsAPI();
        $ga->setAccessToken(self::refreshToken());
        $ga->setAccountId('ga:' . $id);
// Set the default params. For example the start/end dates and max-results
        $defaults = array(
            'start-date' => date('Y-m-d', strtotime('-1 month')),
            'end-date' => date('Y-m-d'),
        );
        $ga->setDefaultQueryParams($defaults);
        $params = array(
            'metrics' => 'ga:visitBounceRate',
            'dimensions' => 'ga:date',
        );
        $visits = $ga->query($params);

        return ($visits);
    }

    public static function refreshToken()
    {
        $client = @json_decode(File::get(storage_path('/app/gmail/tokens/gmail-json.json')),true);
        if ($client and isset($client['expires_in']) and isset($client['created']) and isset($client['refresh_token'])) {
            $exp_date = $client['expires_in'] + $client['created'];
            if (time() < $exp_date) {
                return $client['access_token'];
            }

            $setting = \Config::get('services.google');
            $client_id = $setting['client_id'];
            $client_secret = $setting['client_secret'];
            $redirect_uri = $setting['redirect'];
            $ga = new GoogleAnalyticsAPI();
            $ga->auth->setClientId($client_id);
            $ga->auth->setClientSecret($client_secret);
            $ga->auth->setRedirectUri($redirect_uri);
            $data = $ga->auth->refreshAccessToken($client['refresh_token']);
            if(isset($data['http_code']) and $data['http_code']==401){
                return null;
            };
            $client['access_token'] = $data['access_token'];
            $client['expires_in'] = $data['expires_in'];
            File::put(storage_path('/app/gmail/tokens/gmail-json.json'), json_encode($client, true));
            \Session::put('oauth_access_token', $client['access_token']);
            return $data['access_token'];
        }
        return null;
    }
}