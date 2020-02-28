@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
                <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link " id="info-tab"
                           href="{!! route('admin_emails_notifications_emails') !!}" role="tab"
                           aria-controls="general" aria-selected="true" aria-expanded="true">Communications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="general-tab"
                           href="{!! route('admin_emails_notifications_send_email') !!}" role="tab"
                           aria-controls="accounts" aria-selected="true" aria-expanded="true">Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="general-tab" href="{!! route('admin_emails_newsletters') !!}"
                           role="tab"
                           aria-controls="accounts" aria-selected="true" aria-expanded="true">Subscribers</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content w-100">
                <div class="card panel panel-default">
                    <div class="card-header panel-heading d-flex flex-wrap justify-content-between">
                        <h2 class="m-0 pull-left">Notification</h2>
                        @ok('create_admin_emails_notifications_send_email')
                        <div class="text-right">
                            <a class="btn btn-warning" href="{!! route('admin_emails_notifications_settings') !!}">Settings</a>
                        </div>
                        @endok
                    </div>
                    <div class="d-flex justify-content-between px-4 mt-2">
                        <div>
                            <select name="table_head" id="table_head_id" class="selectpicker" multiple>
                                <option value="#" data-column="0" data-name="id">#</option>
                                <option value="Status" data-column="1" data-name="status">Status</option>
                                <option value="Type" data-column="2" data-name="category_id">Type</option>
                                <option value="From" data-column="3" data-name="from">From</option>
                                <option value="Subject" data-column="4" data-name="subject">Subject</option>
                                <option value="Created At" data-column="5" data-name="created_at">Created At</option>
                                <option value="Actions" data-column="6" data-name="actions">Actions</option>
                            </select>
                        </div>
                        @ok('create_admin_emails_notifications_send_email')
                        <div>
                            <a class="btn btn-primary"
                               href="{!! route('create_admin_emails_notifications_send_email') !!}">Create
                                notification</a>
                        </div>
                        @endok
                    </div>
                    <div class="card-body panel-body notification--body pt-0">
                        <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>From</th>
                                <th>Subject</th>
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
            var datatable;

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
                    columns: tableHeadArray,
                    order: [[1, 'ASC']]
                });
                datatable = table;

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
                    localStorage.setItem(storageName, JSON.stringify(selected_items))
                }

                init();

                $(selectId).on('changed.bs.select', function (e) {
                    init();
                });
            }

            tableInit(
                "emails_not_table",
                [
                    {id: '#', name: 'id'},
                    {id: 'Status', name: 'status'},
                    {id: 'Author', name: 'category_id'},
                    {id: 'URL', name: 'from'},
                    {id: 'Short Description', name: 'subject'},
                    {id: 'Status', name: 'created_at'},
                    {id: 'Action', name: 'actions'}
                ],
                '#table_head_id',
                [
                    {data: 'id', name: 'id'},
                    {data: 'status', name: 'status'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'from', name: 'from'},
                    {data: 'subject', name: 'subject'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ],
                '#users-table',
                "{!! route('datatable_all_custom_emails') !!}"
            );

            $('body').on('click', '.send-now', function () {
                var data = {'id': $(this).attr('data-id')};
                $.ajax({
                    url: "{!! route('admin_emails_notifications_send_now') !!}",
                    type: 'POST',
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        $('.error-box').html('');
                        if (data.error == false) {
                            datatable.ajax.reload();
                        }
                    },
                    error: function (data) {
                        // alert(data.err);
                    }
                });
            });
            $('body').on('click', '.copy-message', function () {
                var data = {'id': $(this).attr('data-id')};
                $.ajax({
                    url: "{!! route('admin_emails_notifications_copy') !!}",
                    type: 'POST',
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        $('.error-box').html('');
                        if (data.error == false) {
                            datatable.ajax.reload();
                        }
                    },
                    error: function (data) {
                        // alert(data.err);
                    }
                });
            });
        });

    </script>
@stop
