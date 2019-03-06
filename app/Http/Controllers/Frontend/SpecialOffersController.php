<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 2/5/2019
 * Time: 4:57 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;

class SpecialOffersController extends Controller
{
    protected $view = 'frontend.my_account';

    public function getIndex()
    {
        $now = strtotime(today()->toDateString());

        $coupons = \Auth::user()->coupons()->where('start_date','<=',$now)->where('end_date','>=',$now)->where('status',true)->get();

        return $this->view('special_offers',compact(['coupons']));
    }
}