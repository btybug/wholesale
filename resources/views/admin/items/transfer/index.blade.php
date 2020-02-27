@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="card panel panel-default">
            <div class="card-header panel-heading clearfix">
                <h2 class="m-0 pull-left">{!! __('Transfers') !!}</h2>
                <div class="pull-right">
                    @ok('admin_items_new_transfer')<a class="btn btn-primary pull-right mr-1" href="{!! route('admin_items_new_transfer') !!}">
                        New Transfer</a>@endok
                </div>
            </div>
            <div class="card-body panel-body">
                <table id="orders-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Item</th>
                        <th>From</th>
                        <th>To</th>
                        <th>QTY</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function () {
            $('#orders-table').DataTable({
                ajax: "{!! route('datatable_all_transfers') !!}",
                dom: 'Bflrtip',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                "scrollX": true,
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'item_id', name: 'item_id'},
                    {data: 'from_id', name: 'from_id'},
                    {data: 'to_id', name: 'to_id'},
                    {data: 'qty', name: 'qty'},
                    {data: 'created_at', name: 'created_at'}
                ],
                order: [ [0, 'desc'] ]
            });
        });
    </script>
@stop
