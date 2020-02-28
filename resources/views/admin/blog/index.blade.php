@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading d-flex flex-wrap justify-content-between align-items-center">
              <h2 class="m-0 pull-left">Posts</h2>
               @ok('admin_blog_settings') <div class=""><a class="btn btn-warning pull-right" href="{!! route('admin_blog_settings') !!}">Settings</a></div>@endok
        </div>
        <div class="card-body panel-body pt-0">
            <div class="d-flex justify-content-between mt-2">
                <div>
                    <select name="table_head" id="table_head_id" class="selectpicker" multiple>
                        <option value="ID" data-column="0" data-name="id">ID</option>
                        <option value="Title" data-column="1" data-name="title">Title</option>
                        <option value="Author" data-column="2" data-name="user_id">Author</option>
                        <option value="URL" data-column="3" data-name="url">URL</option>
                        <option value="Short Description" data-column="4" data-name="short_description">Short Description</option>
                        <option value="Status" data-column="5" data-name="status">Status</option>
                        <option value="Added/Last Modified Date" data-column="6" data-name="created_at">Added/Last Modified Date</option>
                        <option value="Action" data-column="7" data-name="actions">Action</option>
                    </select>
                </div>
                <div class="ml-1">
                    @ok('admin_blog_create') <div class=""><a class="btn btn-primary pull-right" href="{!! route('admin_blog_create') !!}">Add new</a></div>@endok
                </div>
            </div>

            <table id="posts-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>URL</th>
                    <th>Short Description</th>
                    <th>Status</th>
                    <th>Added/Last Modified Date</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop
@section('js')
    <script>

        $(document).ready(function() {

            function tableInit(storageName, selectData, selectId, tableData, tableId, ajaxUrl) {
                if(!localStorage.getItem(storageName)) {
                    localStorage.setItem(storageName, JSON.stringify(selectData))
                }

                let selId = JSON.parse(localStorage.getItem(storageName)).map((el) => {
                    return el.id;
                });

                $(selectId).selectpicker({
                    // actionsBox: true,
                    dropupAuto: true,
                    // header: 'Select',
                    liveSearch: true,
                    liveSearchPlaceholder: 'Search',
                    multipleSeparator: ' | ',
                    style: 'btn-default',
                    // width: 'auto'
                });
                $(selectId).selectpicker('val', selId);
                var tableHeadArray = tableData;

                tableArray = tableHeadArray.map((head) => {
                    const id = head.data;

                    var visible = JSON.parse(localStorage.getItem(storageName)).find((el) => {
                        return el.name === id;
                    });
                    if(visible) {
                        return head;
                    } else {
                        return {
                            ...head,
                            visible: false
                        };
                    }
                });
                var table = $(tableId).DataTable({
                    ajax: ajaxUrl,
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
                    columns: tableHeadArray
                });

                function init() {
                    var selected_items = [];
                    $(`${selectId} option`).each(function() {
                        var column = table.column($(this).attr('data-column'));
                        if($(this).is(':selected')) {
                            selected_items.push({
                                id: $(this).val(),
                                text: $(this).val(),
                                name: $(this).attr("data-name")
                            });
                            column.visible(true);
                        } else {
                            column.visible(false);
                        }
                    });
                    console.log(selected_items, 'selected_items')
                    localStorage.setItem(storageName, JSON.stringify(selected_items))
                }

                init();

                $(selectId).on('changed.bs.select', function (e) {
                    init();
                });
            }

            tableInit(
                "blog_table",
                [
                    {id: 'ID', name: 'id'},
                    {id: 'Title', name: 'title'},
                    {id: 'Author', name: 'user_id'},
                    {id: 'URL', name: 'url'},
                    {id: 'Short Description', name: 'short_description'},
                    {id: 'Status', name: 'status'},
                    {id: 'Added/Last Modified Date', name: 'created_at'},
                    {id: 'Action', name: 'actions'}
                ],
                '#table_head_id',
                [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'url', name: 'url'},
                    {data: 'short_description', name: 'short_description'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ],
                '#posts-table',
                "{!! route('datatable_all_posts') !!}"
            )
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
