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

class OtherController extends Controller
{
    protected $view = 'admin.inventory.other';

    public function getIndex()
    {
        return $this->view('index');
    }

    public function getNew($id=null)
    {

        $items = Items::all()->pluck('name', 'id');
        $model = Others::find($id);
        return $this->view('new', compact('model', 'items'));
    }

    public function postOthers(OtherRequest $request)
    {
        $data = $request->only(['item_id', 'qty', 'reason', 'notes']);
        $id = $request->get('id');
        $qty = $data['qty'];
        $data['group']=uniqid();
        if ($id) {
            $other = Others::findOrFail($id);
            $qty = $data['qty'] - $other->qty;
            $data['group']=$other->group;
        }
        $item = Items::findOrFail($data['item_id']);
        $item->quantity = $item->quantity - $qty;
        $data['parent_id']=$id;
        $data['user_id']=\Auth::id();
        Others::create($data);
        $item->save();
        return redirect()->route('admin_inventory_other');
    }

}