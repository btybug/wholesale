@extends('layouts.frontend')
@section('content')
    <main class="main-content">
        <div class="shopping-cart_wrapper shopping__cart-wrapper">
            <div class="container main-max-width">
                <div class="d-flex shopping-cart-head">
                    <ul class="nav nav-pills">
                        <li class="nav-item col-md-3">
                            <a class="item visited d-flex align-items-center justify-content-between"
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
                            <a class="item visited d-flex align-items-center justify-content-between"
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
                            <a class="item visited d-flex align-items-center justify-content-between"
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
                            <a class="item active d-flex align-items-center justify-content-between"
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
            </div>
            <div class="container main-max-width shopping__cart-mw">
                <div class="cart-area">
                    <div id="singleProductPageCnt" class="shopping-cart-content">
                        <div class="shopping-cart-inner">
                        <div class="d-flex flex-wrap checkout-data">
                            <div class="col-lg-10 pl-0">
                            {{--                confirm tab start--}}
                                <div class="shopping__cart-confirm w-100">
                                <h1 class="font-40 title">{!! __('shop_confirm_title') !!}</h1>
                                <p class="font-20 sec-title">{!! __('shop_confirm_desc') !!}</p>
                                <div class="row list-shipping">
                                    <div class="left-col">
                                        <ul class="row">
                                            <li class="col-md-4 col-sm-6">
                                                <div class="sipping-item-wrap">
                                                    <div class="item-photo">
                                                        <img src="/public/img/confirm-box.png" class="box-img"
                                                             alt="item"/>
                                                    </div>
                                                    <h3 class="font-sec-reg font-24 item-title">{!! __('order_number') !!}</h3>
                                                    <p class="font-sec-reg font-24 text-red-clr lh-1 item-info">
                                                        {!! $order->order_number !!}
                                                    </p>
                                                    <a href="{{ route('my_account_order_invoice',$order->id) }}"
                                                       class="d-flex align-items-center justify-content-center font-18 text-sec-clr bg-blue-clr item-order-btn">
                                                        {!! __('track_your_order') !!}</a>
                                                </div>
                                            </li>
                                            <li class="col-md-4 col-sm-6">
                                                <div class="sipping-item-wrap address-item">
                                                    <div class="item-photo">
                                                        <img src="/public/img/confirm-home.png" class="home-img"
                                                             alt="item"/>
                                                    </div>
                                                    <h3 class="font-sec-reg font-24 item-title">{!! __('shipping_address') !!}</h3>
                                                    <div class="d-inline-block text-left">
                                                        <p class="font-main-light font-17 text-wrap">{{ $order->shippingAddress->company }}</p>
                                                        <p class="font-main-light font-17 text-wrap">
                                                            {!! $order->shippingAddress->first_line_address ." ".$order->shippingAddress->second_line_address  !!}</p>
                                                        <p class="font-main-light font-17 text-wrap">{!! $order->shippingAddress->city !!}</p>
                                                        <p class="font-main-light font-17 text-wrap">{!! $order->shippingAddress->post_code !!}</p>
                                                        <p class="font-main-light font-17 text-wrap mb-0">{!! $order->shippingAddress->country !!}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-md-4 col-sm-6">
                                                <div class="sipping-item-wrap delivery-item">
                                                    <div class="item-photo">
                                                        <img src="/public/img/confirm-calendar.png" class="calendar-img"
                                                             alt="item"/>
                                                    </div>
                                                    <h3 class="font-sec-reg font-24 item-title">
                                                        {!! __('expected') !!} <br>
                                                        {!! __('date_delivery') !!}
                                                    </h3>
                                                    <p class="font-sec-reg font-24 text-tert-clr lh-1 date-info">
                                                        {!! __('friday') !!}</p>
                                                    <p class="font-sec-reg font-24 text-tert-clr lh-1 date-info mb-0">
                                                        10/08/2019</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="right-col">
                                        <div class="sipping-item-wrap-both">
                                            <div class="d-flex flex-wrap align-items-center sipping-item-wrap ">
                                                <div class="item-photo">
                                                    <img src="/public/img/confirm-user.png" class="user-img"
                                                         alt="item"/>
                                                </div>
                                                <a href="{{ route('my_account') }}"
                                                   class="d-flex align-items-center justify-content-center font-18 text-sec-clr bg-blue-clr item-order-btn">
                                                    {!! __('view_profile') !!}</a>
                                            </div>
                                            <div class="d-flex flex-wrap align-items-center sipping-item-wrap ">
                                                <div class="item-photo">
                                                    <img src="/public/img/confirm-gift.png" class="gift-img"
                                                         alt="item"/>
                                                </div>
                                                <a href="{{ route('wholesaler') }}"
                                                   class="d-flex align-items-center justify-content-center font-18 text-sec-clr bg-red item-order-btn">
                                                    {!! __('continue_shopping') !!}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="block-ads">
                                </div>
                                <h2 class="font-40 lh-1 title">{!! __('your_order') !!}</h2>
                                <ul class="row list-order">
                                    @foreach($order->items as $item)
                                        {{--{!! dd($item->options) !!}--}}

                                        <li class="col-md-4">
                                            <div class="order__product-wall">
                                                <div class="main-info">
                                                    <div class="order__product-photo">
                                                        <img src="{!! checkImage($item->image) !!}"
                                                             alt="{{ $item->name }}">
                                                    </div>
                                                    <h6 class="font-20 text-tert-clr lh-1 order__product-title text-truncate">{{ $item->name }}</h6>
                                                    <p class="font-20 lh-1 order__product-sec-title"> </p>
                                                    <div class="order__product-info">

                                                    </div>
                                                </div>

                                                <div class="qty-price">
                                                    <div
                                                        class="d-flex flex-wrap align-items-center justify-content-between qty-price-inner">
                                                        <div class="d-flex align-items-center qty-col">
                                                            <span
                                                                class="font-sec-light font-24 lh-1 qty-text">{!! __('qty') !!}</span>
                                                            <div class="product__single-item-inp-num">
                                                                <div class="quantity">
                                                                    <input type="number" readonly min="1" max="9"
                                                                           step="1"
                                                                           value="{{ $item->qty }}">

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="price-col">
                                                        <span class="lh-1 text-tert-clr ">
                                                            {!! convert_price($item->price,$order->currency) !!}
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            </div>
                            {{--                confirm tab end--}}
                            <div class="col-lg-2 pr-md-right">
                                <div class="right-content">
                                    <div class="right-ads">
                                        <img src="/public/img/temp/ads-product-2.jpg" alt="ads">
                                    </div>
                                    <div class="card order-summary">
                                        <div class="card-header text-tert-clr font-26">
                                            {!! __('order_summary') !!}
                                        </div>
                                        <div class="card-body border-top-0">
                                            <div
                                                class="single-row font-24 d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="name">
                                                    {!! __('sub_total') !!}
                                                </div>
                                                <div
                                                    class="price font-main-bold">
                                                    {!! convert_price($order->amount-$order->shipping_price,$order->currency) !!}
                                                </div>
                                            </div>
                                            <div
                                                class="single-row font-24 d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="name">
                                                    {!! __('tax') !!}
                                                </div>
                                                <div
                                                    class="price font-main-bold">{!! convert_price(0,$order->currency) !!}
                                                </div>
                                            </div>
                                            <div
                                                class="single-row font-24 d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="name">
                                                    {!! __('shipping') !!}
                                                </div>
                                                <div
                                                    class="w-100 font-18 d-flex flex-wrap justify-content-between align-items-center shipping-wall">
                                                    <div class="shipping-item">
                                                        {!! $order->shipping_method !!}
                                                    </div>
                                                    <div class="price font-24 font-main-bold">
                                                        {!! convert_price($order->shipping_price,$order->currency) !!}
                                                    </div>
                                                </div>
                                                {{--<div--}}
                                                    {{--class="w-100 d-flex font-18 flex-wrap justify-content-between align-items-center shipping-wall">--}}
                                                    {{--<div class="shipping-item">--}}
                                                        {{--Shipping Service--}}
                                                    {{--</div>--}}
                                                    {{--<div class="price font-24 font-main-bold">£0</div>--}}
                                                {{--</div>--}}
                                            </div>
                                            <div
                                                class="single-row font-24 d-flex flex-wrap justify-content-between align-items-center">
                                                <div
                                                    class="w-100 d-flex flex-wrap justify-content-between align-items-center">
                                                    <div class="name">
                                                        {!! __('coupon_discount') !!}
                                                    </div>
                                                    <div
                                                        class="price font-main-bold">{!! convert_price(0,$order->currency) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="single-row font-21 d-flex flex-wrap justify-content-between align-items-center border-bottom-0 mb-0 pb-0">
                                                <div class="name">
                                                    {!! __('total') !!}
                                                </div>
                                                <div
                                                    class="price text-tert-clr font-main-bold">
                                                    {!! convert_price($order->amount,$order->currency) !!}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--@include("frontend.shop._partials.order_summary",['pyp' =>true,'back_route' => route('shop_check_out')])--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <button id="scrollTopBtn" class="scroll-top-btn d-flex align-items-center justify-content-center pointer">
            <svg viewBox="0 0 17 10" width="17px" height="10px">
                <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                      d="M0.000,8.111 L1.984,10.005 L8.498,3.789 L15.010,10.005 L16.995,8.111 L8.498,0.001 L0.000,8.111 Z"/>
            </svg>
        </button>
    </main>
@stop
@section('css')
@stop

@section('js')
@stop

