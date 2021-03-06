@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
        <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
            <li class="nav-item ">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_store') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">General</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="shipping-tab" href="{!! route('admin_settings_shipping') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">GEO zones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="payment_gateways" href="{!! route('admin_settings_payment_gateways') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Payment gateways</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_couriers') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Couriers</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_store_gifts') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Gifts</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_delivery') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Delivery Cost</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_tax_rates') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Tax Rates</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " id="printing-tab" href="{!! route('admin_settings_printing') !!}" role="tab"
                   aria-controls="printing" aria-selected="true" aria-expanded="true">Printing</a>
            </li>
        </ul>
        </div>
        <div class="" id="myTabContent">
            <div class="" aria-labelledby="general-tab">

            </div>
        </div>
        <div class="payment_gateways_tab">
            <ul class="list_paymant">
                <li class="item">
                    <div class="chek-title">
                        <input id="cash_paymant" @if($model->cash) checked @endif  name="cash" class="gateways_inp" type="checkbox">
                        <label for="cash_paymant" class="title">Cash Paymant</label>
                    </div>
                    <a href="{!! route('admin_payment_gateways_cash') !!}" class="btn btn-sm btn-warning"><i class="fa fa-cogs"></i></a>
                </li>
                <li class="item">
                    <div class="chek-title">
                        <input id="stripe_paymant" @if($model->stripe) checked @endif name="stripe" class="gateways_inp" type="checkbox">
                        <label for="stripe_paymant"  class="title">Stripe</label>
                    </div>
                    <a href="{!! route('admin_payment_gateways_stripe') !!}" class="btn btn-sm btn-warning"><i class="fa fa-cogs"></i></a>
                </li>
                <li class="item">
                    <div class="chek-title">
                        <input id="paypal" type="checkbox" name="paypal" @if($model->paypal) checked @endif value="paypal" class="gateways_inp">
                        <label for="paypal" class="title">Paypal</label>
                    </div>
                    <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-cogs"></i></a>
                </li>

            </ul>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')
    <script>
        $('body').on('change','.payment_gateways_tab .list_paymant .item .gateways_inp',function () {
            if ($(this).is(':checked')) {
                $(this).closest('.item').addClass('active')
            }else {
                $(this).closest('.item').removeClass('active')
            }
        });
            $('.gateways_inp').on('change',function () {
                var data={key:$(this).attr('name'),onOff:$(this).prop( "checked")}
                $.ajax({
                    type: "post",
                    url: '{!! route('post_admin_payment_gateways_enable') !!}',
                    datatype: "json",
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    }
                });
                });

    </script>
@stop
