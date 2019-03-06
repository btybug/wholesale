@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="coupons_new_page">
        <div>
            <a href="{!! route('admin_inventory_purchase') !!}" class="btn btn-warning pull-right">Back</a>
        </div>
        <h3>SKU : {{ $sku }}</h3>
        <div class="pull-right">
            <div class="col-md-6 "><b>Quantity:</b></div>
            <div class="col-md-6"> <span>255</span></div>
        </div>
        {!! Form::hidden('sku',$sku,['class' => 'select-sku']) !!}

        <div class="col-md-8">
            <table id="categories-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Purchase Date</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $datum)
                        <tr>
                            <td>{{ $datum->qty }}</td>
                            <td>{{ $datum->price }}</td>
                            <td>{{ BBgetDateFormat($datum->purchase_date) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4 product-box">

        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
    <link rel="stylesheet" href="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.css">
@stop
@section('js')
    <script src="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.js"></script>
    <script src="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/bootstrap-tagsinput.js"></script>
    <script>
        $('#input-date-start').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
            // minYear: 1901,
            // maxYear: parseInt(moment().format('YYYY'),10)
        });

        get_product();
        function get_product() {
            var sku = $(".select-sku").val();
            $.ajax({
                type: "post",
                url: "{!! route('admin_inventory_purchase_get_stock_by_sku') !!}",
                cache: false,
                datatype: "json",
                data: {sku: sku},
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function (data) {
                    if (!data.error) {
                        $(".product-box").html(data.html);
                    }
                }
            });
        }
    </script>
@stop
