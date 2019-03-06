<?php namespace App\Services;

use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\StockVariation;
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

    public function getCartItems($id = null){
        $cartCollection = ($id) ? Cart::session(Orders::ORDER_NEW_SESSION_ID)->getContent() : Cart::getContent();

        $items = [];
        $empty = ($id) ? Cart::session(Orders::ORDER_NEW_SESSION_ID)->isEmpty() : Cart::isEmpty();
        if(! $empty){
            foreach($cartCollection as $key => $value){
                $items[$value->name][$key] = $value;
            }
        }

        self::$cartItems = $items;

        return $items;
    }

    public function getCount() {
        $cartCollection = count($this->getCartItems());
        return $cartCollection;
    }

    public static function getVariation ($id)
    {
        return StockVariation::find($id);
    }

    public static function getPriceSum($id)
    {
        $data = (isset(self::$cartItems[$id])) ? self::$cartItems[$id] : [] ;
        $price = 0;
        if(count($data)){
            foreach ($data as $datum){
                $price += $datum->getPriceSum();
            }
        }
        return $price;
    }

    public function remove($id,$user_id = null)
    {
        $list = $this->getCartItems($user_id);
        $data = (isset($list[$id])) ? $list[$id] : [] ;

        if(count($data)){
            foreach ($data as $datum){
                if($user_id){
                    Cart::session(Orders::ORDER_NEW_SESSION_ID)->remove($datum->id);
                }else{
                    Cart::remove($datum->id);
                }
            }
        }else{
            if($user_id){
                Cart::session(Orders::ORDER_NEW_SESSION_ID)->remove($id);
            }else{
                Cart::remove($id);
            }
        }
    }

    public function update($id,$qty,$condition,$value,$user_id = null)
    {
        $list = $this->getCartItems($user_id);
        $data = (isset($list[$id])) ? $list[$id] : [] ;

        if(count($data)){
            foreach ($data as $datum){
                if($condition == 'inner'){
                    if($user_id){
                        Cart::session(Orders::ORDER_NEW_SESSION_ID)->update($datum->id, array(
                            'quantity' => array(
                                'relative' => false,
                                'value' => $value
                            )));
                    }else{
                        Cart::update($datum->id, array(
                            'quantity' => array(
                                'relative' => false,
                                'value' => $value
                            )));
                    }
                }else{
                    if($user_id){
                        Cart::session(Orders::ORDER_NEW_SESSION_ID)->update($datum->id, array(
                            'quantity' => $qty
                        ));
                    }else{
                        Cart::update($datum->id, array(
                            'quantity' => $qty
                        ));
                    }
                }
            }
        }
    }

    public function saveOrderItems($items,$order)
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

            if(count($item)){
                foreach($item as $vid){
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
}