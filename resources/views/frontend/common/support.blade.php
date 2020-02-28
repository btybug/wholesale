@extends('layouts.frontend')
@section('content')
    <main class="main-content">
        <section class="support__page-wrapper">
            <div class="container main-max-width">
                <div class="logo-wrap">
                    <img src="{!! get_site_logo() !!}" alt="{{ get_site_name() }}" title="{{ get_site_name() }}">
                </div>
                <div class="support-lists-wrap">
                    <ul class="support-lists row">
                        @if(LaravelGmail::check())
                            <li class="col-md-4 col-sm-6">
                                <a href="{!! route('support_contact_us') !!}" class="d-flex align-items-center item-link">
                                    <div class="item-photo">
                                        <img src="/public/img/message-icon.png" alt="contact" title="contact">
                                    </div>
                                    <div class="item-name font-20">{!! __('contact_us') !!}</div>
                                </a>
                            </li>
                        @endif
                        <li class="col-md-4 col-sm-6">
                            <a href="{!! route('terms_conditions') !!}" class="d-flex align-items-center item-link">
                                <div class="item-photo">
                                    <img src="/public/img/paper-icon.png" alt="Terms Conditions" title="Terms & Conditions">
                                </div>
                                <div class="item-name font-20">{!! __('terms_and_conditions') !!}</div>
                            </a>
                        </li>
                        <li class="col-md-4 col-sm-6">
                            <a href="{!! route('delivery') !!}" class="d-flex align-items-center item-link">
                                <div class="item-photo">
                                    <img src="/public/img/delivery-icon.png" alt="Delivery" title="Delivery">
                                </div>
                                <div class="item-name font-20">{!! __('delivery') !!}</div>
                            </a>
                        </li>
                        <li class="col-md-4 col-sm-6">
                            <a href="{!! route('faq_page') !!}" class="d-flex align-items-center item-link">
                                <div class="item-photo">
                                    <img src="/public/img/faq-icon.png" alt="FAQ" title="FAQ">
                                </div>
                                <div class="item-name font-20">{!! __('faq') !!}</div>
                            </a>
                        </li>

                        <li class="col-md-4 col-sm-6">
                            <a href="{!! route('about_us') !!}" class="d-flex align-items-center item-link">
                                <div class="item-photo">
                                    <img src="/public/img/faq-icon.png" alt="FAQ" title="FAQ">
                                </div>
                                <div class="item-name font-20">{!! __('About us') !!}</div>
                            </a>
                        </li>

                        <li class="col-md-4 col-sm-6">
                            <a href="{!! route('privacy') !!}" class="d-flex align-items-center item-link">
                                <div class="item-photo">
                                    <img src="/public/img/faq-icon.png" alt="privacy" title="privacy">
                                </div>
                                <div class="item-name font-20">{!! __('privacy') !!}</div>
                            </a>
                        </li>
                        <li class="col-md-4 col-sm-6">
                            <a href="{!! route('cookies') !!}" class="d-flex align-items-center item-link">
                                <div class="item-photo">
                                    <img src="/public/img/faq-icon.png" alt="cookies" title="cookies">
                                </div>
                                <div class="item-name font-20">{!! __('cookies') !!}</div>
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
        </section>
    </main>
@stop
