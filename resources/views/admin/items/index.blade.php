@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
                <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="info-tab" href="{!! route('admin_items') !!}" role="tab"
                           aria-controls="general" aria-selected="true" aria-expanded="true">Items</a>
                    </li>
                    @ok('admin_inventory_purchase')
                    <li class="nav-item">
                        <a class="nav-link " id="general-tab" href="{!! route('admin_items_archives') !!}" role="tab"
                           aria-controls="accounts" aria-selected="true" aria-expanded="true">Archive</a>
                    </li>
                    @endok
                </ul>
            </div>

            <div class="tab-content w-100">
                <div class="card panel panel-default">
                    <div class="d-flex justify-content-between px-4 mt-2">
                        <div>
                            <select name="table_head" id="table_head_id" class="selectpicker text-black" multiple>
                                <!-- <option value="#" data-column="0" data-name="#" selected disabled>#</option>
                                <option value="#" data-column="1" data-name="id" selected disabled>id</option> -->
                                {{--                            <option value="Name" data-column="2" data-name="name" selected>Name</option>--}}
                                <option value="Short Description" data-column="3" data-name="short_description" selected>Short Description</option>
                                <option value="Brand" data-column="4" data-name="brand_id" selected>Brand</option>
                                <option value="Barcode" data-column="5" data-name="barcode_id" selected>Barcode</option>
                                <option value="Quantity" data-column="6" data-name="quantity" selected>Quantity</option>
                                <option value="Category" data-column="7" data-name="category" selected>Category</option>
                                <option value="Price" data-column="8" data-name="price" selected>Price</option>
                                <option value="Status" data-column="9" data-name="status" selected>Status</option>
                                <option value="Created At" data-column="10" data-name="created_at">Created At</option>
                                {{--                            <option value="Actions" data-column="11" data-name="actions" selected>Actions</option>--}}
                            </select>
                        </div>
                        @ok('admin_items_new')
                        <div class="ml-1">
                            <a  href="{!! route('admin_items_new') !!}" class="btn btn-primary">New Item</a>
                        </div>
                        @endok
                    </div>
{{--                    <div class="card-header panel-heading d-flex justify-content-between">--}}
{{--                        <h2 class="m-0 pull-left">Items</h2>--}}
{{--                        --}}
{{--                    </div>--}}
                    <div class="card-body panel-body pt-0">

                        <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th><div class="text-center"><input type="checkbox" class="select_all_checkbox"/></div></th>
                                <th>id</th>
                                <th>Name</th>
                                <th>Short Description</th>
                                <th>Brand</th>
                                <th>Barcode</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Select</th>
                                <th>id</th>
                                <th>Name</th>
                                <th>Short Description</th>
                                <th>Brand</th>
                                <th>Barcode</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="svg_barcode" style="display: none"></div>
        <div id="qr_codes"></div>
        <svg id="svg_barcode_print" style="display: none"></svg>
    </div>

    <div class="edit-list--container"  id="heading">
        <div class="d-flex justify-content-end heading">
            <button class="heading-btn editing_minimize"><i class="fa fa-minus"></i></button>
            <button class="heading-btn editing_max"><i class="fa fa-window-maximize"></i></button>
            <button class="heading-btn editing_close"><i class="fa fa-times"></i></button>
        </div>
        <div class="edit-list--container-content main-scrollbar">

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
    <link href="/public/plugins/select2/select2.min.css" rel="stylesheet"/>
