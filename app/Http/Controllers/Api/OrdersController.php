<?php


namespace App\Http\Controllers\Api;




use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function getOrders()
    {
        $orders=\Auth::user()->orders();
        return response()->json(['orders'=>$orders],200);
    }

}
