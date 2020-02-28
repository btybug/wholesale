@extends('layouts.account',['activePage'=>'staff'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Manage Staff member</h4>
                            <p class="card-category">Complete profile</p>
                        </div>
                        <div class="card-body">
                            {!! Form::model((isset($model)?$model:null),[ 'enctype'=>"multipart/form-data"]) !!}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Name</label>
                                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Last Name</label>
                                        {!! Form::text('last_name',0,['class'=>'form-control','min'=>'0','step'=>1]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">E-mail</label>
                                        {!! Form::text('email',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Phone</label>
                                        {!! Form::text('phone',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Birthday</label>
                                        {!! Form::date('birthday',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Pass Type</label>
                                        {!! Form::select('pass_type',['passport'=>'Passport','id'=>'ID'],null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Pass/ID</label>
                                        {!! Form::text('pass',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class=" bmd-form-group">
                                        <label class="bmd-label-floating" for="staff_photo">Photo</label>
                                        {!! Form::file('photo',['id'=>'staff_photo']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Salary</label>
                                        {!! Form::number('salary',null,['class'=>'form-control','min'=>0,'step'=>'0.01']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Status</label>
                                        {!! Form::select('status',[0=>'Working',1=>'Vacation',2=>'Fired',3=>'Busy with the director'],null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Gender</label>
                                        {!! Form::select('gender',['male'=>'Male','female'=>'Female'],null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Family status</label>
                                        {!! Form::select('family_status',['single'=>'Single','married'=>'Married'],null,['class'=>'form-control']) !!}
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Role</label>
                                        {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Rate</label>
                                        {!! Form::number('rating',null,['class'=>'form-control','min'=>0]) !!}

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Shop</label>
                                        {!! Form::select('shop_id',$shops,null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Hired at</label>
                                        {!! Form::date('hired_at',null,['class'=>'form-control','min'=>0]) !!}

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Address</label>
                                        {!! Form::text('address',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Create</button>
                            <div class="clearfix"></div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
@stop
