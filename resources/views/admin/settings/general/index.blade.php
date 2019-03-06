@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true" aria-expanded="true">General</a>
            </li>
        </ul>
        <div class="tab-content tab-content-store-settings" id="myTabContent">
            <div class="tab-pane fade active in" id="general" role="tabpanel" aria-labelledby="general-tab">
                <form>
                    <div class="form-group">
                        <label for="SiteName">Site Name</label>
                        <input type="text" class="form-control" id="SiteName" aria-describedby="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="siteLogo">Site Logo</label>
                        <input type="file" class="form-control" id="siteLogo">
                    </div>
                    <div class="form-group">
                        <label for="email">E-Mail Address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="email" placeholder="Enter E-Mail Address">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" aria-describedby="password" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <label for="firstAddress">1st line address</label>
                        <input type="text" class="form-control" id="firstAddress" aria-describedby="firstAddress" placeholder="Enter Address">
                    </div>
                    <div class="form-group">
                        <label for="secondAddress">2nd line address</label>
                        <input type="text" class="form-control" id="secondAddress" aria-describedby="secondAddress" placeholder="Enter Address">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <select id="city" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select id="country" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="postCode">Post Code</label>
                        <input type="text" class="form-control" id="postCode" aria-describedby="postCode" placeholder="Enter Post Code">
                    </div>
                    <div class="form-group">
                        <label for="metaTitle">Meta Title</label>
                        <input type="text" class="form-control" id="metaTitle" aria-describedby="metaTitle" placeholder="Your Store">
                    </div>
                    <div class="form-group">
                        <label for="metaTagDesc">Meta Tag Description</label>
                        <input type="text" class="form-control" id="metaTagDesc" aria-describedby="metaTagDesc" placeholder="My Store">
                    </div>
                    <div class="form-group">
                        <label for="metaTagKeywords">Meta Tag Keywords</label>
                        <input type="text" class="form-control" id="metaTagKeywords" aria-describedby="metaTagKeywords" placeholder="Meta Tag Keywords">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop