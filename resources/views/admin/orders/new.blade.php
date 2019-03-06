@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h2 class="m-0 pull-left">Orders</h2>
            <div class="pull-right">

            </div>
        </div>
        <div class="panel-body">
            <div class="row order-main-cnt">
                <div class="col-md-8">
                    <div class="order-main-cnt_left-col">
                        <div class="tab-content-store-settings">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="details user-add-details">
                                        @include("admin.orders._partials.add_user")
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-default customer-notes">
                                        <div class="panel-heading">Customer Notes</div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                        <textarea name="" id="customer_notes" cols="30" rows="10" class="form-control"
                                                  placeholder="Notes"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row cart-table">

                            </div>
                            <div class="text-right add-product">
                                <button class="btn btn-primary" data-toggle="modal" data-target=".add-product-modal"><i
                                            class="fa fa-plus"></i><span
                                            class="ml-5">Add Product</span></button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 scroll_content">
                    <div class="cart-right">
                        <div class="order-summary-outer">
                            <div class="order-summary">
                                @include("admin.orders._partials.order_summary")
                            </div>
                            <div class="coupons">
                                <!-- applied copuns -->
                                <form id="apply_coupon" class="form-validate">
                                    <div class="form-group">
                                        <label>Coupon Code</label>
                                        <input type="text" name="coupon_code" class="form-control" id="coupon_code">
                                        <div id="coupon_require_error" class="help-block errors hide">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="shipping-payment">
                                @include("admin.orders._partials.shipping_payment")
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade customer-details-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-4">Select channel</label>
                                    <div class="col-md-8">
                                        <select name="" id="" class="form-control">
                                            <option value="">All</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-4">Find User</label>
                                    <div class="col-md-8">
                                        {!! Form::select('user_id',$users,null,['class' => 'form-control tag-input-v select-user','placeholder' => 'Search']) !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="details user-details">
                        @include("admin.orders._partials.select_user")
                    </div>
                    <div class="text-right">
                        <button class="btn btn-info add-user">Save</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade  add-product-modal" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Big</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-3">
                        <div class="basic-left basic-wall h-100">
                            <div class="all-list-extra">
                                <div class="col-md-12" style="margin-bottom: 15px;">
                                    {!! Form::select('product',$products,null,['class' => 'form-control tag-input-v select-product','placeholder' => 'Select product']) !!}
                                </div>
                                <div class="col-md-12">
                                    <ul class="get-all-extra-tab">
                                        {{--@foreach($products as $product)--}}
                                        {{--<li style="display: flex" data-id="{{ $product->id }}"--}}
                                        {{--class="promotion-elm {{ ($loop->first)?'active':'' }}"><a--}}
                                        {{--href="#">{{ $product->name }}</a>--}}
                                        {{--<div class="buttons">--}}
                                        {{--</div>--}}
                                        {{--</li>--}}
                                        {{--@endforeach--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 extra-variations">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade stripe-modal" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pay with stripe</h4>
                </div>
                <div class="modal-body">
                    <div id="stripe-method" class="d-none payment-method-data">
                        <script src="https://js.stripe.com/v3/"></script>
                        <form action="/admin/orders/stripe-charge" method="post" id="payment-form">
                            {!! csrf_field()!!}
                            <div class="form-row">
                                <label for="card-element">

                                </label>
                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>

                            <button class="btn btn-info ">Submit Payment</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link href={{asset("public/css/main.css?v=".rand(111,999))}} rel="stylesheet"/>
    <style>
        .scroll_content {
            padding-top: 30px;
            height: calc(100vh - 236px);
            overflow-y: auto;
            overflow-x: hidden;
        }
        .panels-address .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .panels-address .panel-heading .edit {
            cursor: pointer;
        }

        .customer-notes .wall {
            margin-bottom: 15px;
            padding: 4px 12px;
        }

        .customer-notes .wall.danger {
            background-color: #ffdddd;
            border-left: 6px solid #f44336;
        }

        .customer-notes .wall.success {
            background-color: #ddffdd;
            border-left: 6px solid #4CAF50;
        }

        .customer-notes .wall.info {
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

        .tab-content-store-settings .details .tabs-address {

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

        .errors {
            color: red;
            font-style: italic;
        }

        .Qty .input-group {
            align-items: center;
            justify-content: center;
            flex-direction: column;
            display: flex;
        }

        .get-all-extra-tab .promotion-elm {
            position: relative;
            box-shadow: 0 0 4px #ccc;
            margin-bottom: 10px;
            height: 150px;
            overflow: hidden;
            clear: both;
            align-items: center;
            cursor: pointer;
            -webkit-transition: 0.5s ease;
            -moz-transition: 0.5s ease;
            -ms-transition: 0.5s ease;
            -o-transition: 0.5s ease;
            transition: 0.5s ease;
        }

        .get-all-extra-tab .promotion-elm.active, .get-all-extra-tab .promotion-elm:hover {
            background-color: #3eb3d7;
        }

        .get-all-extra-tab .promotion-elm.active > a, .get-all-extra-tab .promotion-elm:hover > a {
            color: #ffffff;
        }

        .get-all-extra-tab .promotion-elm > a {
            padding-left: 5px;
            font-size: 16px;
            color: #000000;
        }

        .get-all-extra-tab .promotion-elm img {
            width: 100%;
            height: auto;
        }

        .get-all-extra-tab .promotion-elm .delete-product-item {
            position: absolute;
            right: 0;
            top: 0;
        }

        .get-all-extra-tab .promotion-elm > div {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .get-all-extra-tab .buttons {
            margin-left: auto;
        }

        .customer-details-modal .details {
            margin-bottom: 20px;
        }

        .customer-details-modal .details .address-head {
            padding: 10px;
            text-align: center;
            background-color: #3c8dbc;
            color: white;
            font-size: 16px;
        }

        .customer-details-modal .details .user-img-name {
            border: 1px solid #28618373;
            box-shadow: 0 0 4px #28618385;
        }

        .customer-details-modal .details .user-img-name img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .customer-details-modal .details .user-img-name .name {
            padding: 15px 20px;
            border-top: 1px solid #28618385;
            text-align: center;
            font-weight: bold;
            background-color: #61747fe3;
            color: white;
        }

        .add-product-modal .modal-dialog {
            position: fixed;
            margin: 0;
            width: 100%;
            height: 100%;
            padding: 0;
        }

        .add-product-modal .modal-content {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            border-radius: 0;
            box-shadow: none;
        }

        .add-product-modal .modal-header {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 50px;
            padding: 10px;
            background: #3c8dbc;
            border: 0;
        }

        .add-product-modal .modal-title {
            font-weight: 300;
            font-size: 2em;
            color: #fff;
            line-height: 30px;
        }

        .add-product-modal .modal-body {
            position: absolute;
            top: 50px;
            bottom: 60px;
            width: 100%;
            font-weight: 300;
            overflow: auto;
        }

        .add-product-modal .modal-footer {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            height: 60px;
            padding: 10px;
            background: #f1f3f5;
        }

        .order-main-cnt .order-table tbody td:not(.stock-price) {
            vertical-align: middle;
        }

        .order-main-cnt .order-table .stock-price .stock-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .order-main-cnt .order-table .stock-price .stock-name {
            /* display: block; */
            border: 1px solid #eee;
            padding: 5px;
            box-shadow: 0 0 4px #ccc;
            background-color: #f9f9f9;
            width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .order-main-cnt .order-table .stock-price .stock-count {
            background-color: #777;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            color: white;
        }

        .order-main-cnt .order-table .stock-price .right.extra-del {
            display: flex;
        }

        .order-main-cnt .order-table .stock-price .right.extra-del .stock-count {
            margin-right: 5px;
        }

        .order-main-cnt .order-table .stock-price .extra-stock {
            margin-top: 45px;
        }

        .order-main-cnt .order-table .head-stock-price {
            display: flex;
            justify-content: space-between;
        }

        .order-main-cnt .order-table .w-8 {
            width: 8%;
        }

        .add-product .ml-5 {
            margin-left: 5px;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .order-main-cnt table .w-5 {
            width: 5%;
        }

        .order-main-cnt table .w-20 {
            width: 20%;
            max-width: 220px;
        }

        .order-main-cnt table .product-name {
            border: 1px solid #ccc;
            box-shadow: 0 0 4px #ccc;
        }

        .order-main-cnt table .product-name img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .order-main-cnt table .product-name .name {
            padding: 15px 20px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-weight: bold;
            background-color: #f3f3f37d;
        }

        .content-wrapper {
            min-height: 100% !important;
            height: calc(100vh - 101px);
            overflow: hidden;
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
    <style>
        .StripeElement {
            width: 389px;
            background-color: white;
            height: 40px;
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    {{--//STRIPE--}}
    <script>
        var stripe = Stripe("{!! stripe_key() !!}");
        var elements = stripe.elements();
        // Custom Styling
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '24px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element
        var card = elements.create('card', {style: style});
        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });
        // Send Stripe Token to Server
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
// Add Stripe Token to hidden input
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
// Submit form
            form.submit();
        }
    </script>

    <script>
        $(function () {

            var timeout = null;

            $("body").on('keyup','#coupon_code',function () {
                let value = $(this).val();
                $("#coupon_require_error").addClass('hide');
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    console.log(value);
                    AjaxCall("/admin/orders/apply-coupon", {code: value, user_id: $("#order_user").val()}, function (res) {
                        if (res.error) {
                            $("#coupon_require_error").text(res.message);
                            $("#coupon_require_error").removeClass('hide');
                        }
                        $(".shipping-payment").html(res.shippingHtml);
                        $(".order-summary").html(res.summaryHtml);
                    });
                }, 500);
            });

            $("body").on('keyup','#customer_notes',function () {
                let value = $(this).val();
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    AjaxCall("/admin/orders/order-new-customer-notes", {note: value, user_id: $("#order_user").val()}, function (res) {
                        if (res.error) {

                        }
                    });
                }, 500);
            });
//
//
//            $("body").on('keypast','#coupon_code',function () {
//                console.log($(this).val());
//            });

            $("body").on('click','.pay-button',function () {
                let user = $("#order_user").val();
                let product = $("#order_product_subtotal").val();
                let method =  $("input[name='payment_method']:checked"). val();
                console.log(user,product)

                if(user == '' || user == undefined){
                    alert('Please select User...')
                    return false;
                }

                if(product == 0 || product == undefined){
                    alert('Please select products...')
                    return false;
                }

                if(method =='cash'){
                    AjaxCall(
                        "/admin/orders/cash-payment",
                        {},
                        res => {
                            if (!res.error) {
                                window.location = res.url;
                            }
                        },
                        error => {
                            alert('error');
                        }
                    );
                }else if(method == 'stripe'){
                    $(".stripe-modal").modal();
                }
            })

            $(".tag-input-v").select2({width: '100%'});

            $("body").on('change', '.select-product', function () {
                let id = $(this).val();
                AjaxCall("/admin/inventory/stock/get-by-id", {id: id}, function (res) {
                    if (!res.error) {
                        var isExists = $(".promotion-elm[data-id='" + res.data.id + "']");
                        if (isExists.length == 0) {
                            let html = `<li  data-id="${res.data.id}"
                                        class="promotion-elm">
                                        <div class="row">
                                            <img src="${res.data.image}" class="img" height="100">
                                        </div>
                                        <a href="#">${res.data.name}</a>
                                        <a class="btn btn-danger delete-product-item" href="javascript::void(0)"><i class="fa fa-trash"></i></a>
                                    </li>`
                            $('.get-all-extra-tab').append(html);
                        }

                    }
                });
            });

            $("#country").select2();
            $("#geo_country").select2();

            function getRegionsPackage() {
                let value = $("#country").val();
                AjaxCall(
                    "/get-regions-by-country",
                    {country: value},
                    res => {
                    let select = document.getElementById('regions');
                select.innerText = null;
                if (!res.error) {
                    $.each(res.data, function (index, value) {
                        var opt = document.createElement('option');
                        opt.value = res.data[value];
                        opt.innerHTML = res.data[value];
                        select.appendChild(opt);
                    })

                }
            })
                ;
            }

            $("body").on("change", "#country", function () {
                getRegionsPackage();
            });

            $("body").on("change", "#geo_country", function () {
                getRegions();
            });

            function getRegions() {
                let value = $("#geo_country").val();
                AjaxCall(
                    "/get-regions-by-geozone",
                    {country: value},
                    res => {
                    let select = document.getElementById('geo_region');
                select.innerText = null;
                if (!res.error) {
                    var opt = document.createElement('option');
                    $.each(res.data, function (k, v) {
                        var option = $(opt).clone();
                        option.val(k);
                        option.text(v);
                        $(select).append(option);
                    });

                }
            })
                ;
            }

//            setTimeout(function () {
//                $('.get-all-extra-tab').find('.promotion-elm').first().trigger('click')
//            }, 5);

//            setTimeout(function () {
//                get_price();
//
//                var plist = $(".poptions-group");
//                for (var i = 0; i < plist.length; i++) {
//                    get_promotion_price($(plist[i]).data('promotion'))
//                }
//            }, 20);

            $("body").on('click', '.promotion-elm', function (e) {
                var id = $(this).data('id');
                $('.get-all-extra-tab').find('.promotion-elm').removeClass('active');
                $(this).addClass('active');
                AjaxCall("/admin/orders/get-product", {id: id}, function (res) {
                    if (!res.error) {
                        $(".extra-variations").html(res.html);
                        get_price();
                        var plist = $(".poptions-group");
                        for (var i = 0; i < plist.length; i++) {
                            get_promotion_price($(plist[i]).data('promotion'))
                        }
                    }
                });
            })


            $("body").on('click', '.delete-product-item', function (e) {
                e.stopPropagation();

                $('.kaliony-page[data-id="' + $(this).parent().data('id') + '"]').remove()
                $(this).parent().remove()
            })


            $("body").on('change', '.select-user', function () {
                var id = $(this).val();
                AjaxCall("/admin/orders/get-user", {id: id}, function (res) {
                    if (!res.error) {
                        $(".user-details").html(res.html);
                    }
                });
            });

            $("body").on('click', '.add-user', function () {
                var id = $('.select-user').val();
                AjaxCall("/admin/orders/add-user", {id: id}, function (res) {
                    if (!res.error) {
                        $(".user-add-details").html(res.html);
                        $(".shipping-payment").html(res.shippingHtml);
                        $(".order-summary").html(res.summaryHtml);
                        $(".customer-details-modal").modal('hide')
                    }
                });
            });

            $("body").on('change', '.select-variation-option', function () {
                get_price();
            });

            $("body").on('change', '.select-variation-radio-option', function () {
                get_price();
            });

            $("body").on('click', '.add-to-cart', function () {
                var variationId = $("#variation_uid").val();
                var userID = $("#order_user").val();

                if (variationId && variationId != '') {
                    var requiredItems = [];
                    var optionalItems = [];

                    var requiredItemsData = $(".required_item");
                    var optionalItemsData = $(".optional_item");


                    optionalItemsData.each(function (i, e) {
                        if ($(e).parent().find('.optional_checkbox').is(':checked')) {
                            optionalItems.push($(e).val());
                        }
                    });

                    requiredItemsData.each(function (i, e) {
                        requiredItems.push($(e).val());
                    });
//                    console.log(requiredItems)
//                    return false;
                    $.ajax({
                        type: "post",
                        url: "/admin/orders/add-to-cart",
                        cache: false,
                        datatype: "json",
                        data: {uid: variationId, requiredItems: requiredItems, optionalItems: optionalItems,user_id : userID},
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            if (!data.error) {
                                $(".cart-count").html(data.count)
                                $('#cartSidebar').html(data.headerHtml)
                                $(".cart-table").html(data.html);
                                $(".shipping-payment").html(data.shippingHtml);
                                $(".order-summary").html(data.summaryHtml);
                            } else {

                            }
                        }
                    });
                } else {
                    alert('Select available variation');
                }
            })


            $("body").on('click', '.qtycount', function () {
                var uid = $(this).data('uid');
                var condition = $(this).data('condition');
                var userID = $("#order_user").val();

                if (uid && uid != '') {
                    $.ajax({
                        type: "post",
                        url: "/admin/orders/update-cart",
                        cache: false,
                        datatype: "json",
                        data: {uid: uid, condition: condition,user_id : userID},
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            if (!data.error) {
                                $(".cart-table").html(data.html);
                                $(".shipping-payment").html(data.shippingHtml);
                                $(".order-summary").html(data.summaryHtml);
                            } else {
                                alert('error')
                            }
                        }
                    });
                } else {
                    alert('Select available variation');
                }
            });

            $("body").on('change', '.qty-input', function () {
                var uid = $(this).data('uid');
                var condition = 'inner';
                var value = $(this).val();
                var userID = $("#order_user").val();

                if (uid && uid != '') {
                    $.ajax({
                        type: "post",
                        url: "/admin/orders/update-cart",
                        cache: false,
                        datatype: "json",
                        data: {uid: uid, condition: condition, value: value, user_id: userID},
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            if (!data.error) {
                                $(".cart-table").html(data.html);
                                $(".shipping-payment").html(data.shippingHtml);
                                $(".order-summary").html(data.summaryHtml);
                            } else {
                                alert('error')
                            }
                        }
                    });
                } else {
                    alert('Select available variation');
                }
            });


            $("body").on('click', '.remove-from-cart', function () {
                var uid = $(this).data('uid');
                var userID = $("#order_user").val();

                if (uid && uid != '') {
                    $.ajax({
                        type: "post",
                        url: "/admin/orders/remove-from-cart",
                        cache: false,
                        datatype: "json",
                        data: {uid: uid, user_id:userID},
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            if (!data.error) {
                                $(".cart-table").html(data.html);
                                $(".shipping-payment").html(data.shippingHtml);
                                $(".order-summary").html(data.summaryHtml);
                            } else {
                                alert('error')
                            }
                        }
                    });
                } else {
                    alert('Select available variation');
                }
            })

            function get_price() {
                var items = $(".extra-variations").find('.select-variation-option');
                console.log(items)

                $("body .btn-add-to-cart").removeClass('add-to-cart');
                let options = {};

                for (var i = 0; i < items.length; i++) {
                    options[$(items[i]).data('name')] = $(items[i]).val();
                }

                $.map($("body .options-group input:radio:checked"), function (elem, idx) {
                    options[$(elem).data('name')] = $(elem).val();
                });
                console.log(items, options, $("body #vpid").val())
                $.ajax({
                    type: "post",
                    url: "/products/get-price",
                    cache: false,
                    datatype: "json",
                    data: {options: options, uid: $("body #vpid").val()},
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        if (!data.error) {
                            var price = "€" + data.price;
                            if (data.message) {
                                price = data.message + " €" + data.price;
                            }
                            $("body .price-place").html(price);
                            $("body #variation_uid").val(data.variation_id);
                            $("body .btn-add-to-cart").addClass('add-to-cart');
                        } else {
                            $("body .price-place").html(data.message);
                            $("body #variation_uid").val('');
                        }
                    }
                });
            }

            var plist = $(".poptions-group");
            for (var i = 0; i < plist.length; i++) {
                get_promotion_price($(plist[i]).data('promotion'))
            }

            $("body").on('change', '.select-variation-poption', function () {
                var pid = $(this).closest('.poptions-group').data('promotion');
                get_promotion_price(pid);
            });

            $("body").on('change', '.select-variation-radio-poption', function () {
                var pid = $(this).closest('.poptions-group').data('promotion');
                get_promotion_price(pid);
            });

            function get_promotion_price(pid) {
                let options = {};

                $.map($("[data-promotion='" + pid + "'] input:radio:checked"), function (elem, idx) {
                    options[$(elem).data('name')] = $(elem).val();
                });

                $.map($("[data-promotion='" + pid + "'] .select-variation-poption"), function (elem, idx) {
                    options[$(elem).data('name')] = $(elem).val();
                });

                console.log(options);
//            price-place-promotion
                $.ajax({
                    type: "post",
                    url: "/products/get-price",
                    cache: false,
                    datatype: "json",
                    data: {options: options, uid: pid, promotion: true},
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        if (!data.error) {
                            var price = "€" + data.price;
                            if (data.message) {
                                price = data.message + " €" + data.price;
                            }

                            $("[data-promotion='" + pid + "'] .price-place-promotion").html(price);
                            $("[data-promotion='" + pid + "'] .variation_items").val(data.variation_id);
//                        $("#variation_uid").val(data.variation_id);
//                        $(".btn-add-to-cart").addClass('add-to-cart');
                        } else {
                            $("[data-promotion='" + pid + "'] .price-place-promotion").html(data.message);
//                        $("#variation_uid").val('');
                        }
                    }
                });
            }


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
                            $('.hidden-add-field_heading .fa-close').trigger('click');
                            $(".order-timeline").html(data.html);
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