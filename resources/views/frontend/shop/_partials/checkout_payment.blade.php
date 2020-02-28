<div id="singleProductPageCnt" class="shopping-cart-content">
    <div class="shopping-cart-inner">
        <div class="d-flex flex-wrap">
            <div class="col-lg-10 pl-0">
                    <div class="d-flex shopping-cart-head">
                        {{--                    <div class="shopping-cart-head-back-btn">--}}

                        {{--                    </div>--}}
                        <ul class="nav nav-pills">
                            <li class="nav-item col-md-3">
                                <a href="{!! route('shop_my_cart') !!}" class="item visited d-flex align-items-center justify-content-between"
                                   ref="javascript:void(0);">
                                    <span class="font-sec-reg text-main-clr num">1</span>
                                    <span
                                        class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('shopping_cart') !!}</span>
                                    <span class="icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                                </a>
                            </li>
                            <li class="nav-item col-md-3">
                                <a href="{!! route('shop_check_out') !!}" class="item visited d-flex align-items-center justify-content-between"
                                   href="javascript:void(0);">
                                    <span class="font-sec-reg text-main-clr num">2</span>
                                    <span class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('checkout') !!}</span>
                                    <span class="icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                                </a>
                            </li>
                            <li class="nav-item col-md-3">
                                <a class="item active d-flex align-items-center justify-content-between"
                                   href="javascript:void(0);">
                                    <span class="font-sec-reg text-main-clr num">3</span>
                                    <span class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('payment') !!}</span>
                                    <span class="icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                                </a>
                            </li>
                            <li class="nav-item col-md-3">
                                <a class="item d-flex align-items-center justify-content-between"
                                   href="javascript:void(0);">
                                    <span class="font-sec-reg text-main-clr num">4</span>
                                    <span
                                        class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('confirmation') !!}</span>
                                    <span class="icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                <div class="shopping__cart-tab-main new__scroll h-100">
                    <div class="shopping-cart-payment shopping__cart-payment-wrapper">
                        <div class="head-wrap">
                            <h1 class="font-sec-reg font-24 lh-1 title">{!! __('payment_method') !!}</h1>
                            <p class="font-18 desc lh-1 m-0">{!! __('select_payment_method') !!}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="left-wrapper">
                                    <div class="method-lists">
                                        @if($geoZone && count($geoZone->payment_options))
                                            @if(in_array('cash',$geoZone->payment_options) && $active_payments_gateways->cash)
                                                @if($cash)
                                                    <div class="method">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input payment_methods"
                                                                   checked id="deliveryRadios1" name="payment_method" value="cash">
                                                            <label class="custom-control-label" for="deliveryRadios1">
                                                                <span class="d-flex method-wrap pointer">
                                                                         <span class="method-payment-photo">
                                                                             <img
                                                                                 src="{{ $cash->image }}"
                                                                                 alt="brand"/>
                                                                        </span>
                                                                </span>
                                                                <span class="check-line"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif

                                            @if(in_array('stripe',$geoZone->payment_options) && $active_payments_gateways->stripe)
                                                @if($stripe)
                                                    <div class="method">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input payment_methods"
                                                                   {{ (!$cash && $stripe)?'checked':'' }} id="deliveryRadios2" name="payment_method" value="stripe">
                                                            <label class="custom-control-label" for="deliveryRadios2">
                                                                <span class="d-flex method-wrap pointer">
                                                                         <span class="method-payment-photo">
                                                                             <img
                                                                                 src="{{ $stripe->stripe_image }}"
                                                                                 alt="brand"/>
                                                                        </span>
                                                                </span>
                                                                <span class="check-line"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="payment-method">
                                    <div id="stripe-method" class="payment-method-data d-none">
                                        <div class="pay-credit-card mt-0">
                                            <script src="https://js.stripe.com/v3/"></script>
                                            <form action="/stripe-charge" method="post" id="payment-form">
                                                {!! csrf_field()!!}
                                                <div class="form-group row item-wrap card-number">
                                                    <label for="cardNumber" class="col-xl-2 col-sm-4 pr-sm-0 col-form-label text-gray-clr d-flex flex-nowrap">{!! __('card_number') !!} <span class="sup">*</span></label>
                                                    <div class="col-xl-6 col-sm-8 p-xl-0 center-col align-self-center">
                                                        <div id="cardNumber" class="field form-control"></div>
                                                        <span class="cards-icon d-inline-flex align-items-center">
                                                    <img src="/public/img/visa-logo.png" alt="visa"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row item-wrap">
                                                    <label for="cardName" class="col-xl-2 col-sm-4 pr-sm-0 col-form-label text-gray-clr d-flex flex-nowrap">{!! __('name_on_card') !!} <span class="sup">*</span></label>
                                                    <div class="col-xl-6 col-sm-8 p-xl-0 center-col">
                                                        <input type="text" class="form-control" id="cardName" placeholder="Connor Silva">
                                                    </div>
                                                </div>
                                                <div class="form-group row item-wrap expiry-date">
                                                    <label for="card-expiry-element" class="col-xl-2 col-sm-4 pr-sm-0 col-form-label text-gray-clr d-flex flex-nowrap">{!! __('expiry_date') !!}<span class="sup">*</span></label>
                                                    <div class="col-xl-6 col-sm-8 p-xl-0 center-col">
                                                        <div class="d-flex flex-wrap justify-content-between">
                                                            <div class="col-sm-4 p-0 d-flex">
                                                                <div id="card-expiry-element" class="field  form-control"></div>
                                                            </div>
                                                            <div class="col-sm-8 p-0 d-flex flex-wrap secure-code">
                                                                <label for="secureCode" class="col-sm-6 col-form-label text-gray-clr text-sm-right d-flex flex-nowrap">{!! __('security_code') !!} <span class="sup">*</span></label>
                                                                <div class="col-sm-6 pr-0">
                                                                    <div id="secureCode" class="field  form-control"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row item-wrap checked-payment">
                                                    <div class="col-sm-8 pr-0">
                                                        <div class="d-flex flex-wrap justify-content-between align-self-center">
                                                            <button type="submit" class=" btn btn-primary text-uppercase mt-1 font-15 btn-done submit-stripe-btn">
                                                                {!! __('pay') !!}
                                                            </button>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-9 pr-sm-0">
                                                        <div class="error"></div>
                                                        <div class="success">
                                                            {!! __('success_token_desc') !!} <span class="token"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 p-0 center-col">

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @if(in_array('cash',$geoZone->payment_options) && $active_payments_gateways->cash)
                                        <div id="cash-method" class="payment-method-data d-none">
                                            <button class="btn btn-primary text-uppercase mt-1 font-15 btn-done submit-cash">
                                                {!! __('pay_cash') !!}
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 pr-md-right">
                <div class="right-content">
                    @include("frontend.shop._partials.order_summary",['page' =>'payment','pyp' =>true,'back_route' => route('shop_check_out')])
                </div>
            </div>
        </div>
    </div>
</div>



{{--<div class="col-lg-9 pl-md-left">--}}
    {{--<div class="left-content">--}}
        {{--<h3 class="head font-main-bold font-20 text-uppercase txt-cl-light-blue">Payment method</h3>--}}
        {{--<div class="shopping-cart-payment">--}}
            {{--@if($geoZone && count($geoZone->payment_options))--}}
            {{--<ul class="accordion list-unstyled mb-0 profile-form " id="accordionExample">--}}
                {{--@if(in_array('cash',$geoZone->payment_options) && $active_payments_gateways->cash)--}}
                    {{--@if($cash)--}}
                        {{--<li class="payment-method">--}}
                            {{--<div id="headingOne">--}}
                                {{--<div class="d-inline-block heading" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">--}}
                                    {{--<input class="form-check-input register-form_input-radio payment_methods" type="radio" name="payment_method" id="deliveryRadios1" value="cash" checked="checked">--}}
                                    {{--<label class="form-check-label mb-0 d-flex text-main-clr pointer" for="deliveryRadios1">--}}
                                        {{--<span class="d-inline-flex flex-column">--}}
                                                {{--<span class="font-main-bold text-uppercase mb-1"> {{ $cash->name }}</span>--}}
                                                {{--<span class="font-12">{{ $cash->description }}</span>--}}
                                        {{--</span>--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">--}}
                            {{--</div>--}}
                        {{--</li>--}}
                    {{--@else--}}
                        {{--<li class="payment-method">--}}
                            {{--Cash method not configured--}}
                        {{--</li>--}}
                    {{--@endif--}}
                {{--@endif--}}

                {{--@if(in_array('stripe',$geoZone->payment_options) && $active_payments_gateways->stripe)--}}
                    {{--@if($stripe)--}}
                        {{--<li class="payment-method">--}}
                            {{--<div id="headingTwo">--}}
                                {{--<div class="collapsed d-inline-block heading" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">--}}
                                    {{--<input {{ (!$cash && $stripe)?'checked':'' }} class="form-check-input register-form_input-radio payment_methods" type="radio" name="payment_method" id="deliveryRadios2" value="stripe">--}}
                                    {{--<label class="form-check-label mb-0 d-flex text-main-clr pointer" for="deliveryRadios2">--}}
                                    {{--<span class="d-inline-flex flex-column">--}}

                                    {{--<span class="font-main-bold text-uppercase mb-1 d-flex flex-wrap">--}}
                                          {{--{{ $stripe->stripe_payment_name }}--}}
                                        {{--<span class="cards d-flex align-self-center align-items-center">--}}
                                             {{--<img src="/public/img/visa-logo.png" alt="visa">--}}
                                             {{--<img src="/public/img/mc-logo.png" alt="mc">--}}
                                             {{--<img src="/public/img/maestro-logo.png" alt="maestro">--}}
                                         {{--</span>--}}
                                    {{--</span>--}}
                                    {{--<span class="font-12">{{ $stripe->description }}</span>--}}
                                    {{--</span>--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">--}}
                                {{--<div class="pay-credit-card">--}}
                                    {{--<script src="https://js.stripe.com/v3/"></script>--}}
                                    {{--<form action="/stripe-charge" method="post" id="payment-form">--}}
                                        {{--{!! csrf_field()!!}--}}
                                        {{--<div class="form-row">--}}
                                            {{--<label for="card-element">--}}

                                            {{--</label>--}}
                                            {{--<div id="card-element">--}}
                                                {{--<!-- A Stripe Element will be inserted here. -->--}}
                                            {{--</div>--}}

                                            {{--<!-- Used to display form errors. -->--}}
                                            {{--<div id="card-errors" role="alert"></div>--}}
                                        {{--</div>--}}

                                        {{--<button class="btn btn-info ">Submit Payment</button>--}}
                                    {{--</form>--}}

                                    {{--<form action="/stripe-charge" method="post" id="payment-form">--}}
                                        {{--{!! csrf_field()!!}--}}
                                        {{--<div class="form-group row item-wrap card-number">--}}
                                            {{--<label for="cardNumber" class="col-xl-2 col-sm-4 pr-sm-0 col-form-label text-gray-clr d-flex flex-nowrap">Card Number <span class="sup">*</span></label>--}}
                                            {{--<div class="col-xl-6 col-sm-8 p-xl-0 center-col align-self-center">--}}
                                                {{--<div id="cardNumber" class="field form-control"></div>--}}
                                                {{--<input type="text" class="form-control" id="cardNumber" placeholder="4598 9849 4894 8408">--}}
                                                {{--<span class="cards-icon d-inline-flex align-items-center">--}}
                                                    {{--<img src="/public/img/visa-logo.png" alt="visa"></span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group row item-wrap">--}}
                                            {{--<label for="cardName" class="col-xl-2 col-sm-4 pr-sm-0 col-form-label text-gray-clr d-flex flex-nowrap">Name on Card <span class="sup">*</span></label>--}}
                                            {{--<div class="col-xl-6 col-sm-8 p-xl-0 center-col">--}}
                                                {{--<input type="text" class="form-control" id="cardName" placeholder="Connor Silva">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group row item-wrap expiry-date">--}}
                                            {{--<label for="card-expiry-element" class="col-xl-2 col-sm-4 pr-sm-0 col-form-label text-gray-clr d-flex flex-nowrap">Expiry Date <span class="sup">*</span></label>--}}
                                            {{--<div class="col-xl-6 col-sm-8 p-xl-0 center-col">--}}
                                                {{--<div class="d-flex flex-wrap justify-content-between">--}}
                                                    {{--<div class="col-sm-4 p-0 d-flex">--}}
                                                        {{--<div id="card-expiry-element" class="field  form-control"></div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-sm-8 p-0 d-flex flex-wrap secure-code">--}}
                                                        {{--<label for="secureCode" class="col-sm-6 col-form-label text-gray-clr text-sm-right d-flex flex-nowrap">Security Code <span class="sup">*</span></label>--}}
                                                        {{--<div class="col-sm-6 pr-0">--}}
                                                            {{--<div id="secureCode" class="field  form-control"></div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group row item-wrap checked-payment">--}}
                                            {{--<div class="col-sm-8 pr-0">--}}
                                                {{--<div class="d-flex flex-wrap justify-content-between align-self-center">--}}
                                                    {{--<button type="submit" class="d-none btn btn-primary text-uppercase mt-1 font-15 btn-done submit-stripe-btn">--}}
                                                        {{--Done--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}

                                            {{--</div>--}}
                                            {{--<div class="col-sm-9 pr-sm-0">--}}
                                                {{--<div class="error"></div>--}}
                                                {{--<div class="success">--}}
                                                    {{--Success! Your Stripe token is <span class="token"></span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-sm-3 p-0 center-col">--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                    {{--@else--}}
                        {{--<li class="payment-method">--}}
                            {{--Stripe method not configured--}}
                        {{--</li>--}}
                    {{--@endif--}}
                {{--@endif--}}

                    {{--@if(in_array('paypal',$geoZone->payment_options)  && $active_payments_gateways->paypal)--}}
                        {{--<li class="payment-method">--}}
                            {{--<div id="headingThree">--}}
                                {{--<div class="collapsed d-inline-block heading" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">--}}
                                    {{--<input {{ (!$cash && !$stripe)?'checked':'' }} class="form-check-input register-form_input-radio payment_methods" type="radio" name="payment_method" id="deliveryRadios3" value="paypal">--}}
                                    {{--<label class="form-check-label mb-0 d-flex text-main-clr pointer" for="deliveryRadios3">--}}
                                                            {{--<span class="d-inline-flex flex-column">--}}

                                                            {{--<span class="font-main-bold text-uppercase mb-1 d-flex flex-wrap">--}}
                                                                {{--Pay with PayPal--}}
                                                                {{--<span class="cards"><img src="/public/img/paypal.png" alt="paypal"></span>--}}
                                                            {{--</span>--}}
                                                            {{--<span class="font-12">The standard chunk of Lorem Ipsum used since the 1500s</span>--}}
                                                            {{--</span>--}}

                                    {{--</label>--}}
                                {{--</div>--}}

                            {{--</div>--}}
                            {{--<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">--}}
                            {{--</div>--}}
                        {{--</li>--}}
                    {{--@endif--}}
            {{--</ul>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="col-lg-3 pr-md-right">--}}
    {{--<div class="right-content">--}}
        {{--<h3 class=" head font-main-bold font-20 text-uppercase">ORDER--}}
            {{--SUMMARY</h3>--}}
        {{--<div class="card order-summary">--}}
            {{--<div class="card-header border-bottom-0 font-13">--}}
                {{--You will earn <span class="font-main-bold">200 points.</span>--}}
            {{--</div>--}}
            {{--<div class="card-body border-top-0">--}}
                {{--<div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">--}}
                    {{--<div class="name">--}}
                        {{--Sub Total--}}
                    {{--</div>--}}
                    {{--<div class="price font-main-bold">{!! convert_price(\App\Services\CartService::getTotalPriceSum()+\Cart::getSubTotal(),$currency, false) !!}</div>--}}
                {{--</div>--}}
                {{--<div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">--}}
                    {{--<div class="name">--}}
                        {{--Tax--}}
                    {{--</div>--}}
                    {{--<div class="price font-main-bold">{!! convert_price(0,$currency, false) !!}</div>--}}
                {{--</div>--}}
                {{--<div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">--}}
                    {{--<div class="name">--}}
                        {{--Shipping {!! ($shipping) ? '('.$shipping->getAttributes()->courier->name.')' : '' !!}--}}
                    {{--</div>--}}
                    {{--<div class="price font-main-bold">{!! ($shipping) ? convert_price($shipping->getValue(),$currency, false) : convert_price(0,$currency, false) !!}</div>--}}
                {{--</div>--}}
                {{--<div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">--}}
                    {{--<div class="name">--}}
                        {{--Discount (Coupon)--}}
                    {{--</div>--}}
                    {{--<div class="price font-main-bold">{{ convert_price(0,$currency, false) }}</div>--}}
                {{--</div>--}}
                {{--<div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">--}}
                    {{--<div class="name">--}}
                        {{--Total--}}
                    {{--</div>--}}
                    {{--<div class="price font-main-bold">{!! convert_price(\App\Services\CartService::getTotalPriceSum()+\Cart::getTotal(),$currency, false) !!}</div>--}}
                {{--</div>--}}
                {{--<div class="coupon-code font-17 d-flex flex-wrap justify-content-between align-items-center">--}}
                    {{--<div class="name">--}}
                        {{--Coupon code--}}
                    {{--</div>--}}
                    {{--<div class="code">--}}
                        {{--<input type="text" class="form-control" name="coupon_code"  id="coupon_code">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="checkout-btn text-center">--}}
                    {{--<button class="btn btn-primary text-uppercase font-15 go-to-payment">--}}
                        {{--CHECKOUT--}}
                    {{--</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="secure d-flex flex-wrap justify-content-between align-items-center">--}}
            {{--<span class="secure-icon">--}}
                {{--<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="26px">--}}
                    {{--<path fill-rule="evenodd" fill="rgb(81, 132, 229)" d="M12.000,26.000 C0.711,21.986 0.882,13.191 1.034,5.421 C1.043,4.954 1.052,4.502 1.057,4.059 C5.462,3.878 8.985,2.571 12.000,-0.000 C15.016,2.571 18.538,3.878 22.945,4.059 C22.950,4.502 22.959,4.954 22.969,5.421 C23.121,13.189 23.290,21.986 12.000,26.000 ZM21.282,5.596 C17.725,5.220 14.666,4.076 12.000,2.125 C9.335,4.076 6.276,5.220 2.720,5.596 C2.647,9.347 2.587,13.215 3.816,16.559 C5.134,20.144 7.742,22.594 12.000,24.232 C16.259,22.594 18.867,20.144 20.185,16.558 C21.415,13.213 21.355,9.346 21.282,5.596 ZM10.783,17.740 C10.783,17.740 10.288,17.352 10.126,17.226 L5.719,13.776 C5.716,13.772 5.716,13.772 5.713,13.769 L6.869,12.462 L10.576,15.367 L17.033,8.254 L18.365,9.386 L11.339,17.127 C11.164,17.316 10.783,17.740 10.783,17.740 Z"/>--}}
                {{--</svg>--}}
            {{--</span>--}}
            {{--<p class="mb-0 font-12">--}}
                {{--Full Refund if you don't receive your order. <br>--}}
                {{--Full or Partial Refund, if the item is not as described.--}}
            {{--</p>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
