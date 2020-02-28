@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

    {!! Form::model($coupons,['url' => route('admin_store_coupons_save'),'files' => true,'id' => 'form-coupon','class' => '']) !!}
    <div class="row">
        <div class="col-lg-8">
            <div class="coupons_new_page">
                <div class="card panel panel-default coupons_page-panel">
                    {!! Form::hidden('id',null) !!}
                    <div class="card-header panel-heading">
                        <div class="left-head">
                            <h2 class="m-0 pull-left">New Coupon</h2>
                        </div>
                        <div class="right-head d-flex">
                            <div class="button-save ml-5">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body panel-body">
                        <div class="form-group row required">
                            <label class="col-xl-2 control-label" for="input-name">Coupon Name</label>
                            <div class="col-xl-7">
                                {!! Form::text('name',null,['placeholder' => 'Coupon Name',
                                       'id'=>'input-name', 'class'=> 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row required">
                            <label class="col-xl-2 control-label" for="input-code"><span data-toggle="tooltip"
                                                                                         title=""
                                                                                         data-original-title="The code the customer enters to get the discount.">Code</span></label>
                            <div class="col-xl-7">
                                {!! Form::text('code',null,['placeholder' => 'Code',
                                   'id'=>'input-code', 'class'=> 'form-control']) !!}
                            </div>
                            <div class="col-xl-3 mt-xl-0 mt-2">
                                <button type="button" class="btn btn-default generate-code">Generate code</button>
                            </div>
                        </div>
                        <div class="card panel panel-default mb-2">
                            <div class="card-header panel-heading">Application</div>
                            <div class="card-body panel-body">
                                <div class="form-group row">
                                    <label class="col-xl-2 control-label" for="input-total"><span data-toggle="tooltip"
                                                                                                  title=""
                                                                                                  data-original-title="The total amount that must be reached before the coupon is valid.">Discount Amount</span></label>
                                    <div class="col-xl-10">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                {!! Form::text('discount',$coupons->discount??null,['placeholder' => 'Discount',
                                                        'id'=>'input-discount', 'class'=> 'form-control']) !!}
                                            </div>
                                            <div class="col-sm-6">
                                                {!! Form::select('type',['p' => 'Percentage','f' => 'Fixed Amount'],[$coupons->type??null],[ 'id'=>'input-type', 'class'=> 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-2 control-label">Coupon Based</label>
                                    <div class="col-xl-10">
                                        <label class="radio-inline">{!! Form::radio('based','product',true,['class' => 'coupon_type']) !!}
                                            Product base
                                        </label>
                                        <label class="radio-inline">{!! Form::radio('based','cart',false,['class' => 'coupon_type']) !!}
                                            Cart base
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row product-box {{ (isset($coupons) && $coupons->based == 'cart') ? 'hide' :'' }}">
                                    <label class="col-xl-2 control-label" for="input-product"><span
                                                data-toggle="tooltip" title=""
                                                data-original-title="Choose specific products the coupon will apply to. Select no products to apply coupon to entire cart.">Products</span></label>
                                    <div class="col-xl-5">
                                        {!! Form::select('product',['' => 'Select'] + $products,null,['class'=> 'form-control input-select2 product-select','style'=>'width:100%']) !!}
                                    </div>
                                </div>
                                <div class="form-group row product-box {{ (isset($coupons) && $coupons->based == 'cart') ? 'hide' :'' }}">
                                    <label class="col-xl-2 control-label" for="input-product"><span
                                                data-toggle="tooltip" title=""
                                                data-original-title="Choose specific products the coupon will apply to. Select no products to apply coupon to entire cart.">Variations</span></label>
                                    <div class="col-xl-10 variations-box">
                                        @if($coupons && $coupons->stock)
                                            @foreach($coupons->stock->variations as $variation)
                                                <div class="col-md-3">
                                                    <label for="variation_{{ $variation->id }}">{{ get_stock_variation($variation->id) }}</label>
                                                    {!! Form::checkbox('variations[]',$variation->id,null,['id' => 'variation_'.$variation->id]) !!}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-2 control-label">Free Shipping</label>
                                    <div class="col-xl-10">
                                        <label class="radio-inline">{!! Form::radio('shipping_type',$coupons->shipping_type??null,true,['value' => 1]) !!}
                                            Yes
                                        </label>
                                        <label class="radio-inline">{!! Form::radio('shipping_type',$coupons->shipping_type??null,false,['value' => 0]) !!}
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card panel panel-default mb-2">
                            <div class="card-header panel-heading">Target</div>
                            <div class="card-body panel-body">

                                    <div class="form-group ">
                                        <div class="row">
                                            <label class="col-xl-3 control-label">Target</label>
                                            <div class="col-xl-9">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        {!! Form::select('target',[
                                                            '0' => "All",
                                                            '1' => "Specific"
                                                        ],null,['class' => 'form-control select-target']) !!}
                                                    </div>
                                                    <div class="col-sm-9 user-box {{ (isset($coupons) && $coupons->target) ? '' :'hide' }}">
                                                        {!! Form::select('users[]',$users,null,['class'=> 'form-control input-select2','multiple' => true,'style' => 'width:100%;']) !!}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="send_email" class="col-sm-9 control-label">Send
                                                email(notification)
                                                {!! Form::checkbox('send_email',1,null,['id' => 'send_email']) !!}
                                            </label>


                                        </div>
                                    </div>

                            </div>
                        </div>
                        <div class="card panel panel-default mb-2">
                            <div class="card-header panel-heading">Validity</div>
                            <div class="card-body panel-body">
                                <div class="form-group row">
                                    <div class="col-xl-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label" for="input-date-start">Date
                                                Start</label>
                                            <div class="col-sm-8">
                                                <div class="input-group date">
                                                    {!! Form::text('start_date',$coupons->start_date??null,['placeholder' => 'Date Start',
                                                  'id'=>'input-date-start', 'class'=> 'form-control','data-date-format'=>'YYYY-MM-DD']) !!}
                                                    <span class="input-group-btn">
<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label text-xl-right" for="input-date-end">Date
                                                End</label>
                                            <div class="col-sm-8">
                                                <div class="input-group date">
                                                    {!! Form::text('end_date',$coupons->end_date??null,['placeholder' => 'Date end',
                                                  'id'=>'input-date-end', 'class'=> 'form-control','data-date-format'=>'YYYY-MM-DD']) !!}
                                                    <span class="input-group-btn">
<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-2 control-label" for="input-total"><span data-toggle="tooltip"
                                                                                                  title=""
                                                                                                  data-original-title="The total amount that must be reached before the coupon is valid.">Minimal order amount</span></label>
                                    <div class="col-xl-10">
                                        {!! Form::text('total_amount',$coupons->total_amount??null,['placeholder' => 'Minimal order amount',
                                           'id'=>'input-total', 'class'=> 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-2 control-label" for="input-uses-total"><span
                                                data-toggle="tooltip" title=""
                                                data-original-title="The maximum number of times the coupon can be used by any customer. Leave blank for unlimited">Total card use</span></label>
                                    <div class="col-xl-10">
                                        {!! Form::text('user_per_coupon',$coupons->user_per_coupon??null,['placeholder' => 'Total card use',
                                           'id'=>'input-uses-total', 'class'=> 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-2 control-label" for="input-uses-customer"><span
                                                data-toggle="tooltip" title=""
                                                data-original-title="The maximum number of times the coupon can be used by a single customer. Leave blank for unlimited">Each user for</span></label>
                                    <div class="col-xl-10">
                                        {!! Form::text('user_per_customer',$coupons->user_per_customer??null,['placeholder' => 'Each user for',
                                          'id'=>'input-uses-customer', 'class'=> 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-8">
                            <div class="col-md-12">
                                {{--<div class="form-group row">--}}
                                {{--<label class="col-sm-2 control-label" for="input-status">Status</label>--}}
                                {{--<div class="col-sm-10">--}}
                                {{--{!! Form::select('status',['1' => 'Enabled','0' => 'Disabled'],[$coupons->status??null],[ 'id'=>'input-status', 'class'=> 'form-control']) !!}--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-lg-0 mt-1">
            <div class="form-group">
                {!! Form::select('theme', [
                    '' => "Select",
                    'voucher_blue' => "Theme blue",
                    'voucher_red' => "Theme red",
                ],null,['class' => 'form-control','id' => 'voucherThemeSelect']) !!}
            </div>
            <div class="voucher-box">

            </div>
        </div>
    </div>
    {!! Form::close() !!}



    <script type="template" id="variation_template">
        <div class="col-md-3">
            <label for="variation_{id}">{name}</label>
            {!! Form::checkbox('variations[]',"{id}",null,['id' => 'variation_{id}']) !!}
        </div>
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(".input-select2").select2();

        $("body").on('change', '#voucherThemeSelect', function () {
            $(".voucher-box").html('');
            let data = $("#form-coupon").serialize();
            if ($(this).val() != "") {
                AjaxCall("/admin/store/coupons/get-theme", data, function (res) {
                    if (!res.error) {
                        $(".voucher-box").append(res.html)
                    }
                });
            }

        });

        $("body").on('change', '.product-select', function () {
            $(".variations-box").html('');
            AjaxCall("/admin/stock/get-variations-by-id", {id: $(this).val()}, function (res) {
                if (!res.error) {
                    if (res.data.length) {
                        for (let i in res.data) {
                            var item = res.data[i];
                            let html = ` <div class="col-md-3">
                                    <label for="variation_${item.id}">${item.name}</label>
                                    <input type="checkbox" checked value='${item.id}' name="variations[]" id=variation_${item.id}" />
                                </div>`;
                            $(".variations-box").append(html)
                        }
                    }
                }
            });
        });

        $("body").on('change', '.coupon_type', function () {
            if ($(this).val() == 'product') {
                $(".product-box").removeClass('hide')
            } else {
                $(".product-box").addClass('hide')
            }
        });

        $("body").on('change', '.select-target', function () {
            if ($(this).val() == '1') {
                $(".user-box").removeClass('hide')
            } else {
                $(".user-box").addClass('hide')
            }
        });

        $('#input-date-start').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            // minYear: 1901,
            // maxYear: parseInt(moment().format('YYYY'),10)
        }, function (start, end, label) {
            var years = moment().diff(start, 'years');
            // alert("You are " + years + " years old!");
        });
        $('#input-date-end').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            // minYear: 1901,
            // maxYear: parseInt(moment().format('YYYY'),10)
        }, function (start, end, label) {
            var years = moment().diff(start, 'years');
            // alert("You are " + years + " years old!");
        });


        var userList = null;
        $.ajax({
            url: "/admin/get-categories",
            type: "POST",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $("input[name='_token']").val()
            },
            success: function (data) {
                userList = data;
            }
        });

        $("body").on("click", ".generate-code", function () {
            console.log(4545)
            $("#input-code").val(generateCode());
        });

        function generateCode() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 10; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }

    </script>
@stop
