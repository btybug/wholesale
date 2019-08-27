<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Barcodes;
use App\Services\BarcodesService;
use Illuminate\Http\Request;


class BarcodesController extends Controller
{
    protected $view = 'admin.inventory.Barcodes';



    public function getIndex()
    {
        return $this->view('index');
    }

    public function getNew()
    {
        return $this->view('new');
    }
    public function getBarcodeView($id)
    {
        $barcode=Barcodes::findOrfail($id);
        return $this->view('view',compact('barcode'));
    }

    public function postNew(Request $request)
    {
        $v=\Validator::make($request->all(),['code'=>'required|unique:barcodes,code']);
        if($v->fails()) return redirect()->back()->withErrors($v);
        Barcodes::create(['code'=>$request->get('code')]);
        return redirect()->route('admin_inventory_barcodes');
    }

    public function deteleBarcode(Request $request)
    {
        return \Response::json(['error' => !Barcodes::findOrFail($request->get('slug'))->delete()]);
    }


}
