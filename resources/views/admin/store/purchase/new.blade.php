@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="coupons_new_page panel panel-default">
        <div class="panel-heading">
            <h3 class="m-0">Purchase Form</h3>
        </div>
        <div class="panel-body">

            <div class="col-md-8">
                {!! Form::model($model,['url' => route('admin_inventory_purchase_save'),'id' => 'form-coupon','class' => '']) !!}
                {!! Form::hidden('id') !!}
                <div class="form-group row required">
                    <label class="col-sm-2 control-label" for="input-code">
                        <span data-toggle="tooltip" title="" data-original-title="">Item</span></label>
                    <div class="col-sm-10">
                        {!! Form::select('item_id',$items,null,[ 'class'=> 'form-control select-sku']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="input-discount">Quantity</label>
                    <div class="col-sm-10">
                        {!! Form::number('qty',null,['placeholder' => 'Purchase quantity','class'=> 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="input-discount">Price</label>
                    <div class="col-sm-10">
                        {!! Form::number('price',null,['placeholder' => 'Purchase price','class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="input-date-start">Purchase date</label>
                    <div class="col-sm-3">
                        <div class="input-group date">
                            {!! Form::text('purchase_date',null,['placeholder' => 'Purchase date',
                          'id'=>'input-date-start', 'class'=> 'form-control']) !!}
                            <span class="input-group-btn">
<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
</span></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="supplier">
                        Supplier</label>
                    <div class="col-sm-10">
                        {!! Form::select('supplier_id',$suppliers,null,[ 'class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="invoiceNumber">Invoice number</label>
                    <div class="col-sm-10">
                        {!! Form::number('invoice_number',null,['placeholder' => 'Purchase invoice number','class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="input-status"></label>
                    <div class="col-sm-10 text-right">
                        {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-md-4 product-box">

            </div>
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
