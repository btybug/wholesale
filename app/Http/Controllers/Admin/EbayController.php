<?php


namespace App\Http\Controllers\Admin;


use App\Ebay\AuthEbay;
use App\Ebay\Ebay;
use App\Http\Controllers\Controller;
use DTS\eBaySDK\Account\Enums;
use DTS\eBaySDK\Account\Services;
use DTS\eBaySDK\Account\Types;
use DTS\eBaySDK\OAuth\Services\OAuthService;
use DTS\eBaySDK\OAuth\Types\GetUserTokenRestRequest;
use Illuminate\Http\Request;


class EbayController extends Controller
{
    protected $view = 'admin.ebay';
    protected $oAuthService;

    public function __construct()
    {
        $config = config('ebay');
        $this->oAuthService = new OAuthService([
            'credentials' => $config['sandbox']['credentials'],
            'ruName' => $config['sandbox']['ruName'],
            'sandbox' => true
        ]);
    }
    public function settings()
    {
        return $this->view('settings');
    }

    public function listing()
    {
        return $this->view('listing');
    }

    public function orders()
    {
        return $this->view('orders');
    }

    public function app()
    {
        return $this->view('templates.index');
    }

    public function getAccount()
    {
        dd(AuthEbay::getAccount());
    }

    public function getAppToken()
    {
        $api = $this->oAuthService->getAppToken();
        return $this->view('templates.get_app_token', [
            'statusCode' => $api->getStatusCode(),
            'accessToken' => $api->access_token,
            'tokenType' => $api->token_type,
            'expiresIn' =>time()+$api->expires_in-60,
            'refreshToken' => $api->refresh_token,
            'error' => $api->error,
            'errorDescription' => $api->error_description
        ]);
    }

    public function getUserToken()
    {
        $state = uniqid();
        $url =  $this->oAuthService->redirectUrlForUser([
            'state' => $state,
            'scope' => [
                'https://api.ebay.com/oauth/api_scope/sell.account',
                'https://api.ebay.com/oauth/api_scope/sell.inventory',
                'https://api.ebay.com/oauth/api_scope/sell.fulfillment'
            ]
        ]);
        return $this->view('templates.get_user_token',[
            'url'   => $url,
            'state' => $state
        ]);
    }

    public function getUserTokenBack(Request $request)
    {
        $api = $this->oAuthService->getUserToken(new GetUserTokenRestRequest([
            'code' => $request->get('code')
        ]));
        $token=[
            'state' => $request->get('state'),
            'code' => $request->get('code'),
            'statusCode' => $api->getStatusCode(),
            'accessToken' => $api->access_token,
            'tokenType' => $api->token_type,
            'expiresIn' =>time()+$api->expires_in-60,
            'refreshToken' => $api->refresh_token,
            'error' => $api->error,
            'errorDescription' => $api->error_description
        ];
        if (!\File::isDirectory(storage_path('app/ebay'))){
            \File::makeDirectory(storage_path('app/ebay'));
        }
        \File::put(storage_path('app/ebay/token.json'),json_encode($token,true));
        return $this->view('templates.auth_accepted',$token);
    }
}

