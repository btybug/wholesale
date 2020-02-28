@extends('layouts.frontend')
@section('content')
    <main class="main-content">
        <section class="support__pages-wrapper contact__page-wrapper">
            <div class="container main-max-width">

                <div class="row">
                    <div class="col-lg-3">
                        <ul class="left-wrapper">
                            @if(LaravelGmail::check())
                                <li class="item-wrap">
                                    <a href="{!! route('support_contact_us') !!}"
                                       class="d-flex align-items-center item-link active">
                                        <span class="line"></span>
                                        <div class="item-photo">
                                            <img src="/public/img/message-icon.png" alt="contact" title="Contact Us">
                                        </div>
                                        <div class="item-name font-20">{!! __('contact_us') !!}</div>
                                    </a>
                                </li>
                            @endif
                            <li class="item-wrap">
                                <a href="{!! route('delivery') !!}" class="d-flex align-items-center item-link">
                                    <div class="item-photo">
                                        <img src="/public/img/delivery-icon.png" alt="Delivery" title="Delivery">
                                    </div>
                                    <div class="item-name font-20">{!! __('delivery') !!}</div>
                                </a>
                            </li>
                            <li class="item-wrap">
                                <a href="{!! route('terms_conditions') !!}"
                                   class="d-flex align-items-center item-link ">
                                    <div class="item-photo">
                                        <img src="/public/img/paper-icon.png" alt="Terms Conditions" title="Terms & Conditions">
                                    </div>
                                    <div class="item-name font-20">{!! __('terms_and_conditions') !!}</div>
                                </a>
                            </li>

                            <li class="item-wrap">
                                <a href="{!! route('faq_page') !!}" class="d-flex align-items-center item-link">
                                    <div class="item-photo">
                                        <img src="/public/img/faq-icon.png" alt="FAQ" title="FAQ">
                                    </div>
                                    <div class="item-name font-20">{!! __('faq') !!}</div>
                                </a>
                            </li>

                                <li class="item-wrap">
                                    <a href="{!! route('about_us') !!}" class="d-flex align-items-center item-link">
                                        <div class="item-photo">
                                            <img src="/public/img/faq-icon.png" alt="about_us" title="about_us">
                                        </div>
                                        <div class="item-name font-20">{!! __('About us') !!}</div>
                                    </a>
                                </li>

                                <li class="item-wrap">
                                    <a href="{!! route('privacy') !!}" class="d-flex align-items-center item-link">
                                        <div class="item-photo">
                                            <img src="/public/img/faq-icon.png" alt="privacy" title="privacy">
                                        </div>
                                        <div class="item-name font-20">{!! __('privacy') !!}</div>
                                    </a>
                                </li>
                                <li class="item-wrap">
                                    <a href="{!! route('cookies') !!}" class="d-flex align-items-center item-link ">
                                        <div class="item-photo">
                                            <img src="/public/img/faq-icon.png" alt="cookies" title="cookies">
                                        </div>
                                        <div class="item-name font-20">{!! __('cookies') !!}</div>
                                    </a>
                                </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-8">
                        {!! Form::open() !!}
                        <div class="contact-main-content">
                            <h1 class="font-sec-reg font-22 lh-1 text-tert-clr main-title">{!! __('send_us_message') !!}</h1>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <div class="row mb-3 mb-lg-0">
                                        <label for="contactname"
                                               class="col-xl-2 col-sm-3 col-form-label font-sec-light">{!! __('name') !!}</label>
                                        <div class="col-xl-10 col-sm-9">
                                            <input name="name" type="text" class="form-control border-light" id="contactname"
                                                   value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="contactphone"
                                               class="col-xl-2 col-sm-3 col-form-label font-sec-light">{!! __('phone') !!}</label>
                                        <div class="col-xl-10 col-sm-9">
                                            <input  name="phone" type="tel" class="form-control border-light" id="contactphone"
                                                   value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row email-group">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="contactemail"
                                               class="col-xl-2 col-sm-3 pr-sm-0 pr-3 col-form-label font-sec-light">{!! __('e_mail') !!}</label>
                                        <div class="col-xl-10 col-sm-9">
                                            <input name="email" type="email" class="form-control border-light" id="contactemail"
                                                   value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row subject-group">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label for="contactsubject" class="col-xl-1 col-lg-2 col-sm-3 pr-sm-0 pr-3 col-form-label font-sec-light">{!! __('subject') !!}</label>
                                        <div class="col-xl-11 col-lg-10 pl-lg-0 pl-lg-0 pl-xl-3 col-sm-9">
                                            <input name="subject" type="text" class="form-control" id="contactsubject"
                                                   value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row area-group">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label for="contactarea"
                                               class="col-xl-1 col-lg-2 col-sm-3 pr-sm-0 pr-3 col-form-label font-sec-light">{!! __('message') !!}</label>
                                        <div class="col-xl-11 col-lg-10 pl-lg-0 pl-lg-0 pl-xl-3 col-sm-9">
                                            <textarea name="message" id="contactarea" cols="30" rows="10"
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="attach">

