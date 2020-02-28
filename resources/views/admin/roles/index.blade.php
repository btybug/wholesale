@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">

{{--        <div class="card-header panel-heading clearfix">--}}
{{--            <div class="pull-left">--}}
{{--                <h2 class="m-0">Roles</h2>--}}
{{--            </div>--}}
{{--            --}}
{{--        </div>--}}
        <div class="d-flex justify-content-end px-4 mt-2">
            <div>
                <a class="btn btn-warning pull-right text-white" href="{!! route('admin_create_role') !!}">Create Role</a>
            </div>
        </div>
        <div class="card-body panel-body pt-0">
            <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>SLug</th>
                    <th>Description</th>
                    <th>Access</th>
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
            $('#users-table').DataTable({
                ajax:  "{!! route('datatable_all_roles') !!}",
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
                    {data: 'id',name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'slug',name: 'slug'},
                    {data: 'description', name: 'description'},
                    {data: 'access', name: 'access'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop
