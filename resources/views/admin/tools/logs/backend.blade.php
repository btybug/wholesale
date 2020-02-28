@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
        <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link " id="info-tab" href="{!! route('admin_staff') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Staff</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shipping-tab" href="{!! route('admin_tools_logs') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">Activity Log Frontend</a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" id="payment_gateways" href="{!! route('admin_tools_logs_backend') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">Activity Log Backend</a>
            </li>
        </ul>
    </div>
    <div class="" id="myTabContent">
        <div class="card">
            <div class="card-body pt-0">
                <div class="" id="myTabContent">
                    <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>User last name</th>
                            <th>Object Name</th>
                            <th>Object Id</th>
                            <th>Action Type</th>
                            <th>Date</th>
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
            $(function () {
                $('#users-table').DataTable({
                    ajax:  "{!! route('datatable_backend_activity') !!}",
                    dom: '<"d-flex justify-content-between align-items-baseline"lfB><rtip>',
                    displayLength: 10,
                    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                    "scrollX": true,
                    buttons: [
                        'csv', 'excel', 'pdf', 'print'
                    ],
                    columns: [
                        {data: '_id',name: '_id'},
                        {data: 'user_id',name: 'user_id'},
                        {data: 'user_name',name: 'user_name'},
                        {data: 'user_last_name',name: 'user_last_name'},
                        {data: 'object_name',name: 'object_name'},
                        {data: 'object_id', name: 'object_id'},
                        {data: 'action_type', name: 'action_type'},
                        {data: 'created_at', name: 'created_at'},
                    ],
                    order: [ [0, 'desc'] ]
                });
            });
        });

    </script>
@stop
