@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="">
        <div>
            <div class="card panel panel-default">
{{--                <div class="card-header panel-heading d-flex flex-wrap justify-content-between">--}}
{{--                        <h2 class="m-0">Promotions</h2>--}}
{{--                </div>--}}
                <div class="d-flex flex-wrap justify-content-between px-4 mt-2">
                    <div>
                        <select name="table_head" id="table_head_id" class="selectpicker text-black" multiple>
                            <option value="#" data-column="0" data-name="id">#</option>
                            <option value="Name" data-column="1" data-name="name">Name</option>
                            <option value="Product" data-column="2" data-name="stock_id">Product</option>
                            <option value="Start Date" data-column="3" data-name="start_date">Start Date</option>
                            <option value="End Date" data-column="4" data-name="end_date">End Date</option>
                            <option value="Canceled" data-column="5" data-name="canceled">Canceled</option>
                            <option value="Actions" data-column="6" data-name="actions">Actions</option>
                        </select>
                    </div>
                    @ok('admin_stock_promotions_new')
                        <div><a class="btn btn-primary pull-right" href="{!! route('admin_stock_promotions_new') !!}">Add new</a></div>
                    @endok

                </div>
                <div class="card-body panel-body pt-0">
                    <table id="promotion-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Product</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Canceled</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
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
                    dom: 'Bflrtip',
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
                "promotion_table",
                [
                     {id: '#', name: 'id'},
                     {id: 'Name', name: 'name'},
                     {id: 'Product', name: 'stock_id'},
                     {id: 'Start Date', name: 'start_date'},
                     {id: 'End Date', name: 'end_date'},
                     {id: 'Canceled', name: 'canceled'},
                     {id: 'Actions', name: 'actions'}
                 ],
                '#table_head_id',
                [
                    {data: 'id', name: 'variation_id'},
                    {data: 'name', name: 'name'},
                    {data: 'stock_id', name: 'stock_id'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'canceled', name: 'canceled'},
                    {data: 'actions', name: 'actions'}
                ],
                '#promotion-table',
                "{!! route('datatable_all_promotions') !!}"
            )
        });

    </script>
@stop
