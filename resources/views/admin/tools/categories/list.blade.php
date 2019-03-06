@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="col-md-6 pull-left"><h2>Categories</h2></div>
        </div>

        <div class="payment_gateways_tab">
            <ul class="list_paymant">
                <li class="item">
                    <div class="chek-title">

                        <label for="cash_paymant" class="title">Stocks</label>
                    </div>
                   @ok('admin_store_categories')<a href="{!! route('admin_store_categories','stocks') !!}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>@endok
                </li>
                <li class="item">
                    <div class="chek-title">
                        <label for="stripe_paymant"  class="title">Posts</label>
                    </div>
                    @ok('admin_store_categories')<a href="{!! route('admin_store_categories','posts') !!} " class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>@endok
                </li>
                <li class="item">
                    <div class="chek-title">
                        <label for="stripe_paymant"  class="title">Tickets</label>
                    </div>
                    @ok('admin_store_categories')<a href="{!! route('admin_store_categories','tickets') !!} " class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>@endok
                </li>
                <li class="item">
                    <div class="chek-title">
                        <label for="stripe_paymant"  class="title">FAQ</label>
                    </div>
                    @ok('admin_store_categories')<a href="{!! route('admin_store_categories','faq') !!} " class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>@endok
                </li>
                <li class="item">
                    <div class="chek-title">
                        <label for="stripe_paymant"  class="title">Notifications</label>
                    </div>
                    @ok('admin_store_categories')<a href="{!! route('admin_store_categories','notifications') !!} " class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>@endok
                </li>
            </ul>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
