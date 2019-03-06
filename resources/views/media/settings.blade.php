@extends('layouts.mTabs',['index'=>'module_settings'])
@section('tab')
    <div class="container-fluid">
        <div class="row">
            <h2>Default Settings</h2>
        </div>
        <div class="row">
            {!! Form::open(['class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('directory_default_max_size','Default Max Size',[])!!}
                {!! Form::text('directory_default_max_size',isset($settings['directory_default_max_size']) ? $settings['directory_default_max_size'] : null,['class'=>'form-control','placeholder'=>'Enter folder default max size'])!!}
            </div>
            <div class="form-group">
                {!! Form::label('directory_default_extension','Default Extension',[])!!}
                {!! Form::text('directory_default_extension',isset($settings['directory_default_extension']) ? $settings['directory_default_extension'] : '.*',['class'=>'form-control','placeholder'=>'Enter folder default accepted extension'])!!}
            </div>
            <div class="form-group">
                {!! Form::label('directory_default_uploader','Default Uploader',[])!!}
                {!! Form::select('directory_default_uploader', $uploaders, isset($settings['directory_default_uploader']) ? $settings['directory_default_uploader'] : null, ['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
                {!! Form::submit('Store',['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop