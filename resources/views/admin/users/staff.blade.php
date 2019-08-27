@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="info-tab" href="{!! route('admin_staff') !!}" role="tab"
                       aria-controls="general" aria-selected="true" aria-expanded="true">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="general-tab" href="{!! route('admin_tools_logs') !!}" role="tab"
                       aria-controls="accounts" aria-selected="true" aria-expanded="true">Activity Log Frontend</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" id="payment_gateways" href="{!! route('admin_tools_logs_backend') !!}" role="tab"
                       aria-controls="shipping" aria-selected="false">Activity Log Backend</a>
                </li>
            </ul>
            <div class="tab-content w-100">
                 <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <div class="pull-left">
                <h2 class="m-0">Staff</h2>
            </div>
            <div class="pull-right"><a href="{!! route('admin_staff_new') !!}" class="btn btn-info">Create new staff</a></div>
        </div>
        <div class="card-body panel-body">

            <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th>Gender</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function () {
            $('#users-table').DataTable({
                ajax: "{!! route('datatable_all_staff') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'phone', name: 'phone'},
                    {data: 'country', name: 'country'},
                    {data: 'gender', name: 'gender'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop
