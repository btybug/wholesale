@extends('layouts.admin')
@section('content')
    <div class="card panel panel-default border-0 bg-transparent">
{{--        <div class="card-header panel-heading">--}}
{{--            <h2 class="m-0">SEO</h2>--}}
{{--        </div>--}}
        <div class="card-body panel-body px-0">
            <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
            <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="shipping-tab" href="{!! route('admin_seo_bulk') !!}" role="tab"
                       aria-controls="shipping" aria-selected="false">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="shipping-tab" href="{!! route('admin_seo_bulk_products') !!}" role="tab"
                       aria-controls="shipping" aria-selected="false">Products</a>
                </li>
                @ok('admin_seo_pages')
                <li class="nav-item ">
                    <a class="nav-link" id="admin_seo_pages" href="{!! route('admin_seo_bulk_pages') !!}" role="tab"
                       aria-controls="shipping" aria-selected="false">Pages</a>
                </li>
                @endok
                @ok('admin_seo_brands')
                <li class="nav-item ">
                    <a class="nav-link" id="admin_seo_pages" href="{!! route('admin_seo_bulk_brands') !!}" role="tab"
                       aria-controls="shipping" aria-selected="false">Brands</a>
                </li>
                @endok
            </ul>
            </div>
            <div class="pt-25">
                <div class="card panel panel-default">
{{--                    <div class="card-header panel-heading d-flex flex-wrap justify-content-between">--}}
{{--                     <h3 class="m-0 mr-1">Inventory</h3>--}}
{{--                        --}}
{{--                    </div>--}}
                    <div class="d-flex flex-wrap justify-content-between px-4 mt-2">
                        <div>
                            <select name="table_head" id="table_head_id" multiple class="form-control" style="width: 100%">
                                <!-- <option value="#" data-column="0" data-name="id">#</option> -->
                                <option value="Product Name" data-column="2" data-name="id">Product Name</option>
                                <option value="OG title" data-column="3" data-name="title">OG title</option>
                                <option value="OG image" data-column="4" data-name="image">OG image</option>
                                <option value="OG description" data-column="5" data-name="description">OG description</option>
                                <option value="OG Keywords" data-column="6" data-name="keywords">OG Keywords</option>
                                <option value="Robots" data-column="7" data-name="robots">Robots</option>
                                <option value="FB title" data-column="8" data-name="fb_title">FB title</option>
                                <option value="FB image" data-column="9" data-name="fb_image">FB image</option>
                                <option value="FB description" data-column="10" data-name="fb_description">FB description</option>
                                <option value="TW title" data-column="11" data-name="twitter_title">TW title</option>
                                <option value="TW image" data-column="12" data-name="twitter_image">TW image</option>
                                <option value="TW description" data-column="13" data-name="twitter_description">TW description</option>
                                <option value="Actions" data-column="14" data-name="actions">Actions</option>
                            </select>
                        </div>
                        <div><a class="btn btn-primary pull-right" href="{!! route('admin_stock_new') !!}">Add new</a></div>
                    </div>
                    <div class="card-body panel-body pt-0">

                        <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><div class="text-center"><input type="checkbox" class="select_all_checkbox"/></div></th>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>OG title</th>
                                    <th>OG image</th>
                                    <th>OG description</th>
                                    <th>OG Keywords</th>
                                    <th>Robots</th>

                                    <th>FB title</th>
                                    <th>FB image</th>
                                    <th>FB description</th>

                                    <th>TW title</th>
                                    <th>TW image</th>
                                    <th>TW description</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Select</th>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>OG title</th>
                                    <th>OG image</th>
                                    <th>OG description</th>
                                    <th>OG Keywords</th>
                                    <th>Robots</th>

                                    <th>FB title</th>
                                    <th>FB image</th>
                                    <th>FB description</th>

                                    <th>TW title</th>
                                    <th>TW image</th>
                                    <th>TW description</th>

                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="confirm_delete" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>do you really want to delete selected items?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary delete_rows">Yes</button>
            </div>
            </div>
        </div>
    </div>


