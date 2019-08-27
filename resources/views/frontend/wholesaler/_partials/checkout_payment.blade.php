<div id="singleProductPageCnt" class="shopping-cart-content">
    <div class="shopping-cart-inner">
        <div class="d-flex flex-wrap">
            <div class="col-lg-10 pl-0">
                <div class="shopping-cart-payment shopping__cart-payment-wrapper">
                    <div class="head-wrap">
                        <h1 class="font-sec-reg font-24 lh-1 title">Payment Methode</h1>
                        <p class="font-18 desc lh-1 m-0">Select a payment methode</p>
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
                                        <form action="/wholesaler/stripe-charge" method="post" id="payment-form">
                                            {!! csrf_field()!!}
                                            <div class="form-group row item-wrap card-number">
                                                <label for="cardNumber" class="col-xl-2 col-sm-4 pr-sm-0 col-form-label text-gray-clr d-flex flex-nowrap">Card Number <span class="sup">*</span></label>
                                                <div class="col-xl-6 col-sm-8 p-xl-0 center-col align-self-center">
                                                    <div id="cardNumber" class="field form-control"></div>
                                                    <span class="cards-icon d-inline-flex align-items-center">
                                                    <img src="/public/img/visa-logo.png" alt="visa"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row item-wrap">
                                                <label for="cardName" class="col-xl-2 col-sm-4 pr-sm-0 col-form-label text-gray-clr d-flex flex-nowrap">Name on Card <span class="sup">*</span></label>
                                                <div class="col-xl-6 col-sm-8 p-xl-0 center-col">
                                                    <input type="text" class="form-control" id="cardName" placeholder="Connor Silva">
                                                </div>
                                            </div>
                                            <div class="form-group row item-wrap expiry-date">
                                                <label for="card-expiry-element" class="col-xl-2 col-sm-4 pr-sm-0 col-form-label text-gray-clr d-flex flex-nowrap">Expiry Date <span class="sup">*</span></label>
                                                <div class="col-xl-6 col-sm-8 p-xl-0 center-col">
                                                    <div class="d-flex flex-wrap justify-content-between">
                                                        <div class="col-sm-4 p-0 d-flex">
                                                            <div id="card-expiry-element" class="field  form-control"></div>
                                                        </div>
                                                        <div class="col-sm-8 p-0 d-flex flex-wrap secure-code">
                                                            <label for="secureCode" class="col-sm-6 col-form-label text-gray-clr text-sm-right d-flex flex-nowrap">Security Code <span class="sup">*</span></label>
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
                                                            Pay
                                                        </button>
                                                    </div>

                                                </div>
                                                <div class="col-sm-9 pr-sm-0">
                                                    <div class="error"></div>
                                                    <div class="success">
                                                        Success! Your Stripe token is <span class="token"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 p-0 center-col">

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @if($geoZone && in_array('cash',$geoZone->payment_options) && $active_payments_gateways->cash)
                                    <div id="cash-method" class="payment-method-data d-none">
                                        <button class="btn btn-primary text-uppercase mt-1 font-15 btn-done submit-cash">PAY CASH</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 pr-md-right">
                <div class="right-content">
                    @include("frontend.wholesaler._partials.order_summary",['pyp' =>true,'back_route' => route('wholesaler_check_out')])
                </div>
            </div>
        </div>
    </div>
</div>
