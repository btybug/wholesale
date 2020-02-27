@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
                <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link " id="info-tab" href="{!! route('admin_items') !!}" role="tab"
                           aria-controls="general" aria-selected="true" aria-expanded="true">Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="general-tab" href="{!! route('admin_items_archives') !!}" role="tab"
                           aria-controls="accounts" aria-selected="true" aria-expanded="true">Archive</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content w-100">
                <div class="card panel panel-default admin-datatable-margin">
{{--                    <div class="card-header panel-heading d-flex justify-content-between">--}}
{{--                        <h2 class="m-0 pull-left">Archive</h2>--}}
{{--                    </div>--}}
                    <div class="card-body panel-body pt-0">
                        <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Sku</th>
                                <th>Barcode</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('js')
    <script>
        $(function () {
            $('#stocks-table').DataTable({
                ajax: "{!! route('datatable_all_items_archive') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                "scrollX": true,
                dom: '<"d-flex justify-content-between align-items-baseline"lfB><rtip>',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'type', name: 'type'},
                    {data: 'sku', name: 'sku'},
                    {data: 'barcode_id', name: 'barcode_id'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'short_description', name: 'short_description'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop
