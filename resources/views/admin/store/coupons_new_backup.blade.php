@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="coupons_new_page">
        <div class="panel panel-default coupons_page-panel">
            {!! Form::model($coupons,['url' => route('admin_store_coupons_save'),'files' => true,'id' => 'form-coupon','class' => '']) !!}
            {!! Form::hidden('id',null) !!}
            <div class="panel-heading">
                <div class="left-head">
                    <h2 class="m-0 pull-left">New Coupon</h2>

                </div>
                <div class="right-head">
                    <div class="button-save">
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group row required">
                            <label class="col-sm-2 control-label" for="input-name">Coupon Name</label>
                            <div class="col-sm-10">
                                {!! Form::text('name',$coupons->name??null,['placeholder' => 'Coupon Name',
                                       'id'=>'input-name', 'class'=> 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="col-md-12">

                        <div class="form-group row required">
                            <label class="col-sm-2 control-label" for="input-code"><span data-toggle="tooltip"
                                                                                         title=""
                                                                                         data-original-title="The code the customer enters to get the discount.">Code</span></label>
                            <div class="col-sm-10">
                                {!! Form::text('code',$coupons->code??null,['placeholder' => 'Code',
                                   'id'=>'input-code', 'class'=> 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip"
                                                                                          title=""
                                    data-original-title="The total amount that must be reached before the coupon is valid.">Discount Amount</span></label>
                            <div class="col-sm-10">
                                <div class="col-sm-6">
                                    {!! Form::text('discount',$coupons->discount??null,['placeholder' => 'Discount',
                                            'id'=>'input-discount', 'class'=> 'form-control']) !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Form::select('type',['p' => 'Percentage','f' => 'Fixed Amount'],[$coupons->type??null],[ 'id'=>'input-type', 'class'=> 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip"
                                                                                          title=""
                                                                                          data-original-title="The total amount that must be reached before the coupon is valid.">Total Amount</span></label>
                            <div class="col-sm-10">
                                {!! Form::text('total_amount',$coupons->total_amount??null,['placeholder' => 'Total Amount',
                                   'id'=>'input-total', 'class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Coupon Based</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">{!! Form::radio('based','product',true,['class' => 'coupon_type']) !!}
                                    Product base
                                </label>
                                <label class="radio-inline">{!! Form::radio('based','cart',false,['class' => 'coupon_type']) !!}
                                    Cart base
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Free Shipping</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">{!! Form::radio('shipping_type',$coupons->shipping_type??null,true,['value' => 1]) !!}
                                    Yes
                                </label>
                                <label class="radio-inline">{!! Form::radio('shipping_type',$coupons->shipping_type??null,false,['value' => 0]) !!}
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group row product-box {{ (isset($coupons) && $coupons->based == 'cart') ? 'hide' :'' }}">
                            <label class="col-sm-2 control-label" for="input-product"><span
                                        data-toggle="tooltip" title=""
                                        data-original-title="Choose specific products the coupon will apply to. Select no products to apply coupon to entire cart.">Products</span></label>
                            <div class="col-sm-10">
                                {!! Form::select('products',$products,null,['class'=> 'form-control input-select2 product-select']) !!}
                            </div>
                        </div>
                        <div class="form-group row product-box {{ (isset($coupons) && $coupons->based == 'cart') ? 'hide' :'' }}">
                            <label class="col-sm-2 control-label" for="input-product"><span
                                        data-toggle="tooltip" title=""
                                        data-original-title="Choose specific products the coupon will apply to. Select no products to apply coupon to entire cart.">Variations</span></label>
                            <div class="col-md-10 variations-box">

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label" for="input-date-start">Date Start</label>
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
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label text-right" for="input-date-end">Date End</label>
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
                            <label class="col-sm-2 control-label" for="input-uses-total"><span
                                        data-toggle="tooltip" title=""
                                        data-original-title="The maximum number of times the coupon can be used by any customer. Leave blank for unlimited">Uses Per Coupon</span></label>
                            <div class="col-sm-10">
                                {!! Form::text('user_per_coupon',$coupons->user_per_coupon??null,['placeholder' => 'Uses Per Coupon',
                                   'id'=>'input-uses-total', 'class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="input-uses-customer"><span
                                        data-toggle="tooltip" title=""
                                        data-original-title="The maximum number of times the coupon can be used by a single customer. Leave blank for unlimited">Uses Per Customer</span></label>
                            <div class="col-sm-10">
                                {!! Form::text('user_per_customer',$coupons->user_per_customer??null,['placeholder' => 'Uses Per Customer',
                                  'id'=>'input-uses-customer', 'class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="input-status">Status</label>
                            <div class="col-sm-10">
                                {!! Form::select('status',['1' => 'Enabled','0' => 'Disabled'],[$coupons->status??null],[ 'id'=>'input-status', 'class'=> 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>

            </div>
        </div>
        {!! Form::close() !!}
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

//        let html = $('#variation_template').html();
//        let data_p=$(this).attr('data-p');
//        let lang=$('.languages-'+data_p).length+1;
//        html= html.replace(/{p}/g,data_p).replace(/{l}/g,lang);
//        $(this).closest('.languages').append(html) ;

        $("body").on('change', '.product-select', function () {
            AjaxCall("/admin/inventory/stock/get-variations-by-id", {id: $(this).val()}, function (res) {
                if (!res.error) {
                    if(res.data.length){
                        for(let i in res.data){
                            var item = res.data[i];
                            let html = $('#variation_template').html();
                            html= html.replace(/{name}/g,item.name).replace(/{id}/g,item.id);
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
        $("#input-category").tagsinput({
            maxTags: 5,
            confirmKeys: [13, 32, 44],
            typeaheadjs: {
                // name: "citynames",
                displayKey: "name",
                valueKey: "name",
                source: function (query, processSync, processAsync) {
                    return $.ajax({
                        url: "/admin/get-categories",
                        type: "POST",
                        data: {query: query},
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": $("input[name='_token']").val()
                        },
                        success: function (json) {
                            return processAsync(json);
                        }
                    });
                },
                templates: {
                    empty: ['<div class="empty-message">', "No results", "</div>"].join(
                        "\n"
                    ),
                    header: "<h4>Categoris</h4><hr>",
                    suggestion: function (data) {
                        return `<div class="user-search-result"><span> ${data.name} </span></div>`;
                    }
                }
            }
        });
        $("#input-category").on("beforeItemAdd", function (event) {
            event.cancel = true;
            let valueCatergorayName = $("#category-names").val()
            if (!valueCatergorayName.includes(event.item)) {
                $(".coupon-category-list").append(makeSearchHtml(event.item))
                if ($("#category-names").val().trim()) {
                    let arr = JSON.parse($("#category-names").val())
                    arr.push(event.item)
                    $("#category-names").val(JSON.stringify(arr))

                    console.log(1)
                    return
                }
                console.log(2)
                let elm = [event.item]
                $("#category-names").val(JSON.stringify(elm))
                return

            }
        });

        function makeSearchHtml(data) {

            return `<li>${data}<span class="remove-search-tag"><i class="fa fa-trash"></i></span></li>`

        }

        $("body").on("click", ".remove-search-tag", function () {
            let text = $(this).closest("li").text()
            let arr = JSON.parse($("#category-names").val())
            let index = arr.indexOf(text)
            arr.splice(index, 1)
            $("#category-names").val(JSON.stringify(arr))
            $(this).closest("li").remove()

        })

    </script>
@stop
