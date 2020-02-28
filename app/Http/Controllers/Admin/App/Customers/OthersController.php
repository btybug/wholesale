<?php


namespace App\Http\Controllers\Admin\App\Customers;


use App\Http\Controllers\Controller;
use App\Http\Services\WholesaleService;
use App\Models\ItemHistory;
use App\Models\RackItems;
use App\Models\Shops;
use Illuminate\Http\Request;

class OthersController extends Controller
{
    public function index(WholesaleService $wholesaleService)
    {
        $others = ItemHistory::whereNull("to_id")->get();
        $response= $wholesaleService->getItems($others->pluck('item_id','item_id')->all());
        $remoteItems=$response['items'];

        return view('customers.others.index',compact(['others','remoteItems']));
    }
    public function create()
    {
        $shops = Shops::all()->pluck('name','id')->toArray();
        $items = \App\RemoteModels\Items::all()->pluck('name','id')->toArray();
        return view('customers.others.create',compact('items','shops'));
    }

    public function postShopItems(Request $request,WholesaleService $wholesaleService)
    {
        $user=\Auth::getUser();
        $model = $user->shops()->findOrFail($request->id);
        $items = RackItems::leftJoin("racks","rack_items.rack_id","racks.id")
            ->leftJoin("shops","racks.shop_id","shops.id")
            ->where("shops.id",$model->id)
            ->select("rack_items.*",\DB::raw("SUM(rack_items.qty) as count"))
            ->groupBy("rack_items.item_id")
            ->get();

        $response= $wholesaleService->getItems($items->pluck("item_id","item_id")->all());
        $remoteItems=$response['items'];

        return response()->json(['error' => false, 'data' => $remoteItems]);
    }

    public function postCreate(Request $request)
    {
        $user=\Auth::getUser();
        $model = $user->shops()->findOrFail($request->shop_id);
        ItemHistory::create([
            'from_id' => $model->id,
            'to_id' => null,
            'item_id' => $request->item_id,
            'qty' => $request->qty,
            'reason' => $request->reason,
            'note' => $request->notes,
        ]);

        return redirect()->route('customer_others');
    }
}
