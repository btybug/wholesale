@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            <h2 class="m-0 pull-left">Users</h2>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
            <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Membership</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Verification Type</th>
                    <th>Customer Number</th>
                    <th>Registered</th>
                    <th>Actions</th>
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
            $('#users-table').DataTable({
                ajax: "{!! route('datatable_all_users') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'membership', name: 'membership'},
                    {data: 'phone', name: 'phone'},
                    {data: 'country', name: 'country'},
                    {data: 'gender', name: 'gender'},
                    {data: 'status', name: 'status'},
                    {data: 'verification_type', name: 'verification_type'},
                    {data: 'customer_number', name: 'customer_number'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop