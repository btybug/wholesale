<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\WholesaleService;
use App\Models\ItemHistory;
use App\Models\Items;
use App\Models\RackItems;

class PurchasesController extends Controller
{

    public function index()
    {
        return view('admin.purchases.index');
    }

    public function import(WholesaleService $wholesaleService, $id)
    {
        $response = $wholesaleService->getOrderItems($id);
        $item = $response['item'];
        $user = \Auth::getUser();
        $shop = $user->defaultSroage();
        $import = $shop->imports()->create(['order_id' => $id]);
        $data = [];
        $rack = $shop->getDefaultRack();
        $localItem=Items::firstOrNew([
            'item_id'=>$item['variation_id'],
            'shop_id'=>$shop->id,
        ]);
        $localItem->default_price=$item['price'];
        $localItem->price=($localItem->price)??0.00;
        $localItem->save();

        $data[] = ['item_id' => $localItem->id, 'qty' => $item['qty'], 'import_id' => $import->id, 'price' => $item['price']];
        RackItems::updateItem($item, $rack,$localItem->id);
        \DB::table('import_items')->insert($data);
        $wholesaleService->postImport($id);

        ItemHistory::create([
            'to_id' => $shop->id,
            'item_id' => $localItem->id,
            'qty' => $item['qty'],
            'reason' => 'Import'
        ]);

        return redirect()->back();
    }


}
