@extends('layouts.admin')

@section('content')
    @php
        $model=null
    @endphp
    <div class="inventory_attributes">
        <div class="card panel panel-default">
            <div class="card-header panel-heading">
                        <div class="tools-stikers--header">
                            <h2>Stickers</h2>
                            {{--{!! Form::open(['url'=>route('admin_tools_stickers_manage')]) !!}--}}
                            {{--<div class="col-md-8">--}}
                            {{--<input class="form-control new-oreder-input"  name="translatable[gb][name]" type="text">--}}
                            {{--</div>--}}
                            @ok('admin_tools_stickers_new_form')
                            <div>
                                <button class="btn btn-primary add-new-order" type="submit"><span
                                            class="icon-plus mr-2"><i class="fa fa-plus"></i></span>Add New
                                </button>
                            </div>
                            @endok
                            {{--{!! Form::close() !!}--}}
                        </div>
            </div>
            <div class="card-body panel-body">
                <div class="d-flex flex-wrap">
                    <div class="col-md-3 attributes-container">
                        <div class="form-group row">
                            <label for="search-input" class="col-sm-3 col-form-label">Search</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="search-input" name="" placeholder="search">
                            </div>
                        </div>
                        <div class="search-attributes-scrolled">
                            @foreach($stickers as $sticker)
                                <div class="form-group row bord-top bg-light attr-option" data-item-id="{!! $sticker->id !!}"
                                     data-parent-id="1">
                                    <div class="col-md-6">
                                        {!! $sticker->name !!}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
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
                                </div>
                            @endforeach
                        </div>

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
                    <div class="col-md-8 offset-md-1">
                        @include('admin.tools.stickers_form')
                    </div>
                    @endok
                </div>

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

