@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="m-0">Emails</h2>
           </div>
    <div class="panel-body">
        <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Is Member</th>
                <th>Type/Category</th>
                <th>Subscribed Date</th>
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
            $('#users-table').DataTable(
                {
                ajax:  "{!! route('datatable_all_newsletters') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                columns: [
                    {data: 'id',name: 'id'},
                    {data: 'email',name: 'email'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            }
            );
        });

    </script>
@stop