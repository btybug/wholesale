@extends('layouts.admin')
@section('content')

    <div class="card panel panel-default">
        <div class="card-header panel-heading">
            <h2 class="m-0">Warehouse</h2>
        </div>
        <div class="card-body panel-body">
            <div class="content main-content">
                {!! Form::model($model,['url' => route('admin_warehouses_save'),'class' => 'form-horizontal']) !!}
                {!! Form::hidden('id',null) !!}
                <div class="row">
                    @if(count(get_languages()))
                        <ul class="nav nav-tabs w-100">
                            @foreach(get_languages() as $language)
                                <li class="nav-item"><a
                                        class="nav-link @if($loop->first) active @endif"
                                        data-toggle="tab"
                                        href="#{{ strtolower($language->code) }}">
                                                                            <span
                                                                                class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                    </a></li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="tab-content mt-20 w-100">
                        @if(count(get_languages()))
                            @foreach(get_languages() as $language)
                                <div id="{{ strtolower($language->code) }}"
                                     class="tab-pane fade  @if($loop->first) in active show @endif">
                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 control-label col-form-label text-sm-right"><span
                                                data-toggle="tooltip"
                                                title=""
                                                data-original-title="Attribute Name Title">Warehouse name</span></label>
                                        <div class="col-sm-10">
                                            {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($model,strtolower($language->code),'name'),['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 control-label col-form-label text-sm-right"><span
                                                data-toggle="tooltip"
                                                title=""
                                                data-original-title="Attribute Name Title">Manager name</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 control-label col-form-label text-sm-right"><span
                                                data-toggle="tooltip"
                                                title=""
                                                data-original-title="Attribute Name Title">City </span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 control-label col-form-label text-sm-right"><span
                                                data-toggle="tooltip"
                                                title=""
                                                data-original-title="Attribute Name Title">Telephone Number</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 control-label col-form-label text-sm-right"><span
                                                data-toggle="tooltip"
                                                title=""
                                                data-original-title="Short Description">Description</span></label>
                                        <div class="col-sm-10">
                                            {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($model,strtolower($language->code),'description'),['class'=>'form-control','cols'=>30,'rows'=>2]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 control-label col-form-label text-sm-right"><span
                                                data-toggle="tooltip"
                                                title=""
                                                data-original-title="Attribute Name Title">First Line Address </span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 control-label col-form-label text-sm-right"><span
                                                data-toggle="tooltip"
                                                title=""
                                                data-original-title="Attribute Name Title">Address</span></label>
                                        <div class="col-sm-10">
                                            {!! Form::text('translatable['.strtolower($language->code).'][address]',get_translated($model,strtolower($language->code),'address'),['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                            <div class="form-group">
                                <div class="row">
                                    <label for="feature_image"
                                           class="control-label col-sm-4 control-label col-form-label text-sm-right">Image</label>
                                    <div class="col-sm-8">
                                        {!! media_button('image',$model) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">

                                    <div class="col-sm-8">
                                        {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
                {!! Form::close() !!}
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
        })

    </script>
@stop
