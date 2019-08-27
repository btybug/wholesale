@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="row " style="zoom: 75%">

        <div class="col-xs-12">
            <div class="col-md-6 pull-left">
                <h2 class="m-0">User All Logs</h2>
            </div>
        </div>
        <div class="col-xs-12">
            <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
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
        <div class="col-xs-12">
            <div class="col-md-6 pull-left">
                <h2 class="m-0">User Submit Actions</h2>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function () {
            $('#users-table').DataTable({
                ajax:  "{!! route('datatable_user_activity',$user->id) !!}",
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'id',name: 'id'},
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
