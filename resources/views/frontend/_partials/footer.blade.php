
<footer class="main-footer font-main-light">
    <div class="footer-top home__page-wrapper">
{{--        <div class="container main-max-width">--}}
        <div class="container home_width">
            <div class="d-flex flex-wrap">
                <div class="footer-menu-subscribe col-lg-8 col-md-7 col-xl-9 p-0">
                    <div class="footer-menu">
                        <div class="row">
                            @foreach(get_footer_links() as $footer_link)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="menus text-sm-left text-center  mt-lg-0 mt-2">
                                    <h5 class="font-main-bold text-uppercase font-17">{!! $footer_link['title'] !!}</h5>
                                   <div class="d-flex justify-content-center justify-content-sm-start">
                                       {{--first column--}}
                                       <ul>
                                           @foreach($footer_link['children'] as $child)
                                               <li>
                                                   <a href="{!! $child['link'] !!}" target="_blank">{!! $child['title'] !!}</a>
                                               </li>
                                           @endforeach
                                       </ul>
                                   </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="footer-info col-md-5 col-lg-4 col-xl-3 text-md-right p-0 mt-md-0 mt-4 text-sm-left text-center">
                    <a href="#" class="d-block footer-logo">
                        <img src="{!! get_site_logo() !!}" alt="{{ get_site_name() }}" title="{{ get_site_name() }}">
                    </a>
                    @php
                        $general_settings = get_general_settings();
                    @endphp
                    @if($general_settings)
                       {!! $general_settings['first_address'].", ".$general_settings['second_address'].", ".$general_settings['city'].", ".$general_settings['country'].", ".$general_settings['post_code'] !!}
                    @endif
{{--                    <div class="footer-desc mb-3">--}}
{{--                        <p class="mb-0">{!! __('footer_desc') !!}</p>--}}
{{--                    </div>--}}
{{--                    <div class="footer-payment">--}}
{{--                        <div>--}}
{{--                            <img src="/public/img/paypal.png" alt="paypal" title="paypal">--}}
{{--                            <img src="/public/img/visa.png" alt="visa" title="visa">--}}
{{--                            <img src="/public/img/maestro.png" alt="maestro" title="maestro">--}}
{{--                            <img src="/public/img/mc.png" alt="mc" title="mc">--}}
{{--                        </div>--}}
{{--                    </div>--}}



{{--                    <div class="copyright">--}}
{{--                        &#9400; Copyright 2019 Kaliony UK--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-end mb-3 align-items-center footer-subscribe-social-wrap">

{{--                {!! Form::open(['url' => route('subscribe_to_newsletter')]) !!}--}}
{{--                <div class="footer-subscribe">--}}

{{--                    <div class="d-flex position-relative align-items-center">--}}
{{--                        <label for="footer-subscribe" class="font-main-bold text-uppercase mb-0 text-nowrap">{!! __('subscribe') !!}--}}
{{--                            </label>--}}
{{--                        {!! Form::email('subscribe_email',null,['class' => 'form-control','placeholder' => __('placeholder_your_email'),'id' => 'footer-subscribe']) !!}--}}
{{--                        <span class="arrow position-absolute">--}}
{{--                                        <svg viewBox="0 0 24 8"--}}
{{--                                             width="24px" height="8px">--}}
{{--        <path fill-rule="evenodd" fill="rgb(81, 132, 229)"--}}
{{--              d="M23.791,3.998 L18.090,0.000 L18.090,2.888 L0.791,2.888 L0.791,5.109 L18.090,5.109 L18.090,7.997 L23.791,3.998 Z"/>--}}
{{--        </svg>--}}
{{--                                    </span>--}}
{{--                    </div>--}}
{{--                    @if ($errors->has('subscribe_email'))--}}
{{--                        <span class="invalid-feedback" style="display: block" role="alert">--}}
{{--                                    <strong>{{ $errors->first('subscribe_email') }}</strong>--}}
{{--                                </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                {!! Form::close() !!}--}}
                <div class="footer-social">
                    @php
                    $icons = get_social_icons();
                    @endphp
                    <ul class="d-inline-flex flex-wrap">
                        @if(count($icons))
                            @foreach($icons as $icon)
                        <li><a href="{{ $icon['url'] }}" class="d-flex align-items-center justify-content-center"><span><i
                                        class="{{ $icon['social'] }}"></i></span></a></li>
                            @endforeach
                        @endif

                    </ul>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-end align-items-center">
                <div class="copyright">
                    &#9400; {!! __('copyright') !!}
                </div>
            </div>
        </div>
    </div>
{{--    <div class="footer-bottom">--}}
{{--        <div class="container main-max-width">--}}
{{--            <div class="d-flex flex-wrap justify-content-end align-items-center">--}}
{{--                <div class="footer_select-lang d-flex align-items-center">--}}
{{--                    <label for="langSelect" class="text-tert-clr mb-0">Language:</label>--}}
{{--                    <select id="langSelect"--}}
{{--                            class="select-2 select-2--no-search main-select main-select-2arrows products-filter-wrap_select not-selected"--}}
{{--                            style="width: 95px;">--}}
{{--                        <option class="selected">English</option>--}}
{{--                        <option>Arm</option>--}}
{{--                        <option>Russian</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <div class="copyright">--}}
{{--                    &#9400; {!! __('copyright') !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
</footer>
<div class="dark-bg_body"></div>
