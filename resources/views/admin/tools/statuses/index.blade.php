@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="col-md-6 pull-left"><h2>Statuses</h2></div>
        </div>

        <div class="payment_gateways_tab">
            <ul class="list_paymant">
                <li class="item">
                    <div class="chek-title">

                        <label for="cash_paymant" class="title">Order</label>
                    </div>
                    @ok('admin_stock_statuses_manage')<a href="{!! route('admin_stock_statuses_manage','order') !!}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                </li>
                <li class="item">
                    <div class="chek-title">
                        <label for="stripe_paymant"  class="title">User</label>
                    </div>
                    @ok('admin_stock_statuses_manage')<a href="{!! route('admin_stock_statuses_manage','user') !!} " class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>@endok
                </li>
                <li class="item">
                    <div class="chek-title">
                        <label for="paypal" class="title">Posts</label>
                    </div>
                    @ok('admin_stock_statuses_manage')<a href="{!! route('admin_stock_statuses_manage','post') !!}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>@endok
                </li>
                <li class="item">
                    <div class="chek-title">
                        <label for="paypal" class="title">Stock</label>
                    </div>
                    @ok('admin_stock_statuses_manage')<a href="{!! route('admin_stock_statuses_manage','stock') !!}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>@endok
                </li>

                <li class="item">
                    <div class="chek-title">
                        <label for="paypal" class="title">Tickets</label>
                    </div>
                    @ok('admin_stock_statuses_manage')<a href="{!! route('admin_stock_statuses_manage','tickets') !!}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>@endok
                </li>
                <li class="item">
                    <div class="chek-title">
                        <label for="paypal" class="title">Ticket Priority</label>
                    </div>
                    @ok('admin_stock_statuses_manage')<a href="{!! route('admin_stock_statuses_manage','ticket_priority') !!}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>@endok
                </li>

            </ul>
        </div>

        {{--<div class="col-xs-12">--}}
            {{--<table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th>#</th>--}}
                    {{--<th>Name</th>--}}
                    {{--<th>type</th>--}}
                    {{--<th>Description</th>--}}
                    {{--<th>icon</th>--}}
                    {{--<th>Color</th>--}}
                    {{--<th>Actions</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
            {{--</table>--}}
        {{--</div>--}}
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
{{--@section('js')--}}
    {{--<script>--}}
        {{--$(function () {--}}
            {{--$('#stocks-table').DataTable({--}}
                {{--ajax: "{!! route('datatable_all_statuses') !!}",--}}
                {{--columns: [--}}
                    {{--{data: 'id', name: 'id'},--}}
                    {{--{data: 'name', name: 'name'},--}}
                    {{--{data: 'type', name: 'type'},--}}
                    {{--{data: 'description', name: 'description'},--}}
                    {{--{data: 'icon', name: 'icon'},--}}
                    {{--{data: 'color', name: 'color'},--}}
                    {{--{data: 'actions', name: 'actions'}--}}
                {{--]--}}
            {{--});--}}
        {{--});--}}

    {{--</script>--}}
{{--@stop--}}