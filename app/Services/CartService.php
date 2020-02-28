<?php namespace App\Services;

use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Stock;
use App\Models\StockVariation;
use App\Models\StockVariationDiscount;
use App\Models\ZoneCountries;
use Darryldecode\Cart\Facades\CartFacade as Cart;

/**
 * Created by PhpStorm.
 * User: edo
 * Date: 10/18/2018
 * Time: 1:01 PM
 */
class CartService
{
    public static $cartItems = [];
    public $variations = [];
    public $extras = [];
    public $price = 0;

    public function getCartItems($id = null)
    {
        $cartCollection = ($id) ? Cart::session(Orders::ORDER_NEW_SESSION_ID)->getContent() : Cart::getContent();

        $items = [];
        $empty = ($id) ? Cart::session(Orders::ORDER_NEW_SESSION_ID)->isEmpty() : Cart::isEmpty();
        if (!$empty) {
            foreach ($cartCollection as $key => $value) {
                $items[$value->name][$key] = $value;
            }
        }

        self::$cartItems = $items;

        return $items;
    }

    public function getCount()
    {
        $cartCollection = count($this->getCartItems());
        return $cartCollection;
    }

    public static function getVariation($id)
    {
        return StockVariation::find($id);
    }

    public static function getPriceSum($id)
    {
        $cart = Cart::get($id);
        $price = $cart->price;
        if ($cart && $cart->attributes->has('extra') && isset($cart->attributes['extra']['price'])) {
            $price += $cart->attributes['extra']['price'];
        }
        return ($cart) ? $price * $cart->quantity : $price;
    }

    public static function getTotalPriceSum($session = false)
    {
        $data = ($session) ? Cart::session(Orders::ORDER_NEW_SESSION_ID)->getContent() :Cart::getContent() ;
        $price = 0;
        foreach ($data as $cart) {
            $itemPrice = 0;
            if ($cart->attributes->has('extra') && isset($cart->attributes['extra']['price'])) {
                $itemPrice = $cart->attributes['extra']['price'];
            }

            $price += $itemPrice * $cart->quantity;
        }
        return $price;
    }

    public static function getTotalCouponSum()
    {
        $data = Cart::getConditionsByType('coupon');
        $price = 0;
        foreach ($data as $cart) {
            dd($cart->getValue(),$cart);
//            if ($cart->getTarget() == 'total') {
//                $itemPrice = $cart->attributes['extra']['price'];
//            }

            $price += $cart->getPrice();
        }
        return $price;
    }

    public function remove($id, $user_id = null)
    {
        $list = $this->getCartItems($user_id);
        $data = (isset($list[$id])) ? $list[$id] : [];

        if (count($data)) {
            foreach ($data as $datum) {
                if ($user_id) {
                    Cart::session(Orders::ORDER_NEW_SESSION_ID)->remove($datum->id);
                } else {
                    Cart::remove($datum->id);
                }
            }
        } else {
            if ($user_id) {
                Cart::session(Orders::ORDER_NEW_SESSION_ID)->remove($id);
            } else {
                Cart::remove($id);
            }
        }
    }

    public function removeExtra($id, $section_id, $user_id = null)
    {
        $section = Cart::get($section_id);
        if ($section && $section->attributes->has('extra')) {
            $attrs = $section->attributes;
            $extras = $attrs['extra'];
            foreach ($extras['data'] as $key => $datum) {
                if ($datum['key'] == $id) {
                    $price = $datum['price'];
                    unset($extras['data'][$key]);
                }
            }

            $extras['price'] -= $price;
            $attrs['extra'] = $extras;
            if ($user_id) {
                Cart::session(Orders::ORDER_NEW_SESSION_ID)->update($section_id, array(
                    'attributes' => $attrs
                ));
            } else {
                Cart::update($section_id, array(
                    'attributes' => $attrs
                ));
            }
        }
    }

