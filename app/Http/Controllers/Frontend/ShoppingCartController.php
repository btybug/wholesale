<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\Coupons;
use App\Models\DeliveryCosts;
use App\Models\GeoZones;
use App\Models\Orders;
use App\Models\Posts;
use App\Models\Settings;
use App\Models\Stock;
use App\Models\StockVariation;
use App\Models\StockVariationOption;
use App\Models\ZoneCountries;
use App\Services\CartService;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Countries\Package\Countries;
use View;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    protected $view = 'frontend.shop';

    private $cartService;
    private $countries;
    private $geoZones;

    public function __construct(
        CartService $cartService,
        Countries $countries,
        GeoZones $geoZones
    )
    {
        $this->cartService = $cartService;
        $this->countries = $countries;
        $this->geoZones = $geoZones;
    }

    public function index()
    {
        return $this->view('index');
    }

    public function getCart()
    {
//        Cart::clear();
        enableFilter();
        $items = Cart::getContent();
        $data = $this->cartService->getShipping($items);

        $default_shipping = $data['default_shipping'];
        $shipping = $data['shipping'];
        $geoZone = $data['geoZone'];

        return $this->view('cart', compact(['items', 'default_shipping', 'shipping', 'geoZone']));
    }

    public function getCheckOut()
    {
        $items = Cart::getContent();
        if (!count($items)) return redirect('/');

        session()->forget('shipping_address', 'billing_address', 'payment_token');
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
                session()->put('billing_address_id', $default_shipping->id);
                session()->put('shipping_address_id', $default_shipping->id);
                $shipping = Cart::getCondition($geoZone->name);

                if (count($geoZone->deliveries)) {
                    $subtotal = Cart::getSubTotal();
                    $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();
                    if(! $shipping) {
                        Cart::removeConditionsByType('shipping');
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
                            Cart::condition($condition2);
                            $shipping = Cart::getCondition($geoZone->name);
                        }
                    }
                }
            }
        }

        return $this->view('check_out', compact(['billing_address', 'default_shipping', 'countries', 'countriesShipping', 'geoZone', 'shipping', 'delivery', 'address', 'address_id']));
    }

    public function postAddToCart(Request $request)
    {
        $product = Stock::where('status', true)->find($request->product_id);
        if ($product) {
            $error = $this->cartService->validateProduct($product, $request->variations);
//            dd($this->cartService->variations,$this->cartService->price);
            if (!$error) {
                $cart_id = uniqid();
                Cart::add($cart_id, $product->id, $this->cartService->price, $request->product_qty, ['variations' => $this->cartService->variations, 'product' => $product]);

//                if (Auth::check()) {
//                    $user = \Auth::user();
//                    $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
//                    $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
//                    $geoZone = ($zone) ? $zone->geoZone : null;
//                    if ($geoZone && count($geoZone->deliveries)) {
//                        $subtotal = Cart::getSubTotal();
//                        Cart::removeConditionsByType('shipping');
//                        $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();
//                        if ($delivery && count($delivery->options)) {
//                            $shippingDefaultOption = $delivery->options->first();
//                            $condition2 = new \Darryldecode\Cart\CartCondition(array(
//                                'name' => $geoZone->name,
//                                'type' => 'shipping',
//                                'target' => 'total',
//                                'value' => $shippingDefaultOption->cost,
//                                'order' => 1,
//                                'attributes' => $shippingDefaultOption
//                            ));
//                            Cart::condition($condition2);
//                        }
//                    }
//                }

                $headerhtml = \View('frontend._partials.shopping_cart_options')->render();
                $popuphtml = \View('frontend.products._partials.offer_popup',['vape' => $product,'key' => $cart_id,
                    'price' => $this->cartService->price,'qty' => $request->product_qty])->render();

                return \Response::json(['error' => false,'show_popup' => (count($product->special_offers) > 0)?true:false, 'message' => 'added', 'key' => $cart_id,'product_id' => $product->id,
                    'count' => $this->cartService->getCount(), 'headerHtml' => $headerhtml,'specialHtml' => $popuphtml]);
            }

            return \Response::json(['error' => true, 'message' => $error]);
        }

        return \Response::json(['error' => true, 'message' => 'try again']);
    }

    public function postAddExtraToCart(Request $request)
    {
        if(! Cart::isEmpty()){
            $key = $request->key;
            $product = Stock::where('status', true)->find($request->product_id);
            if($product){
                $error = $this->cartService->validateExtra($product, $request->variations);
                if(! $error) {
                    $parent = Cart::get($key);
                    if($parent){
                        $attrs = $parent->attributes;
                        $newAttr = [];
                        if( $parent->attributes->has('extra') && isset($parent->attributes->extra['data']))
                        {
                            $data = $parent->attributes->extra['data'];
                            $price = $parent->attributes->extra['price'];
                            $x = [];
                            foreach ($data as $datum){
                                $x[] = $datum;
                            }

                            $newData = $this->cartService->extras['data'];
                            $price = $price + $this->cartService->extras['price'];

                            foreach ($newData as $datum){
                                $x[] = $datum;
                            }


                            $newAttr = ['data' => $x,'price' => $price];
                            $attrs['extra'] = $newAttr;
                        }
                        else
                        {
                            $attrs['extra'] = $this->cartService->extras;
                        }

                        Cart::update($key, array(
                            'attributes' => $attrs
                        ));

                        $data = $this->cartService->getShipping(Cart::getContent());
                        $default_shipping = $data['default_shipping'];
                        $shipping = $data['shipping'];
                        $geoZone = $data['geoZone'];
                        $html = \View("frontend.shop._partials.cart_table",compact(['default_shipping','shipping','geoZone']))->render();

                        return \Response::json(['error' => false, 'message' => 'Extra Product added',
                            'html' => $html]);

                    }
                }


              return \Response::json(['error' => true, 'message' => $error]);
            }

          return \Response::json(['error' => true, 'message' => "product not found"]);
        }

        return \Response::json(['error' => true, 'message' => 'Cart is empty, you can\'t add extra']);
    }

    public function postUpdateQty(Request $request)
    {
        $qty = ($request->condition == "true") ? 1 : -1;
        $default_shipping = null;
        $shipping = null;
        $geoZone = null;
        if($request->condition == 'inner'){
            Cart::update($request->uid, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->value
                )));
        }else{
            Cart::update($request->uid, array(
                'quantity' => $qty
            ));
        }


        if (\Auth::check()) {
            $default_shipping = \Auth::user()->addresses()->where('type', 'default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if ($geoZone && count($geoZone->deliveries)) {
                $subtotal = Cart::getSubTotal();
                $shipping = Cart::getCondition($geoZone->name);
                $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();

                if(! $shipping){
                    Cart::removeConditionsByType('shipping');

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
                        Cart::condition($condition2);
                        $shipping = Cart::getCondition($geoZone->name);
                    }
                }
            }
        }

        $items = Cart::getContent();

        $html = $this->view('_partials.cart_table', compact(['items', 'default_shipping', 'shipping', 'geoZone']))->render();
        $headerhtml = \View('frontend._partials.shopping_cart_options')->render();

        return \Response::json(['error' => false, 'html' => $html, 'headerHtml' => $headerhtml]);
    }

    public function postRemoveFromCart(Request $request)
    {
        $default_shipping = null;
        $shipping = null;
        $geoZone = null;

        if($request->section_id){
             $this->cartService->removeExtra($request->uid,$request->section_id);
        }else{
            $this->cartService->remove($request->uid);
        }

        if (\Auth::check()) {
            $default_shipping = \Auth::user()->addresses()->where('type', 'default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if ($geoZone && count($geoZone->deliveries)) {
                $subtotal = Cart::getSubTotal();
                $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();
                $shipping = Cart::getCondition($geoZone->name);

                if(!$shipping){
                    Cart::removeConditionsByType('shipping');
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
                        Cart::condition($condition2);
                        $shipping = Cart::getCondition($geoZone->name);
                    }
                }
            }
        }

        $items = Cart::getContent();
        $html = $this->view('_partials.cart_table', compact(['items', 'default_shipping', 'shipping', 'geoZone']))->render();
        $headerhtml = \View('frontend._partials.shopping_cart_options')->render();

        return \Response::json(['error' => false, 'html' => $html, 'count' => $this->cartService->getCount(), 'headerHtml' => $headerhtml]);
    }

    public function postChangeShippingMethod(Request $request)
    {
        $items = $this->cartService->getCartItems();
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

            $subtotal = Cart::getSubTotal();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;

            if ($geoZone) {
                Cart::removeConditionsByType('shipping');
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
                        Cart::condition($condition2);
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
                            Cart::condition($condition2);
                        }
                    }
                }

                session()->put('billing_address_id', $default_shipping->id);
                session()->put('shipping_address_id', $default_shipping->id);
                $shipping = Cart::getCondition($geoZone->name);
            }
        }


        $html = $this->view('_partials.checkout_render',
            compact(['billing_address', 'default_shipping', 'countries', 'countriesShipping', 'geoZone', 'shipping', 'delivery', 'address']))->with('address_id', $request->addressId)->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postPaymentOptions(Request $request)
    {
        session()->put('shipping_address', session()->get('shipping_address_id'));
        session()->put('billing_address', session()->get('billing_address_id'));
        $token = md5(uniqid());
        session()->put('payment_token', $token);

        return \Response::json(['error' => false, 'url' => route('shop_payment', $token)]);
    }

    public function getPayment($token)
    {
        $createdToken = session()->get('payment_token');
        if ($createdToken != $token) {
            abort(404);
        }

        $items = $this->cartService->getCartItems();
        if (!count($items)) return redirect('/');

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
            $default_shipping = $user->addresses()->where('id', session()->get('shipping_address_id'))->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if ($geoZone) {
                if (count($geoZone->deliveries)) {
                    $subtotal = Cart::getSubTotal();
                    $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();
                    $shipping = Cart::getCondition($geoZone->name);

                    if(! $shipping){
                        Cart::removeConditionsByType('shipping');
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
                            Cart::condition($condition2);
                            $shipping = Cart::getCondition($geoZone->name);
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
        Cart::removeConditionsByType('coupon');
        $cartItems = Cart::getContent();
        foreach ($cartItems as $cartItem) {
            Cart::clearItemConditions($cartItem->id);
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
                $subtotal = Cart::getSubTotal();
                if ($subtotal >= $coupon->total_amount) {
                    if ($coupon->based == 'cart') {
                        $cc = new \Darryldecode\Cart\CartCondition(array(
                            'name' => $coupon->name,
                            'type' => 'coupon',
                            'target' => 'total',
                            'value' => ($coupon->type == 'p') ? "-" . $coupon->discount . "%" : "-" . $coupon->discount
                        ));

                        Cart::condition($cc);
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

        $user = Auth::user();
        $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
        $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
        $geoZone = ($zone) ? $zone->geoZone : null;
        $shipping = Cart::getCondition($geoZone->name);

        $orderSummary = $this->view("_partials.order_summary", compact('shipping'))->render();

        return \Response::json(['error' => $error, 'message' => $message, 'summaryHtml' => $orderSummary]);
    }

    public function postSpecialOfferModal(Request $request)
    {
        $cart_id = $request->item_id;
        $item = Cart::get($cart_id);
        if($item){
            $product = Stock::find($item->attributes->product->id);
            $price = $item->price;
            $qty = $item->quantity;
            $extras = ($item->attributes->has('extra')) ? $item->attributes->extra['data'] : [];

            $popuphtml = \View('frontend.products._partials.offer_popup',['vape' => $product,'key' => $cart_id,'price' => $price,'qty' => $qty,'extras' => $extras])->render();
            return response()->json(['error' => false,'html' => $popuphtml]);
        }

        return response()->json(['error' => true]);
    }
}
