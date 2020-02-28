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
use App\Models\Settings;
use App\Services\EAN13render;
use Illuminate\Http\Request;


class BarcodesController extends Controller
{
    protected $view = 'admin.inventory.Barcodes';



    public function getIndex()
    {
        return $this->view('index');
    }

    public function postSettings(Request $request,Settings $settings)
    {

        $settings->updateOrCreateSettings('barcodes', $request->all());
        return response()->json(['success'=>true]);
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
        $data=$request->all();
        $data['code']=explode(',',$data['code']);
        $v=\Validator::make($data,['code.*'=>'required|unique:barcodes,code']);
        if($v->fails()) return redirect()->back()->withErrors($v);

        foreach ($data['code'] as $code){
            $barcode= Barcodes::create(['code'=>$code]);
            $path=EAN13render::get($code,public_path('barcodes'.DS.$code.'.png'),200,100);
        }


        return redirect()->route('admin_inventory_barcodes');
    }

    public function deteleBarcode(Request $request)
    {
        return \Response::json(['error' => !Barcodes::findOrFail($request->get('slug'))->delete()]);
    }

    public function prnpriview($id)
    {
        $barcode=Barcodes::findOrfail($id);
        return $this->view('print',compact('barcode'));
    }


}