@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    @stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
      $(function () {

            function tableInit(storageName, selectData, selectId, tableData, tableId, ajaxUrl) {
                if(!localStorage.getItem(storageName)) {
                    localStorage.setItem(storageName, JSON.stringify(selectData))
                }
                JSON.parse(localStorage.getItem(storageName)).map((el) => {
                    $(selectId).find(`[data-name="${el.name}"]`).attr('selected', 'selected')
                });
                $(selectId).select2({
                    multiple: true,
                    // initSelection: function (element, callback) {
                    //     var selected_items = JSON.parse(localStorage.getItem(storageName));
                    //     callback(selected_items);
                    // }
                });

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

                $('body').on('click', '.delete_rows', function() {
                    const ids = [];
                    $('#stocks-table tbody tr.selected').each(function() {
                        ids.push($(this).find('.classes__id').text());
                    });


                    if(ids.length > 0){
                        AjaxCall("{!! route('post_admin_stock_multi_delete') !!}", {idS:ids}, function (res) {
                            if (!res.error) {
                                table.ajax.reload();
                                $('#confirm_delete').modal('hide');
                            }
                        });
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
                                        columns: 'th:visible:not(:last-child)'
                                    }
                                },
                                {
                                    extend: 'csvHtml5',
                                    exportOptions: {
                                        columns: 'th:visible:not(:last-child)'
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    exportOptions: {
                                        columns: 'th:visible:not(:last-child)'
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                        columns: 'th:visible:not(:last-child)'
                                    }
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: 'th:visible:not(:last-child)'
                                    }
                                }
                            ]
                        },
                        {
                            extend: 'collection',
                            text: 'Edit',
                            className: 'd-none edit_hidden_button',
                            buttons: [
                                {
                                    text: 'Delete',
                                    attr:  {
                                        'data-toggle': 'modal',
                                        'data-target': '#confirm_delete'
                                    },
                                    action: function() {

                                        const ids = [];
                                        $('#stocks-table tbody tr.selected').each(function() {
                                            ids.push($(this).find('.classes__id').text());
                                        });


                                        if(ids.length > 0){
                                            // alert(666)
                                        }
                                    }
                                },
                                {
                                    text: 'Quick Edit',
                                    action: function ( e, dt, node, config ) {
                                        const ids = [];
                                        $('#stocks-table tbody tr.selected').each(function() {
                                            ids.push($(this).find('.classes__id').text());
                                        });


                                        if(ids.length > 0){
                                            // alert(666)
                                            window.location.href = '/admin/seo/bulk/products/edit-rows/'+encodeURI(ids);
                                        }
                                        {{--ids.length > 0 && AjaxCall('{{ route('post_admin_items_edit_row_many') }}', {ids}, function(res) {--}}
                                        {{--    console.log(res)--}}
                                        {{--})--}}
                                    },
                                }
                            ]
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
                        {
                            className: 'classes__id',
                            targets: 1,
                        }
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
                            var input = document.createElement("input");

                            column[0][0] !== 0 && column[0][0] !== 14 && $(input).appendTo($(column.footer()).empty())
                                .on('keyup change clear', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        });
                    },
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
                    localStorage.setItem(storageName, JSON.stringify(selected_items))
                }

                init();

                $(selectId).on('change.select2', function (e) {
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
                "seo_product_table",
                [
                    {id: '#', text: '#', name: 'id'},
                    {id: 'id', text: 'Id', name: 'id'},
                    {id: 'Product Name', text: 'Product Name', name: 'stock_translations.name'},
                    {id: 'OG title', text: 'OG title', name: 'og:title'},
                    {id: 'OG image', text: 'OG image', name: 'og:image'},
                    {id: 'OG description', text: 'OG description', name: 'og:description'},
                    {id: 'OG Keywords', text: 'OG Keywords', name: 'og:keywords'},
                    {id: 'Robots', text: 'Robots', name: 'robots'},
                    {id: 'FB title', text: 'FB title', name: 'fb:title'},
                    {id: 'FB image', text: 'FB image', name: 'fb:image'},
                    {id: 'FB description', text: 'FB description', name: 'fb:description'},
                    {id: 'TW title', text: 'TW title', name: 'tw:title'},
                    {id: 'TW image', text: 'TW image', name: 'tw:image'},
                    {id: 'TW description', text: 'TW description', name: 'tw:description'},
                    {id: 'Actions', text: 'Actions', name: 'actions'},
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
                    {data: 'title', name: 'title',searchable:false},
                    {data: 'image', name: 'image',searchable:false},
                    {data: 'description', name: 'description',searchable:false},
                    {data: 'keywords', name: 'keywords',searchable:false},
                    {data: 'robots', name: 'robots',searchable:false},
                    {data: 'fb_title', name: 'fb_title',searchable:false},
                    {data: 'fb_image', name: 'fb_image',searchable:false},
                    {data: 'fb_description', name: 'fb_description',searchable:false},
                    {data: 'twitter_title', name: 'twitter_title',searchable:false},
                    {data: 'twitter_image', name: 'twitter_image',searchable:false},
                    {data: 'twitter_description', name: 'twitter_description',searchable:false},
                    {data: 'actions', name: 'actions',searchable:false}
                ],
                '#stocks-table',
                "{!! route('datatable_bulk_stocks') !!}"
            )
        });
    </script>
@stop
