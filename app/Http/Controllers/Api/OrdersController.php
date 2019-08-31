<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\OrderItem;
use App\Models\Orders;
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
        $item = \Auth::user()->orders()->items()->findOrFail($request->get('item_id'));
        if ($item) {
            return response()->json(['item' => $item,'error'=>false], 200);
        }else{
            return response()->json(['item' => [],'error'=>true,'message'=>'order not found'], 401);
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
        $ides=$request->get('ides');
        $items=Items::whereIn('id',$request->get('ides'))->get();
        $data=[];
        foreach ($ides as $id){
            foreach ($items as $item){
                if($item->id == $id)
                $data[$id]=$item;
            }
        }
        return response()->json(['items' => $data,'error'=>false], 200);
    }

    public function getOredersAndItems()
    {
        $result=OrderItem::leftJoin('orders','orders.id','=','order_items.order_id')
            ->where('orders.user_id',\Auth::id())->select(
                'order_items.name',
                'order_items.qty',
                'order_items.price',
                'order_items.amount',
                'order_items.created_at',
                'orders.order_number')->get();
        return response()->json(['items' => $result,'error'=>false], 200);
    }
}
