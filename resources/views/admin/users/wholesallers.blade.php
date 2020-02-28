@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="tab-content w-100">
                 <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <div class="pull-left">
                <h2 class="m-0">Wholesallers</h2>
            </div>
        </div>
        <div class="card-body panel-body">
<div class="table-responsive">
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
    </div>
@stop
@section('js')
    <script>
        $(function () {
            {{--$('#users-table').DataTable({--}}
                {{--ajax: "{!! route('datatable_all_staff') !!}",--}}
                {{--"processing": true,--}}
                {{--"serverSide": true,--}}
                {{--"bPaginate": true,--}}
                {{--dom: 'Bfrtip',--}}
                {{--buttons: [--}}
                    {{--'csv', 'excel', 'pdf', 'print'--}}
                {{--],--}}
                {{--columns: [--}}
                    {{--{data: 'id', name: 'id'},--}}
                    {{--{data: 'name', name: 'name'},--}}
                    {{--{data: 'last_name', name: 'last_name'},--}}
                    {{--{data: 'email', name: 'email'},--}}
                    {{--{data: 'role', name: 'role'},--}}
                    {{--{data: 'phone', name: 'phone'},--}}
                    {{--{data: 'country', name: 'country'},--}}
                    {{--{data: 'gender', name: 'gender'},--}}
                    {{--{data: 'created_at', name: 'created_at'},--}}
                    {{--{data: 'actions', name: 'actions'}--}}
                {{--]--}}
            {{--});--}}
        });

    </script>
@stop
