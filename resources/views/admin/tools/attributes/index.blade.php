@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h2 class="m-0 pull-left">Attributes</h2>
           @ok('admin_store_attributes_new')<div class="pull-right"><a class="btn btn-primary pull-right" href="{!! route('admin_store_attributes_new') !!}">Add new</a></div>@endok
        </div>
        <div class="panel-body">
            <table id="attributes-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Icon</th>
                    <th>Is Filter</th>
                    <th>Render Style</th>
                    <th>Added/Last Modified Date</th>
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
            $('#attributes-table').DataTable({
                ajax:  "{!! route('datatable_all_attributes') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                columns: [
                    {data: 'id',name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'image', name: 'image'},
                    {data: 'icon', name: 'icon'},
                    {data: 'filter', name: 'filter'},
                    {data: 'display_as', name: 'display_as'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop