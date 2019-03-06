@extends('layouts.admin')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="m-0">Add new item</h2>
        </div>
        <div class="panel-body">
            <div class="content main-content">
                <ul class="nav nav-tabs admin-profile-left">
                    <li class="active"><a data-toggle="tab" href="#info">Info</a></li>
                </ul>
                <div class="tab-content">
                    <div id="info" class="tab-pane fade in active media-new-tab basic-details-tab">
                        {!! Form::model($model,['class'=>'form-horizontal','url' => route('post_admin_items_new')]) !!}
                        {!! Form::hidden('id', null) !!}
                        <div class="row">
                            <label for="feature_image" class="control-label col-sm-4"></label>
                            <div class="col-sm-8 text-right pt-25 mb-25">
                                <button class="btn btn-info" type="submit">Save</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="basic-left basic-wall h-100">
                                    <div class="all-list">
                                        <ul class="nav nav-tabs media-list">
                                            <li class="active"><a data-toggle="tab" href="#location">Location</a></li>
                                            <li><a data-toggle="tab" href="#structure">Structure</a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="basic-center basic-wall">
                                    <div class="tab-content media-list-tab-content">
                                        <div id="location" class="tab-pane fade in active">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="text" class="control-label col-sm-4">1st Line address</label>
                                                    <div class="col-sm-8">
                                                        {!! Form::text('first_line_address',null,['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="text" class="control-label col-sm-4">2nd line address</label>
                                                    <div class="col-sm-8">
                                                        {!! Form::text('second_line_address',null,['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="text" class="control-label col-sm-4">Country</label>
                                                    <div class="col-sm-8">
                                                        {!! Form::select('country',$countries,null,['class'=>'form-control','id' => 'geo_country']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group hide">
                                                <div class="row">
                                                    <label for="text" class="control-label col-sm-4">City</label>
                                                    <div class="col-sm-8">
                                                        {!! Form::text('city',null,['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="text" class="control-label col-sm-4">Post Code</label>
                                                    <div class="col-sm-8">
                                                        {!! Form::text('post_code',null,['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div id="structure" class="tab-pane fade">
                                            structure
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {!! Form::close() !!}
                    </div>
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
        $(function () {
            $("#geo_country").select2({ width: '100%' });
        })

    </script>
@stop
