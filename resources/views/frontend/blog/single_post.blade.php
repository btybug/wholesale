@extends('layouts.frontend')
@section('meta')
    {!! postSeo($post) !!}
    <meta property="og:url" content="{!! route('blog_post',$post->url) !!}">
@stop
@section('content')
    <main class="main-content">
        <!--breadcrump-->
        <div class="container main-max-width main-content-wrapper">
            <div class="content-head d-flex flex-wrap justify-content-between">
                <div class="left-head d-flex align-items-center mb-lg-0 mb-2">
                    {{ Breadcrumbs::render('blog_post',$post->title) }}
                </div>
            </div>
        </div>

        <div class="news-inner-wrapper">
            <div class="container main-max-width">
                <div class="row">
                    <div class="col-md-9">
                        <div class="left-content">
                            @if($post->image)
                                <div class="main-photo">
                                    <img src="{{ $post->image }}" alt="{{ $post->title }}" title="{{ $post->title }}">
                                </div>
                            @endif

                            <div class="title-cat d-flex justify-content-between align-items-center">
                                <div class="title">
                                    <h1 class="font-sec-reg font-36 text-main-clr mb-0 lh-1">{!! $post->title !!}</h1>
                                </div>
                                <div class="cat-time text-right">
                                    <div class="font-13 text-light-clr">{!! BBgetDateFormat($post->created_at) !!}</div>
                                </div>
                            </div>
                            <div class="admin-tags d-flex flex-wrap justify-content-between align-items-center">
                                <div class="admin d-flex mb-1">
                                    <div class="admin-photo">
                                        <img src=" {{ user_avatar($post->author->id) }}" alt="{{ $post->author->name }}"
                                             title="{{ $post->author->name }}" class="rounded-circle">
                                    </div>
                                    <div class="admin-main ">
                                        <div class="admin-by font-main-bold font-15 text-tert-clr lh-1">
                                            {{$post->author->name}}
                                        </div>
                                        <div class="admin-desc">
                                            <p class="mb-0 font-main-light font-13 text-light-clr">{{ $post->short_description }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if($post && $post->tags)
                                    <?php
                                    $tags = json_decode($post->tags, true);
                                    ?>
                                    <div class="tags mb-1">
                                        <ul class="list-inline m-0 p-0">
                                            @foreach($tags as $tag)
                                                <li class="list-inline-item"><a href="javascript:void(0)"
                                                                                class="text-light-clr">{{ $tag }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="news-main-content font-main-light font-15">
                                {!! $post->long_description !!}
                            </div>
                            <div class="news-share mb-md-0 mb-2">
                                <h5 class="font-15 text-tert-clr">{!! __('share') !!}</h5>
                                <ul class="d-flex">
                                    <li class="col-3 p-0"><a href="#"
                                                             class="d-flex align-items-center justify-content-center facebook-bg"><span><i
                                                    class="fab fa-facebook-f"></i></span></a></li>
                                    <li class="active col-3 p-0"><a href="#"
                                                                    class="d-flex align-items-center justify-content-center border-left-0 instagram-bg"><span><i
                                                    class="fab fa-instagram"></i></span></a></li>
                                    <li class="col-3 p-0"><a href="#"
                                                             class="d-flex align-items-center justify-content-center border-left-0 twitter-bg"><span><i
                                                    class="fab fa-twitter"></i></span></a></li>
                                    <li class="col-3 p-0"><a href="#"
                                                             class="d-flex align-items-center justify-content-center border-left-0 plus-bg"><span><i
                                                    class="fas fa-plus"></i></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="right-content">
                            @if($ads && isset($ads['images']))
                                @foreach($ads['images'] as $key => $ad)
                                    <div class="advertisment @if(!$loop->first) mt-20 @endif">
                                        <a href="{!! $ads['urls'][$key] !!}">
                                            <img src="{!! $ad !!}" alt="{!! $ads['tags'][$key] !!}"
                                                 title="{!! $ads['tags'][$key] !!}">
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-50">
                    @if(count($relatedPosts))
                        <div class="line-wall"></div>
                        <h5 class="font-sec-bold font-20 text-uppercase text-tert-clr mb-4">{!! __('related_posts') !!}</h5>
                        <div class="related-sliders">
                            <div class="realated-slider">
                                @foreach($relatedPosts as $relatedPost)
                                    <div>
                                        <div class="display-grid">
                                            <a href="{!! post_url($relatedPost) !!}" class="d-block">
                                            <span class="news-card main-transition position-relative">
                                                <span class="news-card_view d-block position-relative">
                                                    <!--news main image-->
                                                    <img class="card-img-top" src="{{ $relatedPost->image }}" alt="">
                                                    <!--share icon-->
                                                    <span
                                                        class="like-icon news-card_share-icon d-inline-block pointer main-transition position-absolute">
                                                        <svg viewBox="0 0 20 21" width="20px" height="21px">
                                                            <path fill-rule="evenodd" opacity="0.6"
                                                                  fill="rgb(255, 255, 255)"
                                                                  d="M16.364,13.881 C15.393,13.881 14.480,14.252 13.793,14.925 C13.603,15.111 13.438,15.316 13.296,15.533 L7.014,11.799 C7.181,11.392 7.275,10.948 7.275,10.484 C7.275,10.018 7.181,9.576 7.015,9.168 L13.298,5.461 C13.944,6.454 15.074,7.116 16.364,7.116 C18.368,7.116 19.999,5.518 19.999,3.555 C19.999,1.592 18.368,-0.006 16.364,-0.006 C14.359,-0.006 12.728,1.592 12.728,3.555 C12.728,4.002 12.817,4.430 12.971,4.823 L6.678,8.535 C6.028,7.565 4.910,6.923 3.639,6.923 C1.635,6.923 0.004,8.519 0.004,10.484 C0.004,12.447 1.635,14.045 3.639,14.045 C4.910,14.045 6.028,13.402 6.678,12.431 L12.969,16.172 C12.813,16.573 12.728,17.001 12.728,17.442 C12.728,18.393 13.106,19.289 13.793,19.960 C14.480,20.633 15.393,21.003 16.364,21.003 C17.335,21.003 18.247,20.633 18.934,19.960 C19.621,19.289 19.999,18.393 19.999,17.442 C19.999,16.491 19.621,15.598 18.934,14.925 C18.247,14.252 17.335,13.881 16.364,13.881 L16.364,13.881 Z"/>
                                                        </svg>
                                                    </span>
                                                </span>
                                                <span class="news-card_body">
                                                    <span class="news-card_body-text d-block">
                                                        <span
                                                            class="d-inline-block card-title font-21 font-sec-bold text-main-clr underlined-on-hover">
                                                            {{ str_limit($relatedPost->title,30) }}
                                                        </span>
                                                        <span
                                                            class="card-text d-block font-main-light font-15 text-light-clr">
                                                            {{ str_limit($relatedPost->short_description,30) }}
                                                        </span>
                                                    </span>
                                                    <span class="news-card_footer d-flex align-items-center">
                                                        <span
                                                            class="d-inline-block font-12 font-main-light text-light-clr">{{ time_ago($relatedPost->created_at) }}</span>
                                                        <span class="ml-auto">
                                                            <span
                                                                class="news-card_views d-inline-flex align-items-center position-relative">
                                                                <svg
                                                                    viewBox="0 0 16 11"
                                                                    width="16px" height="11px">
                    <path fill-rule="evenodd" fill="rgb(188, 188, 188)"
                          d="M8.000,-0.003 C4.364,-0.003 1.235,2.270 0.000,5.497 C1.235,8.725 4.364,10.998 8.000,10.998 C11.636,10.998 14.760,8.725 15.999,5.497 C14.760,2.270 11.636,-0.003 8.000,-0.003 L8.000,-0.003 ZM8.000,9.165 C5.962,9.165 4.364,7.549 4.364,5.497 C4.364,3.446 5.962,1.830 8.000,1.830 C10.034,1.830 11.636,3.446 11.636,5.497 C11.636,7.549 10.034,9.165 8.000,9.165 L8.000,9.165 ZM8.000,3.299 C6.764,3.299 5.816,4.252 5.816,5.497 C5.816,6.743 6.764,7.696 8.000,7.696 C9.235,7.696 10.180,6.743 10.180,5.497 C10.180,4.252 9.235,3.299 8.000,3.299 L8.000,3.299 Z"/>
                    </svg>
                                                                <span
                                                                    class="d-inline-block text-main-clr ml-2">123</span>
                                                                <!--views tooltip-->
                                                                <span
                                                                    class="news-card_views-tooltip d-inline-flex align-items-center justify-content-center font-12 font-main-light main-transition position-absolute">{!! __('view') !!}</span>
                                                            </span>
                                                            <span class="d-inline-flex align-items-center">
                                                                <svg
                                                                    viewBox="0 0 15 12"
                                                                    width="15px" height="12px">
                    <path fill-rule="evenodd" fill="rgb(188, 188, 188)"
                          d="M15.002,5.832 L8.767,-0.002 L8.767,3.343 C4.351,3.391 -0.003,7.181 -0.003,12.001 C2.109,9.975 4.607,8.146 8.767,8.295 L8.767,11.665 L15.002,5.832 Z"/>
                    </svg>
                                                                <span
                                                                    class="d-inline-block text-main-clr ml-2">10</span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </span>

                                            </span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(count($post->stocks))
                    <!--RELATED PRODUCTS-->
                        <h5 class="font-sec-bold font-20 text-uppercase text-tert-clr my-4">{!! __('related_products') !!}</h5>
                        <div class="related-sliders related-slid-product">
                            <div class="realated-slider">
                                @foreach($post->stocks as $product)
                                    <div>
                                        <div class="display-grid">
                                            <div class="w-100">
                                                <div class="product-card position-relative">
                                                    <a href="{{ route('product_single', ['type' =>"vape", 'slug' => $product->slug]) }}"
                                                       class="main--link">
                                                        <div class="product-card_view position-relative">
                                                            <!--product main image-->
                                                            <div>
                                                                <img class="card-img-top"
                                                                     src="{{ (media_image_tmb($product->image)) }}"
                                                                     alt="">
                                                            </div>
                                                            <!--like icon-->
                                                            <span
                                                                class="like-icon product-card_like-icon d-inline-block pointer position-absolute {{ (! $product->is_favorite)?:'active' }}"
                                                                data-id="{{ $product->variation_id }}"> <!--gets class active-->
                                            <svg viewBox="0 0 20 18" width="20px" height="18px">
                                                <path fill-rule="evenodd" opacity="0.949" fill="rgb(255, 255, 255)"
                                                      d="M14.698,-0.003 C13.055,-0.003 11.417,0.767 10.358,2.015 C9.299,0.767 7.661,-0.003 6.017,-0.003 C3.034,-0.003 0.718,2.306 0.718,5.280 C0.718,8.935 3.994,11.915 9.007,16.336 L10.358,17.677 L11.709,16.336 C16.722,11.915 19.998,8.935 19.998,5.280 C19.998,2.306 17.682,-0.003 14.698,-0.003 L14.698,-0.003 Z"/>
                                            </svg>
                                        </span>
                                                            <!--new label-->
                                                        {{--<span class="new-label product-card_new-label d-inline-block text-uppercase font-main-bold font-16 text-sec-clr position-absolute">new</span>--}}
                                                        @if($product->new_price)
                                                            <!--sale label-->
                                                                <span
                                                                    class="sale-label product-card_sale-label d-inline-block text-uppercase font-main-bold font-16 text-sec-clr position-absolute">
                                                {!! __('sale') !!}
                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="product-card_body">
                                                            <!--product image thumbs-->
                                                            <div class="d-flex product-card-thumbs flex-wrap">
                                                                <div
                                                                    class="product-card_thumb-img-holder pointer active_slider">
                                                                    <img src="{{ (media_image_tmb($product->image)) }}"
                                                                         alt="{{ $product->name }}">
                                                                </div>
                                                                @if($product->variations)
                                                                    @foreach($product->variations as $variation)
                                                                        @if($variation->image)
                                                                            <div
                                                                                class="product-card_thumb-img-holder pointer">
                                                                                <img class=""
                                                                                     src="{{ (media_image_tmb($variation->image)) }}"
                                                                                     alt="{{ $variation->name }}">
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <div class="product-card_body-text">
                                                                <h2 class="card-title font-21 font-sec-bold">
                                                <span class="text-tert-clr">
                                                    {{ str_limit($product->name,30) }}
                                                </span>
                                                                </h2>
                                                                <p class="card-text font-main-light font-15 text-light-clr">
                                                                    {{ str_limit($product->short_description,30) }}
                                                                </p>
                                                                <div
                                                                    class="product-card_icons-outer d-flex justify-content-between align-items-center">
                                                                    <!--icons-->
                                                                    <div class="product-card_icons">
                                                            <span class="product-card_icon d-inline-block">
                                                        <svg
                                                            viewBox="0 0 18 18"
                                                            width="18px" height="18px">
                <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                      d="M17.791,6.835 C17.566,6.980 17.251,6.934 17.091,6.732 C16.191,5.598 15.052,4.707 13.702,4.086 C10.833,2.759 7.169,2.763 4.305,4.095 C2.950,4.725 1.805,5.620 0.911,6.763 C0.811,6.885 0.656,6.948 0.501,6.948 C0.401,6.948 0.301,6.921 0.211,6.867 C-0.014,6.723 -0.069,6.444 0.091,6.241 C1.081,4.981 2.345,3.991 3.845,3.294 C6.989,1.832 11.008,1.827 14.157,3.285 C15.652,3.978 16.911,4.959 17.906,6.210 C18.066,6.412 18.016,6.691 17.791,6.835 ZM14.807,2.223 C14.727,2.223 14.652,2.205 14.577,2.173 C12.662,1.282 10.998,0.900 9.009,0.900 C7.024,0.900 5.155,1.327 3.440,2.169 C3.195,2.286 2.895,2.209 2.761,1.989 C2.631,1.768 2.715,1.499 2.960,1.377 C4.825,0.463 6.859,-0.000 9.009,-0.000 C11.138,-0.000 12.997,0.423 15.037,1.372 C15.282,1.485 15.377,1.759 15.252,1.980 C15.162,2.133 14.987,2.223 14.807,2.223 ZM8.964,4.347 C13.507,4.347 17.206,7.510 17.206,11.398 C17.206,12.861 15.822,14.049 14.127,14.049 C12.432,14.049 11.048,12.861 11.048,11.398 C11.048,10.435 10.113,9.648 8.968,9.648 C7.824,9.648 6.889,10.431 6.889,11.398 C6.889,12.933 7.554,14.377 8.758,15.457 C9.704,16.303 10.623,16.771 12.032,17.118 C12.297,17.185 12.458,17.433 12.382,17.671 C12.323,17.869 12.122,18.000 11.902,18.000 C11.857,18.000 11.813,17.995 11.773,17.982 C10.178,17.590 9.138,17.059 8.059,16.092 C6.664,14.841 5.894,13.171 5.894,11.394 C5.894,9.931 7.274,8.743 8.973,8.743 C10.673,8.743 12.053,9.931 12.053,11.394 C12.053,12.357 12.988,13.144 14.132,13.144 C15.277,13.144 16.211,12.361 16.211,11.394 C16.211,8.001 12.962,5.242 8.968,5.242 C6.125,5.242 3.530,6.664 2.361,8.869 C1.971,9.598 1.776,10.449 1.776,11.394 C1.776,12.096 1.845,13.203 2.440,14.638 C2.536,14.872 2.406,15.129 2.146,15.219 C1.886,15.304 1.601,15.187 1.500,14.953 C1.011,13.770 0.771,12.609 0.771,11.394 C0.771,10.314 1.001,9.333 1.456,8.483 C2.790,5.971 5.740,4.347 8.964,4.347 ZM8.999,6.538 C12.123,6.538 14.662,8.712 14.662,11.389 C14.662,11.637 14.437,11.839 14.162,11.839 C13.887,11.839 13.662,11.637 13.662,11.389 C13.662,9.211 11.573,7.438 8.999,7.438 C6.429,7.438 4.335,9.211 4.335,11.389 C4.335,12.685 4.655,13.882 5.259,14.859 C5.904,15.894 6.334,16.339 7.104,17.037 C7.299,17.212 7.299,17.500 7.099,17.671 C7.009,17.766 6.879,17.806 6.754,17.806 C6.624,17.806 6.499,17.761 6.400,17.671 C5.534,16.884 5.065,16.384 4.390,15.300 C3.700,14.193 3.335,12.838 3.335,11.389 C3.335,8.716 5.875,6.538 8.999,6.538 ZM8.443,11.394 C8.443,11.146 8.668,10.944 8.944,10.944 C9.219,10.944 9.443,11.146 9.443,11.394 C9.443,12.658 10.168,13.855 11.383,14.598 C12.087,15.030 12.917,15.241 13.917,15.241 C14.157,15.241 14.562,15.219 14.962,15.156 C15.232,15.111 15.491,15.277 15.542,15.520 C15.592,15.763 15.407,15.997 15.137,16.042 C14.552,16.137 14.057,16.141 13.917,16.141 C12.727,16.141 11.683,15.871 10.818,15.345 C9.333,14.436 8.443,12.960 8.443,11.394 Z"/>
                </svg>
                                                    </span>
                                                                        <span class="product-card_icon d-inline-block">
                                                        <svg
                                                            viewBox="0 0 16 17"
                                                            width="16px" height="17px">
                <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                      d="M16.000,4.548 C16.000,4.315 15.877,4.111 15.686,4.009 L8.258,0.062 C8.081,-0.025 7.875,-0.025 7.711,0.092 C7.547,0.194 7.452,0.397 7.452,0.601 L7.452,7.534 L0.845,4.009 C0.571,3.863 0.229,3.980 0.093,4.271 C-0.044,4.563 0.065,4.927 0.339,5.072 L6.753,8.480 L0.339,11.917 C0.065,12.063 -0.058,12.427 0.093,12.718 C0.188,12.922 0.393,13.053 0.599,13.053 C0.681,13.053 0.763,13.039 0.845,12.995 L7.452,9.471 L7.452,16.403 C7.452,16.607 7.547,16.796 7.711,16.912 C7.807,16.971 7.903,17.000 8.012,17.000 C8.094,17.000 8.190,16.985 8.258,16.942 L15.686,12.995 C15.877,12.893 16.000,12.689 16.000,12.456 C16.000,12.223 15.877,12.019 15.686,11.917 L9.270,8.495 L15.686,5.087 C15.877,4.985 16.000,4.781 16.000,4.548 ZM8.573,15.427 L8.573,9.471 L14.181,12.456 L8.573,15.427 ZM8.573,7.534 L8.573,1.562 L14.181,4.548 L8.573,7.534 Z"/>
                </svg>
                                                    </span>
                                                                        <span class="product-card_icon d-inline-block">
                                                       <svg
                                                           viewBox="0 0 20 15"
                                                           width="20px" height="15px">
                <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                      d="M19.794,5.420 C19.690,5.514 19.554,5.566 19.412,5.566 C19.255,5.566 19.109,5.505 19.002,5.394 C16.700,3.007 13.586,1.693 10.231,1.693 C6.876,1.693 3.761,3.007 1.461,5.394 C1.354,5.505 1.208,5.566 1.050,5.566 C0.908,5.566 0.773,5.514 0.668,5.420 C0.442,5.217 0.429,4.873 0.641,4.654 C3.156,2.045 6.562,0.609 10.231,0.608 C13.901,0.609 17.307,2.045 19.822,4.654 C20.033,4.873 20.020,5.217 19.794,5.420 ZM10.231,4.473 C12.727,4.472 15.121,5.464 16.970,7.266 C17.076,7.368 17.133,7.505 17.133,7.649 C17.132,7.794 17.073,7.930 16.967,8.032 C16.861,8.133 16.721,8.189 16.572,8.189 C16.421,8.189 16.280,8.132 16.174,8.029 C14.537,6.435 12.427,5.557 10.232,5.557 C8.035,5.557 5.925,6.435 4.288,8.029 C4.183,8.132 4.041,8.189 3.890,8.189 C3.741,8.189 3.601,8.133 3.495,8.032 C3.276,7.821 3.274,7.477 3.492,7.265 C5.341,5.465 7.734,4.473 10.231,4.473 ZM10.166,8.371 L10.223,8.371 C11.492,8.371 12.884,8.950 13.858,9.882 C13.964,9.984 14.023,10.120 14.024,10.264 C14.024,10.409 13.966,10.546 13.861,10.649 C13.755,10.752 13.614,10.809 13.463,10.809 C13.314,10.809 13.173,10.753 13.068,10.652 C12.309,9.925 11.192,9.455 10.224,9.455 L10.167,9.455 C9.198,9.455 8.081,9.925 7.322,10.652 C7.217,10.753 7.076,10.809 6.927,10.809 C6.777,10.809 6.635,10.752 6.529,10.649 C6.311,10.436 6.313,10.092 6.533,9.882 C7.506,8.950 8.898,8.371 10.166,8.371 ZM10.192,12.459 C10.780,12.459 11.259,12.922 11.259,13.490 C11.259,14.059 10.780,14.521 10.192,14.521 C9.604,14.521 9.126,14.059 9.126,13.490 C9.126,12.922 9.604,12.459 10.192,12.459 Z"/>
                </svg>
                                                    </span>
                                                                    </div>

                                                                    <!--Price-->
                                                                    <span
                                                                        class="product-card_price d-inline-block font-sec-bold font-24 text-tert-clr lh-1 ml-auto">
                                                            {{ convert_price(@$product->variations->first()->price,$currency)}}
                                                        </span>

                                                                </div>
                                                            </div>
                                                            <!--btn-->
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                       class="product-card_btn d-inline-flex align-items-center text-center font-15 text-sec-clr text-uppercase text-white cursor-pointer add-to-card-modal"
                                                       data-id="{{ $product->id }}">
                                                        <span
                                                            class="product-card_btn-text">{!! __('add_to_cart') !!}</span>
                                                        <span class="d-inline-block ml-auto">
                                <svg viewBox="0 0 18 22" width="18px" height="22px">
    <path fill-rule="evenodd" opacity="0.8" fill="rgb(255, 255, 255)"
          d="M14.305,3.679 L14.305,0.003 L3.694,0.003 L3.694,3.679 L-0.004,3.679 L-0.004,21.998 L18.003,21.998 L18.003,3.679 L14.305,3.679 ZM4.935,1.216 L13.064,1.216 L13.064,3.679 L4.935,3.679 L4.935,1.216 ZM16.761,20.785 L1.238,20.785 L1.238,4.891 L3.694,4.891 L3.694,7.329 L4.935,7.329 L4.935,4.891 L13.064,4.891 L13.064,7.329 L14.305,7.329 L14.305,4.891 L16.761,4.891 L16.761,20.785 Z"/>
    </svg>
                            </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @include("frontend.comments.index",['model'=>$post,'type'=>'posts'])
                </div>
                {{--end global block--}}
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
    <style>
        /* start news inner new*/
        .related-sliders .display-grid {
            margin: 0 20px;
        }

        .related-slid-product .fs-carousel.fs-light.fs-carousel-enabled .fs-carousel-canister {
            min-height: 570px;
        }

        .related-sliders .fs-carousel.fs-light.fs-carousel-enabled .fs-carousel-control_next, .related-sliders .fs-carousel.fs-light.fs-carousel-enabled.fs-carousel-rtl .fs-carousel-control_previous {
            right: 0;
        }

        .related-sliders .fs-carousel.fs-light.fs-carousel-enabled .fs-carousel-control_previous, .related-sliders .fs-carousel.fs-light.fs-carousel-enabled.fs-carousel-rtl .fs-carousel-control_next {
            left: 0;
        }

        .related-sliders .fs-carousel.fs-light.fs-carousel-enabled .fs-carousel-control {
            background: #5084e5;
        }

        .related-sliders .fs-carousel.fs-light.fs-carousel-enabled .fs-carousel-control:focus {
            outline: none;
        }

        .related-sliders .fs-carousel.fs-light.fs-carousel-enabled .fs-carousel-control_next:before, .related-sliders .fs-carousel.fs-light.fs-carousel-enabled.fs-carousel-rtl .fs-carousel-control_previous:before {
            border-left: 10.5px solid #ffffff;
        }

        .related-sliders .fs-carousel.fs-light.fs-carousel-enabled .fs-carousel-control_previous:before, .related-sliders .fs-carousel.fs-light.fs-carousel-enabled.fs-carousel-rtl .fs-carousel-control_next:before {
            border-right: 10.5px solid #fff;
        }

        /* end news inner new*/

    </style>
    {{--{!! Html::style("public/admin_theme/bower_components/bootstrap/dist/css/bootstrap.min.css") !!}--}}
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css"/>
    <link type="text/css" rel="stylesheet"
          href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css"/>
    <link rel="stylesheet" href="{{asset('public/admin_theme/OwlCarousel2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin_theme/OwlCarousel2/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/formstone/carousel/carousel.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/formstone/light.css')}}">
    <style>

        #gp-inner-container {
            height: calc(100% - 100px);
            overflow: auto;
        }

        .hide-icons {
            cursor: pointer;
        }
    </style>
@stop

@section("js")
    {{--<script src="{{asset('public/admin_theme/OwlCarousel2/owl.carousel.min.js')}}"></script>--}}

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
    <script>
        $("#share").jsSocials({
            shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
        });
        $(".gp-author-social-icons").jsSocials({
            shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
        });
        $(".gp-share-icons-on-footer").jsSocials({
            shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
        });
        $("body").on("click", ".gp-share-button, .hide-icons", function () {
            $("#gp-share-icons-hide").toggle()
        })
    </script>

    <script src="{{asset('public/plugins/formstone/core.js')}}"></script>
    <script src="{{asset('public/plugins/formstone/mediaquery.js')}}"></script>
    <script src="{{asset('public/plugins/formstone/touch.js')}}"></script>
    <script src="{{asset('public/plugins/formstone/carousel/carousel.js')}}"></script>

    <script>

        $(".realated-slider").carousel({
            show: {
                "567": 1,
                "740px": 2,
                "1220px": 4
            },
            pagination: false,
            theme: "fs-light"
            // matchWidth: false
        });

    </script>

@stop
