@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">

        <div class="card-header panel-heading clearfix">
            <div class="pull-left">
                <h2 class="m-0">Roles</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-warning pull-right text-white" href="{!! route('admin_create_role') !!}">Create Role</a>
            </div>
        </div>
        <div class="card-body panel-body">
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
                dom: 'Bfrtip',
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
