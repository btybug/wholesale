@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <div class="panel-heading d-flex flex-wrap justify-content-between">
                <h2 class="m-0 mr-1">Tickets</h2>
                <div class="d-flex flex-wrap">
                   @ok('admin_tickets_settings') <a class="btn btn-warning mr-10 text-white" href="{!! route('admin_tickets_settings') !!}">Settings</a>@endok
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end px-4 mt-2">
            @ok('admin_tickets_new')<a class="btn btn-primary" href="{!! route('admin_tickets_new') !!}">Add new</a>@endok
        </div>
        <div class="card-body panel-body pt-0">
            <table id="posts-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Subject</th>
                    <th>Summary</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Tags</th>
                    <th>Attachments</th>
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
                ajax: "{!! route('datatable_tickets') !!}",
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
                    {data: 'user_id', name: 'user_id'},
                    {data: 'subject', name: 'subject'},
                    {data: 'summary', name: 'summary'},
                    {data: 'status_id', name: 'status_id'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'priority_id', name: 'priority_id'},
                    {data: 'tags', name: 'tags'},
                    {data: 'attachments', name: 'attachments'},
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
