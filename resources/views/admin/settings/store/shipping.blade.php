@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
        <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
            <li class="nav-item ">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_store') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="shipping-tab" href="{!! route('admin_settings_shipping') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">GEO zones</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_payment_gateways') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">Payment gateways</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_couriers') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Courier </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_store_gifts') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Gifts</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_settings_delivery') !!}"
                   role="tab"
                   aria-controls="shipping" aria-selected="false">Delivery Cost</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_tax_rates') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Tax Rates</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " id="printing-tab" href="{!! route('admin_settings_printing') !!}" role="tab"
                   aria-controls="printing" aria-selected="true" aria-expanded="true">Printing</a>
            </li>
        </ul>
        </div>
        <div id="content">
{{--            <div class="card panel panel-default mb-3">--}}
{{--                <div class="card-header panel-heading clearfix">--}}
{{--                    <h2 class="pull-left m-0">Geo Zones</h2>--}}
{{--                    <div class="pull-right">--}}
{{--                       --}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="card panel panel-default mb-3">
{{--                            <div class="card-header panel-heading">--}}
{{--                                <h3 class="panel-title h5"><i class="fa fa-list"></i> Geo Zone List</h3>--}}
{{--                            </div>--}}
                <div class="d-flex flex-wrap justify-content-end px-4 mt-2">
                    <a href="{!! route('admin_settings_geo_zones_new') !!}" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                            <div class="card-body panel-body pt-0">
                                <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Payment Options</th>
                                        <th>Description</th>
                                        <th>Created at</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')
    <script>
        $(function () {
            $('#users-table').DataTable({
                ajax:  "{!! route('datatable_all_geo_zones') !!}",
                dom: '<"d-flex justify-content-between align-items-baseline"lfB><rtip>',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                "scrollX": true,
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'id',name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'payment_options', name: 'payment_options'},
                    {data: 'description', name: 'description'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ],
                order: [ [0, 'desc'] ]
            });
        });

    </script>
    @stop
