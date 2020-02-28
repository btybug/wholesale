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
{{--                            <a class="item visited d-flex align-items-center justify-content-between"--}}
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
{{--                            <a class="item active d-flex align-items-center justify-content-between"--}}
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
                <div class="cart-area">
                    @include('frontend.shop._partials.checkout_payment')
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
@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
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

        .success,
        .error {
            display: none;
            font-size: 13px;
        }

        .success.visible,
        .error.visible {
            display: inline;
        }

        .error {
            color: #E4584C;
        }

        .success {
            color: #666EE8;
        }

        .success .token {
            font-weight: 500;
            font-size: 13px;
        }
    </style>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <script>

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
        
        var stripe = Stripe("{!! stripe_key() !!}");
        var elements = stripe.elements();
        // Custom Styling
        var style = {
            base: {
                color: '#21213b',
                borderRadius: 0,
                borderColor: '#c8c8d2',
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

        var card  = elements.create('cardNumber', {
            style: style
        });
        card.mount('#cardNumber');

        var cardExpiryElement = elements.create('cardExpiry', {
            style: style
        });
        cardExpiryElement.mount('#card-expiry-element');

        var cardCvcElement = elements.create('cardCvc', {
            style: style
        });
        cardCvcElement.mount('#secureCode');


        function setOutcome(result) {
            var successElement = document.querySelector('.success');
            var errorElement = document.querySelector('.error');
            successElement.classList.remove('visible');
            errorElement.classList.remove('visible');

            if (result.token) {
                // In this example, we're simply displaying the token
                successElement.querySelector('.token').textContent = result.token.id;
                successElement.classList.add('visible');

                // In a real integration, you'd submit the form with the token to your backend server
                //var form = document.querySelector('form');
                //form.querySelector('input[name="token"]').setAttribute('value', result.token.id);
                //form.submit();
            } else if (result.error) {
                errorElement.textContent = result.error.message;
                errorElement.classList.add('visible');
            }
        }

        var cardBrandToPfClass = {
            'visa': 'pf-visa',
            'mastercard': 'pf-mastercard',
            'amex': 'pf-american-express',
            'discover': 'pf-discover',
            'diners': 'pf-diners',
            'jcb': 'pf-jcb',
            'unknown': 'pf-credit-card',
        }

//        function setBrandIcon(brand) {
//            var brandIconElement = document.getElementById('brand-icon');
//            var pfClass = 'pf-credit-card';
//            if (brand in cardBrandToPfClass) {
//                pfClass = cardBrandToPfClass[brand];
//            }
//            for (var i = brandIconElement.classList.length - 1; i >= 0; i--) {
//                brandIconElement.classList.remove(brandIconElement.classList[i]);
//            }
//            brandIconElement.classList.add('pf');
//            brandIconElement.classList.add(pfClass);
//        }

        card.on('change', function(event) {
            // Switch brand logo
//            if (event.brand) {
//                setBrandIcon(event.brand);
//            }

            setOutcome(event);
        });

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.querySelector('.error');
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





        //        // Create an instance of the card Element
//        var card = elements.create('card', {style: style});
//        // Add an instance of the card Element into the `card-element` <div>
//        card.mount('#card-element');
//        // Handle real-time validation errors from the card Element.
//        card.addEventListener('change', function(event) {
//            var displayError = document.getElementById('card-errors');
//            if (event.error) {
//                displayError.textContent = event.error.message;
//            } else {
//                displayError.textContent = '';
//            }
//        });

    </script>
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
//        $(document).ready(function () {

            $("body").on("click", ".back-step", function (event) {
                $(".nav-link").each(function (index,value) {
                    $(value).removeClass('active').addClass('disabled');
                });

                $(".tab-pane").each(function (index,value) {
                    $(value).removeClass('active in show');
                });

                $("#address").addClass('active in show');
                $("#address-tab").removeClass('disabled').addClass('active');
            });

            $("body").on("click", ".nav-link", function (event) {
                event.stopImmediatePropagation();
            });

            function paymentMethod() {
                var method = $("input[name='payment_method']:checked"). val();
                var el = $(".checkout-btn");
                var button = '';
                if(method == 'cash'){
                    $("#stripe-method").removeClass('show').addClass('d-none');
                    $("#cash-method").removeClass('d-none').addClass('show');
                    button = '<button class="order-summary-btn font-sec-reg text-uppercase font-24 text-sec-clr submit-cash w-100">{!! __('pay_cash') !!}</button>';
                }else if(method == 'stripe'){
                    $("#stripe-method").removeClass('d-none').addClass('show');
                    $("#cash-method").removeClass('show').addClass('d-none');

                    button = '<button class="order-summary-btn font-sec-reg text-uppercase font-24 text-sec-clr submit-stripe">{!! __('pay_with_card') !!}</button>';
                }
console.log(method)
                el.html(button);
            }

paymentMethod();



            $("body").on('click','.submit-stripe',function () {
//                $("#payment-form").submit();
                $('.submit-stripe-btn').trigger('click');
            });


            $('body').on('change', '.payment_methods', function () {
                paymentMethod();
            })
//        });

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
                $(".container").css('opacity','0.6');
                $(".loader-img").toggleClass('d-none');
                AjaxCall(
                    "/change-shipping-method",
                    {deliveryId:deliveryId,optionId: optionId,addressId: addressId},
                    res => {
                    if (!res.error) {
                    $(".container").css('opacity','1');
                    $(".loader-img").toggleClass('d-none');
                    $("#address").html(res.html);
                }
            },
                error => {
                    $(".container").css('opacity','1');
                    $(".loader-img").toggleClass('d-none');
                }
                );
            });


            $("body").on("click", ".submit-cash", function () {
                $(".container").css('opacity','0.6');
                $(".loader-img").toggleClass('d-none');
                AjaxCall(
                    "/cash-order",
                    {},
                    res => {
                    if (!res.error) {
                    $(".container").css('opacity','1');
                    $(".loader-img").toggleClass('d-none');
                    window.location = res.url;
                }
            },
                error => {
                    $(".container").css('opacity','1');
                    $(".loader-img").toggleClass('d-none');
                }
                );
            });
        })
    </script>
@stop
