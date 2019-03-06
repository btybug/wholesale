@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="box box-info">
        {{ Form::open(['url' => route('reply_comment_post',$comment->id), 'class' => 'form-horizontal']) }}
        <div class="box-body">
            <div class="form-group">
                <div class="text-center head">
                    <h3>Replying to</h3>
                    <span>
                        @if($comment->author)
                            Author : {{ $comment->author->name }}
                        @else
                            Author : {{ $comment->guest_name . ' ('.$comment->guest_email.')' }}
                        @endif
                    </span>

                </div>
                <div class="comments">
                    <div class="single">
                        {!! $comment->comment !!}
                    </div>

                </div>
            </div>
            <div class="form-group">
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

    <div class="box-footer">
        <a href="{{route('show_comments')}}" class="btn btn-default">{!! trans('admin.cancel') !!}</a>
        {{ Form::submit(trans('admin.save'), ['class' => 'btn btn-info pull-right']) }}
    </div>
    {{ Form::close() }}
@stop
@section('css')
    <style>
        .head{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
        .head span{

        }
        .head h3{
            margin: 0;
            margin-right: 15px;
            font-size: 16px;
            font-weight: bold;
        }
        .comments{
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .comments .single{
            padding: 20px;
            border-radius: 6px;
            background-color: #EEEEEE;
        }
    </style>
@stop