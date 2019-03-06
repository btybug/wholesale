@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
   <div class="panel panel-default">
       <div class="panel-heading clearfix">
           <h2 class="m-0 pull-left"> New Staff</h2>
           <ol class="breadcrumb pull-right m-0">
               <li><a href="http://demo0.laravelcommerce.com/admin/dashboard/this_month"><i class="fa fa-dashboard"></i>
                       Dashboard</a></li>
               <li class="active">New Staff</li>
           </ol>
       </div>

       <div class="panel-body">

           <div class="row">
               <div class="col-md-9">
                   <div class="tab-content">
                           <div id="users_profile" class="tab-pane fade in active">
                               {!! Form::open(['class'=>'']) !!}
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
                                   <label for="inputExperience" class="col-sm-2 control-label">Status</label>
                                   <div class="col-sm-10">
                                       {!! Form::select('status',[0=>'In Active',1=>'Active'],null,['class'=>'form-control']) !!}

                                   </div>
                               </div>
                               <div class="form-group row">
                                   <label for="inputExperience" class="col-sm-2 control-label">Role</label>
                                   <div class="col-sm-10">
                                       {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}

                                   </div>
                               </div>


                               <div class="form-group row">
                                   <div class="col-sm-offset-2 col-sm-10 text-right">
                                       <button type="submit" class="btn btn-success">Update</button>
                                   </div>
                               </div>
                               {!! Form::close() !!}

                           </div>
                           <div id="users_logs" class="tab-pane fade">
                               <h3>Logs</h3>
                           </div>
                           <div id="users_favourites" class="tab-pane fade">
                               <h3>Favourites</h3>
                           </div>
                           <!-- /.tab-pane -->
                       </div>

               </div>

           </div>

       </div>
   </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')
@stop