    public function update($id, $qty, $condition, $value, $user_id = null)
    {
        $list = $this->getCartItems($user_id);
        $data = (isset($list[$id])) ? $list[$id] : [];

        if (count($data)) {
            foreach ($data as $datum) {
                if ($condition == 'inner') {
                    if ($user_id) {
                        Cart::session(Orders::ORDER_NEW_SESSION_ID)->update($datum->id, array(
                            'quantity' => array(
                                'relative' => false,
                                'value' => $value
                            )));
                    } else {
                        Cart::update($datum->id, array(
                            'quantity' => array(
                                'relative' => false,
                                'value' => $value
                            )));
                    }
                } else {
                    if ($user_id) {
                        Cart::session(Orders::ORDER_NEW_SESSION_ID)->update($datum->id, array(
                            'quantity' => $qty
                        ));
                    } else {
                        Cart::update($datum->id, array(
                            'quantity' => $qty
                        ));
                    }
                }
            }
        }
    }

    public function saveOrderItems($items, $order)
    {
        foreach ($items as $variation_id => $item) {
            $main = $item[$variation_id];
            unset($item[$variation_id]);
            $options = [];
            foreach ($main->attributes->variation->options as $option) {
                $options[$option->attr->name] = $option->option->name;
            }

            $mainOrder = OrderItem::create([
                'order_id' => $order->id,
                'name' => $main->attributes->variation->stock->name,
                'sku' => $main->name,
                'variation_id' => $variation_id,
                'price' => $main->price,
                'qty' => $main->quantity,
                'amount' => $main->price * $main->quantity,
                'image' => $main->attributes->variation->stock->image,
                'options' => $options
            ]);

//            if($main->attributes->requiredItems && count($main->attributes->requiredItems)){
//                foreach($main->attributes->requiredItems as $vid){
//                    $reqV = StockVariation::find($vid);
//                    $voptions = [];
//                    foreach ($reqV->options as $option) {
//                        $voptions[$option->attr->name] = $option->option->name;
//                    }
//
//                    $promotionPrice = ($reqV) ? $reqV->stock->promotion_prices()
//                        ->where('variation_id',$reqV->id)->first() : null;
//                    $price = ($promotionPrice) ? $promotionPrice->price : (($reqV) ? $reqV->price : 0);
//                    OrderItem::create([
//                        'order_id' => $order->id,
//                        'name' => $reqV->name,
//                        'sku' => $reqV->variation_id,
//                        'variation_id' => $vid,
//                        'price' => $price,
//                        'qty' => 1,
//                        'amount' => $price,
//                        'image' => $reqV->stock->image,
//                        'options' => $voptions,
//                        'type' => 'required',
//                        'parent_id' => $mainOrder->id
//                    ]);
//                }
//            }

            if (count($item)) {
                foreach ($item as $vid) {
                    $variationOpt = $vid->attributes->variation;

                    $options = [];
                    foreach ($variationOpt->options as $option) {
                        $options[$option->attr->name] = $option->option->name;
                    }

                    OrderItem::create([
                        'order_id' => $order->id,
                        'name' => $variationOpt->stock->name,
                        'sku' => $variationOpt->name,
                        'variation_id' => $variationOpt->variation_id,
                        'price' => $vid->price,
                        'qty' => $vid->quantity,
                        'amount' => $vid->price * $vid->quantity,
                        'image' => $variationOpt->stock->image,
                        'options' => $options,
                        'parent_id' => $mainOrder->id,
                        'type' => $vid->attributes->type
                    ]);
                }
            }
        }
    }

