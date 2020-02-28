@extends('layouts.admin')
@section('content')
    <section class="setting_add_lang">
        <div class="card panel panel-default">
                    <div class="card-header panel-heading">
                        <h3 class="box-title m-0">Add Language</h3>
                    </div>
                    <div class="card-body panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-7 col-lg-10">
                                {!! Form::model($model,['class' => 'form-validate','url' => route('admin_settings_languages_new_post')]) !!}
                                {!! Form::hidden('id',null) !!}
                                <div class="form-group row">
                                    <label for="code" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('code',['' => 'Select'] + $countries,null,['class' => 'form-control','id' => 'code']) !!}
                                        <span class="help-block">Language name such as &quot;English&quot;</span>
                                        {!! Form::hidden('name',null,['id' => 'lang-name']) !!}
                                        {!! Form::hidden('original_name',null,['id' => 'original_name']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="original_name" class="col-sm-2 control-label">Original Name</label>
                                    <div class="col-sm-10">
                                        <div class="form-control original_name">{!! @$model->original_name !!}</div>
                                        <span class="help-block">Language name such as &quot;España&quot;</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="direction"
                                           class="col-sm-2 control-label">Direction</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('direction',[
                                            'ltr' => 'Left To Right',
                                            'rtl' => 'Right To Left'
                                        ],null,['class' => 'form-control','id' => 'direction']) !!}
                                        <span class="help-block">Language Direction</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 control-label">Icon</label>
                                    <div class="col-sm-10">
                                        <div class="form-control lang-place">
                                            @if($model)
                                                <span class="flag-icon flag-icon-{{ strtolower($model->code) }}"></span>
                                            @endif
                                        </div>
                                        <span class="help-block">Language Flag</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="is_default"
                                           class="col-sm-2 control-label">Default</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('default',[
                                            '0' => 'No',
                                            '1' => 'Yes'
                                        ],null,['class' => 'form-control','id' => 'is_default']) !!}
                                        <span class="help-block">Set default language.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="shared"
                                           class="col-sm-2 control-label">Share to Front</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('shared',[
                                            '0' => 'No',
                                            '1' => 'Yes'
                                        ],null,['class' => 'form-control','id' => 'shared']) !!}
                                        <span class="help-block">Share language.</span>
                                    </div>
                                </div>


                                <div class="text-right">
                                    {!! Form::submit('Save Language',['class' => 'btn btn-info']) !!}
                                    <a href="#"
                                       type="button" class="btn btn-default">Back</a>
                                </div>
                                {!! Form::close() !!}

                            </div>
                        </div>

                    </div>
                </div>
    </section>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')
    <script>
        $("body").on("change","#code", function (e) {
           var code = $(this).val();
            AjaxCall("{!! route('post_admin_settings_get_languages') !!}", {code, code}, function(res) {
                if(!res.error){
                    $("#lang-name").val(res.data.name);
                    $("#original_name").val(res.data.native);
                    $(".original_name").html(res.data.native);
                    $(".lang-place").html(`<span class="flag-icon flag-icon-${res.data.code.toLowerCase()}"></span>`);
                };
            });
        })
    </script>
@stop
