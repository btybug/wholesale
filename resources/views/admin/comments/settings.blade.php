@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    {{ Form::model($model,[]) }}
        <div class="card panel panel-default">
            <div class="card-header panel-heading d-flex flex-wrap justify-content-between">
                <h2 class="m-0 pull-left">Comment settings</h2>
                <div class="ml-1">
                    <a href="{{route('show_comments')}}" class="btn btn-danger mr-10">{!! trans('Cancel') !!}</a>
                    {{ Form::submit(trans('admin.save'), ['class' => 'btn btn-primary pull-right']) }}
                </div>
            </div>
            <div class="card-body panel-body">
                <div class="form-group row">
                    {{Form::label('status', "Comment approve",['class' => 'col-sm-2 control-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('status',[''=> "Select",1 => "No",0 => "Yes"],null,['class' => $errors->has('status') ? 'form-control  is-invalid' : "form-control ",])}}
                        @if ($errors->has('status'))<span
                            class="invalid-feedback"><strong>{{ $errors->first('status') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    {{Form::label('user_delete', "Comment delete",['class' => 'col-sm-2 control-label'])}}
                    <div class="col-sm-10">
                        {{Form::select('user_delete',[''=> "Select",1 => "Yes",0 => "No"],null,['class' => $errors->has('user_delete') ? 'form-control  is-invalid' : "form-control ",])}}
                        @if ($errors->has('user_delete'))<span
                            class="invalid-feedback"><strong>{{ $errors->first('user_delete') }}</strong></span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    {{ Form::close() }}
@stop
