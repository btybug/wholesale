<?php


namespace App\Http\Controllers\Admin\App\Customers;


use App\Http\Controllers\Controller;

class OrdersController extends Controller
{

    public function index()
    {
        return view('customers.orders.index');
    }

    public function getOrderd($id=null)
    {
        return view('customers.orders.order');
    }
}
