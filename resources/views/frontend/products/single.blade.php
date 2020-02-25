@extends('layouts.frontend')
@section('meta')
    {!! stockSeo($vape) !!}
    {!! \App\Models\RIchSnippets\RichProducts::create($vape->id,$type) !!}
@stop
@section('content')
    <div class="main-content">

        <!--shopping dtls fixed at the bottom-->
        <div class="continue-shp-wrapp">
            <div class="container main-max-width h-100 p-0">
                <div class="d-flex flex-lg-row flex-column align-items-center justify-content-between h-100">
                    <a href="{{ route('categories_front') }}"
                       class="continue-shp-wrapp_link font-sec-bold font-21 text-light-clr text-uppercase">{!! __('continue_shopping') !!}</a>
                    <div class="d-flex align-items-center ml-lg-auto continue-shp-wrapp_right">
                        <div class="continue-shp-wrapp_qty position-relative">
                            <!--minus qty-->
                            <span data-type="minus"
                                  class="d-inline-block pointer position-absolute continue-shp-wrapp_qty-minus qty-count">
                            <svg viewBox="0 0 20 3" width="20px" height="3px">
                                <path fill-rule="evenodd" fill="rgb(214, 217, 225)"
                                      d="M20.004,2.938 L-0.007,2.938 L-0.007,0.580 L20.004,0.580 L20.004,2.938 Z"/>
                            </svg>
                        </span>
                        {!! Form::number('',1,['class' => 'field-input w-100 h-100 font-23 text-center border-0 product-qty-select none-touchable ','min' => 'number']) !!}
                        <!--plus qty-->
                            <span data-type="plus"
                                  class="d-inline-block pointer position-absolute continue-shp-wrapp_qty-plus qty-count">
                            <svg viewBox="0 0 20 20" width="20px" height="20px">
                                <path fill-rule="evenodd" fill="rgb(211, 214, 223)"
                                      d="M20.004,10.938 L11.315,10.938 L11.315,20.000 L8.696,20.000 L8.696,10.938 L-0.007,10.938 L-0.007,8.580 L8.696,8.580 L8.696,0.007 L11.315,0.007 L11.315,8.580 L20.004,8.580 L20.004,10.938 Z"/>
                            </svg>
                        </span>
                        </div>
                        <a href="#"
                           class="btn-add-to-cart product-card_btn d-inline-flex align-items-center justify-content-between text-center font-15 text-sec-clr text-uppercase"
                           data-toggle="modal" data-target="#specialPopUpModal">
                            <span class="product-card_btn-text">{!! __('add_to_cart') !!}</span>
                            <span class="d-inline-block ml-auto">
                            <svg viewBox="0 0 18 22" width="18px" height="22px">
                                <path fill-rule="evenodd" opacity="0.8" fill="rgb(255, 255, 255)"
                                      d="M14.305,3.679 L14.305,0.003 L3.694,0.003 L3.694,3.679 L-0.004,3.679 L-0.004,21.998 L18.003,21.998 L18.003,3.679 L14.305,3.679 ZM4.935,1.216 L13.064,1.216 L13.064,3.679 L4.935,3.679 L4.935,1.216 ZM16.761,20.785 L1.238,20.785 L1.238,4.891 L3.694,4.891 L3.694,7.329 L4.935,7.329 L4.935,4.891 L13.064,4.891 L13.064,7.329 L14.305,7.329 L14.305,4.891 L16.761,4.891 L16.761,20.785 Z"></path>
                            </svg>
                        </span>
                        </a>
                        <span
                            class="product-card_price d-inline-block font-sec-bold font-41 text-tert-clr lh-1 position-relative">
                        <span class="price-place-summary">
                            @if($vape->type)
                                {{ convert_price($vape->price,$currency, false)}}
                            @endif
                        </span>
                    </span>
                    </div>
                </div>

            </div>

        </div>

        <div id="loading" class="d-flex justify-content-center align-items-center my-5">
            <div class="lds-dual-ring"></div>
        </div>
        <!--main-content-->
        <div id="singleProductPageCnt" class="single-product-page-cnt d-none flex-column ">
            <main class="position-relative">
                <!--breadcrump-->
                {{--                <div class="main-content container main-max-width main-content-wrapper">--}}
                {{--                    <div class="content-head d-flex flex-wrap justify-content-between">--}}
                {{--                        <div class="left-head d-flex align-items-center mb-lg-0 mb-2">--}}
                {{--                            {{ Breadcrumbs::render('single_product',$type,$vape->name) }}--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="products-wrap product__single-wrapper">
                    <div class="product__single-top">
                        <div class="container main-max-width h-100">
                            <div class="d-flex align-items-center product__single-top-inner h-100">
                                <div class="product__single-top-inner-left">
                                    <h1 class="font-sec-reg text-tert-clr font-28 text-uppercase product__single-top-title text-truncate">
                                        {!! $vape->name !!}
                                    </h1>
                                    <div class="d-flex align-items-center">
                                        <span class="font-sec-reg font-26 text-main-clr lh-1">
                                            {!! $vape->short_description !!}
                                        </span>
                                        @if(Auth::check())
                                            <span class="icon products__item-favourite product-card_like-icon
                                            {{ ($vape->in_favorites()->where('user_id',\Auth::id())->first())?'active':null}}"
                                                  data-id="{{ $vape->id }}">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="32px" height="31px" viewBox="0 0 31 32">
                                            <path fill-rule="evenodd" stroke-width="2px" stroke="rgb(53, 53, 53)"
                                                  opacity="0.702" fill="rgb(255, 255, 255)"
                                                  d="M21.852,2.990 C19.636,2.990 17.428,4.080 15.999,5.846 C14.571,4.080 12.363,2.990 10.147,2.990 C6.125,2.990 3.002,6.258 3.002,10.466 C3.002,15.639 7.419,19.857 14.178,26.113 L15.999,28.011 L17.821,26.113 C24.580,19.857 28.998,15.639 28.998,10.466 C28.998,6.258 25.875,2.990 21.852,2.990 L21.852,2.990 Z"/>
                                            </svg>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="brands-top-slider">
                                    @foreach($vape->stickers()->orderBy('ordering')->get() as $sticker)
                                        <div class="brand-wall">
                                            <div class="brand-item">
                                                <a href="javascript:void(0)" class="brand-link">
                                                    <img src="{!! $sticker->image !!}" alt="{{ $sticker->name }}" title="{{ $sticker->name }}">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container main-max-width single-product-dtls-wrap-outer pr-lg-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="single-product-dtls-wrap" id="requiredProducts">
                                    <div class="row">
                                        <div class="col-lg-6 product-single-view-outer mr-0 w-100">
                                            <div class="product-card_view product-card_view--single position-relative">
                                                <!--product main image-->
                                                @if($vape->image)
                                                    <div class="h-100">
                                                        <a href="{!! checkImage($vape->image,'stock') !!}" class="product-single-lightbox-item" title="{!! ($vape->name) !!}" data-lightbox-gallery="photo_gallery-single-product">
                                                        <img class="single-product_top-img"
                                                             src="{!! checkImage($vape->image,'stock') !!}"
                                                             alt="{!! ( $vape->name) !!}"
                                                             title="{!! ( $vape->name) !!}"
                                                        >
                                                        </a>
                                                    </div>
                                                @endif
                                            <!--new label-->
                                                {{--                                                <span--}}
                                                {{--                                                    class="new-label product-card_new-label d-inline-block text-uppercase font-main-bold font-16 text-sec-clr position-absolute">new</span>--}}
                                            <!--sale label-->
                                                {{--                                                <span--}}
                                                {{--                                                    class="sale-label product-card_sale-label d-inline-block text-uppercase font-main-bold font-16 text-sec-clr position-absolute">-10%</span>--}}
                                            </div>
                                            <div class="main-image-alt-text font-20 font-main-bold text-center text-gray-clr">
                                                {!! $vape->name !!}
                                            </div>
                                            <div class="d-flex product-card-thumbs product-card-thumbs--single">
                                                @if($vape->image)
                                                    <div class="product-card_thumb-img-holder pointer active_slider">
                                                        <a href="{!! checkImage($vape->image,'stock') !!}" class="product-single-lightbox-item" title="{!! ($vape->name) !!}" data-lightbox-gallery="photo_gallery-single-product">
                                                            <img class="" src="{!! checkImage($vape->image,'stock') !!}"
                                                                 alt="{!! ($vape->name) !!}"
                                                                 title="{!! ($vape->name) !!}"
                                                            >
                                                        </a>
                                                    </div>
                                                @endif
                                                @if($vape->other_images && count($vape->other_images))
                                                    @foreach($vape->other_images as $other_image)
                                                        <div class="product-card_thumb-img-holder pointer"
                                                             data-id="null">
                                                            <a href="{!! checkImage($other_image['image'],'stock') !!}" class="product-single-lightbox-item"
                                                               title="{!! $other_image['alt'] !!}" data-lightbox-gallery="photo_gallery-single-product">

                                                            <img class=""
                                                                 src="{{checkImage($other_image['image'],'stock')}}"
                                                                 alt="{!! $other_image['alt'] !!}"
                                                                 title="{!! $other_image['alt'] !!}"
                                                            >
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-lg-6 product-single-info-outer">
                                            <div class="product-single-info">
                                                <input type="hidden" value="{{ $vape->id }}" data-p="{{ $vape->type }}"
                                                       id="vpid">
                                                <div
                                                    class="d-flex align-items-center product__single-delivery-right mb-3">
                                                    <div class="product__single-delivery-free font-20 lh-1">
                                                        {!! __('free_on_orders_over') !!}
                                                    </div>
                                                    <a href="#"
                                                       class="product__single-delivery-details font-20 text-tert-clr lh-1">{!! __('more_detail') !!}</a>
                                                </div>
                                                <div class="product__single-item">
                                                    @include("admin.inventory._partials.render_price_form",['model' => $vape])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--carousel--}}

                                <div class="product-single-tab">
                                    <div id="carousel-tabs-wrap" class="product-single-tab_nav-pills" role="tablist">
                                        <div class="carousel-tabs">
                                            @if((trim(strip_tags($vape->long_description)))
                                              || ($vape->main_item &&  $vape->main_item->specifications  && count($vape->main_item->specifications))
                                              || (trim(strip_tags($vape->what_is_content))) || ($vape->banners && count($vape->banners)))
                                                <a class="nav-link product-single-tab_link font-20 font-main-bold main-transition active"
                                               data-toggle="pill" href="#pills-tecnical" role="tab"
                                               aria-controls="pills-tecnical" aria-selected="true">{!! __('technical') !!}</a>
                                            @endif

                                            @if($vape->videos && count($vape->videos))
                                            <a class="nav-link product-single-tab_link font-20 font-main-bold main-transition"
                                               data-toggle="pill" href="#pills-videos" role="tab"
                                               aria-controls="pills-videos" aria-selected="true">{!! __('Videos') !!}</a>
                                            @endif

                                            @if($vape->special_offers && count($vape->special_offers))
                                            <a class="nav-link product-single-tab_link font-20 font-main-bold main-transition"
                                               data-toggle="pill" href="#pills-offers" role="tab"
                                               aria-controls="pills-offers" aria-selected="true">{!! __('offers') !!}</a>
                                            @endif

                                            @if($vape->related_products && count($vape->related_products))
                                            <a class="nav-link product-single-tab_link font-20 font-main-bold main-transition"
                                               data-toggle="pill" href="#pills-related" role="tab"
                                               aria-controls="pills-related" aria-selected="false">{!! __('related') !!}</a>
                                            @endif

                                            @if($vape->reviews_tab && count($reviews))
                                                <a class="nav-link product-single-tab_link font-20 font-main-bold main-transition"
                                                   data-toggle="pill" href="#pills-reviews" role="tab"
                                                   aria-controls="pills-reviews" aria-selected="false">{!! __('reviews') !!}</a>
                                            @endif
                                            @if($vape->faq_tab && count($vape->faqs))
                                                <a class="nav-link product-single-tab_link font-20 font-main-bold main-transition"
                                                   data-toggle="pill" href="#pills-faq" role="tab"
                                                   aria-controls="pills-faq" aria-selected="false">{!! __('faq') !!}</a>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="tab-content">

                                        @if((trim(strip_tags($vape->long_description)))
                                        || ($vape->main_item &&  $vape->main_item->specifications  && count($vape->main_item->specifications))
                                        || (trim(strip_tags($vape->what_is_content))) || ($vape->banners && count($vape->banners)))
                                            <div class="tab-pane fade show active" id="pills-tecnical"
                                                 role="tabpanel"
                                                 aria-labelledby="pills-tecnical-tab">
                                                <div class="d-flex flex-wrap">
                                                    <div class="product_single-main-tab-content">
                                                        @if(trim(strip_tags($vape->long_description)))
                                                            <div class="tecnical-desc">
                                                                <h3 class="tecnical-desc_sub-title font-main-bold font-24 text-uppercase">
                                                                    {!! __('description') !!}</h3>
                                                                <div class="tecnical-desc_heading">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 font-15 text-gray-clr">
                                                                            <div
                                                                                class="tecnical-desc_info-col font-15 text-gray-clr font-main-light">
                                                                                {!! $vape->long_description !!}
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if($vape->main_item &&  $vape->main_item->specifications_with_children  && count($vape->main_item->specifications_with_children))
                                                            <div class="technical-features">
                                                                <h3 class="tecnical-desc_sub-title font-main-bold font-24 text-uppercase">
                                                                    {!! __('features') !!}</h3>
                                                                <div class="d-flex flex-wrap technical-features-content
                                                                    @if(count($vape->main_item->specifications_with_children) >= 10 ) technical-features-content-to-col @endif">
                                                                    @if(count($vape->main_item->specifications_with_children) >= 10)
                                                                        <div class="w-100">
                                                                        <div class="row ">
                                                                            @foreach($vape->main_item->specifications_with_children as $stockAttr)
                                                                                    @if($loop->iteration % 2 == 0)
                                                                                        <div class="col-md-6">
                                                                                            <div
                                                                                                class="d-flex technical-features-content-wall">
                                                                                                <div
                                                                                                    class="technical-features-content-left">
                                                                                                    <div
                                                                                                        class="d-flex align-items-center h-100">
                                                                                    <span
                                                                                        class="font-18 text-sec-clr technical-features-content-title">{{ $stockAttr->attr->name }}</span>
                                                                                                        @if($stockAttr->attr->description)
                                                                                                            <span data-toggle="tooltip"
                                                                                                                  data-placement="top"
                                                                                                                  title="{!! $stockAttr->attr->description !!}">
                                                                                                    <svg
                                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                                        width="24px"
                                                                                                        height="24px"
                                                                                                        viewBox="0 0 24 24">
                                                                                                        <path
                                                                                                            fill-rule="evenodd"
                                                                                                            fill="rgb(255, 255, 255)"
                                                                                                            d="M11.997,0.012 C5.379,0.012 0.012,5.379 0.012,11.997 C0.012,18.616 5.379,23.983 11.997,23.983 C18.616,23.983 23.983,18.616 23.983,11.997 C23.983,5.379 18.616,0.012 11.997,0.012 ZM14.492,18.587 C13.876,18.830 13.384,19.016 13.016,19.143 C12.649,19.271 12.222,19.336 11.736,19.336 C10.988,19.336 10.407,19.151 9.993,18.789 C9.579,18.424 9.373,17.962 9.373,17.401 C9.373,17.183 9.389,16.959 9.419,16.732 C9.451,16.506 9.500,16.250 9.568,15.962 L10.340,13.236 C10.408,12.972 10.467,12.723 10.514,12.492 C10.560,12.259 10.583,12.045 10.583,11.850 C10.583,11.503 10.511,11.259 10.368,11.123 C10.223,10.985 9.949,10.918 9.543,10.918 C9.344,10.918 9.139,10.948 8.929,11.010 C8.721,11.073 8.540,11.132 8.392,11.188 L8.596,10.348 C9.101,10.142 9.585,9.966 10.047,9.820 C10.509,9.671 10.945,9.598 11.356,9.598 C12.098,9.598 12.670,9.779 13.073,10.136 C13.474,10.494 13.676,10.960 13.676,11.532 C13.676,11.651 13.662,11.860 13.634,12.159 C13.606,12.458 13.555,12.730 13.479,12.982 L12.711,15.701 C12.649,15.920 12.593,16.169 12.542,16.447 C12.492,16.726 12.468,16.940 12.468,17.084 C12.468,17.444 12.548,17.691 12.710,17.822 C12.871,17.953 13.153,18.020 13.549,18.020 C13.737,18.020 13.947,17.986 14.185,17.920 C14.421,17.855 14.591,17.797 14.698,17.747 L14.492,18.587 ZM14.356,7.550 C13.999,7.883 13.567,8.049 13.062,8.049 C12.560,8.049 12.125,7.883 11.764,7.550 C11.405,7.217 11.223,6.812 11.223,6.339 C11.223,5.868 11.406,5.462 11.764,5.126 C12.125,4.789 12.560,4.621 13.062,4.621 C13.567,4.621 13.999,4.789 14.356,5.126 C14.714,5.462 14.894,5.868 14.894,6.339 C14.894,6.813 14.714,7.217 14.356,7.550 Z"/>
                                                                                                    </svg>
                                                                                                </span>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="technical-features-content-right">
                                                                                                    <div
                                                                                                        class="d-flex align-items-center h-100">
                                                                                    <span
                                                                                        class="font-18 text-gray-clr font-main-light technical-features-content-desc">
                                                                                        @foreach($stockAttr->children as $child)
                                                                                            <a href="{{ route('stickers',$child->sticker->slug) }}">{{ $child->sticker->name }} </a>
                                                                                            @if(! $loop->last)
                                                                                                ,
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="col-md-6">
                                                                                            <div
                                                                                                class="d-flex technical-features-content-wall">
                                                                                                <div
                                                                                                    class="technical-features-content-left">
                                                                                                    <div
                                                                                                        class="d-flex align-items-center h-100">
                                                                                    <span
                                                                                        class="font-18 text-sec-clr technical-features-content-title">{{ $stockAttr->attr->name }}</span>
                                                                                                        @if($stockAttr->attr->description)
                                                                                                            <span data-toggle="tooltip"
                                                                                                                  data-placement="top"
                                                                                                                  title="{!! $stockAttr->attr->description !!}">
                                                                                                    <svg
                                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                                        width="24px"
                                                                                                        height="24px"
                                                                                                        viewBox="0 0 24 24">
                                                                                                        <path
                                                                                                            fill-rule="evenodd"
                                                                                                            fill="rgb(255, 255, 255)"
                                                                                                            d="M11.997,0.012 C5.379,0.012 0.012,5.379 0.012,11.997 C0.012,18.616 5.379,23.983 11.997,23.983 C18.616,23.983 23.983,18.616 23.983,11.997 C23.983,5.379 18.616,0.012 11.997,0.012 ZM14.492,18.587 C13.876,18.830 13.384,19.016 13.016,19.143 C12.649,19.271 12.222,19.336 11.736,19.336 C10.988,19.336 10.407,19.151 9.993,18.789 C9.579,18.424 9.373,17.962 9.373,17.401 C9.373,17.183 9.389,16.959 9.419,16.732 C9.451,16.506 9.500,16.250 9.568,15.962 L10.340,13.236 C10.408,12.972 10.467,12.723 10.514,12.492 C10.560,12.259 10.583,12.045 10.583,11.850 C10.583,11.503 10.511,11.259 10.368,11.123 C10.223,10.985 9.949,10.918 9.543,10.918 C9.344,10.918 9.139,10.948 8.929,11.010 C8.721,11.073 8.540,11.132 8.392,11.188 L8.596,10.348 C9.101,10.142 9.585,9.966 10.047,9.820 C10.509,9.671 10.945,9.598 11.356,9.598 C12.098,9.598 12.670,9.779 13.073,10.136 C13.474,10.494 13.676,10.960 13.676,11.532 C13.676,11.651 13.662,11.860 13.634,12.159 C13.606,12.458 13.555,12.730 13.479,12.982 L12.711,15.701 C12.649,15.920 12.593,16.169 12.542,16.447 C12.492,16.726 12.468,16.940 12.468,17.084 C12.468,17.444 12.548,17.691 12.710,17.822 C12.871,17.953 13.153,18.020 13.549,18.020 C13.737,18.020 13.947,17.986 14.185,17.920 C14.421,17.855 14.591,17.797 14.698,17.747 L14.492,18.587 ZM14.356,7.550 C13.999,7.883 13.567,8.049 13.062,8.049 C12.560,8.049 12.125,7.883 11.764,7.550 C11.405,7.217 11.223,6.812 11.223,6.339 C11.223,5.868 11.406,5.462 11.764,5.126 C12.125,4.789 12.560,4.621 13.062,4.621 C13.567,4.621 13.999,4.789 14.356,5.126 C14.714,5.462 14.894,5.868 14.894,6.339 C14.894,6.813 14.714,7.217 14.356,7.550 Z"/>
                                                                                                    </svg>
                                                                                                </span>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="technical-features-content-right">
                                                                                                    <div
                                                                                                        class="d-flex align-items-center h-100">
                                                                                    <span
                                                                                        class="font-18 text-gray-clr font-main-light technical-features-content-desc">
                                                                                        @foreach($stockAttr->children as $child)
                                                                                            <a href="{{ route('stickers',$child->sticker->slug) }}">{{ $child->sticker->name }} </a>
                                                                                            @if(! $loop->last)
                                                                                                ,
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                            @endforeach
                                                                        </div>
                                                                        </div>
                                                                    @else
                                                                        @foreach($vape->main_item->specifications_with_children as $stockAttr)
                                                                                <div
                                                                                            class="d-flex technical-features-content-wall">
                                                                                            <div
                                                                                                class="technical-features-content-left">
                                                                                                <div
                                                                                                    class="d-flex align-items-center h-100">
                                                                                    <span
                                                                                        class="font-18 text-sec-clr technical-features-content-title">{{ $stockAttr->attr->name }}</span>
                                                                                                    @if($stockAttr->attr->description)
                                                                                                        <span data-toggle="tooltip"
                                                                                                              data-placement="top"
                                                                                                              title="{!! $stockAttr->attr->description !!}">
                                                                                                    <svg
                                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                                        width="24px"
                                                                                                        height="24px"
                                                                                                        viewBox="0 0 24 24">
                                                                                                        <path
                                                                                                            fill-rule="evenodd"
                                                                                                            fill="rgb(255, 255, 255)"
                                                                                                            d="M11.997,0.012 C5.379,0.012 0.012,5.379 0.012,11.997 C0.012,18.616 5.379,23.983 11.997,23.983 C18.616,23.983 23.983,18.616 23.983,11.997 C23.983,5.379 18.616,0.012 11.997,0.012 ZM14.492,18.587 C13.876,18.830 13.384,19.016 13.016,19.143 C12.649,19.271 12.222,19.336 11.736,19.336 C10.988,19.336 10.407,19.151 9.993,18.789 C9.579,18.424 9.373,17.962 9.373,17.401 C9.373,17.183 9.389,16.959 9.419,16.732 C9.451,16.506 9.500,16.250 9.568,15.962 L10.340,13.236 C10.408,12.972 10.467,12.723 10.514,12.492 C10.560,12.259 10.583,12.045 10.583,11.850 C10.583,11.503 10.511,11.259 10.368,11.123 C10.223,10.985 9.949,10.918 9.543,10.918 C9.344,10.918 9.139,10.948 8.929,11.010 C8.721,11.073 8.540,11.132 8.392,11.188 L8.596,10.348 C9.101,10.142 9.585,9.966 10.047,9.820 C10.509,9.671 10.945,9.598 11.356,9.598 C12.098,9.598 12.670,9.779 13.073,10.136 C13.474,10.494 13.676,10.960 13.676,11.532 C13.676,11.651 13.662,11.860 13.634,12.159 C13.606,12.458 13.555,12.730 13.479,12.982 L12.711,15.701 C12.649,15.920 12.593,16.169 12.542,16.447 C12.492,16.726 12.468,16.940 12.468,17.084 C12.468,17.444 12.548,17.691 12.710,17.822 C12.871,17.953 13.153,18.020 13.549,18.020 C13.737,18.020 13.947,17.986 14.185,17.920 C14.421,17.855 14.591,17.797 14.698,17.747 L14.492,18.587 ZM14.356,7.550 C13.999,7.883 13.567,8.049 13.062,8.049 C12.560,8.049 12.125,7.883 11.764,7.550 C11.405,7.217 11.223,6.812 11.223,6.339 C11.223,5.868 11.406,5.462 11.764,5.126 C12.125,4.789 12.560,4.621 13.062,4.621 C13.567,4.621 13.999,4.789 14.356,5.126 C14.714,5.462 14.894,5.868 14.894,6.339 C14.894,6.813 14.714,7.217 14.356,7.550 Z"/>
                                                                                                    </svg>
                                                                                                </span>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="technical-features-content-right">
                                                                                                <div
                                                                                                    class="d-flex align-items-center h-100">
                                                                                    <span
                                                                                        class="font-18 text-gray-clr font-main-light technical-features-content-desc">
                                                                                        @foreach($stockAttr->children as $child)
                                                                                            <a href="{{ route('stickers',$child->sticker->slug) }}">{{ $child->sticker->name }} </a>
                                                                                            @if(! $loop->last)
                                                                                                ,
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if(trim(strip_tags($vape->what_is_content)))
                                                            <div class="technical-inside-box">
                                                                <h3 class="tecnical-desc_sub-title font-main-bold font-24 text-uppercase">
                                                                    {!! __('inside_box') !!}</h3>
                                                                <div class="d-flex flex-wrap technical-inside-box-inner">
                                                                    <div class="technical-inside-box-left lh-1">
                                                                        {!! $vape->what_is_content !!}
                                                                    </div>
                                                                    <div class="technical-inside-box-right">
                                                                        <div class="technical-inside-box-photo">
                                                                            @if($vape->what_is_image)
                                                                                <img src="{{ $vape->what_is_image }}"
                                                                                     alt="what is in box">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if($vape->banners && count($vape->banners))

                                                            <div class="tecnical_gallery">
                                                                <div class="tecnical_gallery-all">
                                                                    @foreach($vape->banners as $banner)
                                                                        @if(pathinfo($banner->image,PATHINFO_EXTENSION) == 'html')
                                                                            @php
                                                                                $banner = ltrim($banner->image, '/');
                                                                                $html = (File::exists($banner)) ? File::get($banner) : "";
                                                                            @endphp
                                                                            <div>
                                                                                <a href="{!! $html !!}"
                                                                                   class="tecnical_gallery_obj-holder lightbox-item"
                                                                                   data-lightbox-gallery="gallery_name">
                                                                                        {!! $html !!}
                                                                                </a>
                                                                            </div>
                                                                        @else
                                                                            <div>
                                                                                <a href="{{ checkImage($banner->image) }}"
                                                                                   class="tecnical_gallery_obj-holder lightbox-item"
                                                                                   data-lightbox-gallery="gallery_name"
                                                                                   title="yyyyyyyy{!! @getImage($banner->image)->seo_alt !!}">
                                                                                    <img src="{{ checkImage($banner->image) }}"
                                                                                         alt="{!! $banner->alt !!}-gallery"
                                                                                         title="{!! $banner->tags !!}-gallery"
                                                                                    >
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="product_single-right-ads">
                                                        @if($vape->ads && count($vape->ads))
                                                            @foreach($vape->ads as $ad)
                                                                <div class="single-ads-wall">
                                                                    <a href="{!! $ad->url !!}" target="_blank" class="d-block h-100">
                                                                        <img src="{!! $ad->image !!}" alt="{!! $ad->tags !!}">
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            @if($ads && isset($ads['images']))
                                                                @foreach($ads['images'] as $key => $ad)
                                                                    <div class="single-ads-wall">
                                                                        <a href="{!! $ads['urls'][$key] !!}" target="_blank" class="d-block h-100">
                                                                            <img src="{!! $ad !!}" alt="{!! $ads['tags'][$key] !!}">
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="tab-pane related-tab-pane fade show" id="pills-related"
                                             role="tabpanel"
                                             aria-labelledby="pills-related-tab">
                                            <div class="d-flex flex-wrap">
                                                <div class="product_single-main-tab-content">
                                                    @include("frontend.products._partials.products_render",['products' => $vape->related_products,'related' => true])
                                                </div>
                                                <div class="product_single-right-ads">
                                                    @if($vape->ads && count($vape->ads))
                                                        @foreach($vape->ads as $ad)
                                                            <div class="single-ads-wall">
                                                                <a href="{!! $ad->url !!}" target="_blank" class="d-block h-100">
                                                                    <img src="{!! $ad->image !!}" alt="{!! $ad->tags !!}">
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @if($ads && isset($ads['images']))
                                                            @foreach($ads['images'] as $key => $ad)
                                                                <div class="single-ads-wall">
                                                                    <a href="{!! $ads['urls'][$key] !!}" target="_blank" class="d-block h-100">
                                                                        <img src="{!! $ad !!}" alt="{!! $ads['tags'][$key] !!}">
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        @if($vape->reviews_tab && count($reviews))
                                            <div class="tab-pane fade show" id="pills-reviews" role="tabpanel"
                                                 aria-labelledby="pills-tecnical-tab">
                                                @foreach($reviews as $review)
                                                    <section class="reviews__card-wrapper">
                                                        <blockquote class="rating__card__quote">“{!! $review->review !!}”</blockquote>

                                                        <div class="rating__card__stars">
                                                            <span class="fa fa-star {{ ($review->rate >= \App\Enums\ReviewStatusTypes::STAR1 )?'checked':'' }}"></span>
                                                            <span class="fa fa-star {{ ($review->rate >= \App\Enums\ReviewStatusTypes::STAR2 )?'checked':'' }}"></span>
                                                            <span class="fa fa-star {{ ($review->rate >= \App\Enums\ReviewStatusTypes::STAR3 )?'checked':'' }}"></span>
                                                            <span class="fa fa-star {{ ($review->rate >= \App\Enums\ReviewStatusTypes::STAR4 )?'checked':'' }}"></span>
                                                            <span class="fa fa-star {{ ($review->rate >= \App\Enums\ReviewStatusTypes::STAR5 )?'checked':'' }}"></span>
                                                        </div>
                                                        <p class="rating__card__bottomText">by {!! $review->nickname !!} on {!! BBgetDateFormat($review->created_at) !!}</p>
                                                    </section>
                                                @endforeach

                                            </div>
                                        @endif
                                        @if($vape->faq_tab && count($vape->faqs))
                                            <div class="tab-pane fade show" id="pills-faq" role="tabpanel"
                                                 aria-labelledby="pills-faq-tab">
                                                <div class="faq-wrapper">
                                                    @foreach($vape->faqs as $faq)
                                                        <div class="accordion offset-top-0" role="tablist"
                                                             aria-multiselectable="true" id="accordion-3">
                                                            <div class="card card-accordion"><a
                                                                    class="card-header collapsed" href="#"
                                                                    data-toggle="collapse"
                                                                    data-target="#accordion-3--card-0-content"
                                                                    id="accordion-3--card-0-header"
                                                                    aria-expanded="false"
                                                                    aria-controls="accordion-3--card-0-content"> {!! $faq->question !!}</a>
                                                                <div class="collapse"
                                                                     id="accordion-3--card-0-content"
                                                                     aria-labelledby="accordion-3--card-0-header"
                                                                     data-parent="#accordion-3" style="">
                                                                    <div
                                                                        class="card-body">{!! $faq->answer !!}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        @endif
                                        @if($vape->videos && count($vape->videos))
                                        <div class="tab-pane fade show" id="pills-videos" role="tabpanel"
                                             aria-labelledby="pills-videos-tab">
                                            <div class="row video-carousel-wrap">
                                                <div class="col-2">
                                                    <div class="video--carousel-thumb d-flex flex-column"
                                                         data-carousel-controller-for=".video--carousel">
                                                        @foreach($vape->videos as $video)
                                                            <div class="video-item-thumb"><img
                                                                    src="https://img.youtube.com/vi/{{ $video }}/maxresdefault.jpg"
                                                                    alt="{{ $video }}"></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-10">
                                                    <div class="video--carousel">
                                                        @foreach($vape->videos as $video)
                                                            <div class="video-item">
                                                                <iframe width="100%" height="415"
                                                                        src="https://www.youtube.com/embed/{{ $video }}?enablejsapi=1&version=3&playerapiid=ytplayer"
                                                                        frameborder="0"
                                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                                        allowfullscreen></iframe>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($vape->special_offers && count($vape->special_offers))
                                        <div class="tab-pane fade show" id="pills-offers" role="tabpanel"
                                             aria-labelledby="pills-offers-tab">
                                            <div class="d-flex flex-wrap">
                                                <div class="product_single-main-tab-content">
                                                    @include("frontend.products._partials.products_render",['products' => $vape->special_offers])
                                                </div>
                                                <div class="product_single-right-ads">
                                                    @if($vape->ads && count($vape->ads))
                                                        @foreach($vape->ads as $ad)
                                                            <div class="single-ads-wall">
                                                                <a href="{!! $ad->url !!}" target="_blank" class="d-block h-100">
                                                                    <img src="{!! $ad->image !!}" alt="{!! $ad->tags !!}">
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @if($ads && isset($ads['images']))
                                                            @foreach($ads['images'] as $key => $ad)
                                                                <div class="single-ads-wall">
                                                                    <a href="{!! $ads['urls'][$key] !!}" target="_blank" class="d-block h-100">
                                                                        <img src="{!! $ad !!}" alt="{!! $ads['tags'][$key] !!}">
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--scroll top button-->
                <button id="scrollTopBtn"
                        class="scroll-top-btn d-flex align-items-center justify-content-center pointer">
                    <svg viewBox="0 0 17 10" width="17px" height="10px">
                        <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                              d="M0.000,8.111 L1.984,10.005 L8.498,3.789 L15.010,10.005 L16.995,8.111 L8.498,0.001 L0.000,8.111 Z"></path>
                    </svg>
                </button>
            </main>
        </div>
    </div>

    @if(! $vape->is_offer)
        <div class="modal fade p-0" id="specialPopUpModal" tabindex="-1" role="dialog"
             aria-labelledby="specialPopUpModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable mw-100" role="document">
                <div class="modal-content">
                    <div class="modal-header special__popup-head">
                        <h5 class="font-sec-reg font-26 text-sec-clr modal-title" id="specialPopUpModalTitle">{!! __('special_offer') !!}</h5>
                        <div class="font-main-light font-20 text-main-clr align-self-stretch text-truncate special__popup-head-mid">
                            <span class="w-100 text-truncate">{!! __('special_offer_desc') !!}</span>

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
    @endif
