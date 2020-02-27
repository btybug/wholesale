@extends('layouts.admin')
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading">
            <h2 class="m-0">{{ ($model) ? $model->name : "Form Name" }}</h2>
        </div>
        <div class="card-body panel-body">
           <div class="col-xl-8">
           {!! Form::model($model,['class'=>'','url'=>route('post_admin_suppliers')]) !!}
           {!! Form::hidden('id') !!}

           <!-- Text input-->
               <div class="form-group row">
                   <label class="col-md-2 control-label" for="name">Name</label>
                   <div class="col-md-10">
                       {!! Form::text('name',null,['class'=>'form-control input-md','id'=>'name']) !!}
                   </div>
               </div>
               <!-- Text input-->
               <div class="form-group row">
                   <label class="col-md-2 control-label" for="address">Address</label>
                   <div class="col-md-10">
                       {!! Form::text('address',null,['class'=>'form-control input-md','id'=>'address']) !!}
                   </div>
               </div>
               <!-- Text input-->
               <div class="form-group row">
                   <label class="col-md-2 control-label" for="phone">Phone</label>
                   <div class="col-md-10">
                       {!! Form::text('phone',null,['class'=>'form-control input-md','id'=>'phone']) !!}
                   </div>
               </div>
               <!-- Text input-->
               <div class="form-group row">
                   <label class="col-md-2 control-label" for="company">Company</label>
                   <div class="col-md-10">
                       {!! Form::text('company',null,['class'=>'form-control input-md','id'=>'company']) !!}
                   </div>
               </div>     <!-- Text input-->
               <div class="form-group row">
                   <label class="col-md-2 control-label" for="textinput">Email</label>
                   <div class="col-md-10">
                       {!! Form::email('email',null,['class'=>'form-control input-md','id'=>'email']) !!}
                   </div>
               </div>     <!-- Text input-->
               <div class="form-group row">
                   <label class="col-md-2 control-label" for="fax">Fax</label>
                   <div class="col-md-10">
                       {!! Form::text('fax',null,['class'=>'form-control input-md','id'=>'fax']) !!}
                   </div>
               </div>

               <!-- Textarea -->
               <div class="form-group row">
                   <label class="col-md-2 control-label" for="notes">Notes</label>
                   <div class="col-md-10">
                       {!! Form::textarea('notes',null,['class'=>'form-control','id'=>'notes']) !!}
                   </div>
               </div>
               <!-- Button -->
               <div class="form-group row">
                   <label class="col-md-2 control-label" ></label>
                   <div class="col-md-10 text-right">
                       <button type="submit" class="btn btn-primary">Save</button>
                   </div>
               </div>

               {!! Form::close() !!}
           </div>
        </div>
    </div>


@stop