@stop
@section('js')
    <script src="/public/plugins/select2/select2.full.min.js"></script>

    <script>
        $(function () {
            var table;

            $("body").on('click','.edit-row',function () {
                let id = $(this).data('id');

                AjaxCall("{!! route('post_admin_items_edit_row') !!}", {id:id}, function (res) {
                    if (!res.error) {
                        $('.edit-list--container .edit-list--container-content').html(res.html);
                        $('.edit-list--container .custom-select').select2();
                        $('.edit-list--container').show();
                        $(".edit-list--container").draggable({ handle:'.heading'});
                    }
                });
            });


            $("body").on('click','.edit_item_custom',function (e) {
                e.preventDefault();
                let form = $(this).closest('form').serialize();

                AjaxCall("{!! route('post_admin_items_edit_row_save') !!}", form, function (res) {
                    if (!res.error) {

                        $('.edit-list--container').find('.edit-list--container-content').empty();
                        $('body').css('overflow', 'unset');
                        $('.edit-list--container').hide();
                        $(".edit-list--container").draggable('destroy');

                        $('.edit-list--container').removeClass('max-wrap');
                        $('.edit-list--container').removeClass('min-wrap');
                        $('body').css('overflow', 'unset');
                        table.ajax.reload();
                    }
                });
            });



            const shortAjax = function (URL, obj = {}, cb) {
                fetch(URL, {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify(obj)
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (json) {
                        return cb(json);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            };


            $('body').on('click', '.delete_rows', function() {
                const ids = [];
                $('#stocks-table tbody tr.selected').each(function() {
                    ids.push($(this).find('td.id_n').text());
                });


                if(ids.length > 0){
                    AjaxCall("{!! route('post_admin_items_multi_delete') !!}", {idS:ids}, function (res) {
                        if (!res.error) {
                            table.ajax.reload();
                            $('#confirm_delete').modal('hide');
                        }
                    });
                }
            });

            const action = function ( dt, url, method, type ) {
                const ids = [];
                dt.rows( { selected: true } ).data().map((r) => ids.push(r.id));
                console.log('data', ids);
                shortAjax(url, {method, type, ids}, (res) => console.log('res', res), (err) => console.log('err', err));
            };


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

                const barcode_settings = JSON.parse($('#barcode-settings').text());

                let width = Number(barcode_settings.width);
                let height = Number(barcode_settings.height);
                let margin = Number(barcode_settings.margin);
                let back_color = barcode_settings.background_color;
                let line_color = barcode_settings.line_color;
                let text_align = barcode_settings.text_align;
                let text_font = barcode_settings.text_font;
                let format = barcode_settings.format;
                let font_size = Number(barcode_settings.font_size);
                let text_margin = Number(barcode_settings.text_margin);
                let displayValue = Boolean(Number(barcode_settings.text_switch));
                let bold = Number(barcode_settings.bold);
                let italic = Number(barcode_settings.italic);
                let fontOptions = '';

                if(bold && italic) {
                    fontOptions = 'bold italic'
                } else if(bold) {
                    fontOptions = 'bold'
                } else if(italic) {
                    fontOptions = 'italic'
                } else {
                    fontOptions = ''
                }


                table = $(tableId).DataTable({
                    ajax: ajaxUrl,
                    "processing": true,
                    "serverSide": true,
                    "bPaginate": true,
                    "scrollX": true,
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
                        // 'selectAll',
                        // 'selectNone',
                        // {
                        //     extend: 'collection',
                        //     text: 'Export',
                        //     buttons: [

                        //     ]
                        // },
                        {
                            extend: 'collection',
                            text: 'Download',
                            buttons: [
                                {
                                    text: 'Barcode',
                                    action: function(e, dt) {
                                        const ids = [];
                                        $('#stocks-table tbody tr.selected').each(function() {
                                            ids.push($(this).find('td.id_n').text());
                                        });
                                        console.log(ids)
                                        $('.loader_container').css('display', 'block');
                                        $('body').css('overflow', 'hidden');
                                        if(ids.length === 0) {
                                            $('.loader_container').css('display', 'none');
                                            $('body').css('overflow', 'auto');
                                            return false;
                                        }
                                        shortAjax('/admin/find/items/barcodes', {ids}, function(res) {

                                            res.barcodes.map(function(barcode) {
                                                $('#svg_barcode').append(`<svg id="svg_${barcode.value}"></svg>`)
                                            });
                                            res.barcodes.map(function(barcode, key) {
                                                JsBarcode(`#svg_${barcode.value}`, barcode.value, {
                                                    format,
                                                    font: text_font,
                                                    fontSize: font_size,
                                                    textMargin: text_margin,
                                                    height,
                                                    width,
                                                    margin,
                                                    background: back_color,
                                                    lineColor: line_color,
                                                    textAlign: text_align,
                                                    fontOptions,
                                                    displayValue,
                                                })
                                                    .render();
                                                $(`#svg_${barcode.value}`).css('display', 'none');
                                                $('.loader_container').css('display', 'none');
                                                $('body').css('overflow', 'auto');
                                                saveSvgAsPng(document.getElementById(`svg_${barcode.value}`), `${barcode.file_name.replace(/\s/g, '_').trim()}.png`, {scale: 10});

                                                // var s = new XMLSerializer().serializeToString(document.getElementById('svg_barcode'));
                                                // var encodedData = window.btoa(s);
                                                //
                                                // var img = $(`<img id="${'barcode_'+value}">`); //Equivalent: $(document.createElement('img'))
                                                // var li = $('<li style="list-style-type: none; margin: 0 20px 20px 0"></li>');
                                                // img.attr('src', 'data:image/svg+xml;base64,' + encodedData);
                                                // img.appendTo(li);
                                                //
                                                // li.appendTo('.barcodes_image_list');
                                                // console.log(encodedData);
                                            });
                                            // $('#barcodeModalPrint').modal('show');
                                        });
                                    }
                                },
                                {
                                    text: 'QR Code',
                                    action: function (e, dt) {
                                        const ids = [];
                                        $('#stocks-table tbody tr.selected').each(function() {
                                            ids.push($(this).find('td.id_n').text());
                                        });

                                        $('.loader_container').css('display', 'block');
                                        $('body').css('overflow', 'hidden');

                                        function toDataURL(url) {
                                            return fetch(url).then((response) => {
                                                return response.blob();
                                            }).then(blob => {
                                                return URL.createObjectURL(blob);
                                            });
                                        }

                                        async function forceDownload(url, fileName){
                                            const a = document.createElement("a");
                                            a.href = await toDataURL(url);
                                            a.download = fileName;
                                            document.body.appendChild(a);
                                            a.click();
                                            document.body.removeChild(a);
                                        }
                                        if(ids.length === 0) {
                                            $('.loader_container').css('display', 'none');
                                            $('body').css('overflow', 'auto');
                                            return false;
                                        }
                                        shortAjax('/admin/find/items/qrcodes', {ids}, function(res) {

                                            console.log(res.qrcodes);
                                            $('.loader_container').css('display', 'none');
                                            $('body').css('overflow', 'auto');

                                            res.qrcodes.map(function(arr, key) {
                                                setTimeout(function() {
                                                    arr.map(function(er, key) {
                                                        forceDownload(er.url, er.name.replace(/\s/g, '_').trim() + '.png');
                                                    });
                                                }, key*3000);
                                            });
                                        });
                                    }
                                }
                            ]
                        },
                        {
                            extend: 'collection',
                            text: 'Print',
                            buttons: [
                                {
                                    text: 'Barcode',
                                    action: function ( e, dt, node, config ) {
                                        const ids = [];
                                        $('#stocks-table tbody tr.selected').each(function() {
                                            ids.push($(this).find('td.id_n').text());
                                        });


                                        ids.length > 0 && shortAjax('/admin/find/items/barcodes_print', {ids}, function(res) {
                                            console.log(res)
                                        })
                                    }
                                },
                                {
                                    text: 'QR Code',
                                    action: function ( e, dt, node, config ) {
                                        const ids = [];
                                        $('#stocks-table tbody tr.selected').each(function() {
                                            ids.push($(this).find('td.id_n').text());
                                        });

                                        ids.length > 0 && shortAjax('/admin/find/items/qr_codes_print', {ids}, function(res) {
                                            console.log(res)
                                        })
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
                                            ids.push($(this).find('td.id_n').text());
                                        });


                                        if(ids.length > 0){
                                            // alert(666)
                                            window.location.href = '/admin/inventory/items/edit-rows/'+encodeURI(ids);
                                        }
                                        {{--ids.length > 0 && AjaxCall('{{ route('post_admin_items_edit_row_many') }}', {ids}, function(res) {--}}
                                        {{--    console.log(res)--}}
                                        {{--})--}}
                                    },
                                }
                            ]
                        },
                        // {
                        //     text: 'Edit',
                        //     className: 'd-none edit_hidden_button',
                        //     action: function ( e, dt, node, config ) {
                        //         const ids = [];
                        //         $('#stocks-table tbody tr.selected').each(function() {
                        //             ids.push($(this).find('td.id_n').text());
                        //         });

                        //         if(ids.length > 0){
                        //             window.location.href = '/admin/inventory/items/edit-rows/'+encodeURI(ids);
                        //         }
                        //         {{--ids.length > 0 && AjaxCall('{{ route('post_admin_items_edit_row_many') }}', {ids}, function(res) {--}}
                        //         {{--    console.log(res)--}}
                        //         {{--})--}}
                        //     }
                        // }
                    ],
                    // language: {
                    //     buttons: {
                    //         selectAll: "Select all items",
                    //         selectNone: "Select none"
                    //     }
                    // },
                    "autoWidth": false,
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
                        { className: "id_n", "targets": [ 1 ], width: '30px' },
                        { "targets": [ 11 ], width: '20%' },
                    ],
                    "order": [[ 1, "asc" ]],
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
                    columns: tableHeadArray,
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            console.log(column)
                            var input = document.createElement("input");
                            column[0][0] !== 0 && column[0][0] !== 11 && $(input).appendTo($(column.footer()).empty())
                                .on('keyup change clear', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        });
                    }
                });

                // edit_hidden_button

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
                    {id: 'Short Description', name: 'short_description'},
                    {id: 'Brand', name: 'brand_id'},
                    {id: 'Barcode', name: 'barcode_id'},
                    {id: 'Quantity', name: 'quantity'},
                    {id: 'Category', name: 'category'},
                    {id: 'Price', name: 'price'},
                    {id: 'Status', name: 'status'},
                    {id: 'Created At', name: 'created_at'},
                    {id: 'Actions', name: 'actions'}
                ],
                '#table_head_id',
                [
                    {  data: null,
                        name: 'items.id',
                        defaultContent: '',
                        className: 'select-checkbox',
                        orderable: false},
                    {data: 'id', name: 'items.id'},
                    {data: 'name', name: 'item_translations.name'},
                    {data: 'short_description', name: 'item_translations.short_description'},
                    {data: 'brand_id', name: 'categories_translations.name'},
                    {data: 'barcode_id', name: 'barcodes.code'},
                    {data: 'quantity', name: 'items.quantity'},
                    {data: 'category', name: 'categories_translations.name'},
                    {data: 'default_price', name: 'default_price'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ],
                '#stocks-table',
                "{!! route('datatable_all_items') !!}"
            )

            {{--$('#stocks-table tfoot th').each( function () {--}}
                {{--var title = $(this).text();--}}
                {{--$(this).html( '<input type="text" placeholder="Search '+title+'" />' );--}}
            {{--} );--}}

            {{--// Apply the search--}}


            {{--var table =  $('#stocks-table').DataTable({--}}
                {{--ajax: "{!! route('datatable_all_items') !!}",--}}
                {{--"processing": true,--}}
                {{--"serverSide": true,--}}
                {{--"bPaginate": true,--}}
                {{--// responsive: true,--}}
                {{--"scrollX": true,--}}
                {{--"pagingType": "full_numbers",--}}
                {{--dom: 'Bfrtip',--}}
                {{--buttons: [--}}
                    {{--'csv', 'excel', 'pdf', 'print'--}}
                {{--],--}}
                {{--columns: [--}}
                    {{--{data: 'id', name: 'id'},--}}
                    {{--{data: 'name', name: 'item_translations.name'},--}}
                    {{--{data: 'type', name: 'type'},--}}
                    {{--{data: 'brand_id', name: 'brand_id'},--}}
                    {{--{data: 'barcode_id', name: 'barcode_id'},--}}
                    {{--{data: 'quantity', name: 'quantity'},--}}
                    {{--{data: 'category', name: 'category'},--}}
                    {{--{data: 'created_at', name: 'created_at'},--}}
                    {{--{data: 'actions', name: 'actions', orderable: false, searchable: false}--}}
                {{--],--}}

            {{--});--}}
            $('body').on('click', '.edit-list--container .heading-btn', function(ev) {
                if($(ev.target).closest('.heading-btn').hasClass('editing_close')) {
                    $('.edit-list--container').find('.edit-list--container-content').empty();
                    $('body').css('overflow', 'unset');
                    $('.edit-list--container').hide();
                    $(".edit-list--container").draggable('destroy');

                    $('.edit-list--container').removeClass('max-wrap');
                    $('.edit-list--container').removeClass('min-wrap');
                    $('body').css('overflow', 'unset');
                } else if($(ev.target).closest('.heading-btn').hasClass('editing_max')) {
                    i = $(ev.target).closest('.heading-btn').find('i');

                    if(!$('.edit-list--container').hasClass('max-wrap')) {
                        if($(".edit-list--container").data('draggable')) {
                            $(".edit-list--container").draggable('destroy');
                        }
                        min = $('.edit-list--container').hasClass('min-wrap');
                        max = true;
                        min && $('.edit-list--container').removeClass('min-wrap');
                        i.removeClass('fa-window-maximize');
                        i.addClass('fa-window-restore');
                        $('.edit-list--container').addClass('max-wrap');
                        $('body').css('overflow', 'hidden');
                    } else {
                        max = false;
                        $(".edit-list--container").draggable({ handle:'.heading'});
                        min && $('.edit-list--container').addClass('min-wrap');
                        i.removeClass('fa-window-restore');
                        i.addClass('fa-window-maximize');
                        $('.edit-list--container').removeClass('max-wrap');
                        $('body').css('overflow', 'unset');
                    }
                } else if($(ev.target).closest('.heading-btn').hasClass('editing_minimize')) {
                    if($('.edit-list--container').hasClass('min-wrap')) {
                        if(max) {
                            i.removeClass('fa-window-maximize');
                            i.addClass('fa-window-restore');
                            $('.edit-list--container').addClass('max-wrap');
                            $('body').css('overflow', 'hidden');
                        } else {
                            $(".edit-list--container").draggable({ handle:'.heading'});

                        }
                        $('.edit-list--container').removeClass('min-wrap');
                    } else {
                        if(max) {
                            i.removeClass('fa-window-restore');
                            i.addClass('fa-window-maximize');
                            $('.edit-list--container').removeClass('max-wrap');
                            $('body').css('overflow', 'unset');
                        }
                        $('.edit-list--container').addClass('min-wrap');
                    }
                }
            });

        });

    </script>
@stop
