@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
                <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
                    @ok('admin_stock')
                    <li class="nav-item">
                        <a class="nav-link " id="info-tab" href="{!! route('admin_stock') !!}" role="tab"
                           aria-controls="general" aria-selected="true" aria-expanded="true">Products</a>
                    </li>
                    @endok

                    <li class="nav-item">
                        <a class="nav-link active" id="general-tab" href="{!! route('admin_stock_offers') !!}" role="tab"
                           aria-controls="accounts" aria-selected="true" aria-expanded="true">Offers</a>
                    </li>
                </ul>
                @ok('admin_stock_settings')
                <div class="nav-item ml-2">
                    <a class="nav-link btn btn-success" id="general-tab" href="{!! route('admin_stock_settings') !!}" role="tab"
                       aria-controls="accounts" aria-selected="true" aria-expanded="true">Settings</a>
                </div>
                @endok
            </div>

            <div class="tab-content w-100">
                <div class="card panel panel-default">
                    <div class="d-flex justify-content-between px-4 mt-2">
                        <div>
                            <select name="table_head" id="table_head_id" class="selectpicker text-black" multiple>
                                <!-- <option value="#" data-column="0" data-name="id">#</option> -->
                                <option value="Name" data-column="2" data-name="name">Name</option>
                                <option value="Image" data-column="3" data-name="image">Image</option>
                                <option value="Added/Last Modified Date" data-column="4" data-name="created_at">Added/Last Modified Date</option>
                                <option value="Actions" data-column="5" data-name="actions">Actions</option>
                            </select>
                        </div>
                        @ok('admin_stock_new_offer')
                        <div class="ml-1">
                            <a class="btn btn-primary" href="{!! route('admin_stock_new_offer') !!}">Add new</a>
                        </div>
                        @endok
                    </div>
{{--                    <div class="card-header panel-heading d-flex flex-wrap justify-content-between">--}}
{{--                            <h2 class="m-0">Offers</h2>--}}
{{--                    </div>--}}
                    <div class="card-body panel-body pt-0">
                        <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th><div class="text-center"><input type="checkbox" class="select_all_checkbox"/></div></th>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Added/Last Modified Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Select</th>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Added/Last Modified Date</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
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
                    "order": [[ 1, "asc" ]],
                    dom: '<"d-flex justify-content-between align-items-baseline"lfB><rtip>',
                    displayLength: 10,
                    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                    buttons: [
                        {
                            extend: 'collection',
                            text: 'Export',
                            buttons: [
                                {
                                    extend: 'copyHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'csvHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                }
                            ]
                        },
                        {
                            text: 'Edit',
                            className: 'd-none edit_hidden_button',
                            action: function ( e, dt, node, config ) {
                                const ids = [];
                                $('#stocks-table tbody tr.selected').each(function() {
                                    ids.push($(this).find('td.id_n').text());
                                });

                                if(ids.length > 0){
                                    window.location.href = '/admin/inventory/items/edit-rows/'+encodeURI(ids);
                                }
                                {{--ids.length > 0 && AjaxCall('{{ route('post_admin_items_edit_row_many') }}', {ids}, function(res) {--}}
                                {{--    console.log(res)--}}
                                {{--})--}}
                            }
                        }
                    ],
                    "autoWidth": false,
                    columns: tableHeadArray,
                    columnDefs: [
                        {
                            orderable: false,
                            className: 'select-checkbox',
                            targets: 0,
                            width: '30px',
                            'checkboxes': {
                                'selectRow': true
                            }
                        },
                    ],
                    select: {
                        style:    'multi',
                        selector: '.select-checkbox'
                    },
                    exportOptions: {
                        modifier: {
                            selected: null
                        },
                        columns: ':visible:not(.not-exported)',
                        rows: '.selected'
                    },
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            console.log(column)
                            var input = document.createElement("input");
                            column[0][0] !== 0 && column[0][0] !== 5 && column[0][0] !== 3 && $(input).appendTo($(column.footer()).empty())
                                .on('keyup change clear', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        });
                    }
                });

                table.on( 'select', function ( e, dt, type, indexes ) {
                    if ( type === 'row' ) {
                        if($('tr[role="row"].selected').length !== 0) {
                            console.log(111)

                            $('.edit_hidden_button').removeClass('d-none');
                            $('.edit_hidden_button').addClass('d-block');
                        }
                    }
                });

                table.on( 'deselect', function ( e, dt, type, indexes ) {
                    if ( type === 'row' ) {
                        if($('tr[role="row"].selected').length === 0) {
                            console.log(222)

                            $('.edit_hidden_button').removeClass('d-block');
                            $('.edit_hidden_button').addClass('d-none');
                        }
                    }
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

                $("body").on( "change", ".select_all_checkbox",function(e) {
                    // console.log(table.rows({selected: true}).length);
                    if ($(this).is( ":checked" )) {
                        table.rows(  ).select();
                    } else {
                        table.rows(  ).deselect();
                    }
                });
            }

            tableInit(
                "stock_table",
                [
                    {id: '#', name: 'id'},
                    {id: 'id', name: 'id'},
                    {id: 'Name', name: 'name'},
                    {id: 'Image', name: 'image'},
                    {id: 'Added/Last Modified Date', name: 'created_at'},
                    {id: 'Actions', name: 'actions'}
                ],
                '#table_head_id',
                [
                    {  data: null,
                        name: 'id',
                        defaultContent: '',
                        className: 'select-checkbox',
                        orderable: false},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'stock_translations.name'},
                    {data: 'image', name: 'image'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ],
                '#stocks-table',
                "{!! route('datatable_all_stocks_offers') !!}"
            )
        });

    </script>
@stop
