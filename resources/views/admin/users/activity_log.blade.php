@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="row " style="zoom: 75%">

        <div class="col-sm-12">
            <div class="col-md-6 pull-left">
                <h2 class="m-0">User All Logs</h2>
            </div>
        </div>
        <div class="col-sm-12">
            <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Object Name</th>
                    <th>Object Id</th>
                    <th>Action Type</th>
                    <th>Date</th>
                </tr>
                </thead>
            </table>
        </div>
        <div class="col-sm-12">
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
                dom: 'Bflrtip',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                "scrollX": true,
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: '_id',name: '_id'},
                    {data: 'object_name',name: 'object_name'},
                    {data: 'object_id', name: 'object_id'},
                    {data: 'action_type', name: 'action_type'},
                    {data: 'created_at', name: 'created_at'},
                ],
                order: [ [0, 'desc'] ]
            });
            });

    </script>
@stop
