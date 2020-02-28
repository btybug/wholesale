<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Events\ClaimReferralBonus;
use App\Events\OrderSubmitted;
use App\Http\Controllers\Admin\Requests\OrderHistoryRequest;
use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\Coupons;
use App\Models\Items;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\OrdersJob;
use App\Models\Others;
use App\Models\Statuses;
use App\Models\Settings;
use App\Models\Stock;
use App\Models\StockVariation;
use App\Models\StockVariationDiscount;
use App\Models\StripePayments;
use App\Models\ZoneCountries;
use App\Models\ZoneCountryRegions;
use App\Services\CartService;
use App\Services\OrdersService;
use App\Services\PrinterService;
use App\User;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use PragmaRX\Countries\Package\Countries;
use App\Models\GeoZones;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected $view = 'admin.orders';

    private $statuses;
    private $settings;
    private $cartService;
    private $countries;
    private $geoZones;
    private $orderService;
    private $amount;

    public function __construct(
        Statuses $statuses,
        Settings $settings,
        CartService $cartService,
        Countries $countries,
        GeoZones $geoZones,
        OrdersService $orderService
    )
    {
        $this->statuses = $statuses;
        $this->settings = $settings;
        $this->cartService = $cartService;
        $this->countries = $countries;
        $this->geoZones = $geoZones;
        $this->orderService = $orderService;
    }

    public function index()
    {
        return $this->view('index');
    }

    public function getManage($id, Settings $settings)
    {
        $order = Orders::where('id', $id)
            ->with('shippingAddress')
            ->with('billingAddress')
            ->with('history')
            ->with('items')
            ->with('user')->first();

        if (!$order) abort(404);
        $hidden = [];
        $model = $settings->getEditableData('orders_statuses');
        $settings = $settings->getEditableData('admin_general_settings');

        $hidden[] = $model->submitted;
        $hidden[] = $model->partially_collected;
        $hidden[] = $model->collected;

        $statuses = $this->statuses->where('type', 'order')->get()->pluck('name', 'id');
        return $this->view('manage', compact('order', 'statuses','settings'));
    }

    public function getEdit($id)
    {
        $order = Orders::findOrFail($id);

        return $this->view('edit', compact('order'));
    }

    public function postEdit($id, Request $request)
    {
        $order = Orders::findOrFail($id);
        if($request->order_item_id == 'all'){
            $items = $order->items;
            foreach ($items as $item){
                $orderItem = $this->orderService->refundItems($item,$order,$request);
                $orderItem->is_refunded = true;
                $orderItem->save();
            }

//            $order->type = 2;

        }else{
            $orderItem = $order->items()->where('id',$request->order_item_id)->first();
            if(! $orderItem) abort(500);

            $orderItem = $this->orderService->refundItems($orderItem,$order,$request);
            $orderItem->is_refunded = true;
            $orderItem->save();

            $order->amount -= $orderItem->amount;

        }
        $order->save();

        return redirect()->back();
    }

    public function getNew()
    {
        $user = null;
        $products = Stock::all()->pluck('name', 'id')->all();
        $statuses = $this->statuses->where('type', 'order')->get()->pluck('name', 'id');

//        $users = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
//            ->whereNull('role_id')
//            ->orWhere('roles.type', 'frontend')->select('users.*', 'roles.title')->pluck('name', 'users.id');
//
        $users = User::all()->pluck('name', 'id')->all();

        $countries = $this->countries->all()->pluck('name.common', 'name.common')->toArray();
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        session()->forget('order_new_shipping_address_id', 'order_new_user_id', 'order_new_customer_notes', 'order_new_coupon');
        Cart::session(Orders::ORDER_NEW_SESSION_ID)->clear();
        Cart::session(Orders::ORDER_NEW_SESSION_ID)->removeConditionsByType('shipping');

        return $this->view('new', compact('statuses', 'products', 'users', 'user', 'countries', 'countriesShipping'));
    }

    public function addNote(OrderHistoryRequest $request, OrdersService $ordersService)
    {
        $order = Orders::findOrFail($request->id);
        $status_id = $request->get('status_id', null);
        $order->history()->create([
            'status_id' => $request->get('status_id', null),
            'note' => $request->note,
        ]);
        $ordersService->changeStatus($order, $status_id);
        $histories = $order->history()->orderBy('created_at', 'desc')->get();
        $statuses = $this->statuses->where('type', 'order')->get()->pluck('name', 'id');

        $html = \View('admin.orders._partials.timeline_item', compact(['histories']))->render();
        $statusHtml = \View('admin.orders._partials.order_status', compact(['order','statuses']))->render();

        return \Response::json(['error' => false, 'html' => $html,'statusHtml' => $statusHtml]);
    }

    public function getSettings()
    {
        $settings = $this->settings->getEditableData('order');
        $statuses=Statuses::where('type','order')->get();

        return $this->view('settings', compact(['settings', 'statuses']));
    }

    public function postSettings(Request $request)
    {
        $data = $request->except('_token');

        $this->settings->updateOrCreateSettings('order', $data);

        return redirect()->back();
    }

    public function getItem(Request $request)
    {
        $vape = Stock::findOrFail($request->id);
        $currency = get_currency();
        $html = $this->view('_partials.product', compact(['vape','currency']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postGetUser(Request $request)
    {
        $user = User::findOrFail($request->id);

        $html = $this->view("_partials.select_user", compact('user'))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postCollecting($id, Request $request)
    {
        $order = Orders::findOrfail($id);
        $error = true;
        $message = '';
        $success = false;
        if($request->unique_id){
            $error = false;
            $item = Items::find($request->item_id);
            $warehouse = $request->warehouse;
            $rack = $request->rack;
            $shelve = $request->shelve;
            $qty = $request->qty;

            $settings = $this->settings->getEditableData('orders_statuses');

            $count = $request->count;
            $collected = $order->collections->count()+1;
            $itemsNeedCollect = $count - $collected;
            if ($count == $collected) {
                $success = true;

                if ($settings && isset($settings['collected'])) {

                    $historyData['user_id'] = \Auth::id();
                    $historyData['status_id'] = $settings['collected'];

                    $existing = $item->locations()->where('warehouse_id',$warehouse)
                        ->where('rack_id', $rack)
                        ->where('shelve_id', $shelve)->first();
                    if ($existing) {
                        if ($existing->qty < $qty) {
                            return redirect()->back()->with('error', "This item is not exists in warehouse");
                        }
                        $collect = $order->collections()->create([
                            'unique_id' => $request->unique_id
                        ]);
                        $order->history()->create($historyData);

                        $existing->update([
                            'qty' => $existing->qty - $qty
                        ]);

                        Others::create([
                            'item_id' => $item->id,
                            'user_id' => $order->user_id,
                            'qty' => (int)$qty,
                            'reason' => 'sold',
                            'grouped' => $order->id,
                        ]);
                    }

                }
            } else {
                $message = "You need collect $itemsNeedCollect item(s)";

                if ($collected == 1 && $settings && isset($settings['partially_collected'])) {
                    dd(2);

                    $historyData['user_id'] = \Auth::id();
                    $historyData['status_id'] = $settings['partially_collected'];

                    $existing = $item->locations()->where('warehouse_id',$warehouse)
                        ->where('rack_id', $rack)
                        ->where('shelve_id', $shelve)->first();
                    if ($existing) {
                        if ($existing->qty < $qty) {
                            return redirect()->back()->with('error', "This item is not exists in warehouse");
                        }
                        $collect = $order->collections()->create([
                            'unique_id' => $request->unique_id
                        ]);
                        $order->history()->create($historyData);

                        $existing->update([
                            'qty' => $existing->qty - $qty
                        ]);

                        Others::create([
                            'item_id' => $item->id,
                            'user_id' => $order->user_id,
                            'qty' => (int)$qty,
                            'reason' => 'sold',
                            'grouped' => $order->id,
                        ]);
                    }
                }
            }
        }


        return \Response::json(['error' => $error, 'message' => $message,'success' => $success]);
    }

    public function ItemById(Request $request)
    {
        $model = Stock::findOrFail($request->id);

        return \Response::json(['error' => false, 'data' => $model]);
    }

    public function postAddUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $delivery = null;
        $countries = $this->countries->all()->pluck('name.common', 'name.common')->toArray();
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();

        if(! $default_shipping) return \Response::json(['error' => true, 'message' => "User not have default shipping address"]);
        $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
        $geoZone = ($zone) ? $zone->geoZone : null;
        if ($geoZone && count($geoZone->deliveries)) {
            $subtotal = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getSubTotal();
            $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();
        }

        session()->put('order_new_shipping_address_id', $default_shipping->id);
        session()->put('order_new_user_id', $user->id);

        $html = $this->view("_partials.add_user", compact('user', 'countries', 'countriesShipping'))->render();
        $shippingHtml = $this->view("_partials.shipping_payment", compact('user', 'delivery', 'geoZone'))->render();
        $orderSummary = $this->view("_partials.order_summary", compact('user', 'geoZone'))->render();


        return \Response::json(['error' => false, 'html' => $html, 'shippingHtml' => $shippingHtml, 'summaryHtml' => $orderSummary]);
    }

    public function postAddToCart(Request $request)
    {
        $product = Stock::find($request->product_id);
        $user = User::where('id',$request->user_id)->first();
        $default_shipping = null;
        $shipping = null;
        $geoZone = null;

        if ($product) {
            $error = $this->cartService->validateProduct($product, $request->variations);

            if (!$error) {
                $cart_id = uniqid();
                Cart::session(Orders::ORDER_NEW_SESSION_ID)->add($cart_id, $product->id, $this->cartService->price,
                    $request->product_qty, ['variations' => $this->cartService->variations, 'product' => $product]);

                if ($user) {
                    $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
                    $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
                    $geoZone = ($zone) ? $zone->geoZone : null;
                    if ($geoZone && count($geoZone->deliveries)) {
                        $subtotal = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getSubTotal();
                        $shipping = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getCondition($geoZone->name);
                        $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();

                        if(! $shipping){
                            Cart::session(Orders::ORDER_NEW_SESSION_ID)->removeConditionsByType('shipping');

                            if ($delivery && count($delivery->options)) {
                                $shippingDefaultOption = $delivery->options->first();
                                $condition2 = new \Darryldecode\Cart\CartCondition(array(
                                    'name' => $geoZone->name,
                                    'type' => 'shipping',
                                    'target' => 'total',
                                    'value' => $shippingDefaultOption->cost,
                                    'order' => 1,
                                    'attributes' => $shippingDefaultOption
                                ));
                                Cart::session(Orders::ORDER_NEW_SESSION_ID)->condition($condition2);
                                $shipping = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getCondition($geoZone->name);
                            }
                        }
                    }
                }

                $items = $this->cartService->getCartItems(true);
                $html = $this->view('_partials.cart', compact(['items', 'default_shipping', 'shipping', 'geoZone']))->render();
                $shippingHtml = $this->view("_partials.shipping_payment", compact('user', 'delivery', 'geoZone'))->render();
                $orderSummary = $this->view("_partials.order_summary", compact('user', 'geoZone'))->render();

                return \Response::json(['error' => false, 'message' => 'added',
                    'count' => $this->cartService->getCount(), 'html' => $html,
                    'shippingHtml' => $shippingHtml, 'summaryHtml' => $orderSummary
                ]);
            }

            return \Response::json(['error' => true, 'message' => $error]);
        }

        return \Response::json(['error' => true, 'message' => 'try again']);
    }

    public function postUpdateQty(Request $request)
    {
        $qty = ($request->condition) ? 1 : -1;
        $default_shipping = null;
        $shipping = null;
        $delivery = null;
        $geoZone = null;
        $user = User::find($request->user_id);

        if ($user) {
            if ($request->condition == 'inner') {
                Cart::session(Orders::ORDER_NEW_SESSION_ID)->update($request->uid, array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $request->value
                    )));
            } else {
                $i = Cart::session(Orders::ORDER_NEW_SESSION_ID)->update($request->uid, array(
                    'quantity' => $qty
                ));
            }

            $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if ($geoZone && count($geoZone->deliveries)) {
                $subtotal = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getSubTotal();
                Cart::session(Orders::ORDER_NEW_SESSION_ID)->removeConditionsByType('shipping');
                $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();
                if ($delivery && count($delivery->options)) {
                    $shippingDefaultOption = $delivery->options->first();
                    $condition2 = new \Darryldecode\Cart\CartCondition(array(
                        'name' => $geoZone->name,
                        'type' => 'shipping',
                        'target' => 'total',
                        'value' => $shippingDefaultOption->cost,
                        'order' => 1,
                        'attributes' => $shippingDefaultOption
                    ));
                    Cart::session(Orders::ORDER_NEW_SESSION_ID)->condition($condition2);
                    $shipping = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getCondition($geoZone->name);
                }
            }

        } else {
            if ($request->condition == 'inner') {
                Cart::session(Orders::ORDER_NEW_SESSION_ID)->update($request->uid, array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $request->value
                    )));
            } else {
                $i = Cart::session(Orders::ORDER_NEW_SESSION_ID)->update($request->uid, array(
                    'quantity' => $qty
                ));
            }
        }

        $items = $this->cartService->getCartItems(true);

        $shippingHtml = $this->view("_partials.shipping_payment", compact('user', 'delivery', 'geoZone'))->render();
        $orderSummary = $this->view("_partials.order_summary", compact('user', 'geoZone'))->render();
        $html = $this->view('_partials.cart', compact(['items', 'default_shipping', 'shipping', 'geoZone']))->render();

        return \Response::json(['error' => false, 'html' => $html, 'shippingHtml' => $shippingHtml, 'summaryHtml' => $orderSummary]);
    }

    public function postRemoveFromCart(Request $request)
    {
        $default_shipping = null;
        $shipping = null;
        $geoZone = null;
        $delivery = null;

        $user = User::find($request->user_id);

        if ($user) {
            $this->cartService->remove($request->uid, true);

            $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if ($geoZone && count($geoZone->deliveries)) {
                $subtotal = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getSubTotal();
                Cart::session(Orders::ORDER_NEW_SESSION_ID)->removeConditionsByType('shipping');
                $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();
                if ($delivery && count($delivery->options)) {
                    $shippingDefaultOption = $delivery->options->first();
                    $condition2 = new \Darryldecode\Cart\CartCondition(array(
                        'name' => $geoZone->name,
                        'type' => 'shipping',
                        'target' => 'total',
                        'value' => $shippingDefaultOption->cost,
                        'order' => 1,
                        'attributes' => $shippingDefaultOption
                    ));
                    Cart::session(Orders::ORDER_NEW_SESSION_ID)->condition($condition2);
                    $shipping = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getCondition($geoZone->name);
                }
            }
        } else {
            $this->cartService->remove($request->uid, true);
        }

        $items = $this->cartService->getCartItems(true);
        $html = $this->view('_partials.cart', compact(['items', 'default_shipping', 'shipping', 'geoZone']))->render();
        $shippingHtml = $this->view("_partials.shipping_payment", compact('user', 'delivery', 'geoZone'))->render();
        $orderSummary = $this->view("_partials.order_summary", compact('user', 'geoZone'))->render();

        return \Response::json(['error' => false, 'html' => $html, 'count' => $this->cartService->getCount(), 'shippingHtml' => $shippingHtml, 'summaryHtml' => $orderSummary]);
    }

    public function orderCash(Request $request)
    {
        $billingId = $shippingId = session()->get('order_new_shipping_address_id');
        $userId = session()->get('order_new_user_id');
        $user = User::findOrFail($userId);
        $customer_notes = session()->get('order_new_customer_notes');
        $coupon = session()->get('order_new_coupon');

        $this->amount = CartService::getTotalPriceSum(true) + Cart::session(Orders::ORDER_NEW_SESSION_ID)->getTotal();
        $geoZone = null;
        $items = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getContent();

        $shippingAddress = Addresses::find($shippingId);
        $zone = ($shippingAddress) ? ZoneCountries::find($shippingAddress->country) : null;
        $region = ($shippingAddress) ? ZoneCountryRegions::find($shippingAddress->region) : null;
        $geoZone = ($zone) ? $zone->geoZone : null;

        $order = \DB::transaction(function () use ($billingId, $shippingId, $geoZone, $shippingAddress, $zone, $region,$user) {
            $shipping = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getCondition($geoZone->name);
            $items = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getContent();
            $order_number = get_order_number();

            $order = Orders::create([
                'user_id' => \Auth::id(),
                'code' => getUniqueCode('orders', 'code', Countries::where('name.common', $zone->name)->first()->cca2),
                'amount' => $this->amount,
                'billing_addresses_id' => $billingId,
                'shipping_method' => $shipping->getAttributes()->courier->name,
                'payment_method' => 'cash',
                'shipping_price' => $shipping->getValue(),
                'currency' => get_currency(),
                'order_number' => $order_number
            ]);

            $status = $setting = $this->settings->getData('order', 'open');
            $historyData['user_id'] = $user->id;
            $historyData['status_id'] = ($status) ? $status->val : $this->statuses->where('type', 'order')->first()->id;
            $historyData['note'] = 'Order made';

            $order->history()->create($historyData);

            $shippingAddress = $shippingAddress->toArray();
            $shippingAddress['country'] = ($zone) ? $zone->name : null;
            $shippingAddress['region'] = ($region) ? $region->name : null;

            unset($shippingAddress['id']);
            unset($shippingAddress['created_at']);
            unset($shippingAddress['updated_at']);
            unset($shippingAddress['user_id']);
            $order->shippingAddress()->create($shippingAddress);

            $sales = [];
            foreach ($items as $variation_id => $item) {
                $options = [];
                foreach ($item->attributes->variations as $variation) {
                    $dataV = [];
                    $dataV['price'] = $variation['price'];
                    $dataV['options'] = [];
                    foreach ($variation['options'] as $option) {
                        if (isset($sales[$option['option']->item_id])) {
                            $sales[$option['option']->item_id] = $sales[$option['option']->item_id] + $option['qty'];
                        } else {
                            $sales[$option['option']->item_id] = $option['qty'];
                        }
                        $discount = null;;
                        if($option['option']->price_type == 'discount'){
                            if($option['option']->discount_type =='fixed'){
                                $discount = StockVariationDiscount::where("variation_id",$option['option']->id)->first();
                            }else{
                                $discount = $option['option']->discounts()->where('from','<=',$option['qty'])->where('to','>=',$option['qty'])->first();
                            }
                        }

                        $dataV['options'][] = [
                            'qty' => $option['qty'],
                            'name' => $option['option']->name,
                            'title' => $option['option']->title,
                            'id' => $option['option']->id,
                            'image' => $option['option']->image,
                            'variation' => $option['option'],
                            'unique_id' => uniqid(),
                            'discount' => $discount
                        ];
                    }
                    $options[$variation['group']->variation_id] = $dataV;
                }

                $extras = [];
                if($item->attributes->has('extra') && isset($item->attributes->extra['data'])){
                    foreach ($item->attributes->extra['data'] as $extra) {
                        $dataV = [];
                        $dataV['price'] = $extra['price'];
                        $dataV['options'] = [];
                        foreach ($extra['variations']['options'] as $option) {
                            if (isset($sales[$option['option']->item_id])) {
                                $sales[$option['option']->item_id] = $sales[$option['option']->item_id] + 1;
                            } else {
                                $sales[$option['option']->item_id] = 1;
                            }

                            $discount = null;;
                            if($option['option']->price_type == 'discount'){
                                if($option['option']->discount_type =='fixed'){
                                    $discount = StockVariationDiscount::where("variation_id",$option['option']->id)->first();
                                }else{
                                    $discount = $option['option']->discounts()->where('from','<=',$option['qty'])->where('to','>=',$option['qty'])->first();
                                }
                            }

                            $dataV['options'][] = [
                                'qty' => $option['qty'],
                                'name' => $option['option']->name,
                                'title' => $option['option']->title,
                                'id' => $option['option']->id,
                                'image' => $option['option']->image,
                                'variation' => $option['option'],
                                'unique_id' => uniqid(),
                                'discount' => $discount
                            ];
                        }
                        $extras[$extra['variations']['group']->variation_id] = $dataV;
                    }
                }


                if (count($sales)) {
                    foreach ($sales as $item_id => $sale) {
                        Others::create([
                            'item_id' => $item_id,
                            'user_id' => $user->id,
                            'qty' => (int)$sale * $item->quantity,
                            'reason' => 'sold',
                            'grouped' => $order->id,
                        ]);
                    }
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'name' => $item->attributes->product->name,
                    'sku' => '',
                    'stock_id' => $item->attributes->product->id,
                    'variation_id' => $variation_id,
                    'price' => $item->price,
                    'qty' => $item->quantity,
                    'amount' => $item->price * $item->quantity,
                    'image' => $item->attributes->product->image,
                    'options' => ['options' => $options, 'extras' => $extras]
                ]);
            }

            OrdersJob::makeNew($order->id);
            event(new OrderSubmitted($user, $order));

            return $order;
        });

        return \Response::json(['error' => false, 'url' => route('admin_orders')]);
    }

    public function stripeCharge(Request $request)
    {
        putenv('STRIPE_API_KEY=' . stripe_secret());
        putenv('STRIPE_API_VERSION=2016-07-06');

        $billingId = $shippingId = session()->get('order_new_shipping_address_id');
        $userId = session()->get('order_new_user_id');
        $user = User::findOrFail($userId);

        $stripe = new Stripe();

// This is a $20.00 charge in US Dollar.
        $charge = $stripe->charges()->create(
            array(
                'amount' => Cart::session(Orders::ORDER_NEW_SESSION_ID)->getTotal(),
                'currency' => 'usd',
                'source' => $request->get('stripeToken')
            )
        );
        $data = [];
        $data['user_id'] = $user->id;
        $data['transaction_id'] = $charge['id'];
        $data['amount'] = $charge['amount'];
        $data['currency_code'] = $charge['currency'];
        $data['payment_status'] = $charge['status'];
        $transaction = StripePayments::create($data);
        $order = $this->orderStripe($transaction, $user);

        if (!Cart::session(Orders::ORDER_NEW_SESSION_ID)->isEmpty() && session()->has('order_new_shipping_address_id') && session()->has('order_new_user_id') && $order) {
            session()->forget('order_new_user_id', 'order_new_shipping_address_id', 'order_new_customer_notes', 'order_new_coupon');
            Cart::session(Orders::ORDER_NEW_SESSION_ID)->clear();
            Cart::session(Orders::ORDER_NEW_SESSION_ID)->removeConditionsByType('shipping');

            return redirect('admin_orders');
        }
    }

    private function orderStripe($transaction, $user)
    {
        $billingId = $shippingId = session()->get('order_new_shipping_address_id');
        $customer_notes = session()->get('order_new_customer_notes');
        $coupon = session()->get('order_new_coupon');

        $shippingAddress = Addresses::find($shippingId);
        $zone = ($shippingAddress) ? ZoneCountries::find($shippingAddress->country) : null;
        $geoZone = ($zone) ? $zone->geoZone : null;
        $shipping = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getCondition($geoZone->name);

        $order = \DB::transaction(function () use ($billingId, $shippingId, $transaction, $geoZone, $shippingAddress, $zone, $user, $customer_notes, $coupon) {
            $shipping = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getCondition($geoZone->name);
            $items = $this->cartService->getCartItems(true);
            $order_number = get_order_number();

            $order = Orders::create([
                'user_id' => $user->id,
                'transaction_id' => $transaction->id,
                'code' => getUniqueCode('orders', 'code', Countries::where('name.common', $zone->name)->first()->cca2),
                'amount' => Cart::session(Orders::ORDER_NEW_SESSION_ID)->getTotal(),
                'billing_addresses_id' => $billingId,
                'shipping_method' => $shipping->getAttributes()->courier->name,
                'payment_method' => 'stripe',
                'shipping_price' => $shipping->getValue(),
                'currency' => 'usd',
                'order_number' => $order_number,
                'customer_notes' => $customer_notes,
                'coupon_code' => $coupon,
            ]);
            if (user_can_claim($user)) {
                event(new ClaimReferralBonus($user->inviter, $user));
            }
            $settings = $this->settings->getEditableData('orders_statuses');
            if ($settings && isset($settings['submitted'])) {
                $historyData['user_id'] = $user->id;
                $historyData['status_id'] = $settings['submitted'];
                $order->history()->create($historyData);
            }

            $shippingAddress = $shippingAddress->toArray();
            unset($shippingAddress['id']);
            unset($shippingAddress['created_at']);
            unset($shippingAddress['updated_at']);
            unset($shippingAddress['user_id']);
            $order->shippingAddress()->create($shippingAddress);

            $this->cartService->saveOrderItems($items, $order);

            OrdersJob::makeNew($order->id);

            return $order;
        });

        return \Response::json(['error' => false, 'url' => route('admin_orders')]);
    }

    public function postApplyCoupon(Request $request)
    {
        $now = strtotime(today()->toDateString());
        $coupon = Coupons::where('code', $request->code)->where('status', true)
            ->where('start_date', '<=', $now)->where('end_date', '>=', $now)->first();
//        Cart::getConditions();
//        dd(Cart::session(Orders::ORDER_NEW_SESSION_ID)->getConditions());
        Cart::session(Orders::ORDER_NEW_SESSION_ID)->removeConditionsByType('coupon');
        $cartItems = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getContent();
        foreach ($cartItems as $cartItem) {
            Cart::session(Orders::ORDER_NEW_SESSION_ID)->clearItemConditions($cartItem->id);
        }

        $error = false;
        $message = '';
        if ($coupon) {
            session()->put('order_new_coupon', $request->code);

            //checking if user can apply this coupon
            if ($coupon->target) {
                if ($coupon->users && count($coupon->users) && !in_array(\Auth::id(), $coupon->users)) {
                    $error = true;
                    $message = 'Please enter a valid coupon code, ... you can not use this(testing)';
                }
            }

            if ($error == false) {
                $subtotal = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getSubTotal();
                if ($subtotal >= $coupon->total_amount) {
                    if ($coupon->based == 'cart') {
                        $cc = new \Darryldecode\Cart\CartCondition(array(
                            'name' => $coupon->name,
                            'type' => 'coupon',
                            'target' => 'total',
                            'value' => ($coupon->type == 'p') ? "-" . $coupon->discount . "%" : "-" . $coupon->discount
                        ));

                        Cart::session(Orders::ORDER_NEW_SESSION_ID)->condition($cc);
                    } else {
                        if ($coupon->variations && count($coupon->variations)) {
                            $cc = new \Darryldecode\Cart\CartCondition(array(
                                'name' => $coupon->name,
                                'type' => 'coupon',
                                'value' => ($coupon->type == 'p') ? "-" . $coupon->discount . "%" : "-" . $coupon->discount
                            ));
                            foreach ($cartItems as $item) {
                                if (in_array($item->id, $coupon->variations)) {
                                    \Cart::addItemCondition($item->id, $cc);
                                }
                            }
                        }
                    }
                }
            }
        } else {
            if ($request->code == '') {
                $error = false;
                $message = '';
            } else {
                $error = true;
                $message = 'Please enter a valid coupon ';
            }
        }

        $user = User::find($request->user_id);
        $items = $this->cartService->getCartItems(true);
        $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
        $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
        $geoZone = ($zone) ? $zone->geoZone : null;
        $subtotal = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getSubTotal();
        $delivery = ($geoZone) ? $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first() : null;

        $shippingHtml = $this->view("_partials.shipping_payment", compact('user', 'delivery', 'geoZone'))->render();
        $orderSummary = $this->view("_partials.order_summary", compact('user', 'geoZone'))->render();

        return \Response::json(['error' => $error, 'message' => $message, 'shippingHtml' => $shippingHtml, 'summaryHtml' => $orderSummary]);
    }

    public function postApplyCustomerNotes(Request $request)
    {
        session()->put('order_new_customer_notes', $request->note);

        return \Response::json(['error' => false]);

    }

    public function printPdf(Request $request,$id,Settings $settings,PrinterService $printerService)
    {
// This  $data array will be passed to our PDF blade
        $settings = $settings->getEditableData('admin_general_settings');
        $order = Orders::findOrFail($id);
        $data = [
            'order' => $order,
            'settings' => $settings,
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry
            s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'
        ];

        if(! \File::isDirectory(storage_path("app".DS."printer"))){
            \File::makeDirectory(storage_path("app".DS."printer"));
        }

        $pdf = \PDF::loadView('admin.pdf.invoice', $data)->save(storage_path("app".DS."printer").DS.$order->order_number."-invoice.pdf");
        $pdfShipping = \PDF::loadView('admin.pdf.shipping', $data)->save(storage_path("app".DS."printer").DS.$order->order_number."-shipping.pdf");

        $printerService->call("invoice",storage_path("app".DS."printer").DS.$order->order_number."-invoice.pdf");

        $printerService->call("shipping",storage_path("app".DS."printer").DS.$order->order_number."-shipping.pdf");

        foreach ($order->items as $item){
            if($item->stock && $item->stock->downloads && count($item->stock->downloads)){
                foreach ($item->stock->downloads as $download){
                    $printerService->call("downloads",url($download));
                }
            }
        }

        return redirect()->back()->with("success","Printing started !!!");
    }
}
