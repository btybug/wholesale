@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">

{{--        <div class="card-header panel-heading clearfix">--}}
{{--            <div class="pull-left">--}}
{{--                <h2 class="m-0">Users</h2>--}}
{{--            </div>--}}
{{--            --}}
{{--        </div>--}}
        @ok('admin_customers_new')
        <div class="d-flex justify-content-end px-4 mt-2">
            <div class="pull-right"><a href="{!! route('admin_customers_new') !!}" class="btn btn-info">Create new customer</a></div>
        </div>
        @endok
        <div class="card-body panel-body pt-0">
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
                "scrollX": true,
                dom: '<"d-flex justify-content-between align-items-baseline"lfB><rtip>',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
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
