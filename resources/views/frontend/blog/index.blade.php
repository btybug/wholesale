@extends('layouts.frontend')
@section('content')
    <main class="main-content">
        <div class="top-filters">
            <div class="container main-max-width">
                {!! Form::model($filterModel,['url' => route('blog'),'id' =>'news-filter','method' => 'GET']) !!}

                <div class="d-flex align-items-center position-relative">
                    @include('frontend._partials.individual_left_bar',['type' => 'news'])

                    <div class="btn d-md-none toggler ml-auto pointer bg-transparent pointer" data-toggle="collapse" data-target="#sortBySelects">Sort By:</div>

                    <div  id="sortBySelects" class="sort-by-selects news_sort_by_select collapse d-md-flex align-items-center ml-sm-auto">
                        <div class="product-grid-list d-flex align-self-center">
                            <span id="dispGrid" class="d-inline-block pointer display-icon active">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" idth="15px" height="15px" viewBox="0 0 15 15">
                                    <path fill-rule="evenodd" fill="rgb(188, 188, 188)"
                                      d="M13.769,8.730 C13.090,8.730 12.539,8.179 12.539,7.500 C12.539,6.821 13.090,6.270 13.769,6.270 C14.448,6.270 14.998,6.821 14.998,7.500 C14.998,8.179 14.448,8.730 13.769,8.730 ZM13.769,2.462 C13.090,2.462 12.539,1.911 12.539,1.232 C12.539,0.553 13.090,0.003 13.769,0.003 C14.448,0.003 14.998,0.553 14.998,1.232 C14.998,1.911 14.448,2.462 13.769,2.462 ZM7.501,14.997 C6.822,14.997 6.271,14.447 6.271,13.768 C6.271,13.089 6.822,12.538 7.501,12.538 C8.180,12.538 8.730,13.089 8.730,13.768 C8.730,14.447 8.180,14.997 7.501,14.997 ZM7.501,8.730 C6.822,8.730 6.271,8.179 6.271,7.500 C6.271,6.821 6.822,6.270 7.501,6.270 C8.180,6.270 8.730,6.821 8.730,7.500 C8.730,8.179 8.180,8.730 7.501,8.730 ZM7.501,2.462 C6.822,2.462 6.271,1.911 6.271,1.232 C6.271,0.553 6.822,0.003 7.501,0.003 C8.180,0.003 8.730,0.553 8.730,1.232 C8.730,1.911 8.180,2.462 7.501,2.462 ZM1.233,14.997 C0.554,14.997 0.004,14.447 0.004,13.768 C0.004,13.089 0.554,12.538 1.233,12.538 C1.912,12.538 2.462,13.089 2.462,13.768 C2.462,14.447 1.912,14.997 1.233,14.997 ZM1.233,8.730 C0.554,8.730 0.004,8.179 0.004,7.500 C0.004,6.821 0.554,6.270 1.233,6.270 C1.912,6.270 2.462,6.821 2.462,7.500 C2.462,8.179 1.912,8.730 1.233,8.730 ZM1.233,2.462 C0.554,2.462 0.004,1.911 0.004,1.232 C0.004,0.553 0.554,0.003 1.233,0.003 C1.912,0.003 2.462,0.553 2.462,1.232 C2.462,1.911 1.912,2.462 1.233,2.462 ZM13.769,12.538 C14.448,12.538 14.998,13.089 14.998,13.768 C14.998,14.447 14.448,14.997 13.769,14.997 C13.090,14.997 12.539,14.447 12.539,13.768 C12.539,13.089 13.090,12.538 13.769,12.538 Z"/>
                                </svg>
                            </span>
                            <span id="displVertBtn" class="d-inline-block pointer display-icon">
                                <svg width="15px" height="15px" viewBox="0 0 15 15">
                                    <path fill-rule="evenodd" opacity="0.502" fill="rgb(121, 121, 121)"
                                      d="M0.011,15.000 L0.011,13.586 L15.004,13.586 L15.004,15.000 L0.011,15.000 ZM0.011,6.791 L15.004,6.791 L15.004,8.205 L0.011,8.205 L0.011,6.791 ZM0.011,-0.004 L15.004,-0.004 L15.004,1.410 L0.011,1.410 L0.011,-0.004 Z"/>
                                </svg>
                            </span>
                        </div>

                        <div class="sort-by_select d-flex align-items-center position-relative">
                            <label for="sortByLimit" class="text-main-clr mb-0 text-uppercase">{!! __('limit') !!}: </label>
                            <div class="select-wall">
                                {!! Form::select('per-page',[
                                    '8' => __('select'),
                                    '5' => '5 '. __('per_page'),
                                    '10' =>'10 '. __('per_page'),
                                    '15' =>'15 '. __('per_page'),
                                    '30' =>'30 '. __('per_page'),
                                ], null,[
                                    'class' =>'select-filter select-2 select-2--no-search main-select main-select-2arrows products-filter-wrap_select not-selected arrow-dark',
                                    'style' => 'width: 250px'
                                ]) !!}
                            </div>
                        </div>

                        <div class="sort-by_select d-flex align-items-center position-relative">
                            <label for="sortBy" class="text-main-clr mb-0 text-uppercase">{!! __('sort_by') !!}: </label>
                            <div class="select-wall">
                                {!! Form::select('sort',[
                                    '' => __('select'),
                                    'desc' => __('newest'),
                                    'asc' => __('oldest'),
                                ],null,[
                                    'class' => 'select-filter select-2 select-2--no-search main-select main-select-2arrows products-filter-wrap_select not-selected arrow-dark',
                                    'style' => 'width: 250px'
                                ]) !!}
                            </div>
                        </div>


                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="news-wrap change-display-wrap display-grid">
            <div class="container main-max-width">
                <div class="row justify-content-md-start justify-content-center">
                    @foreach($posts as $post)
                        <a href="{!! post_url($post) !!}" class="news-wrap_col">
                            <span class="news-card main-transition position-relative">
                                <span class="news-card_view d-block position-relative">
                                    <!--news main image-->
                                        <img class="card-img-top"  src="{!! ($post->image)?$post->image:'http://demo.laravelcommerce.com/resources/assets/images/news_images/1504015363.about_contact_pages.svg' !!}" alt="{!! $post->title !!}" title="{!! $post->title !!}">
                                    <!--share icon-->
                                    <span class="like-icon news-card_share-icon d-inline-block pointer main-transition position-absolute">
                                    <svg iewBox="0 0 20 21" width="20px" height="21px">
                                        <path fill-rule="evenodd"  opacity="0.6" fill="rgb(255, 255, 255)" d="M16.364,13.881 C15.393,13.881 14.480,14.252 13.793,14.925 C13.603,15.111 13.438,15.316 13.296,15.533 L7.014,11.799 C7.181,11.392 7.275,10.948 7.275,10.484 C7.275,10.018 7.181,9.576 7.015,9.168 L13.298,5.461 C13.944,6.454 15.074,7.116 16.364,7.116 C18.368,7.116 19.999,5.518 19.999,3.555 C19.999,1.592 18.368,-0.006 16.364,-0.006 C14.359,-0.006 12.728,1.592 12.728,3.555 C12.728,4.002 12.817,4.430 12.971,4.823 L6.678,8.535 C6.028,7.565 4.910,6.923 3.639,6.923 C1.635,6.923 0.004,8.519 0.004,10.484 C0.004,12.447 1.635,14.045 3.639,14.045 C4.910,14.045 6.028,13.402 6.678,12.431 L12.969,16.172 C12.813,16.573 12.728,17.001 12.728,17.442 C12.728,18.393 13.106,19.289 13.793,19.960 C14.480,20.633 15.393,21.003 16.364,21.003 C17.335,21.003 18.247,20.633 18.934,19.960 C19.621,19.289 19.999,18.393 19.999,17.442 C19.999,16.491 19.621,15.598 18.934,14.925 C18.247,14.252 17.335,13.881 16.364,13.881 L16.364,13.881 Z"/>
                                    </svg>
                                </span>

                                </span>
                                <span class="news-card_body">
                                    <span class="news-card_body-text d-block">
                                        <span class="d-inline-block card-title font-21 font-sec-bold text-main-clr underlined-on-hover" title="{{ $post->title }}">{!! str_limit($post->title,30) !!}</span>
                                        <span class="card-text d-block font-main-light font-15 text-light-clr" title="{{ $post->short_description }}">
                                            {!! str_limit($post->short_description,60) !!}
                                        </span>
                                    </span>
                                    <span class="news-card_footer d-flex align-items-center">
                                        <span class="d-inline-block font-12 font-main-light text-light-clr">{!! time_ago($post->created_at) !!}</span>
                                        <span class="ml-auto">
                                            <span class="news-card_views d-inline-flex align-items-center position-relative">
                                                <svg viewBox="0 0 16 11" width="16px" height="11px">
                                                    <path fill-rule="evenodd"  fill="rgb(188, 188, 188)" d="M8.000,-0.003 C4.364,-0.003 1.235,2.270 0.000,5.497 C1.235,8.725 4.364,10.998 8.000,10.998 C11.636,10.998 14.760,8.725 15.999,5.497 C14.760,2.270 11.636,-0.003 8.000,-0.003 L8.000,-0.003 ZM8.000,9.165 C5.962,9.165 4.364,7.549 4.364,5.497 C4.364,3.446 5.962,1.830 8.000,1.830 C10.034,1.830 11.636,3.446 11.636,5.497 C11.636,7.549 10.034,9.165 8.000,9.165 L8.000,9.165 ZM8.000,3.299 C6.764,3.299 5.816,4.252 5.816,5.497 C5.816,6.743 6.764,7.696 8.000,7.696 C9.235,7.696 10.180,6.743 10.180,5.497 C10.180,4.252 9.235,3.299 8.000,3.299 L8.000,3.299 Z"/>
                                                </svg>
                                                <span class="d-inline-block text-main-clr ml-2">123</span>
                                                <!--views tooltip-->
                                                <span class="news-card_views-tooltip d-inline-flex align-items-center justify-content-center font-12 font-main-light main-transition position-absolute">{!! __('view') !!}</span>
                                            </span>
                                            <span class="d-inline-flex align-items-center">
                                                <svg viewBox="0 0 15 12" ="15px" height="12px">
                                                    <path fill-rule="evenodd"  fill="rgb(188, 188, 188)" d="M15.002,5.832 L8.767,-0.002 L8.767,3.343 C4.351,3.391 -0.003,7.181 -0.003,12.001 C2.109,9.975 4.607,8.146 8.767,8.295 L8.767,11.665 L15.002,5.832 Z"/>
                                                </svg>
                                                <span class="d-inline-block text-main-clr ml-2">10</span>
                                            </span>
                                        </span>
                                    </span>
                                </span>

                            </span>
                        </a>


                    {{--<strong>{!! BBgetDateFormat($post->created_at,'d') !!}</strong>{!! BBgetDateFormat($post->created_at,'M') !!}--}}
                    @endforeach
                    <!-- The END -->
                </div>
            </div>
        </div>

        <div class="container main-max-width">
            <!--view more dotes-->
            <div class="view-more-dots text-center">
                <span class="view-more-dots_item d-inline-block"></span>
                <span class="view-more-dots_item d-inline-block"></span>
                <span class="view-more-dots_item d-inline-block"></span>
            </div>
            {{-- <!--pagination--> Not finished !! --}}
            {{ $posts->links("vendor.pagination.bootstrap-4",compact(['filterModel'])) }}

            {{--<nav class="main-pagination-wrapp d-flex justify-content-center" aria-label="page navigation">--}}
                {{--<ul class="pagination flex-wrap rounded-0">--}}
                    {{--<li class="page-item disabled"><a class="page-link text-tert-clr font-15 rounded-0" href="/awdawd">Previous</a></li>--}}
                    {{--<li class="page-item active"><a class="page-link text-gray-clr font-16" href="#">1<span class="sr-only">(current)</span></a></li>--}}
                    {{--<li class="page-item"><a class="page-link text-gray-clr font-16" href="#">2</a></li>--}}
                    {{--<li class="page-item"><a class="page-link text-gray-clr font-16" href="#">3</a></li>--}}
                    {{--<li class="page-item"><a class="page-link text-gray-clr font-16" href="#">4</a></li>--}}
                    {{--<li class="page-item"><a class="page-link text-gray-clr font-16" href="#">&#8228;&#8228;&#8228;</a></li>--}}
                    {{--<li class="page-item"><a class="page-link text-tert-clr font-15 rounded-0" href="#">Next</a></li>--}}
                {{--</ul>--}}
            {{--</nav>--}}

        </div>


        <!--scroll top button-->
        <button id="scrollTopBtn" class="scroll-top-btn d-flex align-items-center justify-content-center pointer">
            <svg viewBox="0 0 17 10" width="17px" height="10px">
                <path fill-rule="evenodd" fill="rgb(124, 124, 124)" d="M0.000,8.111 L1.984,10.005 L8.498,3.789 L15.010,10.005 L16.995,8.111 L8.498,0.001 L0.000,8.111 Z"></path>
            </svg>
        </button>
    </main>
@stop
@section("js")

<script>
    // $("body").on("click", ".change-view-blog", function (e) {
    //     e.preventDefault()
    //     $(".change-view-blog").removeClass("active")
    //     $(this).addClass("active")
    //     if($(this).attr("id") === "list_news"){
    //         localStorage.setItem('testObject',"list_news");
    //         $(".blogs").addClass("blogs-list")
    //     }else {
    //         localStorage.setItem('testObject',"cube");
    //         $(".blogs").removeClass("blogs-list")
    //     }
    // })

    // localStorage.setItem('testObject', JSON.stringify(testObject));

    // Retrieve the object from storage
    // var retrievedObject = localStorage.getItem('testObject');

    $(document).ready(function(){
        $("body").on('change','.select-filter',function () {
            $("#news-filter").submit()
        })
    })
</script>

@stop
