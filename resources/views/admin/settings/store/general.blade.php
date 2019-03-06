@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_store') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">General</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="shipping-tab" href="{!! route('admin_settings_shipping') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">Shipping</a>
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
            <li class="nav-item ">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_tax_rates') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Tax Rates</a>
            </li>
        </ul>
        <div class="tab-content">
            {!! Form::open(['class'=>'form-horizontal']) !!}
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="text" class="col-md-4">we ship to</label>
                                <div class="col-md-8">
                                    {!! Form::text('we_ship_to',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Stock availability</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-md-4">Availabile stock status</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-7">

                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-md-4">Out of stock status</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <label class="radio-inline">
                                        <input type="radio" name="optradio" checked>Enable Back order
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optradio">Disable order
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Currency</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <table class="table table-responsive table-striped table-bordered">
                                <thead>
                                <tr class="info">
                                    <th>Default</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Symbol</th>
                                    <th>Currency Exchange Rate</th>
                                    <th>Update using Api</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="currency-list">
                                @foreach($siteCurrencies as $currency)
                                    <tr>
                                        <td>
                                            {!! Form::radio('is_default',$currency->code,($currency->is_default)?true:null,['class'=>'c-default']) !!}
                                        </td>
                                        <td>
                                            {!! Form::select("currencies[$currency->id][code]",$currencies,$currency->code,['class'=>'form-control c-code']) !!}
                                        </td>
                                        <td>
                                            {!! Form::text("currencies[$currency->id][name]",$currency->name,['class'=>'form-control c-name']) !!}
                                        </td>
                                        <td>
                                            {!! Form::text("currencies[$currency->id][symbol]",$currency->symbol,['class'=>'form-control c-symbol','disabled' =>true]) !!}
                                        </td>
                                        <td>
                                            {!! Form::text("currencies[$currency->id][rate]",$currency->rate,['class'=>'form-control c-rate']) !!}
                                        </td>
                                        <td class="w-10">
                                            <button type="button" data-code="{{ $currency->code }}" class="btn btn-primary get-live-rate">Get live rate</button>
                                        </td>
                                        <td class="text-right w-5">
                                            <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="7" class="text-right">
                                        <button type="button" class="btn btn-info btn-sm " id="add-more-currency"><i
                                                    class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                                </tfoot>

                            </table>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-info">Update All exchange rates</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <script type="template" id="currency_row">
        <tr>
            <td>
                {!! Form::radio('is_default',null,null,['class'=>'c-default']) !!}
            </td>
            <td>
                {!! Form::select('currencies[{id}][code]',$currencies,null,['class'=>'form-control c-code']) !!}
            </td>
            <td>
                {!! Form::text('currencies[{id}][name]',null,['class'=>'form-control c-name']) !!}
            </td>
            <td>
                {!! Form::text('currencies[{id}][symbol]',null,['class'=>'form-control c-symbol','disabled' =>true]) !!}
            </td>
            <td>
                {!! Form::text('currencies[{id}][rate]',null,['class'=>'form-control c-rate']) !!}
            </td>
            <td class="w-10">
                <button type="button" data-code="" class="btn btn-primary get-live-rate">Get live rate</button>
            </td>
            <td class="text-right w-5">
                <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    </script>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">

@stop
@section('js')
    <script>
        $(function () {
            function makeid() {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

                for (var i = 0; i < 9; i++)
                    text += possible.charAt(Math.floor(Math.random() * possible.length));

                return text;
            }

//            $('.default-currency').on('change', function () {
//                let value = $(this).val();
//                window.location.href='?p='+value;
//            })
            $('#add-more-currency').on('click', function () {
                let unqiueID = makeid();
                let html = $('#currency_row').html();
                html=html.replace(/{id}/g,unqiueID);
                $('#currency-list').append(html);
            });
            $('body').on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
            });

            $('body').on('click', '.get-live-rate' ,function () {
                let code = $(this).data('code');
                let parent = $(this).closest('tr');

                $.ajax({
                    type: "post",
                    url: "/admin/settings/store/general/currency-get-live",
                    cache: false,
                    datatype: "json",
                    data: {
                        code: code
                    },
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        if (!data.error) {
                            parent.find('.c-rate').val(data.rate)
                        }else{
                            alert('NO live data with this code');
                        }
                    }
                });
            });

            $("body").on('change','.c-code',function () {
                let code = $(this).val();
                let parent = $(this).closest('tr');
                $.ajax({
                    type: "post",
                    url: "/admin/settings/store/general/currency-data",
                    cache: false,
                    datatype: "json",
                    data: {
                        code: code
                    },
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        if (!data.error) {
                            parent.find('.c-name').val(data.data.name)
                            parent.find('.c-symbol').val(data.data.symbol)
                            parent.find('.c-rate').val(data.data.rate)
                            parent.find('.c-default').val(data.data.currency)
                            parent.find('.get-live-rate').data('code',data.data.currency)
                        }
                    }
                });
            });


        })
    </script>

@stop