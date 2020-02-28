@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
           <h2 class="m-0 pull-left">Comments</h2>
            <div class="pull-right"><a class="btn btn-primary pull-right" href="{!! route('admin_blog_comments_settings') !!}">Settings</a></div>

        </div>
        <div class="card-body panel-body">
            <h1>aaaaaaaaaaa</h1>
            <select name="table_head" id="table_head_id" class="selectpicker" multiple>
                <option value="ID" data-column="0" data-name="author">Author</option>
                <option value="Comment" data-column="1" data-name="comment">Comment</option>
                <option value="Replies" data-column="2" data-name="replies">Replies</option>
                <option value="Action" data-column="3" data-name="actions">Action</option>
            </select>
            <table id="posts-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Replies</th>
                    {{--<th>Author</th>--}}
                    {{--<th>Message</th>--}}
                    {{--<th>Status</th>--}}
                    {{--<th>Added/Last Modified Date</th>--}}
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
                "blog_comments_table",
                [
                    {id: 'ID', name: 'author'},
                    {id: 'Comment', name: 'comment'},
                    {id: 'Replies', name: 'replies'},
//                      {id: 'user_id', name: 'user_id'},
//                      {id: 'message', name: 'message'},
//                      {id: 'status', name: 'status'},
//                      {id: 'created_at', name: 'created_at'},
                    {id: 'Action', name: 'actions'}
                ],
                '#table_head_id',
                [
                    [
                        {data: 'author', name: 'author'},
                        {data: 'comment', name: 'comment'},
                        {data: 'replies', name: 'replies'},
//                      {data: 'user_id', name: 'user_id'},
//                      {data: 'message', name: 'message'},
//                      {data: 'status', name: 'status'},
//                      {data: 'created_at', name: 'created_at'},
                        {data: 'actions', name: 'actions'}
                    ]
                ],
                '#posts-table',
                "{!! route('datatable_all_post_comments') !!}"
            )
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
