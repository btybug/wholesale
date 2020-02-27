@extends('layouts.admin')
@section('content')
    <div class="card panel panel-default">
{{--        <div class="card-header panel-heading d-flex flex-wrap justify-content-between">--}}
{{--            <h2 class="m-0 ">Suppliers</h2>--}}
{{--        </div>--}}
        <div class="d-flex justify-content-end px-4 mt-2">
            @ok('admin_suppliers_new')<div><a class="btn btn-primary pull-right" href="{!! route('admin_suppliers_new') !!}">Add new</a></div>@endok

        </div>
        <div class="card-body panel-body pt-0">
            <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Fax</th>
                    <th>Notes</th>
                    <th>Created At</th>
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
            $('#stocks-table').DataTable({
                ajax: "{!! route('datatable_all_suppliers') !!}",
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
                    {data: 'address', name: 'address'},
                    {data: 'phone', name: 'phone'},
                    {data: 'company', name: 'company'},
                    {data: 'email', name: 'email'},
                    {data: 'fax', name: 'fax'},
                    {data: 'notes', name: 'notes'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop
