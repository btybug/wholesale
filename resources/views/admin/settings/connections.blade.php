@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row flex-column">
            @include("admin.settings._partials.menu",['active' => 'connections'])


            <div class="tab-content">
                <div class="tab-pane fade active in show" id="admin_settings_general">
                    <div class="row">
                        <div class="col-xl-9 col-lg-11">
                            <div class="card panel panel-default mb-3">
                                <div class="card-header panel-heading">SMTP SERVICE</div>
                                <div class="card-body panel-body">
                                    {!! Form::open(['class'=>'form-horizontal']) !!}

                                    <fieldset>
                                        <!-- Text input-->
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                   for="textinput">MAIL DRIVER</label>
                                            <div class="col-xl-4 col-sm-8">
                                                {!! Form::text('MAIL_DRIVER',env('MAIL_DRIVER'),['class'=>'form-control input-md']) !!}
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4  control-label col-form-label text-sm-right"
                                                   for="textinput">MAIL HOST</label>
                                            <div class="col-xl-4 col-sm-8">
                                                {!! Form::text('MAIL_HOST',env('MAIL_HOST'),['class'=>'form-control input-md']) !!}
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4  control-label col-form-label text-sm-right"
                                                   for="textinput">MAIL PORT</label>
                                            <div class="col-xl-4 col-sm-8">
                                                {!! Form::text('MAIL_PORT',env('MAIL_PORT'),['class'=>'form-control input-md']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                   for="textinput">MAIL USERNAME</label>
                                            <div class="col-xl-4 col-sm-8">
                                                {!! Form::text('MAIL_USERNAME',env('MAIL_USERNAME'),['class'=>'form-control input-md']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                   for="textinput">MAIL PASSWORD</label>
                                            <div class="col-xl-4 col-sm-8">
                                                {!! Form::text('MAIL_PASSWORD',env('MAIL_PASSWORD'),['class'=>'form-control input-md']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                   for="textinput">MAIL ENCRYPTION</label>
                                            <div class="col-xl-4 col-sm-8">
                                                {!! Form::text('MAIL_ENCRYPTION',env('MAIL_ENCRYPTION'),['class'=>'form-control input-md']) !!}
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                   for="singlebutton"></label>
                                            <div class="col-xl-4 col-sm-8">
                                                <button id="singlebutton" name="singlebutton" class="btn btn-info">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-9 col-lg-11">
                            <div class="card panel panel-default mb-3">
                                <div class=" card-header panel-heading">GMAIL API</div>
                                <div class="card-body panel-body">
                                    <div class="text-right">
                                        <a class="btn btn-success"
                                           href="{!!  route('analytics_login') !!}">Login @if(LaravelGmail::check())
                                                Other User @endif</a>
                                        @if(LaravelGmail::check())
                                            <a class="btn btn-danger" href="{!!  route('google_log_out') !!}">Logout</a>
                                        @endif
                                    </div>
                                    <div class="w-100">
                                        <h1 class="settings-connection-email-name text-truncate">{{ LaravelGmail::user() }}</h1>
                                    </div>
                                    {!! Form::open(['class'=>'form-horizontal','url'=>route('post_admin_gmail_settings')]) !!}
                                    <fieldset>
                                        <!-- Form Name -->
                                        <legend>Google Api Credentials</legend>
                                        <!-- Text input-->
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                   for="textinput">GOOGLE PROJECT ID</label>
                                            <div class="col-xl-4 col-sm-8">
                                                {!! Form::text('GOOGLE_PROJECT_ID',env('GOOGLE_PROJECT_ID'),['class'=>'form-control input-md']) !!}
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                   for="textinput">GOOGLE CLIENT ID</label>
                                            <div class="col-xl-4 col-sm-8">
                                                {!! Form::text('GOOGLE_CLIENT_ID',env('GOOGLE_CLIENT_ID'),['class'=>'form-control input-md']) !!}
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                   for="textinput">GOOGLE CLIENT SECRET</label>
                                            <div class="col-xl-4 col-sm-8">
                                                {!! Form::text('GOOGLE_CLIENT_SECRET',env('GOOGLE_CLIENT_SECRET'),['class'=>'form-control input-md']) !!}
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                   for="textinput">GOOGLE REDIRECT URI</label>
                                            <div class="col-xl-4 col-sm-8">
                                                {!! Form::text('GOOGLE_REDIRECT_URI','/admin/gmail/oauth/callback',['class'=>'form-control input-md']) !!}
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="form-group row">
                                            <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                   for="singlebutton"></label>
                                            <div class="col-xl-4 col-sm-8">
                                                <button id="singlebutton" name="singlebutton" class="btn btn-info">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-11">
                            <div class="card panel panel-default mb-3">
                                <div class="card-header panel-heading">MANAGE SITE API</div>
                                <div class="card-body panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::model($manage_api_settings,['class'=>'form-horizontal','url'=>route('post_admin_manage_api_settings')]) !!}
                                            <fieldset>
                                                <!-- Form Name -->
                                                <legend>Connection</legend>

                                                <!-- Text input-->
                                                <div class="form-group row">
                                                    <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                           for="textinput">Client ID</label>
                                                    <div class="col-xl-4 col-sm-8">
                                                        {!! Form::text('client_id',null,['class'=>'form-control input-md']) !!}
                                                    </div>
                                                </div>

                                                <!-- Text input-->
                                                <div class="form-group row">
                                                    <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                           for="textinput">Secret</label>
                                                    <div class="col-xl-4 col-sm-8">
                                                        {!! Form::text('client_secret',null,['class'=>'form-control input-md']) !!}
                                                    </div>
                                                </div>

                                                <!-- Button -->
                                                <div class="form-group row">
                                                    <label class="col-xl-4 col-sm-4 control-label col-form-label text-sm-right"
                                                           for="singlebutton"></label>
                                                    <div class="col-xl-4 col-sm-8">
                                                        <button type="submit" name="singlebutton"
                                                                class="btn btn-info">Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('public/admin_theme/plugins/timepicker/bootstrap-timepicker.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

@stop


@section('js')
    {!! Html::script("public/admin_theme/plugins/timepicker/bootstrap-timepicker.js")!!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(function () {


            $(".calendar").datepicker();
            $('.timepicker1').timepicker();
            $('#first_line_country').select2();
            $("body").on("click", ".add-new-social-input", function () {
                var uid = Math.random().toString(36).substr(2, 9);
                var html = `<div class="clearfix">
                    </div><div class="d-flex align-items-center w-100 social-container mt-3">
                    <div class="col-sm-6 p-0">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary dark_blue_gradient-cl dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-facebook-f icon-blue"></i>
                    </button><div class="dropdown-menu">
                    <a class="dropdown-item active"  href="javascript:void(0);"> <i class="fa fa-facebook icon-green"></i>  <span class="name">Facebook</span> </a> <a class="dropdown-item" href="javascript:void(0);"> <i class="fa fa-twitter icon-green"></i> <span class="name">Twitter</span></a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-yahoo icon-purple"></i>
                    <span class="name">Yahoo</span></a><a class="dropdown-item" href="javascript:void(0);">
                    <i class="fa fa-google icon-red"></i><span class="name">Google</span> </a> </div>
                    <input name="social_media[${uid}][social]" value="fab fa-facebook icon-green" type="hidden" class="social_type">
                    </div>
                    <input name="social_media[${uid}][url]" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Profile URL">
                    </div></div><div class="col-sm-3"><button class="plus-icon remove-new-social-input btn btn-danger">
                    <i class="fa fa-minus"></i></button></div></div>`;
                $(".social-media-group").append(html);
            });

            $("body").on("click", ".remove-new-social-input", function () {
                $(this).closest(".social-container").remove();
            });

            $("body").on("click", "#add-more-hours", function () {
                var uid = Math.random().toString(36).substr(2, 9);
                var html = '<tr><td><div class="form-group"><label for="weekday" class="mb-0">Weekday</label><select class="form-control"  name="opening_hours[weekday][]"><option value="Sunday" selected="selected">Sunday</option><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option></select> </div> </td> <td> ' +
                    '<div class="form-group"> ' +
                    '<strong>From</strong> ' +
                    '<div class="input-group bootstrap-timepicker timepicker">' +
                    '<input class="form-control timepicker1" name="opening_hours[time_from][]" type="text" >' +
                    '<label class="input-group-addon" for="timepicker1">' +
                    '<i class="glyphicon glyphicon-time"></i></label>' +
                    '</div></div> </td> <td> <div class="form-group"> ' +
                    '<strong>To</strong> ' +
                    '<div class="input-group bootstrap-timepicker timepicker"> ' +
                    '<input class="form-control timepicker1" name="opening_hours[time_to][]" type="text"> ' +
                    '<label class="input-group-addon" for="timepicker2">' +
                    '<i class="glyphicon glyphicon-time"></i>' +
                    '</label> </div> </div> </td> <td><button type="button" class="btn btn-danger pull-right remove-hour"><i class="fa fa-minus"></i></button>' +
                    '</td></tr>';
                $("#working-hours").append(html);
                $('.timepicker1').timepicker();
            });

            $("body").on("click", ".remove-hour", function () {
                $(this).closest("tr").remove();
            });
            $("body").on("click", "#add-more-calendar", function () {
                var uid = Math.random().toString(36).substr(2, 9);
                var html = '<tr> ' +
                    '<td> ' +
                    '<label for="calendar">Calendar</label> ' +
                    '<div class="input-group"> ' +
                    '<input class="form-control calendar" name="calendar[holidays][]" type="text"> ' +
                    '<label class="input-group-addon" for="calendar"><i class="glyphicon glyphicon-calendar"></i></label> ' +
                    '</div> ' +
                    '</td> ' +
                    '<td> ' +
                    '<input class="form-control" name="calendar[reason][]" type="text"> ' +
                    '</td> ' +
                    '<td> ' +
                    '<button type="button" class="btn btn-danger pull-right remove-calendar"><i class="fa fa-minus"></i></button> ' +
                    '</td> ' +
                    '</tr>';
                $("#calendar").append(html);
                $(".calendar").datepicker();

            });

            $("body").on("click", ".remove-calendar", function () {
                $(this).closest("tr").remove();
            });

            $("body").on("click", ".social-profile-page .dropdown-item", function () {
                var parent = $(this).closest(".input-group-prepend").find(".dropdown-toggle").find("i");

                var classList = $(this).find("i").attr("class");

                parent.attr("class", "").addClass(classList);
                $(this).closest(".input-group-prepend").find('.social_type').val(classList);
                $(this).parent().children().removeClass('active')
                $(this).addClass('active')
            });
        });
    </script>
@stop