@stop

@section('css')
    <link href="/public/plugins/formstone/carousel/carousel.css" rel="stylesheet">
    <link href="/public/plugins/formstone/lightbox/lightbox.css" rel="stylesheet">
    <link href="/public/plugins/formstone/light.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css"/>
    <link type="text/css" rel="stylesheet"
          href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css"/>

    <style>
        .technical-features-content.technical-features-content-to-col{
max-width: 100%;
        }
        .technical-features-content.technical-features-content-to-col .technical-features-content-left{
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }
        .technical-features-content.technical-features-content-to-col .technical-features-content-right{
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }
        .technical-features-content.technical-features-content-to-col  .technical-features-content-wall{
            height: 100%;
        }
        .products__item-favourite.active svg path {
            fill: #ee3a50;
        }

        .products__item-favourite {
            cursor: pointer;
        }

        .share-social-btn {
            position: relative;
        }

        .product-share-social {
            background: #353636;
            visibility: hidden;
            opacity: 0;
            transition: all .5s;
            position: absolute;
            right: 0;
            top: 150%;
        }

        .product-share-social .jssocials-share {
            margin-right: 0;
        }

        .product-share-social:before {
            position: absolute;
            bottom: 100%;
            right: 5px;
            content: '';
            display: inline-block;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 10px 16px 10px;
            border-color: transparent transparent #353636 transparent;
        }

        .product-share-social .jssocials-shares {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }

        .share-social-btn:hover .product-share-social {
            visibility: visible;
            opacity: 1;
        }

        .video--carousel-thumb .fs-carousel-active {
            border: 2px solid #5184e5 !important;
        }

        .video--carousel-thumb .fs-carousel-item {
            border: 2px solid transparent;
        }

        .product-single-info_radio-label:before {
            border-radius: 50%;
        }
    </style>
