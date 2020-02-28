@extends('layouts.admin',['activePage'=>'discounts'])
@section('content')
    <div class="order__admin-wrapper">
        <div class="d-flex align-items-center justify-content-between position-relative head-order-wrap">
            <div class="d-flex align-items-center left-head">
                <span class="font-sec-reg font-24 title">Order:{!! $order->order_number !!}</span>
                <div class="d-flex align-items-center">
                    <span class="title-customer">Customer</span>
                    <span class="font-main-light border-main d-flex align-items-center justify-content-center name">
                        Malek Rabah
                    </span>
                </div>
            </div>
            <div class="d-flex align-items-center right-head">
                <a href="javascript:void(0)" class="btn btn-default refund-all">Refund Order</a>
            </div>
        </div>
        <nav class="nav-orders">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-order-details-tab" data-toggle="tab" href="#nav-order-details" role="tab" aria-controls="nav-details" aria-selected="true">Refund</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade  show active" id="nav-order-details" role="tabpanel" aria-labelledby="nav-order-details-tab">
                <div class="order-details__tab">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="order-details__tab-left">
                                <div class="shopping__cart-confirm w-100">
                                    <div class="row list-shipping">
                                        <div class="left-col">
                                            <ul class="row mb-0">
                                                <li class="col-md-4 col-sm-6">
                                                    <div class="sipping-item-wrap delivery-item">
                                                        <div class="item-photo">
                                                            <img src="/public/img/confirm-calendar.png" class="calendar-img" alt="item">
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
                                                        Parcelforce Worldwide
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center single-wrap">
                                                    <div class="font-sec-reg font-18 left-wrap">Total items</div>
                                                    <div class="font-16 text-tert-clr right-wrap">
                                                        {!! $order->items()->count() !!} Item
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center single-wrap">
                                                    <div class="font-sec-reg font-18 left-wrap">Total weight</div>
                                                    <div class="font-16 text-tert-clr right-wrap">200 g</div>
                                                </div>
                                                <div class="d-flex align-items-center single-wrap">
                                                    <div class="font-sec-reg font-18 left-wrap">Payment Method</div>
                                                    <div class="font-16 text-tert-clr right-wrap">
                                                        {!! $order->payment_method !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="font-sec-reg font-22 lh-1 title">Order Details</h2>
                                    <ul class="row list-order">
                                    </ul>

                                    <h2 class="font-sec-reg font-22 lh-1 title">Refunded</h2>
                                    <ul class="row list-order">
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
                                        <div class="single-row font-21 d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="name">
                                                Sub Total
                                            </div>
                                            <div class="price font-main-bold">
                                                £{!! $order->sub_total !!}
                                            </div>
                                        </div>
                                        <div class="single-row font-21 d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="name">
                                                Tax
                                            </div>
                                            <div class="price font-main-bold">
                                                £{!! $order->tax !!}
                                            </div>
                                        </div>

                                        <div class="single-row font-21 d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="w-100 d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="name">
                                                    Admin Discount
                                                </div>
                                                <div class="price font-main-bold">
                                                    £{!! $order->admin_discount !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-row font-21 d-flex flex-wrap justify-content-between align-items-center border-bottom-0 mb-0 pb-0">
                                            <div class="name">
                                                Total
                                            </div>
                                            <div class="price text-tert-clr font-main-bold">
                                                £{!! $order->total !!}
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


            $('body').on('click','.order__admin-wrapper .head-order-wrap .right-head .change-btn',function () {
                if($('.order__admin-wrapper .order__change-status-wrapper').hasClass('d-none')){
                    $('.order__admin-wrapper .order__change-status-wrapper').removeClass('d-none')
                    $(this).addClass('d-none')
                    let headWrap = $(this).closest('.right-head')
                    $(headWrap).find('.submit-btn').addClass('d-none')
                    $(headWrap).find('.status-pending').removeClass('d-none')

                }else{
                    $('.order__admin-wrapper .order__change-status-wrapper').addClass('d-none')
                }
            });
            $('body').on('click','.order__change-status-wrapper-inner .close-status-icon',function () {
                $('.order__admin-wrapper .head-order-wrap .right-head .change-btn').removeClass('d-none')
                $('.order__admin-wrapper .head-order-wrap .right-head .status-pending').addClass('d-none')
                $('.order__admin-wrapper .head-order-wrap .right-head .submit-btn').removeClass('d-none')
                $(this).closest('.order__change-status-wrapper').addClass('d-none')
            });

            $("body").on('click','.check-item-btn',function () {
                var data = $("body").find('.check-collecting');
                data.each(function (e,i) {
                    $(i).click();
                })
            })

            $('body').on('click', '.check-collecting', function (event) {
                let $_this = $(this);
                if(! $_this.hasClass('d-none')){
                    let unique_id = $_this.data("unique");
                    let item_id = $_this.data("item");
                    let warehouse = $_this.closest('.collect-item').find(".warehouse").val();
                    let rack = $_this.closest('.collect-item').find(".rack").val();
                    let shelve = $_this.closest('.collect-item').find(".shelve").val();
                    let qty = $_this.closest('.collect-item').find(".itm-qty").val();

                    AjaxCall("{!! route('admin_orders_collecting',$order->id) !!}", {
                        unique_id: unique_id,
                        item_id: item_id,
                        warehouse: warehouse,
                        rack: rack,
                        shelve: shelve,
                        qty: qty,
                        count: $("#item_count").val()
                    }, function (res) {
                        if (!res.error) {
                            $_this.addClass('d-none');
                            $_this.closest('td').addClass('active');
                            $_this.closest('td').find('.check-icon').removeClass('d-none');

                            $(".status-check").html(res.message);
                            if(res.success){
                                $(".check-item-btn").addClass('active');
                            }
                        }
                    });
                }

            });

            $('#check1').click(function () {
                if ($(this).is(':checked')) alert('checked'); else alert('unchecked');
            });

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
                            $('.hidden-add-field_heading .close-status-icon').trigger('click');
                            $(".order-timeline").html(data.html);
                            $("#orderStatus").html(data.statusHtml);
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
