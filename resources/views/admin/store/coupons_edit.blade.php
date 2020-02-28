@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="row">
        <div class="col-xl-8">
            <div class="coupons_new_page">
                <div class="card panel panel-default coupons_page-panel">

                    <div class="card-header panel-heading">
                        <div class="left-head">
                            <h2 class="m-0 pull-left">{{ ($coupons) ? $coupons->name : "Add Coupon" }}</h2>

                        </div>
                        <div class="right-head d-flex">
                            <div class="cancel-coupon">
                                @if($coupons->status)
                                    {!! Form::model($coupons,['url' => route('admin_store_coupons_cancel'),'class' => '']) !!}
                                    {!! Form::hidden('id',null) !!}
                                    <button type="submit" class="btn btn-danger">Cancel the coupon</button>
                                    {!! Form::close() !!}
                                @else
                                    <strong>Canceled on: </strong> {{ BBgetDateFormat($coupons->updated_at) }}
                                @endif
                            </div>
                            {!! Form::model($coupons,['url' => route('admin_store_coupons_save'),'files' => true,'id' => 'form-coupon','class' => '']) !!}
                            {!! Form::hidden('id',null) !!}
                        </div>
                    </div>
                    <div class="card-body panel-body">
                        <div class="form-group row required">
                            <label class="col-xl-2 col-md-3 control-label" for="input-name">Coupon Name</label>
                            <div class="col-xl-7 col-md-6">
                                <div class="form-control">{{ $coupons->name }}</div>
                            </div>
                        </div>

                        <div class="form-group row required">
                            <label class="col-xl-2 col-md-3  control-label" for="input-code"><span data-toggle="tooltip"
                                                                                         title=""
                                                                                         data-original-title="The code the customer enters to get the discount.">Code</span></label>
                            <div class="col-xl-7 col-md-6">
                                <div class="form-control">{{ $coupons->code }}</div>
                            </div>
                            <div class="col-xl-3 col-md-3">
                            </div>
                        </div>
                        <div class="card panel panel-default mb-2">
                            <div class="card-header panel-heading">Application</div>
                            <div class="card-body panel-body">
                                <div class="form-group row">
                                    <label class="col-xl-2 col-md-4 control-label" for="input-total"><span data-toggle="tooltip"
                                                                                                  title=""
                                                                                                  data-original-title="The total amount that must be reached before the coupon is valid.">Discount Amount</span></label>
                                    <div class="col-xl-10 col-md-8">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-control">{{ $coupons->discount }}</div>
                                            </div>
                                            <div class="col-sm-6">
                                                @if($coupons->type == 'p')
                                                    <div class="form-control">Percentage</div>
                                                @else
                                                    <div class="form-control">Fixed Amount</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-2 col-md-4 control-label">Coupon Based</label>
                                    <div class="col-xl-10 col-md-8">
                                        @if($coupons->based == 'product')
                                            <div class="form-control"> Product base</div>
                                        @else
                                            <div class="form-control">Cart base</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row product-box {{ (isset($coupons) && $coupons->based == 'cart') ? 'hide' :'' }}">
                                    <label class="col-xl-2 col-md-4 control-label" for="input-product"><span
                                                data-toggle="tooltip" title=""
                                                data-original-title="Choose specific products the coupon will apply to. Select no products to apply coupon to entire cart.">Select Product</span></label>
                                    <div class="col-xl-10 col-md-8">
                                        <div class="form-control"> {{ ($coupons->stock) ? $coupons->stock->name : null }}</div>
                                    </div>
                                </div>
                                <div class="form-group row product-box {{ (isset($coupons) && $coupons->based == 'cart') ? 'hide' :'' }}">
                                    <label class="col-xl-2 col-md-4  control-label" for="input-product"><span
                                                data-toggle="tooltip" title=""
                                                data-original-title="Choose specific products the coupon will apply to. Select no products to apply coupon to entire cart.">Variations</span></label>
                                    <div class="col-xl-10 col-md-8 variations-box">
                                        @if($coupons && $coupons->stock)
                                            @foreach($coupons->stock->variations as $variation)
                                                <div class="">
                                                    <label for="variation_{{ $variation->id }}">{{ get_stock_variation($variation->id) }}</label>
                                                    {!! Form::checkbox('variations[]',$variation->id,null,['id' => 'variation_'.$variation->id]) !!}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-2 col-md-4  control-label">Free Shipping</label>
                                    <div class="col-xl-10 col-md-8">
                                        @if($coupons->shipping_type)
                                            <div class="form-control"> Yes</div>
                                        @else
                                            <div class="form-control"> No</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card panel panel-default mb-2">
                            <div class="card-header panel-heading">Target</div>
                            <div class="card-body panel-body">
                                <div class="form-group row">
                                    <label class="col-xl-2 col-md-4 control-label">Target</label>
                                    <div class="col-xl-10 col-md-8">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                @if($coupons->target)
                                                    <div class="form-control"> Specific</div>
                                                @else
                                                    <div class="form-control"> All</div>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 user-box {{ (isset($coupons) && $coupons->target) ? '' :'hide' }}">
                                                @if($coupons->users && count($coupons->users))
                                                    @foreach($coupons->users as $user)
                                                        <div class="">{{ get_user($user) }}</div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card panel panel-default">
                            <div class="card-header panel-heading">Validity</div>
                            <div class="card-body panel-body">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label" for="input-date-start">Date
                                                Start</label>
                                            <div class="col-sm-8">
                                                <div class="input-group date">
                                                    <div class="form-control">{!! BBgetDateFormat($coupons->start_date) !!}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label text-md-right" for="input-date-end">Date
                                                End</label>
                                            <div class="col-sm-8">
                                                <div class="input-group date">
                                                    <div class="form-control">{!! BBgetDateFormat($coupons->end_date) !!}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-2 col-sm-4 control-label" for="input-total"><span data-toggle="tooltip"
                                                                                                  title=""
                                                                                                  data-original-title="The total amount that must be reached before the coupon is valid.">Minimal order amount</span></label>
                                    <div class="col-xl-10 col-sm-8">
                                        <div class="form-control">{{ $coupons->total_amount }}</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-2 col-sm-4 control-label" for="input-uses-total"><span
                                                data-toggle="tooltip" title=""
                                                data-original-title="The maximum number of times the coupon can be used by any customer. Leave blank for unlimited">Total card use</span></label>
                                    <div class="col-xl-10 col-sm-8">
                                        <div class="form-control">{{ $coupons->user_per_coupon }}</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-2 col-sm-4 control-label" for="input-uses-customer"><span
                                                data-toggle="tooltip" title=""
                                                data-original-title="The maximum number of times the coupon can be used by a single customer. Leave blank for unlimited">Each user for</span></label>
                                    <div class="col-xl-10 col-sm-8">
                                        <div class="form-control">{{ $coupons->user_per_customer }}</div>
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
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-xl-4">
            {!! $coupons->renderVoucher() !!}
        </div>
    </div>


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

        $("body").on('change', '.product-select', function () {
            $(".variations-box").html('');
            AjaxCall("/admin/stock/get-variations-by-id", {id: $(this).val()}, function (res) {
                if (!res.error) {
                    if (res.data.length) {
                        for (let i in res.data) {
                            var item = res.data[i];
                            let html = $('#variation_template').html();
                            html = html.replace(/{name}/g, item.name).replace(/{id}/g, item.id);
                            $(".variations-box").append(html)
                            console.log(res.data[i])
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
