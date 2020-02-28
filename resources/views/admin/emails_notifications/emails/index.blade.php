@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
                <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="info-tab"
                           href="{!! route('admin_emails_notifications_emails') !!}" role="tab"
                           aria-controls="general" aria-selected="true" aria-expanded="true">Communications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="general-tab"
                           href="{!! route('admin_emails_notifications_send_email') !!}" role="tab"
                           aria-controls="accounts" aria-selected="true" aria-expanded="true">Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="general-tab" href="{!! route('admin_emails_newsletters') !!}"
                           role="tab"
                           aria-controls="accounts" aria-selected="true" aria-expanded="true">Subscriber</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content w-100">
                <div class="card panel panel-default">
{{--                    <div class="card-header panel-heading">--}}
{{--                        <h2 class="m-0">Emails</h2>--}}
{{--                    </div>--}}
                    <div class="card-body panel-body">
                        <select name="table_head" id="table_head_id" class="selectpicker" multiple>
                            <option value="#" data-column="0" data-name="id">#</option>
                            <option value="Slug" data-column="1" data-name="slug">Slug</option>
                            <option value="Status" data-column="2" data-name="is_active">Status</option>
                            <option value="Module" data-column="3" data-name="module">Module</option>
                            <option value="Created At" data-column="4" data-name="created_at">Created At</option>
                            <option value="Actions" data-column="5" data-name="actions">Actions</option>
                        </select>
                        <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Module</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>

        $(document).ready(function () {

            function tableInit(storageName, selectData, selectId, tableData, tableId, ajaxUrl) {
                if (!localStorage.getItem(storageName)) {
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
                    if (visible) {
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
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    buttons: [
                        'csv', 'excel', 'pdf', 'print'
                    ],
                    columns: tableHeadArray
                });

                function init() {
                    var selected_items = [];
                    $(`${selectId} option`).each(function () {
                        var column = table.column($(this).attr('data-column'));
                        if ($(this).is(':selected')) {
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
                "email_all_table",
                [
                    {id: '#', name: 'id'},
                    {id: 'Slug', name: 'slug'},
                    {id: 'Status', name: 'is_active'},
                    {id: 'Module', name: 'module'},
                    {id: 'Created At', name: 'created_at'},
                    {id: 'Actions', name: 'actions'}
                ],
                '#table_head_id',
                [
                    {data: 'id', name: 'id'},
                    {data: 'slug', name: 'slug'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'module', name: 'module'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ],
                '#users-table',
                "{!! route('datatable_all_emails') !!}"
            )
        });

    </script>
@stop
