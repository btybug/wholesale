@extends('layouts.frontend')

@section('content')
    <div class="main-content">
        <div class="faq-single-page-wrapper">
            <div class="container main-max-width">
                <div class="row">
                    <div class="col-md-3">
                        @if($left_faq_ads && isset($left_faq_ads['images']))
                            @foreach($left_faq_ads['images'] as $key => $ad)
                                <div class="faq-single-ads mb-2">
                                    <a href="{!! $left_faq_ads['urls'][$key] !!}" target="_blank" class="d-block h-100">
                                        <img src="{!! $ad !!}" alt="{!! $left_faq_ads['tags'][$key] !!}">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="faq-single-content">
                            <h1 class="font-sec-reg font-36 text-main-clr faq-single-main-title">{!! $faq->question !!}</h1>
                            <div class="faq-single-desc">
                                {!! $faq->answer !!}
                            </div>

                        </div>
                        @include("frontend.comments.index",['model' => $faq,'type' => 'faq'])
                    </div>
                    <div class="col-md-3">
                        @if($right_faq_ads && isset($right_faq_ads['images']))
                            @foreach($right_faq_ads['images'] as $key => $ad)
                                <div class="faq-single-ads mb-2">
                                    <a href="{!! $right_faq_ads['urls'][$key] !!}" target="_blank" class="d-block h-100">
                                        <img src="{!! $ad !!}" alt="{!! $right_faq_ads['tags'][$key] !!}">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('public/frontend/css/faq-page.css?v='.rand(111,999))}}">
    <link rel="stylesheet" href="{{asset('public/css/comments.css?v='.rand(111,999))}}">
    <style>

        #gp-inner-container {
            height: calc(100% - 100px);
            overflow: auto;
        }

        .hide-icons {
            cursor: pointer;
        }

        .comments {
            font-family: 'SF-UI-Text-Medium_1';
            font-size: 16px;
        }

        .comments .user-comment-img .user-img img {
            width: 100%;
            max-height: 65px;
            object-fit: cover;
        }

        .comments .user-comment-img .user-comment {
            flex: 1;
            height: 100%;
        }

        .comments .user-comment-img .user-comment .content-reply {
            font-family: 'SF-UI-Text-Light_1';
            margin-top: auto;
            padding-bottom: 10px;
        }

        .comments .user-comment-img .user-comment .content-reply .reply {
            color: #1c8379;
            text-decoration: none;
        }

        .comments .user-comment-img .user-title h6 {
            color: #3a3b3b;

        }

        .comments .user-comment-img .user-title span {
            color: #cbcbcb;
        }

        .comments .user-add-comment {
            font-family: 'SF-UI-Text-Light_1';
        }

        .comments .user-add-comment img {
            width: 100%;
            max-height: 65px;
            object-fit: cover;
        }

        .comments .user-add-comment textarea {
            border: none;
            border-bottom: 1px solid #26a69a;
            resize: none;
            outline: none;
            padding: 0;
            overflow: hidden;
            width: 100%;
            margin-top: 10px;
        }

        .comments .user-add-comment input {
            display: block;
            width: 100%;
            padding: .375rem 0;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            border: none;
            background-clip: padding-box;
            border-bottom: 1px solid #27a59a;
            outline: none;
        }

        .comments .user-add-comment button {
            color: #27a59a;
            border-color: #27a59a;
        }

        .comments .user-add-comment button:hover {
            background-color: #27a59a;
            border-color: #27a59a;
            color: #ffffff;
        }
    </style>
@stop
@section('js')

@stop
