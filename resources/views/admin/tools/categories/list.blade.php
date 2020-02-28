@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

    <div class="payment_gateways_tab w-100">
        <h2>Categories</h2>
        <ul class="list_paymant">
            @foreach($categories as $category)
                <li class="item">
                    <div class="chek-title">
                        <label for="stripe_paymant" class="title font-weight-bold">{!! strtoupper($category->type) !!}</label>
                    </div>
                    <a href="#" class="btn btn-sm btn-warning text-white"><i class="fa fa-edit"></i></a>
                </li>
            @endforeach
        </ul>
    </div>

@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
