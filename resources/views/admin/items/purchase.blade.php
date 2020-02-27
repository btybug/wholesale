@extends('layouts.admin')
@section('content')
    <section class="content-top">
        <div class="row m-0">
            <div class="col-md-3">
                <input type="text" placeholder="Product Name" class="form-control" value="{{ $item->name }}" readonly>
            </div>
            <div class="col-md-3">
                <input type="text" placeholder="SKU" class="form-control" value="{{ $item->sku }}" readonly>
            </div>
            <div class="col-md-3">
                <input type="text" placeholder="Quantity" class="form-control"
                       value="{{ $item->purchase->sum('qty')-$item->others->sum('qty') }}" readonly>
            </div>
        </div>
    </section>
    <div class="content main-content">
        <ul class="nav nav-tabs admin-profile-left">
            @if($item->type!='bundle')
                <li class="nav-item"><a class="nav-link active" id="nav-purchases-tab" data-toggle="tab"
                                        href="#purchases" role="tab" aria-controls="nav-purchases" aria-selected="true">Purchases</a>
                </li>
                <li class="nav-item"><a class="nav-link" id="nav-others-tab" data-toggle="tab" href="#others" role="tab"
                                        aria-controls="nav-others" aria-selected="false">Others</a></li>
            @endif
            <li class="nav-item"><a class="nav-link @if($item->type =='bundle') active @endif" id="nav-sales-tab" data-toggle="tab" href="#sales" role="tab"
                                    aria-controls="nav-sales" aria-selected="false">Sales</a></li>
                <li class="nav-item"><a class="nav-link" id="nav-locations-tab" data-toggle="tab" href="#locations" role="tab"
                                        aria-controls="nav-locations" aria-selected="false">Locations</a></li>
        </ul>
        <div class="tab-content">
            @if($item->type!='bundle')
            <div id="purchases" role="tabpanel" aria-labelledby="nav-purchases-tab" class="tabe-pane fade show active media-new-tab basic-details-tab">
                <div class="row justify-content-end mt-2">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">Total Quantity:</div>
                            <div class="col-md-6">{!! $item->purchase->sum('qty') !!}</div>
                        </div>
                    </div>
                </div>
                <div>
                    <table id="categories-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>SKU</th>
                            <th>Owner</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Purchase Date</th>
                            <th>Entry Date</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div id="others" class="tabe-pane fade media-new-tab basic-details-tab" role="tabpanel"
                 aria-labelledby="nav-others-tab">
                <div class="row justify-content-end mt-2">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">Total Quantity:</div>
                            <div class="col-md-6">{!! $item->others()->where('reason','!=','sold')->sum('qty') !!}</div>
                        </div>
                    </div>
                </div>
                <div>
                    <table id="categories-table-others" class="table table-style table-bordered" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>SKU</th>
                            <th>Owner</th>
                            <th>Qty</th>
                            <th>Reason</th>
                            <th>Purchase Date</th>
                            <th>Entry Date</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @endif
                <div id="sales" class="tabe-pane fade @if($item->type=='bundle') show active  @endif media-new-tab basic-details-tab" role="tabpanel" aria-labelledby="nav-sales-tab">
                    <div class="row justify-content-end mt-2">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-6">Total Quantity:</div>
                                <div class="col-md-6">{!! $item->others()->where('reason','sold')->sum('qty') !!}</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <table id="categories-table-sales" class="table table-style table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>SKU</th>
                                <th>Owner</th>
                                <th>Qty</th>
                                <th>Reason</th>
                                <th>Purchase Date</th>
                                <th>Entry Date</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div id="locations" class="tabe-pane fade media-new-tab basic-details-tab" role="tabpanel" aria-labelledby="nav-locations-tab">
                    <div class="form-group row">
                        <div class="col-xl-12 mt-5">
                            <div class="table-responsive">
                                <table class="table table--store-settings">
                                    <thead>
                                    <tr class="bg-my-light-pink">
                                        <th>Warehouse</th>
                                        <th>Rack</th>
                                        <th>Shelve</th>
                                        <th>Qty</th>
                                    </tr>
                                    </thead>

                                    <tbody class="v-options-list-locations">
                                    @if($item && $item->locations)
                                        @foreach($item->locations as $location)
                                            <tr class="v-options-list-item location-item">
                                                <td>
                                                    <div class="form-control">{{ ($location->warehouse)?$location->warehouse->name:null }}</div>
                                                </td>
                                                <td>
                                                    <div class="form-control">{{ ($location->rack)?$location->rack->name:null }}</div>
                                                </td>
                                                <td>
                                                    @if($location->rack)
                                                        @php
                                                            $shelve = $location->rack->children()->where('id',$location->shelve_id)->first();
                                                        @endphp
                                                        <div class="form-control">{{ ($shelve)?$shelve->name:null }}</div>
                                                    @endif
                                                </td>
                                                <td colspan="2" class="text-right">
                                                    <div class="form-control">{{ $location->qty }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
        </div>
    </div>
@stop
@section('css')
    <style>
        .tab-content .tab-pane {
            display: none;
        }

        .tab-content .tab-pane.active {
            display: block;
        }
    </style>
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">

@stop
@section('js')

    <script src="/public/js/custom/stock.js?v=" .rand(111,999)></script>

    <script>
        $(function () {
            $('#categories-table').DataTable({
                ajax: "{!! route('datatable_item_purchases',$item->id) !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                "scrollX": true,
                dom: 'Bflrtip',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'sku', name: 'sku'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'qty', name: 'qty'},
                    {data: 'price', name: 'price'},
                    {data: 'purchase_date', name: 'purchase_date'},
                    {data: 'created_at', name: 'created_at'}
                ]
            });
            $('#categories-table-others').DataTable({
                ajax: "{!! route('datatable_item_others',$item->id) !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                "scrollX": true,
                dom: 'Bflrtip',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'sku', name: 'sku'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'qty', name: 'qty'},
                    {data: 'reason', name: 'reason'},
                    {data: 'purchase_date', name: 'purchase_date'},
                    {data: 'created_at', name: 'created_at'}
                ]
            });

            $('#categories-table-sales').DataTable({
                ajax: "{!! route('datatable_item_sales',$item->id) !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                "scrollX": true,
                dom: 'Bflrtip',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'sku', name: 'sku'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'qty', name: 'qty'},
                    {data: 'reason', name: 'reason'},
                    {data: 'purchase_date', name: 'purchase_date'},
                    {data: 'created_at', name: 'created_at'}
                ]
            });
        });

    </script>
@stop
