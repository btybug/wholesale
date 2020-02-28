@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    {{ Form::model($comment,['url' => route('edit_comment_post',$comment->id), 'class' => '']) }}

    <div class="card panel panel-default">
        <div class="card-header panel-heading d-flex flex-wrap justify-content-between">
            <h2 class="m-0 pull-left">Edit Comment</h2>
            <div class="ml-1">
                <a href="{{route('show_comments')}}" class="btn btn-danger mr-10">{!! trans('admin.cancel') !!}</a>
                {{ Form::submit(trans('admin.save'), ['class' => 'btn btn-primary pull-right']) }}
            </div>
        </div>
        <div class="card-body panel-body">
            @if(! $comment->author)
                <div class="form-group row">
                    {{Form::label('guest_name', trans('admin.guest_name'),['class' => 'col-sm-2 control-label'])}}
                    <div class="col-sm-10">
                        {{Form::text('guest_name', null,['id' => 'guest_name','class' => $errors->has('guest_name') ? 'form-control  is-invalid' : "form-control ",])}}
                        @if ($errors->has('guest_name'))<span
                                class="invalid-feedback"><strong>{{ $errors->first('guest_name') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    {{Form::label('guest_email', trans('admin.guest_email'),['class' => 'col-sm-2 control-label'])}}
                    <div class="col-sm-10">
                        {{Form::text('guest_email', null,['id' => 'guest_email','class' => $errors->has('guest_email') ? 'form-control  is-invalid' : "form-control ",])}}
                        @if ($errors->has('guest_email'))<span
                                class="invalid-feedback"><strong>{{ $errors->first('guest_email') }}</strong></span>
                        @endif
                    </div>
                </div>
            @endif


            <div class="form-group row">
                {{Form::label('comment', trans('admin.comment'),['class' => 'col-sm-2 control-label'])}}
                <div class="col-sm-10">
                    {{Form::textarea('comment', null,['id' => 'comment','class' => $errors->has('comment') ? 'form-control  is-invalid' : "form-control "])}}
                    @if ($errors->has('comment'))<span
                            class="invalid-feedback"><strong>{{ $errors->first('comment') }}</strong></span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{ Form::close() }}
@stop
