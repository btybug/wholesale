@extends('layouts.admin')
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <h2 class="m-0 pull-left">Items</h2>
            <div class="pull-right"><a class="btn btn-primary pull-right" href="{!! route('admin_items_new') !!}">Add new</a></div>
        </div>
        <div class="card-body panel-body">
            <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Group</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function () {
            $('#stocks-table').DataTable({
                ajax: "{!! route('admin_manage_api_all_items') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                "scrollX": true,
                dom: 'Bflrtip',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'sku', name: 'sku'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'image', name: 'image'},
                    {data: 'filter', name: 'filter'},
                    {data: 'short_description', name: 'short_description'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop
