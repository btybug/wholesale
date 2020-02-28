@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
        <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
            @ok('admin_settings_store')
            <li class="nav-item ">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_store') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">General</a>
            </li>
            @endok
            @ok('admin_settings_shipping')
            <li class="nav-item ">
                <a class="nav-link" id="shipping-tab" href="{!! route('admin_settings_shipping') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">GEO zones</a>
            </li>
            @endok
            @ok('admin_settings_payment_gateways')
            <li class="nav-item">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_payment_gateways') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Payment gateways</a>
            </li>
            @endok
            @ok('admin_settings_couriers')
            <li class="nav-item">
                <a class="nav-link active" id="payment_gateways" href="{!! route('admin_settings_couriers') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Courier </a>
            </li>
            @endok
            @ok('admin_settings_store_gifts')
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_store_gifts') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Gifts</a>
            </li>
            @endok
            @ok('admin_settings_delivery')
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_delivery') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Delivery Cost</a>
            </li>
            @endok
            @ok('admin_settings_tax_rates')
            <li class="nav-item ">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_tax_rates') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Tax Rates</a>
            </li>
            @endok
            <li class="nav-item ">
                <a class="nav-link " id="printing-tab" href="{!! route('admin_settings_printing') !!}" role="tab"
                   aria-controls="printing" aria-selected="true" aria-expanded="true">Printing</a>
            </li>
        </ul>
        </div>
        <div class="" id="myTabContent">
            <div class="" aria-labelledby="general-tab">
                <div class="payment_gateways_tab">
                    <ul class="list_paymant">
                        @foreach($couriers as $courier)
                            <li class="item @if($model->{$courier->id}) active @endif">
                                <div class="chek-title">
                                    <input id="cash_paymant" @if($model->{$courier->id}) checked
                                           @endif  name="{!! $courier->id !!}" class="gateways_inp" type="checkbox">
                                    <label for="cash_paymant" class="title">{!! $courier->name !!}</label>
                                </div>
                                @ok('admin_settings_courier_edit')
                                <a href="{!! route('admin_settings_courier_edit',$courier->id) !!}"
                                   class="btn btn-sm btn-warning"><i class="fa fa-cogs"></i></a>
                                @endok
                            </li>
                        @endforeach
                    </ul>
                    <div class="text-right">
                        <a href="{!! route('admin_settings_courier_create') !!}" class="btn btn-primary">Create new</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop

@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')
    <script>
        $('body').on('change', '.payment_gateways_tab .list_paymant .item .gateways_inp', function () {
            if ($(this).is(':checked')) {
                $(this).closest('.item').addClass('active')
            } else {
                $(this).closest('.item').removeClass('active')
            }
        });
        $('.gateways_inp').on('change', function () {
            var data = {key: $(this).attr('name'), onOff: $(this).prop("checked")}
            $.ajax({
                type: "post",
                url: '{!! route('post_admin_couriers_enable') !!}',
                datatype: "json",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                }
            });
        });

    </script>
@stop
