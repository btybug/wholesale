<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/28/2018
 * Time: 9:59 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Requests\OtherRequest;
use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Others;
use App\Models\Warehouse;

class OtherController extends Controller
{
    protected $view = 'admin.inventory.other';

    public function getIndex()
    {
        return $this->view('index');
    }

    public function getNew($id = null)
    {

        $items = Items::where('type', 'simple')->get()->pluck('name', 'id');
        $model = Others::find($id);
        $warehouses = Warehouse::all()->pluck('name','id')->all();

        return $this->view('new', compact('model', 'items','warehouses'));
    }

    public function postOthers(OtherRequest $request)
    {
        $data = $request->only(['item_id', 'qty', 'reason', 'notes']);
        $id = $request->get('id');
        $data['grouped'] = uniqid();
        if ($id) {
            $other = Others::findOrFail($id);
            $data['grouped'] = $other->grouped;
        }
        $data['parent_id'] = $id;
        $data['user_id'] = \Auth::id();
        $other = Others::create($data);

        $item = Items::find($request->get('item_id'));

        if($item){
            $qty = $this->saveLocations($item, $request->get('locations', []));
            if($qty > 0){
                $other->qty = $qty;
                $other->save();
            }
        }

        return redirect()->route('admin_inventory_other');
    }

    private function saveLocations($item, array $data = [])
    {
        $qty = 0;
        $deletableArray = [];
        if (count($data)) {
            foreach ($data as $datum) {
                $existing = $item->locations()->where('warehouse_id', $datum['warehouse_id'])
                    ->where('rack_id', $datum['rack_id'])
                    ->where('shelve_id', $datum['shelve_id'])->first();
                if ($existing) {
                    $qty += $datum['qty'];
                    $datum['qty'] = $existing->qty - $qty;
                    $existing->update($datum);
                }
            }
        }

        return $qty;
    }

}
