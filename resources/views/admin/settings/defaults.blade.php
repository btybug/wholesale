@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row flex-column">
            @include("admin.settings._partials.menu",['active' => 'defaults'])

            <div class="tab-content w-100">
                {!! Form::model($model) !!}

                <div class="tab-pane fade active in show" id="admin_settings_general">
                    <div class="row">
                        <div class="col-lg-7 col-sm-6">
                            <div class="card panel panel-default mb-3">
                                <div class="card-header panel-heading">Items Defaults</div>
                                <div class="card-body panel-body">
                                    <div class="row">
                                        {!! media_button('item_image',$model) !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-7 col-sm-6">
                            <div class="card panel panel-default mb-3">
                                <div class="card-header panel-heading">Stock Defaults</div>
                                <div class="card-body panel-body">
                                    <div class="row">
                                        {!! media_button('stock_image',$model) !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-5 col-sm-6">
                            <div class="text-right">
                                <button class="btn btn-info mb-20 mt20" type="submit">Save</button>
                            </div>
                        </div>

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>


    </div>
@stop




@section('js')

@stop
