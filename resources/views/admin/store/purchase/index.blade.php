@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h2 class="m-0 pull-left">Purchase</h2>
            @ok('admin_inventory_purchase_new')
            <div class="pull-right">
                <a class="btn btn-primary" href="{!! route('admin_inventory_purchase_new') !!}">Add new</a>
            </div>
            @endok
        </div>
        <div class="panel-body">
            <table id="categories-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>SKU</th>
                    <th>Owner</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Purchase Date</th>
                    <th>Entry Date</th>
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
            $('#categories-table').DataTable({
            ajax:  "{!! route('datatable_all_purchases') !!}",
            "processing": true,
            "serverSide": true,
            "bPaginate": true,
            columns: [
                {data: 'id',name: 'id'},
                {data: 'sku', name: 'sku'},
                {data: 'user_id',name: 'user_id'},
                {data: 'qty', name: 'qty'},
                {data: 'price', name: 'price'},
                {data: 'purchase_date', name: 'purchase_date'},
                {data: 'created_at', name: 'created_at'},
                {data: 'actions', name: 'actions'}
            ]
            });
        });

    </script>
@stop