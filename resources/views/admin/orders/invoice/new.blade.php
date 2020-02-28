@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <h2 class="m-0 pull-left">Orders</h2>
            <div class="pull-right">

            </div>
        </div>
        <div class="card-body panel-body">
            <div class="row order-main-cnt">
                <div class="col-sm-8">
                    <div class="order-main-cnt_left-col">
                        <div class="tab-content-store-settings">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="details user-add-details">
                                        @include("admin.orders._partials.add_user")
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card panel panel-default customer-notes">
                                        <div class="card-header panel-heading">Customer Notes</div>
                                        <div class="card-body panel-body">
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
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".add-product-modal"><i
                                        class="fa fa-plus"></i><span
                                        class="ml-1">Add Product</span></button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4 scroll_content">
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
                    <h4 class="modal-title">Select user</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-4 col-form-label">Find User</label>
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
        <div class="modal-dialog modal-lg mw-100" role="document">
            <div class="modal-content">
                <div class="modal-header rounded-0">
                    <h4 class="modal-title">Modal Big</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
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

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                        <form action="/admin/orders/invoices/stripe-charge" method="post" id="payment-form">
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
<div class="modal fade" id="popUpModal" tabindex="-1" role="dialog" aria-labelledby="popUpModalLabel"
     aria-hidden="true" style="z-index: 9999999;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="wizardViewModal" tabindex="-1" role="dialog" aria-labelledby="wizardViewLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg wizardViewModal--new" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wizardViewLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer bord-top d-flex justify-content-between popup-modal-footer py-0">

                <div class="align-items-start selected-items_popup ">
                    <ul class="d-flex flex-wrap footer-list w-100 main-scrollbar">
                        <li class="footer-list-item">
                            <span class="title">Item name 1</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                        <li class="footer-list-item">
                            <span class="title">Item name 2</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                        <li class="footer-list-item">
                            <span class="title">Item name 3</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                        <li class="footer-list-item">
                            <span class="title">Item name 1</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                        <li class="footer-list-item">
                            <span class="title">Item name 2</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                        <li class="footer-list-item">
                            <span class="title">Item name 3</span>
                            <span class="close-icon"><i class="fa fa-times"></i></span>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center footer--right">
                    <span class="font-weight-bold text-danger message_place_js font-16" >Lorem ipsum dolor sit amet.</span>
                    <button type="button" class="btn btn-primary b_save ml-2" data-section-id="">
                        Add selected
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
<input type="hidden" id="symbol" value="{{ get_symbol() }}">

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link href="/public/plugins/formstone/carousel/carousel.css" rel="stylesheet">
    <link href="/public/plugins/formstone/lightbox/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">


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
    <style>
        .font-35 {
            font-size: 35px;
        }
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
    <script src="/public/plugins/formstone/carousel/carousel.js"></script>
    <script src="/public/plugins/formstone/lightbox/lightbox.js"></script>

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
        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            stripe.createToken(card).then(function (result) {
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

            $("body").on('keyup', '#coupon_code', function () {
                let value = $(this).val();
                $("#coupon_require_error").addClass('hide');
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    console.log(value);
                    AjaxCall("/admin/orders/invoices/apply-coupon", {
                        code: value,
                        user_id: $("#order_user").val()
                    }, function (res) {
                        if (res.error) {
                            $("#coupon_require_error").text(res.message);
                            $("#coupon_require_error").removeClass('hide');
                        }
                        $(".shipping-payment").html(res.shippingHtml);
                        $(".order-summary").html(res.summaryHtml);
                    });
                }, 500);
            });

            $("body").on('keyup', '#customer_notes', function () {
                let value = $(this).val();
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    AjaxCall("/admin/orders/invoices/order-new-customer-notes", {
                        note: value,
                        user_id: $("#order_user").val()
                    }, function (res) {
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

            $("body").on('click', '.pay-button', function () {
                let user = $("body").find("#order_user").val();
                let product = $("body").find("#order_product_subtotal").val();
                let method = $("body").find("input[name='payment_method']:checked").val();
                console.log(user, product)

                if (user == '' || user == undefined) {
                    alert('Please select User...')
                    return false;
                }

                if (product == 0 || product == undefined) {
                    alert('Please select products...')
                    return false;
                }

                if (method == 'cash') {
                    AjaxCall(
                        "/admin/orders/invoices/cash-payment",
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
                } else if (method == 'stripe') {
                    $(".stripe-modal").modal();
                }
            })

            $(".tag-input-v").select2({width: '100%'});

            $("body").on('change', '.select-product', function () {
                let id = $(this).val();
                AjaxCall("{{ route('admin_orders_invoice_items_by_id') }}", {id: id}, function (res) {
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
                            $(".tecnical_gallery_obj-holder").lightbox();

                            $(".lightbox-product").lightbox();
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
                AjaxCall("/admin/orders/invoices/get-item", {id: id}, function (res) {
                    if (!res.error) {
                        $(".extra-variations").html(res.html);
                        // get_price();
                        // var plist = $(".poptions-group");
                        // for (var i = 0; i < plist.length; i++) {
                        //     get_promotion_price($(plist[i]).data('promotion'))
                        // }

                        $('.select-2').each(function() {
                            console.log($(this));
                            $(this).select2({minimumResultsForSearch: -1})
                        });

                        function checkLimit(value, max) {
                            return value <= max;
                        }

                        const getCurrencySymbol = () => {
                            return $('.header-bottom #symbol').val();
                        };
                        // $('.share-button').on('click', function(ev) {
                        //     ev.stopImmediatePropagation();
                        //     $('#share_modal').addClass('show');
                        // });
                        // $(document).click(function (e) {
                        //     console.log(e.target);
                        //     const containerBlock = $("#share_modal");
                        //     let arrowLink = $('.share-button.facebook-share-button');
                        //     console.log(arrowLink.has(e.target).length === 0,containerBlock.has(e.target).length === 0,containerBlock !== e.target);
                        //     if ($(e.target).closest('#share_modal').length === 0 || $(e.target).hasClass('share_modal_close')) {
                        //         if (containerBlock.hasClass('show')) {
                        //             containerBlock.removeClass('show');
                        //         }
                        //     }
                        // });
                        //count total price function
                        const countTotalPrice = () => {
                            let total_price = 0;
                            $('.add-product-modal .product__single-item-info-price[data-single-price]').each(function() {
                                // console.log('aaaa', $(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length === 1);
                                if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length === 1) {
                                    $(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').is( ":checked" ) ? total_price += $(this).data('single-price')*1 : total_price = total_price;
                                } else {
                                    total_price += $(this).data('single-price')*1;
                                }
                            });
                            return total_price * $('.continue-shp-wrapp .continue-shp-wrapp_qty input[type="number"].field-input.product-qty-select').val()*1;
                        };

                        const setOfferPrice = (offer, offerPrice) => {
                            // console.log(totalPrice, 222222222222222222);
                            offer.html(`${getCurrencySymbol()}${offerPrice}`);
                        };

                        const countOfferTotalPrice = () => {
                            let offer_total_price = 0;
                            $('.added-offers').find('.special__popup-content-right-product-price').each(function(key) {
                                console.log(key);
                                offer_total_price += $(this).data('price');
                            });
                            $('.offer-total-price').html(`${getCurrencySymbol()}${offer_total_price}`);
                        };

                        const countOfferPrice = (gget = false) => {

                            $('#specialPopUpModal .special__popup-main-product-item').each(function() {
                                var value = 0;
                                var id = $(this).data('id');
                                $(this).find('.pr-wrap').each(function() {
                                    if($(this).data('per-price') === 'product') {
                                        value += $(this).data('price');
                                    } else if($(this).data('per-price') === 'item') {
                                        $(this).find('.product__single-item-info-bottom').each(function() {
                                            if($(this).closest('.product__single-item-info-bottom').find('.select-variation-option').length > 0 || ($(this).hasClass('get-single-price') && $(this).closest('.filter').length > 0)) {
                                                value += $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price');
                                            } else if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="radio"]').length > 0) {
                                                value += $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price');
                                            }  else if($(this).closest('.pr-wrap').find('.popup-select').length > 0) {
                                                value += $(this).find('.get-single-price').data('single-price');
                                            }else if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length > 0) {
                                                if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input').prop('checked')) {
                                                    value += $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price');
                                                }
                                            }

                                        });
                                    }
                                });

                                $(this).find('.product__single-item_price').data('price-for-add', value);
                                setOfferPrice($(this).find('.product__single-item_price'), value);
                                // var addedPricePlace = $(`#specialPopUpModal .added-offers .special__popup-content-right-product[data-id="${id}"] .special__popup-content-right-product-price`);
                                // if(!$(this).hasClass('user-non-select')) {
                                //     addedPricePlace.data('price', value);
                                //     addedPricePlace.html(`${getCurrencySymbol()}${value}`);
                                // }
                                countOfferTotalPrice();
                            });
                        };
                        const setTotalPrice = (totalPrice) => {
                            // console.log(totalPrice, 222222222222222222);
                            totalPrice !== undefined && $('.continue-shp-wrapp .price-place-summary').html(`${getCurrencySymbol()}${totalPrice}`);
                        };



                        countOfferPrice();


                        setTotalPrice(countTotalPrice());

                        $('body').on('click', " .continue-shp-wrapp_qty-minus.qty-count, .continue-shp-wrapp_qty-plus.qty-count", function() {
                            const totalQtyInput = $(this).closest('.continue-shp-wrapp_qty').find('input.product-qty-select');
                            console.log(111111, '--------')
                            if($(this).hasClass('continue-shp-wrapp_qty-plus')) {
                                totalQtyInput.val(totalQtyInput.val()*1 + 1);
                            } else if($(this).hasClass('continue-shp-wrapp_qty-minus') && totalQtyInput.val()*1>1) {
                                totalQtyInput.val(totalQtyInput.val() * 1 - 1);
                            }
                            setTotalPrice(countTotalPrice());
                        });

                        //qty up and down,  and input-qty
                        $('body').on('click', '.product__single-item-info-bottom .inp-up, .product__single-item-info-bottom .inp-down',function(ev) {
                            let flag;
                            const input_qty = $(this).closest('.quantity').find('.input-qty');
                            const qty = input_qty.val();
                            let prevV;
                            let nextV;
                            console.log(222222, '--------')
                            if($(this).hasClass('inp-up')) {
                                input_qty.val(qty*1 + 1);
                                flag = true;
                            } else if($(this).hasClass('inp-down')) {
                                prevV = $(this).closest('.quantity').find('input.product-qty').val()*1;
                                qty>1 && input_qty.val(qty*1 - 1);
                                nextV = $(this).closest('.quantity').find('input.product-qty').val()*1;
                                flag = false;
                            }



                            let variation_id = 0;

                            if($(this).closest('.filters-select-wizard').length > 0 || $(this).closest('.filter').find('.filters-modal-wizard').length > 0) {
                                variation_id = $(this).closest('.product__single-item-info-bottom').data('id');
                            } else if($(this).closest('.product__single-item-info-bottom').find('.select-variation-option').length > 0) {
                                variation_id = $(this).closest('.product__single-item-info-bottom').find('.select-variation-option').val();
                            } else if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="radio"]').length > 0) {
                                variation_id = $(this).closest('.product__single-item-info-bottom').find('.custom-control-input:checked').val();
                            }  else if($(this).closest('.product__single-item-info').find('.popup-select').length > 0 && $(this).closest('.add-product-modal').length > 0) {
                                variation_id = $(this).closest('.product__single-item-info-bottom').data('id');
                                if(prevV === 1 && nextV === 1 && !flag) {
                                    return true;
                                } else {
                                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price',
                                        $(this)
                                            .closest('.product__single-item-info-bottom')
                                            .find('.product__single-item-info-price')
                                            .data('single-price')*1
                                        /(flag ? ($(this)
                                            .closest('.quantity')
                                            .find('input.product-qty')
                                            .val()*1-1) : ($(this)
                                            .closest('.quantity')
                                            .find('input.product-qty')
                                            .val()*1+1))
                                        *($(this)
                                            .closest('.quantity')
                                            .find('input.product-qty')
                                            .val()*1));
                                    // $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span').html(`${getCurrencySymbol()}${$(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')}`);
                                    // setTotalPrice(countTotalPrice());
                                    // return true;
                                }
                            } else if($(this).closest('.pr-wrap').find('.popup-select').length > 0 && $(this).closest('#specialPopUpModal').length > 0) {
                                variation_id = $(this).closest('.product__single-item-info-bottom').data('id');
                                if(prevV === 1 && nextV === 1 && !flag) {
                                    return true;
                                } else {
                                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price',
                                        $(this)
                                            .closest('.product__single-item-info-bottom')
                                            .find('.product__single-item-info-price')
                                            .data('single-price')*1
                                        /(flag ? ($(this)
                                            .closest('.quantity')
                                            .find('input.product-qty')
                                            .val()*1-1) : ($(this)
                                            .closest('.quantity')
                                            .find('input.product-qty')
                                            .val()*1+1))
                                        *($(this)
                                            .closest('.quantity')
                                            .find('input.product-qty')
                                            .val()*1));
                                    // $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span').html(`${getCurrencySymbol()}${$(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')}`);
                                    // setTotalPrice(countTotalPrice());
                                    // return true;
                                }
                            } else if($(this).closest('.product__single-item-info-bottom').find('.custom-control-input[type="checkbox"]').length > 0) {
                                variation_id = $(this).closest('.product__single-item-info-bottom').find('.custom-control-input').val();
                                // console.log($(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')*1, ($(this).closest('.quantity').find('input.product-qty').val()*1-1), $(this).closest('.quantity').find('input.product-qty').val()*1);
                                // console.log('val',$(this).closest('.product__single-item-info-bottom').find('.input.product-qty').val()*1);
                                if(prevV === 1 && nextV === 1 && !flag) {
                                    return true;
                                } else {
                                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price',
                                        $(this)
                                            .closest('.product__single-item-info-bottom')
                                            .find('.product__single-item-info-price')
                                            .data('single-price')*1
                                        /(flag ? ($(this)
                                            .closest('.quantity')
                                            .find('input.product-qty')
                                            .val()*1-1) : ($(this)
                                            .closest('.quantity')
                                            .find('input.product-qty')
                                            .val()*1+1))
                                        *($(this)
                                            .closest('.quantity')
                                            .find('input.product-qty')
                                            .val()*1));
                                    // $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span').html(`${getCurrencySymbol()}${$(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price')}`);
                                    // setTotalPrice(countTotalPrice());
                                    // return true;
                                }

                            }
                            const price_place = $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span');
                            fetch("/products/get-discount-price", {
                                method: "post",
                                headers: {
                                    "Content-Type": "application/json",
                                    Accept: "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                                credentials: "same-origin",
                                body: JSON.stringify({
                                    variation_id,
                                    qty: input_qty.val()*1
                                })
                            })
                                .then((res) => {
                                    return res.json();
                                })
                                .then((data) => {
                                    // alert(data.price)
                                    console.log(333333, '--------')

                                    price_place.html(`${getCurrencySymbol()}${data.price}`);
                                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price', data.price);
                                    setTotalPrice(countTotalPrice());
                                    if($(this).closest('#specialPopUpModal')) {
                                        $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                                        countOfferPrice();
                                    }
                                })
                                .catch(error => console.error(error));
                        });

                        //select variation
                        $('body').on('change', '.add-product-modal select.select-variation-option.single-product-select', function(ev) {
                            ev.preventDefault();
                            const row = $(this).closest('.product__single-item-info-bottom');
                            const group_id = row.data('id');
                            const select_element_id = $(this).val();
                            const vpid = $('#vpid').val();
                            const $self = $(this);
                            const val = $(this).val();
                            const item = row.closest('.product__single-item-info');
                            if(val !== 'no') {
                                fetch("/products/get-variation-menu-raw", {
                                    method: "post",
                                    headers: {
                                        "Content-Type": "application/json",
                                        Accept: "application/json",
                                        "X-Requested-With": "XMLHttpRequest",
                                        "X-CSRF-Token": $('input[name="_token"]').val()
                                    },
                                    credentials: "same-origin",
                                    body: JSON.stringify({
                                        group_id: group_id,
                                        select_element_id: select_element_id,
                                        vpid:vpid
                                    })
                                })
                                    .then(function (response) {
                                        return response.json();
                                    })
                                    .then(function (data) {
                                        console.log(444444, '--------');

                                        row.html(data.html);
                                        row.find('.select-2').select2({minimumResultsForSearch: -1});
                                        if(item.data('per-price') === 'product') {
                                            item.find('.product__single-item-info-price').data('single-price', item.data('price')*1);
                                            let currency = $('#symbol').val();
                                            item.find('.product__single-item_price').text(currency + item.data('price')*1);
                                        }
                                        // row.find('.product-qty').select2();
                                        $self.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                                        setTotalPrice(countTotalPrice());
                                    })
                                    .catch(function (error) {
                                        console.log(error);
                                    });
                            } else {
                                if(item.data('per-price') === 'item') {
                                    // item.data('price', 0);
                                    item.find('.product__single-item-info-price').data('single-price', 0);
                                    let currency = $('#symbol').val();
                                    item.find('.product__single-item-info-price span').text(currency + item.find('.product__single-item-info-price').data('single-price')*1);
                                } else if(item.data('per-price') === 'product') {
                                    // item.data('price', 0);
                                    item.find('.product__single-item-info-price').data('single-price', 0);
                                    let currency = $('#symbol').val();
                                    item.find('.product__single-item_price').text(currency + item.find('.product__single-item-info-price').data('single-price')*1);
                                }
                                setTotalPrice(countTotalPrice());
                            }
                        });

                        $('body').on('change', '#specialPopUpModal select.select-variation-option.single-product-select', function(ev) {
                            ev.preventDefault();
                            const row = $(this).closest('.product__single-item-info-bottom');
                            const group_id = row.data('id');
                            const select_element_id = $(this).val();
                            const vpid = $('#vpid').val();

                            fetch("/products/get-offer-menu-raw", {
                                method: "post",
                                headers: {
                                    "Content-Type": "application/json",
                                    Accept: "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                                credentials: "same-origin",
                                body: JSON.stringify({
                                    group_id: group_id,
                                    select_element_id: select_element_id,
                                    vpid:vpid
                                })
                            })
                                .then(function (response) {
                                    return response.json();
                                })
                                .then(function (data) {
                                    console.log(555555, '--------')

                                    row.html(data.html);
                                    row.find('.select-2').select2({minimumResultsForSearch: -1});
                                    if($(this).closest('#specialPopUpModal')) {
                                        $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                                        countOfferPrice();
                                    }

                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        });

                        //add new single item
                        $('body').on('click', '.add-product-modal .product__single-item-add-new a.product__single-item-add-new-btn', function(ev) {
                            ev.preventDefault();
                            const row = $(this).closest('.product__single-item-info');
                            const id = row.data('group-id');
                            const $self = $(this);
                            console.log(666666, $self.closest('.product__single-item-info.limit').find('.product__single-item-info-bottom').length, $self.closest('.product__single-item-info.limit').data('limit'), $self.closest('.product__single-item-info.limit').data('min-limit'));
                            checkLimit($self.closest('.product__single-item-info.limit').find('.product__single-item-info-bottom').length + 1,   $self.closest('.product__single-item-info.limit').data('limit')) && fetch("/products/get-variation-menu-raw", {
                                method: "post",
                                headers: {
                                    "Content-Type": "application/json",
                                    Accept: "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                                credentials: "same-origin",
                                body: JSON.stringify({
                                    id
                                })
                            })
                                .then(function (response) {
                                    return response.json();
                                })
                                .then(function (data) {
                                    // row.html(data.html);
                                    console.log(666666, '--------');

                                    const single_item_info_bottom = row.find('.product__single-item-info-bottom');
                                    row.find('.product__single-item-add-new').before(data.html);

                                    // console.log(row.find('.select-2'));
                                    row.find('.product__single-item-info-bottom').last().find('.select-2').select2({minimumResultsForSearch: -1});
                                    $self.closest('.product__single-item-info').css('border-color', '#d7d7d7');

                                    setTotalPrice(countTotalPrice());
                                    // const new_rows_list = row.find('.product__single-item-info-bottom');
                                    // console.log($(new_rows_list[new_rows_list.length - 1]).find('select'));
                                    // $(new_rows_list[new_rows_list.length-1]).find('select').select2()
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        });

                        $('body').on('click', '#specialPopUpModal .product__single-item-add-new a.product__single-item-add-new-btn', function(ev) {
                            ev.preventDefault();
                            console.log(777777, '--------');
                            const $self = $(this);
                            const row = $self.closest('.pr-wrap');
                            const id = row.data('group-id');
                            $self.closest('.limit.pr-wrap').css('border', 'none');
                            checkLimit($self.closest('.limit.pr-wrap').find('.product__single-item-info-bottom').length + 1,   $self.closest('.limit.pr-wrap').data('limit')) && fetch("/products/get-offer-menu-raw", {
                                method: "post",
                                headers: {
                                    "Content-Type": "application/json",
                                    Accept: "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                                credentials: "same-origin",
                                body: JSON.stringify({
                                    id
                                })
                            })
                                .then(function (response) {
                                    return response.json();
                                })
                                .then(function (data) {
                                    // row.html(data.html);
                                    const single_item_info_bottom = row.find('.product__single-item-info-bottom');
                                    row.find('.product__single-item-add-new').before(data.html);

                                    // console.log(row.find('.select-2'));
                                    row.find('.product__single-item-info-bottom').last().find('.select-2').select2({minimumResultsForSearch: -1});
                                    if($(this).closest('#specialPopUpModal')) {
                                        $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                                        countOfferPrice();
                                    }
                                    setTotalPrice(countTotalPrice());
                                    // const new_rows_list = row.find('.product__single-item-info-bottom');
                                    // console.log($(new_rows_list[new_rows_list.length - 1]).find('select'));
                                    // $(new_rows_list[new_rows_list.length-1]).find('select').select2()
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        });

                        $('body').on('click', '.add-product-modal .remove-single_product-item', function() {
                            console.log(888888, '--------')

                            $(this).closest('.product__single-item-info-bottom').remove();
                            $(this).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                            setTotalPrice(countTotalPrice());
                        });

                        $('body').on('click', '#specialPopUpModal .remove-single_product-item', function() {
                            console.log(999999, '--------')

                            $(this).closest('.product__single-item-info-bottom').remove();
                            countOfferPrice();
                        });

                        //select-qty
                        $('body').on('change', 'select.select-qty', function(ev) {
                            const price_place = $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price span');
                            const variation_id = $(this).closest('.product__single-item-info-bottom').find('.select-variation-option').val();
                            const discount_id = $(this).val();

                            fetch("/products/get-discount-price", {
                                method: "post",
                                headers: {
                                    "Content-Type": "application/json",
                                    Accept: "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                                credentials: "same-origin",
                                body: JSON.stringify({
                                    variation_id,
                                    discount_id
                                })
                            })
                                .then((res) => {
                                    return res.json();
                                })
                                .then((data) => {
                                    console.log(101010, '--------')

                                    price_place.html(`${getCurrencySymbol()}${data.price}`);
                                    $(this).closest('.product__single-item-info-bottom').find('.product__single-item-info-price').data('single-price', data.price);
                                    setTotalPrice(countTotalPrice());
                                    if($(this).closest('#specialPopUpModal')) {
                                        $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price);
                                        countOfferPrice();
                                    }
                                })
                                .catch(error => console.error(error));
                        });

                        $('body').on('input', '.add-product-modal .product_radio-single .custom-radio .custom-control-input[type="checkbox"]', function(ev) {
                            ev.preventDefault();
                            console.log(121212, '--------');
                            if($(this).is(':checked') && checkLimit($(this).closest('.product__single-item-info').find('.custom-control-input:checked').length, $(this).closest('.product__single-item-info.limit').data('limit'))) {
                                $(this).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                                setTotalPrice(countTotalPrice());
                            } else {
                                $(this).prop('checked', false);
                            }
                            // const row = $(this).closest('.product__single-item-info-bottom');
                            // const group_id = $(this).data('id');
                            // const select_element_id = $(this).val();
                            // const vpid = $('#vpid').val();

                        });

                        $('body').on('change', '#specialPopUpModal .product_radio-single .custom-radio .custom-control-input[type="checkbox"]', function(ev) {
                            ev.preventDefault();
                            console.log(131313, '--------');
                            $(this).closest('.limit.pr-wrap').css('border', 'none');
                            if($(this).is(':checked') && checkLimit($(this).closest('.limit.pr-wrap').find('.custom-control-input:checked').length, $(this).closest('.pr-wrap.limit').data('limit'))) {
                                if($(this).closest('#specialPopUpModal')) {
                                    countOfferPrice();
                                }
                            } else {
                                $(this).prop('checked', false);
                            }
                            // const row = $(this).closest('.product__single-item-info-bottom');
                            // const group_id = $(this).data('id');
                            // const select_element_id = $(this).val();
                            // const vpid = $('#vpid').val();
                            // if($(this).closest('#specialPopUpModal')) {
                            //     countOfferPrice();
                            // }
                        });

                        $('body').on('change', '.add-product-modal .product_radio-single .custom-radio .custom-control-input[type="radio"]', function(ev) {
                            ev.preventDefault();
                            const row = $(this).closest('.product__single-item-info-bottom');
                            const group_id = $(this).data('id');
                            const select_element_id = $(this).val();
                            const vpid = $('#vpid').val();
                            const $self = $(this);

                            fetch("/products/get-variation-menu-raw", {
                                method: "post",
                                headers: {
                                    "Content-Type": "application/json",
                                    Accept: "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                                credentials: "same-origin",
                                body: JSON.stringify({
                                    group_id: group_id,
                                    select_element_id: select_element_id,
                                    vpid:vpid
                                })
                            })
                                .then(function (response) {
                                    return response.json();
                                })
                                .then(function (data) {
                                    console.log(141414, '--------')

                                    row.html(data.html);
                                    row.find('.select-2').select2({minimumResultsForSearch: -1});
                                    $self.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                                    // row.find('.product-qty').select2();
                                    setTotalPrice(countTotalPrice());
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        });

                        $('body').on('change', '#specialPopUpModal .product_radio-single .custom-radio .custom-control-input[type="radio"]', function(ev) {
                            ev.preventDefault();
                            const row = $(this).closest('.product__single-item-info-bottom');
                            const group_id = $(this).data('id');
                            const select_element_id = $(this).val();
                            const vpid = $('#vpid').val();

                            fetch("/products/get-offer-menu-raw", {
                                method: "post",
                                headers: {
                                    "Content-Type": "application/json",
                                    Accept: "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                                credentials: "same-origin",
                                body: JSON.stringify({
                                    group_id: group_id,
                                    select_element_id: select_element_id,
                                    vpid:vpid
                                })
                            })
                                .then(function (response) {
                                    return response.json();
                                })
                                .then(function (data) {
                                    console.log(151515, '--------')

                                    row.html(data.html);
                                    row.find('.select-2').select2({minimumResultsForSearch: -1});
                                    // row.find('.product-qty').select2();
                                    if($(this).closest('#specialPopUpModal')) {
                                        // $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                                        countOfferPrice();
                                    }
                                    // setTotalPrice(countTotalPrice());
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        });

                        const btnAddToRemove = (btn) => {
                            btn.removeClass('add-btn').addClass('remove-btn');
                            btn.html('remove');
                        };

                        const btnRemoveToAdd = (btn) => {
                            btn.removeClass('remove-btn').addClass('add-btn');
                            btn.html('add');
                        };

                        minLimitCheck = ($self) => {
                            const wrapper = $self.closest('.special__popup-main-product-item');
                            const wrongLimit = [];
                            wrapper.find('.limit.pr-wrap').each(function() {
                                const minLimit = $(this).data('min-limit');
                                if($(this).find('.product__single-item-add-new').length > 0) {
                                    $(this).find('.single-product-select').length < minLimit && wrongLimit.push($(this).data('group-id'));
                                } else if ($(this).find('.custom-control-input[type="checkbox"]').length > 0) {
                                    let count = 0;
                                    $(this).find('.custom-control-input[type="checkbox"]').each(function() {
                                        $(this).is(':checked') && ++count;
                                    });
                                    count < minLimit && wrongLimit.push($(this).data('group-id'));
                                } else if($(this).find('.popup-select').length > 0) {
                                    $(this).find('.product__single-item-info-bottom').length < minLimit && wrongLimit.push($(this).data('group-id'));
                                }
                            });

                            return wrongLimit;
                        };

                        $('body').on('click', '.special__popup-main-product-item-btn.add-btn', function() {
                            const id = $(this).closest('.special__popup-main-product-item').data('id');
                            const price = $(this).closest('.special__popup-main-product-item').find('.product__single-item_price').data('price-for-add');
                            const $self = $(this);
                            const wrongMinLimit = minLimitCheck($self);
                            console.log(wrongMinLimit);
                            if(wrongMinLimit.length === 0) {
                                fetch("/products/add-offer", {
                                    method: "post",
                                    headers: {
                                        "Content-Type": "application/json",
                                        Accept: "application/json",
                                        "X-Requested-With": "XMLHttpRequest",
                                        "X-CSRF-Token": $('input[name="_token"]').val()
                                    },
                                    credentials: "same-origin",
                                    body: JSON.stringify({
                                        id,
                                        price
                                    })
                                })
                                    .then(function (response) {
                                        return response.json();
                                    })
                                    .then(function (data) {
                                        $self.closest('.special__popup-main-product-item').addClass('active');
                                        $self.closest('.special__popup-main-product-item').addClass('user-non-select');
                                        // console.log($self.closest('.special__popup-main-product-item'));
                                        btnAddToRemove($self);
                                        if($(`#specialPopUpModal .added-offers .special__popup-content-right-product[data-id="${id}"]`).length === 0) {
                                            $('.special__popup-content-right-item.added-offers').append(data.html);
                                        }
                                        countOfferTotalPrice();
                                    })
                                    .catch(function (error) {
                                        console.log(error);
                                    });
                            } else {
                                wrongMinLimit.map((groupId) => {
                                    $self.closest('.special__popup-main-product-item').find(`.limit.pr-wrap[data-group-id="${groupId}"]`).css('border', '1px solid red');
                                });
                            }

                        });

                        $('body').on('click', '.special__popup-main-product-item-btn.remove-btn', function() {
                            btnRemoveToAdd($(this));
                            $(this).closest('.special__popup-main-product-item').removeClass('active');
                            const id = $(this).closest('.special__popup-main-product-item').data('id');
                            $('.special__popup-content-right-item.added-offers').find(`.special__popup-content-right-product[data-id="${id}"]`).remove();
                            countOfferTotalPrice();
                        });

                        $('body').on('click', '.special__popup-content-right-product-remove', function() {
                            const id = $(this).closest('.special__popup-content-right-product').data('id');
                            $(this).closest('.special__popup-content-right-product').remove();
                            const product = $(`#specialPopUpModal .special__popup-main-product-item[data-id="${id}"]`);
                            const buttonCart = product.find('.special__popup-main-product-item-btn');
                            product.removeClass('active');
                            buttonCart.removeClass('remove-btn').addClass('add-btn').html('add');
                            if(buttonCart.closest('.user-non-select').length > 0) {
                                buttonCart.closest('.user-non-select').removeClass('user-non-select');
                            }
                            countOfferTotalPrice();
                        });

                        //data object for add-to-cart and extra
                        const addDataKey = {};

//item price
                        let item_price = 0;

//section price
                        let section_price = 0;

//extra group ids
                        const selectedGroupId = [];



//event default
                        const eventInitialDefault = (ev) => {
                            ev.preventDefault();
                            ev.stopImmediatePropagation();
                        };

// return true if argument is checked
                        const isChecked = (checkbox) => {
                            return checkbox.is(':checked');
                        };

//return true if argument is required
                        const isReq = (el) => {
                            return Number(el.closest('[data-req]').attr('data-req'));
                        };

//return true if arguments is section and false if arguments is item
                        const isSection = (el) => {
                            return el.closest('[data-per-price]').attr('data-per-price') === "product";
                        };

//return true if argument is single select
                        const isSingle = (select) => {
                            if (select.attr('id')) {
                                return select.attr('id').includes('single');
                            }
                        };

//return true if we are on the cart page
                        const isCartPage = () => {
                            return $('.shopping-cart_wrapper').length !== 0;
                        };


//pass element and get row
                        const getRow = (el) => {
                            return $(el).closest('product-single-info_row');
                        };



// product-count-plus event callback
                        const handleProductCountPlus = (plus_button, section, type, limit) => {
                            const counter = $(plus_button.closest('.continue-shp-wrapp_qty').find('.field-input')[0]);

                            // new_qty(section);
                            // Number(counter.val()) < Number(limit) - Number(new_qty(section)) +
                            Number($(plus_button.closest('.continue-shp-wrapp_qty').find('.field-input')[0]).val()) && counter.val(Number(counter.val()) + 1);
                            // new_qty(section);
                            // if (type === 'select') {
                            //     select2MaxLimit(section, limit);
                            // }

                            const price = plus_button.closest('[data-price]').attr('data-price');
                            plus_button.closest('[data-price]').find('.price-placee').html(`${getCurrencySymbol()}${price * Number(counter.val())}`);
                        };

//create hidden input and take data for filter modal
                        const createInputHiddenForFilter = (items, self) => {
                            let inputHidden = document.createElement('input');
                            $(inputHidden).attr({
                                type: 'hidden',
                                name: self.attr('data-name'),
                                value: items
                            });
                            $('body').find(`.${self.attr('id')}`).closest('.product-single-info_row').find('.product-single-info_row-items').append($(inputHidden));
                        };



                        const makeSelectedItemModal = (id, title, filter) => {
                            return (`<div class="col-md-2 col-sm-3 selected-item_popup" data-id-popup="${id}">
                              <div class="d-flex justify-content-between selected-item_popup-wrapper">
                                <div class="align-self-center text-truncate">
                                  ${title}
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                  <div class="mr-1">Qty</div>
                                  <div class="continue-shp-wrapp_qty position-relative mr-0">
                                    <!--minus qty-->
                                <span class="d-flex align-items-center pointer position-absolute selected-item-popup_qty-minus qty-count">
                                <svg viewBox="0 0 20 3" width="12px" height="3px">
                                <path fill-rule="evenodd" fill="rgb(214, 217, 225)"
                                d="M20.004,2.938 L-0.007,2.938 L-0.007,0.580 L20.004,0.580 L20.004,2.938 Z"></path>
                                </svg>
                                </span>
                                <input class="popup_field-input w-100 h-100 font-23 text-center border-0 selected-item-popup_qty-select none-touchable" min="number" name=""
                                type="number" value="1">
                                <!--plus qty-->
                                <span class="d-flex align-items-center pointer position-absolute selected-item-popup_qty-plus qty-count">
                                <svg viewBox="0 0 20 20" width="15px" height="15px">
                                <path fill-rule="evenodd" fill="rgb(211, 214, 223)"
                                d="M20.004,10.938 L11.315,10.938 L11.315,20.000 L8.696,20.000 L8.696,10.938 L-0.007,10.938 L-0.007,8.580 L8.696,8.580 L8.696,0.007 L11.315,0.007 L11.315,8.580 L20.004,8.580 L20.004,10.938 Z"></path>
                                </svg>
                                </span>
                                </div>
                                <div>
                                <a href="javascript:void(0)" data-el-id="${id}" class="btn btn-sm delete-menu-item${!filter ? '_popup' : ''} text-danger"><i class="fa fa-times"></i></a>
                                </div>
                                </div>
                                </div>
                                </div>`);
                                };

                        const makeOutOfStockSelectOption = (select, type) => {
                            if (type === "select") {
                                select.find('[data-out="1"]').attr('disabled', 'disabled');


                                const current_item_id = $(select.find('[data-out="0"]')[0]).attr('data-select2-id');
                                // new_qty(select);
                                if (isSingle(select)) {
                                    select.find('[data-out="0"]').length > 0 && select.val($(select.find('[data-out="0"]')[0]).val());
                                    fetch("/products/get-variation-menu-raw", {
                                        method: "post",
                                        headers: {
                                            "Content-Type": "application/json",
                                            Accept: "application/json",
                                            "X-Requested-With": "XMLHttpRequest",
                                            "X-CSRF-Token": $('input[name="_token"]').val()
                                        },
                                        credentials: "same-origin",
                                        body: JSON.stringify({
                                            id: $(select.find('[data-out="0"]')[0]).val(),
                                            selectElementId: current_item_id
                                        })
                                    })
                                        .then(function (response) {
                                            return response.json();
                                        })
                                        .then(function (json) {
                                            if (isSingle(select)) {
                                                !isSection(select) && (select.closest('.product-single-info_row').find('.selected-menu-options').html(json.html));
                                            } else {
                                                select.closest('.product-single-info_row').find('.product-single-info_row-items').append(json.html);
                                            }
                                            setTotalPrice(countTotalPrice());
                                        })
                                        .catch(function (error) {
                                            console.log(error);
                                        });
                                }
                            } else if (type === "list") {
                                select.find('[data-out="1"]').addClass('none-touchable-op');
                            } else if (type === "popup") {
                                select.find('[data-out="1"]').closest('.single-item-wrapper').addClass('none-touchable-op');
                            } else if (type === "filter") {
                                // console.log('filter stock', select);
                                select.find('[data-out="1"]').addClass('none-touchable-op');
                            }
                        };

                        const discountInputChange = ($ev, $element, discount_type) => {
                            // console.log('99999999999999999999999999999999999999', discount_type);
                            const variation_id = $element.attr('data-id');
                            // console.log(variation_id);
                            if(discount_type === 'range') {
                                const qty = $element.val();
                                fetch("/products/get-discount-price", {
                                    method: "post",
                                    headers: {
                                        "Content-Type": "application/json",
                                        Accept: "application/json",
                                        "X-Requested-With": "XMLHttpRequest",
                                        "X-CSRF-Token": $('input[name="_token"]').val()
                                    },
                                    credentials: "same-origin",
                                    body: JSON.stringify({
                                        variation_id,
                                        qty
                                    })
                                })
                                    .then((res) => {
                                        return res.json();
                                    })
                                    .then((data) => {
                                        $element.closest('.menu-item-selected').find('.price-placee').html(`${getCurrencySymbol()}${data.price}`);
                                    })
                                    .catch(error => console.error(error));
                            } else if(discount_type === 'fixed') {
                                const discount_id = $element.val();
                                fetch("/products/get-discount-price", {
                                    method: "post",
                                    headers: {
                                        "Content-Type": "application/json",
                                        Accept: "application/json",
                                        "X-Requested-With": "XMLHttpRequest",
                                        "X-CSRF-Token": $('input[name="_token"]').val()
                                    },
                                    credentials: "same-origin",
                                    body: JSON.stringify({
                                        variation_id,
                                        discount_id
                                    })
                                })
                                    .then((res) => {
                                        return res.json();
                                    })
                                    .then((data) => {
                                        $element.closest('.menu-item-selected').find('.price-placee').html(`${getCurrencySymbol()}${data.price}`);
                                    })
                                    .catch(error => console.error(error));
                            }

                        };

                        const unselectHandle = (select, id) => {
                            select.closest('.filters-select-wizard').find(`.product__single-item-info-bottom[data-id="${id}"]`).remove();
                            setTimeout(function () {
                                // select2MaxLimit(select, limit);
                                // setTotalPrice(false);
                                setTotalPrice(countTotalPrice());
                            }, 0);
                        };

                        const selectHandle = (el, id, selectElementId, limit, select) => {

                            // console.log('el', el, 'id', id, 'selectElementId', selectElementId, 'select',select)
                            fetch("/products/get-variation-menu-raws", {
                                method: "post",
                                headers: {
                                    "Content-Type": "application/json",
                                    Accept: "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                                credentials: "same-origin",
                                body: JSON.stringify({items: [{id: id, value: 1}], ids: [id]})
                            })
                                .then(function (response) {
                                    return response.json();
                                })
                                .then(function (json) {
                                    // const isMultiple = select.closest('[data-limit]').attr('data-limit') === '1' ? false : true;

                                    el.closest('.product__single-item-info-bottom').find('.filter-children-items').append(json.html);
                                    // select2MaxLimit(select, limit);
                                    setTotalPrice(countTotalPrice());
                                    // el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.product__single-item-info-bottom').remove();
                                    // el.closest('.product__single-item-info-bottom').find('.filter-children-items').append(json.html);
                                    // el.closest('.product-single-info_row').find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').html($(el.closest('.product-single-info_row').find('.filter-children-items').children()[1]));
                                    // console.log('$(el.closest(\'.product__single-item-info-bottom\').find(\'.filter-children-items\').children()[1])', $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]));
                                    // $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]).remove();
                                    el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.select-2').each(function() {
                                        $(this).select2({minimumResultsForSearch: -1});
                                    });
                                    el.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                                    el.closest('.filters-select-wizard').on('click', '.remove-single_product-item', function(ev) {
                                        // ev.stopImmediatePropagation();
                                        unselectHandle($(this), $(this).closest('.product__single-item-info-bottom').data('id'));
                                    });


                                    // setTotalPrice(modal);
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        };


                        const selectOfferHandle = (el, id, selectElementId, limit, select) => {

                            // console.log('el', el, 'id', id, 'selectElementId', selectElementId, 'select',select)
                            fetch("/products/get-offer-menu-raws", {
                                method: "post",
                                headers: {
                                    "Content-Type": "application/json",
                                    Accept: "application/json",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-Token": $('input[name="_token"]').val()
                                },
                                credentials: "same-origin",
                                body: JSON.stringify({items: [{id: id, value: 1}], ids: [id]})
                            })
                                .then(function (response) {
                                    return response.json();
                                })
                                .then(function (json) {
                                    // const isMultiple = select.closest('[data-limit]').attr('data-limit') === '1' ? false : true;

                                    el.closest('.filter-children-items').append(json.html);
                                    // select2MaxLimit(select, limit);
                                    // setTotalPrice(countTotalPrice());

                                    // el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.product__single-item-info-bottom').remove();
                                    // el.closest('.product__single-item-info-bottom').find('.filter-children-items').append(json.html);
                                    // el.closest('.product-single-info_row').find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').html($(el.closest('.product-single-info_row').find('.filter-children-items').children()[1]));
                                    // console.log('$(el.closest(\'.product__single-item-info-bottom\').find(\'.filter-children-items\').children()[1])', $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]));
                                    // $(el.closest('.product__single-item-info-bottom').find('.filter-children-items').children()[1]).remove();
                                    el.closest('.product__single-item-info-bottom').find('.filter-children-items').find('.select-2').each(function() {
                                        $(this).select2({minimumResultsForSearch: -1});
                                    });
                                    el.closest('.product__single-item-info').css('border-color', '#d7d7d7');
                                    el.closest('.filters-select-wizard').on('click', '.remove-single_product-item', function(ev) {
                                        // ev.stopImmediatePropagation();
                                        unselectHandle($(this), $(this).closest('.product__single-item-info-bottom').data('id'));
                                    });
                                    countOfferPrice();
                                    countOfferTotalPrice();

                                    // setTotalPrice(modal);
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        };
// //unselect handle function

                        // const filterModalSingleInit = () => {
                        //     (function () {
                        //         const $body = $('body');
                        //
                        //         $(`.add-product-modal .filters-modal-wizard`).each(function (index) {
                        //             const group_id = $(this).attr('data-group');
                        //             const filter = [];
                        //
                        //             let dg = null;
                        //             let filter_limit = 0;
                        //
                        //             $("body").on('click', `.filters-modal-wizard[data-group="${group_id}"]`, function () {
                        //                 dg = $(this).attr('data-group');
                        //                 let group = $(this).attr('data-group');
                        //                 filter_limit = $(this).closest('.limit').attr('data-limit');
                        //                 const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
                        //                     return $(item).attr('data-id');
                        //                 });
                        //                 // console.log('index',index);
                        //                 $.ajax({
                        //                     type: "post",
                        //                     url: "/products/select-items",
                        //                     cache: false,
                        //                     data: {
                        //                         group,
                        //                         selectedIds,
                        //                         type: "popup"
                        //                     },
                        //                     headers: {
                        //                         "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        //                     },
                        //                     success: function (data) {
                        //                         if (!data.error) {
                        //                             $("#wizardViewModal .selected-items_filter").empty();
                        //                             $(`.filter[data-group-id="${group}"]`).closest('.product-single-info_row').find('.menu-item-selected').toArray().map((selectedItem) => {
                        //                                 const selectedItemId = $(selectedItem).attr('data-id');
                        //                                 const selectedItemTitle = $(selectedItem).find('.delete-menu-item').parent().text().trim();
                        //                                 // $("#wizardViewModal .selected-items_filter").append(makeSelectedItemModal(selectedItemId, selectedItemTitle, true));
                        //                             });
                        //                             $("#wizardViewModal").modal();
                        //                         } else {
                        //                             alert("error");
                        //                         }
                        //                     }
                        //                 });
                        //             });
                        //
                        //             $("body").on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .wrap-item`, function (ev) {
                        //                 const id = $(this).attr('data-id');
                        //                 const title = $(this).find('.name').text().trim();
                        //                 filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
                        //                 // filter_limit > new_qty(null, 'filter') &&
                        //                 if (!$(this).hasClass('active')) {
                        //                     $(this).addClass('active');
                        //                     // $('.selected-items_filter').append(makeSelectedItemModal(id, title, true));
                        //                 } else if ($(this).hasClass('active')) {
                        //                     $(`[data-id-popup="${id}"]`).remove();
                        //                     $(this).removeClass('active');
                        //                 }
                        //             });
                        //
                        //             $('body').on('click', '#wizardViewModal .selected-item-popup_qty-minus', function (ev) {
                        //                 eventInitialDefault(ev);
                        //                 $(this).siblings(".popup_field-input").val() > 1 && $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) - 1);
                        //             });
                        //
                        //             $('body').on('click', '#wizardViewModal .selected-item-popup_qty-plus', function (ev) {
                        //                 eventInitialDefault(ev);
                        //                 filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
                        //                 if (filter_limit > new_qty(null, 'filter')) {
                        //                     $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) + 1);
                        //                 }
                        //             });
                        //
                        //             $('body').on('click', '#wizardViewModal .selected-item_popup .delete-menu-item', function () {
                        //                 const remove_id = $(this).attr('data-el-id');
                        //                 $('#wizardViewModal').find(`.wrap-item[data-id="${remove_id}"]`).removeClass('active');
                        //                 $(this).closest('.selected-item_popup').remove();
                        //             });
                        //
                        //
                        //             $('body').on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function () {
                        //                 const items_array = [];
                        //                 // console.log(2, '*****************************')
                        //
                        //                 $('#wizardViewModal .modal-body').find('.wrap-item').each(function () {
                        //                     $(this).hasClass('active') && (items_array.push($(this).attr('data-id')));
                        //                 });
                        //
                        //                 const popup_items_qty = [];
                        //                 // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
                        //                 $(`[data-id-popup].selected-item_popup`).find('.popup_field-input').each(function () {
                        //                     const $this = $(this);
                        //                     popup_items_qty.push({
                        //                         id: $this.closest('.selected-item_popup').attr('data-id-popup'),
                        //                         value: $this.val()
                        //                     });
                        //                 });
                        //
                        //                 fetch("/products/get-variation-menu-raws", {
                        //                     method: "post",
                        //                     headers: {
                        //                         "Content-Type": "application/json",
                        //                         Accept: "application/json",
                        //                         "X-Requested-With": "XMLHttpRequest",
                        //                         "X-CSRF-Token": $('input[name="_token"]').val()
                        //                     },
                        //                     credentials: "same-origin",
                        //                     body: JSON.stringify({ids: items_array})
                        //                 })
                        //                     .then(function (response) {
                        //                         return response.json();
                        //                     })
                        //                     .then(function (json) {
                        //                         const items_row = $(`[data-group-id="${dg}"]`).find('.product-single-info_row-items');
                        //                         items_row.append(json.html);
                        //                         const selects = items_row.find('.select-2');
                        //                         selects.length > 0 && selects.each(function() {
                        //                             $(this).select2({minimumResultsForSearch: -1});
                        //                         });
                        //                         $(`[data-group-id="${dg}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                        //                         // $(`[data-group-id="${dg}"]`).closest('.product-single-info_row').find('.field-input').each(function () {
                        //                         //     const d_id = $(this).attr('data-id');
                        //                         //     const value = popup_items_qty.length > 0 && popup_items_qty.find((el) => {
                        //                         //         return el.id === d_id;
                        //                         //     }).value;
                        //                         //     $(this).val(value);
                        //                         //     $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
                        //                         // });
                        //                         setTotalPrice(countTotalPrice());
                        //
                        //                         $('#wizardViewModal').modal('hide');
                        //
                        //
                        //
                        //                         $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                        //                             $(this).closest('.menu-item-selected').remove();
                        //                             setTotalPrice(countTotalPrice());
                        //                         });
                        //
                        //                         $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                        //                             ev.preventDefault();
                        //                             ev.stopImmediatePropagation();
                        //                             const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                        //
                        //                             handleProductCountMinus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
                        //                             setTotalPrice(countTotalPrice());
                        //
                        //                         });
                        //
                        //                         $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                        //                             ev.preventDefault();
                        //                             ev.stopImmediatePropagation();
                        //                             const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                        //
                        //                             handleProductCountPlus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
                        //                             setTotalPrice(countTotalPrice());
                        //                         });
                        //                     });
                        //             });
                        //
                        //             $(this).on('click', function (e) {
                        //                 const first_category_id = $(this).attr('data-action');
                        //                 let self = $(this);
                        //                 let selectMoreItems = [];
                        //                 let selectSingleItems;
                        //
                        //                 $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .item-content`, function () {
                        //                     $('.shopping-cart_wrapper .item-content').removeClass('active');
                        //                     $(this).addClass('active');
                        //                 });
                        //
                        //                 $body.on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function (e) {
                        //                     eventInitialDefault(e);
                        //                     // console.log(1, '*****************************')
                        //
                        //                     $(`.filter[data-group-id="${group_id}"]`).find('.product-single-info_row-items').empty();
                        //
                        //                     if (Number(self.attr('data-multiple')) === 1) {
                        //                         $(this).closest('.contents-wrapper').find('.wrap-item.active').each(function () {
                        //                             selectMoreItems.push($(this).attr('data-id'));
                        //                         });
                        //                         selectMoreItems.forEach((item) => {
                        //                             createInputHiddenForFilter(item, self);
                        //                         });
                        //                     } else {
                        //                         selectSingleItems = $(this).closest('.contents-wrapper').find('.wrap-item.active').attr('data-id');
                        //                         createInputHiddenForFilter(selectSingleItems, self);
                        //                     }
                        //
                        //                     $('#wizardViewModal').modal('hide');
                        //                 });
                        //
                        //                 $.ajax({
                        //                     type: "post",
                        //                     url: "/filters",
                        //                     cache: false,
                        //                     data: {
                        //                         group: self.attr('data-group'),
                        //                         category_id: first_category_id,
                        //                         filters: filter,
                        //                         type: "popup"
                        //                     },
                        //                     headers: {
                        //                         "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        //                     },
                        //                     success: function (data) {
                        //                         if (!data.error) {
                        //                             const modal_group_id = self.attr('data-group');
                        //                             $('#wizardViewModal').attr('data-group', modal_group_id);
                        //                             const contantPlace = $('.contents-wrapper .content');
                        //                             const wizardPlace = $('.shopping-cart-head .nav-pills');
                        //
                        //                             wizardPlace.empty();
                        //                             wizardPlace.append(data.wizard);
                        //                             if (data.type === "filter") {
                        //                                 contantPlace.html(data.filters);
                        //                             } else if (data.type === "items") {
                        //                                 contantPlace.html(data.items_html);
                        //                                 makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
                        //                                 $('.shopping-cart_wrapper .next-btn').addClass('d-none');
                        //                                 $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
                        //                             }
                        //                         } else {
                        //                             alert("error");
                        //                         }
                        //                     },
                        //                     error: function (error) {
                        //                         filter.pop();
                        //                     }
                        //                 });
                        //
                        //                 $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .next-btn`, function (e) {
                        //                     eventInitialDefault(e);
                        //                     $('.content-wrap').find('.active').toArray().map(function (actv) {
                        //                         filter.push($(actv).closest('[data-id]').attr('data-id'));
                        //                     });
                        //                     // console.log(filter);
                        //
                        //                     $('.content-wrap').find('.active').length === 0 ? alert('select item') : $.ajax({
                        //                         type: "post",
                        //                         url: "/filters",
                        //                         cache: false,
                        //                         data: {
                        //                             group: self.attr('data-group'),
                        //                             category_id: first_category_id,
                        //                             filters: filter,
                        //                             type: "popup"
                        //                         },
                        //                         headers: {
                        //                             "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        //                         },
                        //                         success: function (data) {
                        //                             if (!data.error) {
                        //                                 $('.shopping-cart-head .nav-pills').empty();
                        //                                 $('.shopping-cart-head .nav-pills').append(data.wizard);
                        //                                 $('.back-btn').removeClass('d-none');
                        //                                 if (data.type === "filter") {
                        //                                     $('.contents-wrapper .content').html(data.filters);
                        //                                 } else if (data.type === "items") {
                        //                                     $('.contents-wrapper .content').html(data.items_html);
                        //                                     $(`#wizardViewModal[data-group="${group_id}"] .selected-item_popup`).each(function () {
                        //                                         $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).length > 0
                        //                                         && $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).addClass('active');
                        //                                     });
                        //                                     makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
                        //                                     $('.shopping-cart_wrapper .next-btn').addClass('d-none');
                        //                                     $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
                        //                                 }
                        //                             } else {
                        //                                 alert("error");
                        //                             }
                        //                         },
                        //                         error: function (error) {
                        //                             filter.pop();
                        //                         }
                        //                     });
                        //                 });
                        //                 $('body').on('click', '.shopping-cart_wrapper .back-btn', function (e) {
                        //                     e.preventDefault();
                        //                     e.stopImmediatePropagation();
                        //
                        //                     filter.pop();
                        //                     // console.log(filter)
                        //                     $.ajax({
                        //                         type: "post",
                        //                         url: "/filters",
                        //                         cache: false,
                        //                         data: {
                        //                             group: self.attr('data-group'),
                        //                             category_id: first_category_id,
                        //                             filters: filter,
                        //                             type: 'popup'   //self.attr('data-type')
                        //                         },
                        //                         headers: {
                        //                             "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        //                         },
                        //                         success: function (data) {
                        //                             if (!data.error) {
                        //
                        //                                 $('.shopping-cart-head .nav-pills').empty();
                        //                                 $('.shopping-cart-head .nav-pills').append(data.wizard);
                        //                                 if (data.type === "filter") {
                        //                                     $('.contents-wrapper .content').html(data.filters);
                        //                                     $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
                        //                                     $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
                        //                                 } else if (data.type === "items") {
                        //                                     $('.contents-wrapper .content').html(data.items_html);
                        //                                 }
                        //                                 if (filter.length === 0) {
                        //                                     $('.shopping-cart_wrapper .back-btn').addClass('d-none');
                        //                                 }
                        //                             } else {
                        //                                 alert("error");
                        //                             }
                        //                         },
                        //                         error: function (error) {
                        //                             console.log(error);
                        //                         }
                        //                     });
                        //                 });
                        //             });
                        //             $('#wizardViewModal').on('hidden.bs.modal', function (e) {
                        //                 filter.length = 0;
                        //                 $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
                        //                 $('.shopping-cart_wrapper .back-btn').addClass('d-none');
                        //                 $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
                        //                 $('#wizardViewModal .selected-items_filter').empty();
                        //                 $('#wizardViewModal .content-wrap .wrap-item').removeClass('active');
                        //             });
                        //         });
                        //     })();
                        // };
                        // filterModalSingleInit();

                        function limite_message(group_id, active_item) {
                            const place = $('#wizardViewModal .message_place_js');
                            const limit = $(`.product__single-item-info[data-group-id="${group_id}"]`).data('limit');
                            const min_limit = $(`.product__single-item-info[data-group-id="${group_id}"]`).data('min-limit');
                            const count = $('#wizardAll').find('.item-content.active').length;
                            let message = '';
                            console.log(22222222222);
                            // console.log(count, min_limit, limit)
                            if(count < min_limit || count > limit) {
                                $('#wizardViewModal .b_save').attr('disabled', true);
                            } else {
                                $('#wizardViewModal .b_save').attr('disabled', false);
                            }

                            if(limit !== 1) {
                                if(min_limit >= 1 && count === 0) {
                                    message = `You need to select items`;
                                } else if (min_limit >= 1 && count < min_limit && limit !== count) {
                                    message = `${min_limit - count} items left`;
                                } else if(count === limit && !active_item) {
                                    message = `You allowed to select ${limit} items only`;
                                } else if(count >= min_limit && count <= limit) {
                                    message = '';
                                }
                            }

                            if(limit === 1 && count === 0) {
                                message = 'You need to select one item';
                            } else if(limit === 1 && count !== 0) {
                                message = '';
                            }

                            // console.log(limit, min_limit, count, message,  group_id);
                            place.text(message);
                        }

                        function activate_item(self, id, name, group_id) {
                            const limit = $(`.product__single-item-info[data-group-id="${group_id}"]`).data('limit');
                            if(limit !== 1) {
                                if($(self).hasClass('active')) {
                                    $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                                        $(this).find('.item-content').removeClass('active');
                                    });
                                    $('#wizardViewModal .footer-list').find(`li[data-id="${id}"]`).remove();
                                } else {
                                    const group_element = $(`.product__single-item-info[data-group-id="${group_id}"]`);

                                    if($("#wizardViewModal #myTabContent #wizardAll").find('.item-content.active').length < group_element.data('limit')) {
                                        $(self).addClass('active');
                                        $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                                            $(this).find('.item-content').addClass('active');
                                        });
                                        $('#wizardViewModal .footer-list').find(`.footer-list-item[data-id="${id}"]`).length === 0 && $('#wizardViewModal .footer-list')
                                            .append(`<li class="footer-list-item" data-id="${id}" data-name="${name}">
                                                            <span class="title">${name}</span>
                                                            <span class="close-icon item-selected-footer"><i class="fa fa-times"></i></span>
                                                        </li>`);
                                    }
                                }
                            } else {
                                // if($(self).hasClass('active')) {
                                // $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                                //     $(this).find('.item-content').removeClass('active');
                                // });
                                // $('#wizardViewModal .footer-list').find(`li[data-id="${id}"]`).remove();
                                // } else {
                                $("#wizardViewModal #myTabContent").find('li').each(function() {
                                    if($(this).data('id') === id) {
                                        $(this).find('.item-content').addClass('active');
                                    } else {
                                        $(this).find('.item-content').removeClass('active');
                                    }

                                });

                                const group_element = $(`.product__single-item-info[data-group-id="${group_id}"]`);

                                if($("#wizardViewModal #myTabContent #wizardAll").find('.item-content.active').length < group_element.data('limit')) {
                                    $(self).addClass('active');
                                    $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                                        $(this).find('.item-content').addClass('active');
                                    });
                                    $('#wizardViewModal .footer-list').find(`.footer-list-item[data-id="${id}"]`).length === 0 && $('#wizardViewModal .footer-list')
                                        .html(`<li class="footer-list-item" data-id="${id}" data-name="${name}">
                                                            <span class="title">${name}</span>
                                                            <span class="close-icon item-selected-footer"><i class="fa fa-times"></i></span>
                                                        </li>`);
                                }
                                // }
                            }

                        }

                        const filterModalSingleInit = () => {
                            (function () {
                                $(`.add-product-modal .filters-modal-wizard`).each(function (index) {
                                    const button_group_id = $(this).attr('data-group');
                                    selected_ides = [];
                                    let x_group;
                                    $("body").on('click', `.filters-modal-wizard[data-group="${button_group_id}"]`, function () {
                                        let group_id = $(this).data('group');
                                        x_group = group_id;
                                        $("#wizardViewModal").attr('data-group', group_id);

                                        // const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
                                        //     return $(item).attr('data-id');
                                        // });

                                        $("#wizardViewModal .modal-body").empty();
                                        $("#wizardViewModal .footer-list").empty();
                                        $.ajax({
                                            type: "post",
                                            url: "/filters/render-tabs",
                                            cache: false,
                                            data: {
                                                group: group_id
                                            },
                                            headers: {
                                                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                                            },
                                            success: function (data) {
                                                $("#wizardViewModal .modal-body").html(data.html);
                                                selected_ides.length = 0;
                                                $(`.product__single-item-info[data-group-id="${group_id}"]`).find('.product__single-item-info-bottom').each(function(a, b) {
                                                    $(this).data('id') && selected_ides.push($(this).data('id'));
                                                });
                                                $("#wizardViewModal ul.content li").each(function() {
                                                    $(this).find(".item-content").on('click', function () {
                                                        let id = $(this).closest('li').attr('data-id');
                                                        let name = $(this).closest('li').attr('data-name');
                                                        activate_item(this, id, name, group_id);
                                                        const active_item = $(this).hasClass('active');
                                                        limite_message(group_id, active_item);
                                                    });
                                                    // console.log(selected_ides);
                                                    // console.log('lalalalaaaa', selected_ides.includes($(this).data('id')) && $($(this).find(".item-content")[0]));
                                                    if(selected_ides.includes($(this).data('id'))) {
                                                        let id = $(this).closest('li').attr('data-id');
                                                        let name = $(this).closest('li').attr('data-name');
                                                        activate_item(this, id, name, group_id);
                                                        limite_message(group_id, true);
                                                    }

                                                });
                                                limite_message(group_id, true);
                                                // $(`#wizardViewModal ul.content li`).each(function() {
                                                //
                                                // });
                                                $("#wizardViewModal").modal();
                                            },
                                            error: function() {
                                                $("#wizardViewModal .modal-body").empty();
                                                $("#wizardViewModal").modal();
                                            }
                                        });
                                    });

                                    $('body').on('click', `#wizardViewModal[data-group="${button_group_id}"] .close-icon.item-selected-footer`, function(ev) {
                                        const id = $(this).closest('li').data('id');
                                        const group_id = button_group_id;
                                        $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                                            $(this).find('.active').removeClass('active');
                                        });
                                        $(this).closest('li').remove();
                                        // console.log(x_group, group_id)
                                        if(x_group === group_id) {
                                            limite_message(x_group);
                                        }
                                    });



                                    $('body').on('click', `#wizardViewModal[data-group="${button_group_id}"] .b_save`, function () {
                                        const items_array = [];

                                        $('#wizardViewModal .modal-body').find(".item-content.active").each(function () {
                                            items_array.push($(this).closest('li').attr('data-id'));
                                        });

                                        const popup_items_qty = [];
                                        // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
                                        $(`[data-id-popup].selected-item_popup`).find('.popup_field-input').each(function () {
                                            const $this = $(this);
                                            popup_items_qty.push({
                                                id: $this.closest('.selected-item_popup').attr('data-id-popup'),
                                                value: $this.val()
                                            });
                                        });

                                        fetch("/products/get-variation-menu-raws", {
                                            method: "post",
                                            headers: {
                                                "Content-Type": "application/json",
                                                Accept: "application/json",
                                                "X-Requested-With": "XMLHttpRequest",
                                                "X-CSRF-Token": $('input[name="_token"]').val()
                                            },
                                            credentials: "same-origin",
                                            body: JSON.stringify({ids: items_array})
                                        })
                                            .then(function (response) {
                                                return response.json();
                                            })
                                            .then(function (json) {
                                                // console.log(json);

                                                const items_row = $(`[data-group-id="${button_group_id}"]`).find('.product-single-info_row-items');
                                                items_row.html(json.html);

                                                const selects = items_row.find('.select-2');
                                                selects.length > 0 && selects.each(function() {
                                                    $(this).select2({minimumResultsForSearch: -1});
                                                });
                                                $(`[data-group-id="${button_group_id}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                                                $(`[data-group-id="${button_group_id}"]`).closest('.product-single-info_row').find('.field-input').each(function () {
                                                    const d_id = $(this).attr('data-id');
                                                    const value = popup_items_qty.length > 0 && popup_items_qty.find((el) => {
                                                        return el.id === d_id;
                                                    }).value;
                                                    $(this).val(value);
                                                    $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
                                                });
                                                setTotalPrice(countTotalPrice());

                                                $('#wizardViewModal').modal('hide');

                                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                                                    $(this).closest('.menu-item-selected').remove();
                                                    setTotalPrice(countTotalPrice());
                                                });

                                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                                                    ev.preventDefault();
                                                    ev.stopImmediatePropagation();
                                                    const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                                    handleProductCountMinus($(this), $(`[data-group="${button_group_id}"]`), 'popup', limit);
                                                    setTotalPrice(countTotalPrice());

                                                });

                                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                                                    ev.preventDefault();
                                                    ev.stopImmediatePropagation();
                                                    const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                                    handleProductCountPlus($(this), $(`[data-group="${button_group_id}"]`), 'popup', limit);
                                                    setTotalPrice(countTotalPrice());
                                                });

                                                // console.log('group_id', group_id);


                                            });
                                    });

                                    $('body').on('click', '#wizardViewModal .item-selected-footer', function() {
                                        let id = $(this).closest('.footer-list-item').attr('data-id');
                                        let name = $(this).closest('.footer-list-item').attr('data-name');
                                        activate_item($(`#wizardViewModal .content[data-id="${id}"]`).find('.item-content'), id, name);
                                        $(this).closest('.footer-list-item').remove();
                                    });
                                });
                            })();
                        };

                        const filterModalOfferInit = () => {
                            (function () {
                                $(`#specialPopUpModal .filters-modal-wizard`).each(function (index) {
                                    const button_group_id = $(this).attr('data-group');
                                    selected_ides = [];
                                    let x_group;

                                    $("body").on('click', `.filters-modal-wizard[data-group="${button_group_id}"]`, function () {
                                        let group_id = $(this).data('group');
                                        x_group = group_id;
                                        $("#wizardViewModal").attr('data-group', group_id);

                                        // const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
                                        //     return $(item).attr('data-id');
                                        // });

                                        $("#wizardViewModal .modal-body").empty();
                                        $("#wizardViewModal .footer-list").empty();
                                        $.ajax({
                                            type: "post",
                                            url: "/filters/render-tabs",
                                            cache: false,
                                            data: {
                                                group: group_id
                                            },
                                            headers: {
                                                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                                            },
                                            success: function (data) {
                                                $("#wizardViewModal .modal-body").html(data.html);
                                                selected_ides.length = 0;
                                                $(`.product__single-item-info[data-group-id="${button_group_id}"]`).find('.product__single-item-info-bottom').each(function(a, b) {
                                                    $(this).data('id') && selected_ides.push($(this).data('id'));
                                                });
                                                $("#wizardViewModal ul.content li").each(function() {
                                                    $(this).find(".item-content").on('click', function () {
                                                        let id = $(this).closest('li').attr('data-id');
                                                        let name = $(this).closest('li').attr('data-name');
                                                        activate_item(this, id, name, group_id);
                                                        const active_item = $(this).hasClass('active');
                                                        limite_message(group_id, active_item);
                                                    });
                                                    // console.log(selected_ides);
                                                    // console.log('lalalalaaaa', selected_ides.includes($(this).data('id')) && $($(this).find(".item-content")[0]));
                                                    if(selected_ides.includes($(this).data('id'))) {
                                                        let id = $(this).closest('li').attr('data-id');
                                                        let name = $(this).closest('li').attr('data-name');
                                                        activate_item(this, id, name, group_id);
                                                        limite_message(group_id, true);
                                                    }
                                                });
                                                limite_message(group_id, true);

                                                // $(`#wizardViewModal ul.content li`).each(function() {
                                                //
                                                // });
                                                $("#wizardViewModal").modal();
                                            },
                                            error: function() {
                                                $("#wizardViewModal .modal-body").empty();
                                                $("#wizardViewModal").modal();
                                            }
                                        });
                                    });

                                    $('body').on('click', `#wizardViewModal[data-group="${button_group_id}"] .close-icon.item-selected-footer`, function(ev) {
                                        const id = $(this).closest('li').data('id');
                                        const group_id = button_group_id;
                                        $("#wizardViewModal #myTabContent").find(`li[data-id="${id}"]`).each(function() {
                                            $(this).find('.active').removeClass('active');
                                        });
                                        $(this).closest('li').remove();
                                        console.log(x_group, group_id)
                                        if(x_group === group_id) {
                                            limite_message(x_group);
                                        }
                                    });

                                    $('body').on('click', `#wizardViewModal[data-group="${button_group_id}"] .b_save`, function () {
                                        const items_array = [];

                                        $('#wizardViewModal .modal-body').find(".item-content.active").each(function () {
                                            items_array.push($(this).closest('li').attr('data-id'));
                                        });

                                        const popup_items_qty = [];
                                        // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
                                        $(`[data-id-popup].selected-item_popup`).find('.popup_field-input').each(function () {
                                            const $this = $(this);
                                            popup_items_qty.push({
                                                id: $this.closest('.selected-item_popup').attr('data-id-popup'),
                                                value: $this.val()
                                            });
                                        });

                                        fetch("/products/get-offer-menu-raws", {
                                            method: "post",
                                            headers: {
                                                "Content-Type": "application/json",
                                                Accept: "application/json",
                                                "X-Requested-With": "XMLHttpRequest",
                                                "X-CSRF-Token": $('input[name="_token"]').val()
                                            },
                                            credentials: "same-origin",
                                            body: JSON.stringify({ids: items_array})
                                        })
                                            .then(function (response) {
                                                return response.json();
                                            })
                                            .then(function (json) {
                                                console.log(json);

                                                const items_row = $(`[data-group-id="${button_group_id}"]`).find('.product-single-info_row-items');
                                                items_row.html(json.html);

                                                const selects = items_row.find('.select-2');
                                                selects.length > 0 && selects.each(function() {
                                                    $(this).select2({minimumResultsForSearch: -1});
                                                });
                                                $(`[data-group-id="${button_group_id}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                                                $(`[data-group-id="${button_group_id}"]`).closest('.product-single-info_row').find('.field-input').each(function () {
                                                    const d_id = $(this).attr('data-id');
                                                    const value = popup_items_qty.length > 0 && popup_items_qty.find((el) => {
                                                        return el.id === d_id;
                                                    }).value;
                                                    $(this).val(value);
                                                    $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
                                                });
                                                // setTotalPrice(countTotalPrice());

                                                countOfferPrice();
                                                countOfferTotalPrice();

                                                $('#wizardViewModal').modal('hide');

                                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                                                    $(this).closest('.menu-item-selected').remove();
                                                    setTotalPrice(countTotalPrice());
                                                });

                                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                                                    ev.preventDefault();
                                                    ev.stopImmediatePropagation();
                                                    const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                                    handleProductCountMinus($(this), $(`[data-group="${button_group_id}"]`), 'popup', limit);
                                                    setTotalPrice(countTotalPrice());

                                                });

                                                $(`[data-group="${button_group_id}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                                                    ev.preventDefault();
                                                    ev.stopImmediatePropagation();
                                                    const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');

                                                    handleProductCountPlus($(this), $(`[data-group="${button_group_id}"]`), 'popup', limit);
                                                    setTotalPrice(countTotalPrice());
                                                });

                                                // console.log('group_id', group_id);


                                            });
                                    });

                                    $('body').on('click', '#wizardViewModal .item-selected-footer', function() {
                                        let id = $(this).closest('.footer-list-item').attr('data-id');
                                        let name = $(this).closest('.footer-list-item').attr('data-name');
                                        activate_item($(`#wizardViewModal .content[data-id="${id}"]`).find('.item-content'), id, name);
                                        $(this).closest('.footer-list-item').remove();
                                    });
                                });
                            })();
                            // $(`#specialPopUpModal .filters-modal-wizard`).each(function (index) {
                            //     const group_id = $(this).attr('data-group');
                            //     const filter = [];
                            //
                            //     let dg = null;
                            //     let filter_limit = 0;
                            //
                            //     $("body").on('click', `.filters-modal-wizard[data-group="${group_id}"]`, function () {
                            //         dg = $(this).attr('data-group');
                            //         let group = $(this).attr('data-group');
                            //         filter_limit = $(this).closest('.limit').attr('data-limit');
                            //         const selectedIds = $(this).closest('.product-single-info_row').find('.menu-item-selected').toArray().map(function (item) {
                            //             return $(item).attr('data-id');
                            //         });
                            //         // console.log('index',index);
                            //         $.ajax({
                            //             type: "post",
                            //             url: "/products/select-items",
                            //             cache: false,
                            //             data: {
                            //                 group,
                            //                 selectedIds,
                            //                 type: "popup"
                            //             },
                            //             headers: {
                            //                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                            //             },
                            //             success: function (data) {
                            //                 if (!data.error) {
                            //                     $("#wizardViewModal .selected-items_filter").empty();
                            //                     $(`.filter[data-group-id="${group}"]`).closest('.product-single-info_row').find('.menu-item-selected').toArray().map((selectedItem) => {
                            //                         const selectedItemId = $(selectedItem).attr('data-id');
                            //                         const selectedItemTitle = $(selectedItem).find('.delete-menu-item').parent().text().trim();
                            //                         // $("#wizardViewModal .selected-items_filter").append(makeSelectedItemModal(selectedItemId, selectedItemTitle, true));
                            //                     });
                            //                     $("#wizardViewModal").modal();
                            //                 } else {
                            //                     alert("error");
                            //                 }
                            //             }
                            //         });
                            //     });
                            //
                            //     $("body").on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .wrap-item`, function (ev) {
                            //         const id = $(this).attr('data-id');
                            //         const title = $(this).find('.name').text().trim();
                            //         filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
                            //         // filter_limit > new_qty(null, 'filter') &&
                            //         if (!$(this).hasClass('active')) {
                            //             $(this).addClass('active');
                            //             // $('.selected-items_filter').append(makeSelectedItemModal(id, title, true));
                            //         } else if ($(this).hasClass('active')) {
                            //             $(`[data-id-popup="${id}"]`).remove();
                            //             $(this).removeClass('active');
                            //         }
                            //     });
                            //
                            //     $('body').on('click', '#wizardViewModal .selected-item-popup_qty-minus', function (ev) {
                            //         eventInitialDefault(ev);
                            //         $(this).siblings(".popup_field-input").val() > 1 && $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) - 1);
                            //     });
                            //
                            //     $('body').on('click', '#wizardViewModal .selected-item-popup_qty-plus', function (ev) {
                            //         eventInitialDefault(ev);
                            //         filter_limit = $(`.filters-modal-wizard[data-group="${$(this).closest('[data-group]').attr('data-group')}"]`).closest('.limit').attr('data-limit');
                            //         if (filter_limit > new_qty(null, 'filter')) {
                            //             $(this).siblings(".popup_field-input").val(Number($(this).siblings(".popup_field-input").val()) + 1);
                            //         }
                            //     });
                            //
                            //     $('body').on('click', '#wizardViewModal .selected-item_popup .delete-menu-item', function () {
                            //         const remove_id = $(this).attr('data-el-id');
                            //         $('#wizardViewModal').find(`.wrap-item[data-id="${remove_id}"]`).removeClass('active');
                            //         $(this).closest('.selected-item_popup').remove();
                            //     });
                            //
                            //
                            //     $('body').on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function () {
                            //         const items_array = [];
                            //         // console.log(2, '*****************************')
                            //
                            //         $('#wizardViewModal .modal-body').find('.wrap-item').each(function () {
                            //             $(this).hasClass('active') && (items_array.push($(this).attr('data-id')));
                            //         });
                            //
                            //         const popup_items_qty = [];
                            //         // console.log($(`[data-id-popup].selected-item_popup`).find('.popup_field-input'));
                            //         $(`[data-id-popup].selected-item_popup`).find('.popup_field-input').each(function () {
                            //             const $this = $(this);
                            //             popup_items_qty.push({
                            //                 id: $this.closest('.selected-item_popup').attr('data-id-popup'),
                            //                 value: $this.val()
                            //             });
                            //         });
                            //
                            //         fetch("/products/get-offer-menu-raws", {
                            //             method: "post",
                            //             headers: {
                            //                 "Content-Type": "application/json",
                            //                 Accept: "application/json",
                            //                 "X-Requested-With": "XMLHttpRequest",
                            //                 "X-CSRF-Token": $('input[name="_token"]').val()
                            //             },
                            //             credentials: "same-origin",
                            //             body: JSON.stringify({ids: items_array})
                            //         })
                            //             .then(function (response) {
                            //                 return response.json();
                            //             })
                            //             .then(function (json) {
                            //                 const items_row = $(`[data-group-id="${dg}"]`).find('.product-single-info_row-items');
                            //                 items_row.append(json.html);
                            //                 const selects = items_row.find('.select-2');
                            //                 selects.length > 0 && selects.each(function() {
                            //                     $(this).select2({minimumResultsForSearch: -1});
                            //                 });
                            //                 $(`[data-group-id="${dg}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                            //                 // $(`[data-group-id="${dg}"]`).closest('.product-single-info_row').find('.field-input').each(function () {
                            //                 //     const d_id = $(this).attr('data-id');
                            //                 //     const value = popup_items_qty.length > 0 && popup_items_qty.find((el) => {
                            //                 //         return el.id === d_id;
                            //                 //     }).value;
                            //                 //     $(this).val(value);
                            //                 //     $(this).closest('.menu-item-selected').find('.price-placee').html(getCurrencySymbol() + $(this).closest('.menu-item-selected').attr('data-price') * Number($(this).val()));
                            //                 // });
                            //                 countOfferPrice();
                            //                 countOfferTotalPrice();
                            //
                            //                 $('#wizardViewModal').modal('hide');
                            //
                            //
                            //
                            //                 $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                            //                     $(this).closest('.menu-item-selected').remove();
                            //                     setTotalPrice(countTotalPrice());
                            //                 });
                            //
                            //                 $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                            //                     ev.preventDefault();
                            //                     ev.stopImmediatePropagation();
                            //                     const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                            //
                            //                     handleProductCountMinus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
                            //                     setTotalPrice(countTotalPrice());
                            //
                            //                 });
                            //
                            //                 $(`[data-group="${dg}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                            //                     ev.preventDefault();
                            //                     ev.stopImmediatePropagation();
                            //                     const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                            //
                            //                     handleProductCountPlus($(this), $(`[data-group="${dg}"]`), 'popup', limit);
                            //                     setTotalPrice(countTotalPrice());
                            //                 });
                            //             });
                            //     });
                            //
                            //     $(this).on('click', function (e) {
                            //         const first_category_id = $(this).attr('data-action');
                            //         let self = $(this);
                            //         let selectMoreItems = [];
                            //         let selectSingleItems;
                            //
                            //         $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .item-content`, function () {
                            //             $('.shopping-cart_wrapper .item-content').removeClass('active');
                            //             $(this).addClass('active');
                            //         });
                            //
                            //         $body.on('click', `#wizardViewModal[data-group="${group_id}"] .add-items-btn`, function (e) {
                            //             eventInitialDefault(e);
                            //             // console.log(1, '*****************************')
                            //
                            //             $(`.filter[data-group-id="${group_id}"]`).find('.product-single-info_row-items').empty();
                            //
                            //             if (Number(self.attr('data-multiple')) === 1) {
                            //                 $(this).closest('.contents-wrapper').find('.wrap-item.active').each(function () {
                            //                     selectMoreItems.push($(this).attr('data-id'));
                            //                 });
                            //                 selectMoreItems.forEach((item) => {
                            //                     createInputHiddenForFilter(item, self);
                            //                 });
                            //             } else {
                            //                 selectSingleItems = $(this).closest('.contents-wrapper').find('.wrap-item.active').attr('data-id');
                            //                 createInputHiddenForFilter(selectSingleItems, self);
                            //             }
                            //
                            //             $('#wizardViewModal').modal('hide');
                            //         });
                            //
                            //         $.ajax({
                            //             type: "post",
                            //             url: "/filters",
                            //             cache: false,
                            //             data: {
                            //                 group: self.attr('data-group'),
                            //                 category_id: first_category_id,
                            //                 filters: filter,
                            //                 type: "popup"
                            //             },
                            //             headers: {
                            //                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                            //             },
                            //             success: function (data) {
                            //                 if (!data.error) {
                            //                     const modal_group_id = self.attr('data-group');
                            //                     $('#wizardViewModal').attr('data-group', modal_group_id);
                            //                     const contantPlace = $('.contents-wrapper .content');
                            //                     const wizardPlace = $('.shopping-cart-head .nav-pills');
                            //
                            //                     wizardPlace.empty();
                            //                     wizardPlace.append(data.wizard);
                            //                     if (data.type === "filter") {
                            //                         contantPlace.html(data.filters);
                            //                     } else if (data.type === "items") {
                            //                         contantPlace.html(data.items_html);
                            //                         makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
                            //                         $('.shopping-cart_wrapper .next-btn').addClass('d-none');
                            //                         $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
                            //                     }
                            //                 } else {
                            //                     alert("error");
                            //                 }
                            //             },
                            //             error: function (error) {
                            //                 filter.pop();
                            //             }
                            //         });
                            //
                            //         $body.on('click', `#wizardViewModal[data-group="${group_id}"] .shopping-cart_wrapper .next-btn`, function (e) {
                            //             eventInitialDefault(e);
                            //             $('.content-wrap').find('.active').toArray().map(function (actv) {
                            //                 filter.push($(actv).closest('[data-id]').attr('data-id'));
                            //             });
                            //             // console.log(filter);
                            //
                            //             $('.content-wrap').find('.active').length === 0 ? alert('select item') : $.ajax({
                            //                 type: "post",
                            //                 url: "/filters",
                            //                 cache: false,
                            //                 data: {
                            //                     group: self.attr('data-group'),
                            //                     category_id: first_category_id,
                            //                     filters: filter,
                            //                     type: "popup"
                            //                 },
                            //                 headers: {
                            //                     "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                            //                 },
                            //                 success: function (data) {
                            //                     if (!data.error) {
                            //                         $('.shopping-cart-head .nav-pills').empty();
                            //                         $('.shopping-cart-head .nav-pills').append(data.wizard);
                            //                         $('.back-btn').removeClass('d-none');
                            //                         if (data.type === "filter") {
                            //                             $('.contents-wrapper .content').html(data.filters);
                            //                         } else if (data.type === "items") {
                            //                             $('.contents-wrapper .content').html(data.items_html);
                            //                             $(`#wizardViewModal[data-group="${group_id}"] .selected-item_popup`).each(function () {
                            //                                 $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).length > 0
                            //                                 && $(this).closest('#wizardViewModal').find(`.wrap-item[data-id="${$(this).attr('data-id-popup')}"]`).addClass('active');
                            //                             });
                            //                             makeOutOfStockSelectOption($('#wizardViewModal'), 'filter');
                            //                             $('.shopping-cart_wrapper .next-btn').addClass('d-none');
                            //                             $('.shopping-cart_wrapper .add-items-btn').removeClass('d-none');
                            //                         }
                            //                     } else {
                            //                         alert("error");
                            //                     }
                            //                 },
                            //                 error: function (error) {
                            //                     filter.pop();
                            //                 }
                            //             });
                            //         });
                            //         $('body').on('click', '.shopping-cart_wrapper .back-btn', function (e) {
                            //             e.preventDefault();
                            //             e.stopImmediatePropagation();
                            //
                            //             filter.pop();
                            //             // console.log(filter)
                            //             $.ajax({
                            //                 type: "post",
                            //                 url: "/filters",
                            //                 cache: false,
                            //                 data: {
                            //                     group: self.attr('data-group'),
                            //                     category_id: first_category_id,
                            //                     filters: filter,
                            //                     type: 'popup'   //self.attr('data-type')
                            //                 },
                            //                 headers: {
                            //                     "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                            //                 },
                            //                 success: function (data) {
                            //                     if (!data.error) {
                            //
                            //                         $('.shopping-cart-head .nav-pills').empty();
                            //                         $('.shopping-cart-head .nav-pills').append(data.wizard);
                            //                         if (data.type === "filter") {
                            //                             $('.contents-wrapper .content').html(data.filters);
                            //                             $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
                            //                             $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
                            //                         } else if (data.type === "items") {
                            //                             $('.contents-wrapper .content').html(data.items_html);
                            //                         }
                            //                         if (filter.length === 0) {
                            //                             $('.shopping-cart_wrapper .back-btn').addClass('d-none');
                            //                         }
                            //                     } else {
                            //                         alert("error");
                            //                     }
                            //                 },
                            //                 error: function (error) {
                            //                     console.log(error);
                            //                 }
                            //             });
                            //         });
                            //     });
                            //     $('#wizardViewModal').on('hidden.bs.modal', function (e) {
                            //         filter.length = 0;
                            //         $('.shopping-cart_wrapper .next-btn').removeClass('d-none');
                            //         $('.shopping-cart_wrapper .back-btn').addClass('d-none');
                            //         $('.shopping-cart_wrapper .add-items-btn').addClass('d-none');
                            //         $('#wizardViewModal .selected-items_filter').empty();
                            //         $('#wizardViewModal .content-wrap .wrap-item').removeClass('active');
                            //     });
                            // });

                        };

                        filterModalSingleInit();

                        const filterSelectSingleInit = () => {
                            (function () {

                                $(`.add-product-modal .filters-select-wizard`).each(function () {
                                    const group_id = $(this).attr('data-group');

                                    $(`[data-group="${group_id}"]`).on('change', function () {
                                        let self = $(this);
                                        let parentRow = $(this).closest('.product__single-item-info-bottom');
                                        let data = parentRow.find('form#filter-form').serialize();
                                        const limit = $(this).closest('[data-limit]').attr('data-limit');

                                        AjaxCall("/filters",
                                            data,
                                            function (res) {
                                                if (!res.error) {
                                                    switch (res.type) {
                                                        case 'filter':
                                                            parentRow.find('.filter-children-items').empty();
                                                            parentRow.find('.filter-children-selects').html(res.filters);
                                                            Number(parentRow.find('.limit[data-limit]').attr('data-limit')) === 1
                                                            && parentRow.find('.limit[data-per-price]').attr('data-per-price') !== 'product'
                                                            && parentRow.find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').empty();
                                                            break;
                                                        case 'items':
                                                            const isMultiple = self.closest('[data-limit]').attr('data-limit') === '1' ? false : true;
                                                            parentRow.find('.filter-children-selects').html(res.filters);
                                                            parentRow.find('.filter-children-items').children().length === 0 && parentRow.find('.filter-children-items').html(res.items_html);
                                                            parentRow.find(".product--select-items").select2({
                                                                multiple: isMultiple,
                                                                placeholder: "Select Products",
                                                            });
                                                            makeOutOfStockSelectOption(parentRow.find(".product--select-items"), 'select');
                                                            if (isMultiple) {
                                                                // select2MaxLimit(parentRow.find('.product--select-items'), limit);
                                                            } else {
                                                                setTimeout(function () {
                                                                    const selectElementId = $(parentRow.find(".product--select-items").children()[0]).val();
                                                                    const id = parentRow.find(".product--select-items").val();
                                                                    selectHandle(self, id, selectElementId, limit, parentRow.find(".product--select-items"));
                                                                }, 0);

                                                            }
                                                            parentRow.find(".product--select-items").find('option[value=""]').remove();

                                                            break;
                                                    }
                                                }
                                            });
                                    });

                                    $(`[data-group="${group_id}"]`).on('select2:select', '.product--select-items', function (e) {
                                        const id = e.params.data.id;
                                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                                        const selectElementId = $(e.params.data.element).attr('data-select2-id');
                                        // console.log(1111111111111, e.params);
                                        selectHandle($(e.target), id, selectElementId, limit, $(this));
                                    });

                                    $(`[data-group="${group_id}"]`).on('select2:unselect', '.product--select-items', function (e) {
                                        // console.log(e)

                                        // const limit = $(this).closest('[data-limit]').attr('data-limit');
                                        unselectHandle($(this), e.params.data.id);
                                    });

                                    $(`[data-group="${group_id}"]`).on('click', '.product-count-minus', function (ev) {
                                        eventInitialDefault(ev);
                                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                                        const row = $(this).closest('.product-single-info_row');
                                        const select = row.find('.product--select-items');

                                        handleProductCountMinus($(this), select, 'select', limit);
                                        setTotalPrice(countTotalPrice());
                                    });

                                    $(`[data-group="${group_id}"]`).on('click', '.product-count-plus', function (ev) {
                                        eventInitialDefault(ev);
                                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                                        const row = $(this).closest('.product-single-info_row');
                                        const select = row.find('.product--select-items');

                                        handleProductCountPlus($(this), select, 'select', limit);
                                        setTotalPrice(countTotalPrice());
                                    });

                                    $(`[data-group="${group_id}"]`).on('click', '.remove-single_product-item', function () {
                                        // const limit = $(this).closest('[data-limit]').attr('data-limit');

                                        if ($(this).closest('.filters-select-wizard').length > 0) {
                                            const $this = $(this);
                                            const s_id = $this.attr('data-el-id');

                                            $(`.select2-selection__choice[data-select2-id="${s_id}"].select2-selection__choice__remove`).click();
                                            $(this).closest('.filters-select-wizard').find(`option[data-select2-id="${s_id}"]`);
                                            const deleted = $this.closest('.product__single-item-info-bottom').attr('data-id');
                                            const values = $(this).closest('.filters-select-wizard').find('.product--select-items').val().filter((value) => value !== deleted);
                                            // console.log('$this', $this, 's_id', s_id, 'deleted', deleted, 'values', values)
                                            $(this).closest('.filters-select-wizard').find('.product--select-items').val(values).trigger('change.select2');
                                            $this.closest('.menu-item-selected').remove();
                                            // select2MaxLimit($(this).closest('.filters-select-wizard').find('.product--select-items'), limit);
                                            setTotalPrice(countTotalPrice());
                                        }
                                    });
                                });

                            })();
                        };

                        filterSelectSingleInit();



                        const filterSelectOfferInit = () => {
                            (function () {

                                $(`#specialPopUpModal .filters-select-wizard`).each(function () {
                                    const group_id = $(this).attr('data-group');

                                    $(`[data-group="${group_id}"]`).on('change', function () {
                                        let self = $(this);
                                        let parentRow = $(this).closest('.product__single-item-info-bottom');
                                        let data = parentRow.find('form#filter-form').serialize();
                                        const limit = $(this).closest('[data-limit]').attr('data-limit');

                                        AjaxCall("/filters",
                                            data,
                                            function (res) {
                                                if (!res.error) {
                                                    switch (res.type) {
                                                        case 'filter':
                                                            parentRow.find('.filter-children-items').empty();
                                                            parentRow.find('.filter-children-selects').html(res.filters);
                                                            Number(parentRow.find('.limit[data-limit]').attr('data-limit')) === 1
                                                            && parentRow.find('.limit[data-per-price]').attr('data-per-price') !== 'product'
                                                            && parentRow.find('.filter .col-sm-2.pl-sm-3.p-0.text-sm-center').empty();
                                                            break;
                                                        case 'items':
                                                            const isMultiple = self.closest('[data-limit]').attr('data-limit') === '1' ? false : true;
                                                            parentRow.find('.filter-children-selects').html(res.filters);
                                                            parentRow.find('.filter-children-items').children().length === 0 && parentRow.find('.filter-children-items').html(res.items_html);
                                                            parentRow.find(".product--select-items").select2({
                                                                multiple: isMultiple,
                                                                placeholder: "Select Products",
                                                            });
                                                            makeOutOfStockSelectOption(parentRow.find(".product--select-items"), 'select');
                                                            if (isMultiple) {
                                                                // select2MaxLimit(parentRow.find('.product--select-items'), limit);
                                                            } else {
                                                                setTimeout(function () {
                                                                    const selectElementId = $(parentRow.find(".product--select-items").children()[0]).val();
                                                                    const id = parentRow.find(".product--select-items").val();
                                                                    selectOfferHandle(self, id, selectElementId, limit, parentRow.find(".product--select-items"));
                                                                    countOfferPrice();
                                                                }, 0);

                                                            }
                                                            parentRow.find(".product--select-items").find('option[value=""]').remove();

                                                            break;
                                                    }
                                                }
                                            });
                                    });

                                    $(`[data-group="${group_id}"]`).on('select2:select', '.product--select-items', function (e) {
                                        const id = e.params.data.id;
                                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                                        const selectElementId = $(e.params.data.element).attr('data-select2-id');
                                        // console.log(1111111111111, e.params);
                                        selectOfferHandle($(e.target), id, selectElementId, limit, $(this));
                                        countOfferPrice();
                                        countOfferTotalPrice();
                                    });

                                    $(`[data-group="${group_id}"]`).on('select2:unselect', '.product--select-items', function (e) {
                                        // console.log(e)

                                        // const limit = $(this).closest('[data-limit]').attr('data-limit');
                                        unselectHandle($(this), e.params.data.id);
                                        countOfferPrice();
                                        countOfferTotalPrice();
                                    });

                                    $(`[data-group="${group_id}"]`).on('click', '.product-count-minus', function (ev) {
                                        eventInitialDefault(ev);
                                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                                        const row = $(this).closest('.product-single-info_row');
                                        const select = row.find('.product--select-items');

                                        handleProductCountMinus($(this), select, 'select', limit);
                                        countOfferPrice();
                                        countOfferTotalPrice();
                                    });

                                    $(`[data-group="${group_id}"]`).on('click', '.product-count-plus', function (ev) {
                                        eventInitialDefault(ev);
                                        const limit = $(this).closest('[data-limit]').attr('data-limit');
                                        const row = $(this).closest('.product-single-info_row');
                                        const select = row.find('.product--select-items');

                                        handleProductCountPlus($(this), select, 'select', limit);
                                        countOfferPrice();
                                        countOfferTotalPrice();
                                    });

                                    $(`[data-group="${group_id}"]`).on('click', '.remove-single_product-item', function () {
                                        // const limit = $(this).closest('[data-limit]').attr('data-limit');

                                        if ($(this).closest('.filters-select-wizard').length > 0) {
                                            const $this = $(this);
                                            const s_id = $this.attr('data-el-id');

                                            $(`.select2-selection__choice[data-select2-id="${s_id}"].select2-selection__choice__remove`).click();
                                            $(this).closest('.filters-select-wizard').find(`option[data-select2-id="${s_id}"]`);
                                            const deleted = $this.closest('.product__single-item-info-bottom').attr('data-id');
                                            const values = $(this).closest('.filters-select-wizard').find('.product--select-items').val().filter((value) => value !== deleted);
                                            // console.log('$this', $this, 's_id', s_id, 'deleted', deleted, 'values', values)
                                            $(this).closest('.filters-select-wizard').find('.product--select-items').val(values).trigger('change.select2');
                                            $this.closest('.menu-item-selected').remove();
                                            // select2MaxLimit($(this).closest('.filters-select-wizard').find('.product--select-items'), limit);
                                            countOfferPrice();
                                            countOfferTotalPrice();
                                        }
                                    });
                                });

                            })();
                        };

                        $('body').on('click', '#specialPopUpModal .bottom-btn-cart', function() {

                            const activeProducts = $('body').find(' .special__popup-main-product-item.active');
                            const products = [];
                            //Edo
                            if(location.pathname === "/my-cart") {
                                if(activeProducts.length > 0) {
                                    activeProducts.each(function() {
                                        const product_id = $(this).data('id');
                                        const product_qty = 1;
                                        const variations = [];

                                        const pr_items = $(this).find('.pr-wrap');

                                        pr_items.each(function() {
                                            const group_id = $(this).data('group-id');
                                            const products = [];
                                            $(this).find('.product__single-item-info-bottom').each(function() {

                                                // console.log('.product__single-item-info-bottom', this);
                                                let id;
                                                let qty;
                                                let discount_id;
                                                if($(this).closest('.filter').length > 0 && $(this).hasClass('get-single-price')) {
                                                    id = $(this).data('id');
                                                    if($(this).find('.input-qty').length>0) {
                                                        qty = $(this).find('.input-qty').val();
                                                        discount_id = null;
                                                    } else if($(this).find('.select-qty').length>0) {
                                                        qty = null;
                                                        discount_id = $(this).find('.select-qty').val();
                                                    } else {
                                                        qty = '1';
                                                        discount_id = null;
                                                    }
                                                } else if($(this).find('.single-product-select').length > 0 && $(this).closest('.filter').length === 0) {
                                                    id = $(this).find('.single-product-select').val();
                                                    if($(this).find('.input-qty').length>0) {
                                                        qty = $(this).find('.input-qty').val();
                                                        discount_id = null;
                                                    } else if($(this).find('.select-qty').length>0) {
                                                        qty = null;
                                                        discount_id = $(this).find('.select-qty').val();
                                                    } else {
                                                        qty = '1';
                                                        discount_id = null;
                                                    }
                                                } else if($(this).find('.custom-control-input').length > 0) {
                                                    id = $(this).find('.custom-control-input:checked').val();
                                                    // console.log('id', id, $(this), $(this).find('.custom-control-input:checked'),  555555555);
                                                    if($(this).find('.input-qty').length>0) {
                                                        qty = $(this).find('.input-qty').val();
                                                        discount_id = null;
                                                    } else if($(this).find('.select-qty').length>0) {
                                                        qty = null;
                                                        discount_id = $(this).find('.select-qty').val();
                                                    } else {
                                                        qty = '1';
                                                        discount_id = null;
                                                    }
                                                } else if($(this).closest('.pr-wrap').find('.popup-select').length > 0) {
                                                    id = $(this).data('id');

                                                    if($(this).find('.input-qty').length>0) {
                                                        qty = $(this).find('.input-qty').val();
                                                        discount_id = null;
                                                    } else if($(this).find('.select-qty').length>0) {
                                                        qty = null;
                                                        discount_id = $(this).find('.select-qty').val();
                                                    } else {
                                                        qty = '1';
                                                        discount_id = null;
                                                    }
                                                } else if($(this).closest('.filter').length > 0 && $(this).hasClass('.get-single-price')) {
                                                    id = $(this).data('id');

                                                    if($(this).find('.input-qty').length>0) {
                                                        qty = $(this).find('.input-qty').val();
                                                        discount_id = null;
                                                    } else if($(this).find('.select-qty').length>0) {
                                                        qty = null;
                                                        discount_id = $(this).find('.select-qty').val();
                                                    } else {
                                                        qty = '1';
                                                        discount_id = null;
                                                    }
                                                }
                                                products.push({
                                                    id,
                                                    qty,
                                                    discount_id
                                                });
                                            });



                                            variations.push({
                                                group_id,
                                                products: products.filter(function(el) {
                                                    return el.id !== undefined;
                                                })
                                            });


                                        });
                                        products.push({product_id,product_qty, variations});
                                        // console.log(products);
                                    });


                                    fetch("/add-extra-to-cart", {
                                        method: "post",
                                        headers: {
                                            "Content-Type": "application/json",
                                            Accept: "application/json",
                                            "X-Requested-With": "XMLHttpRequest",
                                            "X-CSRF-Token": $('input[name="_token"]').val()
                                        },
                                        credentials: "same-origin",
                                        body: JSON.stringify({
                                            key: $('.special__popup-content').data('key'),
                                            product_id: $('.special__popup-content').data('product-id'),
                                            variations: products
                                        })
                                    }).then(function (response) {
                                        return response.json();
                                    })
                                        .then(function (data) {
                                            // $self.closest('.special__popup-main-product-item').addClass('active');
                                            // console.log($self.closest('.special__popup-main-product-item'));
                                            // btnAddToRemove($self);
                                            // $('.special__popup-content-right-item.added-offers').append(data.html);
                                            $(".cart-area").html(data.html);
                                            // addOfferEvent();
                                            $("#specialPopUpModal").modal('hide');

                                            // $('#headerShopCartBtn').click();
                                        })
                                        .catch(function (error) {
                                            console.log(error);
                                        });
                                } else {

                                }
                            } else {

                                if(activeProducts.length > 0) {
                                    activeProducts.each(function() {
                                        const product_id = $(this).data('id');
                                        const product_qty = 1;
                                        const variations = [];

                                        const pr_items = $(this).find('.pr-wrap');

                                        pr_items.each(function() {
                                            const group_id = $(this).data('group-id');
                                            const products = [];
                                            $(this).find('.product__single-item-info-bottom').each(function() {
                                                // console.log('.product__single-item-info-bottom', this)
                                                let id;
                                                let qty;
                                                let discount_id;

                                                if($(this).closest('.filter').length > 0 && $(this).hasClass('get-single-price')) {
                                                    // console.log(1111111111)
                                                    id = $(this).data('id');
                                                    if($(this).find('.input-qty').length>0) {
                                                        qty = $(this).find('.input-qty').val();
                                                        discount_id = null;
                                                    } else if($(this).find('.select-qty').length>0) {
                                                        qty = null;
                                                        discount_id = $(this).find('.select-qty').val();
                                                    } else {
                                                        qty = '1';
                                                        discount_id = null;
                                                    }
                                                } if($(this).find('.single-product-select').length > 0 && $(this).closest('.filter').length == 0) {
                                                    // console.log(222222222)

                                                    id = $(this).find('.single-product-select').val();
                                                    if($(this).find('.input-qty').length>0) {
                                                        qty = $(this).find('.input-qty').val();
                                                        discount_id = null;
                                                    } else if($(this).find('.select-qty').length>0) {
                                                        qty = null;
                                                        discount_id = $(this).find('.select-qty').val();
                                                    } else {
                                                        qty = '1';
                                                        discount_id = null;
                                                    }
                                                } else if($(this).find('.custom-control-input').length > 0) {
                                                    // console.log(333333333333)

                                                    id = $(this).find('.custom-control-input:checked').val();
                                                    // console.log('id', id, $(this), $(this).find('.custom-control-input:checked'),  555555555);
                                                    if($(this).find('.input-qty').length>0) {
                                                        qty = $(this).find('.input-qty').val();
                                                        discount_id = null;
                                                    } else if($(this).find('.select-qty').length>0) {
                                                        qty = null;
                                                        discount_id = $(this).find('.select-qty').val();
                                                    } else {
                                                        qty = '1';
                                                        discount_id = null;
                                                    }
                                                } else if($(this).closest('.pr-wrap').find('.popup-select').length > 0) {

                                                    id = $(this).data('id');

                                                    if($(this).find('.input-qty').length>0) {
                                                        qty = $(this).find('.input-qty').val();
                                                        discount_id = null;
                                                    } else if($(this).find('.select-qty').length>0) {
                                                        qty = null;
                                                        discount_id = $(this).find('.select-qty').val();
                                                    } else {
                                                        qty = '1';
                                                        discount_id = null;
                                                    }
                                                }
                                                products.push({
                                                    id,
                                                    qty,
                                                    discount_id
                                                });
                                            });



                                            variations.push({
                                                group_id,
                                                products: products.filter(function(el) {
                                                    return el.id !== undefined;
                                                })
                                            });


                                        });
                                        products.push({product_id,product_qty, variations});
                                        // console.log(products);
                                    });


                                    fetch("/add-extra-to-cart", {
                                        method: "post",
                                        headers: {
                                            "Content-Type": "application/json",
                                            Accept: "application/json",
                                            "X-Requested-With": "XMLHttpRequest",
                                            "X-CSRF-Token": $('input[name="_token"]').val()
                                        },
                                        credentials: "same-origin",
                                        body: JSON.stringify({
                                            key: $('.special__popup-content').data('key'),
                                            product_id: $('.special__popup-content').data('product-id'),
                                            variations: products
                                        })
                                    }).then(function (response) {
                                        return response.json();
                                    })
                                        .then(function (data) {
                                            // $self.closest('.special__popup-main-product-item').addClass('active');
                                            // console.log($self.closest('.special__popup-main-product-item'));
                                            // btnAddToRemove($self);
                                            // $('.special__popup-content-right-item.added-offers').append(data.html);
                                            $("#specialPopUpModal").modal('hide');
                                            $("#headerShopCartBtn").click();
                                        })
                                        .catch(function (error) {
                                            console.log(error);
                                        });
                                } else {

                                }
                            }



                        });







                        $('body').on('change', '[data-discount-type] input, [data-discount-type] select', function(ev) {
                            const discount_type = $(ev.target).closest('[data-discount-type]').attr('data-discount-type');
                            discountInputChange($(ev), $(ev.target), discount_type);
                        });

                        setTotalPrice();

                        let initCount = 0,
                            initPopupCount = 0,
                            initFilterModalCount = 0;



                        let dg_popup;

                        $("body").on('click', `.popup-select`, function() {
                            const $this = $(this);
                            const selected_ids = [];
                            $this.closest('.limit.pr-wrap').length > 0 && setTimeout(function() {
                                $this.closest('.limit.pr-wrap').css('border', 'none');
                            }, 1000)
                            if($(this).closest('.add-product-modal').length > 0) {
                                $('#popUpModal').attr('product-or-offer', 'product');
                            } else if($(this).closest('#specialPopUpModal').length > 0) {
                                $('#popUpModal').attr('product-or-offer', 'offer');
                            }

                            dg_popup = $this.data('group');
                            $this.closest('.product__single-item-info').find('.product__single-item-info-bottom').length > 0 && $this.closest('.product__single-item-info').find('.product__single-item-info-bottom').each(function() {
                                selected_ids.push($(this).data('id'));
                            });
                            // console.log('selected_ids', selected_ids)
                            $.ajax({
                                type: "post",
                                url: "/products/select-items",
                                cache: false,
                                data: {
                                    group: dg_popup,
                                    ids: selected_ids
                                },
                                headers: {
                                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                                },
                                success: function (data) {
                                    if (!data.error) {
                                        $("#popUpModal .modal-content").html(data.html);
                                        // $('#popUpModal .title_popup').text(`You can add ${limit} product`);
                                        // makeSelectedItem(data_group_id);
                                        $("#popUpModal").attr('data-group', dg_popup);
                                        makeOutOfStockSelectOption($("#popUpModal .modal-content"), 'popup');
                                        $("#popUpModal").attr('limit', $this.closest('.product__single-item-info.limit').data('limit') || $this.closest('.pr-wrap.limit').data('limit'));
                                        $("#popUpModal").modal();
                                    } else {
                                        console.log(data.error);
                                    }
                                }
                            });
                        });
//[data-group="${dg_popup}"]
                        $("body").on('click', `#popUpModal .single-item-wrapper .single-item`, function (ev) {
                            console.log(181818, '-------')
                            const offer = $(this).closest('#popUpModal').attr('product-or-offer') === 'offer';
                            const id = $(this).closest(".single-item-wrapper").attr('data-id');
                            const title = $(this).find('.name-item').text().trim();
                            const selectedCount = $(this).closest('.modal-body').find('.single-item-wrapper.active').length;
                            const limit = $(this).closest('#popUpModal').attr('limit')*1;
                            const group = $(this).closest('#popUpModal').attr('data-group');
                            const selectedItemsCountInPage = $('.add-product-modal').find(`[data-group-id="${group}"]`).find('.product__single-item-info-bottom').length || $('#specialPopUpModal').find(`[data-group-id="${group}"]`).find('.product__single-item-info-bottom').length;
                            console.log({
                                id,
                                title,
                                selectedCount,
                                limit,
                                group,
                                offer,
                                selectedItemsCountInPage
                            });
                            if (!$(this).closest(".single-item-wrapper").hasClass('active') && selectedCount + 1 + selectedItemsCountInPage <= limit) {
                                $(this).closest(".single-item-wrapper").addClass('active');
                                // $(this).closest('.modal').find('.selected-items_popup')
                                //     .append(makeSelectedItemModal(id, title));
                            } else if ($(this).closest(".single-item-wrapper").hasClass('active')) {
                                // $(`[data-id-popup="${id}"]`).remove();
                                $(this).closest(".single-item-wrapper").removeClass('active');
                            }
                        });

                        $("body").on('click', `#popUpModal .modal-footer .b_save`, function () {
                            const items_value_array = [];
                            const items_array = [];
                            $('#popUpModal').find('.single-item-wrapper.active').each(function () {
                                items_value_array.push({
                                    id: $(this).data('id'),
                                    value: 1
                                    // $(this).find('.selected-item-popup_qty-select').val()
                                });
                                items_array.push($(this).data('id'));
                            });

                            if($(this).closest('#popUpModal').attr('product-or-offer') === 'product') {
                                fetch("/products/get-variation-menu-raws", {
                                    method: "post",
                                    headers: {
                                        "Content-Type": "application/json",
                                        Accept: "application/json",
                                        "X-Requested-With": "XMLHttpRequest",
                                        "X-CSRF-Token": $('input[name="_token"]').val()
                                    },
                                    credentials: "same-origin",
                                    body: JSON.stringify({
                                        ids: items_array,
                                        items: items_value_array
                                    })
                                })
                                    .then(function (response) {
                                        return response.json();
                                    })
                                    .then(function (json) {
                                        const selected_product_wrapper = $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').find('.product-single-info_row-items');

                                        $(`.product__single-item-info[data-group-id="${dg_popup}"]`).append(json.html);
                                        $(`.product__single-item-info[data-group-id="${dg_popup}"]`).find('.select-2').each(function() {
                                            $(this).select2({minimumResultsForSearch: -1});
                                        });
                                        selected_product_wrapper.empty();
                                        selected_product_wrapper.append(json.html);

                                        json.items.map((item) => {
                                            const item_price = Number(selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).attr('data-price'));
                                            selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.product-qty').val(Number(item.value));
                                            selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.price-placee').html(`${getCurrencySymbol()}${item_price * Number(item.value)}`);
                                        });
                                        $(`.product__single-item-info[data-group-id="${dg_popup}"]`).closest('.product__single-item-info').css('border-color', '#d7d7d7');
                                        // setTotalPrice(modal);
                                        setTotalPrice(countTotalPrice());
                                        $('#popUpModal').modal('hide');

                                        $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                                            $(this).closest('.menu-item-selected').remove();
                                            setTotalPrice(countTotalPrice());
                                        });

                                        // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                                        //     eventInitialDefault(ev);
                                        //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                                        //
                                        //     // handleProductCountMinus($(this), $(`[data-group="${data_group_id}"]`), 'popup', limit);
                                        //     // setTotalPrice(modal);
                                        // });
                                        //
                                        // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                                        //     eventInitialDefault(ev);
                                        //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                                        //
                                        //     // handleProductCountPlus($(this), $(`[data-group="${dg_popup}"]`), 'popup', limit);
                                        //     // setTotalPrice(modal);
                                        // });
                                    });
                            } else if($(this).closest('#popUpModal').attr('product-or-offer') === 'offer') {
                                fetch("/products/get-offer-menu-raws", {
                                    method: "post",
                                    headers: {
                                        "Content-Type": "application/json",
                                        Accept: "application/json",
                                        "X-Requested-With": "XMLHttpRequest",
                                        "X-CSRF-Token": $('input[name="_token"]').val()
                                    },
                                    credentials: "same-origin",
                                    body: JSON.stringify({
                                        ids: items_array,
                                        items: items_value_array
                                    })
                                })
                                    .then(function (response) {
                                        return response.json();
                                    })
                                    .then(function (json) {
                                        const selected_product_wrapper = $(`.pr-wrap[data-group-id="${dg_popup}"]`);
                                        // console.log(111111111111111111, selected_product_wrapper, dg_popup)
                                        selected_product_wrapper.append(json.html);


                                        // $(`.product__single-item-info[data-group-id="${dg_popup}"]`).append(json.html);
                                        $(`.pr-wrap[data-group-id="${dg_popup}"]`).find('.select-2').each(function() {
                                            $(this).select2({minimumResultsForSearch: -1});
                                        });

                                        // $(this).closest('.product__single-item-info-bottom').find('.get-single-price').data('single-price', data.price)
                                        countOfferPrice();

                                        // selected_product_wrapper.find('.product__single-item-info-bottom').remove();
                                        //
                                        //
                                        // json.items.map((item) => {
                                        //     const item_price = Number(selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).attr('data-price'));
                                        //     selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.product-qty').val(Number(item.value));
                                        //     selected_product_wrapper.find(`.menu-item-selected[data-id="${item.id}"]`).find('.price-placee').html(`${getCurrencySymbol()}${item_price * Number(item.value)}`);
                                        // });

                                        // setTotalPrice(modal);
                                        // setTotalPrice(countTotalPrice());
                                        $('#popUpModal').modal('hide');

                                        $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.delete-menu-item', function () {
                                            $(this).closest('.menu-item-selected').remove();
                                            setTotalPrice(countTotalPrice());
                                        });

                                        // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-minus', function (ev) {
                                        //     eventInitialDefault(ev);
                                        //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                                        //
                                        //     // handleProductCountMinus($(this), $(`[data-group="${data_group_id}"]`), 'popup', limit);
                                        //     // setTotalPrice(modal);
                                        // });
                                        //
                                        // $(`[data-group="${dg_popup}"]`).closest('.product-single-info_row').on('click', '.product-count-plus', function (ev) {
                                        //     eventInitialDefault(ev);
                                        //     // const limit = $(this).closest('.product-single-info_row').find('.limit[data-limit]').attr('data-limit');
                                        //
                                        //     // handleProductCountPlus($(this), $(`[data-group="${dg_popup}"]`), 'popup', limit);
                                        //     // setTotalPrice(modal);
                                        // });
                                    });
                            }


                        });


                        $("body").on('click', ".select-extra", function () {
                            $("#extraModal").find(".select-extra").removeClass("active");
                            $(this).addClass("active");
                            AjaxCall("/products/get-extra-item", {
                                id: $(this).attr('data-id'),
                                group: $(this).attr('data-group')
                            }, function (res) {
                                if (!res.error) {
                                    $("#extraModal").find(".extra-main-content").html(res.html);
                                    const selectedExtra = selectedGroupId.find(({group}) => {
                                        return group === $(`#extraModal [data-group-id]`).attr('data-group-id');
                                    });

                                    if (selectedExtra) {
                                        $(`#extraModal [data-group-id]`).closest('.product-single-info_row ').addClass('pointer-events-none');
                                        $('#extraModal .product-card_btn').removeClass('d-inline-flex').addClass('d-none');
                                        $('#extraModal .product-card_edit').removeClass('d-none').addClass('d-inline-flex');
                                        $("#extraModal").find(".extra-main-content").html(selectedExtra.view);
                                        productsInit(true, res.type);
                                    } else {
                                        $('#extraModal .product-card_btn').removeClass('d-none').addClass('d-inline-flex');
                                        $('#extraModal .product-card_edit').removeClass('d-inline-flex').addClass('d-none');
                                        productsInit(true, res.type);
                                    }
                                }
                            });
                        });



                        $('#extraModal').on('hidden.bs.modal', function () {
                            $(this).find('.extra-main-content').empty();
                            $("#extraModal .modal-price-place-summary").html(getCurrencySymbol() + '0');
                            !isCartPage() && $('#headerShopCartBtn').click();
                            selectedGroupId.length = 0;
                        });
                        // productsInit();

                        $("body").on('click', '.bottom-btn-cart.no-btn', function() {
                            $("#specialPopUpModal").modal('hide');
                            setTimeout(function() {
                                $("#headerShopCartBtn").click();
                            }, 0);

                        });

                        $("body").on('click', '.btn-add-to-cart', function () {
                            const product_id = $('.add-product-modal #vpid').val();
                            const product_qty = $('.continue-shp-wrapp_qty .field-input.product-qty-select').val();
                            const variations = [];
                            const bad = [];
                            const product__single_items = $('.product__single-item-info');

                            product__single_items.each(function() {
                                const group_id = $(this).data('group-id');
                                let products = [];
                                $(this).find('.product__single-item-info-bottom').each(function() {
                                    let id;
                                    let qty;
                                    let discount_id;
                                    if($(this).closest('.filter').length > 0) {
                                        id = $(this).data('id');
                                        if($(this).find('.input-qty').length>0) {
                                            qty = $(this).find('.input-qty').val();
                                            discount_id = null;
                                        } else if($(this).find('.select-qty').length>0) {
                                            qty = null;
                                            discount_id = $(this).find('.select-qty').val();
                                        } else {
                                            qty = '1';
                                            discount_id = null;
                                        }
                                    } else {
                                        if($(this).find('.single-product-select').length > 0) {
                                            id = $(this).find('.single-product-select').val();
                                            if($(this).find('.input-qty').length>0) {
                                                qty = $(this).find('.input-qty').val();
                                                discount_id = null;
                                            } else if($(this).find('.select-qty').length>0) {
                                                qty = null;
                                                discount_id = $(this).find('.select-qty').val();
                                            } else {
                                                qty = '1';
                                                discount_id = null;
                                            }
                                        } else if($(this).find('.custom-control-input').length > 0) {
                                            id = $(this).find('.custom-control-input:checked').val();

                                            if($(this).find('.input-qty').length>0) {
                                                qty = $(this).find('.input-qty').val();
                                                discount_id = null;
                                            } else if($(this).find('.select-qty').length>0) {
                                                qty = null;
                                                discount_id = $(this).find('.select-qty').val();
                                            } else {
                                                qty = '1';
                                                discount_id = null;
                                            }
                                        } else if($(this).closest('.product__single-item-info').find('.popup-select').length > 0) {
                                            id = $(this).data('id');

                                            if($(this).find('.input-qty').length>0) {
                                                qty = $(this).find('.input-qty').val();
                                                discount_id = null;
                                            } else if($(this).find('.select-qty').length>0) {
                                                qty = null;
                                                discount_id = $(this).find('.select-qty').val();
                                            } else {
                                                qty = '1';
                                                discount_id = null;
                                            }
                                        }
                                    }

                                    id === 'no' ? (products = 'no') : products.push({
                                        id,
                                        qty,
                                        discount_id
                                    });
                                });

                                variations.push({
                                    group_id,
                                    products: products !== 'no' ? products.filter(function(el) {
                                        return el.id !== undefined;
                                    }) : 'no'
                                });


                            });
                            // console.log({product_id,product_qty, variations});
                            variations.map((gr) => {
                                const minLimit = $('.add-product-modal').find(`[data-group-id="${gr.group_id}"]`).attr('data-min-limit')*1;
                                const maxLimit = $('.add-product-modal').find(`[data-group-id="${gr.group_id}"]`).attr('data-limit')*1;
                                console.log(gr.group_id, minLimit)
                                gr.products.length < minLimit && minLimit !== 0 && bad.push(gr.group_id);
                            });
                            // console.log(variations);
                            if(bad.length !== 0) {
                                bad.map(function(group_id) {
                                    $(`.product__single-item-info[data-group-id="${group_id}"]`).css('border-color', 'red');
                                });
                                return false;
                            } else {
                                $.ajax({
                                    type: "post",
                                    url: "/add-to-cart",
                                    cache: false,
                                    datatype: "json",
                                    data: {product_id, product_qty, variations},
                                    headers: {
                                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                                    },
                                    success: function (data) {
                                        if (!data.error) {

                                            if(data.message === 'added') {
                                                $('#cartSidebar').html(data.headerHtml);
                                                $('.add-cart-number.cart-count').html(data.count);
                                                $('#specialPopUpModal .modal-body').html(data.specialHtml);
                                                $('.special__popup-main-product-item .select-2').each(function() {
                                                    $(this).select2({minimumResultsForSearch: -1});
                                                });
                                                filterModalOfferInit();
                                                filterSelectOfferInit();
                                                countOfferPrice();
                                                $("#specialPopUpModal").modal();
                                            }

                                            // $(".cart-count").html(data.count);
                                            // $('#cartSidebar').html(data.headerHtml);
                                            // addDataKey.key = data.key;
                                            // addDataKey.product_id = data.product_id;
                                            // AjaxCall("/products/get-extra-content", {id: $("#vpid").val()}, function (res) {
                                            //     if (!res.error) {
                                            //         $("#extraModal .modal-body").html(res.html);
                                            //         productsInit();
                                            //         $("#extraModal").modal();
                                            //     }
                                            // });
                                            //
                                            // $('#extraModal .extra-content-left .select-extra.item.active').click();
                                        } else {
                                            //test
                                            // alert(data.message);
                                        }
                                    }
                                });
                            }
                        });

                        $('#specialPopUpModal').on('hidden.bs.modal', function (e) {
                            // $('#cartSidebar').empty();
                            // $('.add-cart-number.cart-count').empty();
                            $('#specialPopUpModal .modal-body').empty();
                        });

                        $("body").on('click', '.bottom-btn-cart.no-btn', function() {
                            $("#specialPopUpModal").modal('hide');
                            setTimeout(function() {
                                $("#headerShopCartBtn").click();
                            }, 0);

                        });

                        $("body").on('click', '.btn-add-to-cart-manual', function () {
                            const product_id = $("body").find('#vpid').val();
                            const user_id = $("body").find('#order_user').val();
                            const product_qty = $('.continue-shp-wrapp_qty .field-input.product-qty-select').val();
                            const variations = [];
                            const bad = [];
                            const product__single_items = $('.product__single-item-info');

                            product__single_items.each(function() {
                                const group_id = $(this).data('group-id');
                                const products = [];
                                $(this).find('.product__single-item-info-bottom').each(function() {
                                    let id;
                                    let qty;
                                    let discount_id;
                                    if($(this).closest('.filter').length > 0) {
                                        id = $(this).data('id');
                                        if($(this).find('.input-qty').length>0) {
                                            qty = $(this).find('.input-qty').val();
                                            discount_id = null;
                                        } else if($(this).find('.select-qty').length>0) {
                                            qty = null;
                                            discount_id = $(this).find('.select-qty').val();
                                        } else {
                                            qty = '1';
                                            discount_id = null;
                                        }
                                    } else {
                                        if($(this).find('.single-product-select').length > 0) {
                                            id = $(this).find('.single-product-select').val();
                                            if($(this).find('.input-qty').length>0) {
                                                qty = $(this).find('.input-qty').val();
                                                discount_id = null;
                                            } else if($(this).find('.select-qty').length>0) {
                                                qty = null;
                                                discount_id = $(this).find('.select-qty').val();
                                            } else {
                                                qty = '1';
                                                discount_id = null;
                                            }
                                        } else if($(this).find('.custom-control-input').length > 0) {
                                            id = $(this).find('.custom-control-input:checked').val();

                                            if($(this).find('.input-qty').length>0) {
                                                qty = $(this).find('.input-qty').val();
                                                discount_id = null;
                                            } else if($(this).find('.select-qty').length>0) {
                                                qty = null;
                                                discount_id = $(this).find('.select-qty').val();
                                            } else {
                                                qty = '1';
                                                discount_id = null;
                                            }
                                        } else if($(this).closest('.product__single-item-info').find('.popup-select').length > 0) {
                                            id = $(this).data('id');

                                            if($(this).find('.input-qty').length>0) {
                                                qty = $(this).find('.input-qty').val();
                                                discount_id = null;
                                            } else if($(this).find('.select-qty').length>0) {
                                                qty = null;
                                                discount_id = $(this).find('.select-qty').val();
                                            } else {
                                                qty = '1';
                                                discount_id = null;
                                            }
                                        }
                                    }
                                    products.push({
                                        id,
                                        qty,
                                        discount_id
                                    });
                                });

                                variations.push({
                                    group_id,
                                    products: products.filter(function(el) {
                                        return el.id !== undefined;
                                    })
                                });


                            });
                            console.log({product_id,product_qty,user_id, variations});
                            variations.map((gr) => {
                                gr.products.length === 0 && bad.push(gr.group_id);
                            });
                            if(bad.length !== 0) {
                                bad.map(function(group_id) {
                                    $(`.product__single-item-info[data-group-id="${group_id}"]`).css('border-color', 'red');
                                });
                                return false;
                            } else {
                                $.ajax({
                                    type: "post",
                                    url: "/admin/orders/invoices/add-to-cart",
                                    cache: false,
                                    datatype: "json",
                                    data: {product_id,product_qty,user_id, variations},
                                    headers: {
                                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                                    },
                                    success: function (data) {
                                        if (!data.error) {

                                            if(data.message === 'added') {
                                                $('#cartSidebar').html(data.headerHtml);
                                                $('.add-cart-number.cart-count').html(data.count);
                                                $('#specialPopUpModal .modal-body').html(data.specialHtml);
                                                $('.special__popup-main-product-item .select-2').each(function() {
                                                    $(this).select2({minimumResultsForSearch: -1});
                                                });

                                                $(".cart-table").html(data.html);
                                                $(".shipping-payment").html(data.shippingHtml);
                                                $(".order-summary").html(data.summaryHtml);

                                                filterModalOfferInit();
                                                filterSelectOfferInit();
                                                countOfferPrice();
                                                $("#specialPopUpModal").modal();
                                            }

                                            // $(".cart-count").html(data.count);
                                            // $('#cartSidebar').html(data.headerHtml);
                                            // addDataKey.key = data.key;
                                            // addDataKey.product_id = data.product_id;
                                            // AjaxCall("/products/get-extra-content", {id: $("#vpid").val()}, function (res) {
                                            //     if (!res.error) {
                                            //         $("#extraModal .modal-body").html(res.html);
                                            //         productsInit();
                                            //         $("#extraModal").modal();
                                            //     }
                                            // });
                                            //
                                            // $('#extraModal .extra-content-left .select-extra.item.active').click();
                                        } else {
                                            //test
                                            // alert(data.message);
                                        }
                                    }
                                });
                            }
                        });




                        $("body").on("click", ".extra-sections", function () {
                            let id = $(this).attr('data-product-id');
                            let key = $(this).attr('data-key');
                            AjaxCall("/products/get-extra-content", {id: id}, function (res) {
                                if (!res.error) {
                                    $("#extraModal .modal-body").html(res.html);
                                    productsInit();
                                    addDataKey.product_id = id;
                                    addDataKey.key = key;
                                    $("#extraModal").modal();
                                    $('#extraModal .extra-content-left .select-extra.item.active').click();
                                }
                            });
                        });

                        $('.shopping-cart-inner').find('.product-qty-select').addClass('none-touchable');

                        // $("body").on('click', '.qty-count', function (ev) {
                        //     const inCartList = typeof ev.originalEvent.path.find((path) => {
                        //         return $(path).hasClass('shopping-cart-inner');
                        //     }) !== "undefined";
                        //     if (inCartList) {
                        //         return;
                        //     } else {
                        //         let qty = $('.product-qty-select').val();
                        //         let type = $(this).data('type');
                        //         if (type == 'plus') {
                        //             qty = parseInt(qty) + 1;
                        //             $('.product-qty-select').val(qty);
                        //             setTotalPrice();
                        //         } else {
                        //             if (qty > 1) {
                        //                 qty -= 1;
                        //                 $('.product-qty-select').val(qty);
                        //                 setTotalPrice();
                        //             }
                        //         }
                        //     }
                        // });


                        // function addOfferEvent() {
                        //     $("body").find().each(function() {

                        // const items = [];
                        // $(this).closest('.footer').find('.remove-extra-from-cart').each(function() {
                        //     items.push($(this).data('uid'));
                        // });
                        $("body").on('click', '.add-offers-btn', function(ev) {
                            const item_id = $(this).data('uid');
                            eventInitialDefault(ev);

                            $.ajax({
                                type: "post",
                                url: "/my-cart-special-offer",
                                cache: false,
                                datatype: "json",
                                data: {item_id},
                                headers: {
                                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                                },
                                success: function (data) {
                                    if (!data.error) {
                                        console.log(data.html)
                                        $('#specialPopUpModal .modal-body').html(data.html);

                                        $('#specialPopUpModal .modal-body').find('.select-2').select2({minimumResultsForSearch: -1});
                                        $('.special__popup-content-right-product').each(function() {
                                            if($(`.special__popup-main-product-item[data-id="${$(this).data('id')}"]`).length > 0) {
                                                $(`.special__popup-main-product-item[data-id="${$(this).data('id')}"]`).addClass('user-non-select');
                                            }
                                        });
                                        $('.user-non-select').find('.special__popup-main-product-item-btn').removeClass('add-btn').addClass('remove-btn').html('remove');
                                        filterModalOfferInit();
                                        filterSelectOfferInit();
                                        countOfferPrice();
                                        countOfferTotalPrice();
                                        $('#specialPopUpModal .product__single-item_price').each(function() {
                                            $(this).closest('.special__popup-main-product-item-price').length === 0 && $(this).css('display', 'none')
                                        });
                                        $("#specialPopUpModal").modal();
                                        // if(data.message === 'added') {
                                        //     $('#cartSidebar').html(data.headerHtml);
                                        //     $('.add-cart-number.cart-count').html(data.count);
                                        //     $('#specialPopUpModal .modal-body').html(data.specialHtml);
                                        //     $('.special__popup-main-product-item .select-2').each(function() {
                                        //         $(this).select2();
                                        //     });
                                        //     filterModalOfferInit();
                                        //     filterSelectOfferInit();
                                        //     countOfferPrice();
                                        //     $("#specialPopUpModal").modal();
                                        // }

                                        // $(".cart-count").html(data.count);
                                        // $('#cartSidebar').html(data.headerHtml);
                                        // addDataKey.key = data.key;
                                        // addDataKey.product_id = data.product_id;
                                        // AjaxCall("/products/get-extra-content", {id: $("#vpid").val()}, function (res) {
                                        //     if (!res.error) {
                                        //         $("#extraModal .modal-body").html(res.html);
                                        //         productsInit();
                                        //         $("#extraModal").modal();
                                        //     }
                                        // });
                                        //
                                        // $('#extraModal .extra-content-left .select-extra.item.active').click();
                                    } else {
                                        //test
                                        // alert(data.message);
                                    }
                                }
                            });
                        });


                        //
                        //
                        //
                        //
                        //
                        //
                        //
                        //
                        //
                        //
                        //
                        //
                        //
                        //
                        //
                        //
                        //
                        // $("body").on("click", ".extra-sections", function () {
                        //     let id = $(this).attr('data-product-id');
                        //     let key = $(this).attr('data-key');
                        //     AjaxCall("/products/get-extra-content", {id: id}, function (res) {
                        //         if (!res.error) {
                        //             $("#extraModal .modal-body").html(res.html);
                        //             productsInit();
                        //             addDataKey.product_id = id;
                        //             addDataKey.key = key;
                        //             $("#extraModal").modal();
                        //             $('#extraModal .extra-content-left .select-extra.item.active').click();
                        //         }
                        //     });
                        // });
                        //
                        // $('.shopping-cart-inner').find('.product-qty-select').addClass('none-touchable');
                        //
                        // // $("body").on('click', '.qty-count', function (ev) {
                        // //     const inCartList = typeof ev.originalEvent.path.find((path) => {
                        // //         return $(path).hasClass('shopping-cart-inner');
                        // //     }) !== "undefined";
                        // //     if (inCartList) {
                        // //         return;
                        // //     } else {
                        // //         let qty = $('.product-qty-select').val();
                        // //         let type = $(this).data('type');
                        // //         if (type == 'plus') {
                        // //             qty = parseInt(qty) + 1;
                        // //             $('.product-qty-select').val(qty);
                        // //             setTotalPrice();
                        // //         } else {
                        // //             if (qty > 1) {
                        // //                 qty -= 1;
                        // //                 $('.product-qty-select').val(qty);
                        // //                 setTotalPrice();
                        // //             }
                        // //         }
                        // //     }
                        // // });
                        //
                        //
                        // // function addOfferEvent() {
                        // //     $("body").find().each(function() {
                        //
                        // // const items = [];
                        // // $(this).closest('.footer').find('.remove-extra-from-cart').each(function() {
                        // //     items.push($(this).data('uid'));
                        // // });
                        // $("body").on('click', '.add-offers-btn', function(ev) {
                        //     const item_id = $(this).data('uid');
                        //     eventInitialDefault(ev);
                        //
                        //     $.ajax({
                        //         type: "post",
                        //         url: "/my-cart-special-offer",
                        //         cache: false,
                        //         datatype: "json",
                        //         data: {item_id},
                        //         headers: {
                        //             "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        //         },
                        //         success: function (data) {
                        //             if (!data.error) {
                        //                 // console.log(data.html)
                        //                 $('#specialPopUpModal .modal-body').html(data.html);
                        //
                        //                 $('#specialPopUpModal .modal-body').find('.select-2').select2({minimumResultsForSearch: -1});
                        //                 $('.special__popup-content-right-product').each(function() {
                        //                     if($(`.special__popup-main-product-item[data-id="${$(this).data('id')}"]`).length > 0) {
                        //                         $(`.special__popup-main-product-item[data-id="${$(this).data('id')}"]`).addClass('user-non-select');
                        //                     }
                        //                 });
                        //                 $('.user-non-select').find('.special__popup-main-product-item-btn').removeClass('add-btn').addClass('remove-btn').html('remove');
                        //                 filterModalOfferInit();
                        //                 filterSelectOfferInit();
                        //                 countOfferPrice();
                        //                 countOfferTotalPrice();
                        //                 $('#specialPopUpModal .product__single-item_price').each(function() {
                        //                     $(this).closest('.special__popup-main-product-item-price').length === 0 && $(this).css('display', 'none')
                        //                 });
                        //                 $("#specialPopUpModal").modal();
                        //                 // if(data.message === 'added') {
                        //                 //     $('#cartSidebar').html(data.headerHtml);
                        //                 //     $('.add-cart-number.cart-count').html(data.count);
                        //                 //     $('#specialPopUpModal .modal-body').html(data.specialHtml);
                        //                 //     $('.special__popup-main-product-item .select-2').each(function() {
                        //                 //         $(this).select2();
                        //                 //     });
                        //                 //     filterModalOfferInit();
                        //                 //     filterSelectOfferInit();
                        //                 //     countOfferPrice();
                        //                 //     $("#specialPopUpModal").modal();
                        //                 // }
                        //
                        //                 // $(".cart-count").html(data.count);
                        //                 // $('#cartSidebar').html(data.headerHtml);
                        //                 // addDataKey.key = data.key;
                        //                 // addDataKey.product_id = data.product_id;
                        //                 // AjaxCall("/products/get-extra-content", {id: $("#vpid").val()}, function (res) {
                        //                 //     if (!res.error) {
                        //                 //         $("#extraModal .modal-body").html(res.html);
                        //                 //         productsInit();
                        //                 //         $("#extraModal").modal();
                        //                 //     }
                        //                 // });
                        //                 //
                        //                 // $('#extraModal .extra-content-left .select-extra.item.active').click();
                        //             } else {
                        //                 //test
                        //                 // alert(data.message);
                        //             }
                        //         }
                        //     });
                        // });
                    }
                });
            })


            // $('body').on('change', '.add-product-modal select.select-variation-option.single-product-select', function(ev) {
            //     ev.preventDefault();
            //     alert(111111)
            //     const row = $(this).closest('.product__single-item-info-bottom');
            //     const group_id = row.data('id');
            //     const select_element_id = $(this).val();
            //     const vpid = $('#vpid').val();
            //     const $self = $(this);
            //     fetch("/products/get-variation-menu-raw", {
            //         method: "post",
            //         headers: {
            //             "Content-Type": "application/json",
            //             Accept: "application/json",
            //             "X-Requested-With": "XMLHttpRequest",
            //             "X-CSRF-Token": $('input[name="_token"]').val()
            //         },
            //         credentials: "same-origin",
            //         body: JSON.stringify({
            //             group_id: group_id,
            //             select_element_id: select_element_id,
            //             vpid:vpid
            //         })
            //     })
            //         .then(function (response) {
            //             return response.json();
            //         })
            //         .then(function (data) {
            //             row.html(data.html);
            //             row.find('.select-2').select2({minimumResultsForSearch: -1});
            //             // row.find('.product-qty').select2();
            //             $self.closest('.product__single-item-info').css('border-color', '#d7d7d7');
            //             // setTotalPrice(countTotalPrice());
            //         })
            //         .catch(function (error) {
            //             console.log(error);
            //         });
            // });


            $("body").on('click', '.delete-product-item', function (e) {
                e.stopPropagation();

                $('.kaliony-page[data-id="' + $(this).parent().data('id') + '"]').remove()
                $(this).parent().remove()
            })


            $("body").on('change', '.select-user', function () {
                var id = $(this).val();
                AjaxCall("/admin/orders/invoices/get-user", {id: id}, function (res) {
                    if (!res.error) {
                        $(".user-details").html(res.html);
                    }
                });
            });

            $("body").on('click', '.add-user', function () {
                var id = $('.select-user').val();
                AjaxCall("/admin/orders/invoices/add-user", {id: id}, function (res) {
                    if (!res.error) {
                        $(".user-add-details").html(res.html);
                        $(".shipping-payment").html(res.shippingHtml);
                        $(".order-summary").html(res.summaryHtml);
                        $(".customer-details-modal").modal('hide')
                    }
                });
            });

            // $("body").on('change', '.select-variation-option', function () {
            //     get_price();
            // });
            //
            // $("body").on('change', '.select-variation-radio-option', function () {
            //     get_price();
            // });

            $("body").on('click', '.add-to-cart', function () {
                var itemId = $(this).closest('.item-pr-bx').data('item-id');
                var qty = $(this).closest('.item-pr-bx').find('.qty-item').val();
                var userID = $("body").find("#order_user").val();

                if (itemId && itemId != '') {
                    $.ajax({
                        type: "post",
                        url: "/admin/orders/invoices/add-to-cart",
                        cache: false,
                        datatype: "json",
                        data: {
                            uid: itemId,
                            qty: qty,
                            user_id: userID
                        },
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
                    alert('Select available item');
                }
            })


            $("body").on('click', '.qtycount', function () {
                var uid = $(this).data('uid');
                var condition = $(this).data('condition');
                var userID = $("#order_user").val();

                if (uid && uid != '') {
                    $.ajax({
                        type: "post",
                        url: "/admin/orders/invoices/update-cart",
                        cache: false,
                        datatype: "json",
                        data: {uid: uid, condition: condition, user_id: userID},
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
                        url: "/admin/orders/invoices/update-cart",
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
                        url: "/admin/orders/invoices/remove-from-cart",
                        cache: false,
                        datatype: "json",
                        data: {uid: uid, user_id: userID},
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


            $('body').on('click', '.change-status-btn', function (event) {
                event.preventDefault();
                var form = $(this).parents('form:first');
                var data = form.serialize();
                form.find('.errors').html('');
                $.ajax({
                    url: "{!! route('admin_orders_invoice_add_note') !!}",
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
