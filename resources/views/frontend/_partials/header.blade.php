<header class="main-header">
    <div class="header-top">
        <div class="container main-max-width h-100">
            <div class="d-flex flex-wrap justify-content-between h-100">
                <nav class="navbar navbar-expand-md flex-md-row-reverse w-100 navbar-dark">
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarTogglerDemo01"
                                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="logo-small-screens d-md-none d-flex align-items-center ml-3">
                            <img src="{!! url('/public/img/logo-icon.png') !!}"  alt="" class="logo-small-screens_logo">
                            <h1 class="font-14 font-sec-bold text-sec-clr text-uppercase ml-2 mb-0">The Vapors Hub</h1>
                        </div>
                    </div>

                    @if(Auth::check())
                        <div id="ptofileBtn"
                             class="form-inline my-2 my-lg-0 align-self-lg-auto align-self-baseline pointer">
                            <div class="user-img">
                                <img src="{!! user_avatar() !!}" alt="user">
                            </div>
                            <span class="user-name font-15 text-sec-clr font-main-bold">
                                Hi {{ Auth::user()->name }}
                            </span>
                        </div>
                    @else
                        {{--<span class="d-inline-block">--}}
                        {{--<a href="{!! route('login') !!}" class="header-login-link">Login</a>--}}
                        {{--<span class="header-login-icon">&nbsp;&#47;&nbsp;</span>--}}
                        {{--<a href="{!! route('register') !!}" class="header-login-link">Register</a>--}}
                        {{--</span>--}}


                        <div class="form-inline my-lg-0 h-100 align-self-lg-auto align-self-baseline pointer">
                                <span class="d-inline-block">
                                    <a href="javascript:void(0);" class="text-sec-clr header-login-link"
                                       data-toggle="modal" data-target="#loginModal">Login</a>
                                    <span class="text-sec-clr">&nbsp;/&nbsp;</span>
                                    <a href="javascript:void(0);" class="text-sec-clr header-login-link"
                                       data-toggle="modal" data-target="#registerModal">Register</a>
                                </span>
                        </div>
                    @endif

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link" href="{!! url('/') !!}">Home</a>
                            </li>
                            <li class="nav-item align-items-center nav-item--has-dropdown">
                                <a class="nav-link" href="javascript:void(0)">Products
                                    <span class="ml-2 d-inline-block arrow main-transition pointer">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="9px" height="6px">
<path fill-rule="evenodd" fill="rgb(121, 121, 121)"
      d="M0.003,0.001 L8.998,0.001 L4.501,5.999 L0.003,0.001 Z"/>
</svg>
                        </span>
                                </a>

                                <div class="nav-item--has-dropdown_dropdown">
                                    <div class="products-menu-item row">
                                        @include("frontend._partials.header_menu_products")
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('product_sales') !!}">Sales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('blog') !!}">News</a>
                            </li>
                            {{--<li class="nav-item nav-item--has-dropdown position-relative">--}}
                                {{--<a class="nav-link" href="{!! route('blog') !!}">--}}
                                    {{--Community--}}
                                    {{--<span class="ml-2 d-inline-block arrow main-transition pointer">--}}
                            {{--<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="6px">--}}
{{--<path fill-rule="evenodd" fill="rgb(121, 121, 121)" d="M0.003,0.001 L8.998,0.001 L4.501,5.999 L0.003,0.001 Z"></path>--}}
{{--</svg>--}}
                        {{--</span>--}}
                                {{--</a>--}}
                                {{--<ul class="nav-item--has-dropdown_dropdown list-unstyled p-0">--}}
                                    {{--<li class="nav-item--has-dropdown_dropdown-item">--}}
                                        {{--<a href="{!! route('blog') !!}" class="nav-item--has-dropdown_dropdown-link d-inline-block w-100 text-gray-clr font-15 main-transition">News</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="nav-item--has-dropdown_dropdown-item">--}}
                                        {{--<a href="#" class="nav-item--has-dropdown_dropdown-link d-inline-block w-100 text-gray-clr font-15 main-transition">Forums</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="nav-item--has-dropdown_dropdown-item">--}}
                                        {{--<a href="#" class="nav-item--has-dropdown_dropdown-link d-inline-block w-100 text-gray-clr font-15 main-transition">Social</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            <li class="nav-item">
                                <a class="nav-link " href="{!! route('product_support') !!}">Support</a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container main-max-width">
            <div class="d-flex justify-content-between align-items-center header-bottom-wrapper">
                <a href="{!! url('/') !!}" class="d-md-block d-none logo">
                    <img src="{!! url('/public/img/vapors-logo.png') !!}" alt="logo">
                </a>
                <div class="d-flex align-self-center cat-search">
                    @if(\Request::route()->getName() != 'categories_front')
                        <div class="category-select">
                            @php
                                $categories = \App\Models\Category::with('children')->where('type', 'stocks')->whereNull('parent_id')->get()->pluck('name','slug');
                            @endphp
                            {!! Form::select('category',['' => 'All Categories'] + $categories->toArray(),null,
                                [
                                    'class' => 'all_categories select-2 select-2--no-search main-select main-select-2arrows products-filter-wrap_select not-selected',
                                    'style' =>'width: 190px',
                                    'id' => 'filter_sort'
                                ]) !!}
                        </div>
                    @endif
                    <div class="search position-relative">
                        <input type="search" class="form-control" id="search-product"
                               value="{{ (\Request::has('q')) ? \Request::get('q') :null }}"
                               placeholder="Serach for anything">
                        <span class="position-absolute d-flex align-items-center">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="20px" height="20px">
<path fill-rule="evenodd" fill="rgb(121, 121, 121)"
      d="M19.996,18.987 L16.407,15.260 C19.498,11.614 19.327,6.153 15.881,2.715 C14.065,0.902 11.684,-0.004 9.303,-0.004 C6.922,-0.004 4.541,0.902 2.725,2.715 C-0.908,6.339 -0.908,12.216 2.725,15.841 C4.541,17.653 6.922,18.559 9.303,18.559 C11.469,18.559 13.630,17.800 15.371,16.300 L18.936,20.003 L19.996,18.987 ZM9.303,17.370 C7.136,17.370 5.099,16.528 3.567,15.000 C2.035,13.471 1.191,11.439 1.191,9.277 C1.191,7.116 2.035,5.084 3.567,3.555 C5.099,2.027 7.136,1.185 9.303,1.185 C11.469,1.185 13.507,2.027 15.039,3.555 C18.201,6.710 18.201,11.845 15.039,15.000 C13.507,16.528 11.469,17.370 9.303,17.370 Z"/>
</svg>
                        </span>
                    </div>
                </div>
                <div class="favorite-add-cart d-flex align-items-center">
                    <span class="position-relative pointer add-links-wrap_icon search-mobile-icon">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="26px" height="22px" viewBox="0 0 29 22">
<path fill-rule="evenodd"  fill="rgb(121, 121, 121)"
      d="M19.996,18.987 L16.406,15.260 C19.498,11.613 19.327,6.153 15.881,2.715 C14.065,0.902 11.684,-0.004 9.303,-0.004 C6.922,-0.004 4.541,0.902 2.724,2.715 C-0.909,6.339 -0.909,12.216 2.724,15.840 C4.541,17.653 6.922,18.559 9.303,18.559 C11.469,18.559 13.630,17.800 15.371,16.300 L18.936,20.002 L19.996,18.987 ZM9.303,17.370 C7.136,17.370 5.099,16.528 3.567,15.000 C2.035,13.471 1.191,11.439 1.191,9.277 C1.191,7.116 2.035,5.084 3.567,3.555 C5.099,2.026 7.136,1.185 9.303,1.185 C11.469,1.185 13.506,2.026 15.038,3.555 C18.201,6.710 18.201,11.844 15.038,15.000 C13.506,16.528 11.469,17.370 9.303,17.370 Z"/>
</svg>
                    </span>
                    <div class="d-inline-block simple_select_wrapper currency--wrap">
                        {!! Form::select('currency',site_currencies(),$currency,[
                           'class' =>'select-2 currency--select-2 main-select',
                           'id' => 'change-currency'
                       ]) !!}
                    </div>


                    <a href="{!! route('my_account_favourites') !!}"
                       class="d-inline-block pointer add-links-wrap_icon add-links-wrap_favorite active">
                        <svg viewBox="0 0 29 22" width="26px" height="22px">
                            <path fill-rule="evenodd" fill="rgb(227, 40, 84)"
                                  d="M23.901,2.043 C22.539,0.732 20.737,0.016 18.813,0.016 C16.890,0.016 15.081,0.738 13.720,2.048 L13.009,2.732 L12.287,2.037 C10.926,0.727 9.112,0.000 7.188,0.000 C5.270,0.000 3.462,0.722 2.106,2.027 C0.745,3.337 -0.005,5.077 0.001,6.928 C0.001,8.780 0.756,10.515 2.117,11.825 L12.469,21.788 C12.612,21.926 12.805,22.000 12.992,22.000 C13.180,22.000 13.373,21.931 13.516,21.793 L23.890,11.846 C25.251,10.536 26.001,8.796 26.001,6.944 C26.006,5.093 25.262,3.353 23.901,2.043 L23.901,2.043 Z"/>
                        </svg>
                    </a>
                    <span id="headerShopCartBtn" class="d-inline-block position-relative pointer add-links-wrap_icon">
                        <span class="d-inline-block position-absolute absolute-center add-cart-number cart-count">{{ cartCount() }}</span>
                    <svg
                            width="25px" height="30px" viewBox="0 0 25 30">
<path fill-rule="evenodd" fill="rgb(121, 121, 121)"
      d="M19.867,4.943 L19.867,-0.003 L5.131,-0.003 L5.131,4.943 L-0.005,4.943 L-0.005,30.000 L25.003,30.000 L25.003,4.943 L19.867,4.943 ZM6.854,1.629 L18.143,1.629 L18.143,4.943 L6.854,4.943 L6.854,1.629 ZM23.279,28.368 L1.719,28.368 L1.719,6.575 L5.131,6.575 L5.131,9.857 L6.854,9.857 L6.854,6.575 L18.143,6.575 L18.143,9.857 L19.867,9.857 L19.867,6.575 L23.279,6.575 L23.279,28.368 Z"/>
</svg>
                </span>
                </div>
            </div>
        </div>
    </div>
</header>





@if(Auth::check())
    <!--Hidden Sidebars-->
    <div id="profileSidebar" class="hidden-sidebar profile-sidebar d-flex flex-column align-items-center">
        <div class="profile-sidebar_avatar-holder">
            <img src="{{ user_avatar() }}"
                 alt="">
        </div>
        @include('frontend.my_account._partials.left_bar')
        {!! Form::open(['url'=>route('logout'),'class' => 'mt-auto']) !!}
        <button class="profile-sidebar_logout-btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase text-white pointer">
            Logout
        </button>
        {!! Form::close() !!}
    </div>
@endif
<div id="cartSidebar" class="hidden-sidebar cart-aside d-flex flex-column">
    @include('frontend._partials.shopping_cart_options')
</div>
@if(!Auth::check())

    <!--modal Login-->
    @include("frontend._partials.login_modal")

    <!--modal Register-->
    @include("frontend._partials.register_modal")

@endif
