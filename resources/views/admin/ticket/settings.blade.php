@extends('layouts.admin')
@section('content-header')

@stop

@section('content')
    <div class="stock-page">
        {!! Form::model($settings,[]) !!}
        <div class="card panel panel-default">
            <div class="card-header panel-heading clearfix">
                <h2 class="m-0 pull-left">Settings</h2>
                <div class="text-right btn-save pull-right">
                    <a href="{!! route('admin_tickets') !!}" class="btn btn-action btn-default">Back</a>
                    {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                </div>
            </div>

           <div class="card-body panel-body">
               <div class="row sortable-panels">
                   <div class="col-md-7 ">
                       <div class="form-group">
                           <div class="row">
                               <div class="col-sm-12">
                                   <div class="form-group">
                                       <div class="form-group">
                                           <label>Select status - Open ticket</label>
                                           {!! Form::select('open',$statuses,null,['class'=>'form-control']) !!}
                                       </div>
                                       <div class="form-group">
                                           <label>Select status - Mark Completed</label>
                                           {!! Form::select('completed',$statuses,null,['class'=>'form-control']) !!}
                                       </div>
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
@stop
@section('css')

@stop
@section('js')

@stop