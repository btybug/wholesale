@extends('layouts.frontend')
@section('content')
    <main class="main-content">
        <section class="support__pages-wrapper ">
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
                                            <img src="/public/img/message-icon.png" alt="contact" title="contact">
                                        </div>
                                        <div class="item-name font-20">{!! __('contact_us') !!}</div>
                                    </a>
                                </li>
                            @endif
                            <li class="item-wrap">
                                <a href="{!! route('delivery') !!}" class="d-flex align-items-center item-link active">
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
                    <div class="col-md-9">
                        <div class="bg-white p-5 shadow-sm">
                            <div class="row justify-content-center mb-5">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">{!! __('select_country') !!}</label>
                                        {!! Form::select('country',$countries,null,['class'=>'form-control','id'=>'country']) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">{!! __('select_city') !!}</label>
                                        <div class="city-choser">
                                            <select id="city" disabled readonly="true" class="form-control">
                                                <option selected>{!! __('choose') !!}...</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 shipping-methods">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@stop

@section("js")
    <script>
        postSendAjax = function (url, data, success, error) {
            $.ajax({
                type: "post",
                url: url,
                cache: false,
                datatype: "json",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function (data) {
                    if (success) {
                        success(data);
                    }
                    return data;
                },
                error: function (errorThrown) {
                    if (error) {
                        error(errorThrown);
                    }
                    return errorThrown;
                }
            });
        };

        $("body").on("change", "#country", function () {
            let value = $(this).val()
            postSendAjax("{!! route('delivery_get_countries') !!}", {value}, function (res) {
                if (!res.error) {
                    $(".city-choser").empty().append(res.html)
                    $(".shipping-methods").empty().append(res.sHtml)
                }
            })
        })

    </script>

@stop
