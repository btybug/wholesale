<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Events\ClaimReferralBonus;
use App\Http\Controllers\Admin\Requests\OrderHistoryRequest;
use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\Coupons;
use App\Models\Items;
use App\Models\Orders;
use App\Models\OrdersJob;
use App\Models\Statuses;
use App\Models\Settings;
use App\Models\Stock;
use App\Models\StockVariation;
use App\Models\StripePayments;
use App\Models\ZoneCountries;
use App\Services\CartService;
use App\Services\OrdersService;
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

    public function __construct(
        Statuses $statuses,
        Settings $settings,
        CartService $cartService,
        Countries $countries,
        GeoZones $geoZones
    )
    {
        $this->statuses = $statuses;
        $this->settings = $settings;
        $this->cartService = $cartService;
        $this->countries = $countries;
        $this->geoZones = $geoZones;
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
//        dd($statuses,$model,$hidden);
        return $this->view('manage', compact('order', 'statuses','settings'));
    }

    public function getNew()
    {
        $user = null;
        $products = Stock::all()->pluck('name', 'id')->all();
        $statuses = $this->statuses->where('type', 'order')->get()->pluck('name', 'id');
        $users = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->whereNull('role_id')
            ->orWhere('roles.type', 'frontend')->select('users.*', 'roles.title')->pluck('name', 'users.id');
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
        $statuses = $this->statuses->where('type', 'order')->get()->pluck('name', 'id')->all();
        $settings = $this->settings->getEditableData('order');

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
//        dd($request->all());
        $error = true;
        $message = '';
        $success = false;
        if($request->unique_id){
            $error = false;

            $collect = $order->collections()->create([
                'unique_id' => $request->unique_id
            ]);

            $settings = $this->settings->getEditableData('orders_statuses');

            $count = $request->count;
            $collected = $order->collections->count();
            $itemsNeedCollect = $count - $collected;
            if ($count == $collected) {
                $success = true;
                if ($settings && isset($settings['collected'])) {
                    $historyData['user_id'] = \Auth::id();
                    $historyData['status_id'] = $settings['collected'];
                    $order->history()->create($historyData);
                }
            } else {
                $message = "You need collect $itemsNeedCollect item(s)";

                if ($collected == 1 && $settings && isset($settings['partially_collected'])) {
                    $historyData['user_id'] = \Auth::id();
                    $historyData['status_id'] = $settings['partially_collected'];
                    $order->history()->create($historyData);
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

        $shippingAddress = Addresses::find($shippingId);
        $zone = ($shippingAddress) ? ZoneCountries::find($shippingAddress->country) : null;
        $geoZone = ($zone) ? $zone->geoZone : null;
        $shipping = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getCondition($geoZone->name);

        $order = \DB::transaction(function () use ($billingId, $shippingId, $geoZone, $shippingAddress, $zone, $user, $customer_notes, $coupon) {
            $shipping = Cart::session(Orders::ORDER_NEW_SESSION_ID)->getCondition($geoZone->name);
            $items = $this->cartService->getCartItems(true);
            $order_number = get_order_number();

            $order = Orders::create([
                'user_id' => $user->id,
                'code' => getUniqueCode('orders', 'code', Countries::where('name.common', $zone->name)->first()->cca2),
                'amount' => Cart::session(Orders::ORDER_NEW_SESSION_ID)->getTotal(),
                'billing_addresses_id' => $billingId,
                'shipping_method' => $shipping->getAttributes()->courier->name,
                'payment_method' => 'cash',
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

            session()->forget('order_new_shipping_address_id', 'order_new_user_id', 'order_new_customer_notes', 'order_new_coupon');
            Cart::session(Orders::ORDER_NEW_SESSION_ID)->clear();
            Cart::session(Orders::ORDER_NEW_SESSION_ID)->removeConditionsByType('shipping');

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

    public function printPdf(Request $request,$id,Settings $settings)
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

        $pdf = \PDF::loadView('admin.pdf.invoice', $data);

        return $pdf->download('invoice.pdf');
    }
}
