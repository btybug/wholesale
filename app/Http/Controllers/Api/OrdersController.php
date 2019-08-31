<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function getOrders()
    {
        $orders=\Auth::user()->orders()->orderBy('is_exported','ASC')->get();
        return response()->json(['orders'=>$orders,'error'=>false],200);
    }

    public function getOrderItems(Request $request)
    {
        $order = \Auth::user()->orders()->findOrFail($request->get('order_id'));
        if ($order) {
            return response()->json(['items' => $order->items,'error'=>false], 200);
        }else{
            return response()->json(['items' => [],'error'=>true,'message'=>'order not found'], 401);
        }
    }
    public function postImport(Request $request)
    {
        $orders=\Auth::user()->orders()->findOrFail($request->get('order_id'));
        $orders->is_exported=1;
        $orders->save();
        return response()->json(['error'=>false],200);
    }

    public function postItems(Request $request)
    {
        $items=Items::whereIn('id',$request->get('ides'))->get();
        return response()->json(['items' => $items,'error'=>false], 200);
    }
}
