<?php


namespace App\Http\Controllers\Admin\App\Customers;


use App\Http\Controllers\Controller;
use App\RemoteModels\Exports;
use App\RemoteModels\Items;

class ImportsController extends Controller
{
    public function index()
    {
        $imports=Exports::where('site_id','app-service')->where('shop_id',\Auth::user()->defaultStorageId())->get();
        return view('customers.imports.index',compact('imports'));
    }
    public function viewImport($id)
    {
        $items=\Auth::user()->defaultSroage()->imports()->findOrFail($id)->items;
        $remoteItems=Items::whereIn('id',$items->pluck('item_id'))->get()->pluck('name','id');
        return view('customers.imports.view',compact('items','remoteItems'));
    }

    public function importAccept($id)
    {
        dd($id);
    }
}
