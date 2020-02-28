<?php namespace App\Services;

use App\Events\OrderSubmitted;
use App\Models\Addresses;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\OrdersJob;
use App\Models\Others;
use App\Models\Settings;
use App\Models\Statuses;
use App\Models\StockVariation;
use App\Models\ZoneCountries;
use App\Models\ZoneCountryRegions;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use PragmaRX\Countries\Package\Countries;

/**
 * Created by PhpStorm.
 * User: edo
 * Date: 22/04/2019
 * Time: 1:01 PM
 */
class PaymentService
{
    private $amount = 0;
    public $method = 'cash';

    public function __construct(
        Statuses $statuses,
        Settings $settings
    )
    {
        $this->statuses = $statuses;
        $this->settings = $settings;
    }

    public function call()
    {
        $shippingId = session()->get('shipping_address');
        $billingId = session()->get('billing_address');
        $this->amount = CartService::getTotalPriceSum() + Cart::getTotal();
        $geoZone = null;
        $items = Cart::getContent();
        if (\Auth::check()) {
            $shippingAddress = Addresses::find($shippingId);
            $zone = ($shippingAddress) ? ZoneCountries::find($shippingAddress->country) : null;
            $region = ($shippingAddress) ? ZoneCountryRegions::find($shippingAddress->region) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
        }
        return \DB::transaction(function () use ($billingId, $shippingId, $geoZone, $shippingAddress, $zone, $region) {
//            Cart::removeConditionsByType('shipping');
//            if (count($geoZone->deliveries)) {
//                $subtotal = Cart::getSubTotal();
//                $delivery = $geoZone->deliveries()->where('min', '<=', $subtotal)->where('max', '>=', $subtotal)->first();
//
//                if ($delivery && count($delivery->options)) {
//                    $shippingDefaultOption = $delivery->options->first();
//                    $condition2 = new \Darryldecode\Cart\CartCondition(array(
//                        'name' => $geoZone->name,
//                        'type' => 'shipping',
//                        'target' => 'total',
//                        'value' => $shippingDefaultOption->cost,
//                        'order' => 1,
//                        'attributes' => $shippingDefaultOption
//                    ));
//
//                    Cart::condition($condition2);
//                }
//            }

            $shipping = Cart::getCondition($geoZone->name);
            $items = Cart::getContent();
            $order_number = get_order_number();

            $order = Orders::create([
                'user_id' => \Auth::id(),
                'code' => getUniqueCode('orders', 'code', Countries::where('name.common', $zone->name)->first()->cca2),
                'amount' => $this->amount,
                'billing_addresses_id' => $billingId,
                'shipping_method' => $shipping->getAttributes()->courier->name,
                'payment_method' => $this->method,
                'shipping_price' => $shipping->getValue(),
                'currency' => get_currency(),
                'order_number' => $order_number
            ]);

            $status = $setting = $this->settings->getData('order', 'open');
            $historyData['user_id'] = \Auth::id();
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
                                $discount = \App\Models\StockVariationDiscount::where("variation_id",$option['option']->id)->first();
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
                                    $discount = \App\Models\StockVariationDiscount::where("variation_id",$option['option']->id)->first();
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


//                if (count($sales)) {
//                    foreach ($sales as $item_id => $sale) {
//                        Others::create([
//                            'item_id' => $item_id,
//                            'user_id' => \Auth::id(),
//                            'qty' => (int)$sale * $item->quantity,
//                            'reason' => 'sold',
//                            'grouped' => $order->id,
//                        ]);
//                    }
//                }

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
            event(new OrderSubmitted(\Auth::getUser(), $order));

            return $order;
        });
    }

    public function callWholesaler()
    {
        $shippingId = session()->get('shipping_address_wholesale');
        $billingId = session()->get('billing_address_wholesale');
        $this->amount = Cart::session('wholesaler')->getTotal();
        $geoZone = null;
        $items = Cart::session('wholesaler')->getContent();
        if (\Auth::check()) {
            $shippingAddress = Addresses::find($shippingId);
            $zone = ($shippingAddress) ? ZoneCountries::find($shippingAddress->country) : null;
            $region = ($shippingAddress) ? ZoneCountryRegions::find($shippingAddress->region) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
        }
        return \DB::transaction(function () use ($billingId, $shippingId, $geoZone, $shippingAddress, $zone, $region) {
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
                }
            }

            $shipping = Cart::session('wholesaler')->getCondition($geoZone->name);
            $items = Cart::session('wholesaler')->getContent();
            $order_number = get_order_number();

            $order = Orders::create([
                'user_id' => \Auth::id(),
                'code' => getUniqueCode('orders', 'code', Countries::where('name.common', $zone->name)->first()->cca2),
                'amount' => $this->amount,
                'billing_addresses_id' => $billingId,
                'shipping_method' => $shipping->getAttributes()->courier->name,
                'payment_method' => $this->method,
                'shipping_price' => $shipping->getValue(),
                'currency' => get_currency(),
                'order_number' => $order_number,
                'type' => true
            ]);

            $status = $setting = $this->settings->getData('order', 'open');
            $historyData['user_id'] = \Auth::id();
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
            foreach ($items as $item_id => $item) {
                Others::create([
                    'item_id' => $item->id,
                    'user_id' => \Auth::id(),
                    'qty' => $item->quantity,
                    'reason' => 'sold',
                    'grouped' => $order->id,
                ]);

                OrderItem::create([
                    'order_id' => $order->id,
                    'name' => $item->attributes->item->name,
                    'sku' => '',
                    'variation_id' => $item->id,
                    'price' => $item->price,
                    'qty' => $item->quantity,
                    'amount' => $item->price * $item->quantity,
                    'image' => $item->attributes->item->image,
                    'options' => []
                ]);
            }

            OrdersJob::makeNew($order->id);
            event(new OrderSubmitted(\Auth::getUser(), $order));

            return $order;
        });
    }
}
