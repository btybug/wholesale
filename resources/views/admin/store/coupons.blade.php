@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One"
               aria-selected="true">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two"
               aria-selected="false">Archive</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade p-3 active in" id="one" role="tabpanel" aria-labelledby="one-tab">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h2 class="pull-left m-0">Active Coupons</h2>
                    @ok('admin_store_coupons_new')
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{!! route('admin_store_coupons_new') !!}">Add new</a>
                    </div>
                    @endok
                </div>
                <div class="panel-body">
                    <table id="categories-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>type</th>
                            <th>Discount</th>
                            <th>Minimal order amount</th>
                            <th>Coupon Based</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h2 class="pull-left m-0">Inactive Coupons</h2>
                </div>
                <div class="panel-body">
                    <table id="archive-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>type</th>
                            <th>Discount</th>
                            <th>Minimal order amount</th>
                            <th>Coupon Based</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
    <script>
        $(function () {
            $('#categories-table').DataTable({
                ajax: "{!! route('datatable_all_coupons','active') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'Code'},
                    {data: 'type', name: 'type'},
                    {data: 'discount', name: 'discount'},
                    {data: 'total_amount', name: 'total_amount'},
                    {data: 'based', name: 'shipping_type'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'status', name: 'status'},
                    {data: 'created_by', name: 'created_by'},
                    {data: 'actions', name: 'actions'}
                ]
            });

            $('#archive-table').DataTable({
                ajax: "{!! route('datatable_all_coupons','archive') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'Code'},
                    {data: 'type', name: 'type'},
                    {data: 'discount', name: 'discount'},
                    {data: 'total_amount', name: 'total_amount'},
                    {data: 'based', name: 'shipping_type'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'status', name: 'status'},
                    {data: 'created_by', name: 'created_by'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop