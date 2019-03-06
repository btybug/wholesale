@extends('layouts.admin')
@section('content')

    <h1>{{ LaravelGmail::user() }}</h1>
    @if(LaravelGmail::check())
        <a class="btn btn-warning" href="{{ url('admin/gmail/oauth/gmail/logout') }}">logout</a>
    @else
        {!! Form::open(['class'=>'form-horizontal']) !!}
        <fieldset>

            <!-- Form Name -->
            <legend>Google Api Credentials</legend>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">GOOGLE PROJECT ID</label>
                <div class="col-md-4">
                    {!! Form::text('GOOGLE_PROJECT_ID',env('GOOGLE_PROJECT_ID'),['class'=>'form-control input-md']) !!}
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">GOOGLE CLIENT ID</label>
                <div class="col-md-4">
                    {!! Form::text('GOOGLE_CLIENT_ID',env('GOOGLE_CLIENT_ID'),['class'=>'form-control input-md']) !!}
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">GOOGLE CLIENT SECRET</label>
                <div class="col-md-4">
                    {!! Form::text('GOOGLE_CLIENT_SECRET',env('GOOGLE_CLIENT_SECRET'),['class'=>'form-control input-md']) !!}
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">GOOGLE REDIRECT URI</label>
                <div class="col-md-4">
                    {!! Form::text('GOOGLE_REDIRECT_URI',env('GOOGLE_REDIRECT_URI'),['class'=>'form-control input-md']) !!}
                </div>
            </div>
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Save</button>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}

        <a class="btn btn-success" href="{{ url('admin/gmail/oauth/gmail') }}">login</a>
    @endif
@endsection