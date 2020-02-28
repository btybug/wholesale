<?php


namespace App\Http\Controllers\Admin\App\Customers;


use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\RemoteModels\Exports;
use App\RemoteModels\ExportsItems;
use App\RemoteModels\Items;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $items=(\Session::get('purchase'))?Items::whereIn('id',\Session::get('purchase')['items'])->get():collect([]);
        $shops=\Auth::user()->shops()->pluck('name','id');
        return view('customers.purchase.index',compact('items','shops'));
    }

    public function postPurchase(Request $request)
    {
        \Session::put(['purchase'=>$request->except('_token')]);

        return redirect()->route('customer_purchase');
    }
    public function postMakePurchase(PurchaseRequest $request)
    {
        $items = $request->get('items');
        $Import = Exports::create([
            'customer_id' => \Auth::id(),
            'site_id' => 'app-service',
            'delivery_date' => Carbon::now()->addWeek()
        ]);
       foreach ($items as $key=>$item){
           $items[$key]['export_id']=$Import->id;
       }
        ExportsItems::insert($items);
        \Session::put(['purchase'=>[]]);
        return redirect()->route('customer_imports');
    }

    public function ajaxSopRack(Request $request)
    {
        $shops=\Auth::user()->shops()->pluck('name','id');
        $item_id=$request->get('item_id');
       return response()->json(['error'=>false,'code'=>200,'html'=>view('customers.purchase._partials.shop_rack',compact('shops','item_id'))->render()]);
    }

}
