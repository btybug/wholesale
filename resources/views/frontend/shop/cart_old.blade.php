@extends('layouts.frontend')
@section('content')
    <section class="main-content site-content section-cart-page">
        <div class="container">
            <div class="breadcum-area">
                <div class="breadcum-inner">
                    <h3>Shopping cart</h3>
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="http://demo.laravelcommerce.com">Home</a></li>
                    </ol>
                </div>
            </div>
            <div class="cart-area">
                @include('frontend.shop._partials.cart_table')
            </div>
        </div>
    </section>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/frontend/css/cart.css')}}">
@stop


{{--                    --------------------- shopping cart no registr start------------------}}
<div class="shopping__cart-no-reg">
    <div class="row">
        <div class="col-md-6">
            <div class="left-content">
                <form action="">
                    <div class="main-wrap">
                        <h2 class="font-40 text-tert-clr title">SIGHN IN</h2>
                        <p class="font-26 text-main-clr sec-title">Already a customer</p>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="d-flex bottom-wrap">
                        <a href="#" class="btn-log-reg">log in</a>
                        <a href="#" class="forgot-password">forget your password?</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="right-content">
                <h2>REGISTER</h2>
            </div>
        </div>
    </div>
    <div class="bottom-logo">
        <div class="logo">
            <img src="{!! get_site_logo() !!}" alt="{{ get_site_name() }}">
        </div>
    </div>
</div>
{{----------------------- shopping cart no registr end------------------}}

{{--            ------------------        shoping details tab start   ----------------   --}}
<div id="singleProductPageCnt" class="shopping-cart-content">
    <div class="shopping-cart-inner">
        <div class="d-flex flex-wrap">
            <div class="col-lg-10 pl-0">
                <div class="shopping__cart-tab-details">
                    <div class="row">
                        <div class="col-md-6 detail-left-col">
                            <div class="cart-details">
                                <div class="d-flex align-items-center cart-details-head">
    <span class="cart-details-avatar">
        <span class="icon-avatar">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                width="41px" height="41px" viewBox="0 0 41 41">
            <path fill-rule="evenodd" opacity="0.502" fill="rgb(0, 0, 0)"
                  d="M34.996,26.504 C32.763,24.271 30.105,22.619 27.206,21.618 C30.311,19.479 32.351,15.899 32.351,11.852 C32.351,5.317 27.035,-0.000 20.500,-0.000 C13.965,-0.000 8.648,5.317 8.648,11.852 C8.648,15.899 10.689,19.479 13.794,21.618 C10.895,22.619 8.237,24.271 6.004,26.504 C2.132,30.376 -0.000,35.524 -0.000,41.000 L3.203,41.000 C3.203,31.462 10.962,23.703 20.500,23.703 C30.037,23.703 37.797,31.462 37.797,41.000 L41.000,41.000 C41.000,35.524 38.868,30.376 34.996,26.504 ZM20.500,20.500 C15.731,20.500 11.852,16.620 11.852,11.852 C11.852,7.083 15.731,3.203 20.500,3.203 C25.269,3.203 29.148,7.083 29.148,11.852 C29.148,16.620 25.269,20.500 20.500,20.500 Z"/>
        </svg>
        </span>
    </span>
                                    <span class="font-28 lh-1 text-tert-clr name">
        User Name
    </span>
                                </div>
                                <div class="row cart-details-address">
                                    <div class="col-md-4">
                                        <h3 class="title">Shipping Address</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="address-info">
                                            <div class="select-wall product__select-wall">
                                                <select name="" id=""
                                                        class="select-2 select-2--no-search main-select not-selected arrow-dark select2-hidden-accessible"
                                                        style="width: 100%">
                                                    <option value="">Grand street 178, London
                                                    </option>
                                                    <option value="">Grand street 55, London 2
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="main-info">
                                                <span>Prime Minister</span>
                                                <span>178 Grand Street</span>
                                                <span>London</span>
                                                <span>SW1A 2AA</span>
                                                <span>United Kingdom</span>
                                            </div>
                                            <a href="#"
                                               class="font-18 bg-blue-clr text-sec-clr add-address-btn">Add
                                                New Address</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="cart-details-special">
                                    <h3 class="title">
                                        Special Notes
                                    </h3>
                                    <textarea name="" cols="30" rows="10" class="note"></textarea>
                                    <p class="font-16 text-tert-clr note-info">
                                        * Your Billing address is same as your account
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 detail-right-col">
                            <div class="cart-delivery">
                                <div class="head-delivery">
                                    <h3 class="title">Delivery Methode</h3>
                                    <p class="delivery-sec-title font-18">Select your delivery
                                        service</p>
                                </div>

                                <div class="method">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" checked class="custom-control-input"
                                               id="customRadio1" name="example1" value="customEx">
                                        <label class="custom-control-label" for="customRadio1">
                                                                <span class="d-flex method-wrap pointer">
                                                                    <span class="method-left">
                                                                         <span class="photo">
