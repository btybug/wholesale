@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="coupons_new_page card panel panel-default">
        <div class="card-header panel-heading">
            <h3 class="m-0">Transfer Form</h3>
        </div>
        <div class="card-body panel-body">

            <div class="col-md-8">
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
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')
    <script>


        $("body").on('change','.select-item',function () {
            let item_id = $(this).val();
            $(".locations").html('');
            AjaxCall("{{ route('admin_items_transfer_locations') }}", {item_id: item_id}, function (res) {
                if (!res.error) {
                    $(".locations").append(res.html);
                }
            });
        })

    </script>
@stop
