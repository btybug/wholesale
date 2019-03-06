<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12/11/2018
 * Time: 11:54 AM
 */

namespace App\Services;


use App\Models\Settings;
use Carbon\Carbon;
use Mockery\Exception;

/**
 * Class ManagerApiService
 * @package App\Services
 */
class ClientApiService
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $http;

    /**
     * @var array
     */
    public $source = [];
    /**
     * @var
     */
    protected $settings;

    /**
     * ManagerApiService constructor.
     */
    public function __construct()
    {
        $this->http = new \GuzzleHttp\Client;
    }

    public function CURL_GET($url, $data)
    {
        $response = $this->http->get("http://api.ipapi.com/api/161.185.160.93?access_key=e3cad81ab05eb1e7e3f5b15b3c6d079d", ['form_params' => $data]);
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * @param $url
     * @param $data
     * @return mixed
     */
    public function CURL($url, $data)
    {
        $response = $this->http->post($url, ['form_params' => $data]);
        return json_decode((string)$response->getBody(), true);
    }
}