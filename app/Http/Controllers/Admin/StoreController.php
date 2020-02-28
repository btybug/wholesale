<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\CouponsRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Category;
use App\Models\Coupons;
use App\Models\Emails;
use App\Models\Items;
use App\Models\ItemsLocations;
use App\Models\Notifications\CustomEmails;
use App\Models\Products;
use App\Models\Purchase;
use App\Models\ReferalCoupon;
use App\Models\ShippingZones;
use App\Models\Stock;
use App\Models\StockVariation;
use App\Models\Suppliers;
use App\Models\Warehouse;
use App\Models\WarehouseRacks;
use App\Services\UserService;
use App\User;
use Carbon\Carbon;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $view = 'admin.store';

    public function index()
    {
        return $this->view('index');
    }

    public function newProduct()
    {
        $model = new Products();
        return $this->view('new', compact('model'));
    }

    public function getCoupons()
    {
        return $this->view('coupons');
    }

    public function getCouponsNew()
    {
        $coupons = null;
        $products = Stock::all()->pluck('name', 'id')->all();
        $users = User::pluck('name', 'users.id')->all();

        return $this->view('coupons_new', compact('coupons', 'products', 'users'));
    }

    public function CouponsSave(CouponsRequest $request, UserService $userService)
    {
        $data = $request->except('_token');
        $coupon = Coupons::updateOrCreate($request->id, $data);

        if ($coupon && $coupon->send_email) {
            $category = Category::where('slug', 'special_offer')->first();
            $from = Emails::where('type', 'from')->first();
            $data = [
                'category_id' => $category->id,
                'coupon_id' => $coupon->id,
                'from' => $from->email,
                'status' => 1,
            ];
            $translatable = [
                'gb' => [
                    'subject' => $coupon->name,
                    'content' => 'Content of coupon ' . $coupon->name
                ]
            ];

            if ($coupon->target) {
                $users = $coupon->users;
            } else {
                $users = User::all()->pluck('id');
            }

            $emailCustomer = CustomEmails::updateOrCreate($request->id, $data, $translatable);
            $emailCustomer->users()->attach($users, ['status' => 1]);

            if (count($users)) {
                foreach ($users as $user_id) {
                    ReferalCoupon::create([
                        'user_id' => $user_id,
                        'coupon_id' => $coupon->id,
                    ]);
                }
            }
        }

        return redirect(route('admin_store_coupons'));
    }

    public function cancelCoupon(Request $request)
    {
        $coupons = Coupons::findOrFail($request->id);
        $coupons->update(['status' => false]);

        return redirect(route('admin_store_coupons'));
    }

    public function Delete($id)
    {
        Coupons::find($id)->delete();
        return redirect(route('admin_store_coupons'));
    }

    public function Edit($id)
    {
        $coupons = Coupons::findOrFail($id);

        return $this->view('coupons_edit', compact('coupons'));
    }

    public function postCouponTheme(Request $request)
    {
        $model = Coupons::find($request->id);
        $html = '';
        if (\View::exists("admin.store.coupon_themes.$request->theme")) {
            $html = \View("admin.store.coupon_themes.$request->theme", compact(['model']))->with('data', $request->all())->render();
        }

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function saveTags(Request $request)
    {
        dd($request->all());
    }

    public function getProducts(Request $request)
    {
        dd($request->all());
        return $this->view('coupons_new');
    }

    public function findRegion(Request $request)
    {
        $coontries = new Countries();
        $posible = array();
        $regions = $coontries->where('name.common', $request->country)->first()->hydrateStates()->states->pluck('name', 'postal')->toArray();

        foreach ($regions as $region) {
            if (preg_match("/(" . $request->id . ")/i", $region)) {
                $posible[] = $region;
            }
        }
        return \Response::json(['error' => false, 'data' => $posible]);
    }


    public function getPurchase()
    {
        return $this->view('purchase.index');
    }

    public function getPurchaseNew()
    {
        $model = null;
        $items = Items::get()->pluck('name', 'id')->all();
        $suppliers = Suppliers::all()->pluck('name', 'id')->all();
        $warehouses = Warehouse::all()->pluck('name', 'id')->all();

        return $this->view('purchase.new', compact('model', 'items', 'suppliers', 'warehouses'));
    }

    public function postSaveOrUpdate(PurchaseRequest $request)
    {
        $data = $request->except('_token', 'qty', 'locations');
        $data['purchase_date'] = Carbon::parse($data['purchase_date']);
        $data['user_id'] = \Auth::id();
        $purchase = Purchase::updateOrCreate($request->only('id'), $data);
        $item = Items::find($request->get('item_id'));

        if ($item) {
            $purchase->qty = $this->saveLocations($item, $request->get('locations', []));
            $purchase->save();
        }

        return redirect()->route('admin_inventory_purchase');
    }

    private function saveLocations($item, array $data = [])
    {
        $qty = 0;
        $deletableArray = [];
        if (count($data)) {
            foreach ($data as $datum) {
                $qty += $datum['qty'];
                $existing = $item->locations()->where('warehouse_id', $datum['warehouse_id'])
                    ->where('rack_id', $datum['rack_id'])
                    ->where('shelve_id', $datum['shelve_id'])->first();
                if ($existing) {
                    $datum['qty'] += $existing->qty;
                    $existing->update($datum);
                } else {
                    $location = $item->locations()->create($datum);
                }
            }
        }

        return $qty;
    }

    public function EditPurchase($id)
    {
        $model = Purchase::findOrFail($id);
        $items = Items::where('type', 'simple')->get()->pluck('name', 'id')->all();
        $suppliers = Suppliers::all()->pluck('name', 'id')->all();
        $warehouses = Warehouse::all()->pluck('name', 'id')->all();
        $racks = WarehouseRacks::whereNull('parent_id')->where('warehouse_id', $model->warehouse_id)->get()->pluck('name', 'id')->all();
        $shelves = WarehouseRacks::where('warehouse_id', $model->warehouse_id)->where('parent_id', $model->rack_id)->get()->pluck('name', 'id')->all();
        return $this->view('purchase.new', compact('model', 'items', 'suppliers', 'warehouses', 'racks', 'shelves'));
    }


    public function getStockBySku(Request $request)
    {
        $sku = $request->get('sku');
        $variation = StockVariation::where('variation_id', $sku)->first();
        if ($variation) {
            $vape = $variation->stock;
            $html = $this->view('purchase.product', compact('vape', 'variation'))->render();

            return \Response::json(['error' => false, 'html' => $html]);
        }

        return \Response::json(['error' => true]);
    }

    public function postItemLocations(Request $request)
    {
        $warehouses = Warehouse::all()->pluck('name', 'id')->all();
        $html = $this->view("purchase.locations", compact('warehouses'))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

}
