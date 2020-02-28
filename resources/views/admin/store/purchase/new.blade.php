@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="coupons_new_page card panel panel-default">
        <div class="card-header panel-heading">
            <h3 class="m-0">Purchase Form</h3>
        </div>
        <div class="card-body panel-body">

            <div class="col-xl-8">
                {!! Form::model($model,['url' => route('admin_inventory_purchase_save'),'id' => 'form-coupon','class' => '']) !!}
                {!! Form::hidden('id') !!}
                <div class="form-group row required">
                    <label class="col-sm-2 control-label" for="input-code">
                        <span data-toggle="tooltip" title="" data-original-title="">Item</span></label>
                    <div class="col-sm-10">
                        {!! Form::select('item_id',[null => 'Select'] + $items,null,[ 'class'=> 'form-control select-item']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table--store-settings">
                            <thead>
                            <tr class="bg-my-light-pink">
                                <th>Warehouse</th>
                                <th>Rack</th>
                                <th>Shelve</th>
                                <th>QTY</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody class="v-options-list-locations">
                            @include('admin.store.purchase.locations')
                            </tbody>

                            <tfoot>
                            <tr class="add-new-ship-filed-container">
                                <td colspan="5" class="text-right">
                                    <button type="button" class="btn btn-primary add-location"><i
                                            class="fa fa-plus-circle "></i>
                                    </button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="input-discount">Price</label>
                    <div class="col-sm-10">
                        {!! Form::number('price',null,['placeholder' => 'Purchase price','class'=> 'form-control','step' => 'any']) !!}
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
            <div class="col-xl-4 product-box">

            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
    <link rel="stylesheet" href="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script src="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.js"></script>
    <script src="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/bootstrap-tagsinput.js"></script>
    <script>

        $(".select-item").select2({width: '100%'});

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

        $("body").on('click', '.add-location', function () {
            AjaxCall(
                "{{ route('admin_item_locations') }}",
                {},
                function (res) {
                    if (!res.error) {
                        $('.v-options-list-locations').append(res.html)
                    }
                }
            );
        });

        $("body").on('click', '.delete-v-option_button', function () {
            $(this).closest('tr').remove();
        });

        $("body").on('change','.warehouse',function () {
            let w_id = $(this).val();
            let parent = $(this).closest(".location-item");
            render_racks(w_id,parent)
        })

        $("body").on('change','.rack',function () {
            let r_id = $(this).val();
            let parent = $(this).closest(".location-item");

            render_shelves(r_id,parent)
        })

        function render_racks(w_id,parent){
            parent.find(".rack").html('<option value="0">Select Rack</option>');
            parent.find(".shelve").html('<option value="0">Select Shelve</option>');
            if(w_id){
                AjaxCall("{{ route('admin_warehouses_rack_by_warehouse') }}", {w_id: w_id}, function (res) {
                    if (!res.error) {
                        parent.find(".rack").empty();
                        var html = '<option value="0">Select Rack</option>';
                        for (var prop in res.data) {
                            html += '<option value="'+res.data[prop].id+'">'+res.data[prop].name+'</option>';
                        }

                        parent.find(".rack").append(html);
                    }
                });
            }

        }

        function render_shelves(r_id,parent){
            parent.find(".shelve").html('<option value="0">Select Shelve</option>');
            if(r_id){
                AjaxCall("{{ route('admin_warehouses_shelve_by_rack') }}", {r_id: r_id}, function (res) {
                    if (!res.error) {
                        parent.find(".shelve").empty();

                        var html = '<option value="0">Select Shelve</option>';
                        for (var prop in res.data) {
                            html += '<option value="'+res.data[prop].id+'">'+res.data[prop].name+'</option>';
                        }

                        parent.find(".shelve").append(html);
                    }
                });
            }
        }

        {{--$("body").on('change','.select-item',function () {--}}
            {{--let item_id = $(this).val();--}}
            {{--$(".locations").html('');--}}
            {{--AjaxCall("{{ route('admin_item_locations') }}", {item_id: item_id}, function (res) {--}}
                {{--if (!res.error) {--}}
                    {{--$(".locations").append(res.html);--}}
                {{--}--}}
            {{--});--}}
        {{--})--}}

    </script>
@stop
