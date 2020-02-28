@extends('layouts.frontend',['page_name'=>'cookies'])
@section('content')
    <main class="main-content">
        <section class="support__pages-wrapper faq-page">
            <div class="container main-max-width">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="left-wrapper">
                            @if(LaravelGmail::check())
                                <li class="item-wrap">
                                    <a href="{!! route('support_contact_us') !!}"
                                       class="d-flex align-items-center item-link">
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
                                        <img src="/public/img/paper-icon.png" alt="Terms Conditions" title="Terms Conditions">
                                    </div>
                                    <div class="item-name font-20">{!! __('terms_and_conditions') !!}</div>
                                </a>
                            </li>

                            <li class="item-wrap">
                                <a href="{!! route('faq_page') !!}" class="d-flex align-items-center item-link ">
                                    <div class="item-photo">
                                        <img src="/public/img/faq-icon.png" alt="FAQ" title="FAQ">
                                    </div>
                                    <div class="item-name font-20">{!! __('faq') !!}</div>
                                </a>
                            </li>

                            <li class="item-wrap">
                                <a href="{!! route('about_us') !!}" class="d-flex align-items-center item-link ">
                                    <div class="item-photo">
                                        <img src="/public/img/faq-icon.png" alt="about_us" title="about_us">
                                    </div>
                                    <div class="item-name font-20">{!! __('about_us') !!}</div>
                                </a>
                            </li>

                            <li class="item-wrap">
                                <a href="{!! route('privacy') !!}" class="d-flex align-items-center item-link active">
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
                    <div class="col-md-9">
                        <div class="container">
                            {!! @$model->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop
