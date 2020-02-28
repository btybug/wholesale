@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">
{{--        <div class="card-header panel-heading clearfix">--}}
{{--            <h2 class="m-0 pull-left">Filters</h2>--}}
{{--        </div>--}}
        <div class="d-flex justify-content-end px-4 mt-2">
            @ok('admin_tools_filters_manage') <div><button class="btn btn-primary pull-right" data-toggle="modal" data-target="#add-filter">Add new</button></div>@endok

        </div>
        <div class="card-body panel-body pt-0">
            <table id="posts-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

<div class="modal fade releted-products-add-modal" id="add-filter" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Filter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url'=>route('admin_store_filters_new_category'),'class' => 'updated-form']) !!}
                @if(count(get_languages()))
                    <ul class="nav nav-tabs">
                        @foreach(get_languages() as $language)
                            <li class="nav-item"><a class="nav-link @if($loop->first) active @endif" data-toggle="tab" href="#{{ strtolower($language->code) }}">
                                    <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}</a></li>
                        @endforeach
                    </ul>
                @endif


                <div class="tab-content">
                    @if(count(get_languages()))
                        @foreach(get_languages() as $language)
                            <div id="{{ strtolower($language->code) }}" class="tab-pane fade  @if($loop->first) in active show @endif">
                                <div class="form-group row mt-10">
                                    <label class="col-md-2 col-xs-12">Filter Name</label>
                                    <div class="col-md-10">
                                        {!! Form::text('translatable['.strtolower($language->code).'][name]',null,['class'=>'form-control','required'=>true]) !!}
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
@section('js')
    <script>
        $(function () {
            $('#posts-table').DataTable({
                ajax: "{!! route('datatable_all_filters') !!}",
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
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });

    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
