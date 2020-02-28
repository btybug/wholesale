@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
            <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
                <li class="nav-item ">
                    <a class="nav-link " id="general-tab" href="{!! route('admin_orders') !!}" role="tab"
                       aria-controls="general" aria-selected="true" aria-expanded="true">Orders</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" id="invoice-tab" href="{!! route('admin_orders_invoice') !!}" role="tab"
                       aria-controls="shipping" aria-selected="false">Invoices</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="card panel panel-default">
{{--                <div class="card-header panel-heading d-flex flex-wrap justify-content-between">--}}
{{--                   <h2 class="m-0 mr-1">{!! __('Invoices') !!}</h2>--}}
{{--                   --}}
{{--                </div>--}}
                <div class="d-flex justify-content-end px-4 mt-2">
                    <div>
                        @ok('admin_orders_invoice_new')<a class="btn btn-primary pull-right mr-1" href="{!! route('admin_orders_invoice_new') !!}">New Order</a>@endok
                    </div>
                </div>
        <div class="card-body panel-body pt-0">
            <table id="orders-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Country</th>
                    <th>Region</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Shipping method</th>
                    <th>Payment Method</th>
                    <th>Currency</th>
                    <th>Order Number</th>
                    <th>Type</th>
                    <th>Created At</th>
                    <th>Updated At</th>
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
            $('#orders-table').DataTable({
                ajax: "{!! route('datatable_all_orders_invoice') !!}",
                dom: '<"d-flex justify-content-between align-items-baseline"lfB><rtip>',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                "scrollX": true,
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user', name: 'user'},
                    {data: 'amount', name: 'amount'},
                    {data: 'country', name: 'country'},
                    {data: 'region', name: 'region'},
                    {data: 'city', name: 'city'},
                    {data: 'status', name: 'status'},
                    {data: 'shipping_method', name: 'shipping_method'},
                    {data: 'payment_method', name: 'payment_method'},
                    {data: 'currency', name: 'currency'},
                    {data: 'order_number', name: 'order_number'},
                    {data: 'type', name: 'type'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions'}
                ],
                order: [ [0, 'desc'] ]
            });
        });

    </script>
@stop
