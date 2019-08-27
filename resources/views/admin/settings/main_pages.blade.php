@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

    <div class="container-fluid">
        <div class="row flex-column">
            @include("admin.settings._partials.menu",['active'=> 'main_pages'])
        </div>
        <div class="tab-content">
            <div class="row">
                <div class="col-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link @if($p=='main_pages') active @endif" href="?p=main_pages">Home page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($p=='tc') active @endif" href="?p=tc">T&C</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($p=='about_us')active @endif" href="?p=about_us">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($p=='single_product')active @endif" href="?p=single_product">Single
                                Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($p=='single_post')active @endif" href="?p=single_post">Single
                                Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($p=='confirmation_page')active @endif" href="?p=confirmation_page">Confirmation
                                Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($p=='my_account')active @endif" href="?p=my_account">My Account</a>
                        </li>
                    </ul>
                </div>
                <div class="col-9">
                    @include("admin.settings._partials.main_pages.".$p)
                </div>
            </div>

        </div>


    </div>
    <script type="template" id="add-more-banners">
        <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
            <div class="col-sm-6 p-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        {!! media_button($p.'[]',$model) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <button class="plus-icon remove-new-banner-input btn btn-danger">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
    </script>
@stop
