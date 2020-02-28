@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
        <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs card-header-tabs m-0" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One"
                   aria-selected="true">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two"
                   aria-selected="false">Archive</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active in show" id="one" role="tabpanel" aria-labelledby="one-tab">
            <div class="card panel panel-default">
{{--                <div class="card-header panel-heading d-flex flex-wrap justify-content-between">--}}
{{--                    <h2 class="m-0 mr-1">Active Coupons</h2>--}}
{{--                </div>--}}
                <div class="d-flex flex-wrap justify-content-between px-4 mt-2">
                    <div>
                        <select name="table_head" id="table_head_id1" class="selectpicker" multiple>
                            <option value="#" data-column="0" data-name="id">#</option>
                            <option value="Name" data-column="1" data-name="name">Name</option>
                            <option value="Code" data-column="2" data-name="Code">Code</option>
                            <option value="Type" data-column="3" data-name="type">Type</option>
                            <option value="Discount" data-column="4" data-name="discount">Discount</option>
                            <option value="Minimal order amount" data-column="5" data-name="total_amount">Minimal order amount</option>
                            <option value="Coupon Based" data-column="6" data-name="shipping_type">Coupon Based</option>
                            <option value="Start Date" data-column="7" data-name="start_date">Start Date</option>
                            <option value="End Date" data-column="8" data-name="end_date">End Date</option>
                            <option value="Status" data-column="9" data-name="status">Status</option>
                            <option value="Created By" data-column="10" data-name="created_by">Created By</option>
                            <option value="Actions" data-column="11" data-name="actions">Actions</option>
                        </select>
                    </div>
                    @ok('admin_store_coupons_new')
                    <div>
                        <a class="btn btn-primary" href="{!! route('admin_store_coupons_new') !!}">Add new</a>
                    </div>
                    @endok
                </div>
                <div class="card-body panel-body pt-0">

                    <table id="categories-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Discount</th>
                            <th>Minimal order amount</th>
                            <th>Coupon Based</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade " id="two" role="tabpanel" aria-labelledby="two-tab">
            <div class="card panel panel-default">
                <div class="card-header panel-heading clearfix">
                    <h2 class="pull-left m-0">Inactive Coupons</h2>
                </div>
                <div class="card-body panel-body">
                    <select name="table_head" id="table_head_id2" class="selectpicker" multiple>
                        <option value="#" data-column="0" data-name="id">#</option>
                        <option value="Name" data-column="1" data-name="name">Name</option>
                        <option value="Code" data-column="2" data-name="Code">Code</option>
                        <option value="Type" data-column="3" data-name="type">Type</option>
                        <option value="Discount" data-column="4" data-name="discount">Discount</option>
                        <option value="Minimal order amount" data-column="5" data-name="total_amount">Minimal order amount</option>
                        <option value="Coupon Based" data-column="6" data-name="shipping_type">Coupon Based</option>
                        <option value="Start Date" data-column="7" data-name="start_date">Start Date</option>
                        <option value="End Date" data-column="8" data-name="end_date">End Date</option>
                        <option value="Status" data-column="9" data-name="status">Status</option>
                        <option value="Created By" data-column="10" data-name="created_by">Created By</option>
                        <option value="Actions" data-column="11" data-name="actions">Actions</option>
                    </select>
                    <table id="archive-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Discount</th>
                            <th>Minimal order amount</th>
                            <th>Coupon Based</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Created By</th>
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
                    localStorage.setItem(storageName, JSON.stringify(selected_items))
                }

                init();

                $(selectId).on('changed.bs.select', function (e) {
                    init();
                });
            }

            tableInit(
                "archive_coupons_table",
                [
                    {id: '#', name: 'id'},
                    {id: 'Name', name: 'name'},
                    {id: 'Code', name: 'Code'},
                    {id: 'Type', name: 'type'},
                    {id: 'Discount', name: 'discount'},
                    {id: 'Minimal order amount', name: 'total_amount'},
                    {id: 'Coupon Based', name: 'shipping_type'},
                    {id: 'Start Date', name: 'start_date'},
                    {id: 'End Date', name: 'end_date'},
                    {id: 'Status', name: 'status'},
                    {id: 'Created By', name: 'created_by'},
                    {id: 'Actions', name: 'actions'}
                ],
                '#table_head_id2',
                [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'Code'},
                    {data: 'type', name: 'type'},
                    {data: 'discount', name: 'discount'},
                    {data: 'total_amount', name: 'total_amount'},
                    {data: 'based', name: 'shipping_type'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'status', name: 'status'},
                    {data: 'created_by', name: 'created_by'},
                    {data: 'actions', name: 'actions'}
                ],
                '#archive-table',
                "{!! route('datatable_all_coupons','archive') !!}"
            );

            tableInit(
                "active_coupons_table",
                [
                    {id: '#', name: 'id'},
                    {id: 'Name', name: 'name'},
                    {id: 'Code', name: 'Code'},
                    {id: 'Type', name: 'type'},
                    {id: 'Discount', name: 'discount'},
                    {id: 'Minimal order amount', name: 'total_amount'},
                    {id: 'Coupon Based', name: 'shipping_type'},
                    {id: 'Start Date', name: 'start_date'},
                    {id: 'End Date', name: 'end_date'},
                    {id: 'Status', name: 'status'},
                    {id: 'Created By', name: 'created_by'},
                    {id: 'Actions', name: 'actions'}
                ],
                '#table_head_id1',
                [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'Code'},
                    {data: 'type', name: 'type'},
                    {data: 'discount', name: 'discount'},
                    {data: 'total_amount', name: 'total_amount'},
                    {data: 'based', name: 'shipping_type'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'status', name: 'status'},
                    {data: 'created_by', name: 'created_by'},
                    {data: 'actions', name: 'actions'}
                ],
                '#categories-table',
                "{!! route('datatable_all_coupons','active') !!}"
            );
        });
    </script>
@stop
