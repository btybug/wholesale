@extends('layouts.admin')
@section('content-header')
    {{--<h1>--}}
    {{--Dashboard--}}
    {{--<small>Control panel</small>--}}
    {{--</h1>--}}
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="profile-header">

                <div class="profile-header-cover"></div>

                <div class="profile-header-content">

                    <div class="profile-header-img" style="width: 120px;height: 120px;">
                        <div class="person-img position-relative">
                            {!! Form::open() !!}
                            <div class="position-relative">
                                <div class="dropzone"
                                     data-image="{!! user_avatar() !!}"
                                     data-width="120" data-height="120" data-originalsize="false"
                                     data-url="{!! route('user_profile_image_upload') !!}">
                                    <input type="file" name="thumb" style="position: absolute;"/>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="profile-header-info">
                        <h4 class="m-t-10 m-b-5">{{ Auth::user()->name }}</h4>
                        <p class="m-b-10">{{ Auth::user()->role->title }}</p>
                    </div>

                </div>

                <ul class="profile-header-tab nav nav-tabs">
                    <li class="nav-item"><a href="{{ route('admin_dashboard') }}" class="nav-link">Dashboard</a></li>
                    <li class="nav-item"><a href="{{ route('admin_dashboard_profile') }}"
                                            class="nav-link active">Profile</a></li>
                </ul>

            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <div class="tab-content">
                <div id="users_profile" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="m-0">Profile</h3>
                        </div>
                        <div class="panel-body">
                            <!-- The timeline -->
                            {!! Form::model($user,['multiple'=>true]) !!}
                            {!! Form::hidden('id') !!}

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 control-label">First Name</label>

                                <div class="col-sm-10">
                                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                    {!! Form::text('last_name',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 control-label">E-mail </label>

                                <div class="col-sm-10">
                                    {!! Form::text('email',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-10">
                                    {!! Form::text('phone',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 control-label">Country</label>
                                <div class="col-sm-10">
                                    {!! Form::select('country',$countries,null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 control-label">Gender</label>
                                <div class="col-sm-10">
                                    {!! Form::select('gender',['male'=>'Male','female'=>'Female'],null,['class'=>'form-control']) !!}

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-10 text-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
        </div>
    </div>

@stop

@section('css')
    {!! Html::style("public/admin_assets/css/dashboard.css") !!}

    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    {!! Html::style('public/css/demo.html5imageupload.css') !!}

    <style>
        .errors {
            color: red;
        }
        .dropzone img.preview {
            width: 100%;
            height: 100%;
            object-fit: contain;
            font-family: 'object-fit: contain;';
        }

        .dropzone .tools {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 999;
            display: inline-block;
        }

        .dropzone.smalltools .tools .btn {
            padding: 1px 4px;
            font-size: 12px;
        }


        .dashboard-pages .person-img .dropzone:after {
            content: "\f382";
            font-weight: 900;
            top: 50%;
            transform: translateY(-50%);
            bottom: unset;
            font-size: 28px;
            color: #0eacc9;
        }
    </style>
@stop
@section('js')
    {!! Html::script('public/js/html5imageupload.js') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(function () {

            $('#retrievingfilename').html5imageupload({
                onAfterProcessImage: function () {
                    $('#filename').val($(this.element).data('name'));
                },
                onAfterCancel: function () {
                    $('#filename').val('');
                }

            });

            $('#save').html5imageupload({
                onSave: function (data) {
                },

            });

            $('.dropzone').html5imageupload({
                data: {_token: $('meta[name="csrf-token"]').attr('content')},
                onSave: function () {
                }
            });

            $("#myModal").on('shown.bs.modal', function () {
                $('#modaldialog').html5imageupload();
            });
        });

    </script>
@stop