@stop

@section("js")
    <script src="/public/plugins/formstone/core.js"></script>
    <script src="/public/plugins/formstone/mediaquery.js"></script>
    <script src="/public/plugins/formstone/touch.js"></script>
    <script src="/public/plugins/formstone/transition.js"></script>
    <script src="/public/plugins/formstone/lightbox/lightbox.js"></script>
    <script src="/public/plugins/formstone/carousel/carousel.js"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
    <script>
        //esia
        // var variations = {
        //     "group_id" : "5ca48c5f4401f",
        //     "products" : [
        //         {id:135,qty:1}
        //     ]
        // };

        $(document).ready(function () {
            $('.product-single-lightbox-item').lightbox()
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            // $.ajax({
            //     type: "post",
            //     url: "/add-extra-to-cart",
            //     cache: false,
            //     datatype: "json",
            //     data: {key: "5ca7011cc5a0a",product_id: $("#vpid").val(),variations:variations},
            //     headers: {
            //         "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            //     },
            //     success: function (data) {
            //         if (!data.error) {
            //             $(".cart-count").html(data.count)
            //             $('#cartSidebar').html(data.headerHtml)
            //             $("#headerShopCartBtn").trigger('click');
            //         } else {
            //
            //         }
            //     }
            // });

//          ----start  video carousel----
//             function Init () {
//                 var checkbox = document.getElement("myCheckbox");
//                 if (checkbox.addEventListener) {
//                     checkbox.addEventListener ("CheckboxStateChange", OnChangeCheckbox, false);
//                 }
//             }
//
//             function OnChangeCheckbox (event) {
//                 var checkbox = event.target;
//                 if (checkbox.checked) {
//                     alert ("The check box is checked.");
//                 }
//                 else {
//                     alert ("The check box is not checked.");
//                 }
//             }


//          ----end  video carousel----

            $(".tecnical_gallery_obj-holder").lightbox();

            $(".lightbox-product").lightbox();
            $('body').on('change', '.products_custom_check input', function () {
                if ($(this).is(':checked')) {
                    $(this).closest('.product-single-info_row').find('.extra-product').removeClass('products_closed')
                } else {
                    $(this).closest('.product-single-info_row').find('.extra-product').addClass('products_closed')
                }

            })


            $("body").on('change', '.select-variation-option', function () {
                get_price();
                call_subtotal();
            });

            $("body").on('change', '.select-variation-radio-option', function () {
                get_price();
                call_subtotal();
            });

            $("body").on('click', '.optional_checkbox', function () {
                get_subTotalPrice();
            });

            $("body").on('click', '.add-to-cart', function () {

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
                        url: "/add-to-cart",
                        cache: false,
                        datatype: "json",
                        data: {uid: variationId, requiredItems: requiredItems, optionalItems: optionalItems},
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            if (!data.error) {
                                $(".cart-count").html(data.count)
                                $('#cartSidebar').html(data.headerHtml)
                                $("#headerShopCartBtn").trigger('click');
                            } else {

                            }
                        }
                    });
                } else {
                    alert('Select available variation');
                }
            })


            function get_price() {
                var uid = $("#vpid").val();
                var items = document.getElementsByClassName('select-variation-option');
                $(".btn-add-to-cart").removeClass('add-to-cart');
                let options = {};
                for (var i = 0; i < items.length; i++) {
                    options[$(items[i]).data('name')] = $(items[i]).val();
                }

                $.map($("[data-main-stock='" + uid + "'] input:radio:checked"), function (elem, idx) {
                    options[$(elem).data('name')] = $(elem).val();
                });

                $.ajax({
                    type: "post",
                    url: "/products/get-price",
                    cache: false,
                    datatype: "json",
                    data: {options: options, uid: uid},
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        if (!data.error) {
                            var price = data.price;
                            if (data.message) {
                                price = "<span class='d-inline-block font-16'>" + data.message + "</span>" + data.price;
                            }
                            $(".price-place").html(price);
                            $("#variation_uid").val(data.variation_id);
                            $(".btn-add-to-cart").addClass('add-to-cart');

                            $(".product-card-thumbs").find('[data-id="' + data.variation_id + '"]').trigger("mouseover");
                            if (data.isFavorite) {
                                $(".add-fav-variation").removeClass('d-none').data('id', data.variation_id).addClass('active');
                            } else {
                                $(".add-fav-variation").removeClass('d-none').data('id', data.variation_id).removeClass('active');
                            }

                        } else {
                            $(".price-place").html('<span class="d-inline-block font-16">' + data.message + '</span>');
                            $("#variation_uid").val('');
                            $(".add-fav-variation").addClass('d-none').data('id', '').removeClass('active');
                        }
                    }
                });
            }

            function get_subTotalPrice() {
                var variationId = $("#variation_uid").val();

                if (variationId && variationId != '') {
                    var requiredItems = [];
                    var optionalItems = [];

                    var requiredItemsData = $(".required_item");
                    var optionalItemsData = $(".optional_item");

                    console.log(requiredItemsData, 445445454465)
                    optionalItemsData.each(function (i, e) {
                        if ($(e).parent().find('.optional_checkbox').is(':checked')) {
                            optionalItems.push($(e).val());
                        }
                    });

                    requiredItemsData.each(function (i, e) {
                        requiredItems.push($(e).val());
                    });

                    $.ajax({
                        type: "post",
                        url: "/products/get-subtotal-price",
                        cache: false,
                        datatype: "json",
                        data: {uid: variationId, requiredItems: requiredItems, optionalItems: optionalItems},
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            if (!data.error) {
                                $(".price-place-summary").html(data.price)
                            } else {
                                $(".price-place-summary").html(data.message)
                            }
                        }
                    });
                }
            }

            function call_extra_products() {
                var plist = $(".poptions-group");
                for (var i = 0; i < plist.length; i++) {
                    get_promotion_price($(plist[i]).data('promotion'))
                }
            }

            $("body").on('change', '.select-variation-poption', function () {
                var pid = $(this).closest('.poptions-group').data('promotion');
                get_promotion_price(pid);
                call_subtotal();
            });

            $("body").on('change', '.select-variation-radio-poption', function () {
                var pid = $(this).closest('.poptions-group').data('promotion');
                get_promotion_price(pid);
                call_subtotal();
            });

            function get_promotion_price(pid) {
                let options = {};
                var uid = $("#vpid").val();
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
                    data: {options: options, uid: pid, promotion: true, stock_id: uid},
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        if (!data.error) {
                            var price = data.price;
                            if (data.message) {
                                price = "<span class='d-inline-block font-16'>" + data.message + "</span>" + data.price;
                            }

                            $("[data-promotion='" + pid + "'] .price-place-promotion").html(price);
                            $("[data-promotion='" + pid + "'] .variation_items").val(data.variation_id);
//                        $("#variation_uid").val(data.variation_id);
//                        $(".btn-add-to-cart").addClass('add-to-cart');
                        } else {
                            $("[data-promotion='" + pid + "'] .price-place-promotion").html('<span class="d-inline-block font-16">' + data.message + '</span>');
                            $("[data-promotion='" + pid + "'] .variation_items").val('');
//                        $("#variation_uid").val('');
                        }
                    }
                });
            }

            async function getP() {
                await get_price();
                await call_extra_products();
            }

            getP();

            function call_subtotal(time = 300) {
                setTimeout(
                    function () {
                        get_subTotalPrice();
                    }, time);
            }

            call_subtotal(500);

            $("body").on('click', '.product-card_like-icon', function () {

                let url;
                let is_active = $(this).hasClass("active");

                url = (is_active) ? "/my-account/delete_favourites" : "/my-account/add_favourites";

                let variation_id = $(this).attr("data-id");
                let _this = $(this);
                console.log(`${variation_id}  ---->  `, _this);
                if (variation_id) {
                    $.ajax({
                        type: "post",
                        url: url,
                        cache: false,
                        data: {
                            id: variation_id
                        },
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            console.log(data);
                            if (!data.error) {
                                _this.toggleClass("active")
                            } else {
                                alert("error");
                            }
                        }
                    })
                }
            });


            $("#share").jsSocials({
                shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
            });

            $("#select_items").select2();
        });
    </script>
@stop
