@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row flex-column">
            @include("admin.settings._partials.menu",['active' => 'general'])

            <div class="tab-content w-100">
                {!! Form::model($model) !!}

                <div class="tab-pane fade active in show" id="admin_settings_general">
                    <div class="row">
                        <div class="col-lg-7 col-sm-6">
                            <div class="card panel panel-default mb-3">
                                <div class="card-header panel-heading">Basics</div>
                                <div class="card-body panel-body">
                                    <div class="row">
                                        <div class="col-xl-7 col-lg-10">
                                            <div class="form-group row">
                                                <label for="SiteName" class="col-md-3 col-form-label">Site Name</label>
                                                <div class="col-md-9">
                                                    {!! Form::text('site_name',env('SITE_NAME'),['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="siteLogo" class="col-md-3 col-form-label">Site Logo</label>
                                                <div class="col-md-9">
                                                    {!! media_button('siteLogo',$model) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="description" class="col-md-3 col-form-label">Description</label>
                                                <div class="col-md-9">
                                                    {!! Form::textarea('site_description',null,['class'=>'form-control','rows'=>5]) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="description" class="col-md-3 col-form-label">Site Code</label>
                                                <div class="col-md-9">
                                                    {!! Form::text('site_code',null,['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card panel panel-default social-profile-page mb-3">
                                <div class="card-header panel-heading">Social Profile</div>
                                <div class="card-body panel-body">
                                    <div class="form-group d-flex flex-wrap align-items-center social-media-group">
                                        @if($model && isset($model->social_media) && @json_decode($model->social_media,true))

                                            @php
                                                $social_medias=json_decode($model->social_media,true);
                                            @endphp
                                            @foreach($social_medias as $key=>$social_media)
                                                <div class="clearfix"></div>
                                            <div class="d-flex align-items-center w-100">
                                                <div class="col-sm-6 col-9 p-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-outline-secondary dark_blue_gradient-cl dropdown-toggle"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <i class="{!! $social_media['social'] !!}"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item @if($social_media['social']=='fab fa-facebook-f icon-green') active @endif"
                                                                   href="javascript:void(0);">
{{--                                                                    <i class="fa fa-facebook icon-green"></i>--}}
                                                                    <i class="fab fa-facebook-f"></i>
                                                                    <span class="name">Facebook</span>
                                                                </a>
                                                                <a class="dropdown-item @if($social_media['social']=='fab fa-twitter icon-green') active @endif" href="javascript:void(0);">
{{--                                                                    <i class="fa fa-twitter icon-green"></i>--}}
                                                                    <i class="fab fa-twitter"></i>
                                                                    <span class="name">Twitter</span>
                                                                </a>
                                                                <a class="dropdown-item @if($social_media['social']=='fab fa-pinterest icon-purple') active @endif" href="javascript:void(0);">
{{--                                                                    <i class="fa fa-yahoo icon-purple"></i>--}}
                                                                    <i class="fab fa-pinterest"></i>
                                                                    <span class="name">Pinterest</span>
                                                                </a>
                                                                <a class="dropdown-item @if($social_media['social']=='fab fa-instagram icon-red') active @endif" href="javascript:void(0);">
{{--                                                                    <i class="fa fa-google icon-red"></i>--}}
                                                                    <i class="fab fa-instagram"></i>
                                                                    <span class="name">Instagram</span>
                                                                </a>
                                                                <a class="dropdown-item @if($social_media['social']=='fab fa-linkedin icon-red') active @endif" href="javascript:void(0);">
                                                                    <i class="fab fa-linkedin"></i>
                                                                    <span class="name">Linkendin</span>
                                                                </a>
                                                            </div>

                                                            {!! Form::hidden('social_media['.$key.'][social]',$social_media['social'],['class'=>'social_type']) !!}
                                                        </div>
                                                        {!! Form::text('social_media['.$key.'][url]', $social_media['url'], ['class' => 'form-control','id' => 'socialMedia','placeholder' => 'Profile URL','aria-label' => 'Text input with dropdown button']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-3">
                                                    @if(!$key)
                                                        <button type="button" class="btn btn-primary add-new-social-input">
                                                            <i
                                                                class="fa fa-plus"></i></button>
                                                    @else
                                                        <button class="plus-icon remove-new-social-input btn btn-danger">
                                                            <i class="fa fa-minus"></i></button>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                            <div class="col-sm-6 p-0">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-secondary dark_blue_gradient-cl dropdown-toggle"
                                                                type="button" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="fa fa-facebook-f icon-blue"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item active" href="javascript:void(0);">
                                                                <i class="fa fa-facebook icon-green"></i>
                                                                <span class="name">Facebook</span>
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i class="fa fa-twitter icon-green"></i>
                                                                <span class="name">Twitter</span>
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i class="fa fa-yahoo icon-purple"></i>
                                                                <span class="name">Yahoo</span>
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i class="fa fa-google icon-red"></i>
                                                                <span class="name">Google</span>
                                                            </a>
                                                        </div>

                                                        {!! Form::hidden('social_media[0][social]',null,['class'=>'social_type']) !!}
                                                    </div>
                                                    {!! Form::text('social_media[0][url]', null, ['class' => 'form-control','id' => 'socialMedia','placeholder' => 'Profile URL','aria-label' => 'Text input with dropdown button']) !!}
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="button" class="btn btn-primary add-new-social-input"><i
                                                            class="fa fa-plus"></i></button>
                                                {{--<span class="plus-icon add-new-social-input"><i class="fa fa-plus"></i></span>--}}
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="card panel panel-default mb-3">
                                <div class="card-header panel-heading">Address</div>
                                <div class="card-body panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="firstAddress" class="col-md-4 col-form-label">1st line address</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('first_address',null,['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="secondAddress" class="col-md-4 col-form-label">2nd line address</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('second_address',null,['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="country" class="col-md-4 col-form-label">Country</label>
                                                <div class="col-md-8">
                                                    {!! Form::select('country',$countries,null,['class'=>'form-control','id' => 'first_line_country','style'=>'width:100%']) !!}
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="city" class="col-md-4 col-form-label">City</label>
                                                <div class="col-md-8">
                                                    <div id="regions">
                                                        {!! Form::text('city',null,['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="postCode" class="col-md-4 col-form-label">Post Code</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('post_code',null,['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="postCode" class="col-md-4 col-form-label">Phone</label>
                                                <div class="col-md-8">
                                                    {!! Form::text('phone',null,['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="postCode" class="col-md-4 col-form-label">Email</label>
                                                <div class="col-md-8">
                                                    {!! Form::email('email',null,['class'=>'form-control']) !!}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="settings-map-outer">
                                                <iframe
                                                    src="https://www.google.com/maps/embed/v1/place?key=&q=Armenia"
                                                    {{--{{ $settings->first_address. '+'.$settings->second_address. '+'.$settings->city. '+'.$settings->post_code. '+'.$settings->country }}"--}}
                                                    width="100%" height="100%" frameborder="0" style="border:0"
                                                    allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <div class="col-lg-5 col-sm-6">
                            <div class="text-right">
                                <button class="btn btn-info mb-20 mt20" type="submit">Save</button>
                            </div>
                            <div class="card panel panel-default mb-3">
                                <div class="card-header panel-heading">Date/Time Format</div>
                                <div class="card-body panel-body">
                                    <div class="form-group row">
                                        <label for="dateFormat" class="col-md-3 col-form-label">Date Format</label>
                                        <div class="col-md-9">
                                            {!! Form::select('date_format',[
                                        'd M Y'=>'1 July 2019',
                                        'M-D-y'=>'May-09-78',
                                        'm/d/y'=>'12/22/78',
                                        'd/M/Y'=>'31/DEC/2018',
                                        'D/M/Y'=>'02/MAY/2016',
                                        'Y/M/D'=>'2013/FEB/27',
                                        ],null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="timeFormat" class="col-md-3 col-form-label">Time Format</label>
                                        <div class="col-md-9">
                                            {!! Form::select('time_format',[
                                          '12hrs'=>'12hrs',
                                          '24hrs'=>'24hrs',
                                          'seconds'=>'Seconds',
                                          ],null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card panel panel-default mb-3">
                                <div class="card-header panel-heading">Opening Hours</div>
                                <div class="card-body panel-body form-inline">
                                    <div class="row w-100">
                                        <div class="col-xl-12">
                                            <div class="table-responsive">
                                                <table class="table table--opening-hours" id="working-hours">
                                                    @if($model && isset($model->opening_hours) && @json_decode($model->opening_hours,true))

                                                        @php
                                                            $openingHours=@json_decode($model->opening_hours,true);
                                                        @endphp

                                                        @foreach($openingHours['weekday'] as $key=>$weekday)
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group mb-0">
                                                                        <label for="weekday" class="mb-0">Weekday</label>
                                                                        {!! Form::select('opening_hours[weekday][]',[
                                                                        'Sunday'=>'Sunday',
                                                                        'Monday'=>'Monday',
                                                                        'Tuesday'=>'Tuesday',
                                                                        'Wednesday'=>'Wednesday',
                                                                        'Thursday'=>'Thursday',
                                                                        'Friday'=>'Friday',
                                                                        'Saturday'=>'Saturday',
                                                                        ],$weekday,['class'=>'form-control','id' => 'geo_country']) !!}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group mb-0">
                                                                        <strong>From</strong>
                                                                        <div class="input-group bootstrap-timepicker timepicker flex-nowrap">
                                                                            {!! Form::text('opening_hours[time_from][]',$openingHours['time_from'][$key],['class'=>'form-control timepicker1']) !!}
                                                                            <label class="input-group-addon input-group-append mb-0"
                                                                                   for="timepicker1">
                                                                                <span class="input-group-text h-100"> <i class="fa fa-clock-o"></i></span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group mb-0">
                                                                        <strong>To</strong>
                                                                        <div class="input-group bootstrap-timepicker timepicker flex-nowrap">
                                                                            {!! Form::text('opening_hours[time_to][]',$openingHours['time_from'][$key],['class'=>'form-control timepicker1']) !!}
                                                                            <label class="input-group-addon input-group-append mb-0"
                                                                                   for="timepicker2"><span class="input-group-text h-100"> <i class="fa fa-clock-o"></i></span></label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    @if(!$key)
                                                                        <button type="button"
                                                                                class="btn btn-primary pull-right"
                                                                                id="add-more-hours"><i
                                                                                class="fa fa-plus"></i>
                                                                        </button>
                                                                    @else
                                                                        <button type="button"
                                                                                class="btn btn-danger pull-right remove-hour">
                                                                            <i class="fa fa-minus"></i></button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="weekday" class="mb-0">Weekday</label>
                                                                    {!! Form::select('opening_hours[weekday][]',[
                                                                    'Sunday'=>'Sunday',
                                                                    'Monday'=>'Monday',
                                                                    'Tuesday'=>'Tuesday',
                                                                    'Wednesday'=>'Wednesday',
                                                                    'Thursday'=>'Thursday',
                                                                    'Friday'=>'Friday',
                                                                    'Saturday'=>'Saturday',
                                                                    ],null,['class'=>'form-control','id' => 'geo_country']) !!}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <strong>From</strong>
                                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                                        {!! Form::text('opening_hours[time_from][]',null,['class'=>'form-control timepicker1']) !!}
                                                                        <label class="input-group-addon input-group-append"
                                                                               for="timepicker1"><span class="input-group-text h-100"> <i class="fa fa-clock-o"></i></span></label>
                                                                    </div>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <strong>To</strong>
                                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                                        {!! Form::text('opening_hours[time_to][]',null,['class'=>'form-control timepicker1']) !!}
                                                                        <label class="input-group-addon input-group-append"
                                                                               for="timepicker2"><span class="input-group-text h-100"> <i class="fa fa-clock-o"></i></span></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary pull-right"
                                                                        id="add-more-hours"><i class="fa fa-plus"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card panel panel-default mb-3">
                                <div class="card-header panel-heading">Holidays</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="table-responsive">
                                                <table class="table table--holidays" id="calendar">
                                                    @if($model && isset($model->calendar) && @json_decode($model->calendar,true))

                                                        @php
                                                            $calendar=@json_decode($model->calendar,true);
                                                        @endphp

                                                        @foreach($calendar['holidays'] as $key=>$holidays)
                                                            <tr>
                                                                <td>
                                                                    <label for="calendar">Calendar</label>
                                                                    <div class="input-group">
                                                                        {!! Form::text('calendar[holidays][]',$holidays,['class'=>'form-control calendar']) !!}
                                                                        <label class="input-group-addon input-group-append" for="calendar">
                                                                            <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {!! Form::text('calendar[reason][]',$calendar['reason'][$key],['class'=>'form-control']) !!}
                                                                </td>
                                                                <td>
                                                                    @if(!$key)
                                                                        <button type="button" class="btn btn-primary pull-right"
                                                                                id="add-more-calendar"><i
                                                                                class="fa fa-plus"></i></button>
                                                                    @else
                                                                        <button type="button"
                                                                                class="btn btn-danger pull-right remove-calendar">
                                                                            <i class="fa fa-minus"></i></button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <label for="calendar">Calendar</label>
                                                                <div class="input-group">
                                                                    {!! Form::text('calendar[holidays][]',null,['class'=>'form-control calendar']) !!}
                                                                    <label class="input-group-addon input-group-append" for="calendar"><span class="input-group-text h-100"><i class="fa fa-calendar"></i></span></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {!! Form::text('calendar[reason][]',null,['class'=>'form-control']) !!}
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary pull-right"
                                                                        id="add-more-calendar"><i class="fa fa-plus"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
                    '<label class="input-group-addon input-group-append" for="timepicker1">' +
                    '<span class="input-group-text h-100"> <i class="fa fa-clock-o"></i></span>' +
                    '</div></div> </td> <td> <div class="form-group"> ' +
                    '<strong>To</strong> ' +
                    '<div class="input-group bootstrap-timepicker timepicker"> ' +
                    '<input class="form-control timepicker1" name="opening_hours[time_to][]" type="text"> ' +
                    '<label class="input-group-addon input-group-append" for="timepicker2">' +
                    '<span class="input-group-text h-100"> <i class="fa fa-clock-o"></i></span>' +
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
                    '<label class="input-group-addon input-group-append" for="calendar"><span class="input-group-text h-100"><i class="fa fa-calendar"></i></span></label> ' +
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