<span class="icon">
    <input type="file" name="" id="attach-file" multiple="true" class="inputfile">
    <label for="attach-file">
    <svg
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        width="16px" height="38px">
<path fill-rule="evenodd" opacity="0.769" fill="rgb(53, 53, 53)"
      d="M15.353,25.164 C14.995,25.164 14.705,24.809 14.705,24.372 L14.705,9.783 C14.705,5.261 11.697,1.583 8.000,1.583 C4.303,1.583 1.295,5.261 1.295,9.783 L1.295,15.944 C1.295,15.944 1.295,15.944 1.295,15.945 L1.295,30.988 C1.295,33.981 3.286,36.417 5.734,36.417 C8.182,36.417 10.173,33.981 10.173,30.988 L10.173,22.658 L10.173,15.945 L10.173,10.857 C10.173,9.423 9.219,8.256 8.046,8.256 C6.873,8.256 5.919,9.423 5.919,10.857 L5.919,22.658 C5.919,23.095 5.629,23.449 5.272,23.449 C4.914,23.449 4.624,23.095 4.624,22.658 L4.624,10.857 C4.624,8.550 6.159,6.673 8.046,6.673 C9.933,6.673 11.468,8.550 11.468,10.857 L11.468,15.943 C11.468,15.944 11.468,15.944 11.468,15.945 L11.468,30.988 C11.468,34.854 8.896,38.000 5.734,38.000 C2.572,38.000 0.000,34.854 0.000,30.988 L0.000,24.373 C0.000,24.372 -0.000,24.372 -0.000,24.372 L-0.000,9.783 C-0.000,4.388 3.589,0.000 8.000,0.000 C12.411,0.000 16.000,4.388 16.000,9.783 L16.000,24.372 C16.000,24.809 15.710,25.164 15.353,25.164 Z"/>
</svg>
    </label>
</span>
                                            <span class="font-sec-light font-20">{!! __('attachment') !!}</span>
                                        </div>
                                        <button
                                            class="font-sec-light font-20 d-flex justify-content-center align-items-center bg-blue-clr text-sec-clr submit-btn">
                                            {!! __('submit') !!}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="right-wrapper">
                            <div class="info-wall">
                                <div class="map-block">
                                    <iframe
                                        src="https://www.google.com/maps/embed?bp=Armenia"
{{--{{ $settings->first_address. '+'.$settings->second_address. '+'.$settings->city. '+'.$settings->post_code. '+'.$settings->country }}"--}}
                                        width="100%" height="100%" frameborder="0" style="border:0"
                                        allowfullscreen></iframe>
                                </div>
                                <div class="main-info">
                                    @if($settings)
                                    <div class="item-wrap">
                                        <div class="left">
                                            <span class="icon">
<svg
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    width="23px" height="33px">
<path fill-rule="evenodd" fill="rgb(81, 132, 229)"
      d="M20.590,19.647 L11.500,33.000 L2.396,19.628 C-1.000,15.024 -0.506,7.424 3.465,3.385 C5.611,1.202 8.464,-0.000 11.500,-0.000 C14.535,-0.000 17.389,1.202 19.535,3.385 C23.506,7.424 24.000,15.024 20.590,19.647 ZM18.697,4.237 C16.774,2.282 14.219,1.205 11.500,1.205 C8.781,1.205 6.226,2.282 4.304,4.237 C0.719,7.883 0.278,14.746 3.358,18.924 L11.500,30.882 L19.629,18.942 C22.723,14.746 22.282,7.883 18.697,4.237 ZM11.605,15.669 C9.318,15.669 7.457,13.776 7.457,11.451 C7.457,9.125 9.318,7.232 11.605,7.232 C13.891,7.232 15.753,9.125 15.753,11.451 C15.753,13.776 13.891,15.669 11.605,15.669 ZM11.605,8.437 C9.971,8.437 8.642,9.789 8.642,11.451 C8.642,13.112 9.971,14.464 11.605,14.464 C13.238,14.464 14.568,13.112 14.568,11.451 C14.568,9.789 13.238,8.437 11.605,8.437 Z"/>
</svg>
</span>
                                        </div>
                                        <div class="right">
                                            <p class="font-main-light">{{ $settings->first_address. ' '.$settings->second_address }}</p>
                                            <p class="font-main-light">{{ $settings->city .',' }} {{ $settings->post_code }}</p>
                                            <p class="font-main-light">{{ $settings->country }}</p>
                                        </div>
                                    </div>
                                    <div class="item-wrap align-items-center tel">
                                        <div class="left">
                                            <span class="icon">
<svg
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    width="23px" height="23px">
<path fill-rule="evenodd" fill="rgb(81, 132, 229)"
      d="M22.951,17.821 C22.885,17.625 22.472,17.336 21.709,16.955 C21.502,16.835 21.208,16.672 20.827,16.465 C20.446,16.258 20.100,16.067 19.790,15.893 C19.479,15.719 19.188,15.550 18.916,15.387 C18.873,15.354 18.736,15.259 18.508,15.101 C18.279,14.943 18.086,14.826 17.928,14.750 C17.770,14.674 17.615,14.636 17.462,14.636 C17.244,14.636 16.972,14.791 16.646,15.101 C16.319,15.411 16.019,15.749 15.747,16.114 C15.475,16.479 15.187,16.816 14.882,17.127 C14.577,17.437 14.326,17.592 14.130,17.592 C14.032,17.592 13.910,17.565 13.763,17.511 C13.616,17.456 13.504,17.410 13.428,17.372 C13.352,17.334 13.221,17.258 13.036,17.143 C12.850,17.029 12.747,16.966 12.725,16.955 C11.233,16.127 9.954,15.180 8.887,14.113 C7.819,13.046 6.872,11.766 6.044,10.274 C6.033,10.252 5.971,10.149 5.856,9.964 C5.742,9.778 5.666,9.648 5.627,9.572 C5.589,9.495 5.543,9.384 5.489,9.237 C5.434,9.090 5.407,8.967 5.407,8.869 C5.407,8.673 5.562,8.423 5.873,8.118 C6.183,7.813 6.521,7.524 6.885,7.252 C7.250,6.980 7.588,6.681 7.898,6.354 C8.209,6.027 8.364,5.755 8.364,5.537 C8.364,5.385 8.326,5.230 8.250,5.072 C8.173,4.914 8.056,4.721 7.898,4.492 C7.740,4.263 7.645,4.127 7.612,4.083 C7.449,3.811 7.280,3.520 7.106,3.210 C6.932,2.899 6.741,2.553 6.534,2.172 C6.327,1.791 6.164,1.497 6.044,1.290 C5.663,0.528 5.375,0.114 5.178,0.049 C5.102,0.016 4.988,-0.000 4.835,-0.000 C4.541,-0.000 4.157,0.054 3.684,0.163 C3.210,0.272 2.837,0.386 2.565,0.506 C2.020,0.735 1.443,1.399 0.833,2.499 C0.278,3.522 0.000,4.535 0.000,5.537 C0.000,5.831 0.019,6.117 0.057,6.395 C0.095,6.672 0.163,6.986 0.262,7.334 C0.360,7.683 0.438,7.941 0.498,8.110 C0.558,8.279 0.670,8.581 0.833,9.016 C0.996,9.452 1.094,9.719 1.127,9.817 C1.508,10.884 1.960,11.837 2.483,12.676 C3.343,14.069 4.516,15.510 6.003,16.996 C7.489,18.483 8.930,19.656 10.324,20.517 C11.162,21.039 12.115,21.491 13.182,21.872 C13.280,21.905 13.547,22.003 13.983,22.166 C14.418,22.330 14.721,22.441 14.889,22.501 C15.058,22.561 15.317,22.640 15.665,22.738 C16.014,22.836 16.327,22.904 16.605,22.943 C16.882,22.980 17.168,23.000 17.462,23.000 C18.464,23.000 19.477,22.722 20.501,22.167 C21.600,21.557 22.265,20.980 22.493,20.435 C22.613,20.163 22.727,19.790 22.836,19.316 C22.945,18.843 23.000,18.459 23.000,18.165 C23.000,18.012 22.984,17.898 22.951,17.821 Z"/>
</svg>
</span>
                                        </div>
                                        <div class="right">
                                            <p class="font-main-light mb-0">{{ $settings->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="item-wrap align-items-center">
                                        <div class="left">
                                            <span class="icon">
<svg
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    width="22px" height="18px">
<path fill-rule="evenodd" fill="rgb(81, 132, 229)"
      d="M20.900,18.000 L1.100,18.000 C0.492,18.000 0.000,17.474 0.000,16.826 L0.000,1.174 C0.000,0.526 0.492,0.000 1.100,0.000 L20.900,0.000 C21.507,0.000 22.000,0.526 22.000,1.174 L22.000,16.826 C22.000,17.474 21.507,18.000 20.900,18.000 ZM21.267,1.174 C21.267,0.958 21.102,0.783 20.900,0.783 L1.100,0.783 C0.897,0.783 0.733,0.958 0.733,1.174 L0.733,16.826 C0.733,17.042 0.897,17.217 1.100,17.217 L20.900,17.217 C21.102,17.217 21.267,17.042 21.267,16.826 L21.267,1.174 ZM11.943,9.839 C11.398,10.329 10.602,10.329 10.057,9.839 L1.598,2.256 C1.497,2.166 1.449,2.026 1.472,1.889 C1.495,1.751 1.585,1.637 1.708,1.589 C1.831,1.541 1.969,1.567 2.069,1.657 L10.528,9.240 C10.801,9.485 11.199,9.485 11.472,9.240 L19.931,1.657 C20.005,1.590 20.102,1.558 20.199,1.567 C20.295,1.576 20.385,1.625 20.448,1.705 C20.510,1.784 20.540,1.887 20.532,1.991 C20.524,2.094 20.477,2.190 20.402,2.256 L11.943,9.839 ZM6.699,9.907 C6.787,9.801 6.922,9.755 7.052,9.786 C7.182,9.816 7.286,9.920 7.324,10.056 C7.362,10.192 7.328,10.339 7.235,10.441 L2.101,16.310 C2.013,16.416 1.878,16.463 1.748,16.432 C1.618,16.401 1.514,16.298 1.476,16.161 C1.438,16.025 1.472,15.878 1.565,15.777 L6.699,9.907 ZM14.948,9.786 C15.078,9.755 15.213,9.801 15.301,9.907 L20.435,15.777 C20.567,15.935 20.557,16.178 20.411,16.323 C20.265,16.468 20.038,16.462 19.899,16.310 L14.765,10.441 C14.672,10.339 14.638,10.192 14.676,10.056 C14.714,9.920 14.818,9.816 14.948,9.786 Z"/>
</svg>
</span>
                                        </div>
                                        <div class="right">
                                            <p class="font-main-light mb-0">{{ $settings->email }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="social-wall">
                                <div class="head">
                                    <span class="font-sec-light font-20 lh-1 text-tert-clr">{!! __('chat_with_us') !!}</span>
                                </div>
                                <div class="d-flex flex-wrap justify-content-between social-body">
                                    <a href="#" class="mr-1 d-flex align-items-center">
                                        <span class="icon">
                                            <img src="/public/img/whatsapp-icon.png" alt="whatsapp">
                                        </span>
                                        <span class="name font-sec-light font-20 lh-1 text-main-clr">WhatsApp</span>
                                    </a>
                                    <a href="#" class="d-flex align-items-center">
                                        <span class="icon">
                                            <img src="/public/img/facebook-icon.png" alt="Messenger">
                                        </span>
                                        <span class="name font-sec-light font-20 lh-1 text-main-clr">Messenger</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{--        <div class="d-flex flex-wrap">--}}
                {{--            <div class="col-sm-8 col-lg-9 pl-xl-0">--}}
                {{--                <div class="row">--}}
                {{--                    <div class="col-sm-6">--}}
                {{--                        <div class="form-group">--}}
                {{--                            <label class="form-label input-label" for="contact-me-name">Name</label>--}}
                {{--                            {!! Form::text('name',old('name'),['class' => $errors->has('name') ? 'form-control form-custom--control is-invalid' : 'form-control form-custom--control','placeholder' => 'Name']) !!}--}}
                {{--                            @if ($errors->has('name'))--}}
                {{--                                <span class="invalid-feedback">--}}
                {{--                                            <strong>{{ $errors->first('name') }}</strong>--}}
                {{--                                        </span>--}}
                {{--                            @endif--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-sm-6">--}}
                {{--                        <div class="form-group">--}}
                {{--                            <label class="form-label input-label" for="contact-me-phone">Phone</label>--}}
                {{--                            {!! Form::text('phone',old('phone'),['class' => $errors->has('phone') ? 'form-control form-custom--control is-invalid' : 'form-control form-custom--control','placeholder' => 'Phone']) !!}--}}
                {{--                            @if ($errors->has('phone'))--}}
                {{--                                <span class="invalid-feedback">--}}
                {{--                                            <strong>{{ $errors->first('phone') }}</strong>--}}
                {{--                                        </span>--}}
                {{--                            @endif--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-6">--}}
                {{--                        <div class="form-group">--}}
                {{--                            <label class="form-label input-label" for="contact-me-email">E-Mail</label>--}}
                {{--                            {!! Form::email('email',old('email'),['class' => $errors->has('email') ? 'form-control form-custom--control is-invalid' : 'form-control form-custom--control','placeholder' => 'Email Address']) !!}--}}
                {{--                            @if ($errors->has('email'))--}}
                {{--                                <span class="invalid-feedback">--}}
                {{--                                            <strong>{{ $errors->first('email') }}</strong>--}}
                {{--                                        </span>--}}
                {{--                            @endif--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-6">--}}
                {{--                        <div class="form-group">--}}
                {{--                            <label class="form-label input-label" for="contact-me-email">Category</label>--}}
                {{--                            {!! Form::select('category',[--}}
                {{--                            'about_team' => 'Team'--}}
                {{--                            ],old('category'),['class' => $errors->has('category') ? 'form-control form-custom--control is-invalid' : 'form-control form-custom--control','placeholder' => 'Select Category']) !!}--}}
                {{--                            @if ($errors->has('category'))--}}
                {{--                                <span class="invalid-feedback">--}}
                {{--                                            <strong>{{ $errors->first('category') }}</strong>--}}
                {{--                                        </span>--}}
                {{--                            @endif--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-12">--}}
                {{--                        <div class="form-group">--}}
                {{--                            <label class="form-label input-label" for="contact-me-message">Message</label>--}}
                {{--                            {!! Form::textarea('message',old('message'),['class'=> $errors->has('message') ? 'form-control form-custom--control is-invalid' : 'form-control form-custom--control','placeholder' => 'Message','style' => 'height: 150px']) !!}--}}
                {{--                            @if ($errors->has('message'))--}}
                {{--                                <span class="invalid-feedback">--}}
                {{--                                            <strong>{{ $errors->first('message') }}</strong>--}}
                {{--                                        </span>--}}
                {{--                            @endif--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="row justify-content-sm-center justify-content-xl-start text-center text-xl-left">--}}
                {{--                    <div class="col-sm-8 col-md-6">--}}
                {{--                        <button class="btn btn-block btn-send text-uppercase" type="submit">send message</button>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--            </div>--}}
                {{--            <div class="col-sm-4 col-lg-3 pr-xl-0 pt-sm-0 pt-2">--}}
                {{--                <div class="text-center text-xl-left">--}}
                {{--                    <address class="contact-info d-md-inline-block text-left">--}}
                {{--                        <div class="d-flex flex-row unit">--}}
                {{--                            <div class="unit-left mr-2"><span class="icon fa fa-map-marker"></span></div>--}}
                {{--                            <div class="unit-body"><a href="#" class="text-main-clr">8901 Marmora Road, Glasgow, D04--}}
                {{--                                    89GR</a></div>--}}
                {{--                        </div>--}}
                {{--                        <div class="d-flex flex-row unit">--}}
                {{--                            <div class="unit-left mr-2"><span class="icon fa fa-phone"></span></div>--}}
                {{--                            <div class="unit-body"><a href="tel:#" class="text-main-clr">1-800-1234-567</a></div>--}}
                {{--                        </div>--}}
                {{--                        <div class="d-flex flex-row unit">--}}
                {{--                            <div class="unit-left mr-2"><span class="icon fa fa-envelope"></span></div>--}}
                {{--                            <div class="unit-body"><a href="mailto:#" class="text-main-clr">info@ourteam.org</a></div>--}}
                {{--                        </div>--}}
                {{--                    </address>--}}
                {{--                </div>--}}
                {{--                <div class="text-center text-xl-left">--}}
                {{--                    <ul class="d-flex flex-wrap social-icons justify-content-lg-end justify-content-center">--}}
                {{--                        <li><a href="#"--}}
                {{--                               class="d-flex align-items-center justify-content-center rounded-circle text-main-clr"><i--}}
                {{--                                        class="fab fa-linkedin-in"></i></a></li>--}}
                {{--                        <li><a href="#"--}}
                {{--                               class="d-flex align-items-center justify-content-center rounded-circle text-main-clr"><i--}}
                {{--                                        class="fab fa-twitter"></i></a></li>--}}
                {{--                        <li><a href="#"--}}
                {{--                               class="d-flex align-items-center justify-content-center rounded-circle text-main-clr"><i--}}
                {{--                                        class="fab fa-facebook-f"></i></a></li>--}}
                {{--                    </ul>--}}
                {{--                </div>--}}
                {{--            </div>--}}
                {{--        </div>--}}

            </div>
        </section>
    </main>
@stop
