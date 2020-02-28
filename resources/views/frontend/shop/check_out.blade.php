@extends('layouts.frontend')
@section('content')

    <main class="main-content">
        <div class="shopping-cart_wrapper shopping__cart-wrapper">
{{--            <div class="container main-max-width">--}}
{{--                <div class="d-flex shopping-cart-head">--}}
{{--                    <div class="shopping-cart-head-back-btn">--}}

{{--                    </div>--}}
{{--                    <ul class="nav nav-pills">--}}
{{--                        <li class="nav-item col-md-3">--}}
{{--                            <a class="item visited d-flex align-items-center justify-content-between"--}}
{{--                               ref="javascript:void(0);">--}}
{{--                                <span class="font-sec-reg text-main-clr num">1</span>--}}
{{--                                <span--}}
{{--                                    class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('shopping_cart') !!}</span>--}}
{{--                                <span class="icon">--}}
{{--                                <svg--}}
{{--                                    xmlns="http://www.w3.org/2000/svg"--}}
{{--                                    xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                    width="24px" height="19px">--}}
{{--<path fill-rule="evenodd" fill="rgb(81, 229, 109)"--}}
{{--      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>--}}
{{--</svg>--}}
{{--                                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item col-md-3">--}}
{{--                            <a class="item active d-flex align-items-center justify-content-between"--}}
{{--                               href="javascript:void(0);">--}}
{{--                                <span class="font-sec-reg text-main-clr num">2</span>--}}
{{--                                <span class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('checkout') !!}</span>--}}
{{--                                <span class="icon">--}}
{{--                                    <svg--}}
{{--                                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                                        xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                        width="24px" height="19px">--}}
{{--<path fill-rule="evenodd" fill="rgb(81, 229, 109)"--}}
{{--      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>--}}
{{--</svg>--}}
{{--                                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item col-md-3">--}}
{{--                            <a class="item d-flex align-items-center justify-content-between"--}}
{{--                               href="javascript:void(0);">--}}
{{--                                <span class="font-sec-reg text-main-clr num">3</span>--}}
{{--                                <span class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('payment') !!}</span>--}}
{{--                                <span class="icon">--}}
{{--                                    <svg--}}
{{--                                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                                        xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                        width="24px" height="19px">--}}
{{--<path fill-rule="evenodd" fill="rgb(81, 229, 109)"--}}
{{--      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>--}}
{{--</svg>--}}
{{--                                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item col-md-3">--}}
{{--                            <a class="item d-flex align-items-center justify-content-between"--}}
{{--                               href="javascript:void(0);">--}}
{{--                                <span class="font-sec-reg text-main-clr num">4</span>--}}
{{--                                <span--}}
{{--                                    class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('confirmation') !!}</span>--}}
{{--                                <span class="icon">--}}
{{--                                    <svg--}}
{{--                                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                                        xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                        width="24px" height="19px">--}}
{{--<path fill-rule="evenodd" fill="rgb(81, 229, 109)"--}}
{{--      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>--}}
{{--</svg>--}}
{{--                                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="container main-max-width shopping__cart-mw">
                <div class="shopping-cart-inner">
                    <div class="d-flex flex-wrap checkout-data">
                        @include('frontend.shop._partials.checkout_render')
                    </div>
                </div>
            </div>
        </div>

{{--        <button id="scrollTopBtn" class="scroll-top-btn d-flex align-items-center justify-content-center pointer">--}}
{{--            <svg viewBox="0 0 17 10" width="17px" height="10px">--}}
{{--                <path fill-rule="evenodd" fill="rgb(124, 124, 124)"--}}
{{--                      d="M0.000,8.111 L1.984,10.005 L8.498,3.789 L15.010,10.005 L16.995,8.111 L8.498,0.001 L0.000,8.111 Z"/>--}}
{{--            </svg>--}}
{{--        </button>--}}
    </main>

    @if(Auth::check())
        <div class="modal modal-checkout fade" id="newAddressModal" tabindex="-1" role="dialog"
             aria-labelledby="newAddressModal" aria-hidden="true">
            <div class="modal-dialog main-scrollbar" role="document">
                <div class="modal-content">
                    <button type="button" class="close main-transition" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-checkout_header text-center">
                        <h2 class="modal-checkout_title font-main-bold font-22 text-uppercase">{!! __('add_new_address') !!}</h2>
                        <p class="font-15 text-gray-clr modal-text">{!! __('check_out_modal_desc') !!}</p>
                    </div>
                    <div class="modal-body address-form">

                    </div>
                </div>
            </div>
        </div>
        <!--modal change address-->
        {{--<div class="modal modal-checkout fade" id="changeAddressModal" tabindex="-1" role="dialog"--}}
             {{--aria-labelledby="changeAddressModal">--}}
            {{--<div class="modal-dialog main-scrollbar" role="document">--}}
                {{--<div class="modal-content">--}}
                    {{--<button type="button" class="close main-transition" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                    {{--<div class="modal-checkout_header text-center">--}}
                        {{--<h2 class="modal-checkout_title font-main-bold font-22 text-uppercase">Change address</h2>--}}
                        {{--<p class="font-15 text-gray-clr modal-text"> Lorem ipsum dolor sit amet, consectetur--}}
                            {{--adipisicing.</p>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<form action="" class="checkout-form">--}}

                            {{--<div--}}
                                {{--class="form-group d-flex flex-md-row flex-column align-items-md-center justify-content-between ">--}}
                                {{--<label for="title" class="checkout-form_label text-gray-clr mb-0 pl-md-0 pl-3 pb-0">Enter--}}
                                    {{--Shipping address<span class="form-required-icon text-quatr-clr font-main-bold">&nbsp;&#42;</span></label>--}}
                                {{--<div class="col-md-8">--}}
                                    {{--<div class="simple_select_wrapper">--}}
                                        {{--{!! Form::select('address_book',$address->toArray(),$address_id,['class' => 'form-control select-address',"placeholder" => 'Select','tabindex' => '2']) !!}--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    @endif
@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    {{--<link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">--}}
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
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        function orderSummeryScroll(width){
            let orderSummery = $('.shopping__cart-wrapper .card.order-summary');
            if(!(width >= 992)) {
                $(orderSummery).removeClass('fix_order-summary');
                $(orderSummery).width('auto');
                $(orderSummery).closest('.shopping__cart-wrapper').find('.shopping-cart-inner').css({
                    'min-height': 'auto'
                })
            }
        }

        $(window).on('scroll', function(ev) {
            let orderSummery = $('.shopping__cart-wrapper .card.order-summary');
            console.log(orderSummery[0].offsetTop)
            if($(window).width() >= 992) {
                let fixmeTop = orderSummery.offset().top - 50;
                let currentScroll = $(window).scrollTop();
                let orderSummeryHeight = orderSummery.height();
                let orderSummeryParent = orderSummery.parent().width();
                console.log('currentScroll ->', currentScroll, 'fixmeTop->', fixmeTop)
                if (currentScroll >= 135) {
                    $(orderSummery).addClass('fix_order-summary').width(orderSummeryParent)
                    $(orderSummery).closest('.shopping__cart-wrapper').find('.shopping-cart-inner').css({
                        'min-height': orderSummeryHeight + 'px'
                    })
                } else {
                    $(orderSummery).removeClass('fix_order-summary').width('auto')
                    $(orderSummery).closest('.shopping__cart-wrapper').find('.shopping-cart-inner').css({
                        'min-height': 'auto'
                    })
                }
            } else {
                let orderSummery = $('.shopping__cart-wrapper .card.order-summary');
                $(orderSummery).removeClass('fix_order-summary');
                $(orderSummery).width('auto');
                $(orderSummery).closest('.shopping__cart-wrapper').find('.shopping-cart-inner').css({
                    'min-height':'auto'
                })
            }
        });


        orderSummeryScroll();
        $( window ).on('resize', function(ev) {
            orderSummeryScroll(ev.target.screen.width)
        });

        $("body").on('keyup', '#coupon_code', function () {
            let value = $(this).val();
            $("body").find("#coupon_require_error").addClass('hide');
            clearTimeout(timeout);
            var timeout = setTimeout(function () {
                console.log(value);
                AjaxCall("/apply-coupon", {
                    code: value,
                    user_id: $("#order_user").val()
                }, function (res) {
                    if (res.error) {
                        $("body").find("#coupon_require_error").text(res.message);
                        $("body").find("#coupon_require_error").removeClass('hide');
                    }else{
                        $(".order-summary").html(res.summaryHtml);
                    }

                });
            }, 500);
        });
        //addresses js
        $("body").on('click', '.save-address-book', function () {
            var form = $(".address-book-form").serialize();
            AjaxCall(
                "/my-account/save-address-book",
                form,
                res => {
                    if (!res.error) {
                        console.log(res.data)
                        let select = $(".select-address")
                        var opt = document.createElement('option');
                        opt.value = res.data.id;
                        opt.innerHTML = res.data.company;
                        select.append(opt);
                        $("#newAddressModal").modal('hide');
//
                        select.val(res.data.id).trigger('change');
                    }
                },
                error => {
                    if (error.status == 422) {
                        $('.errors').html('');
                        for (var err in error.responseJSON.errors) {
                            $('.errors').append(error.responseJSON.errors[err] + '<br>');
                        }
                    }
                }
            );
        })

        $("body").on('click', '.address-book-new', function () {
            AjaxCall(
                "/my-account/address-book-form",
                {default: true},
                res => {
                    if (!res.error) {
                        $(".address-form").html(res.html);
                        $("#geo_country_book").select2();
                        $("#newAddressModal").modal();
                    }
                }
            );
        });

        $("body").on("change", ".select-address", function () {
            $(".container").css('opacity', '0.6');
            $(".loader-img").toggleClass('d-none');
            AjaxCall(
                "/change-shipping-method",
                {addressId: $(this).val()},
                res => {
                    if (!res.error) {
                        $(".container").css('opacity', '1');
                        $(".loader-img").toggleClass('d-none');
                        $(".checkout-data").html(res.html);
                        $(".select-address").select2()
                    }
                },
                error => {
                    $(".container").css('opacity', '1');
                    $(".loader-img").toggleClass('d-none');
                }
            );
        });

        $("body").on("change", "#geo_country_book", function () {
            var value = $(this).val();
            AjaxCall(
                "/get-regions-by-geozone",
                {country: value},
                res => {

                    if (!res.error) {
                        var $el = $("#geo_region_book");
                        $el.empty(); // remove old options
                        console.log(res.data)
                        var x = res.data;
                        for (var item in x) {
                            console.log(x[item]);
                            var opt = document.createElement('option');
                            opt.value = item;
                            opt.innerHTML = x[item];
                            $el.append(opt);
                        }

                    }
                }
            );
        });
    </script>

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
        $(document).ready(function () {
            $("body").on("click", ".go-to-payment", function (event) {
                AjaxCall(
                    "/get-payment-options",
                    {},
                    res => {
                        if (!res.error) {
                            window.location = res.url;
                        }
                    }
                );
            });

            $("body").on("click", ".back-step", function (event) {
                $(".nav-link").each(function (index, value) {
                    $(value).removeClass('active').addClass('disabled');
                });

                $(".tab-pane").each(function (index, value) {
                    $(value).removeClass('active in show');
                });

                $(".checkout-data").addClass('active in show');
                $("#address-tab").removeClass('disabled').addClass('active');
            });

            $("body").on("click", ".nav-link", function (event) {
                event.stopImmediatePropagation();
            });

            $('body').on('change', '.payment_methods input[type=radio][name=payment_method]', function () {
                var method = $(this).val();
                if ($(this).is(':checked')) {
                    $('.payment_box').slideUp();
                    $(this).closest('li').find('.payment_box').slideDown();

                    $(".payment-method-data").each(function (index, value) {
                        $(value).addClass('d-none')
                    })

                    $("#" + method + "-method").removeClass('d-none')
                }
            })
        });

    </script>
    <script>
        $(document).ready(function () {
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
                    }
                );
            }

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
                            opt.value = res.data.id;
                            opt.innerHTML = res.data.name;
                            select.appendChild(opt);
                        }
                    }
                );
            }

            $("body").on("change", "#country", function () {
                getRegionsPackage();
            });

            $("body").on("change", "#geo_country", function () {
                getRegions();
            });

            $("body").on("change", ".select-shipping-method", function () {
                var optionId = $(this).val();
                var deliveryId = $(this).data('delivery');
                var addressId = $(".select-address").val();
                $(".container").css('opacity', '0.6');
                $(".loader-img").toggleClass('d-none');
                AjaxCall(
                    "/change-shipping-method",
                    {deliveryId: deliveryId, optionId: optionId, addressId: addressId},
                    res => {
                        if (!res.error) {
                            $(".container").css('opacity', '1');
                            $(".loader-img").toggleClass('d-none');
                            $(".checkout-data").html(res.html);
                            $(".select-address").select2()
                        }
                    },
                    error => {
                        $(".container").css('opacity', '1');
                        $(".loader-img").toggleClass('d-none');
                    }
                );
            });


            $("body").on("click", ".submit-cash", function () {
                $(".container").css('opacity', '0.6');
                $(".loader-img").toggleClass('d-none');
                AjaxCall(
                    "/cash-order",
                    {},
                    res => {
                        if (!res.error) {
                            $(".container").css('opacity', '1');
                            $(".loader-img").toggleClass('d-none');
                            window.location = res.url;
                        }
                    },
                    error => {
                        $(".container").css('opacity', '1');
                        $(".loader-img").toggleClass('d-none');
                    }
                );
            });
        })
    </script>
@stop
