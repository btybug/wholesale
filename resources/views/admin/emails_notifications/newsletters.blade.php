@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
<div class="card panel panel-default">
    <div class="card-header panel-heading">
        <h2 class="m-0">Emails</h2>
           </div>
    <div class="card-body panel-body">
        <select name="table_head" id="table_head_id" class="selectpicker" multiple>
            <option value="#" data-column="0" data-name="id">#</option>
            <option value="Email" data-column="1" data-name="email">Email</option>
            <option value="Is Member" data-column="2" data-name="user_id">Is Member</option>
            <option value="Type/Category" data-column="3" data-name="category_id">Type/Category</option>
            <option value="Subscribed Date" data-column="4" data-name="created_at">Subscribed Date</option>
            <option value="Actions" data-column="5" data-name="actions">Actions</option>
        </select>
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
                    dom: 'Bfrtip',
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
                    localStorage.setItem(storageName, JSON.stringify(selected_items))
                }

                init();

                $(selectId).on('changed.bs.select', function (e) {
                    init();
                });
            }
            tableInit(
                "newsletters_table",
                [
                    {id: '#',name: 'id'},
                    {id: 'Email',name: 'email'},
                    {id: 'Is Member', name: 'user_id'},
                    {id: 'Type/Category', name: 'category_id'},
                    {id: 'Subscribed Date', name: 'created_at'},
                    {id: 'Actions', name: 'actions'}
                ],
                '#table_head_id',
                [
                    {data: 'id',name: 'id'},
                    {data: 'email',name: 'email'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ],
                '#users-table',
                "{!! route('datatable_all_newsletters') !!}"
            )
        });
    </script>
@stop
