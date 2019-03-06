@extends('layouts.frontend')
@section('content')
   <div class="main-content">
       <!--shopping dtls fixed at the bottom-->
       <div class="continue-shp-wrapp">
           <div class="container main-max-width h-100 p-0">
               <div class="d-flex flex-lg-row flex-column align-items-center justify-content-between h-100">
                   <a href="{{ route('categories_front') }}"
                      class="continue-shp-wrapp_link font-sec-bold font-21 text-light-clr text-uppercase">continue
                       shopping</a>
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
                       {!! Form::number('',1,['class' => 'field-input w-100 h-100 font-23 text-center border-0 product-qty-select','min' => 'number']) !!}
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
                          class="btn-add-to-cart product-card_btn d-inline-flex align-items-center justify-content-between text-center font-15 text-sec-clr text-uppercase">
                           <span class="product-card_btn-text">add to cart</span>
                           <span class="d-inline-block ml-auto">
                            <svg viewBox="0 0 18 22" width="18px" height="22px">
                                <path fill-rule="evenodd" opacity="0.8" fill="rgb(255, 255, 255)"
                                      d="M14.305,3.679 L14.305,0.003 L3.694,0.003 L3.694,3.679 L-0.004,3.679 L-0.004,21.998 L18.003,21.998 L18.003,3.679 L14.305,3.679 ZM4.935,1.216 L13.064,1.216 L13.064,3.679 L4.935,3.679 L4.935,1.216 ZM16.761,20.785 L1.238,20.785 L1.238,4.891 L3.694,4.891 L3.694,7.329 L4.935,7.329 L4.935,4.891 L13.064,4.891 L13.064,7.329 L14.305,7.329 L14.305,4.891 L16.761,4.891 L16.761,20.785 Z"></path>
                            </svg>
                        </span>
                       </a>
                       <span class="product-card_price d-inline-block font-sec-bold font-41 text-tert-clr lh-1 position-relative">
                        <span class="price-place-summary"></span>
                    </span>
                   </div>
               </div>

           </div>

       </div>

       <!--main-content-->
       <div id="singleProductPageCnt" class="single-product-page-cnt d-flex flex-column">
           <main class="position-relative">
               <!--breadcrump-->
               <div class="main-content container main-max-width main-content-wrapper">
                   <div class="content-head d-flex flex-wrap justify-content-between">
                       <div class="left-head d-flex align-items-center mb-lg-0 mb-2">
                           {{ Breadcrumbs::render('single_product',$type,$vape->name) }}
                       </div>
                   </div>
               </div>
               <div class="products-wrap">
                   <div class="container main-max-width single-product-dtls-wrap-outer pr-lg-0">
                       <div class="row">
                           <div class="col-md-10 col-12">
                               <div class="single-product-dtls-wrap">
                                   <div class="d-flex flex-xl-nowrap flex-wrap">
                                       <div class="product-single-view-outer">
                                           <div class="align-items-center single-product-main-title mb-3 d-none visible-on-small">
                                               <!--like icon-->
                                               @if(Auth::check())
                                                   <span class="like-icon d-inline-flex align-items-center justify-content-center rounded-circle pointer @if(Auth::user()->favorites()->exists($vape->id)) active @endif"> <!--gets class active-->
                                                    <svg viewBox="0 0 20 18" width="20px" height="18px">
                                                        <path fill-rule="evenodd" opacity="0.949"
                                                              fill="rgb(255, 255, 255)"
                                                              d="M14.698,-0.003 C13.055,-0.003 11.417,0.767 10.358,2.015 C9.299,0.767 7.661,-0.003 6.017,-0.003 C3.034,-0.003 0.718,2.306 0.718,5.280 C0.718,8.935 3.994,11.915 9.007,16.336 L10.358,17.677 L11.709,16.336 C16.722,11.915 19.998,8.935 19.998,5.280 C19.998,2.306 17.682,-0.003 14.698,-0.003 L14.698,-0.003 Z"/>
                                                    </svg>
                                                </span>
                                               @endif
                                               <h2 class="font-36 mb-0">{!! $vape->name !!}</h2>
                                           </div>
                                           <div class="product-card_view product-card_view--single position-relative">
                                               <!--product main image-->
                                               @if($vape->image)
                                                   <div>
                                                       <img class="single-product_top-img" src="{!! checkImage($vape->image) !!}"
                                                            alt="{!! @getImage( $vape->image)->seo_alt !!}">
                                                   </div>
                                                @endif
                                           <!--new label-->
                                               <span class="new-label product-card_new-label d-inline-block text-uppercase font-main-bold font-16 text-sec-clr position-absolute">new</span>
                                               <!--sale label-->
                                               <span class="sale-label product-card_sale-label d-inline-block text-uppercase font-main-bold font-16 text-sec-clr position-absolute">-10%</span>
                                           </div>

                                           <div class="d-flex product-card-thumbs product-card-thumbs--single">
                                               @if($vape->image)
                                                   <div class="product-card_thumb-img-holder pointer active_slider">
                                                       <img class="" src="{!! checkImage($vape->image) !!}"
                                                            alt="{!! @getImage( $vape->image)->seo_alt !!}">
                                                   </div>
                                               @endif
                                               @if($vape->variations && count($vape->variations))
                                                   @foreach($vape->variations as $variation)
                                                       @if(isset($variation['image']))
                                                           <div class="product-card_thumb-img-holder pointer" data-id="{{ $variation['id'] }}">
                                                               <img class="" src="{{ checkImage($variation["image"]) }}"
                                                                    alt="{!! @getImage($variation["image"])->seo_alt !!}">
                                                           </div>
                                                       @endif
                                                   @endforeach
                                               @endif
                                           </div>

                                           <div class="product-card_icons mb-4">
                                            <span class="product-card_icon d-inline-block">
                                                <svg viewBox="0 0 22 22" width="22px" height="22px">
                                                    <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                                                          d="M21.685,8.354 C21.411,8.531 21.027,8.476 20.832,8.228 C19.735,6.842 18.346,5.753 16.700,4.994 C13.203,3.372 8.736,3.377 5.244,5.005 C3.593,5.775 2.198,6.870 1.107,8.266 C0.986,8.415 0.796,8.492 0.608,8.492 C0.486,8.492 0.364,8.459 0.254,8.393 C-0.020,8.217 -0.087,7.876 0.108,7.628 C1.314,6.088 2.856,4.878 4.684,4.026 C8.517,2.239 13.416,2.233 17.255,4.015 C19.076,4.862 20.612,6.061 21.824,7.590 C22.020,7.837 21.959,8.178 21.685,8.354 ZM18.047,2.717 C17.949,2.717 17.858,2.695 17.767,2.656 C15.433,1.567 13.403,1.100 10.978,1.100 C8.559,1.100 6.281,1.622 4.190,2.651 C3.892,2.794 3.526,2.701 3.362,2.431 C3.204,2.162 3.307,1.831 3.606,1.683 C5.879,0.566 8.359,-0.000 10.978,-0.000 C13.574,-0.000 15.841,0.517 18.327,1.678 C18.626,1.815 18.742,2.150 18.589,2.420 C18.479,2.607 18.266,2.717 18.047,2.717 ZM10.923,5.313 C16.463,5.313 20.972,9.179 20.972,13.931 C20.972,15.719 19.283,17.171 17.218,17.171 C15.153,17.171 13.464,15.719 13.464,13.931 C13.464,12.754 12.325,11.792 10.930,11.792 C9.534,11.792 8.395,12.749 8.395,13.931 C8.395,15.807 9.205,17.572 10.674,18.892 C11.825,19.926 12.947,20.498 14.665,20.922 C14.988,21.004 15.183,21.307 15.091,21.598 C15.018,21.840 14.775,22.000 14.507,22.000 C14.452,22.000 14.397,21.994 14.348,21.978 C12.404,21.499 11.137,20.850 9.821,19.668 C8.121,18.139 7.182,16.098 7.182,13.926 C7.182,12.138 8.864,10.686 10.936,10.686 C13.008,10.686 14.689,12.138 14.689,13.926 C14.689,15.103 15.829,16.065 17.225,16.065 C18.619,16.065 19.759,15.108 19.759,13.926 C19.759,9.779 15.798,6.408 10.930,6.408 C7.462,6.408 4.300,8.145 2.874,10.840 C2.399,11.731 2.162,12.771 2.162,13.926 C2.162,14.784 2.247,16.137 2.972,17.891 C3.088,18.177 2.930,18.491 2.612,18.601 C2.295,18.705 1.949,18.562 1.827,18.277 C1.229,16.830 0.937,15.411 0.937,13.926 C0.937,12.606 1.217,11.407 1.772,10.367 C3.398,7.299 6.993,5.313 10.923,5.313 ZM10.967,7.992 C14.775,7.992 17.870,10.648 17.870,13.920 C17.870,14.223 17.596,14.470 17.261,14.470 C16.926,14.470 16.651,14.223 16.651,13.920 C16.651,11.258 14.104,9.091 10.967,9.091 C7.835,9.091 5.281,11.258 5.281,13.920 C5.281,15.504 5.671,16.967 6.409,18.161 C7.195,19.426 7.719,19.971 8.657,20.823 C8.895,21.037 8.895,21.389 8.651,21.598 C8.541,21.714 8.383,21.763 8.230,21.763 C8.072,21.763 7.920,21.708 7.798,21.598 C6.744,20.636 6.171,20.025 5.349,18.700 C4.507,17.347 4.062,15.691 4.062,13.920 C4.062,10.653 7.158,7.992 10.967,7.992 ZM10.290,13.926 C10.290,13.624 10.564,13.376 10.899,13.376 C11.235,13.376 11.508,13.624 11.508,13.926 C11.508,15.472 12.392,16.934 13.873,17.842 C14.732,18.370 15.743,18.629 16.962,18.629 C17.255,18.629 17.748,18.601 18.236,18.524 C18.565,18.469 18.882,18.672 18.943,18.969 C19.004,19.266 18.778,19.552 18.449,19.607 C17.736,19.723 17.133,19.728 16.962,19.728 C15.512,19.728 14.239,19.398 13.184,18.755 C11.374,17.644 10.290,15.840 10.290,13.926 Z"/>
                                                </svg>
                                            </span>
                                               <span class="product-card_icon d-inline-block">
                                                <svg viewBox="0 0 21 21" width="21px" height="21px">
                                                    <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                                                          d="M20.261,5.781 C20.261,5.496 20.112,5.247 19.879,5.122 L10.825,0.298 C10.608,0.192 10.358,0.192 10.158,0.334 C9.957,0.459 9.841,0.708 9.841,0.957 L9.841,9.430 L1.788,5.122 C1.454,4.944 1.037,5.087 0.870,5.443 C0.704,5.799 0.837,6.244 1.171,6.422 L8.990,10.587 L1.171,14.788 C0.837,14.966 0.687,15.411 0.870,15.767 C0.987,16.016 1.237,16.176 1.488,16.176 C1.587,16.176 1.687,16.158 1.788,16.105 L9.841,11.797 L9.841,20.270 C9.841,20.519 9.957,20.751 10.158,20.893 C10.274,20.964 10.391,21.000 10.525,21.000 C10.625,21.000 10.742,20.982 10.825,20.929 L19.879,16.105 C20.112,15.980 20.261,15.731 20.261,15.446 C20.261,15.162 20.112,14.912 19.879,14.788 L12.058,10.605 L19.879,6.440 C20.112,6.315 20.261,6.065 20.261,5.781 ZM11.208,19.078 L11.208,11.797 L18.044,15.446 L11.208,19.078 ZM11.208,9.430 L11.208,2.132 L18.044,5.781 L11.208,9.430 Z"/>
                                                </svg>
                                            </span>
                                               <span class="product-card_icon d-inline-block">
                                                <svg viewBox="0 0 24 18" width="24px" height="18px">
                                                    <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                                                          d="M23.772,6.847 C23.644,6.962 23.479,7.025 23.305,7.025 C23.114,7.025 22.936,6.950 22.805,6.815 C20.000,3.898 16.204,2.291 12.114,2.291 C8.025,2.291 4.228,3.898 1.423,6.815 C1.293,6.951 1.114,7.025 0.922,7.025 C0.749,7.025 0.584,6.962 0.457,6.847 C0.181,6.599 0.166,6.178 0.423,5.911 C3.489,2.722 7.641,0.966 12.114,0.966 C16.587,0.966 20.739,2.722 23.805,5.911 C24.062,6.178 24.047,6.599 23.772,6.847 ZM12.114,5.689 C15.157,5.688 18.075,6.901 20.329,9.102 C20.458,9.228 20.528,9.394 20.528,9.571 C20.526,9.748 20.455,9.914 20.325,10.039 C20.196,10.163 20.025,10.231 19.844,10.231 C19.660,10.231 19.488,10.162 19.358,10.036 C17.363,8.087 14.791,7.014 12.115,7.014 C9.437,7.014 6.864,8.087 4.870,10.036 C4.741,10.162 4.568,10.231 4.384,10.231 C4.202,10.231 4.032,10.163 3.903,10.039 C3.635,9.782 3.634,9.361 3.899,9.102 C6.152,6.901 9.070,5.689 12.114,5.689 ZM12.035,10.453 L12.105,10.453 C13.651,10.453 15.348,11.161 16.535,12.300 C16.664,12.425 16.736,12.591 16.737,12.768 C16.738,12.944 16.667,13.111 16.539,13.237 C16.410,13.364 16.237,13.433 16.054,13.433 C15.872,13.433 15.701,13.365 15.572,13.242 C14.647,12.353 13.286,11.779 12.105,11.779 L12.036,11.779 C10.854,11.779 9.493,12.353 8.568,13.242 C8.439,13.365 8.269,13.433 8.087,13.433 C7.903,13.433 7.731,13.364 7.602,13.237 C7.336,12.978 7.338,12.557 7.605,12.300 C8.792,11.161 10.489,10.453 12.035,10.453 ZM12.066,15.450 C12.783,15.450 13.367,16.015 13.367,16.710 C13.367,17.405 12.783,17.971 12.066,17.971 C11.349,17.971 10.767,17.405 10.767,16.710 C10.767,16.015 11.349,15.450 12.066,15.450 Z"/>
                                                </svg>
                                            </span>
                                           </div>
                                       </div>
                                       <div class="product-single-info-outer">
                                           <div class="product-single-info">
                                               <div class="d-flex align-items-center single-product-main-title">
                                                   <!--like icon-->
                                                   @if(Auth::check())
                                                       <span data-id=""
                                                             class="add-fav-variation product-card_like-icon like-icon d-inline-flex align-items-center justify-content-center rounded-circle pointer d-none"> <!--gets class active-->
                                                        <svg viewBox="0 0 20 18" width="20px" height="18px">
                                                    <path fill-rule="evenodd" opacity="0.949" fill="rgb(255, 255, 255)"
                                                          d="M14.698,-0.003 C13.055,-0.003 11.417,0.767 10.358,2.015 C9.299,0.767 7.661,-0.003 6.017,-0.003 C3.034,-0.003 0.718,2.306 0.718,5.280 C0.718,8.935 3.994,11.915 9.007,16.336 L10.358,17.677 L11.709,16.336 C16.722,11.915 19.998,8.935 19.998,5.280 C19.998,2.306 17.682,-0.003 14.698,-0.003 L14.698,-0.003 Z"/>
                                                    </svg>
                                                    </span>
                                                   @endif
                                                   <h2 class="font-36 mb-0">{!! $vape->name !!}</h2>
                                               </div>
                                               <input type="hidden" value="{{ $vape->id }}" id="vpid">
                                               @include("admin.inventory._partials.render_price_form",['model' => $vape])
                                           </div>
                                       </div>
                                   </div>
                               </div>


                               {{--carousel--}}

                               <div class="product-single-tab">
                                   <div id="carousel-tabs-wrap" class="product-single-tab_nav-pills" role="tablist">
                                       <div class="carousel-tabs">
                                           <a class="nav-link product-single-tab_link font-20 font-main-bold main-transition active"
                                              data-toggle="pill" href="#pills-tecnical" role="tab"
                                              aria-controls="pills-tecnical" aria-selected="true">Tecnical</a>
                                           <a class="nav-link product-single-tab_link font-20 font-main-bold main-transition"
                                              data-toggle="pill" href="#pills-related" role="tab"
                                              aria-controls="pills-related" aria-selected="false">Related</a>
                                           @if($vape->reviews_tab)
                                               <a class="nav-link product-single-tab_link font-20 font-main-bold main-transition"
                                                  data-toggle="pill" href="#pills-reviews" role="tab"
                                                  aria-controls="pills-reviews" aria-selected="false">Reviews</a>
                                           @endif
                                           @if($vape->faq_tab)
                                               <a class="nav-link product-single-tab_link font-20 font-main-bold main-transition"
                                                  data-toggle="pill" href="#pills-faq" role="tab"
                                                  aria-controls="pills-faq" aria-selected="false">FAQ</a>
                                           @endif
                                       </div>
                                   </div>
                                   <div class="tab-content">
                                       <div class="tab-pane fade show active" id="pills-tecnical" role="tabpanel"
                                            aria-labelledby="pills-tecnical-tab">
                                           {{--<p class="product-single-tecnical-text font-15 font-main-light text-light-clr mb-0">--}}
                                           {{--{!! $vape->long_description !!}--}}
                                           {{--</p>--}}
                                           <div class="tecnical-desc tecnical_row">
                                               <h3 class="tecnical-desc_sub-title font-main-bold font-22 text-uppercase">
                                                   Description</h3>
                                               <div class="tecnical-desc_heading">
                                                   <div class="row">
                                                       <div class="col-lg-12 font-15 text-gray-clr">
                                                           <div class="tecnical-desc_info-col font-15 text-gray-clr">
                                                               {!! $vape->long_description !!}
                                                           </div>

                                                       </div>
                                                   </div>
                                               </div>
                                               <ul class="tecnical-labels list-unstyled d-flex">
                                                   @foreach($vape->stickers as $sticker)
                                                       <li class="tecnical-labels_item d-flex align-items-center">
                                                           <img src="{{ $sticker->image }}" alt=""
                                                                class="tecnical-labels_item-img rounded-circle">
                                                           <span class="tecnical-labels_item-text d-inline-block font-main-bold font-15">
                                                        {{ $sticker->name }}
                                                    </span>
                                                       </li>
                                                   @endforeach

                                               </ul>
                                           </div>
                                           <div class="tecnical-dtls tecnical_row">
                                               <h3 class="tecnical-desc_sub-title font-main-bold font-22 text-uppercase">
                                                   What's in the box</h3>

                                               <div class="d-flex">
                                                   <div class="tecnical-dtls_holder">
                                                       @if($vape->what_is_image)
                                                           <img src="{{ $vape->what_is_image }}" alt="">
                                                       @else
                                                           <img src="/public/img/temp/psoduct-descr.png" alt="">
                                                       @endif
                                                   </div>
                                                   <div class="tecnical-dtls_list list-unstyled mb-0">
                                                       {!! $vape->what_is_content !!}
                                                   </div>
                                               </div>

                                           </div>
                                           <div class="tecnical_spf tecnical_row">
                                               <h3 class="tecnical-desc_sub-title font-main-bold font-22 text-uppercase">
                                                   Specification</h3>

                                               <table class="tecnical_spf-table table font-16 w-100">
                                                   @foreach($vape->stockAttrs as $stockAttr)
                                                       <tr>
                                                           <th class="text-tert-clr">{{ $stockAttr->attr->name }}</th>
                                                           <td>
                                                               @foreach($stockAttr->children as $child)
                                                                   {{ $child->sticker->name }} @if(! $loop->last) , @endif
                                                               @endforeach
                                                           </td>
                                                       </tr>
                                                   @endforeach
                                               </table>
                                           </div>
                                           <div class="tecnical_gallery tecnical_row">
                                               <h3 class="tecnical-desc_sub-title font-main-bold font-22 text-uppercase">
                                                   Gallery</h3>
                                               <div class="tecnical_gallery-container mx-auto">

                                                   <div class="row video-carousel-wrap">
                                                       <div class="col-2">
                                                           <div class="video--carousel-thumb d-flex flex-column" data-carousel-controller-for=".video--carousel">
                                                               @if($vape->videos && count($vape->videos))
                                                                   @foreach($vape->videos as $video)
                                                                       <div class="video-item-thumb"><img src="https://img.youtube.com/vi/{{ $video }}/maxresdefault.jpg" alt="{{ $video }}"></div>
                                                                   @endforeach
                                                               @endif
                                                           </div>
                                                       </div>
                                                       <div class="col-10">
                                                           <div class="video--carousel">
                                                               @if($vape->videos && count($vape->videos))
                                                                   @foreach($vape->videos as $video)
                                                                       <div class="video-item"><iframe width="100%" height="415" src="https://www.youtube.com/embed/{{ $video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                                                                   @endforeach
                                                               @endif

                                                           </div>
                                                       </div>
                                                   </div>

                                                   @if($vape->other_images && count($vape->other_images))
                                                       @foreach($vape->other_images as $other_image)
                                                           <a href="{{ $other_image }}"
                                                              class="tecnical_gallery_obj-holder lightbox-item"
                                                              data-lightbox-gallery="gallery_name"
                                                              title="{!! @getImage($other_image)->seo_alt !!}">
                                                               <img src="{{ checkImage($other_image) }}"
                                                                    alt="{!! @getImage($other_image)->seo_alt !!}">
                                                           </a>
                                                       @endforeach
                                                   @endif
                                               </div>
                                           </div>
                                       </div>
                                       <div class="tab-pane related-tab-pane fade show" id="pills-related" role="tabpanel"
                                            aria-labelledby="pills-related-tab">
                                           <div class="display-grid row">
                                               {{--Start--}}

                                               @foreach($vape->related_products as $related_product)
                                                   <div class="col-md-3 products-wrap_col">
                                                       <div class="product-card position-relative">
                                                           <div class="product-card_view position-relative">
                                                               <!--product main image-->
                                                               <div>
                                                                   <img class="card-img-top"
                                                                        src="{{ checkImage($related_product->image) }}"
                                                                        alt="">
                                                               </div>
                                                               <!--like icon-->
                                                               <span class="like-icon product-card_like-icon d-inline-block pointer position-absolute active"> <!--gets class active-->
                                                                <svg viewBox="0 0 20 18" width="20px" height="18px">
                                                                    <path fill-rule="evenodd" opacity="0.949"
                                                                          fill="rgb(255, 255, 255)"
                                                                          d="M14.698,-0.003 C13.055,-0.003 11.417,0.767 10.358,2.015 C9.299,0.767 7.661,-0.003 6.017,-0.003 C3.034,-0.003 0.718,2.306 0.718,5.280 C0.718,8.935 3.994,11.915 9.007,16.336 L10.358,17.677 L11.709,16.336 C16.722,11.915 19.998,8.935 19.998,5.280 C19.998,2.306 17.682,-0.003 14.698,-0.003 L14.698,-0.003 Z"/>
                                                                </svg>
                                                            </span>
                                                               <!--new label-->
                                                               <span class="new-label product-card_new-label d-inline-block text-uppercase font-main-bold font-16 text-sec-clr position-absolute">new</span>
                                                           </div>
                                                           <div class="product-card_body">
                                                               <!--product image thumbs-->
                                                               <div class="d-flex product-card-thumbs">
                                                                   <div class="product-card_thumb-img-holder pointer active_slider">
                                                                       <img class="" src="{{checkImage($related_product->image)}}"
                                                                            alt=""
                                                                            data-img="1">
                                                                   </div>

                                                                   @if($related_product->variations)
                                                                       @foreach($related_product->variations as $related_product_v)
                                                                           @if($related_product_v->image)
                                                                               <div class="product-card_thumb-img-holder pointer">
                                                                                   <img class="" src="{{ checkImage($related_product_v->image) }}" alt="{{ $related_product_v->name }}">
                                                                               </div>
                                                                           @endif
                                                                       @endforeach
                                                                   @endif
                                                               </div>
                                                               <div class="product-card_body-text">
                                                                   <h2 class="card-title font-21 font-sec-bold">{{$related_product->name}}</h2>
                                                                   <p class="card-text font-main-light font-15 text-light-clr">
                                                                       {{$related_product->short_description}}
                                                                   </p>
                                                                   <div class="product-card_icons-outer d-flex justify-content-between align-items-center">
                                                                       <!--icons-->
                                                                       <div class="product-card_icons">
                                                                        <span class="product-card_icon d-inline-block">
                                                                            <svg viewBox="0 0 18 18" width="18px"
                                                                                 height="18px">
                                                                                <path fill-rule="evenodd"
                                                                                      fill="rgb(124, 124, 124)"
                                                                                      d="M17.791,6.835 C17.566,6.980 17.251,6.934 17.091,6.732 C16.191,5.598 15.052,4.707 13.702,4.086 C10.833,2.759 7.169,2.763 4.305,4.095 C2.950,4.725 1.805,5.620 0.911,6.763 C0.811,6.885 0.656,6.948 0.501,6.948 C0.401,6.948 0.301,6.921 0.211,6.867 C-0.014,6.723 -0.069,6.444 0.091,6.241 C1.081,4.981 2.345,3.991 3.845,3.294 C6.989,1.832 11.008,1.827 14.157,3.285 C15.652,3.978 16.911,4.959 17.906,6.210 C18.066,6.412 18.016,6.691 17.791,6.835 ZM14.807,2.223 C14.727,2.223 14.652,2.205 14.577,2.173 C12.662,1.282 10.998,0.900 9.009,0.900 C7.024,0.900 5.155,1.327 3.440,2.169 C3.195,2.286 2.895,2.209 2.761,1.989 C2.631,1.768 2.715,1.499 2.960,1.377 C4.825,0.463 6.859,-0.000 9.009,-0.000 C11.138,-0.000 12.997,0.423 15.037,1.372 C15.282,1.485 15.377,1.759 15.252,1.980 C15.162,2.133 14.987,2.223 14.807,2.223 ZM8.964,4.347 C13.507,4.347 17.206,7.510 17.206,11.398 C17.206,12.861 15.822,14.049 14.127,14.049 C12.432,14.049 11.048,12.861 11.048,11.398 C11.048,10.435 10.113,9.648 8.968,9.648 C7.824,9.648 6.889,10.431 6.889,11.398 C6.889,12.933 7.554,14.377 8.758,15.457 C9.704,16.303 10.623,16.771 12.032,17.118 C12.297,17.185 12.458,17.433 12.382,17.671 C12.323,17.869 12.122,18.000 11.902,18.000 C11.857,18.000 11.813,17.995 11.773,17.982 C10.178,17.590 9.138,17.059 8.059,16.092 C6.664,14.841 5.894,13.171 5.894,11.394 C5.894,9.931 7.274,8.743 8.973,8.743 C10.673,8.743 12.053,9.931 12.053,11.394 C12.053,12.357 12.988,13.144 14.132,13.144 C15.277,13.144 16.211,12.361 16.211,11.394 C16.211,8.001 12.962,5.242 8.968,5.242 C6.125,5.242 3.530,6.664 2.361,8.869 C1.971,9.598 1.776,10.449 1.776,11.394 C1.776,12.096 1.845,13.203 2.440,14.638 C2.536,14.872 2.406,15.129 2.146,15.219 C1.886,15.304 1.601,15.187 1.500,14.953 C1.011,13.770 0.771,12.609 0.771,11.394 C0.771,10.314 1.001,9.333 1.456,8.483 C2.790,5.971 5.740,4.347 8.964,4.347 ZM8.999,6.538 C12.123,6.538 14.662,8.712 14.662,11.389 C14.662,11.637 14.437,11.839 14.162,11.839 C13.887,11.839 13.662,11.637 13.662,11.389 C13.662,9.211 11.573,7.438 8.999,7.438 C6.429,7.438 4.335,9.211 4.335,11.389 C4.335,12.685 4.655,13.882 5.259,14.859 C5.904,15.894 6.334,16.339 7.104,17.037 C7.299,17.212 7.299,17.500 7.099,17.671 C7.009,17.766 6.879,17.806 6.754,17.806 C6.624,17.806 6.499,17.761 6.400,17.671 C5.534,16.884 5.065,16.384 4.390,15.300 C3.700,14.193 3.335,12.838 3.335,11.389 C3.335,8.716 5.875,6.538 8.999,6.538 ZM8.443,11.394 C8.443,11.146 8.668,10.944 8.944,10.944 C9.219,10.944 9.443,11.146 9.443,11.394 C9.443,12.658 10.168,13.855 11.383,14.598 C12.087,15.030 12.917,15.241 13.917,15.241 C14.157,15.241 14.562,15.219 14.962,15.156 C15.232,15.111 15.491,15.277 15.542,15.520 C15.592,15.763 15.407,15.997 15.137,16.042 C14.552,16.137 14.057,16.141 13.917,16.141 C12.727,16.141 11.683,15.871 10.818,15.345 C9.333,14.436 8.443,12.960 8.443,11.394 Z"/>
                                                                            </svg>
                                                                        </span>
                                                                           <span class="product-card_icon d-inline-block">
                                                                            <svg viewBox="0 0 16 17" width="16px"
                                                                                 height="17px">
                                                                                <path fill-rule="evenodd"
                                                                                      fill="rgb(124, 124, 124)"
                                                                                      d="M16.000,4.548 C16.000,4.315 15.877,4.111 15.686,4.009 L8.258,0.062 C8.081,-0.025 7.875,-0.025 7.711,0.092 C7.547,0.194 7.452,0.397 7.452,0.601 L7.452,7.534 L0.845,4.009 C0.571,3.863 0.229,3.980 0.093,4.271 C-0.044,4.563 0.065,4.927 0.339,5.072 L6.753,8.480 L0.339,11.917 C0.065,12.063 -0.058,12.427 0.093,12.718 C0.188,12.922 0.393,13.053 0.599,13.053 C0.681,13.053 0.763,13.039 0.845,12.995 L7.452,9.471 L7.452,16.403 C7.452,16.607 7.547,16.796 7.711,16.912 C7.807,16.971 7.903,17.000 8.012,17.000 C8.094,17.000 8.190,16.985 8.258,16.942 L15.686,12.995 C15.877,12.893 16.000,12.689 16.000,12.456 C16.000,12.223 15.877,12.019 15.686,11.917 L9.270,8.495 L15.686,5.087 C15.877,4.985 16.000,4.781 16.000,4.548 ZM8.573,15.427 L8.573,9.471 L14.181,12.456 L8.573,15.427 ZM8.573,7.534 L8.573,1.562 L14.181,4.548 L8.573,7.534 Z"/>
                                                                            </svg>
                                                                        </span>
                                                                           <span class="product-card_icon d-inline-block">
                                                                            <svg viewBox="0 0 20 15" width="20px"
                                                                                 height="15px">
                                                                                <path fill-rule="evenodd"
                                                                                      fill="rgb(124, 124, 124)"
                                                                                      d="M19.794,5.420 C19.690,5.514 19.554,5.566 19.412,5.566 C19.255,5.566 19.109,5.505 19.002,5.394 C16.700,3.007 13.586,1.693 10.231,1.693 C6.876,1.693 3.761,3.007 1.461,5.394 C1.354,5.505 1.208,5.566 1.050,5.566 C0.908,5.566 0.773,5.514 0.668,5.420 C0.442,5.217 0.429,4.873 0.641,4.654 C3.156,2.045 6.562,0.609 10.231,0.608 C13.901,0.609 17.307,2.045 19.822,4.654 C20.033,4.873 20.020,5.217 19.794,5.420 ZM10.231,4.473 C12.727,4.472 15.121,5.464 16.970,7.266 C17.076,7.368 17.133,7.505 17.133,7.649 C17.132,7.794 17.073,7.930 16.967,8.032 C16.861,8.133 16.721,8.189 16.572,8.189 C16.421,8.189 16.280,8.132 16.174,8.029 C14.537,6.435 12.427,5.557 10.232,5.557 C8.035,5.557 5.925,6.435 4.288,8.029 C4.183,8.132 4.041,8.189 3.890,8.189 C3.741,8.189 3.601,8.133 3.495,8.032 C3.276,7.821 3.274,7.477 3.492,7.265 C5.341,5.465 7.734,4.473 10.231,4.473 ZM10.166,8.371 L10.223,8.371 C11.492,8.371 12.884,8.950 13.858,9.882 C13.964,9.984 14.023,10.120 14.024,10.264 C14.024,10.409 13.966,10.546 13.861,10.649 C13.755,10.752 13.614,10.809 13.463,10.809 C13.314,10.809 13.173,10.753 13.068,10.652 C12.309,9.925 11.192,9.455 10.224,9.455 L10.167,9.455 C9.198,9.455 8.081,9.925 7.322,10.652 C7.217,10.753 7.076,10.809 6.927,10.809 C6.777,10.809 6.635,10.752 6.529,10.649 C6.311,10.436 6.313,10.092 6.533,9.882 C7.506,8.950 8.898,8.371 10.166,8.371 ZM10.192,12.459 C10.780,12.459 11.259,12.922 11.259,13.490 C11.259,14.059 10.780,14.521 10.192,14.521 C9.604,14.521 9.126,14.059 9.126,13.490 C9.126,12.922 9.604,12.459 10.192,12.459 Z"/>
                                                                            </svg>
                                                                        </span>
                                                                       </div>
                                                                       <!--Price-->
                                                                       <span class="product-card_price d-inline-block font-sec-bold font-24 text-tert-clr lh-1 ml-auto">{{ convert_price($related_product->variations->first()->price,$currency)}}</span>
                                                                   </div>
                                                               </div>
                                                               <!--btn-->
                                                               <a href="javascript:void(0)"
                                                                  data-id="{{ $related_product->variations->first()->id }}"
                                                                  class="product-card_btn d-inline-flex align-items-center text-center font-15 text-white text-sec-clr text-uppercase __add_to_card">
                                                                   <span class="product-card_btn-text">add to cart</span>
                                                                   <span class="d-inline-block ml-auto">
                                                                    <svg viewBox="0 0 18 22" width="18px" height="22px">
                                                                        <path fill-rule="evenodd" opacity="0.8"
                                                                              fill="rgb(255, 255, 255)"
                                                                              d="M14.305,3.679 L14.305,0.003 L3.694,0.003 L3.694,3.679 L-0.004,3.679 L-0.004,21.998 L18.003,21.998 L18.003,3.679 L14.305,3.679 ZM4.935,1.216 L13.064,1.216 L13.064,3.679 L4.935,3.679 L4.935,1.216 ZM16.761,20.785 L1.238,20.785 L1.238,4.891 L3.694,4.891 L3.694,7.329 L4.935,7.329 L4.935,4.891 L13.064,4.891 L13.064,7.329 L14.305,7.329 L14.305,4.891 L16.761,4.891 L16.761,20.785 Z"/>
                                                                    </svg>
                                                                </span>
                                                               </a>
                                                           </div>
                                                       </div>
                                                   </div>
                                               @endforeach
                                               {{--the end--}}
                                           </div>
                                       </div>
                                       @if($vape->reviews_tab)
                                           <div class="tab-pane fade show" id="pills-reviews" role="tabpanel"
                                                aria-labelledby="pills-tecnical-tab">
                                               <p class="product-single-tecnical-text font-15 font-main-light text-light-clr mb-0">
                                                   I bought one.
                                               </p>
                                           </div>
                                       @endif
                                       @if($vape->faq_tab)
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
                                                               <div class="collapse" id="accordion-3--card-0-content"
                                                                    aria-labelledby="accordion-3--card-0-header"
                                                                    data-parent="#accordion-3" style="">
                                                                   <div class="card-body">{!! $faq->answer !!}</div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   @endforeach
                                               </div>

                                           </div>
                                       @endif
                                   </div>
                               </div>
                               {{--carousel--}}

                           </div>
                           <div class="col-lg-1 col-2 ml-auto d-flex flex-column pr-0 product-single-share-col">
                               <div class="ml-auto">
                                   <div class="product-single-share-outer d-flex flex-column align-items-center justify-content-center">
                                       <span class="d-inline-block font-main-bold font-22">87</span>
                                       <span class="d-inline-block text-uppercase font-main-light fot-13">shares</span>
                                   </div>
                                   <div class="d-flex flex-column align-items-center">
                                       <a href="#" class="product-single_share-icon d-inline-block">
                                           <svg viewBox="0 0 20 20" width="20px" height="20px">
                                               <path fill-rule="evenodd" fill="rgb(189, 193, 201)"
                                                     d="M18.891,0.005 L1.105,0.005 C0.498,0.005 0.002,0.497 0.002,1.108 L0.002,18.894 C0.002,19.503 0.498,19.999 1.105,19.999 L10.680,19.999 L10.680,12.256 L8.074,12.256 L8.074,9.237 L10.680,9.237 L10.680,7.011 C10.680,4.431 12.257,3.024 14.562,3.024 C15.667,3.024 16.612,3.106 16.890,3.144 L16.890,5.839 L15.290,5.843 C14.037,5.843 13.797,6.436 13.797,7.312 L13.797,9.237 L16.785,9.237 L16.395,12.252 L13.797,12.252 L13.797,19.999 L18.891,19.999 C19.500,19.999 19.996,19.503 19.996,18.894 L19.996,1.108 C19.996,0.497 19.500,0.005 18.891,0.005 L18.891,0.005 Z"></path>
                                           </svg>
                                       </a>
                                       <a href="#" class="product-single_share-icon d-inline-block">
                                           <svg viewBox="0 0 20 16" width="20px" height="16px">
                                               <path fill-rule="evenodd" fill="rgb(211, 214, 223)"
                                                     d="M19.998,1.890 C19.262,2.211 18.472,2.429 17.642,2.526 C18.489,2.026 19.139,1.235 19.445,0.291 C18.652,0.754 17.775,1.090 16.840,1.272 C16.092,0.486 15.026,-0.004 13.846,-0.004 C11.581,-0.004 9.744,1.805 9.744,4.036 C9.744,4.352 9.781,4.661 9.850,4.956 C6.441,4.788 3.419,3.179 1.395,0.735 C1.042,1.332 0.840,2.026 0.840,2.766 C0.840,4.168 1.564,5.404 2.665,6.129 C1.992,6.108 1.360,5.926 0.807,5.624 C0.807,5.641 0.807,5.657 0.807,5.675 C0.807,7.632 2.220,9.265 4.097,9.636 C3.753,9.728 3.390,9.778 3.016,9.778 C2.752,9.778 2.495,9.752 2.245,9.705 C2.766,11.310 4.282,12.478 6.076,12.511 C4.673,13.595 2.904,14.240 0.982,14.240 C0.651,14.240 0.324,14.221 0.003,14.184 C1.818,15.330 3.975,15.999 6.292,15.999 C13.837,15.999 17.962,9.843 17.962,4.504 C17.962,4.329 17.959,4.155 17.951,3.981 C18.752,3.412 19.448,2.700 19.998,1.890 L19.998,1.890 Z"></path>
                                           </svg>
                                       </a>
                                       <a href="#" class="product-single_share-icon d-inline-block">
                                           <svg viewBox="0 0 19 18" width="19px" height="18px">
                                               <path fill-rule="evenodd" fill="rgb(211, 214, 223)"
                                                     d="M19.002,11.037 L19.002,18.005 L14.930,18.005 L14.930,11.504 C14.930,9.872 14.342,8.757 12.868,8.757 C11.742,8.757 11.073,9.508 10.779,10.235 C10.671,10.494 10.644,10.855 10.644,11.219 L10.644,18.005 L6.571,18.005 C6.571,18.005 6.625,6.995 6.571,5.855 L10.644,5.855 L10.644,7.576 C10.635,7.590 10.624,7.603 10.617,7.616 L10.644,7.616 L10.644,7.576 C11.185,6.750 12.150,5.569 14.314,5.569 C16.994,5.569 19.002,7.305 19.002,11.037 L19.002,11.037 ZM2.309,-0.003 C0.916,-0.003 0.005,0.904 0.005,2.096 C0.005,3.263 0.890,4.196 2.256,4.196 L2.283,4.196 C3.703,4.196 4.586,3.263 4.586,2.096 C4.560,0.904 3.703,-0.003 2.309,-0.003 L2.309,-0.003 ZM0.247,18.005 L4.318,18.005 L4.318,5.855 L0.247,5.855 L0.247,18.005 Z"></path>
                                           </svg>
                                       </a>
                                       <a href="#" class="product-single_share-icon d-inline-block">
                                           <svg viewBox="0 0 24 15" width="24px" height="15px">
                                               <path fill-rule="evenodd" fill="rgb(211, 214, 223)"
                                                     d="M21.508,7.917 L21.508,10.421 L19.441,10.421 L19.441,7.917 L16.961,7.917 L16.961,5.830 L19.441,5.830 L19.441,3.325 L21.508,3.325 L21.508,5.830 L23.988,5.830 L23.988,7.917 L21.508,7.917 ZM7.537,15.013 C3.362,15.013 0.015,11.715 0.015,7.500 C0.015,3.284 3.362,-0.013 7.537,-0.013 C9.562,-0.013 11.339,0.571 12.621,1.823 L10.430,4.036 C9.728,3.284 8.694,2.909 7.537,2.909 C5.057,2.909 2.908,4.995 2.908,7.500 C2.908,10.004 5.057,12.091 7.537,12.091 C9.604,12.091 11.175,10.755 11.629,8.752 L7.455,8.752 L7.455,5.830 L14.729,5.830 C14.812,6.331 14.853,6.958 14.853,7.500 C14.853,8.043 14.812,8.544 14.729,9.045 C14.150,12.926 11.257,15.013 7.537,15.013 Z"></path>
                                           </svg>
                                       </a>
                                       <a href="#" class="product-single_share-icon d-inline-block">
                                           <svg viewBox="0 0 19 15" width="19px" height="15px">
                                               <path fill-rule="evenodd" fill="rgb(211, 214, 223)"
                                                     d="M17.729,14.995 L1.266,14.995 C0.571,14.995 0.001,14.384 0.001,13.642 L0.001,3.899 C0.001,3.158 0.454,2.916 1.010,3.364 L8.487,9.414 C8.767,9.638 9.133,9.748 9.500,9.744 C9.862,9.748 10.228,9.638 10.508,9.414 L17.985,3.364 C18.541,2.916 18.994,3.158 18.994,3.899 L18.994,13.642 C18.994,14.384 18.424,14.995 17.729,14.995 ZM10.651,6.618 C10.338,6.881 9.912,6.995 9.496,6.974 C9.083,6.995 8.653,6.877 8.344,6.618 L1.503,0.841 C0.957,0.380 1.080,0.004 1.776,0.004 L17.219,0.004 C17.916,0.004 18.038,0.380 17.492,0.841 L10.651,6.618 Z"></path>
                                           </svg>
                                       </a>
                                   </div>
                               </div>

                           </div>
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
       </div>
   </div>
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

        .video--carousel-thumb .fs-carousel-active{
            border: 2px solid #5184e5 !important;
        }

        .video--carousel-thumb .fs-carousel-item{
            border: 2px solid transparent;
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
        $(document).ready(function () {
//          ----start  video carousel----

            $(".video--carousel").carousel({
                pagination: false,
                controls: false,
            });

            $(".video--carousel-thumb").carousel({
                controls: false,
                pagination: false,
//                show: 4,
                matchWidth:false
            });


//          ----end  video carousel----

            $(".tecnical_gallery_obj-holder").lightbox();
//                    start carousel tabs
            let activeTab = $('#carousel-tabs-wrap a').filter('.active');
            $('#carousel-tabs-wrap a').on('click', function (e) {
                e.preventDefault();
                activeTab.removeClass('active');
                $(activeTab.attr('href')).removeClass('active');
                activeTab = $(this);
                activeTab.addClass("active");
                $(activeTab.attr('href')).addClass('active');
            })
            $(".carousel-tabs").carousel({
                show: {
                    "740px": 2,
                    "980px": 3,
                    "1220px": 2
                },
                matchWidth: false,
                controls: false,
                pagination: false
            });
            if ($(window).width() > 1400) {
                $(".carousel-tabs .fs-touch-element").touch("destroy");
            }
            else {
                $(".carousel-tabs .fs-touch-element").touch();
            }
            $(window).resize(function () {
                if ($(window).width() > 1400) {
                    $(".carousel-tabs .fs-touch-element").touch("destroy");
                }
                else {
                    $(".carousel-tabs .fs-touch-element").touch();
                }
            });


//                    end carousel tabs


            $(".lightbox-product").lightbox();
            $('body').on('change', '.products_custom_check input', function () {
                if ($(this).is(':checked')) {
                    $(this).closest('.product-single-info_row').find('.extra-product').removeClass('products_closed')
                } else {
                    $(this).closest('.product-single-info_row').find('.extra-product').addClass('products_closed')
                }

            })
            $("body").on('click', '.qty-count', function () {
                let qty = $('.product-qty-select').val();
                let type = $(this).data('type');
                if (type == 'plus') {
                    qty = parseInt(qty) + 1;
                    $('.product-qty-select').val(qty)
                } else {
                    if (qty > 1) {
                        qty -= 1;
                        $('.product-qty-select').val(qty)
                    }
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


            $("body").on('click', '.__add_to_card', function () {
                var variationId = $(this).data("id");

                if (variationId && variationId != '') {
//                    console.log(requiredItems)
//                    return false;
                    console.log(variationId);
                    $.ajax({
                        type: "post",
                        url: "/add-to-cart",
                        cache: false,
                        datatype: "json",
                        data: {
                            uid: variationId
                        },
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            console.log(data);
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
            });



            $("body").on('click', '.optional_checkbox', function () {
                get_subTotalPrice();
            });

            $("body").on('click', '.add-to-cart', function () {
                var variationId = $("#variation_uid").val();

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

                            $(".product-card-thumbs").find('[data-id="'+data.variation_id+'"]').trigger("mouseover");
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

                    console.log(requiredItemsData,445445454465)
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

            function call_extra_products(){
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
                    data: {options: options, uid: pid, promotion: true,stock_id : uid},
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

            async function getP(){
                await get_price();
                await call_extra_products();
            }

            getP();

            function call_subtotal(time = 300) {
                setTimeout(
                    function() {
                        get_subTotalPrice();
                    }, time);
            }

            call_subtotal(500);

            $("body").on('click', '.product-card_like-icon', function () {
                let url;
                let is_active = $(this).hasClass("active");

                url = (is_active) ? "/my-account/delete_favourites" : "/my-account/add_favourites";

                let variation_id = $(this).data("id");
                let _this = $(this);

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

        });
    </script>
@stop