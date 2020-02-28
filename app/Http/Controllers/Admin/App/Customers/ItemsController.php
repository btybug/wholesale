<?php


namespace App\Http\Controllers\Admin\App\Customers;


use App\Http\Controllers\Controller;
use App\RemoteModels\Items;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Items::all();
        return view('customers.items.index',compact('items'));
    }
}
