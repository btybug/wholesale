@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2 class="m-0 pull-left">Brands</h2>
            @ok('admin_blog_brands_create') <div class=""><a class="btn btn-primary pull-right" href="{!! route('admin_blog_brands_create') !!}">Add new</a></div>@endok
        </div>
        <div class="card-body panel-body pt-0">

            <table id="brands-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function () {
            $('#brands-table').DataTable({
            ajax: "{!! route('datatable_all_brands') !!}",
            "processing": true,
            "serverSide": true,
            "bPaginate": true,
                dom: '<"d-flex justify-content-between align-items-baseline"lfB><rtip>',
            buttons: [
            'csv', 'excel', 'pdf', 'print'
            ],
            columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'brands_translations.name'},
            {data: 'icon', name: 'last_name'},
            {data: 'image', name: 'image'},
            {data: 'description', name: 'brands_translations.description'},
            {data: 'slug', name: 'slug'},
            {data: 'actions', name: 'actions'}
            ]
            });
        });

    </script>
@stop
@section('css')

@stop
