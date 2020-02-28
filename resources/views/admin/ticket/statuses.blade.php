@extends('layouts.admin')

@section('content')
    @php
        $model=null
    @endphp
    <div class="inventory_attributes">
        <div class="card panel panel-default">
            <div class="card-header panel-heading">
                    <div class="head-space-between">
                        <h2>{!! ucfirst(str_replace("_"," ",$type)) !!} Status</h2>
                        <div class="form-group row bord-top">
                            {!! Form::open(['url'=>route('post_admin_stock_statuses_manage')]) !!}
                            <input name="type" type="hidden" value="{!! $type !!}">
                            {{--<div class="col-md-8">--}}
                                {{--<input class="form-control new-oreder-input"  name="translatable[gb][name]" type="text">--}}
                            {{--</div>--}}
                            <div class="col-md-12 text-right">
                               <button class="btn btn-primary add-new-order"  type="submit"><span class="icon-plus"><i class="fa fa-plus"></i></span>Add New</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
            </div>
            <div class="card-body panel-body">
                <div class="row">
                    <div class="col-xl-3 col-lg-4  col-md-5 attributes-container">
                        <div class="mb-20 list-group">
                            @foreach($statuses as $status)
                                <div class="d-flex flex-wrap form-group row list-group-item bg-light  pointer" data-item-id="{!! $status->id !!}"
                                     data-parent-id="1">
                                    <div class="col-6 attr-option" data-item-id="{!! $status->id !!}">
                                        {!! ($status->name)??"Empty" !!}
                                    </div>
                                    <div class="col-6 text-right">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="width: 20px;height: 20px;background: {{ $status->color }}"></div>
                                            @if(!$status->is_default)
                                                {!! Form::model($status,['url' => route('post_admin_stock_statuses_delete')]) !!}
                                                {!! Form::hidden('id',null) !!}
                                                <button class="btn btn-sm btn-danger" type="submit"><i class='fa fa-trash'></i></button>
                                                {!! Form::close() !!}
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{--<div class="form-group row bord-top">--}}
                        {{--{!! Form::open(['url'=>route('post_admin_stock_statuses_manage')]) !!}--}}
                        {{--<input name="type" type="hidden" value="{!! $type !!}">--}}
                        {{--<div class="col-md-8">--}}
                        {{--<input class="form-control new-oreder-input"  name="translatable[gb][name]" type="text">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 text-right">--}}
                        {{--<button class="btn btn-primary add-new-order"  type="submit">Add </button>--}}
                        {{--</div>--}}
                        {{--</form>--}}
                        {{--</div>--}}
                    </div>
                    <div class="col-xl-9 col-lg-8  col-md-7">
                        @include('admin.tools.statuses._patrials.status_form')
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/admin_theme/bootstrap-colorselector/bootstrap-colorselector.min.css?v='.rand(111,999))}}">
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,888))}}">
@stop

@section("js")
    <script src="{{asset('public/admin_theme/bootstrap-colorselector/bootstrap-colorselector.min.js')}}"></script>
    <script>
        $(function() {
//            $('#colorselector_2').colorselector({
//                callback : function(value, color, title) {
//                    $("#colorValue").val(value);
//                    $("#colorColor").val(color);
//                    $("#colorTitle").val(title);
//                }
//            });
            $('#colorselector_2').colorselector();

        });
    </script>
<script>
$("body").on("click", ".attr-option", function(e) {
    e.preventDefault()
    let id = $(this).attr("data-item-id")
    AjaxCall("{!! route('post_admin_stock_statuses_manage_form') !!}", {id}, function (res) {
        if (!res.error) {
            $("body").find(".options-form").html(res.html)
            $('#colorselector_2').colorselector();
        }
    })
});

</script>
@stop
