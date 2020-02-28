@extends('layouts.admin')
@section('content')
    {!! Form::model($model,['class'=>'form-horizontal']) !!}
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Export User</h2>
        </div>
        <div class="card-body">
            <!-- Multiple Checkboxes -->
            <div class="form-group row">
                <label class="col-md-4 control-label text-md-right" for="checkboxes">Columns</label>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label for="name">
                            <input type="hidden" name="name" value="0">
                            {!! Form::checkbox('name',1,null,['id'=>'name']) !!}
                            name
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="last_name">
                            <input type="hidden" name="last_name" value="0">
                            {!! Form::checkbox('last_name',1,null,['id'=>'last_name']) !!}
                            last name
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="email">
                            <input type="hidden" name="email" value="0">
                            {!! Form::checkbox('email',1,null,['id'=>'email']) !!}
                            email
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="email_verified_at">
                            <input type="hidden" name="email_verified_at" value="0">
                            {!! Form::checkbox('email_verified_at',1,null,['id'=>'email_verified_at']) !!}
                            email verified at
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="phone">
                            <input type="hidden" name="phone" value="0">
                            {!! Form::checkbox('phone',1,null,['id'=>'phone']) !!}
                            phone
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="avatar">
                            <input type="hidden" name="avatar" value="0">
                            {!! Form::checkbox('avatar',1,null,['id'=>'avatar']) !!}
                            avatar
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="country">
                            <input type="hidden" name="country" value="0">
                            {!! Form::checkbox('country',1,null,['id'=>'country']) !!}
                            country
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="gender">
                            <input type="hidden" name="checkboxes" value="0">
                            {!! Form::checkbox('gender',1,null,['id'=>'gender']) !!}
                            gender
                        </label>
                    </div>
                </div>
            </div>
            <!-- Button -->
            <div class="form-group row">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <button id="singlebutton" class="btn btn-info">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Name -->
    {!! Form::close() !!}
@stop
