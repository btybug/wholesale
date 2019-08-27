@extends('layouts.admin')
@section('content-header')

@stop

@section('content')
    {!! Form::model($settings,[]) !!}
    <div class="card panel panel-default stock-page">
        <div class="card-header panel-heading clearfix">
            <h2 class="m-0 pull-left">Order Settings</h2>
            <div class="pull-right">
                <a href="{!! route('admin_orders') !!}" class="btn btn-default btn-action">Back</a>
                {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        <div class="card-body panel-body">

            <div class="row sortable-panels">
                <div class="col-md-9">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Select status - Order made</label>
                        <div class="col-md-10">
                            {!! Form::select('open',$statuses,null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@stop
@section('css')

@stop
@section('js')

@stop