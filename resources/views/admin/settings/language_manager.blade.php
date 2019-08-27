@extends('layouts.admin')
@section('content')
    <section class="settings_lang">

        <div class="card panel panel-default">
            <div class="card-header panel-heading setting_lang_panel_head">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin_settings_languages') }}">Listing All Languages </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);">Language Manager {{ __("home") }} {{ app()->getLocale() }}</a>
                    </li>
                </ul>
            </div>
                <div class="card-body panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>KEY</th>
                                    @foreach($languages as $language)
                                        <th>{{ $language->name }}</th>
                                    @endforeach
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($keys as $key => $text)
                                    <tr>
                                        <td>
                                           {{ $key }}
                                        </td>
                                        @foreach($languages as $language)
                                            @php
                                            $translationData = $language->getTranslations();
                                            $translated = (isset($translationData[$key])) ? $translationData[$key] : '';
                                            @endphp
                                            <td>
                                                <a href="#" class="x-editable" data-type="text" data-pk="{{ $language->code }}" data-name="{{ $key }}"
                                                   data-url="/admin/settings/languages/manager" data-title="Enter Value">
                                                    {{ $translated }}
                                                </a>
                                            </td>
                                        @endforeach
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" data-toggle="tooltip" data-placement="bottom"  title="{!! $language->name !!}"  class="btn btn-sm btn-warning mr-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="{!! $language->name !!}" class="btn btn-sm bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="col-xs-12 text-right">

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
@stop
@section('css')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <script>
        $(document).ready(function(){
            $.fn.editable.defaults.ajaxOptions = { headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}};

            $('.x-editable').editable();
        })
    </script>
@stop