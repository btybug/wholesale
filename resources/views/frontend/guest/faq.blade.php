@extends('layouts.frontend')

@section('content')
    <main class="main-content">
        <div class="faq-page">

            <section class="section novi-background breadcrumb-classic">
                <div class="container section-34 section-sm-50">
                    <div class="d-flex flex-wrap align-items-xl-center">
                        {{--<div class="col-xl-5 d-none d-xl-block text-xl-left">--}}
                        {{--<h2><span class="big">Faq</span></h2>--}}
                        {{--</div>--}}
                        <ul class="list-inline list-inline-dashed p">
                            <li class="list-inline-item"><a href="#">FAQ </a></li>
                            <li class="list-inline-item"><a href="#">Contact us </a></li>
                            </li>
                        </ul>
                        {{--<div class="col-xl-2 d-none d-md-block text-center"><span><i class="fa fa-question-circle"></i></span></div>--}}
                        {{--<div class="offset-top-0 offset-md-top-10 col-xl-5 offset-xl-top-0 small text-xl-right">--}}
                        {{--<ul class="list-inline list-inline-dashed p">--}}
                        {{--<li class="list-inline-item"><a href="#">Home /</a></li>--}}
                        {{--<li class="list-inline-item"><a href="#">Pages /</a></li>--}}
                        {{--<li class="list-inline-item">Faq--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                    </div>
                </div>

            </section>

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
                </div>
            </div>
        </div>
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