<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\GeoZones;
use App\Models\Posts;
use App\Models\Settings;
use App\Models\Stock;
use App\Models\StockVariation;
use App\Models\StockVariationOption;
use App\Models\ZoneCountries;
use App\Services\CartService;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use PragmaRX\Countries\Package\Countries;
use View;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    protected $view= 'frontend.shop';

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
        $items = $this->cartService->getCartItems();
        $default_shipping = null;
        $shipping = null;
        $geoZone  = null;
        if(\Auth::check()){
            $user=\Auth::user();
            $default_shipping=$user->addresses()->where('type','default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if(! count($items)) {
                Cart::removeConditionsByType('shipping');
            }else{
                if($geoZone){
                    $shipping = Cart::getCondition($geoZone->name);
                    if(! $shipping) {
                        Cart::removeConditionsByType('shipping');
                        if(count($geoZone->deliveries)){
                            $subtotal = Cart::getSubTotal();
                            $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max','>=',$subtotal)->first();
                            if($delivery && count($delivery->options)){
                                $shippingDefaultOption =  $delivery->options->first();
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
        }

        return $this->view('cart',compact(['items','default_shipping','shipping','geoZone','shippingDefault']));
    }

    public function getCheckOut()
    {
        $items = $this->cartService->getCartItems();
        if(! count($items)) return redirect('/');

        session()->forget('shipping_address','billing_address','payment_token');
        $billing_address = [];
        $default_shipping = [];
        $geoZone = null; //need to change
        $shipping = null;
        $delivery = null;
        $address_id = null;
        $address = [];
        $countries = $this->countries->all()->pluck('name.common','name.common')->toArray();
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries','geo_zones.id','=','zone_countries.geo_zone_id')
                ->select('zone_countries.*','zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        if(\Auth::check()){
            $user=\Auth::user();
            $address=$user->addresses()->whereIn('type',['address_book','default_shipping'])->pluck('company','id');
//            $billing_address=$user->addresses()->where('type','billing_address')->first();
            $default_shipping=$user->addresses()->where('type','default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if($geoZone){
                session()->put('billing_address_id',$default_shipping->id );
                session()->put('shipping_address_id', $default_shipping->id);

                Cart::removeConditionsByType('shipping');
                if(count($geoZone->deliveries)){
                    $subtotal = Cart::getSubTotal();
                    $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max','>=',$subtotal)->first();
                    if($delivery && count($delivery->options)){
                        $shippingDefaultOption =  $delivery->options->first();
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

        return $this->view('check_out',compact(['billing_address','default_shipping','countries','countriesShipping','geoZone','shipping','delivery','address','address_id']));
    }

    public function postAddToCart(Request $request)
    {
        $variation = StockVariation::find($request->uid);
        if ($variation) {
            if (\Auth::check()) {
                $user = \Auth::user();
                $promotionPrice = $variation->stock->active_sales()->where('variation_id', $variation->id)->first();
                $price = ($promotionPrice) ? $promotionPrice->price : $variation->price;
                Cart::add($variation->id, $variation->id, $price, 1,
                    ['variation' => $variation]);

                $requiredItems = $request->get('requiredItems');
                if ($requiredItems && count($requiredItems)) {
                    foreach ($requiredItems as $opv) {
                        $reqVariation = StockVariation::find($opv);
                        if ($reqVariation) {
                            $promotionPrice = $variation->stock->promotion_prices()->where('variation_id', $reqVariation->id)->first();
                            $reqPrice = ($promotionPrice) ? $promotionPrice->price : $reqVariation->price;
                            Cart::add($variation->id.'.'.$reqVariation->id, $variation->id, $reqPrice, 1,
                                ['variation' => $reqVariation,'type' => 'required']);
                        }
                    }
                }

                $optionalItems = $request->get('optionalItems');
                if ($optionalItems && count($optionalItems)) {
                    foreach ($optionalItems as $opv) {
                        $optpVariation = StockVariation::find($opv);
                        if ($optpVariation) {
                            $promotionPrice = $variation->stock->promotion_prices()->where('variation_id', $optpVariation->id)->first();
                            $reqPrice = ($promotionPrice) ? $promotionPrice->price : $optpVariation->price;
                            Cart::add($variation->id.'.'.$optpVariation->id, $variation->id, $reqPrice, 1,
                                ['variation' => $optpVariation,'type' => 'optional']);
                        }
                    }
                }

                $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
                $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
                $geoZone = ($zone) ? $zone->geoZone : null;
                if ($geoZone && count($geoZone->deliveries)) {
                    $subtotal = Cart::getSubTotal();
                    Cart::removeConditionsByType('shipping');
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
                }
            } else {
                Cart::add($variation->id, $variation->id, $variation->price, 1, ['variation' => $variation]);

                $optionalItems = $request->get('optionalItems');
                if ($optionalItems && count($optionalItems)) {
                    foreach ($optionalItems as $opv) {
                        $optpVariation = StockVariation::find($opv);
                        if ($optpVariation) {
                            Cart::add($optpVariation->id, $variation->id, $optpVariation->price, 1,
                                ['variation' => $optpVariation]);
                        }
                    }
                }
            }

            $headerhtml = \View('frontend._partials.shopping_cart_options')->render();

            return \Response::json(['error' => false, 'message' => 'added', 'count' => $this->cartService->getCount(), 'headerHtml' => $headerhtml]);
        }

        return \Response::json(['error' => true, 'message' => 'try again']);
    }

    public function postUpdateQty(Request $request)
    {
        $qty = ($request->condition) ? 1 : -1;

        $default_shipping = null;
        $shipping = null;
        $geoZone = null;
        if(\Auth::check()){
            $this->cartService->update($request->uid,$qty,$request->condition,$request->value);

            $default_shipping = \Auth::user()->addresses()->where('type','default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if($geoZone && count($geoZone->deliveries)){
                $subtotal = Cart::getSubTotal();
                Cart::removeConditionsByType('shipping');
                $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max','>=',$subtotal)->first();
                if($delivery && count($delivery->options)){
                    $shippingDefaultOption =  $delivery->options->first();
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

        }else{
            $this->cartService->update($request->uid,$qty,$request->condition,$request->value);
        }

        $items = $this->cartService->getCartItems();

        $html = $this->view('_partials.cart_table',compact(['items','default_shipping','shipping','geoZone']))->render();
        $headerhtml = \View('frontend._partials.shopping_cart_options')->render();

        return \Response::json(['error' => false,'html' => $html,'headerHtml' => $headerhtml]);
    }

    public function postRemoveFromCart (Request $request)
    {
        $default_shipping = null;
        $shipping = null;
        $geoZone = null;
        if(\Auth::check()){
            $this->cartService->remove($request->uid);

            $default_shipping = \Auth::user()->addresses()->where('type','default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if($geoZone && count($geoZone->deliveries)){
                $subtotal = Cart::getSubTotal();
                Cart::removeConditionsByType('shipping');
                $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max','>=',$subtotal)->first();
                if($delivery && count($delivery->options)){
                    $shippingDefaultOption =  $delivery->options->first();
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
        }else{
            $this->cartService->remove($request->uid);
        }

        $items = $this->cartService->getCartItems();
        $html = $this->view('_partials.cart_table',compact(['items','default_shipping','shipping','geoZone']))->render();
        $headerhtml = \View('frontend._partials.shopping_cart_options')->render();

        return \Response::json(['error' => false,'html' => $html,'count' => $this->cartService->getCount(),'headerHtml' => $headerhtml]);
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
        $countries = $this->countries->all()->pluck('name.common','name.common')->toArray();
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries','geo_zones.id','=','zone_countries.geo_zone_id')
                ->select('zone_countries.*','zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        if(\Auth::check()){
            $user=\Auth::user();
            $address = $user->addresses()->where('type','address_book')->pluck('company','id');
//            $billing_address = $user->addresses()->where('type','billing_address')->first();

            if($request->addressId){
                $default_shipping=$user->addresses()->where('id',$request->addressId)->first();
            }else{
                $default_shipping=$user->addresses()->where('type','default_shipping')->first();
            }
            $subtotal = Cart::getSubTotal();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;

            if($geoZone){
                Cart::removeConditionsByType('shipping');
               if($request->addressId && ! $request->deliveryId && ! $request->optionId){
                   $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max','>=',$subtotal)->first();
                   if($delivery && count($delivery->options)){
                       $shippingDefaultOption =  $delivery->options->first();
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
               }else{
                   $delivery = $geoZone->deliveries()->where('id',$request->deliveryId)->first();
                   if($delivery) {
                       $shippingDefaultOption = $delivery->options()->where('id', $request->optionId)->first();
                       if($shippingDefaultOption){
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

                session()->put('billing_address_id',$default_shipping->id );
                session()->put('shipping_address_id', $default_shipping->id);
                $shipping = Cart::getCondition($geoZone->name);
            }
        }

        $html = $this->view('_partials.checkout_render',
            compact(['billing_address','default_shipping','countries','countriesShipping','geoZone','shipping','delivery','address']))->with('address_id',$request->addressId)->render();

        return \Response::json(['error' => false,'html' => $html]);
    }

    public function postPaymentOptions(Request $request)
    {
        session()->put('shipping_address', session()->get('shipping_address_id'));
        session()->put('billing_address', session()->get('billing_address_id'));
        $token = md5(uniqid());
        session()->put('payment_token', $token);

        return  \Response::json(['error' => false,'url' => route('shop_payment',$token)]);
    }

    public function getPayment($token)
    {
        $createdToken = session()->get('payment_token');
        if($createdToken != $token){
            abort(404);
        }

        $items = $this->cartService->getCartItems();
        if(! count($items)) return redirect('/');
        
        $billing_address = [];
        $default_shipping = [];
        $geoZone = null; //need to change
        $shipping = null;
        $delivery = null;
        $address_id = null;
        $address = [];
        $countries = $this->countries->all()->pluck('name.common','name.common')->toArray();
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries','geo_zones.id','=','zone_countries.geo_zone_id')
                ->select('zone_countries.*','zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        $active_payments_gateways = ( new Settings() )->getEditableData('active_payments_gateways');
        $cash = ( new Settings() )->getEditableData('payments_gateways_cash');
        $stripe = ( new Settings() )->getEditableData('payments_gateways');
        if(\Auth::check()){
            $user=\Auth::user();
            $default_shipping=$user->addresses()->where('id',session()->get('shipping_address_id'))->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if($geoZone){
                if(count($geoZone->deliveries)){
                    $subtotal = Cart::getSubTotal();
                    $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max','>=',$subtotal)->first();
                    if($delivery && count($delivery->options)){
                        $shippingDefaultOption =  $delivery->options->first();
                        $shipping = Cart::getCondition($geoZone->name);
                    }
                }
            }
        }

        return $this->view('payment',compact(['cash','stripe','active_payments_gateways','billing_address','default_shipping','countries','countriesShipping','geoZone','shipping','delivery','address','address_id']));
    }
}
