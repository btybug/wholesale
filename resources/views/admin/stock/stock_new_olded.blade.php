@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

    {!! Form::model($model,['class'=>'form-horizontal stock-form','url' => route('admin_stock_save')]) !!}
    <div class="card">
        <div class="card-header clearfix">
            <h2 class="m-0 pull-left">{{ ($model) ? $model->name : "New Product" }}</h2>
            <div class="pull-right">
                {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                @if($model && ! isset($offer))
                <a target="_blank" class="btn btn-info" href="{{ route('product_single', ['type' =>"vape", 'slug' => $model->slug]) }}">View</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <section class="content stock-page mt-0 p-0">

                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs admin-profile-left">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#basic">Basic
                                    Details</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#technical">Technical</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#variations">Required</a>
                            </li>
                            @if(! isset($offer))
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#extra">Special
                                        Offers</a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#seo">Seo</a></li>
                        </ul>
                    </div>


                    {!! Form::hidden('id',null,['id' => "stockID"]) !!}
                    <div class="col-md-12">
                        <div class="tab-content tabs_content">
                            <div id="basic" class="tab-pane fade in active show basic-details-tab ">
                                <div class="container-fluid p-25">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="basic-center basic-wall">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-7 col-sm-8">
                                                        @if(count(get_languages()))
                                                            <ul class="nav nav-tabs">
                                                                @foreach(get_languages() as $language)
                                                                    <li class="nav-item"><a
                                                                            class="nav-link @if($loop->first) active @endif"
                                                                            data-toggle="tab"
                                                                            href="#{{ strtolower($language->code) }}">
                                                                            <span
                                                                                class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                                        </a></li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                        <div class="tab-content mt-20">
                                                            @if(count(get_languages()))
                                                                @foreach(get_languages() as $language)
                                                                    <div id="{{ strtolower($language->code) }}"
                                                                         class="tab-pane fade  @if($loop->first) in active show @endif">
                                                                        <div class="form-group row mt-3">
                                                                            <label
                                                                                class="col-xl-2 control-label col-form-label text-xl-right"><span
                                                                                    data-toggle="tooltip"
                                                                                    title=""
                                                                                    data-original-title="Attribute Name Title">Product Name</span></label>
                                                                            <div class="col-xl-10">
                                                                                {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($model,strtolower($language->code),'name'),['class'=>'form-control']) !!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label
                                                                                class="col-xl-2 control-label col-form-label text-xl-right"><span
                                                                                    data-toggle="tooltip"
                                                                                    title=""
                                                                                    data-original-title="Short Description">Short Description</span></label>
                                                                            <div class="col-xl-10">
                                                                                {!! Form::textarea('translatable['.strtolower($language->code).'][short_description]',get_translated($model,strtolower($language->code),'short_description'),['class'=>'form-control','cols'=>30,'rows'=>2]) !!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="product_id"
                                                                                   class="control-label col-xl-4 control-label col-form-label text-xl-right">Product
                                                                                Slug (for url)</label>
                                                                            <div class="col-xl-8">
                                                                                {!! Form::text('translatable['.strtolower($language->code).'][slug]',get_translated($model,strtolower($language->code),'slug'),['class'=>'form-control']) !!}

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        {{--<div class="form-group">--}}
                                                        {{--<div class="row">--}}
                                                        {{--<label for="sku"--}}
                                                        {{--class="control-label col-sm-4">Barcode</label>--}}
                                                        {{--<div class="col-sm-8">--}}
                                                        {{--@if($model && $model->sku)--}}
                                                        {{--{!! \DNS1D::getBarcodeSVG($model->sku, "C39") !!}--}}
                                                        {{--<img src="data:image/png;base64,{{ \DNS1D::getBarcodePNG($model->barcode, "C39") }}" alt="barcode"   />--}}
                                                        {{--@endif--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        <div class="form-group col-xl-8 col-lg-10 p-0">
                                                            <div class="card panel panel-default">
                                                                <div class="card-header panel-heading">
                                                                    <p class="pull-left mb-0">
                                                                        <b data-toggle="tooltip" title="" data-original-title="Change featured image">Feature
                                                                            image</b>
                                                                    </p>
                                                                </div>
                                                                <div class="card-body stock-basic-future-photo-body-wrap">
                                                                    {!! media_button('image',$model) !!}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-xl-8 col-lg-10 p-0">
                                                            <div class="card panel panel-default">
                                                                <div class="card-header panel-heading">
                                                                    <p class="pull-left mb-0">
                                                                        <b data-toggle="tooltip" title="" data-original-title="Main Item">
                                                                            Main Item
                                                                        </b>
                                                                    </p>
                                                                </div>
                                                                <div class="card-body stock-basic-future-photo-body-wrap">
                                                                    {!! Form::hidden('main_item_id',(($model)?$model->main_item_id:null),
                                                                    ['id' => 'main_item']) !!}
                                                                    <a href="javascript:void(0)" class="btn btn-primary select-main-item">
                                                                        @if($model && $model->main_item)
                                                                            Change Main Item
                                                                        @else
                                                                            Select Main Item
                                                                        @endif
                                                                    </a>
                                                                    <span class="main_item_name">
                                                                        @if($model && $model->main_item)
                                                                            {!! $model->main_item->name !!}
                                                                        @else
                                                                            Not Selected
                                                                        @endif

                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
{{--                                                        <div class="form-group">--}}
{{--                                                            <div class="row">--}}
{{--                                                                <label for="faq_tab"--}}
{{--                                                                       class="control-label col-sm-4 control-label text-right">Faq--}}
{{--                                                                    Tab</label>--}}
{{--                                                                <div class="col-sm-8">--}}
{{--                                                                    {!! Form::hidden('faq_tab',false) !!}--}}
{{--                                                                    {!! Form::checkbox('faq_tab', true,null,--}}
{{--                                                                     ['class' => '','id' => 'faq_tab']) !!}--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <div class="row">--}}
{{--                                                                <label for="reviews_tab"--}}
{{--                                                                       class="control-label col-sm-4 control-label  text-right">Reviews--}}
{{--                                                                    Tab</label>--}}
{{--                                                                <div class="col-sm-8">--}}
{{--                                                                    {!! Form::hidden('reviews_tab',false) !!}--}}

{{--                                                                    {!! Form::checkbox('reviews_tab', true,null,--}}
{{--                                                                     ['class' => '','id' => 'reviews_tab']) !!}--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                    <div class="col-lg-4 col-md-5 col-sm-4">
                                                            <div class="stock-basic-tab-right-top">
                                                                <div class="stock_widget--block">
                                                                    <div class="stock_widget--block-header">
                                                                        <span class="">Status</span>

                                                                    </div>
                                                                    <div class="stock_widget--block-body">
                                                                        <div class="">
                                                                            {!! Form::select('status',[
                                                                                '0' => 'Draft',
                                                                                '1' => 'Published',
                                                                            ],null,['class' => 'form-control']) !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @if(isset($offer))
                                                            {!! Form::hidden('is_offer',true) !!}
                                                        @else
                                                            {!! Form::hidden('is_offer',0) !!}
                                                        @endif

                                                            <div class="stock-basic-tab-right-main">

                                                                    @if(! isset($offer))

                                                                            <div class="stock_widget--block">
                                                                                <div class="stock_widget--block-header">
                                                                                    <span class="">Categories</span>

                                                                                </div>
                                                                                <div class="stock_widget--block-body">
                                                                                    {!! Form::hidden('categories',(isset($checkedCategories))
                                                                                   ? json_encode($checkedCategories) : null,['id' => 'categories_tree']) !!}
                                                                                    <div id="treeview_json"></div>
                                                                                </div>
                                                                            </div>

                                                                    @endif
                                                                    <div class="stock_widget--block">
                                                                        <div class="stock_widget--block-header">
                                                                            <span class="">Brands</span>
                                                                        </div>
                                                                        <div class="stock_widget--block-body">
                                                                            <div class="form-group">
                                                                                <div id="brands_treeview_json">
                                                                                    <div class="filter-wall cat-name row">
                                                                                        <div class="col-12">
                                                                                            @foreach($brands as $brand)
                                                                                                <div
                                                                                                    class="single-wrap ml-4">
                                                                                                    <div
                                                                                                        class="custom-control custom-radio custom-control-inline align-items-center radio--packs">
                                                                                                        {!! Form::radio("brand_id",$brand->id,null,['class' => 'custom-control-input','id' => 'customRadio'.$brand->id]) !!}
                                                                                                        <label
                                                                                                            class="product-single-info_radio-label custom-control-label text-gray-clr font-15"
                                                                                                            for="customRadio{{ $brand->id }}">{{ $brand->name }}
                                                                                                            {{--<span class="amount">(189)</span>--}}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="col-sm-12 control-label pl-sm-0">
                                                                                    {!! Form::hidden('special_filter',0) !!}
                                                                                    Special Filter {!! Form::checkbox('special_filter',1,null,['id' => 'specialOffer']) !!}
                                                                                </label>
                                                                                <div id="special_offer_treeview_json" class="@if(! $model || !$model->special_filter) hide @endif">
                                                                                    <div class="filter-wall cat-name row ml-4">
                                                                                        <div class="col-12 p-sm-0">
                                                                                            @foreach($special_filters as $special_filter)
                                                                                                <div
                                                                                                    class="single-wrap">
                                                                                                    <div
                                                                                                        class="custom-control custom-checkbox custom-control-inline align-items-center">
                                                                                                        {!! Form::checkbox("special_filters[]",$special_filter->id,null,
                                                                                                        ['class' => 'custom-control-input','id' => 'special_filter'.$special_filter->id]) !!}
                                                                                                        <label
                                                                                                            class="product-single-info_radio-label custom-control-label text-gray-clr font-15"
                                                                                                            for="special_filter{{ $special_filter->id }}">{{ $special_filter->name }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                            </div>
                                                            <div class="stock-basic-tab-right-top">
                                                                <div class="stock_widget--block">
                                                                    <div class="stock_widget--block-header">
                                                                        <span class="">Tabs</span>

                                                                    </div>
                                                                    <div class="stock_widget--block-body">
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <label for="faq_tab"
                                                                                       class="control-label col-xl-3 col-7 control-label">Faq
                                                                                    Tab</label>
                                                                                <div class="col-xl-9 col-5">
                                                                                    {!! Form::hidden('faq_tab',false) !!}
                                                                                    {!! Form::checkbox('faq_tab', true,null,
                                                                                     ['class' => '','id' => 'faq_tab']) !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <label for="reviews_tab"
                                                                                       class="control-label col-xl-3 col-7 control-label">Reviews
                                                                                    Tab</label>
                                                                                <div class="col-xl-9 col-5">
                                                                                    {!! Form::hidden('reviews_tab',false) !!}

                                                                                    {!! Form::checkbox('reviews_tab', true,null,
                                                                                     ['class' => '','id' => 'reviews_tab']) !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(isset($offer))
                                            <div class="col-md-12">
                                                <div class="basic-center basic-wall d-flex flex-wrap">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="col-sm-12 control-label pl-sm-0">Offer
                                                                Type</label>
                                                            {!! Form::select('offer_type',["0"=>"General","1"=>"Special"],null,['id' => 'offer_type',
                                                            'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div
                                                            class="col-md-12 offer-cat @if(! $model || ! $model->offer_type) show @else hide @endif">
                                                            <div class="form-group">
                                                                <label
                                                                    class="col-sm-12 control-label pl-sm-0">Offers</label>
                                                                {!! Form::hidden('offers',(isset($checkedOffers))
                                                                ? json_encode($checkedOffers) : null,['id' => 'offer_tree']) !!}
                                                                <div id="treeview_json_offer"></div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-12 offer-special @if($model && $model->offer_type) show @else hide @endif">
                                                            <div
                                                                class="panel-heading d-flex justify-content-between align-items-center">
                                                                <h4>
                                                                    Products
                                                                </h4>
                                                                <button type="button"
                                                                        class="btn btn-info select-offer-products">
                                                                    Select
                                                                </button>
                                                            </div>
                                                            <div class="panel-body product-body">
                                                                <ul class="get-all-offer-products-tab stickers--all--lists">
                                                                    @if(isset($model) && count($model->offer_products))
                                                                        @foreach($model->offer_products as $special_offer)
                                                                            <li style="display: flex"
                                                                                data-id="{{ $special_offer->id }}"
                                                                                class="option-elm-attributes">
                                                                                <a href="#"
                                                                                   class="stick--link">{!! $special_offer->name !!}</a>
                                                                                <div class="buttons">
                                                                                    <a href="javascript:void(0)"
                                                                                       class="remove-all-attributes btn btn-sm btn-danger">
                                                                                        <i class="fa fa-trash"></i></a>
                                                                                </div>
                                                                                <input type="hidden"
                                                                                       name="offer_products[]"
                                                                                       value="{{ $special_offer->id }}">
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="technical" class="tab-pane basic-details-tab media-new-tab fade ">
                                <div class="container-fluid p-25">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-4 col-3 pr-0">
                                            <div class="basic-left basic-wall h-100">
                                                <div class="all-list">
                                                    <ul class="nav nav-tabs media-list">
                                                        <li class="nav-item"><a class="nav-link active"
                                                                                data-toggle="tab"
                                                                                href="#long_desc">Long Description</a>
                                                        </li>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                                href="#mediastickers">Stickers</a></li>

                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                                href="#mediavideos">Videos</a>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                                href="#banners">Banners</a></li>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                                href="#mediaotherimage">Extra Images</a></li>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                                href="#mediarelatedproducts">Related
                                                                Products</a></li>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                                href="#wiitb">What's in the box</a></li>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                                href="#ads">Ads</a></li>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                                href="#downloads">Downloads</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-9 col-lg-8 col-9">
                                            <div class="basic-center basic-wall scrollbar_media_tab h-100">
                                                <div class="tab-content">
                                                    <div id="mediaotherimage" class="tab-pane fade ">
                                                        {!! media_button('other_images',$model,true) !!}
                                                    </div>
                                                    <div id="mediavideos" class="tab-pane fade">
                                                        <div class="media-videos">
                                                            <div class="input-group " style="display: flex">
                                                                <input type="text" class="form-control video-url-link"
                                                                       placeholder="Video Url" aria-label="Video Url"
                                                                       aria-describedby="basic-addon2">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-primary add-video-url"
                                                                            type="button">Add Link
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="media-videos-preview mt-20"
                                                                 style="display: flex;flex-wrap: wrap">
                                                                @if(isset($model->videos) && $model->videos && count($model->videos))
                                                                    @foreach($model->videos as $video)
                                                                        <div class="video-single-item"
                                                                             style="display: flex">
                                                                            <iframe width="200" height="200"
                                                                                    src="https://www.youtube.com/embed/{{ $video }}">
                                                                            </iframe>
                                                                            <div>
                                                                                <button
                                                                                    class="btn btn-danger remove-video-single-item btn-sm">
                                                                                    <i class="fa fa-trash"></i></button>
                                                                            </div>
                                                                            <input type="hidden" name="videos[]"
                                                                                   value="{{ $video }}"></div>
                                                                    @endforeach
                                                                @endif

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div id="mediastickers" class="tab-pane fade ">
                                                        <div
                                                            class="panel-heading d-flex justify-content-between align-items-center mb-2">
                                                            <h4>
                                                                Stickers
                                                            </h4>
                                                            <button type="button" class="btn btn-info select-stickers">
                                                                Select
                                                            </button>
                                                        </div>
                                                        <div class="panel-body product-body">
                                                            <ul class="get-all-stickers-tab stickers--all--lists">
                                                                @if(isset($model) && count($model->stickers))
                                                                    @foreach($model->stickers()->orderBy('ordering','asc')->get() as $key => $sticker)
                                                                        <li style="display: flex"
                                                                            data-id="{{ $sticker->id }}"
                                                                            class="option-elm-attributes">
                                                                            <a href="#"
                                                                               class="stick--link">{!! $sticker->name !!}</a>
                                                                            <div class="buttons">
                                                                                <a href="javascript:void(0)"
                                                                                   class="remove-all-attributes btn btn-sm btn-danger">
                                                                                    <i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                            <input type="hidden" name="stickers[{{$key}}][id]"
                                                                                   value="{{ $sticker->id }}">
                                                                            <input type="hidden" class="sticker-ordering" name="stickers[{{ $key }}][ordering]"
                                                                                   value="{{ $sticker->ordering }}">
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div id="mediarelatedproducts" class="tab-pane fade ">
                                                        <div
                                                            class="panel-heading d-flex justify-content-between align-items-center mb-2">
                                                            <h4>
                                                                Related Products
                                                            </h4>
                                                            <button type="button" class="btn btn-info select-products">
                                                                Select
                                                            </button>
                                                        </div>
                                                        <div class="panel-body product-body">
                                                            <ul class="get-all-products-tab stickers--all--lists">
                                                                @if(isset($model) && count($model->related_products))
                                                                    @foreach($model->related_products as $related_product)
                                                                        <li style="display: flex"
                                                                            data-id="{{ $related_product->id }}"
                                                                            class="option-elm-attributes">
                                                                            <a href="#"
                                                                               class="stick--link">{!! $related_product->name !!}</a>
                                                                            <div class="buttons">
                                                                                <a href="javascript:void(0)"
                                                                                   class="remove-all-attributes btn btn-sm btn-danger">
                                                                                    <i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                            <input type="hidden"
                                                                                   name="related_products[]"
                                                                                   value="{{ $related_product->id }}">
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    {{--<div id="mediaspecifications" class="tab-pane fade ">--}}
                                                        {{--<div class="table-responsive">--}}
                                                            {{--<table class="table table--store-settings">--}}
                                                                {{--<thead>--}}
                                                                {{--<tr class="bg-my-light-pink">--}}
                                                                    {{--<th>Attributes</th>--}}
                                                                    {{--<th></th>--}}
                                                                    {{--<th></th>--}}
                                                                {{--</tr>--}}
                                                                {{--</thead>--}}

                                                                {{--<tbody class="v-options-list">--}}
                                                                {{--@if($model && $model->stockAttrs)--}}
                                                                    {{--@foreach($model->stockAttrs as $selected)--}}
                                                                        {{--@include('admin.inventory._partials.specifications')--}}
                                                                    {{--@endforeach--}}
                                                                {{--@endif--}}
                                                                {{--</tbody>--}}

                                                                {{--<tfoot>--}}
                                                                {{--<tr class="add-new-ship-filed-container">--}}
                                                                    {{--<td colspan="4" class="text-right">--}}
                                                                        {{--<button type="button"--}}
                                                                                {{--class="btn btn-primary add-specification_button">--}}
                                                                            {{--<i--}}
                                                                                {{--class="fa fa-plus-circle add-specification"></i>--}}
                                                                        {{--</button>--}}
                                                                    {{--</td>--}}
                                                                {{--</tr>--}}
                                                                {{--</tfoot>--}}
                                                            {{--</table>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    <div id="wiitb" class="tab-pane fade ">
                                                        <div class="basic-center basic-wall">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    @if(count(get_languages()))
                                                                        <ul class="nav nav-tabs">
                                                                            @foreach(get_languages() as $language)
                                                                                <li class="nav-item"><a
                                                                                        class="nav-link @if($loop->first) active @endif"
                                                                                        data-toggle="tab"
                                                                                        href="#{{ strtolower($language->code) }}">
                                                                                        <span
                                                                                            class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                                                    </a></li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                    <div class="tab-content">
                                                                        @if(count(get_languages()))
                                                                            @foreach(get_languages() as $language)
                                                                                <div
                                                                                    id="{{ strtolower($language->code) }}"
                                                                                    class="tab-pane fade  @if($loop->first) in active show @endif">
                                                                                    <div class="form-group row">
                                                                                        <label
                                                                                            class="col-xl-2 control-label col-form-label text-right"><span
                                                                                                data-toggle="tooltip"
                                                                                                title=""
                                                                                                data-original-title="what_is_content">Content</span></label>
                                                                                        <div class="col-xl-10">
                                                                                            {!! Form::textarea('translatable['.strtolower($language->code).'][what_is_content]',get_translated($model,strtolower($language->code),'what_is_content'),['class'=>'form-control tinyMcArea','cols'=>30,'rows'=>10]) !!}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <label for="feature_image"
                                                                                   class="control-label col-sm-4 col-form-label text-right">Image</label>
                                                                            <div class="col-sm-8">
                                                                                {!! media_button('what_is_image',$model) !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="ads" class="tab-pane fade ">
                                                        <div class="card panel panel-default">
                                                            <div class="card-header panel-heading clearfix">
                                                                <p class="d-inline-block">Right column Ads</p>
                                                                <div class="col-sm-2 pull-right">
                                                                    <button type="button"
                                                                            class="btn btn-primary add-new-social-input">
                                                                        <i
                                                                            class="fa fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div
                                                                    class="form-group d-flex flex-wrap align-items-center social-media-group">
                                                                    @if($model && count($model->ads))
                                                                        @foreach($model->ads as $key => $ad)
                                                                    <div
                                                                        class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                                                                        <div class="col-sm-7 p-0">

                                                                                    <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                            {!! media_button("ads[$key][image]",$ad->image) !!}
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group row mt-3">
                                                                                        <label for="staticEmail"
                                                                                               class="col-sm-2 col-form-label">Url</label>
                                                                                        <div class="col-sm-10">
                                                                                            <input type="text"
                                                                                                   name="ads[{{ $key }}][url]" value="{{ $ad->url }}"
                                                                                                   class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label for="staticEmail"
                                                                                               class="col-sm-2 col-form-label">Tag</label>
                                                                                        <div class="col-sm-10">
                                                                                            <input type="text"
                                                                                                   name="ads[{{ $key }}][tags]" value="{{ $ad->tags }}"
                                                                                                   class="form-control">
                                                                                        </div>
                                                                                    </div>


                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <button class="plus-icon remove-new-banner-input btn btn-danger">
                                                                                <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                        @endforeach

                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="banners" class="tab-pane fade ">
                                                        <div class="card panel panel-default">
                                                            <div class="card-header panel-heading clearfix">
                                                                <p class="d-inline-block">Banners</p>
                                                                <div class="col-sm-2 pull-right">
                                                                    <button type="button"
                                                                            class="btn btn-primary add-new-banner-input">
                                                                        <i
                                                                            class="fa fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div
                                                                    class="form-group d-flex flex-wrap align-items-center banner-group">

                                                                    @if($model && count($model->banners))
                                                                        @foreach($model->banners as $key => $banner)
                                                                    <div
                                                                        class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                                                                        <div class="col-sm-7 p-0">

                                                                                    <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                            {!! media_button("banners[$key][image]",$banner->image) !!}
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group row mt-3">
                                                                                        <label for="staticEmail"
                                                                                               class="col-sm-2 col-form-label">Url</label>
                                                                                        <div class="col-sm-10">
                                                                                            <input type="text"
                                                                                                   name="banners[{{ $key }}][url]" value="{{ $banner->url }}"
                                                                                                   class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label for="staticEmail"
                                                                                               class="col-sm-2 col-form-label">Tag</label>
                                                                                        <div class="col-sm-10">
                                                                                            <input type="text"
                                                                                                   name="banners[{{ $key }}][tags]" value="{{ $banner->tags }}"
                                                                                                   class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label for="staticEmail"
                                                                                               class="col-sm-2 col-form-label">Alt text</label>
                                                                                        <div class="col-sm-10">
                                                                                            <input type="text"
                                                                                                   name="banners[{{ $key }}][alt]" value="{{ $banner->alt }}"
                                                                                                   class="form-control">
                                                                                        </div>
                                                                                    </div>

                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <button class="plus-icon remove-new-banner-input btn btn-danger">
                                                                                <i class="fa fa-minus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                        @endforeach
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="long_desc" class="tab-pane fade in active show">
                                                        <div class="basic-center basic-wall">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    @if(count(get_languages()))
                                                                        <ul class="nav nav-tabs mb-2">
                                                                            @foreach(get_languages() as $language)
                                                                                <li class="nav-item"><a
                                                                                        class="nav-link @if($loop->first) active @endif"
                                                                                        data-toggle="tab"
                                                                                        href="#{{ strtolower($language->code) }}">
                                                                                        <span
                                                                                            class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                                                    </a></li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                    <div class="tab-content">
                                                                        @if(count(get_languages()))
                                                                            @foreach(get_languages() as $language)
                                                                                <div
                                                                                    id="{{ strtolower($language->code) }}"
                                                                                    class="tab-pane fade  @if($loop->first) in active show @endif">
                                                                                    <div class="form-group row">
                                                                                        <label
                                                                                            class="col-xl-2 control-label col-form-label text-xl-right"><span
                                                                                                data-toggle="tooltip"
                                                                                                title=""
                                                                                                data-original-title="Short Description">Long Description</span></label>
                                                                                        <div class="col-xl-10">
                                                                                            {!! Form::textarea('translatable['.strtolower($language->code).'][long_description]',get_translated($model,strtolower($language->code),'long_description'),['class'=>'form-control tinyMcArea','cols'=>30,'rows'=>10]) !!}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="downloads" class="tab-pane fade ">
                                                        {!! media_button('downloads',$model,true) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="variations" class="tab-pane basic-details-tab stock-variations-tab fade">
                                <div class="container-fluid p-25">
                                    <div class="row mb-2">
                                        <div class="col-xl-2 col-md-4 col-sm-6">
                                            <label>Price
                                                per:</label>
                                            {!! Form::select('type',[
                                                0 => 'Section',
                                                1 => 'Whole Product'
                                            ],null,['class' => 'form-control','id' => 'changeProductType']) !!}
                                        </div>
                                        <div class="col-xl-2 col-md-4 col-sm-6">

                                        </div>
                                    </div>
                                    <div class="v-box">
                                        @if($model && isset($variations))
                                            @foreach($variations as $v)
                                                @include("admin.stock._partials.variation",['required' => 1])
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="text-center m-4">
                                        <a class="btn btn-info text-white duplicate-v-options" data-required="1"><i
                                                class="fa fa-plus"></i> Add
                                            new option</a>
                                    </div>
                                </div>
                            </div>
                            @if(! isset($offer))
                                <div id="extra" class="tab-pane basic-details-tab stock-extra-tab fade">
                                    <div class="container-fluid p-25">
                                        <div class="text-right m-4">
                                            <a class="btn btn-info text-white select-special-offers"
                                               data-required="0"><i
                                                    class="fa fa-plus"></i> Add Special Offers</a>
                                        </div>
                                        <div class="row get-special-offers-tab">
                                            @if($model && count($model->special_offers))
                                                @foreach($model->special_offers as $offer)
                                                    @include("admin.stock._partials.special_offer_item")
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div id="seo" class="tab-pane basic-details-tab tab_seo fade">
                                <div class="container-fluid p-25">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="basic-center basic-wall">

                                                <div class="card panel panel-default mt-20">
                                                    <div class="card-header panel-heading">FB</div>
                                                    <div class="card-body panel-body">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label for="seo-facebook-title"
                                                                       class="col-xl-2 col-sm-3">Facebook
                                                                    Title</label>
                                                                <div class="col-xl-5 col-sm-9">
                                                                    {!! Form::text('fb[og:title]',($model)?$model->getSeoField('og:title','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:title',$model)]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label for="seo-facebook-desc"
                                                                       class="col-xl-2 col-sm-3">Facebook
                                                                    Description</label>
                                                                <div class="col-xl-5 col-sm-9">
                                                                    {!! Form::text('fb[og:description]',($model)?$model->getSeoField('og:description','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:description',$model)]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-xl-2 col-sm-3">Facebook Image</label>
                                                                <div class="col-xl-5 col-sm-9">
                                                                    {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($fbSeo,'og:image',$model)]) !!}

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card panel panel-default mt-20">
                                                    <div class="card-header panel-heading">Twitter</div>
                                                    <div class="card-body panel-body">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label for="seo-twitter-title"
                                                                       class="col-xl-2 col-sm-3">Twitter
                                                                    Title</label>
                                                                <div class="col-xl-5 col-sm-9">
                                                                    {!! Form::text('twitter[og:title]',($model)?$model->getSeoField('og:title','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$model)]) !!}

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label for="seo-twitter-desc"
                                                                       class="col-xl-2 col-sm-3">Twitter
                                                                    Description</label>
                                                                <div class="col-xl-5 col-sm-9">
                                                                    {!! Form::text('twitter[og:description]',($model)?$model->getSeoField('og:description','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$model)]) !!}

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-xl-2 col-sm-3">Twitter Image</label>
                                                                <div class="col-xl-5 col-sm-9">
                                                                    {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($twitterSeo,'og:image',$model)]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="seo-general-content">
                                                            <div class="table-responsive">
                                                                <table class="form-table">
                                                                    <tbody>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <label for="seo_focuskw">Focus Keyword:</label>
                                                                            <img src="/public/images/question-mark.png"
                                                                                 alt="question">
                                                                        </th>
                                                                        <td>
                                                                            {!! Form::text('general[og:keywords]',($model)?$model->getSeoField('og:keywords'):null,['class'=>'form-control','placeholder'=>getSeo($general,'og:keywords',$model)]) !!}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <label for="seo_title">SEO Title:</label>
                                                                            <img src="/public/images/question-mark.png"
                                                                                 alt="question">
                                                                        </th>
                                                                        <td>
                                                                            {!! Form::text('general[og:title]',($model)?$model->getSeoField('og:title'):null,['class'=>'form-control','placeholder'=>getSeo($general,'og:title',$model)]) !!}
                                                                            <br>
                                                                            <div>
                                                                                <p><span class="wrong">Warning:</span>
                                                                                    Title display in Google is limited to a
                                                                                    fixed
                                                                                    width, yours is too long.
                                                                                </p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <label for="seo_metadesc">Meta
                                                                                description:</label>
                                                                            <img src="/public/images/question-mark.png"
                                                                                 alt="question">
                                                                        </th>
                                                                        <td>
                                                                            {!! Form::textarea('general[og:description]',($model)?$model->getSeoField('og:title'):null,['class'=>'form-control','rows'=>2,'placeholder'=>getSeo($general,'og:description',$model)]) !!}
                                                                            <div>The <code>meta</code> description will be
                                                                                limited
                                                                                to 156 chars, 156 chars left.
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="seo-advanced">
                                                            <div class="table-responsive">
                                                                <table class="form-table">
                                                                    <tbody>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <label for="seo_meta-robots-noindex">Meta Robots
                                                                                Index:</label>
                                                                        </th>
                                                                        <td>
                                                                            {!! Form::select('robot[robots]',[null=>isset($robot)?(($robot->robots)?'As default Index':'As default No Index'):null,'1'=>'Index','0'=>'No Index'],($model)?$model->getSeoField('robots','robot'):null,['class'=>'']) !!}

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Meta Robots Follow</th>
                                                                        <td>
                                                                            <input type="radio" checked="checked"
                                                                                   id="seo_meta-robots-nofollow_0"
                                                                                   value="0">
                                                                            <label
                                                                                for="seo_meta-robots-nofollow_0">Follow</label>
                                                                            <input type="radio"
                                                                                   id="seo_meta-robots-nofollow_1"
                                                                                   value="1">
                                                                            <label
                                                                                for="seo_meta-robots-nofollow_1">Nofollow</label>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <label for="seo_meta-robots-adv">Meta Robots
                                                                                Advanced:</label>
                                                                        </th>
                                                                        <td>
                                                                            <select multiple="multiple" size="7"
                                                                                    style="height: 144px;"
                                                                                    id="seo_meta-robots-adv"
                                                                                    class="">
                                                                                <option selected="selected" value="-">
                                                                                    Site-wide
                                                                                    default: None
                                                                                </option>
                                                                                <option value="none">None</option>
                                                                                <option value="noodp">NO ODP</option>
                                                                                <option value="noydir">NO YDIR</option>
                                                                                <option value="noimageindex">No Image
                                                                                    Index
                                                                                </option>
                                                                                <option value="noarchive">No Archive
                                                                                </option>
                                                                                <option value="nosnippet">No Snippet
                                                                                </option>
                                                                            </select>
                                                                            <div>Advanced <code>meta</code> robots settings
                                                                                for this
                                                                                page.
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <label for="seo_canonical">Canonical
                                                                                URL:</label>
                                                                        </th>
                                                                        <td>
                                                                            <input type="text" id="seo_canonical" value=""
                                                                                   class="form-control"><br>
                                                                            <div>The canonical URL that this page should
                                                                                point to,
                                                                                leave empty to default to
                                                                                permalink. <a target="_blank"
                                                                                              href="#">Cross
                                                                                    domain canonical</a> supported too.
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </section>
        </div>
    </div>
    {!! Form::close() !!}
    <!-- Modal -->
    <div id="myExtraTabModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Option</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'v-option-form']) !!}

                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info save-v-option">Save</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="attributesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Options</h4>
                </div>
                <div class="modal-body">
                    <div class="all-list">
                        <ul>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="mainItemModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="mainItemModalLabel">Add main item</h4>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Products</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="search-product" class="col-sm-2 col-form-label">Search</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control search-attr" id="search-product" placeholder="Search">
                        </div>
                    </div>
                    <ul class="all-list modal-stickers--list" id="stickers-modal-list">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Done</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="stickerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Stickers</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="search-sticker" class="col-sm-2 col-form-label">Search</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control search-attr" id="search-sticker" placeholder="Search">
                        </div>
                    </div>
                    <ul class="all-list modal-stickers--list">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Done</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="variationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Variation form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body variation-box">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning apply-variation">Apply</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="itemsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="discountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Discount price</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['class' => 'form-horizontal','id' => 'discount-form']) !!}
                    <div class="col-md-12">
                        {!! Form::select('discount_type',[''=>'Select type','range' => 'Range','fixed' => 'Fixed'],null,
                        ['class' => 'form-control select-discount-type']) !!}
                    </div>
                    <div class="discount-type-box">

                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning apply-discount">Apply</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="template" id="range-discount">
        <div class="d-flex flex-wrap discount-item">
            <div class="col-md-3">
                <label>From</label>
                {!! Form::number('discount[{count}][from]',null,['class' => 'form-control']) !!}
            </div>
            <div class="col-md-3">
                <label>To</label>
                {!! Form::number('discount[{count}][to]',null,['class' => 'form-control']) !!}
            </div>
            <div class="col-md-3">
                <label>Price/Item</label>
                {!! Form::number('discount[{count}][price]',null,['class' => 'form-control']) !!}
            </div>
            <div class="col-md-3">
                <button class="btn btn-danger remove-discount-item">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
    </script>

    <script type="template" id="fixed-discount">
        <div class="d-flex flex-wrap discount-item">
            <div class="col-md-4">
                <label>Qty</label>
                {!! Form::number('discount[{count}][qty]',null,['class' => 'form-control']) !!}
            </div>

            <div class="col-md-q">
                <label>Total price</label>
                {!! Form::number('discount[{count}][price]',null,['class' => 'form-control']) !!}
            </div>
            <div class="col-md-4">
                <button class="btn btn-danger remove-discount-item">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
    </script>

    <script type="template" id="range-discount-temp">
        <div class="col-md-12 range-box">
            <div class="d-flex flex-wrap discount-item">
                <div class="col-md-3">
                    <label>From</label>
                    {!! Form::number('discount[{count}][from]',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    <label>To</label>
                    {!! Form::number('discount[{count}][to]',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    <label>Price/Item</label>
                    {!! Form::number('discount[{count}][price]',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    <button class="btn btn-danger remove-discount-item">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-12 justify-content-center">
            <a class="btn btn-primary add-range-discount add-discount-field" href="javascript:void(0)"><i
                    class="fa fa-plus"></i></a>
        </div>
    </script>

    <script type="template" id="fixed-discount-temp">
        <div class="col-md-12 fixed-box">
            <div class="d-flex flex-wrap discount-item">
                <div class="col-md-4">
                    <label>Qty</label>
                    {!! Form::number('discount[{count}][qty]',null,['class' => 'form-control']) !!}
                </div>

                <div class="col-md-q">
                    <label>Total price</label>
                    {!! Form::number('discount[{count}][price]',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-4">
                    <button class="btn btn-danger remove-discount-item">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-12 justify-content-center">
                <a class="btn btn-primary add-fixed-discount add-discount-field" href="javascript:void(0)"><i
                        class="fa fa-plus"></i></a>
            </div></div>

    </script>
    <script type="template" id="add-more-banners">
        <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
            <div class="col-sm-7 p-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        {!! media_button('ads[{count}][image]',$model) !!}

                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                    <div class="col-sm-10">
                        <input type="text" name="ads[{count}][url]" class="form-control"  value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                    <div class="col-sm-10">
                        <input type="text" name="ads[{count}][tags]" class="form-control" value="">
                    </div>
                </div>


            </div>
            <div class="col-sm-3">
                <button class="plus-icon remove-new-banner-input btn btn-danger">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
    </script>

    <script type="template" id="add-more-banners-tags">
        <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
            <div class="col-sm-7 p-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        {!! media_button('banners[{count}][image]',$model) !!}

                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                    <div class="col-sm-10">
                        <input type="text" name="banners[{count}][url]" class="form-control"  value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                    <div class="col-sm-10">
                        <input type="text" name="banners[{count}][tags]" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Alt text</label>
                    <div class="col-sm-10">
                        <input type="text" name="banners[{count}][alt]" class="form-control" value="">
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
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
    <link rel="stylesheet" href="{{asset('public/admin_assets/css/nopagescroll.css?v='.rand(111,999))}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
    <style>
        #itemsModal .items-box {
            flex: 1;
        }

        .package-box > div:not(:first-child) {
            margin-top: 20px;
        }

        .v-box > div:not(:first-child) {
            margin-top: 20px;
        }

        .errors {
            color: red;
            font-style: italic;
        }

        .get-all-extra-tab .promotion-elm {
            box-shadow: 0 0 4px #ccc;
            margin-bottom: 10px;
            align-items: center;
            cursor: pointer;
            -webkit-transition: 0.5s ease;
            -moz-transition: 0.5s ease;
            -ms-transition: 0.5s ease;
            -o-transition: 0.5s ease;
            transition: 0.5s ease;
        }

        .get-all-extra-tab .promotion-elm.active, .get-all-extra-tab .promotion-elm:hover {
            background-color: #3eb3d7;
        }

        .get-all-extra-tab .promotion-elm.active > a, .get-all-extra-tab .promotion-elm:hover > a {
            color: #ffffff;
        }

        .get-all-extra-tab .promotion-elm > a {
            padding-left: 5px;
            font-size: 16px;
            color: #000000;
        }

        .get-all-extra-tab .buttons {
            margin-left: auto;
        }

    </style>
@stop
@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.1.2/tinymce.min.js" integrity="sha256-DdWABQXQvgw5MFqHCMQ34eo2D3GTcL6xA36LVz1sAmQ=" crossorigin="anonymous"></script>
    <script src="/public/js/custom/stock.js?v=" .rand(111,999)></script>
    <script>

        $(document).ready(function () {



            $("body").on('click','.select-main-item',function (ev) {
                let items = [];
                $("body").find('.v-item-change').map(function (v,i) {
                    items.push($(i).val());
                })

                if(items.length > 0){
                    AjaxCall("{{ route('admin_stock_main_item') }}", {items: items}, function (res) {
                        if (!res.error) {
                            $("body").find("#mainItemModal .modal-body").html(res.html);
                            $("body").find(".main_item_value").select2();

                            $("#mainItemModal").modal();
                        }
                    });
                }
                console.log(items)
                // $("#mainItemModal").modal();
            });

            $("body").on('click','.add-main-item',function (ev) {
                let item  = $("body").find('.main_item_value');
                if(item.val()){
                    $("#main_item").val(item.val());
                    $(".select-main-item").text("Change main item");

                    var selectedText = $("body").find(".main_item_value option:selected").html();
                    $(".main_item_name").text(selectedText);
                    $("#mainItemModal").modal('hide');
                }

            });


                const shortAjax = function (URL, obj = {}, cb) {
                fetch(URL, {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify(obj)
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (json) {
                        return cb(json);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            };
            tinymce.init({
                selector: ".stock-tiny-area",
                plugins: 'print preview fullpage   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   imagetools textpattern noneditable help    charmap   quickbars  emoticons ',
  //   imagetools_cors_hosts: ['picsum.photos'],
  //   tinydrive_token_provider: function (success, failure) {
  //     success({ token: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJqb2huZG9lIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.Ks_BdfH4CWilyzLNk8S2gDARFhuxIauLa8PwhdEQhEo' });
  //   },
  //   tinydrive_demo_files_url: '/docs/demo/tiny-drive-demo/demo_files.json',
  //   tinydrive_dropbox_app_key: 'jee1s9eykoh752j',
  //   tinydrive_google_drive_key: 'AIzaSyAsVRuCBc-BLQ1xNKtnLHB3AeoK-xmOrTc',
  //   tinydrive_google_drive_client_id: '748627179519-p9vv3va1mppc66fikai92b3ru73mpukf.apps.googleusercontent.com',
  mobile: {
      plugins: 'print preview fullpage   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   textpattern noneditable help   charmap  quickbars  emoticons '
  },
  menu: {
      tc: {
      title: 'TinyComments',
      items: 'addcomment showcomments deleteallconversations'
      }
  },
  menubar: '',
  //   'file edit view insert format tools table tc help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist  | forecolor backcolor    removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media  template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
  autosave_ask_before_unload: true,
  //   autosave_interval: "30s",
  //   autosave_prefix: "{path}{query}-{id}-",
  //   autosave_restore_when_empty: false,
  //   autosave_retention: "2m",
  image_advtab: true,
  content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tiny.cloud/css/codepen.min.css'
  ],
  link_list: [
      { title: 'My page 1', value: 'http://www.tinymce.com' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
      { title: 'My page 1', value: 'http://www.tinymce.com' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
      { title: 'None', value: '' },
      { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  height: 400,
  //   file_picker_callback: function (callback, value, meta) {
  //     /* Provide file and text for the link dialog */
  //     if (meta.filetype === 'file') {
  //       callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
  //     }

  //     /* Provide image and alt text for the image dialog */
  //     if (meta.filetype === 'image') {
  //       callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
  //     }

  //     /* Provide alternative source and posted for the media dialog */
  //     if (meta.filetype === 'media') {
  //       callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
  //     }
  //   },
  templates: [
          { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
      { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
      { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 600,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_drawer: 'sliding',
  spellchecker_dialog: true,
  spellchecker_whitelist: ['Ephox', 'Moxiecode'],
  tinycomments_mode: 'embedded',
  content_style: ".mymention{ color: gray; }",
  contextmenu: "link image imagetools table configurepermanentpen",
  mentions_selector: '.mymention',
  //   mentions_fetch: mentions_fetch,
  //   mentions_menu_hover: mentions_menu_hover,
  //   mentions_menu_complete: mentions_menu_complete,
  //   mentions_select: mentions_select,
            });
            $(document).on('click',function (ev) {
                // ev.stopImmediatePropagation();
                console.log($(ev.target).closest('.stock-toggle-tiny__wrapper'));
                if($(ev.target).closest('.stock-toggle-tiny__wrapper').length === 0
                ){
                    $('body').find('.stock-toggle-tiny__wrapper').fadeOut()
                }
            });
            $('body').on('click','.stock-toggle-tiny__btn',function (ev) {
                ev.stopImmediatePropagation();

                $(this).closest('.shock__edit-tr').find('.stock-toggle-tiny__wrapper').fadeToggle()
            })
            $("#specialOffer").change(function() {
                if(this.checked) {
                    $("#special_offer_treeview_json").removeClass('hide')
                }else{
                    $("#special_offer_treeview_json").addClass('hide')
                }
            });

            var mainS;
            var groupS;
            $("body").on("click", ".add-new-social-input", function () {
                var uid = Math.random().toString(36).substr(2, 9);
                var html = $("#add-more-banners").html();
                html = html.replace(/{count}/g, uid);
                html = html.replace(/media_/g, 'media_' + uid);
                $(".social-media-group").append(html);
            });
            $("body").on("click", ".remove-new-banner-input", function () {
                $(this).closest(".banner-item").remove();
            });

            $("body").on("click", ".add-new-banner-input", function () {
                var uid = Math.random().toString(36).substr(2, 9);
                var html = $("#add-more-banners-tags").html();
                html = html.replace(/{count}/g, uid);
                html = html.replace(/media_/g, 'media_' + uid);
                $(".banner-group").append(html);
            });


            $(document).ready(function(){
                $(".search-attr").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("ul.all-list .option-elm-modal").filter(function() {
                        $(this).toggle($(this).find('a.searchable').data('name').toLowerCase().indexOf(value) > -1)
                    });
                });

                $("body").on("keyup",".search-sticker", function() {
                    var value = $(this).val().toLowerCase();
                    $("ul.modal-stickers--list .option-elm-modal").filter(function() {
                        $(this).toggle($(this).find('a.searchable').data('name').toLowerCase().indexOf(value) > -1)
                    });
                });
            });
            $("body").on("click", '.add-discount', function (e) {
                var main = $(this).data('main');
                var group = $(this).data('group');
                var hiddenInputs = $(this).next()
                mainS = main;
                groupS = group;
                var discount_type = hiddenInputs.find('[data-type-discount="discount_type"]').val();
                var discount = hiddenInputs.find('[data-type-discount="discount"]');
                var discounts_value = discount.toArray().map(discount_gr => $(discount_gr).val()
                    )
                ;
                var discount_length;
                $("#discountModal").find(`.select-discount-type`).val(discount_type).trigger('change');
                $("#discountModal").find(`.remove-discount-item`).trigger('click');
                if (discount_type === 'range') {
                    discount_length = discount.length / 3;
                    for (let i = 1; i <= discount_length; i++) {
                        $("#discountModal").find(`.add-discount-field`).trigger('click');
                    }
                } else if (discount_type === 'fixed') {
                    discount_length = discount.length / 2;
                    for (let i = 1; i <= discount_length; i++) {
                        $("#discountModal").find(`.add-discount-field`).trigger('click');
                    }
                }
                $("#discountModal").find(`.discount-item input`).toArray().map((discount_gr, index) => {
                        $(discount_gr).val(discounts_value[index])
                    }
                )
                ;

                $("#discountModal").find('.apply-discount').attr('data-main', main).attr('data-group', group);

                if ($("#discountModal").find(`.select-discount-type`).val() === '') {
                    $("#discountModal").find(`.add-discount-field`).addClass('d-none');
                }
                ;
                $("#discountModal").modal();

            });

            $('body').on('click', '.apply-discount', function () {
                var data = $("#discount-form").serialize();
                // var main = $(this).data('main');
                // var group = $(this).data('group');
                AjaxCall("{{ route('admin_stock_apply_discount') }}", data + "&main=" + mainS + "&group=" + groupS, function (res) {
                    if (!res.error) {
                        $("body").find(`[data-d-v="${groupS}"]`).html(res.html);
                        $("#discountModal").modal('hide');
                    }
                });
            });

            $('body').on('click', '.add-range-discount', function () {
                let html = $('#range-discount').html();
                var id = guid();
                html = html.replace(/{count}/g, id);
                $(this).closest('.discount-type-box').find('.range-box').append(html);
            });

            $('body').on('click', '.add-fixed-discount', function () {
                let html = $('#fixed-discount').html();
                var id = guid();
                html = html.replace(/{count}/g, id);
                $(this).closest('.discount-type-box').find('.fixed-box').append(html);
            });

            $('body').on('click', '.remove-discount-item', function () {
                $(this).closest('.discount-item').remove();
            });

            $('body').on('change', '.select-discount-type', function () {
                var value = $(this).val();
                var id = guid();
                if (value == 'range') {
                    var html = $('#range-discount-temp').html();
                    html = html.replace(/{count}/g, id);
                    $(".discount-type-box").html(html);
                } else if (value == 'fixed') {
                    var html = $('#fixed-discount-temp').html();
                    html = html.replace(/{count}/g, id);
                    $(".discount-type-box").html(html);
                } else {
                    $(".discount-type-box").html('');
                }
            });

            var value = $("#changeProductType").val();
            var sections = $("body").find('.stock-page');
            sections.each(function (k, v) {
                var data_id = $(v).attr('data-unqiue');
                let parent = $(v).closest('.basic-details-tab');
                section_prices(parent, data_id, value);
            })


            $(".tag-input-v").select2({width: '100%'});
            setTimeout(function () {
                $('.get-all-extra-tab').find('.promotion-elm').first().trigger('click')
            }, 5);

            $("body").on('click', '.select-items', function () {
                let parent = $(this).closest('.stock-page');
                let existings = [];
                parent.find('.v-item-change')
                    .each(function (i, e) {
                        existings.push($(e).val());
                    });
                AjaxCall("{{ route('admin_stock_package_variation_items') }}", {
                    items: existings,
                    uniqueId: parent.attr('data-unqiue')
                }, function (res) {
                    if (!res.error) {
                        $("#itemsModal .modal-content").html(res.html);
                        // $("#itemsModal #searchStickers").select2();
                        $("#itemsModal").modal();
                    }
                });
            });

            $("body").on("change", "#offer_type", function () {
                let value = $(this).val();
                if (value == 1) {
                    $(".offer-cat").removeClass('show').addClass('hide');
                    $(".offer-special").removeClass('hide').addClass('show');
                } else {
                    $(".offer-cat").removeClass('hide').addClass('show');
                    $(".offer-special").removeClass('show').addClass('hide');
                }
            });

            $("body").on('click', '.select-offer-products', function () {
                let arr = [];
                $(".get-all-offer-products-tab")
                    .children()
                    .each(function () {
                        arr.push($(this).attr("data-id"));
                    });
                AjaxCall("/admin/get-stocks", {arr: arr, promotion: 0}, function (res) {
                    if (!res.error) {
                        $("#productsModal .modal-body .all-list").empty();
                        res.data.forEach(item => {
                            let html = `<li data-id="${item.id}" class="option-elm-modal"><a
                                                href="#">${item.name}
                                                </a> <a class="btn btn-primary add-related-offer-event" data-name="${item.name}"
                                                data-id="${item.id}">ADD</a></li>`;
                            $("#productsModal .modal-body .all-list").append(html);
                        })
                        ;
                        $("#productsModal").modal();
                    }
                });
            });

            $("body").on("click", ".add-related-offer-event", function () {
                let id = $(this).data("id");
                let name = $(this).data("name");
                $(".get-all-offer-products-tab")
                    .append(`<li style="display: flex" data-id="${id}" class="option-elm-attributes"><a
                                href="#">${name}</a>
                                <div class="buttons">
                                <a href="javascript:void(0)" class="remove-all-attributes btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                                <input type="hidden" name="offer_products[]" value="${id}" />
                                </li>`);
                $(this)
                    .parent()
                    .remove();
            });

            $("body").on('click', '.select-special-offers', function () {
                let arr = [];
                $(".get-special-offers-tab")
                    .children()
                    .each(function () {
                        arr.push($(this).attr("data-id"));
                    });
                AjaxCall("/admin/get-special-offers", {arr: arr, promotion: 0}, function (res) {
                    if (!res.error) {
                        $("#productsModal .modal-body .all-list").empty();
                        res.data.forEach(item => {
                            let html = `<li data-id="${item.id}" class="option-elm-modal"><a
                                                href="#">${item.name}
                                                </a> <a class="btn btn-primary add-special-offer-event" data-name="${item.name}"
                                                data-id="${item.id}">ADD</a></li>`;
                            $("#productsModal .modal-body .all-list").append(html);
                        })
                        ;
                        $("#productsModal").modal();
                    }
                });
            });

            $("body").on("click", ".add-special-offer-event", function () {
                let $_this = $(this);
                let id = $_this.data("id");
                AjaxCall("/admin/add-special-offers", {id: id}, function (res) {
                    $(".get-special-offers-tab")
                        .append(res.html);
                    $_this.parent().remove();
                });
            });

            $("body").on('click', '.delete-offer', function () {
                $(this).closest('.special-offer-item').remove();
            });


            $("body").on("change", "#changeProductType", function () {
                let value = $(this).val();
                let sections = $("#variations").find('.stock-page');
                let parent = $(this).closest('.basic-details-tab');
                sections.each(function (k, v) {
                    var data_id = $(v).attr('data-unqiue');
                    section_prices(parent, data_id, value);
                })
            });

            function section_prices(parent, data_id, type) {
                if (type == 1) {
                    parent.find('.product-price').removeClass('hide').addClass('show');
                    parent.find('[data-unqiue="' + data_id + '"]').find('.section_price').removeClass('show').addClass('hide');
                    parent.find('[data-unqiue="' + data_id + '"]').find('.package_price').removeClass('show').addClass('hide');
                    parent.find('[data-unqiue="' + data_id + '"]').find('.product_price').removeClass('show').addClass('hide');
                } else {
                    parent.find('.product-price').removeClass('show').addClass('hide');
                    parent.find('[data-unqiue="' + data_id + '"]').find('.section_price').removeClass('hide').addClass('show');
                    parent.find('[data-unqiue="' + data_id + '"]').find('.package_price').removeClass('hide').addClass('show');
                    parent.find('[data-unqiue="' + data_id + '"]').find('.product_price').removeClass('hide').addClass('show');
                    package_product_price(parent, data_id, parent.find('[data-unqiue="' + data_id + '"]').find(".price_per").val());
                }
            }

            $("body").on("change", ".filter-select", function () {
                let parent = $(this).closest('.stock-page');
                let value = $(this).val();
                AjaxCall("{{ route('admin_stock_filter_items') }}", {
                    id: value,
                    uniqueId: parent.attr('data-unqiue')
                }, function (res) {
                    if (!res.error) {
                        parent.find(".filter-variation-box").html(res.html);
                    }
                });
            });

            $("body").on("input", "#itemsModal #searchStickers", function () {
                let stickers = $(this).val();


                $("body").find('.option-elm-modal').each(function() {
                    var instance = new Mark($(this).find('.name-item span'));
                    if(!stickers) {
                        $(this).removeClass('d-none');
                        instance.unmark({
                            "element": "span",
                            "className": "highlight_mark"
                        });
                    } else {
                        if ($(this).data('name').toLowerCase().includes(stickers.toLowerCase())) {
                            $(this).removeClass('d-none');

                            instance.unmark({
                                "element": "span",
                                "className": "highlight_mark"
                            });
                            instance.mark(stickers, {
                                "element": "span",
                                "className": "highlight_mark"
                            });
                        } else {
                            instance.unmark({
                                "element": "span",
                                "className": "highlight_mark"
                            });
                            $(this).addClass('d-none');
                        }
                    }
                });
            });

            $('body').on('click', '#itemsModal .option-elm-modal', function () {
                $(this).toggleClass('active')
            })

            $("body").on('click', '.add-package-items', function () {
                let current = $(this);
                let data_id = current.attr('data-section-id');
                let $_this = $('body').find('[data-unqiue="' + data_id + '"]');
                let existings = [];
                $(".items-box").find('.option-elm-modal')
                    .each(function (i, e) {
                        if ($(e).hasClass('active')) {
                            existings.push($(e).attr('data-id'));
                        }
                    });

                AjaxCall(
                    "/admin/stock/add-package-variation",
                    {main_unique: data_id, items: existings},
                    function (res) {
                        if (!res.error) {
                            $_this.find('.package-variation-box').append(res.html)

                            tinymce.init({
                                selector: ".stock-tiny-area",
                                plugins: 'print preview fullpage   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   imagetools textpattern noneditable help    charmap   quickbars  emoticons ',
  //   imagetools_cors_hosts: ['picsum.photos'],
  //   tinydrive_token_provider: function (success, failure) {
  //     success({ token: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJqb2huZG9lIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.Ks_BdfH4CWilyzLNk8S2gDARFhuxIauLa8PwhdEQhEo' });
  //   },
  //   tinydrive_demo_files_url: '/docs/demo/tiny-drive-demo/demo_files.json',
  //   tinydrive_dropbox_app_key: 'jee1s9eykoh752j',
  //   tinydrive_google_drive_key: 'AIzaSyAsVRuCBc-BLQ1xNKtnLHB3AeoK-xmOrTc',
  //   tinydrive_google_drive_client_id: '748627179519-p9vv3va1mppc66fikai92b3ru73mpukf.apps.googleusercontent.com',
  mobile: {
      plugins: 'print preview fullpage   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   textpattern noneditable help   charmap  quickbars  emoticons '
  },
  menu: {
      tc: {
      title: 'TinyComments',
      items: 'addcomment showcomments deleteallconversations'
      }
  },
  menubar: '',
  //   'file edit view insert format tools table tc help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist  | forecolor backcolor    removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media  template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
  autosave_ask_before_unload: true,
  //   autosave_interval: "30s",
  //   autosave_prefix: "{path}{query}-{id}-",
  //   autosave_restore_when_empty: false,
  //   autosave_retention: "2m",
  image_advtab: true,
  content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tiny.cloud/css/codepen.min.css'
  ],
  link_list: [
      { title: 'My page 1', value: 'http://www.tinymce.com' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
      { title: 'My page 1', value: 'http://www.tinymce.com' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
      { title: 'None', value: '' },
      { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  height: 400,
  //   file_picker_callback: function (callback, value, meta) {
  //     /* Provide file and text for the link dialog */
  //     if (meta.filetype === 'file') {
  //       callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
  //     }

  //     /* Provide image and alt text for the image dialog */
  //     if (meta.filetype === 'image') {
  //       callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
  //     }

  //     /* Provide alternative source and posted for the media dialog */
  //     if (meta.filetype === 'media') {
  //       callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
  //     }
  //   },
  templates: [
          { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
      { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
      { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 600,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_drawer: 'sliding',
  spellchecker_dialog: true,
  spellchecker_whitelist: ['Ephox', 'Moxiecode'],
  tinycomments_mode: 'embedded',
  content_style: ".mymention{ color: gray; }",
  contextmenu: "link image imagetools table configurepermanentpen",
  mentions_selector: '.mymention',
  //   mentions_fetch: mentions_fetch,
  //   mentions_menu_hover: mentions_menu_hover,
  //   mentions_menu_complete: mentions_menu_complete,
  //   mentions_select: mentions_select,
                            });

                            if ($('#changeProductType').val() == 0) {
                                let parent = $_this.closest('.basic-details-tab');

                                package_product_price(parent, data_id, $_this.find(".price_per").val());
                            }

                            $("#itemsModal").modal("hide");
                        }
                    }
                );
            });

            $("body").on('change', '.v-item-change', function () {
                let parent = $(this).closest('tr');
                var value = $(this).val();
                AjaxCall(
                    "/admin/stock/get-item-by-id",
                    {id: value},
                    function (res) {
                        if (!res.error) {
                            parent.find('.v-name').val(res.data.name);
                            parent.find('.modal-input-path').val(res.data.image);
                            parent.find('.img').attr('src', res.data.image).attr('alt', res.data.image);
                            parent.find('.v-price').val(res.data.price);
                        }
                    }
                );
            });

            $("body").on('click', '.duplicate-v-options', function () {
                let parent = $(this).closest('.basic-details-tab');
                AjaxCall(
                    "/admin/stock/duplicate-v-options",
                    {required: $(this).attr('data-required')},
                    function (res) {
                        if (!res.error) {
                            parent.find('.v-box').append(res.html);
                            var value = $("#changeProductType").val();
                            let sections = parent.find('.stock-page');

                            sections.each(function (k, v) {
                                var data_id = $(v).attr('data-unqiue');
                                section_prices(parent, data_id, value);
                            })
                        }
                    }
                );
            });

            $("body").on('click', '.delete-v-option', function () {
                $(this).closest('.stock-page').remove();
            });

            $("body").on('click', '.delete-package-option', function () {
                $(this).closest('tr').remove();
            });

            $("body").on('click', '.duplicate-package-options', function () {
                AjaxCall(
                    "/admin/stock/duplicate-package-options",
                    {},
                    function (res) {
                        if (!res.error) {
                            $('.package-box').append(res.html);
                        }
                    }
                );
            });


            $("body").on('change', '.price_per', function () {
                var parent = $(this).closest('.basic-details-tab');
                var value = $(this).val();
                var data_id = $(this).closest('.stock-page').data('unqiue');
                package_product_price(parent, data_id, value);
            });


            function package_product_price(parent, data_id, type) {
                if (type == 'product') {
                    parent.find('[data-unqiue="' + data_id + '"]').find('.package_price').removeClass('show').addClass('d-none');
                    parent.find('[data-unqiue="' + data_id + '"]').find('.product_price').removeClass('d-none').addClass('show');
                } else {
                    parent.find('[data-unqiue="' + data_id + '"]').find('.product_price').removeClass('show').addClass('d-none');
                    parent.find('[data-unqiue="' + data_id + '"]').find('.package_price').removeClass('d-none').addClass('show');
                }
            }


            $("body").on('click', '.submit-form', function () {
                $(".stock-form").submit();
            })


            function addAttributeToJSONNew($_this) {
                let id = $_this.find('.select-attribute').val();
                let inputOptions = $_this.find(`.input-items-value`);
                let inputOptionsValue = inputOptions.val();
                if (inputOptionsValue.length) {
                    attributesJson[id] = inputOptionsValue;
                }
            }

            function changeVariationOptions() {
                var list = $(".list-attrs-single-item");
                attributesJson = {};
                $(".get-all-attributes-tab")
                    .children()
                    .each(function () {
                        addAttributeToJSONNew($(this))
                    });

                list.each(function (i, e) {
                    var box = $(e).find('.variation-options-place');
                    var options = box.find('select');
                    box.empty();
                    var objData = {};
                    options.each(function (i, e) {
                        var attrId = $(e).data("attribute_id");
                        objData[attrId] = $(e).val();
                    });
                    var variation = $(e).data('variation');
                    AjaxCall(
                        "/admin/stock/render-variation-new-options",
                        {variation: variation, objData: objData, attributesJson: attributesJson},
                        function (res) {
                            if (!res.error) {
                                box.append(res.html)
                            }
                        }
                    );

                })
            }


            $("body").on("change", ".tag-input-v", function (e) {
                changeVariationOptions()
            });


            $("body").on("change", ".price-type-change", function (e) {
                let value = $(this).val();
                let parent = $(this).closest('.package_price');
                if (value == 'static') {
                    parent.find('.price-discount').removeClass('show').addClass('d-none');
                    parent.find('.price-static').removeClass('d-none').addClass('show');
                } else if (value == 'discount') {
                    parent.find('.price-static').removeClass('show').addClass('d-none');
                    parent.find('.price-discount').removeClass('d-none').addClass('show');
                } else {
                    parent.find('.price-static').removeClass('show').addClass('d-none');
                    parent.find('.price-discount').removeClass('show').addClass('d-none');

                }

            });

            $('body').on('change', '.variation-product-select', function () {
                let value = $(this).val();
                let parent = $(this).closest('.stock-page');
                AjaxCall(
                    "/admin/stock/variation-option-view",
                    {type: value, uniqueId: parent.attr('data-unqiue')},
                    function (res) {
                        if (!res.error) {
                            if (value == 'filter') {
                                parent.find('.multi-option').removeClass('hide').addClass('show');
                                parent.find('.filter-option').removeClass('hide').addClass('show');
                                parent.find('.filter-variation-box').empty();
                            } else if (value == 'package_product') {
                                parent.find('.filter-option').removeClass('show').addClass('hide');
                                parent.find('.multi-option').removeClass('hide').addClass('show');
                            } else {
                                parent.find('.filter-option').removeClass('show').addClass('hide');
                                parent.find('.multi-option').removeClass('show').addClass('hide');
                            }

                            parent.find('.type-place').html(res.html)

                            let sections = $("body").find('.stock-page');
                            sections.each(function (k, v) {
                                var data_id = $(v).attr('data-unqiue');
                                let parent = $(v).closest('.basic-details-tab');

                                section_prices(parent, data_id, $("#changeProductType").val());
                            })
                        }
                    }
                );
            });

            $('body').on('click', '.add-variation-row', function () {
                attributesJson = {};
                $(".get-all-attributes-tab")
                    .children()
                    .each(function () {
                        addAttributeToJSONNew($(this))
                    });
                AjaxCall(
                    "/admin/stock/add-variation",
                    {options: attributesJson},
                    function (res) {
                        if (!res.error) {
                            $('#variations .all-list-attrs').append(res.html)
                        }
                    }
                );
            });

            function guid() {
                return "ss".replace(/s/g, s4);
            }

            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(7)
                    .substring(1);
            }

            function getFormData($form) {
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function (n, i) {
                    indexed_array[n['name']] = n['value'];
                });

                return indexed_array;
            }

            $("body").on('click', '.save-extra-variations', function (e) {
                var type = $(this).data('type');
                var list = $(".extra-item");
                var promotionID = $(this).closest('.extra-item-data').data('promotion-v');
                var promotionType = $(this).closest('.extra-item-data').find('.promotion-type').val();
                var promotionPrices = {};

                if (type == 'normal') {
                    list.each(function (i, e) {
                        var variation = $(e).data('variation');
                        promotionPrices[variation] = $(this).val();
                    })
                } else {
                    list.each(function (i, e) {
                        var variation = $(e).data('variation');
                        promotionPrices[variation] = $(".extra-price").val();
                    })
                }

                AjaxCall("/admin/stock/save-extra-option", {data: promotionPrices}, function (res) {
                    if (!res.error) {
                        $(".get-all-extra-tab").find('.promotion-elm').find(`.promotion_price[data-id='${promotionID}']`).val(res.data);
                        $(".get-all-extra-tab").find('.promotion-elm').find(`.promotion_type[data-id='${promotionID}']`).val(promotionType);
                    }
                });
            })

            $("body").on('click', '.promotion-elm', function (e) {
                if (e.target != this) return false;

                var id = $(this).data('id');
                var stock_id = $(this).data('stock-id');
                var type = $(this).find('.promotion_type').val();
                var price = $(this).find('.promotion_price').val();
                console.log(type);
                $('.get-all-extra-tab').find('.promotion-elm').removeClass('active');
                $(this).addClass('active');
                AjaxCall("/admin/stock/get-extra-option-variations", {
                    stock_id: stock_id,
                    id: id,
                    type: type,
                    price: price
                }, function (res) {
                    if (!res.error) {
                        $(".extra-variations").html(res.html);
                    }
                });
            })

            $("body").on('click', '.option-elm-attributes', function () {
                var data = $(this).find('.extra-item-data').val();
                var options = JSON.parse(data)
                console.log(data, options);
                AjaxCall("/admin/stock/get-extra-option-variations", {options: options.test_options}, function (res) {
                    if (!res.error) {

                    }
                });
            })


            $("body").on('click', '.get-all-extra-tab-event', function () {
                AjaxCall("/admin/stock/get-option-by-id", {id: null}, function (res) {
                    if (!res.error) {
                        $("#v-option-form")[0].reset();
                        $("#v-option-form .v-options-list").html(res.html);
                        $(".tag-input-v").tagsinput();
                        $("#myExtraTabModal").modal();
                    }
                });
            })

            $("body").on('click', '.save-v-option', function () {
                var data = $("#v-option-form").serialize();
                AjaxCall("/admin/stock/add-extra-option", data, function (res) {
                    if (!res.error) {
                        $(".get-all-extra-tab").append(res.html);
                        $("#myExtraTabModal").modal('hide');
                        $("#v-option-form")[0].reset();
                    }
                });
            });

            $("body").on('click', '.delete-v-option_button', function () {
                $(this).closest('tr').remove();
                changeVariationOptions();
            });

            $("body").on('click', '.remove-extra-option', function () {
                $(this).closest('li').remove();
            });

            $("body").on('click', '.remove-promotion', function () {
                var id = $(this).closest('li').data('id')
                $(this).closest('li').remove();
                $(".extra-variations").find("[data-promotion-v='" + id + "']").remove();
            });

            $("body").on('click', '.add-new-v-option', function () {
                let $this = $(this);
                AjaxCall("/admin/stock/get-option-by-id", {id: null}, function (res) {
                    if (!res.error) {
                        $this.closest("table").find(".v-options-list").append(res.html);
                        $(".tag-input-v").select2({width: '100%'});
                    }
                });
            });


            $("body").on('click', '.add-specification_button', function () {
                let $this = $(this);
                AjaxCall("/admin/stock/get-specifications", {id: null}, function (res) {
                    if (!res.error) {
                        $this.closest("table").find(".v-options-list").append(res.html);
                        $(".tag-input-v").select2({width: '100%'});
                    }
                });
            });


            $("body").on('change', '.select-attribute', function () {
                var value = $(this).val();
                let vID = $(this).data('uid');
                if (value != '') {
                    AjaxCall("/admin/stock/get-option-by-id", {id: value}, function (res) {
                        if (!res.error) {
                            $(".select-attribute[data-uid=" + vID + "]").closest('.v-options-list-item').replaceWith(res.html);
                            $(".tag-input-v").select2({width: '100%'});
                            changeVariationOptions();
                        }
                    });
                }
            });

            $("body").on('change', '.select-specification', function () {
                var value = $(this).val();
                let vID = $(this).data('uid');
                if (value != '') {
                    AjaxCall("/admin/stock/get-specifications", {id: value}, function (res) {
                        if (!res.error) {
                            $(".select-specification[data-uid=" + vID + "]").closest('.v-options-list-item').replaceWith(res.html);
                            $(".tag-input-v").select2({width: '100%'});
                            changeVariationOptions();
                        }
                    });
                }
            });


            $("body").on('click', '.select-products', function () {
                let arr = [];
                $(".get-all-products-tab")
                    .children()
                    .each(function () {
                        arr.push($(this).attr("data-id"));
                    });
                AjaxCall("/admin/get-stocks", {arr: arr, promotion: 0}, function (res) {
                    if (!res.error) {
                        $("#productsModal .modal-body .all-list").empty();
                        res.data.forEach(item => {
                            let html = `<li data-id="${item.id}" class="option-elm-modal"><a
                                                href="#">${item.name}
                                                </a> <a class="btn btn-primary add-related-event searchable" data-name="${item.name}"
                                                data-id="${item.id}">ADD</a></li>`;
                            $("#productsModal .modal-body .all-list").append(html);
                        })
                        ;
                        $("#productsModal").modal();
                    }
                });
            });

            $("body").on('click', '.select-promotions', function () {
                let arr = [];
                $(".get-all-extra-tab")
                    .children()
                    .each(function () {
                        arr.push($(this).attr("data-id"));
                    });
                AjaxCall("/admin/get-stocks", {arr: arr, promotion: 1}, function (res) {
                    if (!res.error) {
                        $("#productsModal .modal-body .all-list").empty();
                        res.data.forEach(item => {
                            let html = `<li data-id="${item.id}"><a
                                                href="#">${item.name}
                                                </a> <a class="btn btn-primary add-promotion" data-name="${item.name}"
                                                data-id="${item.id}">ADD</a></li>`;
                            $("#productsModal .modal-body .all-list").append(html);
                        })
                        ;
                        $("#productsModal").modal();
                    }
                });
            });


            $("body").on("click", ".select-promotion", function () {
                var id = $(this).data('id');

            });

            $("body").on("click", ".add-promotion", function () {
                let id = $(this).data("id");
                let name = $(this).data("name");
                let stockID = $("#stockID").val();
                $(".get-all-extra-tab")
                    .append(`<li style="display: flex" data-id="${id}" data-stock-id="${stockID}" class="promotion-elm"><a
                                href="#">${name}</a>
                                <div class="buttons">
                                <a href="javascript:void(0)" class="remove-promotion btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                                <input type="hidden" name="promotions[${id}][id]" value="${id}">
                                <input type="hidden" class="promotion_price" data-id="${id}" name="promotion_prices[${id}]" value="">
                                <input type="hidden" class="promotion_type" data-id="${id}" name="promotions[${id}][type]" value="0" />
                                </li>`);
                $(this)
                    .parent()
                    .remove();
            });

            $("body").on("click", ".add-related-event", function () {
                let id = $(this).data("id");
                let name = $(this).data("name");
                $(".get-all-products-tab")
                    .append(`<li style="display: flex" data-id="${id}" class="option-elm-attributes"><a
                                href="#">${name}</a>
                                <div class="buttons">
                                <a href="javascript:void(0)" class="remove-all-attributes btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                                <input type="hidden" name="related_products[]" value="${id}" />
                                </li>`);
                $(this)
                    .parent()
                    .remove();
            });

            $('body').on('click', 'a.nav-link[href="#mediastickers"]', function() {
                setTimeout(function() {
                    console.log(789456123)
                    $( ".get-all-stickers-tab" ).sortable({
                        stop: function() {
                            $('.sticker-ordering').each(function(index, elm){
                                $(elm).val(index+1);
                            })
                        }
                    })
                }, 0)
                $('.sticker-ordering').each(function(index, elm){
                    $(elm).val(index);
                })
                // $('[type="submit"]').on('click', function() {
                //     $('.sticker-ordering').each(function(index, elm){
                //         $(elm).val(index);
                //     })
                // })
            });

            $("body").on('click', '.select-stickers', function () {
                let arr = [];
                $(".get-all-stickers-tab")
                    .children()
                    .each(function () {
                        arr.push($(this).attr("data-id"));
                    });
                AjaxCall("/admin/tools/stickers/get-all", {arr}, function (res) {
                    if (!res.error) {
                        $("#stickerModal .modal-body .all-list").empty();
                        res.data.forEach(item => {
                            let html = `<li data-id="${item.id}" class="option-elm-modal"><a
                                                href="#">${item.name}
                                                </a> <a class="btn btn-primary add-sticker-event searchable" data-name="${item.name}"
                                                data-id="${item.id}">ADD</a></li>`;
                            $("#stickerModal .modal-body .all-list").append(html);
                        })
                        ;
                        $("#stickerModal").modal();
                    }
                });
            });

            $("body").on("click", ".add-sticker-event", function () {
                let id = $(this).data("id");
                let name = $(this).data("name");
                let gu = guid();
                let ordering = Number($(".get-all-stickers-tab").find('.option-elm-attributes').length) + 1;
                $(".get-all-stickers-tab")
                    .append(`<li style="display: flex" data-id="${id}" class="option-elm-attributes"><a
                                href="#">${name}</a>
                                <div class="buttons">
                                <a href="javascript:void(0)" class="remove-all-attributes btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                                <input type="hidden" name="stickers[${gu}][id]" value="${id}">
                                <input type="hidden" class="sticker-ordering" name="stickers[${gu}][ordering]" value="${ordering}">
                                </li>`);
                $(this)
                    .parent()
                    .remove();
            });
        });

        function render_categories_tree() {
            $("#treeview_json").jstree({
                "checkbox": {
                    "three_state": false,
                    "cascade": 'undetermined',
                    "keep_selected_style": false
                },
                plugins: ["wholerow", "checkbox", "types"],
                core: {
                    themes: {
                        responsive: !1
                    },
                    data: {!! json_encode((isset($data)?$data:[])) !!}
                },
                types: {
                    "default": {
                        icon: "fa fa-folder text-primary fa-lg"
                    },
                    file: {
                        icon: "fa fa-file text-success fa-lg"
                    }
                }
            })
        }

        $('#treeview_json').on('changed.jstree', function (e, data) {
            let attributes = $("body").find(".select-specification");
            let attrData = [];

            attributes.map(function (i, e) {
                var value = $(e).val();
                if (value != 'Select' && value != null) {
                    attrData.push($(e).val());
                }
            });

            var categories = $("#categories_tree").val();
            AjaxCall("{{ route('admin_stock_specif_by_category') }}", {
                id: data.node.id,
                selected: data.node.state.selected, attrs: attrData, categories: categories
            }, function (res) {
                if (!res.error) {
                    if (data.node.state.selected == true) {
                        $("#mediaspecifications").find("table").find(".v-options-list").append(res.html);
                        $(".tag-input-v").select2({width: '100%'});
                    } else {
                        for (let i of Object.keys(res.data)) {
                            if (Object.keys(res.existingAttributes).indexOf(i) === -1) {
                                $(`.select-specification option[value="${i}"]:selected`).closest('.v-options-list-item').remove();
                            }

                        }
                    }
                }
            });
        });

        $('#treeview_json').on("changed.jstree", function (e, data) {
            if (data.node) {
                let selectedNode = $('#treeview_json').jstree(true).get_selected(true)
                let dataArr = [];
                for (let i = 0, j = selectedNode.length; i < j; i++) {
                    dataArr.push(selectedNode[i].id);
                    dataArr.push(selectedNode[i].parent);
                }

                let uniqueNames = [];

                if (dataArr.length > 0) {
                    $.each(dataArr, function (i, el) {
                        if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                    });
                }

                let index = uniqueNames.indexOf("#");
                if (index > -1) {
                    uniqueNames.splice(index, 1);
                }

                $("#categories_tree").val(JSON.stringify(uniqueNames));
            }
        });

        render_categories_tree();


        function render_offer_tree() {
            $("#treeview_json_offer").jstree({
                "checkbox": {
                    "three_state": false,
                    "cascade": 'undetermined',
                    "keep_selected_style": false
                },
                plugins: ["wholerow", "checkbox", "types"],
                core: {
                    themes: {
                        responsive: !1
                    },
                    data: {!! json_encode($dataOffers) !!}
                },
                types: {
                    "default": {
                        icon: "fa fa-folder text-primary fa-lg"
                    },
                    file: {
                        icon: "fa fa-file text-success fa-lg"
                    }
                }
            })
        }

        $('#treeview_json_offer').on('changed.jstree', function (e, data) {
            let attributes = $("body").find(".select-specification");
            let attrData = [];

            attributes.map(function (i, e) {
                var value = $(e).val();
                if (value != 'Select' && value != null) {
                    attrData.push($(e).val());
                }
            });

            var categories = $("#offer_tree").val();
            AjaxCall("{{ route('admin_stock_specif_by_category') }}", {
                id: data.node.id,
                selected: data.node.state.selected, attrs: attrData, categories: categories
            }, function (res) {
                if (!res.error) {
                    if (data.node.state.selected == true) {
                        $("#mediaspecifications").find("table").find(".v-options-list").append(res.html);
                        $(".tag-input-v").select2({width: '100%'});
                    } else {
                        for (let i of Object.keys(res.data)) {
                            if (Object.keys(res.existingAttributes).indexOf(i) === -1) {
                                $(`.select-specification option[value="${i}"]:selected`).closest('.v-options-list-item').remove();
                            }

                        }
                    }
                }
            });
        });

        $('#treeview_json_offer').on("changed.jstree", function (e, data) {
            if (data.node) {
                let selectedNode = $('#treeview_json_offer').jstree(true).get_selected(true)
                let dataArr = [];
                for (let i = 0, j = selectedNode.length; i < j; i++) {
                    dataArr.push(selectedNode[i].id);
                    dataArr.push(selectedNode[i].parent);
                }

                let uniqueNames = [];

                if (dataArr.length > 0) {
                    $.each(dataArr, function (i, el) {
                        if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                    });
                }

                let index = uniqueNames.indexOf("#");
                if (index > -1) {
                    uniqueNames.splice(index, 1);
                }

                $("#offer_tree").val(JSON.stringify(uniqueNames));
            }
        });

        render_offer_tree();

        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax = arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }

        function initTinyMce(e) {
            tinymce.init({
                selector: e,
                plugins: 'print preview fullpage   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   imagetools textpattern noneditable help    charmap   quickbars  emoticons ',
  //   imagetools_cors_hosts: ['picsum.photos'],
  //   tinydrive_token_provider: function (success, failure) {
  //     success({ token: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJqb2huZG9lIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.Ks_BdfH4CWilyzLNk8S2gDARFhuxIauLa8PwhdEQhEo' });
  //   },
  //   tinydrive_demo_files_url: '/docs/demo/tiny-drive-demo/demo_files.json',
  //   tinydrive_dropbox_app_key: 'jee1s9eykoh752j',
  //   tinydrive_google_drive_key: 'AIzaSyAsVRuCBc-BLQ1xNKtnLHB3AeoK-xmOrTc',
  //   tinydrive_google_drive_client_id: '748627179519-p9vv3va1mppc66fikai92b3ru73mpukf.apps.googleusercontent.com',
  mobile: {
      plugins: 'print preview fullpage   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   textpattern noneditable help   charmap  quickbars  emoticons '
  },
  menu: {
      tc: {
      title: 'TinyComments',
      items: 'addcomment showcomments deleteallconversations'
      }
  },
  menubar: '',
  //   'file edit view insert format tools table tc help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist  | forecolor backcolor    removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media  template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
  autosave_ask_before_unload: true,
  //   autosave_interval: "30s",
  //   autosave_prefix: "{path}{query}-{id}-",
  //   autosave_restore_when_empty: false,
  //   autosave_retention: "2m",
  image_advtab: true,
  content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tiny.cloud/css/codepen.min.css'
  ],
  link_list: [
      { title: 'My page 1', value: 'http://www.tinymce.com' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
      { title: 'My page 1', value: 'http://www.tinymce.com' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
      { title: 'None', value: '' },
      { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  height: 400,
  //   file_picker_callback: function (callback, value, meta) {
  //     /* Provide file and text for the link dialog */
  //     if (meta.filetype === 'file') {
  //       callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
  //     }

  //     /* Provide image and alt text for the image dialog */
  //     if (meta.filetype === 'image') {
  //       callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
  //     }

  //     /* Provide alternative source and posted for the media dialog */
  //     if (meta.filetype === 'media') {
  //       callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
  //     }
  //   },
  templates: [
          { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
      { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
      { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 600,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_drawer: 'sliding',
  spellchecker_dialog: true,
  spellchecker_whitelist: ['Ephox', 'Moxiecode'],
  tinycomments_mode: 'embedded',
  content_style: ".mymention{ color: gray; }",
  contextmenu: "link image imagetools table configurepermanentpen",
  mentions_selector: '.mymention',
  //   mentions_fetch: mentions_fetch,
  //   mentions_menu_hover: mentions_menu_hover,
  //   mentions_menu_complete: mentions_menu_complete,
  //   mentions_select: mentions_select,
            });
        }

        initTinyMce(".tinyMcArea")

        function guid() {
            return "ss".replace(/s/g, s4);
        }

        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(7)
                .substring(1);
        }
    </script>
@stop