    public function validateProduct($product, $vdata)
    {
        $error = false;
        $extraVariations = $product->variations()->with('item')->required()->groupby('stock_variations.variation_id')->get();
//        dd($vdata);
        if ($vdata && count($vdata) == count($extraVariations)) {
            foreach ($vdata as $k => $item) {
                $data = [];
                $group = $product->variations()->with('item')->where('variation_id', $item['group_id'])->first();
                if ($group) {
                    $data['group'] = $group;
                    $data['options'] = [];
                    $product_limit = 0;

                    if (isset($item['products']) && $item['products'] == 'no') {
                        $data['price'] = 0;
                    }else{
                        if(isset($item['products']) && count($item['products'])) {
                            if ($group->price_per == 'product') {
                                $data['price'] = $group->price;
                                $this->price += $group->price;
                                foreach ($item['products'] as $p) {
                                    $option = $product->variations()->with('item')->where('variation_id', $item['group_id'])->where('id', $p['id'])->first();
                                    if ($option) {
                                        $product_limit += $p['qty'];
                                        $data['options'][] = [
                                            'option' => $option,
                                            'qty' => $p['qty'],
                                        ];
                                    } else {
                                        $error = "Option not found";
                                    }
                                }
                            } else {
                                $itemPrice = 0;
                                foreach ($item['products'] as $p) {
                                    $option = $product->variations()->with('item')->where('variation_id', $item['group_id'])->where('id', $p['id'])->first();
                                    if ($option) {
                                        $p['qty'] = ($p['qty'])??1;
                                        if($option->price_type == 'fixed' || $option->price_type == 'range'){
                                            if($p['discount_id'] == null){
                                                $discount = $option->discounts()->where('from','<=',$p['qty'])->where('to','>=',$p['qty'])->first();
                                                if($discount) {
                                                    $this->price += $p['qty'] * $discount->price;
                                                    $itemPrice += $p['qty'] * $discount->price;
                                                }else{
                                                    $error = "Option not found";
                                                }
                                            }else{
                                                $discount = StockVariationDiscount::findOrFail($p['discount_id']);
                                                if($discount) {
                                                    $this->price += $discount->price;
                                                    $itemPrice += $discount->price;
                                                }else{
                                                    $error = "Option not found";
                                                }
                                            }
                                        }elseif($option->price_type == 'dynamic'){
                                            $this->price += $p['qty'] * $option->item->default_price;
                                            $itemPrice += $p['qty'] * $option->item->default_price;
                                        }else{
                                            $this->price += $p['qty'] * $option->price;
                                            $itemPrice += $p['qty'] * $option->price;
                                        }
                                        $product_limit += $p['qty'];

                                        $data['options'][] = [
                                            'option' => $option,
                                            'qty' => $p['qty'],
                                            'discount_id' => $p['discount_id'],
                                        ];
                                    } else {
                                        $error = "Option not found";
                                    }
                                }
                                $data['price'] = $itemPrice;
                            }
                        }

                        if ($group->min_count_limit > $product_limit || $group->count_limit < $product_limit) {
                            $error = "Please select options according to limit";
                        }
                    }
                } else {
                    $error = "Section not found";
                }

                if (count($data)) {
                    $this->variations[] = $data;
                }
            }
        } else {
            $error = 'Select available options';
        }
        $error = false;
        return $error;
    }

