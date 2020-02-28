@extends('layouts.frontend')
@section('content')
    <main class="main-content">
        <div class="brands_page-wrapper">

            <div class="brands_main-content-wrapper">
                <div class="container main-max-width">
                    @if(count($offers))
                        @foreach($offers as $offer)
                            <div class="d-flex flex-wrap mt-5">
                                <div class="brands_main-content">
                                    <div class="d-flex flex-wrap brands_main-content-top margin-b-brands-top">
                                        @include("frontend.offers._partials.current")
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!--scroll top button-->
        <button id="scrollTopBtn" class="scroll-top-btn d-flex align-items-center justify-content-center pointer">
            <svg viewBox="0 0 17 10" width="17px" height="10px">
                <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                      d="M0.000,8.111 L1.984,10.005 L8.498,3.789 L15.010,10.005 L16.995,8.111 L8.498,0.001 L0.000,8.111 Z"></path>
            </svg>
        </button>
    </main>

@stop
@section('css')
    <link href="/public/plugins/formstone/carousel/carousel.css" rel="stylesheet">
    <link href="/public/plugins/formstone/light.css" rel="stylesheet">
    <link href="/public/css/carousel.css" rel="stylesheet">
    <link href="/public/css/home-slider.css" rel="stylesheet">

@stop

@section('js')
    <script src={{asset("public/plugins/formstone/core.js")}}></script>
    <script src={{asset("public/plugins/formstone/mediaquery.js")}}></script>
    <script src={{asset("public/plugins/formstone/touch.js")}}></script>
    <script src={{asset("public/plugins/formstone/carousel/carousel.js")}}></script>
    <script>
        $(".brands_page-top-slider").carousel({
            pagination: false,
            controls: false,
            infinite: true,
            show: {
                "740px": 2,
                "980px": 3,
                "1220px": 9
            }
        });
        $('body').on('click', '.brands_aside-item-link', function () {
            let value = $(this).data('id');
            let slug = $(this).data('slug');
            $.ajax({
                type: "post",
                url: "/get-offer",
                cache: false,
                datatype: "json",
                data: {id: value},
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function (data) {
                    if (!data.error) {
                        $("body").find(".brands_aside-item-link").removeClass('active');
                        $("body").find(".brands_aside-item-link[data-id='"+value+"']").addClass('active');
                        $("body").find('.brands_main-content-top').html(data.html);
                        history.pushState(null, null, '/offers/'+slug);
                        // document.location.hash = slug
                    }
                }
            });
        });

        $('body').on('click', '.brands_main-content-top-more', function () {
            let topBlock = $(this).closest('.brands_main-content-top');
            if ($(this).hasClass('more-info-btn')) {
                $(this).toggleClass('d-flex d-none')
            } else {
                $(topBlock).find('.more-info-btn').toggleClass('d-none d-flex')
            }
            $(topBlock).find('.brands_main-content-top-info').toggleClass('d-none')
            $(topBlock).find('.brands_main-content-top-right').toggleClass('bottom-border')
            $(topBlock).toggleClass('margin-b-brands-top')

        })
        // grid brands products
        $('body').on('click', '.brands_main-content-products-top .product-grid-list .display-icon', function () {
            if ($(this).hasClass('list')) {
$(this).closest('.brands_main-content-products-wrapper').find('.brands_products__list-wrapper >li').addClass('list-product')
            }else {
                $(this).closest('.brands_main-content-products-wrapper').find('.brands_products__list-wrapper >li').removeClass('list-product')
            }
        })
    </script>
@stop
