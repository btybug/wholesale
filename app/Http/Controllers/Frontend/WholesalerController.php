<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupons;
use App\Models\DeliveryCosts;
use App\Models\GeoZones;
use App\Models\Items;
use App\Models\Statuses;
use App\Models\Settings;
use App\Models\ZoneCountries;
use App\Services\CartService;
use App\Services\FileService;
use App\User;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class WholesalerController extends Controller
{
    private $countries;
    private $geoZones;
    private $statuses;
    private $category;
    private $user;
    private $fileService;
    private $settings;
    private $cartService;

    protected $view = 'frontend.wholesaler';

    public function __construct(
        Countries $countries,
        GeoZones $geoZones,
        Statuses $statuses,
        Category $category,
        User $user,
        FileService $fileService,
        Settings $settings,
        CartService $cartService
    )
    {
        $this->countries = $countries;
        $this->geoZones = $geoZones;
        $this->statuses = $statuses;
        $this->category = $category;
        $this->user = $user;
        $this->fileService = $fileService;
        $this->settings = $settings;
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $categories = Category::with('children')->where('type', 'stocks')->whereNull('parent_id')->get()->pluck('name', 'slug');
        $items = Items::all();

        if($request->ajax()){
            $html = View('frontend.wholesaler._partials.items_render',compact(['items']))->render();
            return response()->json(['error' => false, 'html' => $html]);
        }
        return $this->view('index', compact('items'));
    }

    public function addToCart(Request $request){
        $item = Items::findOrFail($request->id);

        Cart::session('wholesaler')->add($item->id, $item->name, $item->default_price, 1,
            ['item' => $item]);
        $headerhtml = \View('frontend.wholesaler._partials.shopping_cart_options')->render();

        $cartData = Cart::session('wholesaler')->getContent();
        return \Response::json(['error' => false, 'message' => 'added', 'item_id' => $item->id,
            'count' => count($cartData), 'headerHtml' => $headerhtml]);

    }

    public function getCart()
    {
//        Cart::clear();
        enableFilter();
        $items = Cart::session('wholesaler')->getContent();
        $data = $this->cartService->getShippingWholesaler($items);

        $default_shipping = $data['default_shipping'];
        $shipping = $data['shipping'];
        $geoZone = $data['geoZone'];

        return $this->view('cart', compact(['items', 'default_shipping', 'shipping', 'geoZone']));
    }

    public function getCheckOut()
    {
        $items = Cart::session('wholesaler')->getContent();
        if (!count($items)) return redirect('/wholesale');

        session()->forget('shipping_address_wholesale', 'billing_address_wholesale', 'payment_token_wholesale');
        $billing_address = [];
        $default_shipping = [];
        $geoZone = null; //need to change
        $shipping = null;
        $delivery = null;
        $address_id = null;
        $address = [];
        $countries = $this->countries->all()->pluck('name.common', 'name.common')->toArray();
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        if (\Auth::check()) {
            $user = \Auth::user();
            $address = $user->addresses()->whereIn('type', ['address_book', 'default_shipping'])->pluck('first_line_address', 'id');
//            $billing_address=$user->addresses()->where('type','billing_address')->first();
            $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if ($geoZone) {
                session()->put('billing_address_wholesaler_id', $default_shipping->id);
                session()->put('shipping_address_wholesaler_id', $default_shipping->id);
                $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);

                if (count($geoZone->deliveries)) {
                    $subtotal = Cart::session('wholesaler')->getSubTotal();
                    $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();
                    if(! $shipping) {
                        Cart::session('wholesaler')->removeConditionsByType('shipping');
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
                            Cart::session('wholesaler')->condition($condition2);
                            $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);
                        }
                    }
                }
            }
        }

        return $this->view('check_out', compact(['billing_address', 'default_shipping', 'countries', 'countriesShipping', 'geoZone', 'shipping', 'delivery', 'address', 'address_id']));
    }

    public function postChangeShippingMethod(Request $request)
    {
        $items = Cart::session('wholesaler')->getContent();
        $billing_address = [];
        $default_shipping = [];
        $address = [];
        $geoZone = null; //need to change
        $shipping = null;
        $delivery = null;
        $countries = $this->countries->all()->pluck('name.common', 'name.common')->toArray();
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        if (\Auth::check()) {
            $user = \Auth::user();
            $address = $user->addresses()->whereIn('type', ['address_book', 'default_shipping'])->pluck('first_line_address', 'id');
//            $billing_address = $user->addresses()->where('type','billing_address')->first();

            if ($request->addressId) {
                $default_shipping = $user->addresses()->where('id', $request->addressId)->first();
            } else {
                $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
            }

            $subtotal = Cart::session('wholesaler')->getSubTotal();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;

            if ($geoZone) {
                Cart::session('wholesaler')->removeConditionsByType('shipping');
                if ($request->addressId && !$request->deliveryId && !$request->optionId) {
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
                        Cart::session('wholesaler')->condition($condition2);
                    }
                } else {
//                    $delivery = $geoZone->deliveries()->where('id', $request->deliveryId)->first();
                    $delivery = DeliveryCosts::find($request->deliveryId);
                    if ($delivery) {
                        $shippingDefaultOption = $delivery->options()->where('id', $request->optionId)->first();
                        if ($shippingDefaultOption) {
                            Cart::removeConditionsByType('shipping');
                            $condition2 = new \Darryldecode\Cart\CartCondition(array(
                                'name' => $geoZone->name,
                                'type' => 'shipping',
                                'target' => 'total',
                                'value' => $shippingDefaultOption->cost,
                                'order' => 1,
                                'attributes' => $shippingDefaultOption
                            ));
                            Cart::session('wholesaler')->condition($condition2);
                        }
                    }
                }

                session()->put('billing_address_wholesaler_id', $default_shipping->id);
                session()->put('shipping_address_wholesaler_id', $default_shipping->id);
                $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);
            }
        }


        $html = $this->view('_partials.checkout_render',
            compact(['billing_address', 'default_shipping', 'countries', 'countriesShipping', 'geoZone', 'shipping', 'delivery', 'address']))
            ->with('address_id', $request->addressId)->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postUpdateQty(Request $request)
    {
        $qty = ($request->condition == "true") ? 1 : -1;
        $default_shipping = null;
        $shipping = null;
        $geoZone = null;
        if($request->condition == 'inner'){
        Cart::session('wholesaler')->update($request->uid, array(
        'quantity' => array(
        'relative' => false,
        'value' => $request->value
        )));
        }else{
            Cart::session('wholesaler')->update($request->uid, array(
                'quantity' => $qty
            ));
        }

        if (\Auth::check()) {
            $default_shipping = \Auth::user()->addresses()->where('type', 'default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if ($geoZone && count($geoZone->deliveries)) {
                $subtotal = Cart::session('wholesaler')->getSubTotal();
                $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);
                $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();

                if(! $shipping){
                    Cart::session('wholesaler')->removeConditionsByType('shipping');

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
                        Cart::session('wholesaler')->condition($condition2);
                        $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);
                    }
                }
            }
        }

        $items = Cart::session('wholesaler')->getContent();

        $html = $this->view('_partials.cart_table', compact(['items', 'default_shipping', 'shipping', 'geoZone']))->render();
        $headerhtml = \View('frontend.wholesaler._partials.shopping_cart_options')->render();

        return \Response::json(['error' => false, 'html' => $html, 'headerHtml' => $headerhtml]);
    }

    public function postRemoveFromCart(Request $request)
    {
        $default_shipping = null;
        $shipping = null;
        $geoZone = null;

        Cart::session('wholesaler')->remove($request->uid);

        if (\Auth::check()) {
            $default_shipping = \Auth::user()->addresses()->where('type', 'default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if ($geoZone && count($geoZone->deliveries)) {
                $subtotal = Cart::session('wholesaler')->getSubTotal();
                $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();
                $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);

                if(!$shipping){
                    Cart::session('wholesaler')->removeConditionsByType('shipping');
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
                        Cart::session('wholesaler')->condition($condition2);
                        $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);
                    }
                }
            }
        }

        $items = Cart::session('wholesaler')->getContent();
        $html = $this->view('_partials.cart_table', compact(['items', 'default_shipping', 'shipping', 'geoZone']))->render();
        $headerhtml = \View('frontend.wholesaler_partials.shopping_cart_options')->render();

        return \Response::json(['error' => false, 'html' => $html, 'count' => count($items), 'headerHtml' => $headerhtml]);
    }

    public function postPaymentOptions(Request $request)
    {
        session()->put('shipping_address_wholesale', session()->get('shipping_address_wholesaler_id'));
        session()->put('billing_address_wholesale', session()->get('billing_address_wholesaler_id'));
        $token = md5(uniqid());
        session()->put('payment_token_wholesale', $token);

        return \Response::json(['error' => false, 'url' => route('wholesaler_payment', $token)]);
    }

    public function getPayment($token)
    {
        $createdToken = session()->get('payment_token_wholesale');
        if ($createdToken != $token) {
            abort(404);
        }

        $items = Cart::session('wholesaler')->getContent();

        if (!count($items)) return redirect('/wholesaler');

        $billing_address = [];
        $default_shipping = [];
        $geoZone = null; //need to change
        $shipping = null;
        $delivery = null;
        $address_id = null;
        $address = [];
        $countries = $this->countries->all()->pluck('name.common', 'name.common')->toArray();
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        $active_payments_gateways = (new Settings())->getEditableData('active_payments_gateways');
        $cash = (new Settings())->getEditableData('payments_gateways_cash');
        $stripe = (new Settings())->getEditableData('payments_gateways');
        if (\Auth::check()) {
            $user = \Auth::user();
            $default_shipping = $user->addresses()->where('id', session()->get('shipping_address_wholesaler_id'))->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if ($geoZone) {
                if (count($geoZone->deliveries)) {
                    $subtotal = Cart::session('wholesaler')->getSubTotal();
                    $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();
                    $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);

                    if(! $shipping){
                        Cart::session('wholesaler')->removeConditionsByType('shipping');
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
                            Cart::session('wholesaler')->condition($condition2);
                            $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);
                        }
                    }
                }
            }
        }

        return $this->view('payment', compact(['cash', 'stripe', 'active_payments_gateways', 'billing_address', 'default_shipping',
            'countries', 'countriesShipping', 'geoZone', 'shipping', 'delivery', 'address', 'address_id']));
    }

    public function postApplyCoupon(Request $request)
    {
        $now = strtotime(today()->toDateString());
        $coupon = Coupons::where('code', $request->code)->where('status', true)
            ->where('start_date', '<=', $now)->where('end_date', '>=', $now)->first();
//        Cart::getConditions();
//        dd(Cart::session(Orders::ORDER_NEW_SESSION_ID)->getConditions());
        Cart::session('wholesaler')->removeConditionsByType('coupon');
        $cartItems = Cart::session('wholesaler')->getContent();
        foreach ($cartItems as $cartItem) {
            Cart::session('wholesaler')->clearItemConditions($cartItem->id);
        }

        $error = false;
        $message = '';
        if ($coupon) {
            session()->put('order_new_coupon_wholesaler', $request->code);

            //checking if user can apply this coupon
            if ($coupon->target) {
                if ($coupon->users && count($coupon->users) && !in_array(\Auth::id(), $coupon->users)) {
                    $error = true;
                    $message = 'Please enter a valid coupon code, ... you can not use this(testing)';
                }
            }

            if ($error == false) {
                $subtotal = Cart::session('wholesaler')->getSubTotal();
                if ($subtotal >= $coupon->total_amount) {
                    if ($coupon->based == 'cart') {
                        $cc = new \Darryldecode\Cart\CartCondition(array(
                            'name' => $coupon->name,
                            'type' => 'coupon',
                            'target' => 'total',
                            'value' => ($coupon->type == 'p') ? "-" . $coupon->discount . "%" : "-" . $coupon->discount
                        ));

                        Cart::session('wholesaler')->condition($cc);
                    } else {
                        if ($coupon->variations && count($coupon->variations)) {
                            $cc = new \Darryldecode\Cart\CartCondition(array(
                                'name' => $coupon->name,
                                'type' => 'coupon',
                                'value' => ($coupon->type == 'p') ? "-" . $coupon->discount . "%" : "-" . $coupon->discount
                            ));
                            foreach ($cartItems as $item) {
                                if (in_array($item->id, $coupon->variations)) {
                                    \Cart::session('wholesaler')->addItemCondition($item->id, $cc);
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

        $user = Auth::user();
        $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
        $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
        $geoZone = ($zone) ? $zone->geoZone : null;
        $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);

        $orderSummary = $this->view("_partials.order_summary", compact('shipping'))->render();

        return \Response::json(['error' => $error, 'message' => $message, 'summaryHtml' => $orderSummary]);
    }
}

