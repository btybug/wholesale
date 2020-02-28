@extends('layouts.frontend')
@section('content')
    <main class="main-content">
        <div class="container main-max-width main-content-wrapper">
            <div class="brands-page-wrapper">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="brands-wrapper">
                            <ul class="brands-list">
                                @foreach($brands as $brand)
                                <li class="brand-single @if($slug==$brand->slug) active @endif">
                                    <a href="{!! route('brands',$brand->slug) !!}" class="brand-link font-main-bold">
                                        <img src="{!! ($brand->image)?url($brand->image):'#' !!}" class="brand-logo" alt="logo">
                                        <div class="brand-name">{!! $brand->name !!}</div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        @if($current)
                            @include('frontend.brands._partials.brand',['brand'=>$current])
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!--scroll top button-->
        <button id="scrollTopBtn" class="scroll-top-btn d-flex align-items-center justify-content-center pointer">
            <svg viewBox="0 0 17 10" width="17px" height="10px">
                <path fill-rule="evenodd" fill="rgb(124, 124, 124)"
                      d="M0.000,8.111 L1.984,10.005 L8.498,3.789 L15.010,10.005 L16.995,8.111 L8.498,0.001 L0.000,8.111 Z"></path>
            </svg>
        </button>
    </main>

@stop
