@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">
        @ok('admin_gmail_settings')
        <div class="text-right px-4 mt-2">
            <a class="btn btn-warning" href="{!! route('admin_gmail_settings') !!}">Settings</a>
        </div>
        @endok
        @if(LaravelGmail::check())
        <div class="card-body panel-body pt-0">
            <table id="posts-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th><input type="checkbox" data-action="select-all"></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Category</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
        @endif
    </div>
@stop
@if(LaravelGmail::check())
@section('js')
    <script>
        $(function () {
            $('#posts-table').DataTable({
                ajax: "{!! route('datatable_all_contact_us') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                "drawCallback": function(settings) {
                    var table_rows=$('body').find('#posts-table tr');
                    console.log(settings.json.data);
                   $.each(settings.json.data,function (k,v) {
                       if(v.is_readed){
                           $(table_rows[k+1]).addClass('unread');
                       }
                   })
                },
                "scrollX": true,
                dom: 'Bflrtip',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'options', name: 'options'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'category', name: 'category'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action'}
                ]
            });
        });

    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@endif
