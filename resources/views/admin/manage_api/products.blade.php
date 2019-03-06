@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h2 class="pull-left m-0">Inventory</h2>
            <div class="pull-right "><a class="btn btn-primary pull-right" href="{!! route('admin_stock_new') !!}">Add new</a></div>
        </div>
        <div class="panel-body">
            <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Added/Last Modified Date</th>
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
                ajax: "{!! route('admin_manage_api_all_products') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'image', name: 'image'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop