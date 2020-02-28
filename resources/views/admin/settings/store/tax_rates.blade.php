@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
        <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_store') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">General</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="shipping-tab" href="{!! route('admin_settings_shipping') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">GEO zones</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_payment_gateways') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Payment gateways</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_couriers') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Courier </a>
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
            <li class="nav-item">
                <a class="nav-link active" id="general-tab" href="{!! route('admin_settings_tax_rates') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Tax Rates</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " id="printing-tab" href="{!! route('admin_settings_printing') !!}" role="tab"
                   aria-controls="printing" aria-selected="true" aria-expanded="true">Printing</a>
            </li>
        </ul>
        </div>
        <div>
            <div class="" aria-labelledby="general-tab">
                <div class="payment_gateways_tab">
                    <ul class="list_paymant">
                            @foreach($tax_rates as $tax_rate)
                                <li class="item @if($tax_rate->is_active) active @endif">
                                    <div class="chek-title">
                                        <input id="cash_paymant" @if($tax_rate->is_active) checked
                                               @endif  name="{!! $tax_rate->id !!}" class="gateways_inp" type="checkbox">
                                        <label for="cash_paymant" class="title">{!! $tax_rate->name !!}</label>
                                    </div>
                                    <a href="{!! route('get_admin_settings_tax_create_or_update',$tax_rate->id) !!}"
                                       class="btn btn-sm btn-warning"><i class="fa fa-cogs"></i></a>
                                </li>
                            @endforeach
                    </ul>
                    <div class="text-right">
                        <a href="{!! route('get_admin_settings_tax_create_or_update') !!}" class="btn btn-primary">Create new</a>
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
                url: '{!! route('post_admin_tax_rate_enable') !!}',
                datatype: "json",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                }
            });
        });

    </script>
    @stop
