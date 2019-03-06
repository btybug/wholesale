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
                <input type="text" placeholder="Quantity" class="form-control" value="{{ $item->quantity }}" readonly>
            </div>
            <div class="col-md-3">
                {!! Form::submit('Save',['class' => 'btn btn-info pull-right']) !!}
            </div>
        </div>
    </section>
    <div class="content main-content">
        <ul class="nav nav-tabs admin-profile-left">
            <li class="active"><a data-toggle="tab" href="#purchases">Purchases</a></li>
            <li><a data-toggle="tab" href="#sales">Sales</a></li>
        </ul>
        <div class="tab-content">
            <div id="purchases" class="tabe-pane fade in active media-new-tab basic-details-tab">
                <div class="col-md-3 pull-right">
                    <div class="col-md-6">Total Quantity:</div>
                    <div class="col-md-6">{!! $item->purchase->sum('qty') !!}</div>
                </div>
                <div class="col-xs-12">
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
            <div id="sales" class="tabe-pane fade"></div>
        </div>
    </div>


@stop
@section('css')

    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">

@stop
@section('js')

    <script src="/public/js/custom/stock.js?v=" .rand(111,999)></script>

    <script>
        $(function () {
            $('#categories-table').DataTable({
                ajax:  "{!! route('datatable_item_purchases',$item->id) !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                columns: [
                    {data: 'id',name: 'id'},
                    {data: 'sku', name: 'sku'},
                    {data: 'user_id',name: 'user_id'},
                    {data: 'qty', name: 'qty'},
                    {data: 'price', name: 'price'},
                    {data: 'purchase_date', name: 'purchase_date'},
                    {data: 'created_at', name: 'created_at'}
                ]
            });
        });

    </script>
@stop