@extends('layouts.admin')
@section('content-header')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Home</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/get-app-token">Get Application Token</a></li>
                <li class="active"><a href="/get-user-token">Get User Token</a></li>
            </ul>
        </div>
    </div>
</nav>
<h1>Get User Token</h1>
<p>You will be re-directed to eBay to authorise the token. <a class="btn btn-primary" href="{{$url}}" role="button">Generate token</a></p>
<p>State <em>This value should match the one sent back via the API.</em></p>
<pre>{{$state}}</pre>
@stop
