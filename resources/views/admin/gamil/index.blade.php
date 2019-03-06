@extends('layouts.admin')
@section('content')
    <h1>{{ LaravelGmail::user() }}</h1>
    @if(LaravelGmail::check())
        <a href="{{ url('admin/gmail/oauth/gmail/logout') }}">logout</a>
    @else
        <a href="{{ url('admin/gmail/oauth/gmail') }}">login</a>
    @endif
@endsection