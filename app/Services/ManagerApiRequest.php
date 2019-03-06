<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12/12/2018
 * Time: 1:52 PM
 */

namespace App\Services;


use App\Models\Orders;
use App\Models\Roles;
use App\Models\Settings;
use App\User;
use Illuminate\Http\Request;

final class ManagerApiRequest
{
    protected $service;
    protected $http;
    public function __construct(ManagerApiService $service)
    {
        $this->service=$service;
        $this->http = new \GuzzleHttp\Client;
    }

    public function getTest()
    {

        $response = $this->http->post($this->url('oauth-channel/test'),  [
            'headers'=>$this->headers(),
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 'client-id',
                'client_secret' => 'client-secret',
                'redirect_uri' => 'http://example.com/callback',
                'code' =>'qaq',
            ],]);
        return json_decode((string)$response->getBody(), true);
    }

    public function getProducts(Request $request)
    {
        $response = $this->http->post($this->url('oauth-channel/get-all-products'),  [
            'headers'=>$this->headers(),
            'form_params' => $request->except('_token')]);
        return json_decode((string)$response->getBody(), true);
    }

    public function getItems(Request $request)
    {
        $response = $this->http->post($this->url('oauth-channel/get-all-items'),  [
            'headers'=>$this->headers(),
            'form_params' => $request->except('_token')]);
        return json_decode((string)$response->getBody(), true);
    }

    protected function url($path)
    {
        return env('MANAGE_API_DOMAIN') . '/api/' . $path;
    }

    protected function headers()
    {
        return   [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.$this->service->getFreshToken(),
    ];
    }

    public function exportCustomers()
    {

        $response = $this->http->post($this->url('oauth-channel/import-customers'),  [
            'headers'=>$this->headers(),
            'form_params' =>$this->makeCustomers()
        ]);
        return json_decode((string)$response->getBody(), true);
    }
    protected function makeCustomers(){
        $settings=new Settings();
        $model=$settings->getEditableData('manage_api_export_users');
        $columns=$model->toArray();
        $users=User::whereIn('role_id',Roles::where('type','frontend')->pluck('id'))->get()->toArray();
        $result=[];
        foreach ($users as $key=>$user){
            foreach ($columns as $field=>$value){
                if($value && array_key_exists($field,$user)){
                    $result[$key][$field]= ($user[$field])?:'null';
                }
            }
        }
     return $result;
    }

    public function exportOrder(int $order_id)
    {
        $order = Orders::where('id',$order_id)
            ->with('shippingAddress')
            ->with('items')->first();
        $order->shippingAddress->setAttribute('country',getCountryByZone($order->shippingAddress->country)->name);
        $order->shippingAddress->setAttribute('region',getRegion($order->shippingAddress->region,'name'));
        $response = $this->http->post($this->url('oauth-channel/import-order'),  [
            'headers'=>$this->headers(),
            'form_params' =>$order->toArray()
        ]);
        return json_decode((string)$response->getBody(), true);
    }
}