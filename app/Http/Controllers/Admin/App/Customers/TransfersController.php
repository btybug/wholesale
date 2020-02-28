<?php


namespace App\Http\Controllers\Admin\App\Customers;


use App\Http\Controllers\Controller;

class TransfersController extends Controller
{
    public function index()
    {
        return view('customers.transfers.index');
    }
    public function create()
    {
        return view('customers.transfers.create');
    }
}
