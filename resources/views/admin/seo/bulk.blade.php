@extends('layouts.admin')
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading">
            <h2 class="m-0">SEO</h2>
        </div>
         <div class="card-body panel-body">
             <ul class="nav nav-tabs" id="myTab" role="tablist">
                 <li class="nav-item">
                     <a class="nav-link active" id="shipping-tab" href="{!! route('admin_seo_bulk') !!}" role="tab"
                        aria-controls="shipping" aria-selected="false">Posts</a>
                 </li>
                 <li class="nav-item ">
                     <a class="nav-link" id="shipping-tab" href="{!! route('admin_seo_bulk_products') !!}" role="tab"
                        aria-controls="shipping" aria-selected="false">Products</a>
                 </li>
             </ul>
             <div class="pt-25">
                 <div class="card panel panel-default">

                     <div class="card-header panel-heading clearfix">
                         <div class="pull-left">
                             <h3 class="m-0">{!! __('orders') !!}</h3>
                         </div>
                     </div>
                     <div class="card-body panel-body">
                         <select name="table_head" id="table_head_id" class="selectpicker" multiple>
                             <option value="#" data-column="0" data-name="id">#</option>
                             <option value="OG title" data-column="1" data-name="og:title">OG title</option>
                             <option value="OG image" data-column="2" data-name="og:image">OG image</option>
                             <option value="OG description" data-column="3" data-name="og:description">OG description</option>
                             <option value="OG Keywords" data-column="4" data-name="og:keywords">OG Keywords</option>
                             <option value="FB title" data-column="5" data-name="fb:title">FB title</option>
                             <option value="FB image" data-column="6" data-name="fb:image">FB image</option>
                             <option value="FB description" data-column="7" data-name="fb:description">FB description</option>
                             <option value="TW title" data-column="8" data-name="tw:title">TW title</option>
                             <option value="TW image" data-column="9" data-name="tw:image">TW image</option>
                             <option value="TW description" data-column="10" data-name="tw:description">TW description</option>
                             <option value="Actions" data-column="11" data-name="actions">Actions</option>
                         </select>
                         <table id="posts-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                             <thead>
                             <tr>
                                 <th>#</th>
                                 <th>OG title</th>
                                 <th>OG image</th>
                                 <th>OG description</th>
                                 <th>OG Keywords</th>

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

@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">

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
                    columns: tableHeadArray,
                    order: [[0, 'desc']]
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
                "bulk_table",
                [
                    {id: '#', name: 'id'},
                    {id: 'OG title', name: 'og:title'},
                    {id: 'OG image', name: 'og:image'},
                    {id: 'OG description', name: 'og:description'},
                    {id: 'OG Keywords', name: 'og:keywords'},
                    {id: 'FB title', name: 'fb:title'},
                    {id: 'FB image', name: 'fb:image'},
                    {id: 'FB description', name: 'fb:description'},
                    {id: 'TW title', name: 'tw:title'},
                    {id: 'TW image', name: 'tw:image'},
                    {id: 'TW description', name: 'tw:description'},
                    {id: 'Actions', name: 'actions'}
                ],
                '#table_head_id',
                [
                    {data: 'id', name: 'id'},
                    {data: 'og:title', name: 'og:title'},
                    {data: 'og:image', name: 'og:image'},
                    {data: 'og:description', name: 'og:description'},
                    {data: 'og:keywords', name: 'og:keywords'},
                    {data: 'fb:title', name: 'fb:title'},
                    {data: 'fb:image', name: 'fb:image'},
                    {data: 'fb:description', name: 'fb:description'},
                    {data: 'tw:title', name: 'tw:title'},
                    {data: 'tw:image', name: 'tw:image'},
                    {data: 'tw:description', name: 'tw:description'},
                    {data: 'actions', name: 'actions'}
                ],
                '#posts-table',
                "{!! route('datatable_bulk_posts') !!}"
            )
        });
    </script>
@stop
