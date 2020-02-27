@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="coupons_new_page card panel panel-default">
        <div class="card-header panel-heading">
            <h3 class="m-0">Transfer Form</h3>
        </div>
        <div class="card-body panel-body">

            <div class="col-xl-8">
                <div class="form-group row required">
                    <label class="col-sm-2 control-label" for="input-code">
                        <span data-toggle="tooltip" title="" data-original-title="">Item</span></label>
                    <div class="col-sm-10">
                        {!! Form::select('item_id',[null => 'Select'] + $items,null,[ 'class'=> 'form-control select-item']) !!}
                    </div>
                </div>
                <div class="form-group locations">

                </div>

            </div>
        </div>
    </div>
@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(".select-item").select2();


        $("body").on('change','.select-item',function () {
            let item_id = $(this).val();
            $(".locations").html('');
            AjaxCall("{{ route('admin_items_transfer_locations') }}", {item_id: item_id}, function (res) {
                if (!res.error) {
                    $(".locations").append(res.html);
                }
            });
        })

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

    </script>
@stop
