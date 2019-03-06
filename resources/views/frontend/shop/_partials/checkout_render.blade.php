<div class="col-lg-9 pl-md-left">
    <div class="left-content">
        @if(Auth::check())
            @include('frontend.shop._partials.address')
        @else
            @include("frontend._partials.login_modal_form")
        @endif
    </div>
</div>

<div class="col-lg-3 pr-md-right">
    <div class="right-content">
        <h3 class=" head font-main-bold font-20 text-uppercase">ORDER
            SUMMARY</h3>
        <div class="card order-summary">
            <div class="card-header border-bottom-0 font-13">
                You will earn <span class="font-main-bold">200 points.</span>
            </div>
            <div class="card-body border-top-0">
                <div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                    <div class="name">
                        Sub Total
                    </div>
                    <div class="price font-main-bold">{!! convert_price(\Cart::getSubTotal(),$currency) !!}</div>
                </div>
                <div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                    <div class="name">
                        Tax
                    </div>
                    <div class="price font-main-bold">{!! convert_price(0,$currency) !!}</div>
                </div>
                <div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                    <div class="name">
                        Shipping {!! ($shipping) ? '('.$shipping->getAttributes()->courier->name.')' : '' !!}
                    </div>
                    <div
                        class="price font-main-bold">{!! ($shipping) ? convert_price($shipping->getValue(),$currency) : convert_price(0,$currency) !!}</div>
                </div>
                <div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                    <div class="name">
                        Discount (Coupon)
                    </div>
                    <div class="price font-main-bold">{{ convert_price(0,$currency) }}</div>
                </div>
                <div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                    <div class="name">
                        Total
                    </div>
                    <div class="price font-main-bold">{!! convert_price(\Cart::getTotal(),$currency) !!}</div>
                </div>
                <div class="coupon-code font-17 d-flex flex-wrap justify-content-between align-items-center">
                    <div class="name">
                        Coupon code
                    </div>
                    <div class="code">
                        <input type="text" class="form-control" name="coupon_code" id="coupon_code">
                    </div>
                </div>
                <div class="checkout-btn text-center">
                    @if(Auth::check())
                        @if($default_shipping)
                            <button class="btn btn-primary text-uppercase font-15 go-to-payment">
                                CHECKOUT
                            </button>
                        @else
                            <button
                                class="btn btn-primary text-uppercase font-15 btn-checkout-message address-book-new">
                                CHECKOUT
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="secure d-flex flex-wrap justify-content-between align-items-center">
            <span class="secure-icon">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="26px">
                    <path fill-rule="evenodd" fill="rgb(81, 132, 229)"
                          d="M12.000,26.000 C0.711,21.986 0.882,13.191 1.034,5.421 C1.043,4.954 1.052,4.502 1.057,4.059 C5.462,3.878 8.985,2.571 12.000,-0.000 C15.016,2.571 18.538,3.878 22.945,4.059 C22.950,4.502 22.959,4.954 22.969,5.421 C23.121,13.189 23.290,21.986 12.000,26.000 ZM21.282,5.596 C17.725,5.220 14.666,4.076 12.000,2.125 C9.335,4.076 6.276,5.220 2.720,5.596 C2.647,9.347 2.587,13.215 3.816,16.559 C5.134,20.144 7.742,22.594 12.000,24.232 C16.259,22.594 18.867,20.144 20.185,16.558 C21.415,13.213 21.355,9.346 21.282,5.596 ZM10.783,17.740 C10.783,17.740 10.288,17.352 10.126,17.226 L5.719,13.776 C5.716,13.772 5.716,13.772 5.713,13.769 L6.869,12.462 L10.576,15.367 L17.033,8.254 L18.365,9.386 L11.339,17.127 C11.164,17.316 10.783,17.740 10.783,17.740 Z"/>
                </svg>
            </span>
            <p class="mb-0 font-12">
                Full Refund if you don't receive your order. <br>
                Full or Partial Refund, if the item is not as described.
            </p>
        </div>
    </div>
</div>


<!--modal new address-->
