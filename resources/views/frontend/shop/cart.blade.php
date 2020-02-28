@extends('layouts.frontend')
@section('content')
    <main class="main-content">
        <div class="shopping-cart_wrapper shopping__cart-wrapper">
{{--            <div class="container main-max-width ">--}}
{{--                <div class="d-flex shopping-cart-head">--}}
{{--                    <div class="shopping-cart-head-back-btn">--}}

{{--                    </div>--}}
{{--                    <ul class="nav nav-pills">--}}
{{--                        <li class="nav-item col-md-3">--}}
{{--                            <a class="item active d-flex align-items-center justify-content-between"--}}
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
{{--                            <a class="item d-flex align-items-center justify-content-between"--}}
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
                <div class="cart-area">
                    @include('frontend.shop._partials.cart_table')
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

    <div class="modal fade p-0" id="specialPopUpModal" tabindex="-1" role="dialog"
         aria-labelledby="specialPopUpModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable mw-100" role="document">
            <div class="modal-content">
                <div class="modal-header special__popup-head">
                    <h5 class="font-sec-reg font-26 text-sec-clr modal-title" id="specialPopUpModalTitle">{!! __('special_offer') !!}</h5>
                    <div class="font-main-light font-20 text-main-clr align-self-stretch special__popup-head-mid">
                        {!! __('special_popup_head_desc') !!}
                    </div>
                    <button type="button" class="align-self-stretch close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="42px" height="42px" viewBox="0 0 42 42">
<path fill-rule="evenodd" fill="rgb(53, 53, 53)"
      d="M42.008,1.300 L40.701,-0.009 L21.000,19.690 L1.301,-0.009 L-0.008,1.300 L19.691,21.000 L-0.008,40.699 L1.301,42.009 L21.000,22.307 L40.701,42.009 L42.008,40.699 L22.309,21.000 L42.008,1.300 Z"/>
</svg>
                        </span>
                    </button>
                </div>
                <div class="modal-body p-0">
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/frontend/css/cart.css')}}">
@stop
@section("js")
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
    </script>
@stop
