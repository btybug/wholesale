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
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\OrdersJob;
use App\Models\Settings;
use App\Models\Statuses;
use App\Models\StripePayments;
use App\Models\Transaction;
use App\Models\ZoneCountries;
use App\Models\ZoneCountryRegions;
use App\Services\CartService;
use App\Services\PaymentService;
use Cartalyst\Stripe\Exception\StripeException;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use PragmaRX\Countries\Package\Countries;

class StripePaymentController extends Controller
{
    protected $view = 'frontend.shop';
    private $statuses;
    private $settings;
    private $amount;
    private $paymentService;

    public function __construct(
        Statuses $statuses,
        Settings $settings,
        PaymentService $paymentService
    )
    {
        $this->statuses = $statuses;
        $this->settings = $settings;
        $this->paymentService = $paymentService;
    }

    public function stripeCharge(Request $request)
    {
        putenv('STRIPE_API_KEY=' . stripe_secret());
        putenv('STRIPE_API_VERSION=2016-07-06');
        $stripe = new Stripe();

// This is a $20.00 charge in US Dollar.
        try {
            $this->amount = CartService::getTotalPriceSum()+ Cart::getTotal();
            $charge = $stripe->charges()->create(
                array(
                    'amount' => $this->amount,
                    'currency' => 'usd',
                    'source' => $request->get('stripeToken')
                )
            );
        } catch (StripeException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }

        $order = $this->order($charge);
//        dd($order);
//        event(new OrderSubmitted($order->user,$order));

        if (!Cart::isEmpty() && session()->has('shipping_address') && session()->has('billing_address') && $order) {
            session()->forget('shipping_address', 'billing_address');
            session()->forget('shipping_address_id', 'billing_address_id');
            session()->forget('payment_token');
            Cart::clear();
            Cart::removeConditionsByType('shipping');

            return $this->view('_partials.cash_success',compact(['order']));
        }
    }

    public function wholesalerStripeCharge(Request $request)
    {
        putenv('STRIPE_API_KEY=' . stripe_secret());
        putenv('STRIPE_API_VERSION=2016-07-06');
        $stripe = new Stripe();

// This is a $20.00 charge in US Dollar.
        try {
            $this->amount = Cart::session('wholesaler')->getTotal();
            $charge = $stripe->charges()->create(
                array(
                    'amount' => $this->amount,
                    'currency' => 'usd',
                    'source' => $request->get('stripeToken')
                )
            );
        } catch (StripeException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }

        $order = $this->orderWholesaler($charge);
//        dd($order);
//        event(new OrderSubmitted($order->user,$order));

        if (!Cart::session('wholesaler')->isEmpty() && session()->has('shipping_address_wholesale')
            && session()->has('billing_address_wholesale') && $order) {
            session()->forget('shipping_address_wholesale', 'billing_address_wholesale');
            session()->forget('shipping_address_wholesaler_id', 'billing_address_wholesaler_id');
            session()->forget('payment_token_wholesale');
            Cart::session('wholesaler')->clear();
            Cart::session('wholesaler')->removeConditionsByType('shipping');

            return View('frontend.wholesaler._partials.cash_success',compact('order'));
        }
    }

    private function makeTransaction($charge, $order)
    {
        return Transaction::create([
            'user_id' => \Auth::id(),
            'order_id' => $order->id,
            'payment_method' => 'stripe',
            'transaction_id' => $charge['id'],
            'object' => $charge['object'],
            'amount' => $order->amount,
            'amount_refunded' => $charge['amount_refunded'],
            'currency' => $charge['currency'],
            'invoice' => $charge['invoice'],
            'paid' => $charge['paid'],
            'receipt_number' => $charge['receipt_number'],
            'receipt_url' => $charge['receipt_url'],
            'refunds_url' => $charge['refunds']['url'],
            'source_id' => $charge['source']['id'],
            'source_object' => $charge['source']['object'],
            'source_brand' => $charge['source']['brand'],
            'source_country' => $charge['source']['country'],
            'source_exp_month' => $charge['source']['exp_month'],
            'source_exp_year' => $charge['source']['exp_year'],
            'source_funding' => $charge['source']['funding'],
            'source_last4' => $charge['source']['last4'],
            'status' => $charge['status'],
        ]);
    }

    private function order($transaction)
    {
        $this->paymentService->method = 'stripe';
        $order = $this->paymentService->call();
        $this->makeTransaction($transaction, $order);

        return $order;
    }

    private function orderWholesaler($transaction)
    {
        $this->paymentService->method = 'stripe';
        $order = $this->paymentService->callWholesaler();
        $this->makeTransaction($transaction, $order);

        return $order;
    }
}
