@extends('layouts.admin')

@section('content')
    @php
        $model=null
    @endphp
    <div class="col-md-12 inventory_attributes">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tools-stikers--header">
                            <h2>Stickers</h2>
                            {{--{!! Form::open(['url'=>route('admin_tools_stickers_manage')]) !!}--}}
                            {{--<div class="col-md-8">--}}
                            {{--<input class="form-control new-oreder-input"  name="translatable[gb][name]" type="text">--}}
                            {{--</div>--}}
                            @ok('admin_tools_stickers_new_form')
                            <div class="col-md-4 text-right">
                                <button class="btn btn-primary add-new-order" type="submit"><span
                                            class="icon-plus mr-5"><i class="fa fa-plus"></i></span>Add New
                                </button>
                            </div>
                            @endok
                            {{--{!! Form::close() !!}--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-3 attributes-container">
                    @foreach($stickers as $sticker)
                        <div class="form-group row bord-top bg-light attr-option" data-item-id="{!! $sticker->id !!}"
                             data-parent-id="1">
                            <div class="col-md-6">
                                {!! $sticker->name !!}
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <div style="width: 30px;height: 30px;background: {{ $sticker->color }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if($sticker->image)
                                        <img src="{{ $sticker->image }}" width="30"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="form-group row bord-top">
                        {{--{!! Form::open(['url'=>route('admin_tools_stickers_manage')]) !!}--}}
                        {{--<div class="col-md-8">--}}
                        {{--<input class="form-control new-oreder-input"  name="translatable[gb][name]" type="text">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 text-right">--}}
                        {{--<button class="btn btn-primary add-new-order"  type="submit">Add </button>--}}
                        {{--</div>--}}
                        {{--{!! Form::close() !!}--}}
                    </div>
                </div>
                @ok('admin_tools_stickers_manage')
                @include('admin.tools.stickers_form')
                @endok
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet"
          href="{{asset('public/admin_theme/bootstrap-colorselector/bootstrap-colorselector.min.css?v='.rand(111,999))}}">
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop

@section("js")
    <script src="{{asset('public/admin_theme/bootstrap-colorselector/bootstrap-colorselector.min.js')}}"></script>
    <script>
        $(function () {
            $('#colorselector_2').colorselector();
        });
    </script>
    <script>
        $("body").on("click", ".attr-option", function (e) {
            e.preventDefault()
            let id = $(this).attr("data-item-id")
            AjaxCall("{!! route('admin_tools_stickers_manage_form') !!}", {id}, function (res) {
                if (!res.error) {
                    $("body").find(".options-form").html(res.html)
                    $('#colorselector_2').colorselector();
                }
            })
        });

        $("body").on("click", ".add-new-order", function (e) {
            e.preventDefault()
            AjaxCall("{!! route('admin_tools_stickers_new_form') !!}", {}, function (res) {
                if (!res.error) {
                    $("body").find(".options-form").html(res.html)
                    $('#colorselector_2').colorselector();
                }
            })
        });

    </script>
@stop

