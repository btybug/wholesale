@extends('layouts.admin')
@section('content')
    <section class="settings_lang">

        <div class="card panel panel-default">
            <div class="card-header panel-heading setting_lang_panel_head">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);">Listing All Languages</a>
                    </li>
                    <li class="nav-item">
                        @ok('admin_settings_language_manager')
                        <a class="nav-link text-white" href="{{ route('admin_settings_language_manager') }}">Language Manager </a>
                        @endok
                    </li>
                </ul>
                @ok('admin_settings_languages_new')
                <div class="box-tools pull-right">
                    <a href="{!! route('admin_settings_languages_new') !!}"
                       class="btn btn-primary">Add</a>
                </div>
                @endok
            </div>

            <div class="card-body panel-body">

                <div class="row">
                    <div class="col-xs-12">
                    </div>
                </div>

                <div class="row default-div hidden">
                    <div class="col-xs-12">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            Default language has been changed successfully!
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Default</th>
                                    <th>Language</th>
                                    <th>Native</th>
                                    <th>Icon</th>
                                    <th>Code</th>
                                    <th>Shared</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($languages as $language)
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="radio" name="languages_id" value="{!! $language->id !!}"
                                                       @if($language->default) checked @endif class="default_language">
                                            </label>
                                        </td>
                                        <td>{!! $language->name !!}</td>
                                        <td>{!! $language->original_name !!}</td>
                                        <td><span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span></td>
                                        <td>{!! $language->code !!}</td>
                                        <td>{!! ($language->shared) ? "YES" : "NO" !!}</td>
                                        <td>
                                            <div class="datatable-td__action">
                                            @ok('admin_settings_languages_edit')
                                            <a href="{!! route('admin_settings_languages_edit',$language->id) !!}"
                                               data-toggle="tooltip" data-placement="bottom" title="{!! $language->name !!}"
                                               class="btn btn-sm btn-warning">Edit</a>
                                            @endok
                                            @ok('admin_settings_languages_delete')
                                            <a href="{!! route('admin_settings_languages_delete',$language->id) !!}"
                                               data-toggle="tooltip" data-placement="bottom" title="{!! $language->name !!}"
                                               class="btn btn-danger btn-sm bg-red">x</a>
                                            @endok
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-12 text-right">

                        </div>
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
        $(document).ready(function () {
            $(".default_language").click(function () {
                var language_id = $(this).val();

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "/admin/settings/languages",
                    method: "POST",
                    data: {
                        language_id: language_id
                    },
                    success: function (r) {
                        location.reload()
                    }
                })
            })
        })
    </script>
@stop