    public function validateExtra($product, $offers)
    {
        $error = false;
        $offerData = [];
        if(count($offers)){
            foreach ($offers as $vdata){
                $data = [];
                $offer = Stock::find($vdata['product_id']);
                if($offer){
                    $data['offer'] = $offer;
                    $data['key'] = uniqid();
                    $data['variations'] = [];
                    $data['price'] = 0;

                    $variations = [];
                    if(isset($vdata['variations']) && count($vdata['variations'])){
                        foreach ($vdata['variations'] as $variation){
                            $group = $offer->variations()->with('item')->where('variation_id', $variation['group_id'])->first();
                            if ($group) {
                                $variations['group'] = $group;
                                $variations['key'] = uniqid();
                                $variations['options'] = [];

                                $product_limit = 0;
                                if (isset($variation['products']) && count($variation['products'])) {
                                    if ($group->price_per == 'product') {
                                        $data['price'] += $group->price;
                                        $this->price += $group->price;
                                        foreach ($variation['products'] as $p) {
                                            $option = $offer->variations()->with('item')->where('variation_id', $variation['group_id'])->where('id', $p['id'])->first();
                                            if ($option) {
                                                $product_limit += $p['qty'];
                                                $variations['options'][] = [
                                                    'option' => $option,
                                                    'qty' => $p['qty'],
                                                ];
                                            } else {
                                                $error = "Option not found";
                                            }
                                        }
                                    } else {
                                        $itemPrice = 0;
                                        foreach ($variation['products'] as $p) {
                                            $option = $offer->variations()->with('item')->where('variation_id', $variation['group_id'])->where('id', $p['id'])->first();
                                            if ($option) {
                                                $p['qty'] = ($p['qty'])??1;
                                                if($option->price_type == 'fixed' || $option->price_type == 'range'){
                                                    if($p['discount_id'] == null){
                                                        $discount = $option->discounts()->where('from','<=',$p['qty'])->where('to','>=',$p['qty'])->first();
                                                        if($discount) {
                                                            $this->price += $p['qty'] * $discount->price;
                                                            $itemPrice += $p['qty'] * $discount->price;
                                                        }else{
                                                            $error = "Option not found";
                                                        }
                                                    }else{
                                                        $discount = StockVariationDiscount::findOrFail($p['discount_id']);
                                                        if($discount) {
                                                            $this->price += $discount->price;
                                                            $itemPrice += $discount->price;
                                                        }else{
                                                            $error = "Option not found";
                                                        }
                                                    }
                                                }elseif($option->price_type == 'dynamic'){
                                                    $this->price += $p['qty'] * $option->item->default_price;
                                                    $itemPrice += $p['qty'] * $option->item->default_price;
                                                }else{
                                                    $this->price += $p['qty'] * $option->price;
                                                    $itemPrice += $p['qty'] * $option->price;
                                                }
                                                $product_limit += $p['qty'];

                                                $variations['options'][] = [
                                                    'option' => $option,
                                                    'qty' => $p['qty'],
                                                    'discount_id' => $p['discount_id'],
                                                ];
                                            } else {
                                                $error = "Option not found";
                                            }
                                        }
                                        $data['price'] += $itemPrice;

                                    }

                                    if ($group->min_count_limit > $product_limit || $group->count_limit < $product_limit) {
                                        $error = "Please select options according to limit";
                                    }
                                }else{
                                    $error = "Empty variation";
                                }
                            }
                        }
                    }

                    $data['variations'] = $variations;
                }else{
                    $error = "Offer not found";
                }
                $offerData['data'][] = $data;
            }
        }else {
            $error = "No offers";
        }

        if (count($offerData)) {
            $offerData['price'] = $this->price;
            $this->extras = $offerData;
        }

        $error = false;
        return $error;
    }

    public function getShipping($items)
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if (!count($items)) {
                Cart::removeConditionsByType('shipping');
            } else {
                if ($geoZone) {
                    $shipping = Cart::getCondition($geoZone->name);
                    if (!$shipping) {
                        Cart::removeConditionsByType('shipping');
                        if (count($geoZone->deliveries)) {
                            $subtotal = Cart::getSubTotal();
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
                                $shipping = Cart::getCondition($geoZone->name);
                            }
                        }
                    }
                }
            }
        }

        return [
            'default_shipping' => (isset($default_shipping) ? $default_shipping : null),
            'shipping' => (isset($shipping) ? $shipping : null),
            'geoZone' => (isset($geoZone) ? $geoZone : null)
        ];
    }

    public function getShippingWholesaler($items)
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
            $zone = ($default_shipping) ? ZoneCountries::find($default_shipping->country) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            if (!count($items)) {
                Cart::session('wholesaler')->removeConditionsByType('shipping');
            } else {
                if ($geoZone) {
                    $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);
                    if (!$shipping) {
                        Cart::session('wholesaler')->removeConditionsByType('shipping');
                        if (count($geoZone->deliveries)) {
                            $subtotal = Cart::session('wholesaler')->getSubTotal();
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
                                $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);
                            }
                        }
                    }
                }
            }
        }

        return [
            'default_shipping' => (isset($default_shipping) ? $default_shipping : null),
            'shipping' => (isset($shipping) ? $shipping : null),
            'geoZone' => (isset($geoZone) ? $geoZone : null),
            'delivery' => (isset($delivery) ? $delivery : null)
        ];
    }
}
