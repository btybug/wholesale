@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

    <div class="container-fluid">
        <div class="row flex-column">
            @include("admin.settings._partials.menu",['active'=> 'main_pages'])

            <div class="tab-content">
                <div class="row">
                    <div class="col-sm-3 col-4 pr-md-3 pr-0">
                        <div class="nav flex-column list-group mt-3">
                            <a class="list-group-item list-group-item-action @if($p=='banners') active @endif" href="?p=banners">Home page</a>
                            <a class="list-group-item list-group-item-action @if($p=='tc') active @endif" href="?p=tc">T&C</a>
                            <a class="list-group-item list-group-item-action @if($p=='about_us')active @endif" href="?p=about_us">About us</a>
                            <a class="list-group-item list-group-item-action @if($p=='privacy')active @endif" href="?p=privacy">Privacy</a>
                            <a class="list-group-item list-group-item-action @if($p=='cookies')active @endif" href="?p=cookies">Cookies</a>
                            <a class="list-group-item list-group-item-action @if($p=='ads')active @endif" href="?p=ads">Ads</a>
                            <a class="list-group-item list-group-item-action @if($p=='stickers')active @endif" href="?p=stickers">Sticker</a>
                            <a class="list-group-item list-group-item-action @if($p=='brands')active @endif" href="?p=brands">Brands</a>
                        </div>
                    </div>
                    <div class="col-sm-9 col-8">
                        @include("admin.settings._partials.main_pages.".$p)
                    </div>
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
