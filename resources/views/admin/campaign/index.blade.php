@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            <div class="pull-left">
                <h2 class="m-0">Campaigns</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-warning pull-right" href="{!! route('admin_campaign_create') !!}">Create</a>
            </div>
        </div>
        <div class="panel-body">
            <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
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
            $('#users-table').DataTable({
                ajax:  "{!! route('datatable_all_campigns') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                columns: [
                    {data: 'id',name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop