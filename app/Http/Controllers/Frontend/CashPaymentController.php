<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/31/2018
 * Time: 10:14 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Events\OrderSubmitted;
use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\OrderAddresses;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\OrdersJob;
use App\Models\StripePayments;
use App\Models\Statuses;
use App\Models\Settings;
use App\Models\ZoneCountries;
use App\Models\ZoneCountryRegions;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use PragmaRX\Countries\Package\Countries;



class CashPaymentController extends Controller
{
    protected $view= 'frontend.shop';

    private $statuses;
    private $settings;

    public function __construct(
        Statuses $statuses,
        Settings $settings
    )
    {
        $this->statuses = $statuses;
        $this->settings = $settings;
    }

    public function order(Request $request)
    {
        $shippingId = session()->get('shipping_address');
        $billingId = session()->get('billing_address');
        $geoZone = null;
        if(\Auth::check()){
            $shippingAddress = Addresses::find($shippingId);
            $zone = ($shippingAddress) ? ZoneCountries::find($shippingAddress->country) : null;
            $region = ($shippingAddress) ? ZoneCountryRegions::find($shippingAddress->region) : null;
            $geoZone = ($zone) ? $zone->geoZone : null;
            $shipping = Cart::getCondition($geoZone->name);
        }
        $order = \DB::transaction(function () use ($billingId,$shippingId,$geoZone,$shippingAddress,$zone,$region) {
            $shipping = Cart::getCondition($geoZone->name);
            $items = Cart::getContent();
            $order_number = get_order_number();

            $order = Orders::create([
                'user_id' => \Auth::id(),
                'code'=>getUniqueCode('orders','code',Countries::where('name.common', $zone->name)->first()->cca2),
                'amount' => Cart::getTotal(),
                'billing_addresses_id' => $billingId,
                'shipping_method' => $shipping->getAttributes()->courier->name,
                'payment_method' => 'cash',
                'shipping_price' => $shipping->getValue(),
                'currency' => 'usd',
                'order_number' => $order_number
            ]);

            $status = $setting = $this->settings->getData('order', 'open');
            $historyData['user_id'] = \Auth::id();
            $historyData['status_id'] = ($status)?$status->val : $this->statuses->where('type','order')->first()->id;
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
            foreach ($items as $variation_id => $item){
                $options = [];
                foreach ($item->attributes->variation->options as $option){
                    $options[$option->attribute_sticker->attr->name] = $option->attribute_sticker->sticker->name;
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'name' => $item->attributes->variation->stock->name,
                    'sku' => $item->name,
                    'variation_id' => $variation_id,
                    'price' => $item->price,
                    'qty' => $item->quantity,
                    'amount' => $item->price * $item->quantity,
                    'image' => $item->attributes->variation->stock->image,
                    'options' => $options
                ]);
                OrdersJob::makeNew($order->id);
                event(new OrderSubmitted(\Auth::getUser(),$order));
            }

            return $order;
        });

        return \Response::json(['error' => false,'url' => route('cash_order_success',$order->id)]);
    }

    public function success (Request $request,$id)
    {
        $order = Orders::findOrFail($id);
        
        if(! Cart::isEmpty() && session()->has('shipping_address') &&  session()->has('billing_address') && $order){
            session()->forget('shipping_address','billing_address');
            session()->forget('shipping_address_id','billing_address_id');
            session()->forget('payment_token');
            Cart::clear();
            Cart::removeConditionsByType('shipping');

            return $this->view('_partials.cash_success');
        }

        abort(404);
    }
}