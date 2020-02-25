@extends('layouts.frontend')
@section('content')
    <main class="main-content products-page position-relative">
        <div class="top-filters products__page-top-filters main-content-wrapper">
            <div class="container main-max-width">
                <div class="content-head d-flex flex-wrap justify-content-between align-items-center position-relative">

                    <div class="category-select">
                        {!! Form::select('category',['' => __('all_products')]+$categories->toArray(),($category)?$category->slug:null,
                        [
                            'class' => 'select-filter all_categories select-2 select-2--no-search main-select products-filter-wrap_select not-selected arrow-dark',
                            'style' =>'width: 100%',
                            'id' => 'choose_product'
                        ]) !!}
                    </div>
                    <div class="right-head d-flex flex-wrap justify-content-lg-end justify-content-between">
{{--                        <div class="sale-only d-flex align-items-center">--}}
{{--                    <span class="text-gray-clr">--}}
{{--                        {!! __('sale_only') !!}:--}}
{{--                    </span>--}}
{{--                            <label class="switch-custom">--}}
{{--                                <input type="checkbox">--}}
{{--                                <span class="slider round"></span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
                        <div class="product-grid-list align-self-center">
                    <span class="d-inline-block products-filter-wrap_display-icons">
            <span id="dispGrid" class="d-inline-block pointer grid display-icon active">
<svg
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    width="15px" height="15px"
    viewBox="0 0 15 15">
<path fill-rule="evenodd" fill="rgb(188, 188, 188)"
      d="M13.769,8.730 C13.090,8.730 12.539,8.179 12.539,7.500 C12.539,6.821 13.090,6.270 13.769,6.270 C14.448,6.270 14.998,6.821 14.998,7.500 C14.998,8.179 14.448,8.730 13.769,8.730 ZM13.769,2.462 C13.090,2.462 12.539,1.911 12.539,1.232 C12.539,0.553 13.090,0.003 13.769,0.003 C14.448,0.003 14.998,0.553 14.998,1.232 C14.998,1.911 14.448,2.462 13.769,2.462 ZM7.501,14.997 C6.822,14.997 6.271,14.447 6.271,13.768 C6.271,13.089 6.822,12.538 7.501,12.538 C8.180,12.538 8.730,13.089 8.730,13.768 C8.730,14.447 8.180,14.997 7.501,14.997 ZM7.501,8.730 C6.822,8.730 6.271,8.179 6.271,7.500 C6.271,6.821 6.822,6.270 7.501,6.270 C8.180,6.270 8.730,6.821 8.730,7.500 C8.730,8.179 8.180,8.730 7.501,8.730 ZM7.501,2.462 C6.822,2.462 6.271,1.911 6.271,1.232 C6.271,0.553 6.822,0.003 7.501,0.003 C8.180,0.003 8.730,0.553 8.730,1.232 C8.730,1.911 8.180,2.462 7.501,2.462 ZM1.233,14.997 C0.554,14.997 0.004,14.447 0.004,13.768 C0.004,13.089 0.554,12.538 1.233,12.538 C1.912,12.538 2.462,13.089 2.462,13.768 C2.462,14.447 1.912,14.997 1.233,14.997 ZM1.233,8.730 C0.554,8.730 0.004,8.179 0.004,7.500 C0.004,6.821 0.554,6.270 1.233,6.270 C1.912,6.270 2.462,6.821 2.462,7.500 C2.462,8.179 1.912,8.730 1.233,8.730 ZM1.233,2.462 C0.554,2.462 0.004,1.911 0.004,1.232 C0.004,0.553 0.554,0.003 1.233,0.003 C1.912,0.003 2.462,0.553 2.462,1.232 C2.462,1.911 1.912,2.462 1.233,2.462 ZM13.769,12.538 C14.448,12.538 14.998,13.089 14.998,13.768 C14.998,14.447 14.448,14.997 13.769,14.997 C13.090,14.997 12.539,14.447 12.539,13.768 C12.539,13.089 13.090,12.538 13.769,12.538 Z"/>
</svg>
            </span>
            <span id="displVertBtn" class="d-inline-block pointer list display-icon">
<svg
    width="15px" height="15px"
    viewBox="0 0 15 15">
<path fill-rule="evenodd" opacity="0.502" fill="rgb(121, 121, 121)"
      d="M0.011,15.000 L0.011,13.586 L15.004,13.586 L15.004,15.000 L0.011,15.000 ZM0.011,6.791 L15.004,6.791 L15.004,8.205 L0.011,8.205 L0.011,6.791 ZM0.011,-0.004 L15.004,-0.004 L15.004,1.410 L0.011,1.410 L0.011,-0.004 Z"/>
</svg>
            </span>
        </span>
                        </div>
                        <div class="sort-by_select sort-by-products d-flex align-items-center position-relative border-0 new-sort-by_select">
                            <label for="sortBy" class="text-main-clr mb-0 text-uppercase">{!! __('sort_by') !!}: </label>
                            <div class="select-wall">
                                {!! Form::select('sort_by',[
                                    'newest' => __('newest'),
                                    'oldest' => __('oldest')
                                ],(\Request::has('sort_by')) ? \Request::get('sort_by') : null,[
                                    'id' => 'sortBy',
                                    'class' => 'select-filter select-2 select-2--no-search main-select products-filter-wrap_select not-selected arrow-dark',
                                    'style' => 'width: 100%',
                                ]) !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div>
                {{--                <div class="container main-max-width">--}}

                {{--                    <div class="d-flex align-items-center position-relative">--}}

                {{--                        <div class="filters-for-mobile d-lg-none d-flex align-self-stretch align-items-center justify-content-center">--}}
                {{--                            <span class="btn btn--filter text-tert-clr pointer">Filters</span>--}}
                {{--                        </div>--}}

                {{--                        <div class="arrow-wrap d-flex align-items-center nav-item--has-dropdown">--}}
                {{--                            --}}{{--<div class="d-flex arrow-filters pointer">--}}

                {{--                            --}}{{--<span class="mr-2 text-uppercase">Advanced Filters</span>--}}
                {{--                            --}}{{--<span class="icon pointer arrow main-transition">--}}
                {{--                            --}}{{--<svg--}}
                {{--                            --}}{{--xmlns="http://www.w3.org/2000/svg"--}}
                {{--                            --}}{{--xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                {{--                            --}}{{--width="12px" height="15px">--}}
                {{--                            --}}{{--<path fill-rule="evenodd" fill="rgb(81, 132, 229)"--}}
                {{--                            --}}{{--d="M5.998,7.783 L5.991,7.790 L-0.001,1.336 L1.239,-0.000 L5.998,5.126 L10.756,-0.000 L11.997,1.336 L6.005,7.790 L5.998,7.783 ZM5.998,12.335 L10.756,7.209 L11.997,8.545 L6.005,15.000 L5.998,14.992 L5.991,15.000 L-0.001,8.545 L1.239,7.209 L5.998,12.335 Z"/>--}}
                {{--                            --}}{{--</svg>--}}
                {{--                            --}}{{--</span>--}}
                {{--                            --}}{{--</div>--}}

                {{--                            --}}{{--<div class="nav-item--has-dropdown_dropdown">--}}
                {{--                            --}}{{--<div class="all-filters row">--}}
                {{--                            --}}{{--<div class="col-lg-5 col-md-12 filter-left-col">--}}
                {{--                            --}}{{--@foreach($filters as $filter)--}}
                {{--                            --}}{{--@if(in_array($filter->display_as,['select','multy_select']))--}}
                {{--                            --}}{{--@if(\View::exists('frontend.products._partials.filters.'.$filter->display_as))--}}
                {{--                            --}}{{--@include('frontend.products._partials.filters.'.$filter->display_as)--}}
                {{--                            --}}{{--@endif--}}
                {{--                            --}}{{--@endif--}}
                {{--                            --}}{{--@endforeach--}}
                {{--                            --}}{{--</div>--}}
                {{--                            --}}{{--<div class="col-lg-3 col-md-12">--}}
                {{--                            --}}{{--@foreach($filters as $filter)--}}
                {{--                            --}}{{--@if($filter->display_as == 'color')--}}
                {{--                            --}}{{--@if(\View::exists('frontend.products._partials.filters.'.$filter->display_as))--}}
                {{--                            --}}{{--@include('frontend.products._partials.filters.'.$filter->display_as)--}}
                {{--                            --}}{{--@endif--}}
                {{--                            --}}{{--@endif--}}
                {{--                            --}}{{--@endforeach--}}
                {{--                            --}}{{--</div>--}}
                {{--                            --}}{{--<div class="col-lg-4 col-md-12">--}}
                {{--                            --}}{{--@foreach($filters as $filter)--}}
                {{--                            --}}{{--@if(in_array($filter->display_as,['radio','checkbox']))--}}
                {{--                            --}}{{--@if(\View::exists('frontend.products._partials.filters.'.$filter->display_as))--}}
                {{--                            --}}{{--@include('frontend.products._partials.filters.'.$filter->display_as)--}}
                {{--                            --}}{{--@endif--}}
                {{--                            --}}{{--@endif--}}
                {{--                            --}}{{--@endforeach--}}
                {{--                            --}}{{--</div>--}}
                {{--                            --}}{{--<div class="col-12 text-right">--}}
                {{--                            --}}{{--<button class="btn save-filter-btn">Search</button>--}}
                {{--                            --}}{{--</div>--}}
                {{--                            --}}{{--</div>--}}
                {{--                            --}}{{--</div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>

        </div>
        <div class="main-content-wrapper">
            <div class="products-wrap change-display-wrap display-grid products__page-main">
                <div class="container main-max-width">
                    <div class="row">
                        <div class="products__page-main_left-wrapper">
                            {!! Form::model($filterModel,['url' => route('categories_front'),'method' => 'GET','id' => 'filter-form']) !!}
                            <div class="selected_filter-sidebar-wrapper">
                                @if(count($selecteds))
                                    <div class="d-flex justify-content-between head">
                                        <h5 class="font-main-bold text-uppercase">{!! __('selected') !!}</h5>
                                        <a href="javascript:void(0)"
                                           class="text-tert-clr text-uderlined font-15 reset-form">{!! __('reset') !!}</a>
                                    </div>
                                @endif
                            </div>
                            <div class="filter-sidebar-wrapper">
                                <h2 class="font-sec-reg font-21 text-tert-clr lh-1 filters-title">{!! __('filters') !!}</h2>
                                <div class="all-filters">
                                    <div class="mobile-back-reset">
                                        <a href="#" class="back-link">
                                            <span><i class="fa fa-arrow-left"></i></span>
                                        </a>
                                        <a href="javascript:void(0)"
                                           class="text-tert-clr text-uderlined font-15 reset-form">
                                            {!! __('reset') !!}
                                        </a>
                                    </div>
                                    {{--<div class="search-filters position-relative">--}}
                                        {{--<input type="search" class="form-control"  id="search-for-filter" name="search" placeholder="{!! __('search_for_anything') !!}">--}}
                                        {{--<span class="position-absolute d-flex align-items-center search-icon">--}}
                            {{--<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px">--}}
{{--<path fill-rule="evenodd" fill="rgb(121, 121, 121)" d="M19.996,18.987 L16.407,15.260 C19.498,11.614 19.327,6.153 15.881,2.715 C14.065,0.902 11.684,-0.004 9.303,-0.004 C6.922,-0.004 4.541,0.902 2.725,2.715 C-0.908,6.339 -0.908,12.216 2.725,15.841 C4.541,17.653 6.922,18.559 9.303,18.559 C11.469,18.559 13.630,17.800 15.371,16.300 L18.936,20.003 L19.996,18.987 ZM9.303,17.370 C7.136,17.370 5.099,16.528 3.567,15.000 C2.035,13.471 1.191,11.439 1.191,9.277 C1.191,7.116 2.035,5.084 3.567,3.555 C5.099,2.027 7.136,1.185 9.303,1.185 C11.469,1.185 13.507,2.027 15.039,3.555 C18.201,6.710 18.201,11.845 15.039,15.000 C13.507,16.528 11.469,17.370 9.303,17.370 Z"></path>--}}
{{--</svg>--}}
                        {{--</span>--}}
                                    {{--</div>--}}

                                    <div class="filter-single-wall">
                                        <div class="d-flex justify-content-between align-items-center head filter-main__head">
                                            <h5 class="font-sec-reg text-uppercase font-17">{!! __('brands') !!}</h5>
                                            <span class="icon-head">
                                                <i class="fas fa-minus"></i>
                                            </span>
                                        </div>
                                        <div class="list-filter">
                                            @include('frontend.products._partials.filters.checkbox_brand')
                                        </div>
                                    </div>
                                    @foreach($filters as $filter)
                                        <div class="filter-single-wall">
                                            <div class="d-flex justify-content-between align-items-center head filter-main__head">
                                                <h5 class="font-sec-reg text-uppercase font-17">{{ $filter->name }}</h5>
                                                <span class="icon-head">
                                                <i class="fas fa-minus"></i>
                                            </span>
                                            </div>
                                            <div class="list-filter">
                                                @if(\View::exists('frontend.products._partials.filters.'.$filter->display_as))
                                                    @include('frontend.products._partials.filters.'.$filter->display_as)
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="mobile-show-filters-wrap">
                                        <a href="#" class="bg-blue-clr text-sec-clr show-filter-link">{!! __('show') !!}</a>
                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>

                        <div class="products__page-main_right-wrapper">
                            @if($category)
                                <ul class="d-flex products__page-head__list mb-2">
                                    <li>
                                        <a href="javascript:void(0)" class="font-sec-reg item-link @if($sc == 'all')active @endif subcategory-select"  data-slug="all">All</a>
                                    </li>
                                    @foreach($category->children as $subcategory)
                                        <li>
                                            <a href="javascript:void(0)" class="font-sec-reg item-link @if($sc == $subcategory->slug)active @endif subcategory-select" data-slug="{{ $subcategory->slug }}">{!! $subcategory->name !!}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="products-box">
                                @include("frontend.products._partials.products_render",['all_products' => true])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--scroll top btn-->
        <button id="scrollTopBtn"
                class="scroll-top-btn d-flex align-items-center justify-content-center pointer ml-auto">
            <svg
                viewBox="0 0 17 10"
                width="17px" height="10px">
                <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                      d="M0.000,8.111 L1.984,10.005 L8.498,3.789 L15.010,10.005 L16.995,8.111 L8.498,0.001 L0.000,8.111 Z"/>
            </svg>
        </button>
    </main>

    <div class="modal fade" id="addToCardModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{!! __('select_variation') !!}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{!! __('cancel') !!}</button>
                    <a href="javascript:void(0)"
                       class="btn border-0 rounded-0 btn-add-to-cart product-card_btn d-inline-flex align-items-center justify-content-between text-center font-15 text-sec-clr text-uppercase">
                        <span class="product-card_btn-text mr-2">{!! __('add_to_cart') !!}</span>
                        <span class="d-inline-block ml-auto">
                            <svg viewBox="0 0 18 22" width="18px" height="22px">
                                <path fill-rule="evenodd" opacity="0.8" fill="rgb(255, 255, 255)"
                                      d="M14.305,3.679 L14.305,0.003 L3.694,0.003 L3.694,3.679 L-0.004,3.679 L-0.004,21.998 L18.003,21.998 L18.003,3.679 L14.305,3.679 ZM4.935,1.216 L13.064,1.216 L13.064,3.679 L4.935,3.679 L4.935,1.216 ZM16.761,20.785 L1.238,20.785 L1.238,4.891 L3.694,4.891 L3.694,7.329 L4.935,7.329 L4.935,4.891 L13.064,4.891 L13.064,7.329 L14.305,7.329 L14.305,4.891 L16.761,4.891 L16.761,20.785 Z"></path>
                            </svg>
                        </span>
                    </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('css')
    <style>
        @media (min-width: 992px) {
            #addToCardModal .modal-lg {
                max-width: 1400px;
            }
        }

        #addToCardModal .product-card_view.product-card_view--single {
            height: 300px;
        }

    </style>
@stop
@section("js")
    <script>
        $(document).ready(function () {
            if($(window).width()<=767){
                $('body').on('click','.filter-sidebar-wrapper .filters-title',function () {
                    $(this).parent().find('.all-filters').fadeIn()
                })
                $('body').on('click','.filter-sidebar-wrapper .back-link',function () {
                    $(this).parent().parent().fadeOut()
                })
            }

            $('body').on('click', '.filter-sidebar-wrapper .head.filter-main__head', function () {
                let blockId = $(this).parent().find('.list-filter');
                if ($(blockId).css('display') == 'none')
                {
                    $(blockId).animate({height: 'show'}, 100);
                    $(this).find('i').toggleClass('fa-plus fa-minus');
                }
                else
                {
                    $(blockId).animate({height: 'hide'}, 100);
                    $(this).find('i').toggleClass('fa-minus fa-plus');
                }
                $(this).toggleClass('closed')
            });

            $(document).click(function (e) {
                const containerBlock = $(".top-filters .arrow-wrap .nav-item--has-dropdown_dropdown");
                let arrowLink = $('.top-filters .arrow-wrap .arrow-filters');
                if (arrowLink.has(e.target).length === 0 && containerBlock.has(e.target).length === 0 && !$(e.target).hasClass('select2-selection__choice__remove')) {
                    if (containerBlock.hasClass('open')) {
                        containerBlock.removeClass('open');
                        $('.top-filters .main-filters').addClass('closed-mobile');
                        arrowLink.find('.icon.arrow').removeClass('opened')
                    }
                }
            });

            $("#filter-form").on("change", function() {
                $(this).closest('form').data('changed', true);
                doSubmitForm()
            });

            $("#sortBy").on("change", function() {
                doSubmitForm()
            });

            $('body').on('click','#displVertBtn',function () {
                // console.log(6666)
                $(this).closest('.main-content').find('.products__page-main_right-wrapper .products-box').height('auto')
            })
            $("body").on("click",'.subcategory-select', function() {
                $("body").find('.subcategory-select').removeClass('active');
                $("body").find('.subcategory-select[data-slug="'+$(this).data('slug')+'"]').addClass('active');
                doSubmitForm()
            });

            // if($('#filter-form .filter-sidebar-wrapper').length !== 0) {
                $("#search-for-filter").on('keyup', function(e) {
                    e.preventDefault();
                    var code = e.keyCode || e.which;
                    if(code == 13) {
                        doSubmitForm();
                    }

                });

                $('#search-for-filter + span').on('click', function(e) {
                    e.preventDefault();
                    doSubmitForm();
                })
            // }

            var parseQueryString = function() {

                var str = decodeURI(window.location.search);
                var objURL = {};

                str.replace(
                    new RegExp( "([^?=&]+)(=([^&]*))?", "g" ),
                    function( $0, $1, $2, $3 ){
                        objURL[ $1 ] = $3;
                    }
                );
                return objURL;
            };

            function doSubmitForm(removedData) {
                console.log(removedData)
                $('.products-box').html('<div id="loading" class="justify-content-center align-items-center my-5 d-flex">\n' +
                    '            <div class="lds-dual-ring"></div>\n' +
                    '        </div>');
                let form = $("#filter-form");
                let serializeValue = form.serialize();
                let serializedArrey;
                    let category = $('.all_categories').val();
                    let search_text = $("#search-for-filter").val();
                    let sort_by = $("#sortBy").val();
                    let subcategory = $("body").find('.subcategory-select.active').data('slug');

                    let url = category === '' ? "/products" : "/products/" + category;
                    var serArr = form.serializeArray();

                    // let url = "/products/" + category;
                // console.log(typeof serializeValue)
                // console.log(window.location.origin + window.location.pathname + '?' + serializeValue + `&sort_by=${sort_by}&q=${search_text}`)
                if(removedData) {

                    // if(removedData.type === 'brand') {
                    //     $(`.all-filters .filter-single-wall [name="${removedData.name}"][value="${removedData.value}"]`).trigger('click')
                    //     serializedArrey = serArr.filter((filter) => {
                    //         return !Boolean(filter.name === removedData.name && filter.value === removedData.value);
                    //     })
                    //     console.log(serializedArrey)
                    //     console.log('before', serializeValue)

                    //     serializeValue = $.param( serializedArrey )
                    //     console.log('after', serializeValue)
                    // } else if(removedData.type === 'select') {
                        if($(`.all-filters .filter-single-wall [name="${removedData.name}"]`).is('input')) {
                            if($(`.all-filters .filter-single-wall [name="${removedData.name}"]`).attr('type') === 'radio') {
                                serializedArrey = serArr.filter((filter) => {
                                    return !Boolean(filter.name === removedData.name);
                                })
                                $(`.all-filters .filter-single-wall [name="${removedData.name}"]`).each(function(index, radio) {
                                    $(radio).prop('checked', false);
                                });

                            } else if($(`.all-filters .filter-single-wall [name="${removedData.name}"]`).attr('type') === 'checkbox') {
                                $(`.all-filters .filter-single-wall [name="${removedData.name}"][value="${removedData.value}"]`).trigger('click')
                                    serializedArrey = serArr.filter((filter) => {
                                        return !Boolean(filter.name === removedData.name && filter.value === removedData.value);
                                    })
                                    console.log(serializedArrey)
                                    console.log('before', serializeValue)

                                    console.log('after', serializeValue)
                            }
                            serializeValue = $.param( serializedArrey )

                        // }
                    } else if($(`.all-filters .filter-single-wall [name="${removedData.name}"]`).is('select')) {

                        if(removedData.value === "") {

                            $(`.all-filters .filter-single-wall [name="${removedData.name}"]`).find('option').each(function(index, option) {
                                index === 0 && $(option).prop('selected', true);
                                $(option).prop('selected', false);
                            });
                            serializedArrey = serArr.filter((filter) => {
                                return !Boolean(filter.name === removedData.name);
                            })
                            $(`.all-filters .filter-single-wall [name="${removedData.name}"]`).trigger('change');
                        } else {
                            $(`.all-filters .filter-single-wall [name="${removedData.name}"]`).find(`option[value=${removedData.value}]`).prop('selected', false)
                            serializedArrey = serArr.filter((filter) => {
                                return !Boolean(filter.name === removedData.name && filter.value === removedData.value);
                            });
                            $(`.all-filters .filter-single-wall [name="${removedData.name}"]`).trigger('change');
                        }
                        serializeValue = $.param( serializedArrey )
                    }
                    

                } 
                
                history.replaceState('', '', window.location.pathname + '?' + serializeValue + `&sort_by=${sort_by}&subcategory=${subcategory}&q=${search_text || ''}`);
                // window.location.replace(window.location.origin + window.location.pathname + '?' + form);
                console.log(serArr)

                var filters = serArr.map((filt) => {
                    var n = filt.name;
                    var v = filt.name === "amount" ? filt.value.match(/[0-9]+/gi) : filt.value;
                    return {
                        name: n,
                        value: v
                    }
                }).filter(filt => filt.name.includes('select_filter'));

                

                $.ajax({
                    type: "post",
                    url: url,
                    cache: false,
                    datatype: "json",
                    data: `${serializeValue}&sort_by=${sort_by}&subcategory=${subcategory}&q=${search_text || ''}`,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        if (!data.error) {
                            $("body").find('.products-box').css('height','auto');
                            $(".products-box").html(data.html);
                            // $("#filter-form").closest('form').data('changed', true);

                            let productsWallHeight = parseInt( $('body').find('.products-box').height())

                            $("body").find('.products-box').css('height',productsWallHeight);
                            // var ht = (name, path) => {
                            //     return `<li class="selected_filter-sidebar-item position-relative">
                            //                     <span class="selection_remove" role="presentation">×</span>
                            //                      ${name}
                            //                 </li>`
                            // };
                            //
                            // var elements = filters.map((el) => {
                            //     var name = $(`[name="${el.name}"]`)
                            //     console.log(name.prop("tagName"));
                            //     if(name.attr("type") === "radio" && name.attr('checked') === 'checked') {
                            //         return ht(name.next().text().trim())
                            //     } else if(name.attr("type") === "checkbox" && name.attr('checked') === 'checked') {
                            //         return ht(name.next().text().trim())
                            //     } else if(name.prop("tagName") === "SELECT") {
                            //         return ht(name.next().text().trim())
                            //     }
                            //
                            // })


                            // $(".selected_filter-sidebar-wrapper").html(`<ul class="d-inline-block">
                            //                 ${elements.join('')}
                            //             </ul>`)
                        }
                    },
                    error: function() {
                        $(".products-box").html('Error')
                    }
                });
            }
            $('body').on('click', '.selected__filters .single-item .remove-icon', function(ev) {
                const dataKey = $(ev.target).closest('.single-item').data('key').toString();
                const dataType = $(ev.target).closest('.single-item').data('type');
                
                const filter = dataKey.match(/\d+/ig)
                filter_id = filter[0] ? filter[0].toString() : '';
                filter_value = filter[1] ? filter[1].toString() : '';
                let name = '';
                let value = '';
                if(dataType === 'brand') {
                    name = 'brands[]',
                    value = filter_id.toString();
                } else {
                    if(filter_value) {
                        name = `select_filter[${filter_id}][]`;
                        value = filter_value;
                    } else {
                        name = `select_filter[${filter_id}]`;
                    }
                }
                const removedData = {
                    name,
                    value,
                    type: dataType
                }
                doSubmitForm(removedData)
            })


            var rangeDataString = "{{ (\Request::has('amount') && \Request::get('amount')) ? \Request::get('amount') : "0,".(convert_price(500,$currency,false,true)) }}";
            console.log(rangeDataString);
            var rangeArray = rangeDataString.split(',');

            {{--$("#slider-range").slider({--}}
            {{--    range: true,--}}
            {{--    min: 0,--}}
            {{--    max: '{{ convert_price(1000,$currency,false,true,true) }}',--}}
            {{--    values: rangeArray,--}}
            {{--    slide: function (event, ui) {--}}
            {{--        $("#amount").val(ui.values[0] + " - " + ui.values[1]);--}}
            {{--        $("#amount_range").val(ui.values[0] + "," + ui.values[1]);--}}
            {{--    },--}}
            {{--    change: function (event, ui) {--}}
            {{--        doSubmitForm()--}}
            {{--    }--}}
            {{--});--}}

            // $("#amount").val($("#slider-range").slider("values", 0) +
            //     " - " + $("#slider-range").slider("values", 1));

            // $("body").on('click', '.save-filter-btn', function () {
            //     doSubmitForm();
            // });

            // $("body").on('change', '.select-filter', function () {
            //     doSubmitForm();
            // });

            $("body").on('click', '.reset-form', function () {
                $(location).attr("href", "/products/" + $("#choose_product").val())
            });

            $("body").on('change', "#choose_product", function() {
                let form = $("#filter-form");
                let serializeValue = form.serialize();
                let category = $('.all_categories').val();
                let search_text = $("#search-for-filter").val();
                let sort_by = $("#sortBy").val();

                $(location).attr("href", "/products/" + $(this).val() + '?' + serializeValue + `&sort_by=${sort_by}&q=${search_text || ''}`)
            });

            $("body").on('click', '.add-to-card-modal', function () {
                var id = $(this).data("id");

                if (id && id != '') {
                    $.ajax({
                        type: "post",
                        url: "/products/get-product-variations",
                        cache: false,
                        datatype: "json",
                        data: {
                            id: id
                        },
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            if (!data.error) {
                                $("#addToCardModal").find('.modal-body').html(data.html);
                                get_price();

                                var plist = $(".poptions-group");
                                for (var i = 0; i < plist.length; i++) {
                                    get_promotion_price($(plist[i]).data('promotion'))
                                }
                                $("#addToCardModal").modal();
                            } else {

                            }
                        }
                    });
                } else {
                    alert('Select available variation');
                }
            });

            $("body").on('change', '.select-variation-option', function () {
                get_price();
            });

            $("body").on('change', '.select-variation-radio-option', function () {
                get_price();
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
                                $("#addToCardModal").modal('hide');
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

                        } else {
                            $(".price-place").html('<span class="d-inline-block font-16">' + data.message + '</span>');
                            $("#variation_uid").val('');
                            $(".add-fav-variation").addClass('d-none').data('id', '').removeClass('active');
                        }
                    }
                });
            }

            $("body").on('change', '.select-variation-poption', function () {
                var pid = $(this).closest('.poptions-group').data('promotion');
                get_promotion_price(pid);
            });

            $("body").on('change', '.select-variation-radio-poption', function () {
                var pid = $(this).closest('.poptions-group').data('promotion');
                get_promotion_price(pid);
            });

            function get_promotion_price(pid) {
                let options = {};

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
                    data: {options: options, uid: pid, promotion: true},
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
//                        $("#variation_uid").val('');
                        }
                    }
                });
            }

            $('body').on('change', '.products_custom_check input', function () {
                if ($(this).is(':checked')) {
                    $(this).closest('.product-single-info_title').next().removeClass('products_closed')
                } else {
                    $(this).closest('.product-single-info_title').next().addClass('products_closed')
                }
            })

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
            // $("form").keypress(function(e) {
            //     //Enter key
            //     if (e.which == 13) {
            //         return false;
            //     }
            // });

           
        });
    </script>

@stop
