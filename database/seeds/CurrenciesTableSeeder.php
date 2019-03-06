<?php

/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/22/2018
 * Time: 5:38 PM
 */
use Illuminate\Database\Seeder;
class CurrenciesTableSeeder extends Seeder
{
    public function run(\App\Models\GetForexData $forexData,\App\Helpers\Currencies $currencies)
    {
        $data = [];
        $rates = $forexData->latest();

        foreach ($currencies->getData() as $code => $datum){
            if($code == 'USD'){
                $data[] = [
                    'currency'=>'USD',
                    'rate'=>1,
                    'name'=>$datum['name'],
                    'symbol'=>$datum['symbol'],
                    'format'=>$datum['format'],
                ];
            }else{
                $rate = 0;
                if(isset($rates['rates'][$code])){
                    $rate =  $rates['rates'][$code];
                }

                $data[] = [
                    'currency'=>$code,
                    'rate'=>$rate,
                    'name'=>$datum['name'],
                    'symbol'=>$datum['symbol'],
                    'format'=>$datum['format'],
                ];
            }
        }

        \DB::table('currencies')->insert($data);
    }
}