<img src="/public/img/temp/dpd-method-icon.jpg" alt="brand">
                                                                </span>
                                                                    </span>
                                                                     <span class="method-right">
                                                                         <span class="method-item-title">Standrd Delivery</span>
                                                                         <span class="font-main-light method-item-info">Shipping: <span
                                                                                 class="text-red-clr">Free</span></span>
                                                                         <span class="font-main-light method-item-info">Delivery Time: 2 days</span>

                                                                    </span>
                                                                </span>
                                            <span class="check-line"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="method">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input"
                                               id="customRadio2" name="example1" value="customEx">
                                        <label class="custom-control-label" for="customRadio2">
                                                                <span class="d-flex method-wrap pointer">
                                                                    <span class="method-left">
                                                                         <span class="photo">
<img src="/public/img/temp/dhl-method-icon.jpg" alt="brand">
                                                                </span>
                                                                    </span>
                                                                     <span class="method-right">
                                                                         <span
                                                                             class="method-item-title">DHL Delivery</span>
                                                                         <span class="font-main-light method-item-info">Shipping: <span
                                                                                 class="font-weight-bold">$5</span></span>
                                                                         <span class="font-main-light method-item-info">Delivery Time: 3 days</span>

                                                                    </span>
                                                                </span>
                                            <span class="check-line"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="method">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input"
                                               id="customRadio3" name="example1" value="customEx">
                                        <label class="custom-control-label" for="customRadio3">
                                                                <span class="d-flex method-wrap pointer">

                                                                    <span class="method-left">
                                                                         <span class="photo">
                                                                <img src="/public/img/temp/fedex-method-icon.jpg"
                                                                     alt="brand">
                                                                </span>
                                                                    </span>
                                                                     <span class="method-right">
                                                                         <span class="method-item-title">Priority Delivery</span>
                                                                         <span class="font-main-light method-item-info">Shipping: $10</span>
                                                                         <span class="font-main-light method-item-info">Delivery Time: <span
                                                                                 class="text-tert-clr">1 day</span></span>

                                                                    </span>
                                                                </span>
                                            <span class="check-line"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 pr-md-right">
                <div class="right-content">
                    {{--                    <h3 class=" head font-main-bold font-20 text-uppercase">ORDER--}}
                    {{--                        SUMMARY</h3>--}}
                    <div class="card order-summary">
                        <div class="card-header text-tert-clr font-26">
                            ORDER SUMMARY
                        </div>
                        <div class="card-body border-top-0">
                            <div
                                class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="name">
                                    Sub Total
                                </div>
                                <div
                                    class="price font-main-bold">{!! convert_price(\App\Services\CartService::getTotalPriceSum()+\Cart::getSubTotal(),$currency, false) !!}</div>
                            </div>
                            <div
                                class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="name">
                                    Tax
                                </div>
                                <div
                                    class="price font-main-bold">{!! convert_price(0,$currency, false) !!}</div>
                            </div>
                            <div
                                class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="name">
                                    Shipping {!! ($shipping) ? '('.$shipping->getAttributes()->courier->name.')' : '' !!}
                                </div>
                                <div
                                    class="w-100 d-flex flex-wrap justify-content-between align-items-center row_with-select">
                                    <div class="select-wall">
                                        <select name="" id=""
                                                class="select-2 select-2--no-search main-select not-selected arrow-dark select2-hidden-accessible"
                                                style="width: 175px">
                                            <option value="">United Kingdom</option>
                                            <option value="">Armenia</option>
                                        </select>
                                    </div>
                                    <div
                                        class="price font-main-bold">{!! ($shipping) ? convert_price($shipping->getValue(),$currency, false) : convert_price(0,$currency, false) !!}</div>
                                </div>

                            </div>
                            <div
                                class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                                <div
                                    class="w-100 d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="name">
                                        Coupon Discount
                                    </div>
                                    <div
                                        class="price font-main-bold">{{ convert_price(0,$currency, false) }}</div>
                                </div>
                                <div class="w-100 row_with-select">
                                    <div class="code">
                                        <input type="text" class="form-control" name="coupon_code"
                                               id="coupon_code">
                                    </div>
                                </div>

                            </div>
                            <div
                                class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center border-bottom-0">
                                <div class="name">
                                    Total
                                </div>
                                <div
                                    class="price text-tert-clr font-main-bold">{!! convert_price(\App\Services\CartService::getTotalPriceSum()+\Cart::getTotal(),$currency, false) !!}</div>
                            </div>
                            {{--                            <div class="coupon-code font-17 d-flex flex-wrap justify-content-between align-items-center">--}}
                            {{--                                <div class="name">--}}
                            {{--                                    Coupon code--}}
                            {{--                                </div>--}}
                            {{--                                <div class="code">--}}
                            {{--                                    <input type="text" class="form-control" name="coupon_code" id="coupon_code">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="checkout-btn text-center">--}}
                            {{--                                <a class="btn btn-primary text-uppercase font-15"--}}
                            {{--                                   href="{!! route('shop_check_out') !!}">--}}
                            {{--                                    CHECKOUT--}}
                            {{--                                </a>--}}
                            {{--                            </div>--}}
                            <div class="order-summary-btn-wall text-center mb-2">
                                <a class="order-summary-btn font-sec-reg text-uppercase font-24 text-sec-clr shop-detail-btn"
                                   href="#">
                                    SHOPPING DETAILS
                                </a>
                            </div>
                            <div class="order-summary-btn-wall text-center">
                                <a class="order-summary-btn font-sec-reg text-uppercase font-24 text-main-clr back-btn"
                                   href="#">
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>

                    {{--                    <div class="secure d-flex flex-wrap justify-content-between align-items-center">--}}
                    {{--                        <span class="secure-icon">--}}
                    {{--                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                    {{--                                 width="24px" height="26px">--}}
                    {{--                                <path fill-rule="evenodd" fill="rgb(81, 132, 229)"--}}
                    {{--                                      d="M12.000,26.000 C0.711,21.986 0.882,13.191 1.034,5.421 C1.043,4.954 1.052,4.502 1.057,4.059 C5.462,3.878 8.985,2.571 12.000,-0.000 C15.016,2.571 18.538,3.878 22.945,4.059 C22.950,4.502 22.959,4.954 22.969,5.421 C23.121,13.189 23.290,21.986 12.000,26.000 ZM21.282,5.596 C17.725,5.220 14.666,4.076 12.000,2.125 C9.335,4.076 6.276,5.220 2.720,5.596 C2.647,9.347 2.587,13.215 3.816,16.559 C5.134,20.144 7.742,22.594 12.000,24.232 C16.259,22.594 18.867,20.144 20.185,16.558 C21.415,13.213 21.355,9.346 21.282,5.596 ZM10.783,17.740 C10.783,17.740 10.288,17.352 10.126,17.226 L5.719,13.776 C5.716,13.772 5.716,13.772 5.713,13.769 L6.869,12.462 L10.576,15.367 L17.033,8.254 L18.365,9.386 L11.339,17.127 C11.164,17.316 10.783,17.740 10.783,17.740 Z"/>--}}
                    {{--                            </svg>--}}
                    {{--                        </span>--}}
                    {{--                        <p class="mb-0 font-12">--}}
                    {{--                            Full Refund if you don't receive your order. <br>--}}
                    {{--                            Full or Partial Refund, if the item is not as described.--}}
                    {{--                        </p>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
{{--            ------------------        shoping details tab end   ----------------   --}}
