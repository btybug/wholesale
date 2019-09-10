<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function getOrders()
    {
        $orders = \Auth::user()->orders()->orderBy('is_exported', 'ASC')->get();
        return response()->json(['orders' => $orders, 'error' => false], 200);
    }

    public function getOrderItems(Request $request)
    {
        $item = OrderItem::leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.user_id', \Auth::id())
            ->where('order_items.id', $request->get('item_id'))->select('order_items.*')
            ->first();
        if ($item) {
            return response()->json(['item' => $item, 'error' => false], 200);
        } else {
            return response()->json(['item' => [], 'error' => true, 'message' => 'order not found'], 401);
        }
    }

    public function postImport(Request $request)
    {
        $item = OrderItem::leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.user_id', \Auth::id())
            ->where('order_items.id', $request->get('item_id'))->exists();
        if ($item) {
            OrderItem::where('id', $request->get('item_id'))->update(['is_exported' => 1]);
            return response()->json(['error' => false], 200);
        }
        return response()->json(['item' => [], 'error' => true, 'message' => 'order not found'], 401);

    }

    public function postItems(Request $request)
    {
        $ides = $request->get('ides',[]);

        $items = Items::with('barcode')->whereIn('id', $request->get('ides',[]))->get();
        $data = [];
        if(count($ides)){
            foreach ($ides as $id) {
                foreach ($items as $item) {
                    if ($item->id == $id)
                        $data[$id] = $item;
                }
            }
        }

        return response()->json(['items' => $ides, 'error' => 'kakash'], 200);
    }

    public function postItem(Request $request)
    {

        $item = Items::with(['barcode'])->findOrFail($request->id);

        return response()->json(['item' => $item, 'error' => false], 200);
    }

    public function getOredersAndItems()
    {
        $result = OrderItem::leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.user_id', \Auth::id())->select(
                'order_items.id',
                'order_items.variation_id',
                'order_items.name',
                'order_items.qty',
                'order_items.price',
                'order_items.amount',
                'order_items.is_exported',
                'order_items.created_at',
                'orders.order_number')->orderBy('order_items.is_exported', 'ASC')
            ->get();
        return response()->json(['items' => $result, 'error' => false], 200);
    }
}
