@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @ok('admin_settings_general')
                <li class="nav-item ">
                    <a class="nav-link " id="info-tab" href="{!! route('admin_settings_general') !!}" role="tab"
                       aria-controls="general" aria-selected="true" aria-expanded="true">Info</a>
                </li>
                @endok
                @ok('admin_settings_accounts')
                <li class="nav-item">
                    <a class="nav-link " id="general-tab" href="{!! route('admin_settings_accounts') !!}" role="tab"
                       aria-controls="accounts" aria-selected="true" aria-expanded="true">Accounts</a>
                </li>
                @endok
                @ok('admin_settings_footer')
                <li class="nav-item">
                    <a class="nav-link " id="general-tab" href="{!! route('admin_settings_footer') !!}" role="tab"
                       aria-controls="general" aria-selected="true" aria-expanded="true">Footer</a>
                </li>
                @endok
                @ok('admin_settings_tc')
                <li class="nav-item">
                    <a class="nav-link " id="general-tab" href="{!! route('admin_settings_tc') !!}" role="tab"
                       aria-controls="general" aria-selected="true" aria-expanded="true">T&C</a>
                </li>
                @endok
                @ok('admin_settings_connections')
                <li class="nav-item">
                    <a class="nav-link " id="general-tab" href="{!! route('admin_settings_connections') !!}" role="tab"
                       aria-controls="general" aria-selected="true" aria-expanded="true">Connections</a>
                </li>
                @endok
                @ok('admin_settings_about_us')
                <li class="nav-item active">
                    <a class="nav-link " id="general-tab" href="{!! route('admin_settings_about_us') !!}" role="tab"
                       aria-controls="general" aria-selected="true" aria-expanded="true">About us</a>
                </li>
                @endok
            </ul>
            <div class="tab-content">
                {!! Form::model($model,['class'=>'form-horizontal']) !!}
                {!! Form::hidden('type','about_us') !!}
                {!! Form::hidden('id',null) !!}
                <div class="pull-right">
                    <button class="btn btn-success">Save</button>
                </div>
                <div class="clearfix"></div>
                <div class="tab-content tab-content-store-settings">
                    <div class="tab-pane fade active in" id="tab1"
                         aria-labelledby="tab1-tab">
                        <div class="row">
                            <div class="col-md-12">
                                @if(count(get_languages()))
                                    <ul class="nav nav-tabs">
                                        @foreach(get_languages() as $language)
                                            <li class="@if($loop->first) active @endif"><a
                                                        data-toggle="tab"
                                                        href="#{{ strtolower($language->code) }}">
                                                    <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                </a></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="tab-content">
                                    @if(count(get_languages()))
                                        @foreach(get_languages() as $language)
                                            <div id="{{ strtolower($language->code) }}"
                                                 class="tab-pane fade  @if($loop->first) in active @endif">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label"><span
                                                                data-toggle="tooltip"
                                                                title=""
                                                                data-original-title="Description">Description</span></label>
                                                    <div class="col-sm-10">
                                                        {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($model,strtolower($language->code),'description'),['class'=>'form-control tinyMcArea','cols'=>30,'rows'=>10]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')


@stop


@section('js')
    <script src="/public/js/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
        $(function () {
            function initTinyMce(e) {
                tinymce.init({
                    selector: e,
                    height: 500,
                    theme: 'modern',
                    plugins: 'print preview fullpage  searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help',
                    toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                    image_advtab: true,
                    templates: [
                        {title: 'Test template 1', content: 'Test 1'},
                        {title: 'Test template 2', content: 'Test 2'}
                    ],
                    content_css: [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                        '//www.tinymce.com/css/codepen.min.css'
                    ]
                });
            }

            initTinyMce(".tinyMcArea")
        })
    </script>
@stop