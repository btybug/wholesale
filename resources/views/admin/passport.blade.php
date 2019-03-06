@extends('layouts.admin')
@section('content-header')
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@stop
@section('content')
    <!-- Main row -->
    <div class="row" id="app">
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
    <!-- /.row (main row) -->

@stop
@section('css')
    {!! Html::style('css/app.css') !!}
    @stop
@section('js')
    {!! Html::script('js/app.js') !!}
    @stop