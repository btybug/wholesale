@extends('layouts.admin')
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading">
            <h2 class="m-0">SEO</h2>
        </div>
        <div class="card-body panel-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="shipping-tab" href="{!! route('admin_seo_bulk') !!}" role="tab"
                       aria-controls="shipping" aria-selected="false">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="shipping-tab" href="{!! route('admin_seo_bulk_products') !!}" role="tab"
                       aria-controls="shipping" aria-selected="false">Products</a>
                </li>
            </ul>
            <div class="pt-25">
                <div class="card panel panel-default">
                    <div class="card-header panel-heading clearfix">
                     <h3 class="m-0 pull-left">Inventory</h3>
                        <div class="pull-right"><a class="btn btn-primary pull-right" href="{!! route('admin_stock_new') !!}">Add new</a></div>
                    </div>
                    <div class="card-body panel-body">
                        <select name="table_head" id="table_head_id" multiple>
                            <option value="#" data-column="0" data-name="id">#</option>
                            <option value="OG title" data-column="1" data-name="og:title">OG title</option>
                            <option value="OG image" data-column="2" data-name="og:image">OG image</option>
                            <option value="OG description" data-column="3" data-name="og:description">OG description</option>
                            <option value="OG Keywords" data-column="4" data-name="og:keywords">OG Keywords</option>
                            <option value="Robots" data-column="5" data-name="robots">Robots</option>
                            <option value="FB title" data-column="6" data-name="fb:title">FB title</option>
                            <option value="FB image" data-column="7" data-name="fb:image">FB image</option>
                            <option value="FB description" data-column="8" data-name="fb:description">FB description</option>
                            <option value="TW title" data-column="9" data-name="tw:title">TW title</option>
                            <option value="TW image" data-column="10" data-name="tw:image">TW image</option>
                            <option value="TW description" data-column="11" data-name="tw:description">TW description</option>
                            <option value="Actions" data-column="12" data-name="actions">Actions</option>
                        </select>
                        <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
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
                JSON.parse(localStorage.getItem(storageName)).map((el) => {
                    $(selectId).find(`[data-name="${el.name}"]`).attr('selected', 'selected')
                });
                $(selectId).select2({
                    multiple: true,
                    initSelection: function (element, callback) {
                        var selected_items = JSON.parse(localStorage.getItem(storageName));

                        callback(selected_items);
                    }
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

                $(selectId).on('change.select2', function (e) {
                    init();
                });
            }

            tableInit(
                "seo_product_table",
                [
                    {id: '#', text: '#', name: 'id'},
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
                    {data: 'id', name: 'id'},
                    {data: 'og:title', name: 'og:title'},
                    {data: 'og:image', name: 'og:image'},
                    {data: 'og:description', name: 'og:description'},
                    {data: 'og:keywords', name: 'og:keywords'},
                    {data: 'robots', name: 'robots'},
                    {data: 'fb:title', name: 'og:title'},
                    {data: 'fb:image', name: 'og:image'},
                    {data: 'fb:description', name: 'og:description'},
                    {data: 'tw:title', name: 'og:title'},
                    {data: 'tw:image', name: 'og:image'},
                    {data: 'tw:description', name: 'og:description'},
                    {data: 'actions', name: 'actions'}
                ],
                '#stocks-table',
                "{!! route('datatable_bulk_stocks') !!}"
            )
        });
    </script>
@stop
