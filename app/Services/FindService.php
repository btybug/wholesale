<?php namespace App\Services;

use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\StockVariation;
use App\Models\ZoneCountries;
use Darryldecode\Cart\Facades\CartFacade as Cart;

/**
 * Created by PhpStorm.
 * User: edo
 * Date: 10/18/2018
 * Time: 1:01 PM
 */
class FindService
{
    public $config;

    public function __construct()
    {
        $this->config = config('find');
    }

    public function getOptions()
    {
        $data = [];

        foreach ($this->config as $key => $value){
            $data[url($value['url'])] = $key;
        }

        return  $data;
    }
}
