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
            <div class="d-flex align-items-center right-head">
                <a href="javascript:void(0)" class="btn btn-default refund-all">Refund Order</a>
            </div>
        </div>
        <nav class="nav-orders">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-order-details-tab" data-toggle="tab"
                   href="#nav-order-details" role="tab" aria-controls="nav-details" aria-selected="true">Refund</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade  show active" id="nav-order-details" role="tabpanel"
                 aria-labelledby="nav-order-details-tab">
                <div class="order-details__tab">
                    <div class="row">
                        <div class="col-lg-9">
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
                                            <li class="col-xl-4 col-sm-6">
                                                <div class="order__product-wall">
                                                    <div class="main-info">
                                                        <div class="order__product-photo">
                                                            <img src="{!! checkImage($item->image) !!}"
                                                                 alt="{{ $item->name }}">
                                                        </div>
                                                        <h6 class="font-18 text-tert-clr lh-1 order__product-title text-truncate">{{ $item->name }}</h6>
                                                        {{--<p class="font-18 lh-1 order__product-sec-title">Cola Shades--}}
                                                            {{--E-Juice</p>--}}
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
                                                                                            {{ $op['title'] ." - ". getItemShortname($op['variation']['item_id']) }}
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
                                                                                {{ $ext['title'] ." - ". getItemShortname($ext['variation']['item_id']) }}
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
                                                    <div class="delete-item">
                                                        <a href="javascript:void(0)" class="btn btn-danger refund-item" data-id="{{ $item->id }}">Refund</a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <h2 class="font-sec-reg font-22 lh-1 title">Refunded</h2>
                                    <ul class="row list-order">
                                        @foreach($order->items()->where('is_refunded',true)->get() as $item)
                                            <li class="col-xl-4 col-sm-6">
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
                                                                                            {{ $op['title'] ." - ". getItemShortname($op['variation']['item_id'])}}
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
                                                                                {{ $ext['title'] ." - ". getItemShortname($ext['variation']['item_id']) }}
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
                        <div class="col-lg-3">
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
        </div>
    </div>

    <div class="modal fade" id="refund_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="delete_item_label">Are you sure you want to refund ?</h4>
                </div>
                <div class="modal-body">
                    <a class="btn btn-default" data-dismiss="modal">NO</a>
                    <a id="item_modal_refund_button" class="btn btn-danger" data-slug="empty" data-url="empty">YES</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm_refund" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="delete_item_label">Please choose option where to put Item ?</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open() !!}
                    <div class="form-group">
                        {!! Form::hidden('order_item_id',null,['id' => 'order_item_id']) !!}
                        <label>Choose option</label>
                        {!! Form::select('type',[0=> "Put to Others",1=>"Return to Items"],null,['class' => 'form-control choose-option']) !!}
                    </div>
                    <div class="form-group row other-box">
                        <label class="col-md-2 control-label" for="supplier">
                            Reason</label>
                        <div class="col-md-10">
                            {!! Form::select('reason',[
                            'Lost'=>'Lost',
                            'Damaged'=>'Damaged',
                            'Returned'=>'Returned',
                            'Faulty'=>'Faulty',
                            'Shelf life'=>'Shelf life',
                            'Confiscated'=>'Confiscated',
                            'Gift'=>'Gift',
                            'Marketing or designer needs '=>'Marketing or designer needs',
                            'Admin needs'=>'Admin needs',
                            'Stolen'=>'Stolen',
                            ],null,[ 'class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row other-box">
                        <label class="col-md-2 control-label" for="supplier">
                            Notes</label>
                        <div class="col-md-10">
                            {!! Form::textarea('notes',null,[ 'class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <a class="btn btn-default" data-dismiss="modal">Close</a>
                    {!! Form::submit('Confirm',['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
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
            $("body").on('change','.choose-option',function () {
                let val = $(this).val();
                if(val == 1){
                    $("body").find(".other-box").addClass('d-none');
                }else{
                    $("body").find(".other-box").removeClass('d-none');
                }
            })

            $("body").on("click",'.refund-all',function () {
                $("#item_modal_refund_button").attr('data-slug',"all");
                $("#refund_modal").modal();
            });

            $("body").on("click",'.refund-item',function () {
                $("#item_modal_refund_button").attr('data-slug',$(this).data('id'));
                $("#refund_modal").modal();
            })

            $("body").on("click",'#item_modal_refund_button',function () {
                $("#refund_modal").modal("hide");
                $("#order_item_id").val($(this).data('slug'));
                $("#confirm_refund").modal();
            })

        });
    </script>
@stop
