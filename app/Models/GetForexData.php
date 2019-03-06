<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/20/2018
 * Time: 9:41 PM
 */

namespace App\Models;


class GetForexData
{
    private $api_key = 'ezlj4iid4fywjjm11wj66f48xds8bxi00qdx266xysczpi8lonlnxwk24gq4nh6o';

    public function latest($symbols = null)
    {
        $endpoint = 'latest';

// Initialize CURL:
        $url = 'https://www.getforexdata.com/api/' . $endpoint . '?access_key=' . $this->api_key;
        if($symbols){
            $url .= '&symbols='.$symbols;
        }
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

// Decode JSON response:
        $exchangeRates = json_decode($json, true);

// Access the exchange rate values, e.g. GBP:
        return $exchangeRates;
    }

}