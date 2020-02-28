@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading"><h2 class="m-0">Stripe</h2></div>
        <div class="card-body panel-body">
            <div class="row">
                <div class="col-xl-9 col-lg-11">
                    {!! Form::model($model,['class'=>''])!!}
                    <div class="form-group row">
                        <label for="text" class="control-label col-sm-3">Payment Name</label>
                        <div class="col-sm-9">
                            {!! Form::text('stripe_payment_name',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="control-label col-sm-3">Description</label>
                        <div class="col-sm-9">
                            {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="control-label col-sm-3">Image</label>
                        <div class="col-sm-9">
                            {!! media_button('stripe_image',$model) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text1" class="control-label col-sm-3">Icon</label>
                        <div class="col-sm-9">
                            {!! Form::text('icon',null,['class'=>'form-control icon-picker']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="control-label col-sm-3">Stripe Key</label>
                        <div class="col-sm-9">
                            {!! Form::text('stripe_key',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text1" class="control-label col-sm-3">Stripe Secret</label>
                        <div class="col-sm-9">
                            {!! Form::text('stripe_secret',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                            <button  type="submit" class="btn btn-info">Save</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="stylesheet" href="https://farbelous.io/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')
    <script src="https://farbelous.io/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js"></script>
    <script>
        $('.icon-picker').iconpicker();
    </script>
@stop
