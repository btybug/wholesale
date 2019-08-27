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
                        <a href="{!! url('/') !!}" class="logo-small-screens d-md-none d-flex align-items-center ml-3">
                            <img src="{!! url('/public/img/logo-icon.png') !!}"  alt="" class="logo-small-screens_logo">
                            <h1 class="font-14 font-sec-bold text-sec-clr text-uppercase ml-2 mb-0">The Vapors Hub</h1>
                        </a>
                    </div>

                    @if(Auth::check())
                        <div id="ptofileBtn"
                             class="form-inline my-2 my-lg-0 align-self-lg-auto align-self-baseline pointer sidebar_button_active_detector">
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
                        <ul class="navbar-nav mr-auto mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link" href="{!! url('/') !!}">Home</a>
                            </li>

                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="{!! route('product_offers') !!}">Offers</a>--}}
                            {{--</li>--}}

                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('blog') !!}">News</a>
                            </li>


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
                    <img src="{!! get_site_logo() !!}" alt="{{ get_site_name() }}">
                </a>

                    <div class="d-flex align-self-center cat-search">
                        @if(Request::route()->getPrefix() != '/wholesaler')

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
                        @endif
                    </div>
                    <div class="favorite-add-cart d-flex align-items-center">

                        <div class="d-inline-block simple_select_wrapper currency--wrap">
                            {!! Form::select('currency',site_currencies(),@$currency,[
                               'class' =>'select-2 currency--select-2 main-select',
                               'id' => 'change-currency'
                           ]) !!}
                            {!! Form::hidden('currency_symbol',get_symbol(),['id' => 'symbol']) !!}
                        </div>

                            <span id="headerShopCartBtn" class="ml-5 d-inline-block position-relative pointer add-links-wrap_icon sidebar_button_active_detector">
                                <span class="d-inline-block position-absolute absolute-center add-cart-number cart-count">{{ cartCountItems() }}</span>
                                    <svg width="25px" height="30px" viewBox="0 0 25 30">
                                <path fill-rule="evenodd" fill="rgb(121, 121, 121)"
                                      d="M19.867,4.943 L19.867,-0.003 L5.131,-0.003 L5.131,4.943 L-0.005,4.943 L-0.005,30.000 L25.003,30.000 L25.003,4.943 L19.867,4.943 ZM6.854,1.629 L18.143,1.629 L18.143,4.943 L6.854,4.943 L6.854,1.629 ZM23.279,28.368 L1.719,28.368 L1.719,6.575 L5.131,6.575 L5.131,9.857 L6.854,9.857 L6.854,6.575 L18.143,6.575 L18.143,9.857 L19.867,9.857 L19.867,6.575 L23.279,6.575 L23.279,28.368 Z"/>
                                </svg>
                            </span>
                    <div class="button share-button facebook-share-button st-custom-button share-header-icon-container sidebar_button_active_detector" style="margin-left: 15px">
                        <svg fill="#528eff" preserveAspectRatio="xMidYMid meet" height="2em" width="2em" viewBox="0 0 40 40" class="hvr-pulse share-header-icon" style="vertical-align: middle;"><g><path d="m30 26.8c2.7 0 4.8 2.2 4.8 4.8s-2.1 5-4.8 5-4.8-2.3-4.8-5c0-0.3 0-0.7 0-1.1l-11.8-6.8c-0.9 0.8-2.1 1.3-3.4 1.3-2.7 0-5-2.3-5-5s2.3-5 5-5c1.3 0 2.5 0.5 3.4 1.3l11.8-6.8c-0.1-0.4-0.2-0.8-0.2-1.1 0-2.8 2.3-5 5-5s5 2.2 5 5-2.3 5-5 5c-1.3 0-2.5-0.6-3.4-1.4l-11.8 6.8c0.1 0.4 0.2 0.8 0.2 1.2s-0.1 0.8-0.2 1.2l11.9 6.8c0.9-0.7 2.1-1.2 3.3-1.2z"></path></g></svg>
                    </div>
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
<div id="cartSidebar" class="hidden-sidebar cart-aside d-flex flex-column p-0">
    @if(Request::route()->getPrefix() != '/wholesaler')
        @include('frontend._partials.shopping_cart_options')
    @else
        @include('frontend.wholesaler._partials.shopping_cart_options')
    @endif
</div>
<div id="share_modal" class="hidden-sidebar cart-aside d-flex flex-column p-0">
    <button class="share_modal_close">X</button>
    <div class="sharethis-inline-share-buttons main-scrollbar"></div>
</div>
@if(!Auth::check())

    <!--modal Login-->
    @include("frontend._partials.login_modal")

    <!--modal Register-->
    @include("frontend._partials.register_modal")

@endif

<script>

    $(document).ready(function() {
        var x = window.matchMedia("(max-width: 768px)");
        function resize_win(x) {
            if(x.matches) {
                $('body').on('click', '.pr-nav-l, .br-nav-l', function(ev) {
                    ev.preventDefault();
                });
            } else {
                $('body').on('click', '.pr-nav-l, .br-nav-l', function(ev) {
                    return true;
                });
            }
        }
        resize_win(x);
        $(window).on('resize', function() {
            resize_win(x);
        })
    });
</script>
