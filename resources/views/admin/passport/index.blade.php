@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div id="app">
    <passport-clients></passport-clients>

    <passport-authorized-clients></passport-authorized-clients>

    <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
@stop

@section('css')
    <!-- Styles -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    @stop
