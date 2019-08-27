@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
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
    <div class="" id="myTabContent">
        <div class="" id="myTabContent">
            <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Url</th>
                    <th>Method</th>
                    <th>Ip</th>
                    <th>Iso Code</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>State</th>
                    <th>State Name</th>
                    <th>Timezone</th>
                    <th>Agent</th>
                    <th>Date</th>
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
                ajax:  "{!! route('datatable_backend_activity') !!}",
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'user',name: 'user'},
                    {data: 'url',name: 'url'},
                    {data: 'method', name: 'method'},
                    {data: 'ip', name: 'ip'},
                    {data: 'iso_code', name: 'iso_code'},
                    {data: 'country', name: 'country'},
                    {data: 'city', name: 'city'},
                    {data: 'state', name: 'state'},
                    {data: 'state_name', name: 'state_name'},
                    {data: 'timezone', name: 'timezone'},
                    {data: 'agent', name: 'agent'},
                    {data: 'created_at', name: 'created_at'},
                ],
                order: [ [0, 'desc'] ]
            });
        });

    </script>
@stop
