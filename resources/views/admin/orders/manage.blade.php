@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="order__admin-wrapper">
        <div class="d-flex align-items-center justify-content-between position-relative head-order-wrap">
            <div class="d-flex align-items-center left-head">
                <span class="font-sec-reg font-24 title">Order:  {!! $order->order_number !!} </span>
                <div class="d-flex align-items-center">
                    <span class="title-customer">Customer</span>
                    <span class="font-main-light border-main d-flex align-items-center justify-content-center name">
                        {!! $order->user->name ." " .$order->user->last_name !!}
                    </span>
                </div>
            </div>
            <span id="orderStatus">
                @include("admin.orders._partials.order_status")
            </span>
        </div>
        <nav class="nav-orders">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-order-details-tab" data-toggle="tab"
                   href="#nav-order-details" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
                <a class="nav-item nav-link" id="nav-order-docs-tab" data-toggle="tab" href="#nav-order-docs"
                   role="tab"
                   aria-controls="nav-order-docs" aria-selected="false">Docs</a>
                <a class="nav-item nav-link" id="nav-order-collecting-tab" data-toggle="tab"
                   href="#nav-order-collecting" role="tab" aria-controls="nav-order-collecting" aria-selected="false">Collecting</a>
                <a class="nav-item nav-link" id="nav-order-shipping-tab" data-toggle="tab" href="#nav-order-shipping"
                   role="tab" aria-controls="nav-order-shipping" aria-selected="false">Shipping</a>
                <a class="nav-item nav-link" id="nav-order-logs-tab" data-toggle="tab" href="#nav-order-logs"
                   role="tab"
                   aria-controls="nav-order-logs" aria-selected="false">Logs</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade  show active" id="nav-order-details" role="tabpanel"
                 aria-labelledby="nav-order-details-tab">
                <div class="order-details__tab">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="order-details__tab-left">
                                <div class="shopping__cart-confirm w-100">
                                    <div class="row list-shipping">
                                        <div class="left-col">
                                            <ul class="row mb-0">
                                                <li class="col-md-4 col-sm-6">
                                                    <div class="sipping-item-wrap">
                                                        <div class="item-photo">
                                                            <img src="{{ user_avatar($order->user_id) }}"
                                                                 class="user-img"
                                                                 alt="item"/>
                                                        </div>
                                                        <h3 class="font-sec-reg font-18 item-title">{{ $order->user->name. " ".$order->user->last_name }}</h3>
                                                        <p class="font-sec-reg font-18 text-red-clr lh-1 item-info">
                                                            {!! $order->order_number !!}
                                                        </p>
                                                        <a href="{{ route('my_account_order_invoice',$order->id) }}"
                                                           class="d-flex align-items-center justify-content-center font-14 text-sec-clr bg-blue-clr item-order-btn">Verfied
                                                            Customer</a>
                                                    </div>
                                                </li>
                                                <li class="col-md-4 col-sm-6">
                                                    <div class="sipping-item-wrap address-item">
                                                        <div class="item-photo">
                                                            <img src="/public/img/confirm-home.png" class="home-img"
                                                                 alt="item"/>
                                                        </div>
                                                        <h3 class="font-sec-reg font-18 item-title">Shipping
                                                            Address</h3>
                                                        <div class="d-inline-block text-left">
                                                            <p class="font-main-light font-13 text-wrap">{{ $order->shippingAddress->company }}</p>
                                                            <p class="font-main-light font-13 text-wrap">
                                                                {!! $order->shippingAddress->first_line_address ." ".$order->shippingAddress->second_line_address  !!}</p>
                                                            <p class="font-main-light font-13 text-wrap">{!! $order->shippingAddress->city !!}</p>
                                                            <p class="font-main-light font-13 text-wrap">{!! $order->shippingAddress->post_code !!}</p>
                                                            <p class="font-main-light font-13 text-wrap mb-0">{!! $order->shippingAddress->country !!}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="col-md-4 col-sm-6">
                                                    <div class="sipping-item-wrap delivery-item">
                                                        <div class="item-photo">
                                                            <img src="/public/img/confirm-calendar.png"
                                                                 class="calendar-img"
                                                                 alt="item"/>
                                                        </div>
                                                        <h3 class="font-sec-reg font-18 item-title">
                                                            Date of Order
                                                        </h3>
                                                        <p class="font-sec-reg font-18 text-tert-clr lh-1 date-info">
                                                            {{ BBgetDateFormat($order->created_at,"l M Y") }}
                                                        </p>
                                                        <p class="font-sec-reg font-18 text-tert-clr lh-1 date-info mb-0">
                                                            {{ BBgetTimeFormat($order->created_at,"H:i") }}
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="right-col">
                                            <div class="sipping-item-wrap method-wrap">
                                                <div class="d-flex align-items-center single-wrap">
                                                    <div class="font-sec-reg font-18 left-wrap">Delivery Method</div>
                                                    <div class="font-16 text-tert-clr right-wrap">
                                                        {!! $order->shipping_method !!}
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center single-wrap">
                                                    <div class="font-sec-reg font-18 left-wrap">Total items</div>
                                                    <div class="font-16 text-tert-clr right-wrap">
                                                        @if($order->items->count() > 1)
                                                            {{ $order->items()->where('is_refunded',false)->count() }} Items
                                                        @else
                                                            {{ $order->items()->where('is_refunded',false)->count() }} Item
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center single-wrap">
                                                    <div class="font-sec-reg font-18 left-wrap">Total weight</div>
                                                    <div class="font-16 text-tert-clr right-wrap">200 g</div>
                                                </div>
                                                <div class="d-flex align-items-center single-wrap">
                                                    <div class="font-sec-reg font-18 left-wrap">Payment Method</div>
                                                    <div class="font-16 text-tert-clr right-wrap">
                                                        {{ ucfirst($order->payment_method) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="font-sec-reg font-22 lh-1 title">Order Details</h2>
                                    <ul class="row list-order">
                                        @foreach($order->items()->where('is_refunded',false)->get() as $item)
                                            <li class="col-md-4">
                                                <div class="order__product-wall">
                                                    <div class="main-info">
                                                        <div class="order__product-photo">
                                                            <img src="{!! checkImage($item->image) !!}"
                                                                 alt="{{ $item->name }}">
                                                        </div>
                                                        <h6 class="font-18 text-tert-clr lh-1 order__product-title text-truncate">{{ $item->name }}</h6>
                                                        <p class="font-18 lh-1 order__product-sec-title">Cola Shades
                                                            E-Juice</p>
                                                        <div class="order__product-info">
                                                            @if(! $order->type)
                                                                @if(count($item->options['options']))
                                                                    <ul class="list-unstyled mb-0">
                                                                        @foreach($item->options['options'] as $option)
                                                                            <li class="single-row-product">
                                                                                @foreach($option['options'] as $op)
                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-sm-9 font-15 font-main-bold">
                                                                                            {{ $op['title'] }}
                                                                                            @if(isset($op['variation']['item']))
                                                                                                {{ " - " .$op['variation']['item']['short_name'] }}
                                                                                            @endif

                                                                                            @if($op['discount'] && $op['variation']['discount_type'] == 'fixed')
                                                                                                ({{ "Pack of ".$op['discount']['qty'] }})
                                                                                            @endif
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-sm-2 font-main-bold pl-prod-qty-opt                                                                                                                                                                                    ">
                                                                                            <span>x {{ $op['qty'] }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @php
                                                        $extraPrice = 0;
                                                    @endphp
                                                    @if(isset($item->options['extras']) && count($item->options['extras']))
                                                        <div class="order__product-offers">
                                                            <div class="font-16 text-sec-clr offers-tag">
                                                                With offers:
                                                            </div>

                                                            @foreach($item->options['extras'] as $extra)
                                                                @foreach($extra['options'] as $ext)
                                                                    @php
                                                                        if($ext['discount']){
                                                                            if($ext['variation']['discount_type'] =='fixed'){
                                                                                $price = $ext['discount']['price'];
                                                                            }else{
                                                                                $price = $ext['discount']['price']* $ext['qty'];
                                                                            }
                                                                        }else{
                                                                            $price = $ext['variation']['price'] * $ext['qty'];
                                                                        }
                                                                    @endphp
                                                                    @php
                                                                        $extraPrice +=$price;
                                                                    @endphp
                                                                    <div class="d-flex product-offers-inner">
                                                                        <div class="photo">
                                                                            <img src="{{ $ext['image'] }}"
                                                                                 alt="product">
                                                                        </div>
                                                                        <div class="title-offers">
                                                                            <p class="font-18 lh-1 mb-0">
                                                                                {{ $ext['title'] }}
                                                                                @if(isset($ext['variation']['item']))
                                                                                    {{ " - " .$ext['variation']['item']['short_name'] }}
                                                                                @endif

                                                                                @if($ext['discount'] && $ext['variation']['discount_type'] == 'fixed')
                                                                                    ({{ "Pack of ".$ext['discount']['qty'] }})
                                                                                @endif
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    <div class="qty-price">
                                                        <div
                                                            class="d-flex flex-wrap align-items-center justify-content-between qty-price-inner">
                                                            <div class="d-flex align-items-center qty-col">
                                                            <span
                                                                class="font-sec-light font-22 lh-1 qty-text">QTY</span>
                                                                <div class="product__single-item-inp-num">
                                                                    <div class="quantity">
                                                                        <input type="number" readonly min="1" max="9"
                                                                               step="1"
                                                                               value="{{ $item->qty }}">

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="price-col">
                                                        <span class="lh-1 text-tert-clr font-35">
                                                            {!! convert_price($item->price+$extraPrice,get_currency()) !!}
                                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <h2 class="font-sec-reg font-22 lh-1 title">Refunded</h2>
                                    <ul class="row list-order">
                                        @foreach($order->items()->where('is_refunded',true)->get() as $item)
                                            <li class="col-md-4">
                                                <div class="order__product-wall">
                                                    <div class="main-info">
                                                        <div class="order__product-photo">
                                                            <img src="{!! checkImage($item->image) !!}"
                                                                 alt="{{ $item->name }}">
                                                        </div>
                                                        <h6 class="font-18 text-tert-clr lh-1 order__product-title text-truncate">{{ $item->name }}</h6>
                                                        <p class="font-18 lh-1 order__product-sec-title"></p>
                                                        <div class="order__product-info">
                                                            @if(count($item->options['options']))
                                                                <ul class="list-unstyled mb-0">
                                                                    @foreach($item->options['options'] as $option)
                                                                        <li class="single-row-product">
                                                                            @foreach($option['options'] as $op)
                                                                                <div class="row">
                                                                                    <div
                                                                                        class="col-sm-9 font-15 font-main-bold">
                                                                                        {{ $op['title'] }}
                                                                                        @if(isset($op['variation']['item']))
                                                                                            {{ " - " .$op['variation']['item']['short_name'] }}
                                                                                        @endif
                                                                                        @if($op['discount'] && $op['variation']['discount_type'] == 'fixed')
                                                                                            ({{ "Pack of ".$op['discount']['qty'] }})
                                                                                        @endif
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-sm-2 font-main-bold pl-prod-qty-opt                                                                                                                                                                                    ">
                                                                                        <span>x {{ $op['qty'] }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @php
                                                        $extraPrice = 0;
                                                    @endphp
                                                    @if(isset($item->options['extras']) && count($item->options['extras']))
                                                        <div class="order__product-offers">
                                                            <div class="font-16 text-sec-clr offers-tag">
                                                                With offers:
                                                            </div>

                                                            @foreach($item->options['extras'] as $extra)
                                                                @foreach($extra['options'] as $ext)
                                                                    @php
                                                                        if($ext['discount']){
                                                                            if($ext['variation']['discount_type'] =='fixed'){
                                                                                $price = $ext['discount']['price'];
                                                                            }else{
                                                                                $price = $ext['discount']['price']* $ext['qty'];
                                                                            }
                                                                        }else{
                                                                            $price = $ext['variation']['price'] * $ext['qty'];
                                                                        }
                                                                    @endphp
                                                                    @php
                                                                        $extraPrice +=$price;
                                                                    @endphp
                                                                    <div class="d-flex product-offers-inner">
                                                                        <div class="photo">
                                                                            <img src="{{ $ext['image'] }}"
                                                                                 alt="product">
                                                                        </div>
                                                                        <div class="title-offers">
                                                                            <p class="font-18 lh-1 mb-0">
                                                                                {{ $ext['title'] }}
                                                                                @if(isset($ext['variation']['item']))
                                                                                    {{ " - " .$ext['variation']['item']['short_name'] }}
                                                                                @endif

                                                                                @if($ext['discount'] && $ext['variation']['discount_type'] == 'fixed')
                                                                                    ({{ "Pack of ".$ext['discount']['qty'] }})
                                                                                @endif
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    <div class="qty-price">
                                                        <div
                                                            class="d-flex flex-wrap align-items-center justify-content-between qty-price-inner">
                                                            <div class="d-flex align-items-center qty-col">
                                                            <span
                                                                class="font-sec-light font-22 lh-1 qty-text">QTY</span>
                                                                <div class="product__single-item-inp-num">
                                                                    <div class="quantity">
                                                                        <input type="number" readonly min="1" max="9"
                                                                               step="1"
                                                                               value="{{ $item->qty }}">

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="price-col">
                                                        <span class="lh-1 text-tert-clr font-35">
                                                            {!! convert_price($item->price+$extraPrice,get_currency()) !!}
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
                        </div>
                        <div class="col-md-3">
                            <div class="order-details__tab-right">
                                <div class="customers-notes">
                                    <div class="font-sec-reg text-tert-clr font-23 notes-head">
                                        Customer’s Notes
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center notes-body">
                                        <span class="font-sec-reg font-21 no-notes">No Notes Added</span>
                                    </div>
                                </div>
                                <div class="card order-summary">
                                    <div class="order-header text-tert-clr font-23">
                                        ORDER SUMMARY
                                    </div>
                                    <div class="card-body border-top-0">
                                        <div
                                            class="single-row font-21 d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="name">
                                                Sub Total
                                            </div>
                                            <div
                                                class="price font-main-bold">
                                                {{ convert_price($order->items()->where('is_refunded',false)->sum('amount'),$order->currency) }}
                                            </div>
                                        </div>
                                        <div
                                            class="single-row font-21 d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="name">
                                                Tax
                                            </div>
                                            <div
                                                class="price font-main-bold">
                                                {{ convert_price(0,$order->currency) }}
                                            </div>
                                        </div>
                                        <div
                                            class="single-row font-21 d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="name">
                                                Shipping
                                            </div>
                                            <div
                                                class="w-100 font-16 d-flex flex-wrap justify-content-between align-items-center shipping-wall">
                                                <div class="shipping-item">
                                                    United Kingdom
                                                </div>
                                                <div class="price font-21 font-main-bold">
                                                    {{ convert_price(0,$order->currency) }}
                                                </div>
                                            </div>
                                            <div
                                                class="w-100 d-flex font-16 flex-wrap justify-content-between align-items-center shipping-wall">
                                                <div class="shipping-item">
                                                    Shipping Service
                                                </div>
                                                <div class="price font-21 font-main-bold">
                                                    {{ convert_price($order->shipping_price,$order->currency) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="single-row font-21 d-flex flex-wrap justify-content-between align-items-center">
                                            <div
                                                class="w-100 d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="name">
                                                    Coupon Discount
                                                </div>
                                                <div
                                                    class="price font-main-bold">
                                                    {{ ($order->coupon && $order->coupon->based == 'cart') ?
                                                        ( ($order->coupon->type == 'p') ? $order->coupon->discount."%" : convert_price($order->coupon->discount,$order->shipping_price))
                                                    : 0 }}
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="single-row font-21 d-flex flex-wrap justify-content-between align-items-center border-bottom-0 mb-0 pb-0">
                                            <div class="name">
                                                Total
                                            </div>
                                            <div
                                                class="price text-tert-clr font-main-bold">
                                                {{ convert_price($order->amount,$order->currency) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="nav-order-docs" role="tabpanel"
                 aria-labelledby="nav-order-docs-tab">
                <div class="order-docs__tab">
                    <div class="row">
                        <div class="col-md-3">

                            <div class="font-main-reg order-docs__tab-left">
                                <div class="nav flex-column list-nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link item-link active" id="v-pills-docs-invoice-tab" data-toggle="pill" href="#v-pills-docs-invoice" role="tab" aria-controls="v-pills-docs-invoice" aria-selected="true">
                                        <span class="icon"><img src="/public/img/print-icon.png" alt="icon"></span>
                                        <span class="font-20 text-main-clr name">Invoice</span>
                                    </a>
                                    <a class="nav-link item-link" id="v-pills-docs-shipping-tab" data-toggle="pill" href="#v-pills-docs-shipping" role="tab" aria-controls="v-pills-docs-shipping" aria-selected="false">
                                        <span class="icon"><img src="/public/img/delivery-icon.png"
                                                                alt="icon"></span>
                                        <span class="font-20 text-main-clr name">Shipping Label</span>
                                    </a>
                                    <a class="nav-link item-link" id="v-pills-docs-downloads-tab" data-toggle="pill" href="#v-pills-docs-downloads" role="tab" aria-controls="v-pills-docs-downloads" aria-selected="false">
                                        <span class="icon"><img src="/public/img/delivery-icon.png"
                                                                alt="icon"></span>
                                        <span class="font-20 text-main-clr name">Downloads</span>
                                    </a>
                                </div>
{{--                                <ul class="list-nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">--}}
{{--                                    <li class="item-wrap">--}}
{{--                                        <a class="item-link" id="v-pills-docs-invoice-tab" data-toggle="pill" href="#v-pills-docs-invoice" role="tab" aria-controls="v-pills-docs-invoice" aria-selected="true">--}}
{{--                                            <span class="icon"><img src="/public/img/print-icon.png" alt="icon"></span>--}}
{{--                                            <span class="font-20 text-main-clr name">Invoice</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="item-wrap">--}}
{{--                                        <a class="item-link"  id="v-pills-docs-shipping-tab" data-toggle="pill" href="#v-pills-docs-shipping" role="tab" aria-controls="v-pills-docs-shipping" aria-selected="false">--}}
{{--                                            <span class="icon"><img src="/public/img/delivery-icon.png"--}}
{{--                                                                    alt="icon"></span>--}}
{{--                                            <span class="font-20 text-main-clr name">Shipping Label</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
                            </div>
                        </div>
                        <div class="col-md-9">

                            <div class="order-docs__tab-right">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-docs-invoice" role="tabpanel" aria-labelledby="v-pills-docs-invoice-tab">
                                        <div class="text-right">
                                            <a href="{{ route("pdf_download",$order->id) }}"
                                               class="bg-blue-clr text-sec-clr font-20 print-btn">Print</a>
                                        </div>
                                        @include('admin.pdf.invoice')
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-docs-shipping" role="tabpanel" aria-labelledby="v-pills-docs-shipping-tab">
                                        @include('admin.pdf.shipping')
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-docs-downloads" role="tabpanel" aria-labelledby="v-pills-docs-downloads-tab">
                                        @include('admin.pdf.downloads')
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-order-collecting" role="tabpanel"
                 aria-labelledby="nav-order-collecting-tab">
                <div class="font-main-reg order-collecting__tab">
                    <div class="d-flex align-items-center justify-content-between product-add-wrap">
                        <div class="d-flex align-items-center left-wrap">
                            <span class="font-sec-reg font-20 text-tert-clr lh-1 scan-name">Scan Product</span>
                            <input type="text" placeholder="Barcode" class="form-control">
                        </div>
                        <div class="d-flex align-items-center right-wrap">
                            <span class="font-18 lh-1 qty">QTY</span>
                            <div class="product__single-item-inp-num">
                                <div class="quantity">
                                    <input type="number" readonly min="1" max="9" step="1" value="1">
                                </div>
                            </div>
                            <a href="#" class="add-btn">Add</a>
                        </div>
                    </div>
                    <div class="product-table">
                        @php
                            $count = 0;
                        @endphp
                        @if(count($order->items()->where('is_refunded',false)->get()))
                            @foreach($order->items()->where('is_refunded',false)->get() as $item)
                                @if($order->type)
                                    @include("admin.orders._partials.collect_wholesaler")
                                    @php
                                        $count++;
                                    @endphp
                                @else
                                    @if(count($item->options))
                                        @if(isset($item->options['options']))
                                            @foreach($item->options['options'] as $option)
                                                @if(count($option['options']))
                                                    @foreach($option['options'] as $o)
                                                        @include("admin.orders._partials.collect")
                                                        @php
                                                            $count++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                        @if(isset($item->options['extras']))
                                            @foreach($item->options['extras'] as $option)
                                                @if(count($option['options']))
                                                    @foreach($option['options'] as $o)
                                                        @include("admin.orders._partials.collect")
                                                        @php
                                                            $count++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endif

                            @endforeach
                        @endif
                    </div>
                    <div class="d-flex align-items-center total-items-block">
                        {!! Form::hidden('item_count',$count,['id' => 'item_count']) !!}

                        <span class="font-16 total-items-count">Total Items: {{ $count }}</span>
                        <button class="check-item-btn @if($order->collections()->count() == $count) active @endif">
                            <span class="no-item">
                                <span class="icon"></span>
                                <span class="font-16 title status-check">Check All Items</span>
                            </span>
                            <span class="item-checked">
                                <span class="icon">
                                    <span class="first-icon icon-svg"><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="14px" height="11px">
<path fill-rule="evenodd" fill="rgb(255, 255, 255)"
      d="M4.454,8.702 L1.114,5.254 L0.000,6.403 L4.454,11.000 L14.000,1.149 L12.886,0.000 L4.454,8.702 Z"/>
</svg></span>
                                    <span class="second-icon icon-svg"><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="14px" height="11px">
<path fill-rule="evenodd" fill="rgb(255, 255, 255)"
      d="M4.454,8.702 L1.114,5.254 L0.000,6.403 L4.454,11.000 L14.000,1.149 L12.886,0.000 L4.454,8.702 Z"/>
</svg></span>
                                </span>
    <span class="font-16 font-weight-bold title">All Items are collected</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-order-shipping" role="tabpanel" aria-labelledby="nav-order-shipping-tab">
                4
            </div>
            <div class="tab-pane fade" id="nav-order-logs" role="tabpanel"
                 aria-labelledby="nav-order-logs-tab">
                <div class="font-main-reg order-logs__tab">
                    <div class="row">
                        <div class="col-md-9 order-main-cnt_right-col">
                            <div class="order-notes panel panel-default mb-0">
                                <div class="order-notes_timeline">
                                    <ul class="list-unstyled order-timeline">
                                        @include('admin.orders._partials.timeline_item',['histories' => $order->history()->orderBy('created_at','desc')->get()])
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="order-logs__tab-right">
                                <div class="add-notes-block">
                                    <div class="border-main note-head">
                                        <span class="font-sec-reg font-20 lh-1 text-tert-clr">Add Note</span>
                                    </div>
                                    <div class="border-main border-top-0 note-body">
                                        {!! Form::open(['url' =>route('orders_add_note')]) !!}
                                            <div class="errors"></div>
                                            {!! Form::hidden('id',$order->id) !!}
                                            <textarea name="note" id="" cols="30" rows="10"
                                                  placeholder="Your note"></textarea>
                                            {!! Form::submit('Add',['class' => 'add-note-btn change-status-btn']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="/public/admin_assets/css/global-admin.css" rel="stylesheet">
    <link href="/public/css/invoice.css" rel="stylesheet">
    <style>
        .order-main-cnt_right-col {
            height: calc(100vh - 285px);
        }

        .inline-el {
            display: inline;
        }

        .tabe-pane--management-order .mr-30 {
            margin-right: 100px;
            margin-top: 50px;
        }

        .managmentorder-table.collecting .check-product {
            display: inline-block;
        }

        .scan-your-item .panel-scan .scan {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 200px;
        }

        .scan-your-item .panel-scan .qty {
            width: 70%;
            margin: 15px auto;
        }

        .tab-content-store-settings .customer-notes .wall {
            margin-bottom: 15px;
            padding: 4px 12px;
        }

        .tab-content-store-settings .customer-notes .wall.danger {
            background-color: #ffdddd;
            border-left: 6px solid #f44336;
        }

        .tab-content-store-settings .customer-notes .wall.success {
            background-color: #ddffdd;
            border-left: 6px solid #4CAF50;
        }

        .tab-content-store-settings .customer-notes .wall.info {
            background-color: #e7f3fe;
            border-left: 6px solid #2196F3;
        }

        .tab-content-store-settings .details {
            margin-bottom: 20px;
        }

        .tab-content-store-settings .details .user-img-name {
            border: 1px solid #28618373;
            box-shadow: 0 0 4px #28618385;
        }

        .tab-content-store-settings .details .user-img-name img {
            width: 100%;
            height: 145px;
            object-fit: cover;
        }

        .tab-content-store-settings .details .user-img-name .name {
            padding: 15px 20px;
            border-top: 1px solid #28618385;
            text-align: center;
            font-weight: bold;
            background-color: #61747fe3;
            color: white;
        }

        .tab-content-store-settings .details .tabs-address .nav {
            display: flex;
        }

        .tab-content-store-settings .details .tabs-address .nav > li a {
            padding: 10px;
            text-align: center;
            color: black;
            font-size: 16px;
            border-radius: 0;
        }

        .tab-content-store-settings .details .tabs-address .nav > li {
            flex: auto;
        }

        .tab-content-store-settings .details .tabs-address .nav > li.active a {
            background-color: #3c8dbc;
            color: white;
        }

        .managmentorder-table tr td:not(.images) {
            vertical-align: middle;
        }

        .managmentorder-table .w-6 {
            width: 6%;
        }

        .managmentorder-table .w-20 {
            width: 20%;
        }

        .managmentorder-table tr .images .image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .managmentorder-table .check-product {
            display: inherit;
        }

        .managmentorder-table .check-product .contains {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 25px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .managmentorder-table .check-product .contains input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .managmentorder-table .check-product .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .managmentorder-table .check-product .contains:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .managmentorder-table .check-product .contains input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .managmentorder-table .check-product .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .managmentorder-table .check-product .contains input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .managmentorder-table .check-product .contains .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .content-wrapper {
            /*min-height: 100% !important;*/
            /*height: calc(100vh - 101px);*/
            /*overflow: hidden;*/
        }

        body > .wrapper {
            overflow: hidden;
        }

        body .main-sidebar {
            overflow-y: auto !important;
            overflow-x: hidden !important;
            height: 640px;

        }

        body .main-sidebar::-webkit-scrollbar,
        .order-main-cnt_left-col::-webkit-scrollbar,
        .order-notes::-webkit-scrollbar {
            width: 10px;
        }

        body .main-sidebar::-webkit-scrollbar-track,
        .order-main-cnt_left-col::-webkit-scrollbar-track,
        .order-notes::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        body .main-sidebar::-webkit-scrollbar-thumb,
        .order-main-cnt_left-col::-webkit-scrollbar-thumb,
        .order-notes::-webkit-scrollbar-thumb {
            background: #888;
        }

        body .main-sidebar::-webkit-scrollbar-thumb:hover,
        .order-main-cnt_left-col::-webkit-scrollbar-thumb:hover,
        .order-notes::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

    </style>
@stop

@section('js')
    <script>
        $(function () {


            $('body').on('click','.order__admin-wrapper .head-order-wrap .right-head .change-btn',function () {
                if($('.order__admin-wrapper .order__change-status-wrapper').hasClass('d-none')){
                    $('.order__admin-wrapper .order__change-status-wrapper').removeClass('d-none')
            $(this).addClass('d-none')
                    let headWrap = $(this).closest('.right-head')
                    $(headWrap).find('.submit-btn').addClass('d-none')
                    $(headWrap).find('.status-pending').removeClass('d-none')

                }else{
                    $('.order__admin-wrapper .order__change-status-wrapper').addClass('d-none')
                }
            });
            $('body').on('click','.order__change-status-wrapper-inner .close-status-icon',function () {
                $('.order__admin-wrapper .head-order-wrap .right-head .change-btn').removeClass('d-none')
                $('.order__admin-wrapper .head-order-wrap .right-head .status-pending').addClass('d-none')
                $('.order__admin-wrapper .head-order-wrap .right-head .submit-btn').removeClass('d-none')
                $(this).closest('.order__change-status-wrapper').addClass('d-none')
            });

            $("body").on('click','.check-item-btn',function () {
                var data = $("body").find('.check-collecting');
                data.each(function (e,i) {
                    $(i).click();
                })
            })

            $('body').on('click', '.check-collecting', function (event) {
                let $_this = $(this);
                if(! $_this.hasClass('d-none')){
                    let unique_id = $_this.data("unique");
                    let item_id = $_this.data("item");
                    let warehouse = $_this.closest('.collect-item').find(".warehouse").val();
                    let rack = $_this.closest('.collect-item').find(".rack").val();
                    let shelve = $_this.closest('.collect-item').find(".shelve").val();
                    let qty = $_this.closest('.collect-item').find(".itm-qty").val();

                    AjaxCall("{!! route('admin_orders_collecting',$order->id) !!}", {
                        unique_id: unique_id,
                        item_id: item_id,
                        warehouse: warehouse,
                        rack: rack,
                        shelve: shelve,
                        qty: qty,
                        count: $("#item_count").val()
                    }, function (res) {
                        if (!res.error) {
                            $_this.addClass('d-none');
                            $_this.closest('td').addClass('active');
                            $_this.closest('td').find('.check-icon').removeClass('d-none');

                            $(".status-check").html(res.message);
                            if(res.success){
                                $(".check-item-btn").addClass('active');
                            }
                        }
                    });
                }

            });

            $('#check1').click(function () {
                if ($(this).is(':checked')) alert('checked'); else alert('unchecked');
            });

            $('body').on('click', '.change-status-btn', function (event) {
                event.preventDefault();
                var form = $(this).parents('form:first');
                var data = form.serialize();
                form.find('.errors').html('');
                $.ajax({
                    url: "{!! route('orders_add_note') !!}",
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        if (!data.error) {
                            form[0].reset();
                            $('.hidden-add-field_heading .close-status-icon').trigger('click');
                            $(".order-timeline").html(data.html);
                            $("#orderStatus").html(data.statusHtml);
                        }
                    },
                    error: function (data) {
                        let errors = data.responseJSON.errors;
                        $.map(errors, function (k, v) {
                            form.find('.errors').append(`<p>${k[0]}</p>`);
                        });
                    }
                });
            });

            $('#btnAddStatus').on('click', function () {
                $('#addStatusField').addClass('show');
                $('.order-main-cnt_control-btns').hide();
            });

            $('#btnAddNote').on('click', function () {
                $('#addNoteField').addClass('show');
                $('.order-main-cnt_control-btns').hide();
            });

            $('.hidden-add-field_heading .fa-close').on('click', function () {
                $(this).closest('.hidden-add-field').removeClass('show');
                $('.order-main-cnt_control-btns').show("1000");
            });
        });

    </script>
@stop
