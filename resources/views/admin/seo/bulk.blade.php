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
                     <a class="nav-link active" id="shipping-tab" href="{!! route('admin_seo_bulk') !!}" role="tab"
                        aria-controls="shipping" aria-selected="false">Posts</a>
                 </li>
                 <li class="nav-item ">
                     <a class="nav-link" id="shipping-tab" href="{!! route('admin_seo_bulk_products') !!}" role="tab"
                        aria-controls="shipping" aria-selected="false">Products</a>
                 </li>
                 @ok('admin_seo_bulk_pages')
                 <li class="nav-item ">
                     <a class="nav-link" id="admin_seo_pages" href="{!! route('admin_seo_bulk_pages') !!}" role="tab"
                        aria-controls="shipping" aria-selected="false">Pages</a>
                 </li>
                 @endok
                 @ok('admin_seo_bulk_brands')
                 <li class="nav-item ">
                     <a class="nav-link" id="admin_seo_pages" href="{!! route('admin_seo_bulk_brands') !!}" role="tab"
                        aria-controls="shipping" aria-selected="false">Brands</a>
                 </li>
                 @endok
             </ul>
             </div>
             <div class="pt-25">
                 <div class="card panel panel-default">

{{--                     <div class="card-header panel-heading clearfix">--}}
{{--                         <div class="pull-left">--}}
{{--                             <h3 class="m-0">{!! __('orders') !!}</h3>--}}
{{--                         </div>--}}
{{--                     </div>--}}
                     <div class="card-body panel-body">
                         <select name="table_head" id="table_head_id" class="selectpicker" multiple>
                             <option value="#" data-column="0" data-name="id">#</option>
                             <option value="Post Title" data-column="1" data-name="post_title">Post Title</option>
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
                                 <th>Post Title</th>
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

@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
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
                    {id: 'Post Title', name: 'post_title'},
                    {id: 'OG title', name: 'og:title'},
                    {id: 'OG image', name: 'og:image'},
                    {id: 'OG description', name: 'og:description'},
                    {id: 'OG Keywords', name: 'og:keywords'},
                    {id: 'Robots', name: 'robots'},
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
                    {data: 'post_title', name: 'post_title'},
                    {data: 'title', name: 'title'},
                    {data: 'image', name: 'image'},
                    {data: 'description', name: 'description'},
                    {data: 'keywords', name: 'keywords'},
                    {data: 'robots', name: 'robots'},
                    {data: 'fb_title', name: 'fb_title'},
                    {data: 'fb_image', name: 'fb_image'},
                    {data: 'fb_description', name: 'fb_description'},
                    {data: 'twitter_title', name: 'twitter_title'},
                    {data: 'twitter_image', name: 'twitter_image'},
                    {data: 'twitter_description', name: 'twitter_description'},
                    {data: 'actions', name: 'actions'}
                ],
                '#posts-table',
                "{!! route('datatable_bulk_posts') !!}"
            )
        });
    </script>
@stop
