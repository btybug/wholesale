@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row flex-column">
            @include("admin.settings._partials.menu",['active' => 'footer'])


            <div class="tab-content">
                {!! Form::open(['class'=>'form-horizontal']) !!}
                <div class="text-right mb-20 mt20">
                    <button class="btn btn-info">Save</button>
                </div>
                <div class="clearfix"></div>
                <div class="text-right mb-2">
                    <button type="button" class="btn btn-primary add-section" data-lang="gb" data-block="{!! count($footer_links) !!}"><i class="fa fa-plus"></i></button>
                </div>
                <div class="tab-content setting-general-footer--tabs">
                    <div class="tab-pane fade active in show" id="tab1"
                         aria-labelledby="tab1-tab">
                        <div>
                            @if(count(get_languages()))
                                <ul class="nav nav-tabs">
                                    @foreach(get_languages() as $language)
                                        <li class="nav-item "><a class="nav-link @if($loop->first) active @endif" data-toggle="tab"
                                                                                       href="#{{ strtolower($language->code) }}">
                                                <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                            </a></li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="tab-content pt-25">
                                @if(count(get_languages()))
                                    @foreach(get_languages() as $language)
                                        <div id="{{ strtolower($language->code) }}"
                                             class="tab-pane fade  @if($loop->first) in active show @endif">
                                            @if(!isset($footer_links[strtolower($language->code)]))
                                                <div class="panel-group">
                                                    <div class="card panel panel-default mb-3">
                                                        <div class="card-header panel-heading">Panel Header
                                                            <div>
                                                                <button type="button"
{{--                                                                        class="btn btn-primary add-section"--}}
                                                                        class="btn btn-danger remove-section"
                                                                        data-lang="{!!strtolower($language->code)!!}"
                                                                        data-block="0"><i
                                                                            class="fa fa-minus"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="card-body panel-body">
                                                            <!-- Text input-->
                                                            <div class="form-group">
                                                                <div class="row mb-20">
                                                                    <label class="col-md-4 control-label col-form-label text-md-right"
                                                                           for="textinput">Name</label>
                                                                    <div class="col-md-4">
                                                                        {!! Form::text('translatable['.strtolower($language->code).'][name][0]',null,['class'=>'form-control input-md']) !!}

                                                                    </div> <!-- Text input-->
                                                                </div>

                                                                <div class="links">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-5">
                                                                            <div class="row">
                                                                                <label class="col-md-4 control-label col-form-label text-md-right"
                                                                                       for="textinput">Title</label>
                                                                                <div class="col-md-8">
                                                                                    {!! Form::text('translatable['.strtolower($language->code).'][title][0][]',null,['class'=>'form-control input-md']) !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="row">
                                                                                <label class="col-md-4 control-label col-form-label text-md-right"
                                                                                       for="textinput">Link</label>
                                                                                <div class="col-md-8">
                                                                                    {!! Form::text('translatable['.strtolower($language->code).'][link][0][]',null,['class'=>'form-control input-md']) !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <button type="button"
                                                                                            class="btn btn-success add-link"
                                                                                            data-lang="{!!strtolower($language->code)!!}"
                                                                                            data-block="0"><i
                                                                                            class="fa fa-plus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="panel-group">
                                                    @foreach($footer_links[strtolower($language->code)] as $key=>$footer_link)
                                                        <div class="card panel panel-default mb-3">
                                                            <div class="card-header panel-heading">Panel Header
                                                                <div>
                                                                    <button type="button"
{{--                                                                            class="btn btn-primary add-section"--}}
                                                                            class="btn btn-danger remove-section"
                                                                            data-lang="{!!strtolower($language->code)!!}"
                                                                            data-block="{!! $key !!}"><i
                                                                                class="fa fa-minus"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body panel-body">
                                                                <!-- Text input-->
                                                                <div class="form-group">
                                                                    <div class="row mb-20">
                                                                        <label class="col-md-4 control-label col-form-label text-md-right"
                                                                               for="textinput">Name</label>
                                                                        <div class="col-md-4">
                                                                            {!! Form::text('translatable['.strtolower($language->code).'][name]['.$key.']',$footer_link['title'],['class'=>'form-control input-md']) !!}
                                                                        </div> <!-- Text input-->
                                                                    </div>

                                                                    <div class="links">
                                                                        @foreach($footer_link['children'] as $child)
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-5">
                                                                                    <div class="row">
                                                                                        <label class="col-md-4 control-label col-form-label text-md-right"
                                                                                               for="textinput">Title</label>
                                                                                        <div class="col-md-8">
                                                                                            {!! Form::text('translatable['.strtolower($language->code).'][title]['.$key.'][]',$child['title'],['class'=>'form-control input-md']) !!}
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    <div class="row">
                                                                                        <label class="col-md-4 control-label col-form-label text-md-right"
                                                                                               for="textinput">Link</label>
                                                                                        <div class="col-md-8">
                                                                                            {!! Form::text('translatable['.strtolower($language->code).'][link]['.$key.'][]',$child['link'],['class'=>'form-control input-md']) !!}
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4">
                                                                                            @if($loop->first)
{{--                                                                                                <button type="button"--}}
{{--                                                                                                        class="btn btn-primary add-link"--}}
{{--                                                                                                        data-lang="{!!strtolower($language->code)!!}"--}}
{{--                                                                                                        data-block="{!! $key !!}"><i--}}
{{--                                                                                                            class="fa fa-plus"></i>--}}
{{--                                                                                                </button>--}}
                                                                                                <button type="button"
                                                                                                        class="btn btn-danger remove-link"><i
                                                                                                        class="fa fa-minus"></i></button>
                                                                                            @else
                                                                                                <button type="button"
                                                                                                        class="btn btn-danger remove-link"><i
                                                                                                            class="fa fa-minus"></i></button>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                            @endforeach
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-2 offset-md-10">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <button type="button" class="btn btn-primary add-link">
                                                                                        <i class="fa fa-plus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>


        </div>
        <script type="template" id="add-section">

            <div class="card panel panel-default mb-3">
                <div class="card-header panel-heading">Panel Header
                    <div class="pull-right">
                        <button type="button" class="btn btn-danger remove-section"><i
                                    class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body panel-body">
                    <!-- Text input-->
                    <div class="form-group row">
                        <label class="col-md-4 control-label col-form-label text-right" for="textinput">Name</label>
                        <div class="col-md-4">
                            {!! Form::text('translatable[{code}][name][{block}]',null,['class'=>'form-control input-md']) !!}

                        </div>
                    </div> <!-- Text input-->
                    <div class="links">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <label class="col-md-4 control-label col-form-label text-md-right" for="textinput">Title</label>
                                        <div class="col-md-8">
                                            {!! Form::text('translatable[{code}][title][{block}][]',null,['class'=>'form-control input-md']) !!}

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <label class="col-md-4 control-label col-form-label text-md-right" for="textinput">Link</label>
                                        <div class="col-md-8">
                                            {!! Form::text('translatable[{code}][link][{block}][]',null,['class'=>'form-control input-md']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-success add-link" data-lang="{code}"
                                                    data-block="{block}"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </script>
        <script type="template" id="add-link">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <label class="col-md-4 control-label col-form-label text-md-right" for="textinput">Title</label>
                            <div class="col-md-8">
                                {!! Form::text('translatable[{code}][title][{block}][]',null,['class'=>'form-control input-md']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <label class="col-md-4 control-label col-form-label text-md-right" for="textinput">Link</label>
                            <div class="col-md-8">
                                {!! Form::text('translatable[{code}][link][{block}][]',null,['class'=>'form-control input-md']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="button"
                                        class="btn btn-danger remove-link"><i
                                            class="fa fa-minus"></i></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </script>
        @stop

        @section('css')


        @stop


        @section('js')
            <script type="text/javascript">
                $(function () {
                    $('body').on('click', '.add-section', function () {
                        let html = $('#add-section').html();
                        html = html.replace(/{code}/g, $(this).attr('data-lang'));
                        let block = ($(this).attr('data-block') / 1) + 1
                        html = html.replace(/{block}/g, block);
                        $(this).attr('data-block', block)
                        $(this).closest('.form-horizontal').find('.panel-group').append(html);
                    });
                    $('body').on('click', '.remove-section', function () {
                        $(this).closest('.panel').remove();
                    });

                    $('body').on('click', '.add-link', function () {
                        let html = $('#add-link').html();
                        html = html.replace(/{code}/g, $(this).attr('data-lang'));
                        html = html.replace(/{block}/g, $(this).attr('data-block'));
                        $(this).closest('.card-body').find('.links').append(html);
                    });

                    $('body').on('click', '.remove-link', function () {
                        $(this).closest('.form-group').remove();
                    });
                })
            </script>
    </div>
@stop
