@extends('layouts.frontend')
@section('content')
    <main class="main-content">
        <div class="shopping-cart_wrapper shopping__cart-wrapper">
            <div class="container main-max-width ">
                <div class="d-flex shopping-cart-head">
{{--                    <div class="shopping-cart-head-back-btn">--}}

{{--                    </div>--}}
                    <ul class="nav nav-pills">
                        <li class="nav-item col-md-3">
                            <a class="item active d-flex align-items-center justify-content-between"
                               ref="javascript:void(0);">
                                <span class="font-sec-reg text-main-clr num">1</span>
                                <span
                                    class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('shopping_cart') !!}</span>
                                <span class="icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item col-md-3">
                            <a class="item d-flex align-items-center justify-content-between"
                               href="javascript:void(0);">
                                <span class="font-sec-reg text-main-clr num">2</span>
                                <span class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('checkout') !!}</span>
                                <span class="icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item col-md-3">
                            <a class="item d-flex align-items-center justify-content-between"
                               href="javascript:void(0);">
                                <span class="font-sec-reg text-main-clr num">3</span>
                                <span class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('payment') !!}</span>
                                <span class="icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item col-md-3">
                            <a class="item d-flex align-items-center justify-content-between"
                               href="javascript:void(0);">
                                <span class="font-sec-reg text-main-clr num">4</span>
                                <span
                                    class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('confirmation') !!}</span>
                                <span class="icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container main-max-width shopping__cart-mw">
                <div class="cart-area">
                    @include('frontend.wholesaler._partials.cart_table')
                </div>
            </div>
        </div>

        <button id="scrollTopBtn" class="scroll-top-btn d-flex align-items-center justify-content-center pointer">
            <svg viewBox="0 0 17 10" width="17px" height="10px">
                <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                      d="M0.000,8.111 L1.984,10.005 L8.498,3.789 L15.010,10.005 L16.995,8.111 L8.498,0.001 L0.000,8.111 Z"/>
            </svg>
        </button>
    </main>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/frontend/css/cart.css')}}">
@stop
@section("js")
    <script>
        $("body").on('keyup', '#coupon_code', function () {
            let value = $(this).val();
            $("body").find("#coupon_require_error").addClass('hide');
            clearTimeout(timeout);
            var timeout = setTimeout(function () {
                console.log(value);
                AjaxCall("/wholesaler/apply-coupon", {
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

        $("body").on('click','.shopping-cart-content-wholesaler .inp-up, .shopping-cart-content-wholesaler .inp-down',function () {
            var uid = $(this).closest('.shopping__cart-tab-table-wall').data('uid');
            var condition = $(this).hasClass('inp-up');
            if(uid && uid != ''){
                $.ajax({
                    type: "post",
                    url: "/wholesaler/update-cart",
                    cache: false,
                    datatype: "json",
                    data: {  uid : uid, condition: condition },
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function(data) {
                        if(! data.error){
                            $('.cart-area').html(data.html);
                            $('#cartSidebar').html(data.headerHtml);
                        }else{
                            alert('error');
                        }
                    }
                });
            }else{
                alert('Select available variation');
            }
        });

        $("body").on('click','.remove-from-cart',function (e) {
            e.stopPropagation();
            var uid = $(this).data('uid');

            if(uid && uid != ''){
                $.ajax({
                    type: "post",
                    url: "/wholesaler/remove-from-cart",
                    cache: false,
                    datatype: "json",
                    data: {  uid : uid },
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function(data) {
                        if(! data.error){
                            $('.cart-area').html(data.html)
                            $('#cartSidebar').html(data.headerHtml)
                            $(".cart-count").html(data.count);
                        }else{
                            alert('error');
                        }
                    }
                });
            }else{
                alert('Select available variation');
            }
        });
    </script>
@stop
