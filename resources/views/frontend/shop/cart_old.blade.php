@extends('layouts.frontend')
@section('content')
    <section class="main-content site-content section-cart-page">
        <div class="container">
            <div class="breadcum-area">
                <div class="breadcum-inner">
                    <h3>Shopping cart</h3>
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="http://demo.laravelcommerce.com">Home</a></li>
                    </ol>
                </div>
            </div>
            <div class="cart-area">
                @include('frontend.shop._partials.cart_table')
            </div>
        </div>
    </section>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/frontend/css/cart.css')}}">
@stop
