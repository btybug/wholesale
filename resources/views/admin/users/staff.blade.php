@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
                <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
                    @ok('admin_staff')
                    <li class="nav-item">
                        <a class="nav-link active" id="info-tab" href="{!! route('admin_staff') !!}" role="tab"
                           aria-controls="general" aria-selected="true" aria-expanded="true">Staff</a>
                    </li>
                    @endok
                    @ok('admin_tools_logs')
                    <li class="nav-item">
                        <a class="nav-link " id="general-tab" href="{!! route('admin_tools_logs') !!}" role="tab"
                           aria-controls="accounts" aria-selected="true" aria-expanded="true">Activity Log Frontend</a>
                    </li>
                    @endok
                    @ok('admin_tools_logs_backend')
                    <li class="nav-item ">
                        <a class="nav-link" id="payment_gateways" href="{!! route('admin_tools_logs_backend') !!}" role="tab"
                           aria-controls="shipping" aria-selected="false">Activity Log Backend</a>
                    </li>
                    @endok
                </ul>
            </div>
            <div class="tab-content w-100">
       <div class="card panel panel-default">
{{--        <div class="card-header panel-heading clearfix">--}}
{{--            <div class="pull-left">--}}
{{--                <h2 class="m-0">Staff</h2>--}}
{{--            </div>--}}
{{--           --}}
{{--        </div>--}}

           @ok('admin_staff_new')
           <div class="d-flex justify-content-end px-4 mt-2">
               <a href="{!! route('admin_staff_new') !!}" class="btn btn-info">Create new staff</a>
           </div>
           @endok
        <div class="card-body panel-body pt-0">

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
