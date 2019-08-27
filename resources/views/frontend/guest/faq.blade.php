@extends('layouts.frontend')

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
                                            <img src="/public/img/message-icon.png" alt="contact">
                                        </div>
                                        <div class="item-name font-20">Contact Us</div>
                                    </a>
                                </li>
                            @endif
                            <li class="item-wrap">
                                <a href="{!! route('delivery') !!}" class="d-flex align-items-center item-link">
                                    <div class="item-photo">
                                        <img src="/public/img/delivery-icon.png" alt="Delivery">
                                    </div>
                                    <div class="item-name font-20">Delivery</div>
                                </a>
                            </li>
                            <li class="item-wrap">
                                <a href="{!! route('terms_conditions') !!}"
                                   class="d-flex align-items-center item-link ">
                                    <div class="item-photo">
                                        <img src="/public/img/paper-icon.png" alt="Terms Conditions">
                                    </div>
                                    <div class="item-name font-20">Terms & Conditions</div>
                                </a>
                            </li>

                            <li class="item-wrap">
                                <a href="{!! route('faq_page') !!}" class="d-flex align-items-center item-link active">
                                    <div class="item-photo">
                                        <img src="/public/img/faq-icon.png" alt="FAQ">
                                    </div>
                                    <div class="item-name font-20">FAQ</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">

                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="buttons">
                                        <h4>General Questions
                                            <small class="text-muted">({{$categories->count()}})</small>
                                        </h4>
                                        <p>All you need to know about Intense design studio and how to get Support.</p>
                                        {!! renderCategory($categories) !!}
                                    </div>
                                </div>
                                @if($category)
                                    <div class="col-md-9">
                                        <div class="accord">
                                            <div class="offset-top-66 offset-lg-top-0">
                                                <h3>Other Questions
                                                    <small class="text-muted question-count">({{ $category->faqs->count() }})</small>
                                                </h3>
                                                <p>The answers on most common questions are described bellow.</p>
                                                <div class="mt-5">
                                                    <!-- Bootstrap Accordion-->
                                                    <div class="accordion offset-top-0" role="tablist" aria-multiselectable="true"
                                                         id="accordion-2">
                                                        @include('frontend.guest._partials.faq_questions')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/frontend/css/faq-page.css?v='.rand(111,999))}}">
@stop
@section('js')
    <script>
        $(document).ready(function () {
            $("body").on('click','.select-faq-category',function () {
                $(".select-faq-category").removeClass('active');
                $(this).addClass('active');
                let category_id = $(this).data('uid');
                $.ajax({
                    type: "post",
                    url: "/support/faq-by-category",
                    cache: false,
                    datatype: "json",
                    data: {uid: category_id},
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        if (!data.error) {
                            $("#accordion-2").html(data.html);
                            $(".question-count").html("("+data.count+")");
                        }
                    }
                });
            })
        })
    </script>
@stop
