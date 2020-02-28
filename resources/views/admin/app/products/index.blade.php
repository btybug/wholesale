@extends('layouts.admin',['activePage'=>'discounts'])
@section('content')
    <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
        <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs">
            @foreach($warehouse as $key=>$warehous)
                <li class="nav-item position-relative">
                    <div class="position-absolute admin-tab-icon-wrap">
                        @if($warehous->status)
                            <a href="{!! route('admin_app_draft_shop',$warehous->id) !!}" class="btn btn-warning">
                                <i class="fas fa-archive"></i>
                            </a>
                        @else
                            <a href="{!! route('admin_app_activate_shop',$warehous->id) !!}" class="btn btn-info">
                                <i class="fas fa-check"></i>
                            </a>
                        @endif
                        <a href="{!! route('admin_app_drop_shop',$warehous->id) !!}" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                    <a class="nav-link @if($q ==$warehous->id)active @endif"
                       href="{!! route('admin_app_products',$warehous->id) !!}">
                        {!! $warehous->name !!}
                    </a>
                </li>
            @endforeach

        </ul>
        <div class="button-area">
            <a class="btn btn-info add-category text-white" data-toggle="modal" data-target="#store_modal"><span
                    class="icon-plus mr-1"><i
                        class="fa fa-plus"></i></span>Add new</a>
        </div>
    </div>
    @if($q)
        <button type="button" class="btn btn-info select-products"
                data-action="{!! route('admin_app_not_selected_products',$q) !!}">
            Select
        </button>
    @endif
    <ul class="get-all-products-tab stickers--all--lists">

    </ul>
    @if($current && !$current->status)
        <h2 class="text-red">This Warehouse is disabled</h2>
    @endif
    <div class="tab-content w-100">
        <div class="card panel panel-default">
            <div class="d-flex justify-content-between px-4 mt-2">
                <div>
                    <select name="table_head" id="table_head_id" class="selectpicker text-black" multiple>
                        <!-- <option value="#" data-column="0" data-name="#" selected disabled>#</option>
                        <option value="#" data-column="1" data-name="id" selected disabled>id</option> -->
                        {{--                            <option value="Name" data-column="2" data-name="name" selected>Name</option>--}}
                        <option value="Short Description" data-column="3" data-name="short_description" selected>Short
                            Description
                        </option>
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
            </div>
            {{--                    <div class="card-header panel-heading d-flex justify-content-between">--}}
            {{--                        <h2 class="m-0 pull-left">Items</h2>--}}
            {{--                        --}}
            {{--                    </div>--}}
            <div class="card-body panel-body pt-0">

                <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>
                            <div class="text-center"><input type="checkbox" class="select_all_checkbox"/></div>
                        </th>
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
    <div class="modal fade select-products__modal" id="productsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Products</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <select class="form-control search_option_js">
                                <option value="general" selected>General</option>
                                <option value="brand">Brands</option>
                                <option value="category">Categories</option>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control search-attr" id="search-product"
                                   placeholder="Search">
                            <select class="form-control d-none" id="brand_select">

                            </select>
                            <select class="form-control d-none" id="category_select">

                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center mb-2">
                        <input type="checkbox" class="all_select_products_js" style="margin: 0 18.240px"/>
                        <p class="mb-0">Select All</p>
                    </div>
                    <ul class="all-list modal-stickers--list" id="stickers-modal-list">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary done_select_product_js" data-dismiss="modal"
                            data-ajax="true">Add
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade edit_price_modal" id="editPriceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Price</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary done_edit_price_js" data-ajax="true">Edit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <input type="hidden" id="current-shop" value="{!! $q !!}">

    <div class="modal fade select-products__modal" id="store_modal" tabindex="-1" role="dialog"
         aria-labelledby="store_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            {!! Form::open(['url'=>route('admin_app_import_shop')]) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="store_modalLabel">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-start align-items-center mb-2">
                        <input type="checkbox" class="all_select_products_js" style="margin: 0 18.240px"/>
                        <p class="mb-0">Select All</p>
                    </div>
                    <ul class="all-list p-0 modal-stickers--list" id="stickers-modal-list">
                        @foreach($notImportedWarehouse as $w)
                            <li class="option-elm-modal">
                                <div class="btn btn-primary add-related-event searchable">
                                    <input type="checkbox" name="warehouse[]" value="{!! $w->id !!}"
                                           class="select_product_js">
                                </div>
                                <a href="#">{!! $w->name !!}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary ">Add</button>
                </div>
            </div>
            {!! Form::close() !!}
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

            $("body").on('click', '.edit-row', function () {
                let id = $(this).data('id');

                AjaxCall("{!! route('post_admin_items_edit_row') !!}", {id: id}, function (res) {
                    if (!res.error) {
                        $('.edit-list--container .edit-list--container-content').html(res.html);
                        $('.edit-list--container .custom-select').select2();
                        $('.edit-list--container').show();
                        $(".edit-list--container").draggable({handle: '.heading'});
                    }
                });
            });


            $("body").on('click', '.edit_item_custom', function (e) {
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


            $('body').on('click', '.delete_rows', function () {
                const ids = [];
                $('#stocks-table tbody tr.selected').each(function () {
                    ids.push($(this).find('td.id_n').text());
                });


                if (ids.length > 0) {
                    AjaxCall("{!! route('post_admin_items_multi_delete') !!}", {idS: ids}, function (res) {
                        if (!res.error) {
                            table.ajax.reload();
                            $('#confirm_delete').modal('hide');
                        }
                    });
                }
            });

            const action = function (dt, url, method, type) {
                const ids = [];
                dt.rows({selected: true}).data().map((r) => ids.push(r.id));
                console.log('data', ids);
                shortAjax(url, {method, type, ids}, (res) => console.log('res', res), (err) => console.log('err', err));
            };


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

                if (bold && italic) {
                    fontOptions = 'bold italic'
                } else if (bold) {
                    fontOptions = 'bold'
                } else if (italic) {
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
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
                            extend: 'collection',
                            text: 'Download',
                            buttons: [
                                {
                                    text: 'Barcode',
                                    action: function (e, dt) {
                                        const ids = [];
                                        $('#stocks-table tbody tr.selected').each(function () {
                                            ids.push($(this).find('td.id_n').text());
                                        });
                                        $('.loader_container').css('display', 'block');
                                        $('body').css('overflow', 'hidden');
                                        if (ids.length === 0) {
                                            $('.loader_container').css('display', 'none');
                                            $('body').css('overflow', 'auto');
                                            return false;
                                        }
                                        shortAjax('/admin/find/items/barcodes', {ids}, function (res) {

                                            res.barcodes.map(function (barcode) {
                                                $('#svg_barcode').append(`<svg id="svg_${barcode.value}"></svg>`)
                                            });
                                            res.barcodes.map(function (barcode, key) {
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
                                        $('#stocks-table tbody tr.selected').each(function () {
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

                                        async function forceDownload(url, fileName) {
                                            const a = document.createElement("a");
                                            a.href = await toDataURL(url);
                                            a.download = fileName;
                                            document.body.appendChild(a);
                                            a.click();
                                            document.body.removeChild(a);
                                        }

                                        if (ids.length === 0) {
                                            $('.loader_container').css('display', 'none');
                                            $('body').css('overflow', 'auto');
                                            return false;
                                        }
                                        shortAjax('/admin/find/items/qrcodes', {ids}, function (res) {

                                            console.log(res.qrcodes);
                                            $('.loader_container').css('display', 'none');
                                            $('body').css('overflow', 'auto');

                                            res.qrcodes.map(function (arr, key) {
                                                setTimeout(function () {
                                                    arr.map(function (er, key) {
                                                        forceDownload(er.url, er.name.replace(/\s/g, '_').trim() + '.png');
                                                    });
                                                }, key * 3000);
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
                                    action: function (e, dt, node, config) {
                                        const ids = [];
                                        $('#stocks-table tbody tr.selected').each(function () {
                                            ids.push($(this).find('td.id_n').text());
                                        });


                                        ids.length > 0 && shortAjax('/admin/find/items/barcodes_print', {ids}, function (res) {
                                            console.log(res)
                                        });
                                    }
                                },
                                {
                                    text: 'QR Code',
                                    action: function (e, dt, node, config) {
                                        const ids = [];
                                        $('#stocks-table tbody tr.selected').each(function () {
                                            ids.push($(this).find('td.id_n').text());
                                        });

                                        ids.length > 0 && shortAjax('/admin/find/items/qr_codes_print', {ids}, function (res) {
                                            console.log(res)
                                        });
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
                                    attr: {
                                        'data-toggle': 'modal',
                                        'data-target': '#confirm_delete'
                                    },
                                    action: function () {

                                        const ids = [];
                                        $('#stocks-table tbody tr.selected').each(function () {
                                            ids.push($(this).find('.classes__id').text());
                                        });


                                        if (ids.length > 0) {
                                            // alert(666)
                                        }
                                    }
                                },
                                {
                                    text: 'Edit Price',
                                    action: function (e, dt, node, config) {
                                        $('#editPriceModal .modal-body').html('');
                                        $('#stocks-table tbody tr.selected').each(function () {
                                            const edit_button = $(this).find('.edit_price_js');
                                            const id = edit_button.data('id');
                                            const name = edit_button.data('name');
                                            const price = edit_button.data('price');
                                            $('#editPriceModal .modal-body').append(`<div class="form-group row"><label class="col-md-9 col-form-label">${name}</label><div class="col-md-3"><input type="number" class="form-control price_input" value="${price}" aria-label="Small" aria-describedby="inputGroup-sizing-sm" data-name="${name}" data-id="${id}"></div></div>`)
                                        });
                                        $('#editPriceModal').modal('show');

                                    }
                                }
                            ]
                        },

                    ],
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
                        {className: "id_n", "targets": [1], width: '30px'},
                        {"targets": [11], width: '20%'},
                    ],
                    "order": [[1, "asc"]],
                    select: {
                        style: 'multi',
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

                table.on('select', function (e, dt, type, indexes) {
                    if (type === 'row') {
                        if ($('tr[role="row"].selected').length !== 0) {
                            console.log(111)

                            $('.edit_hidden_button').removeClass('d-none');
                            $('.edit_hidden_button').addClass('d-block');
                        }
                    }
                });

                table.on('deselect', function (e, dt, type, indexes) {
                    if (type === 'row') {
                        if ($('tr[role="row"].selected').length === 0) {
                            console.log(222)

                            $('.edit_hidden_button').removeClass('d-block');
                            $('.edit_hidden_button').addClass('d-none');
                        }
                    }
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

                $("body").on("change", ".select_all_checkbox", function (e) {
                    // console.log(table.rows({selected: true}).length);
                    if ($(this).is(":checked")) {
                        table.rows().select();
                    } else {
                        table.rows().deselect();
                    }
                });
            }

            @if($current && $current->status)
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
                    {
                        data: null,
                        name: 'items.id',
                        defaultContent: '',
                        className: 'select-checkbox',
                        orderable: false
                    },
                    {data: 'id', name: 'items.id'},
                    {data: 'name', name: 'item_translations.name'},
                    {data: 'short_description', name: 'item_translations.short_description'},
                    {data: 'brand_id', name: 'categories_translations.name'},
                    {data: 'barcode_id', name: 'barcodes.code'},
                    {data: 'quantity', name: 'items.quantity'},
                    {data: 'category', name: 'categories_translations.name'},
                    {data: 'price', name: 'price'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ],
                '#stocks-table',
                "{!! route('datatable_all_app_items',$q) !!}"
            );
            @endif


            $('body').on('click', '.edit-list--container .heading-btn', function (ev) {
                if ($(ev.target).closest('.heading-btn').hasClass('editing_close')) {
                    $('.edit-list--container').find('.edit-list--container-content').empty();
                    $('body').css('overflow', 'unset');
                    $('.edit-list--container').hide();
                    $(".edit-list--container").draggable('destroy');

                    $('.edit-list--container').removeClass('max-wrap');
                    $('.edit-list--container').removeClass('min-wrap');
                    $('body').css('overflow', 'unset');
                } else if ($(ev.target).closest('.heading-btn').hasClass('editing_max')) {
                    i = $(ev.target).closest('.heading-btn').find('i');

                    if (!$('.edit-list--container').hasClass('max-wrap')) {
                        if ($(".edit-list--container").data('draggable')) {
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
                        $(".edit-list--container").draggable({handle: '.heading'});
                        min && $('.edit-list--container').addClass('min-wrap');
                        i.removeClass('fa-window-restore');
                        i.addClass('fa-window-maximize');
                        $('.edit-list--container').removeClass('max-wrap');
                        $('body').css('overflow', 'unset');
                    }
                } else if ($(ev.target).closest('.heading-btn').hasClass('editing_minimize')) {
                    if ($('.edit-list--container').hasClass('min-wrap')) {
                        if (max) {
                            i.removeClass('fa-window-maximize');
                            i.addClass('fa-window-restore');
                            $('.edit-list--container').addClass('max-wrap');
                            $('body').css('overflow', 'hidden');
                        } else {
                            $(".edit-list--container").draggable({handle: '.heading'});

                        }
                        $('.edit-list--container').removeClass('min-wrap');
                    } else {
                        if (max) {
                            i.removeClass('fa-window-restore');
                            i.addClass('fa-window-maximize');
                            $('.edit-list--container').removeClass('max-wrap');
                            $('body').css('overflow', 'unset');
                        }
                        $('.edit-list--container').addClass('min-wrap');
                    }
                }
            });

            $('body').on('click', '.app-product-status', function (ev) {
                const url = $(ev.target).data('href');

                AjaxCall(url, {}, function (res) {
                    if (!res.error) {
                        table.ajax.reload();
                    }
                });
            })

        });

    </script>
@stop
