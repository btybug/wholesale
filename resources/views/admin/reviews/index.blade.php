@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <div class="panel-heading clearfix">
                <h2 class="m-0 pull-left">Reviews</h2>
                <div class="pull-right">
                </div>
            </div>
        </div>
        <div class="card-body panel-body">
            <table id="posts-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Item</th>
                    <th>Order Number</th>
                    <th>Summary</th>
                    <th>Review</th>
                    <th>Rate</th>
                    <th>Nickname</th>
                    <th>Status</th>
                    <th>Added/Last Modified Date</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function () {
            $('#posts-table').DataTable({
                ajax: "{!! route('datatable_reviews') !!}",
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
                    {data: 'user_id', name: 'user_id'},
                    {data: 'item_id', name: 'item_id'},
                    {data: 'order_id', name: 'order_id'},
                    {data: 'summary', name: 'summary'},
                    {data: 'review', name: 'review'},
                    {data: 'rate', name: 'rate'},
                    {data: 'nickname', name: 'nickname'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
