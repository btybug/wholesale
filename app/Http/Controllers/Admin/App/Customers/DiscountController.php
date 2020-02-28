<?php


namespace App\Http\Controllers\Admin\App\Customers;


use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\App\AppOffersDiscount;
use App\Models\App\Discount;
use App\Models\Items;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::get();
        return view('admin.app.discounts.index',compact(['discounts']));
    }

    public function create()
    {
        $model = null;
        return view('admin.app.discounts.create',compact('model'));
    }

    public function postCreate(DiscountRequest $request)
    {
        Discount::create($request->except("_token"));
        return redirect()->route('app_customer_discounts');
    }

    public function edit($id)
    {
        $model = Discount::findOrFail($id);
        return view('admin.app.discounts.create',compact('model'));
    }

    public function postEdit(DiscountRequest $request,$id)
    {
        $model = Discount::findOrFail($id);
        $model->update($request->except("_token"));
        return redirect()->route('customer_discounts');
    }

    public function offers()
    {
        $discounts = AppOffersDiscount::all();
        return view('admin.app.discounts.offers',compact(['discounts']));
    }

    public function offersCreate()
    {
        $items = Items::all()->pluck('name', 'id');
        $model = null;
        return view('admin.app.discounts.offers_create', compact('model', 'items'));
    }

    public function postOffersCreate(Request $request)
    {
        $date = $request->only('name', 'type');
        $date['data'] = $request->except('_token', 'name', 'type');
        AppOffersDiscount::create($date);
        return redirect()->route('app_customer_offers');
    }

    public function offersEdit($id)
    {
        $items = Items::all()->pluck('name', 'id');
        $model = AppOffersDiscount::findOrFail($id);
        return view('admin.app.discounts.offers_create',compact('model','items'));
    }

    public function postOffersEdit(Request $request,$id)
    {
        $date = $request->only('name', 'type');
        $date['data'] = $request->except('_token', 'name', 'type');
        $model = AppOffersDiscount::findOrFail($id);
        $model->update($date);
        return redirect()->back();
    }

    public function postOnOff(Request $request)
    {
        Discount::where('id',$request->get('id'))->update(['status'=>$request->get('status')]);
        return response()->json(['error'=>false]);
    }

    public function postOffersOnOff(Request $request)
    {
        AppOffersDiscount::where('id',$request->get('id'))->update(['status'=>$request->get('status')]);
        return response()->json(['error'=>false]);
    }
}
