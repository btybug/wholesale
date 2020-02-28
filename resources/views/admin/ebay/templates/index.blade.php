@extends('layouts.admin')
@section('content-header')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Home</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{!! route('admin_ebay_get_app_token') !!}">Get Application Token</a></li>
                <li><a href="{!! route('admin_ebay_get_user_token') !!}">Get User Token</a></li>
            </ul>
        </div>
    </div>
</nav>
<h1>OAuth token examples</h1>
<p>These examples will generate oauth tokens for the eBay <strong>sandbox</strong>.
<p><a class="btn btn-primary" href="{!! route('admin_ebay_get_app_token') !!}" role="button">Get an application token</a></p>
<p><a class="btn btn-primary" href="{!! route('admin_ebay_get_user_token') !!}" role="button">Get an user token</a></p>
@if(\App\Ebay\AuthEbay::exists())
    <p><a class="btn btn-primary" href="{!! route('admin_ebay_get_account') !!}" role="button">Get Account</a></p>
@endif
@stop
