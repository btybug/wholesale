@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">
        {!! Form::model($model,['class' => 'updated-form','url'=>route('admin_blog_brands_create_or_edit')]) !!}
        {!! Form::hidden('id') !!}
        <div class="card-header panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2 class="m-0 pull-left">Brands</h2>
            <div class="form-group">
                {!! Form::submit('Save',['class' => 'btn btn-info btn-submit-form']) !!}
            </div>
        </div>
        <div class="card-body panel-body">

            @if(count(get_languages()))
                <ul class="nav nav-tabs">
                    @foreach(get_languages() as $language)
                        <li class="nav-item"><a class="nav-link @if($loop->first) active @endif" data-toggle="tab" href="#{{ strtolower($language->code) }}">
                                <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}</a></li>
                    @endforeach
                </ul>
            @endif


            <div class="tab-content">
                @if(count(get_languages()))
                    @foreach(get_languages() as $language)
                        <div id="{{ strtolower($language->code) }}" class="tab-pane fade  @if($loop->first) in active show @endif">
                            <div class="form-group row mt-10">
                                <label class="col-xl-2 col-lg-4 col-md-12 col-sm-3 col-form-label">Category Name</label>
                                <div class="col-xl-10 col-lg-8 col-md-12 col-sm-9">
                                    {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($model,$language,'name'),['class'=>'form-control','required'=>true]) !!}
                                </div>

                            </div>

                                <div class="form-group row">
                                    <label class="col-xl-2 col-lg-4 col-md-12 col-sm-3 col-form-label">Description</label>
                                    <div class="col-xl-10 col-lg-8 col-md-12 col-sm-9">
                                        {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($model,$language,'description'),['class'=>'form-control','required'=>true]) !!}
                                    </div>
                                </div>

                        </div>
                    @endforeach
                @endif
            </div>

                <div class="form-group row">
                    <label class="col-xl-2 col-lg-4 col-md-12 col-sm-3 col-form-label">Slug</label>
                    <div class="col-xl-10 col-lg-8 col-md-12 col-sm-9">
                        {!! Form::text('slug',null,['class'=>'form-control','required'=>true]) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-2 col-lg-4 col-md-12 col-sm-3 col-form-label">Custom classes</label>
                    <div class="col-xl-10 col-lg-8 col-md-12 col-sm-9">
                        {!! Form::text('classes',null,['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-2 col-lg-4 col-md-12 col-sm-3 col-form-label">Select stickers</label>
                    <div class="col-xl-10 col-lg-8 col-md-12 col-sm-9">
                        {!! Form::select('stickers[]',$stickers,null,['class'=>'form-control','id' => 'select-stickers','multiple' => true]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-2 col-lg-4 col-md-12 col-sm-3 col-form-label">Icon</label>
                    <div class="col-xl-10 col-lg-8 col-md-12 col-sm-9">
                        <div class="row">
                            <div class="col-md-10 col-xs-12">
                                {!! Form::text('icon',null,['class'=>'form-control icon-picker','required'=>true]) !!}
                            </div>
                            <div class="col-md-2 col-xs-12">
                                <i id="font-show-area"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-2 col-lg-4 col-md-12 col-sm-3 col-form-label">Image</label>
                    <div class="col-xl-10 col-lg-8 col-md-12 col-sm-9">
                        {!! media_button('image',$model) !!}
                    </div>
                </div>



            @if(is_enabled_media_modal())
                <script src="{!! url('public/admin_theme/media/js/lightbox.js') !!}"></script>
                <script src="{!! url('public/admin_theme/media/js/jstree.min.js') !!}"></script>
                <script src="{!! url('public/admin_theme/media/js/custom.js') !!}"></script>
                <script src="{!! url('public/admin_theme/fileinput/js/fileinput.min.js') !!}"></script>
            @endif
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(function () {
            $("#select-stickers").select2();
        })
    </script>
@stop




