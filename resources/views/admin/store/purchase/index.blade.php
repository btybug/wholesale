@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <h2 class="m-0 pull-left">Purchase</h2>
            @ok('admin_inventory_purchase_new')
            <div class="pull-right">
                <a class="btn btn-primary" href="{!! route('admin_inventory_purchase_new') !!}">Add new</a>
            </div>
            @endok
        </div>
        <div class="card-body panel-body">
            <select name="table_head" id="table_head_id" class="selectpicker" multiple>
                <option value="#" data-column="0" data-name="id">#</option>
                <option value="Name" data-column="1" data-name="name">Name</option>
                <option value="SKU" data-column="2" data-name="sku">SKU</option>
                <option value="Owner" data-column="3" data-name="user_id">Owner</option>
                <option value="Qty" data-column="4" data-name="qty">Qty</option>
                <option value="Price" data-column="5" data-name="price">Price</option>
                <option value="Purchase Date" data-column="6" data-name="purchase_date">Purchase Date</option>
                <option value="Entry Date" data-column="7" data-name="created_at">Entry Date</option>
                <option value="Actions" data-column="8" data-name="actions">Actions</option>
            </select>
            <table id="categories-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Owner</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Purchase Date</th>
                    <th>Entry Date</th>
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
                    console.log(selected_items, 'selected_items')
                    localStorage.setItem(storageName, JSON.stringify(selected_items))
                }

                init();

                $(selectId).on('changed.bs.select', function (e) {
                    init();
                });
            }

            tableInit(
                "inventory_purchase_table",
                [
                    {id: '#', name: 'id'},
                    {id: 'Name', name: 'name'},
                    {id: 'SKU', name: 'sku'},
                    {id: 'Owner', name: 'user_id'},
                    {id: 'Qty', name: 'qty'},
                    {id: 'Price', name: 'price'},
                    {id: 'Purchase Date', name: 'purchase_date'},
                    {id: 'Entry Date', name: 'created_at'},
                    {id: 'actions', name: 'actions'}
                ],
                '#table_head_id',
                [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'sku', name: 'sku'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'qty', name: 'qty'},
                    {data: 'price', name: 'price'},
                    {data: 'purchase_date', name: 'purchase_date'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ],
                '#categories-table',
                "{!! route('datatable_all_purchases') !!}"
            )
        });


    </script>
@stop
