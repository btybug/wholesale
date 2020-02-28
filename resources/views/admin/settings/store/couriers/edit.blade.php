@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

    <div class="inventory_attributes">
        <div class="card panel panel-default">
                    <div class="card-header panel-heading d-flex flex-wrap justify-content-between">
                        <h2 class="mb-0 mr-1">Attribute</h2>
                        <div class="button-save text-right">
                            <a class="btn btn-default"
                               href="{!! route('admin_store_attributes') !!}">Back</a>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body panel-body">
                        {!! Form::model($model,['class'=>'','url'=>route('admin_settings_courier_save',($model)?$model->id:null)]) !!}
                        @if(count(get_languages()))
                            <ul class="nav nav-tabs">
                                @foreach(get_languages() as $language)
                                    <li class="nav-item">
                                        <a class="nav-link @if($loop->first) active @endif" data-toggle="tab" href="#{{ strtolower($language->code) }}">
                                            <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="tab-content">
                            @if(count(get_languages()))
                                @foreach(get_languages() as $language)
                                    <div id="{{ strtolower($language->code) }}"
                                         class="tab-pane fade  @if($loop->first) in active show @endif">
                                        <div class="row">
                                            <div class="col-xl-8">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 control-label">Couriers Name</label>
                                                    <div class="col-sm-10">
                                                        {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($model,strtolower($language->code),'name'),['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 control-label">Description</label>
                                                    <div class="col-sm-10">
                                                        {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($model,strtolower($language->code),'description'),['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="input-total">Icon</label>
                                    <div class="col-sm-9">
                                        {!! Form::text('icon',null,['class'=>'form-control icon-picker']) !!}
                                    </div>
                                    <div class="col-sm-1 text-center font-icon-added">
                                        <i id="font-show-area"></i>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="input-total">Image</label>
                                    <div class="col-sm-10">
                                        {!! media_button('image',$model) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        {!! Form::submit('Save',['class' => 'btn btn-info']) !!}
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
    <script src="https://farbelous.io/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js"></script>
    <script>
        $('.icon-picker').iconpicker();
    </script>
@stop
@section("css")
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="stylesheet" href="https://farbelous.io/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
    <style>
        #font-show-area {
            font-size: 50px;
            margin-top: 15px;
        }
    </style>
@stop
