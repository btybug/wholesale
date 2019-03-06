@extends('layouts.admin')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="m-0">SEO</h2>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="shipping-tab" href="{!! route('admin_seo_bulk') !!}" role="tab"
                       aria-controls="shipping" aria-selected="false">Posts</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" id="shipping-tab" href="{!! route('admin_seo_bulk_products') !!}" role="tab"
                       aria-controls="shipping" aria-selected="false">Products</a>
                </li>
            </ul>
            <div class="pt-25">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                     <h3 class="m-0 pull-left">Inventory</h3>
                        <div class="pull-right"><a class="btn btn-primary pull-right" href="{!! route('admin_stock_new') !!}">Add new</a></div>
                    </div>
                    <div class="panel-body">
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
        $(function () {
            $('#stocks-table').DataTable({
                ajax: "{!! route('datatable_bulk_stocks') !!}",
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
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

                ]
            });
        });
    </script>
@stop
