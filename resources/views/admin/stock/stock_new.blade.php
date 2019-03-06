@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    {!! Form::model($model,['class'=>'form-horizontal stock-form','url' => route('admin_stock_save')]) !!}

    <section class="content-top">
        <div class="row m-0">
            <div class="col-md-4">
                <input type="text" placeholder="Product Name" class="form-control" value="{{ @$model->name }}" readonly>
            </div>
            <div class="col-md-4">
                <input type="text" placeholder="SKU" class="form-control" value="{{ @$model->sku }}" readonly>
            </div>
            <div class="col-md-4">
                {!! Form::submit('Save',['class' => 'btn btn-info pull-right']) !!}
            </div>
        </div>
    </section>
    <section class="content-header">
        {{--<h1> Admin Profile </h1>--}}
        <ol class="breadcrumb">
            <li><a href="http://demo0.laravelcommerce.com/admin/dashboard/this_month"><i class="fa fa-dashboard"></i>
                    Dashboard</a></li>
            <li class="active">Admin Profile</li>
        </ol>
    </section>

    <section class="content stock-page">

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs admin-profile-left">
                    <li class="active"><a data-toggle="tab" href="#basic">Basic Details</a></li>
                    <li><a data-toggle="tab" href="#technical">Technical</a></li>
                    <li><a data-toggle="tab" href="#variations">Variations</a></li>
                    <li><a data-toggle="tab" href="#extra">Extra</a></li>
                    <li><a data-toggle="tab" href="#seo">Seo</a></li>
                </ul>
            </div>

            <!-- /.col -->
            {!! Form::hidden('id',null,['id' => "stockID"]) !!}
            <div class="col-md-12">
                <div class="tab-content tabs_content">
                    <div id="basic" class="tab-pane fade in active basic-details-tab ">
                        <div class="container-fluid p-25">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="basic-center basic-wall">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if(count(get_languages()))
                                                    <ul class="nav nav-tabs">
                                                        @foreach(get_languages() as $language)
                                                            <li class="@if($loop->first) active @endif"><a
                                                                        data-toggle="tab"
                                                                        href="#{{ strtolower($language->code) }}">
                                                                    <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                                </a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                <div class="tab-content mt-20">
                                                    @if(count(get_languages()))
                                                        @foreach(get_languages() as $language)
                                                            <div id="{{ strtolower($language->code) }}"
                                                                 class="tab-pane fade  @if($loop->first) in active @endif">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label"><span
                                                                                data-toggle="tooltip"
                                                                                title=""
                                                                                data-original-title="Attribute Name Title">Product Name</span></label>
                                                                    <div class="col-sm-10">
                                                                        {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($model,strtolower($language->code),'name'),['class'=>'form-control']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label"><span
                                                                                data-toggle="tooltip"
                                                                                title=""
                                                                                data-original-title="Short Description">Short Description</span></label>
                                                                    <div class="col-sm-10">
                                                                        {!! Form::textarea('translatable['.strtolower($language->code).'][short_description]',get_translated($model,strtolower($language->code),'short_description'),['class'=>'form-control','cols'=>30,'rows'=>2]) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label for="product_id" class="control-label col-sm-4">Product
                                                            Slug (for url)</label>
                                                        <div class="col-sm-8">
                                                            {!! Form::text('slug', null,
                                                            ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
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
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label for="feature_image"
                                                               class="control-label col-sm-4">Feature image</label>
                                                        <div class="col-sm-8">
                                                            {!! media_button('image',$model) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label for="faq_tab"
                                                               class="control-label col-sm-4">Faq Tab</label>
                                                        <div class="col-sm-8">
                                                            {!! Form::checkbox('faq_tab', true,null,
                                                             ['class' => '','id' => 'faq_tab']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label for="reviews_tab"
                                                               class="control-label col-sm-4">Reviews Tab</label>
                                                        <div class="col-sm-8">
                                                            {!! Form::checkbox('reviews_tab', true,null,
                                                             ['class' => '','id' => 'reviews_tab']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-5">

                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Status</label>
                                                            <div class="col-sm-10">
                                                                {!! Form::select('status',[
                                                                    '0' => 'Draft',
                                                                    '1' => 'Published',
                                                                ],null,['class' => 'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">

                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Categories</label>
                                                            {!! Form::hidden('categories',(isset($checkedCategories))
                                                            ? json_encode($checkedCategories) : null,['id' => 'categories_tree']) !!}
                                                            <div id="treeview_json"></div>
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
                    <div id="technical" class="tab-pane basic-details-tab media-new-tab fade ">
                        <div class="container-fluid p-25">
                            <div class="row d-flex">
                                <div class="col-md-3">
                                    <div class="basic-left basic-wall h-100">
                                        <div class="all-list">
                                            <ul class="nav nav-tabs media-list">
                                                <li class="active"><a data-toggle="tab" href="#long_desc">Long Description</a></li>
                                                <li><a data-toggle="tab" href="#mediastickers">Stickers</a></li>
                                                <li><a data-toggle="tab" href="#mediaspecifications">Specifications</a></li>
                                                <li><a data-toggle="tab" href="#mediavideos">Videos</a>
                                                <li><a data-toggle="tab" href="#mediaotherimage">Images</a></li>
                                                <li><a data-toggle="tab" href="#mediarelatedproducts">Related Products</a></li>
                                                <li><a data-toggle="tab" href="#wiitb">What's in the box</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
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
                                                    <div class="media-videos-preview mt-20" style="display: flex;flex-wrap: wrap">
                                                        @if(isset($model->videos) && $model->videos && count($model->videos))
                                                            @foreach($model->videos as $video)
                                                                <div class="video-single-item" style="display: flex">
                                                                    <iframe width="200" height="200"
                                                                            src="https://www.youtube.com/embed/{{ $video }}">
                                                                    </iframe>
                                                                    <div>
                                                                        <button class="btn btn-danger remove-video-single-item btn-sm">
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
                                                <div class="panel-heading d-flex justify-content-between align-items-center">
                                                    <h4>
                                                       Stickers
                                                    </h4>
                                                    <button type="button" class="btn btn-info select-stickers">Select
                                                    </button>
                                                </div>
                                                <div class="panel-body product-body">
                                                    <ul class="get-all-stickers-tab stickers--all--lists">
                                                        @if(isset($model) && count($model->stickers))
                                                            @foreach($model->stickers as $sticker)
                                                                <li style="display: flex" data-id="{{ $sticker->id }}"
                                                                    class="option-elm-attributes">
                                                                    <a href="#" class="stick--link">{!! $sticker->name !!}</a>
                                                                    <div class="buttons">
                                                                        <a href="javascript:void(0)"
                                                                           class="remove-all-attributes btn btn-sm btn-danger">
                                                                            <i class="fa fa-trash"></i></a>
                                                                    </div>
                                                                    <input type="hidden" name="stickers[]"
                                                                           value="{{ $sticker->id }}">
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <div id="mediarelatedproducts" class="tab-pane fade ">
                                                <div class="panel-heading d-flex justify-content-between align-items-center">
                                                    <h4>
                                                        Related Products
                                                    </h4>
                                                    <button type="button" class="btn btn-info select-products">Select
                                                    </button>
                                                </div>
                                                <div class="panel-body product-body">
                                                    <ul class="get-all-products-tab stickers--all--lists">
                                                        @if(isset($model) && count($model->related_products))
                                                            @foreach($model->related_products as $related_product)
                                                                <li style="display: flex"
                                                                    data-id="{{ $related_product->id }}"
                                                                    class="option-elm-attributes">
                                                                    <a href="#" class="stick--link">{!! $related_product->name !!}</a>
                                                                    <div class="buttons">
                                                                        <a href="javascript:void(0)"
                                                                           class="remove-all-attributes btn btn-sm btn-danger">
                                                                            <i class="fa fa-trash"></i></a>
                                                                    </div>
                                                                    <input type="hidden" name="related_products[]"
                                                                           value="{{ $related_product->id }}">
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <div id="mediaspecifications" class="tab-pane fade ">
                                                <table class="table table-responsive table--store-settings">
                                                    <thead>
                                                    <tr class="bg-my-light-pink">
                                                        <th>Attributes</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>

                                                    <tbody class="v-options-list">
                                                        @if($model && $model->stockAttrs)
                                                            @foreach($model->stockAttrs as $selected)
                                                                @include('admin.inventory._partials.specifications')
                                                            @endforeach
                                                        @endif
                                                    </tbody>

                                                    <tfoot>
                                                    <tr class="add-new-ship-filed-container">
                                                        <td colspan="4" class="text-right">
                                                            <button type="button" class="btn btn-primary"><i
                                                                        class="fa fa-plus-circle add-specification"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div id="wiitb" class="tab-pane fade ">
                                                <div class="basic-center basic-wall">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @if(count(get_languages()))
                                                                <ul class="nav nav-tabs">
                                                                    @foreach(get_languages() as $language)
                                                                        <li class="@if($loop->first) active @endif"><a
                                                                                    data-toggle="tab"
                                                                                    href="#{{ strtolower($language->code) }}">
                                                                                <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                                            </a></li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                            <div class="tab-content">
                                                                @if(count(get_languages()))
                                                                    @foreach(get_languages() as $language)
                                                                        <div id="{{ strtolower($language->code) }}"
                                                                             class="tab-pane fade  @if($loop->first) in active @endif">
                                                                            <div class="form-group">
                                                                                <label class="col-sm-2 control-label"><span
                                                                                            data-toggle="tooltip"
                                                                                            title=""
                                                                                            data-original-title="what_is_content">Content</span></label>
                                                                                <div class="col-sm-10">
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
                                                                           class="control-label col-sm-4">Image</label>
                                                                    <div class="col-sm-8">
                                                                        {!! media_button('what_is_image',$model) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="long_desc" class="tab-pane fade in active">
                                                <div class="basic-center basic-wall">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @if(count(get_languages()))
                                                                <ul class="nav nav-tabs">
                                                                    @foreach(get_languages() as $language)
                                                                        <li class="@if($loop->first) active @endif"><a
                                                                                    data-toggle="tab"
                                                                                    href="#{{ strtolower($language->code) }}">
                                                                                <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                                            </a></li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                            <div class="tab-content">
                                                                @if(count(get_languages()))
                                                                    @foreach(get_languages() as $language)
                                                                        <div id="{{ strtolower($language->code) }}"
                                                                             class="tab-pane fade  @if($loop->first) in active @endif">
                                                                            <div class="form-group">
                                                                                <label class="col-sm-2 control-label"><span
                                                                                            data-toggle="tooltip"
                                                                                            title=""
                                                                                            data-original-title="Short Description">Long Description</span></label>
                                                                                <div class="col-sm-10">
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
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="variations" class="tab-pane basic-details-tab stock-variations-tab fade">
                        <div class="container-fluid p-25">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-1">Product Type</label>
                                        <div class="col-md-3">
                                            {!! Form::select('type',['' => 'Select','simple_product'=>'Simple Product',
                                            'variation_product' => 'Variation Product','package_product' => 'Package product'
                                            ],null,
                                            ['id'=>'variation-product-select','class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="table-product-variotion product-wall row {{ ($model && $model->type =='variation_product') ? '' : 'hide' }}">

                                    <table class="table table-responsive table--store-settings">
                                        <thead>
                                        <tr class="bg-my-light-pink">
                                            <th>Attributes</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody class="v-options-list get-all-attributes-tab">
                                        @if($model)
                                            @foreach($model->type_attrs as $typeAttr)
                                                @include("admin.inventory._partials.variation_option_item",['selected' => $typeAttr,'noAjax' => true])
                                            @endforeach
                                        @endif
                                        </tbody>

                                        <tfoot>
                                        <tr class="add-new-ship-filed-container">
                                            <td colspan="4" class="text-right">
                                                <button type="button" class="btn btn-primary"><i
                                                            class="fa fa-plus-circle add-new-v-option"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="basic-center basic-wall">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="sipmle-product-wall product-wall {{ ($model && $model->type =='simple_product') ? '' : 'hide' }}">
                                                    @php
                                                        $single_variation = ($model && $model->variations) ? $model->variations->first() : null;
                                                    @endphp
                                                    <table class="table table-style table-bordered" cellspacing="0"
                                                           width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>SKU</th>
                                                            <th>Qty</th>
                                                            <th>Price</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                {!! Form::text("variation_single[name]",($single_variation) ? $single_variation->name : null,['class' => 'form-control']) !!}
                                                                {!! Form::hidden("variation_single[id]",($single_variation) ? $single_variation->id : null) !!}
                                                            </td>
                                                            <td>
                                                                {!! Form::select("variation_single[variation_id]",$stockItems,($single_variation) ? $single_variation->variation_id : null,['class' => 'form-control']) !!}
                                                            </td>
                                                            <td>
                                                                {!! (isset($item['qty'])) ? $item['qty'] : 0 !!}
                                                                {!! Form::hidden("variation_single[qty]",($single_variation) ? $single_variation->qty : null) !!}
                                                            </td>
                                                            <td class="w-5">
                                                                {!! Form::text("variation_single[price]",($single_variation) ? $single_variation->price : null,['class' => 'form-control']) !!}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="packge-product-wall product-wall {{ ($model && $model->type =='package_product') ? '' : 'hide' }}">
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            Price : {!! Form::text("package_variation_price",
                                                                ($model && count($model->variations)) ? $model->variations->first()->price : null,['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button class="btn btn-primary pull-right add-package-item"
                                                                    type="button">
                                                                <i class="fa fa-plus"></i> Add new
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <table class="table table-style table-bordered" cellspacing="0"
                                                           width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>SKU</th>
                                                            <th>Qty</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="package-variation-box">
                                                        @if($model && count($model->variations))
                                                            @foreach($model->variations as $package_variation)
                                                                @include('admin.inventory._partials.variation_package_item')
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row variation-product-wall {{ ($model && $model->type =='variation_product') ? '' : 'hide' }}">
                                            <div class="col-md-12">
                                                <button type="button"
                                                        class="btn btn-primary pull-right add-variation-row"><i
                                                            class="fa fa-plus-circle add-new-v-option"></i>
                                                </button>
                                            </div>

                                            <div class="col-md-12">

                                                <table id="variations-table" class="table table-style table-bordered"
                                                       cellspacing="0" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Attributes</th>
                                                        <th>SKU</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="all-list-attrs">
                                                    @if($model && count($model->variations))
                                                        @foreach($model->variations()->with('options')->get() as $variation)
                                                            @include('admin.inventory._partials.variation_item',['item' => $variation])
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="seo" class="tab-pane basic-details-tab tab_seo fade">
                        <div class="container-fluid p-25">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="basic-center basic-wall">

                                        <div class="panel panel-default mt-20">
                                            <div class="panel-heading">FB</div>
                                            <div class="panel-body">
                                                <div class="form-group p-0-15">
                                                    <div class="row">
                                                        <label for="seo-facebook-title" class="col-md-2 col-xs-12">Facebook
                                                            Title</label>
                                                        <div class="col-md-5 col-xs-12">
                                                            {!! Form::text('fb[og:title]',($model)?$model->getSeoField('og:title','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:title',$model)]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group p-0-15">
                                                    <div class="row">
                                                        <label for="seo-facebook-desc" class="col-md-2 col-xs-12">Facebook
                                                            Description</label>
                                                        <div class="col-md-5 col-xs-12">
                                                            {!! Form::text('fb[og:description]',($model)?$model->getSeoField('og:description','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:description',$model)]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group p-0-15">
                                                    <div class="row">
                                                        <label class="col-md-2 col-xs-12">Facebook Image</label>
                                                        <div class="col-md-5 col-xs-12">
                                                            {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($fbSeo,'og:image',$model)]) !!}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default mt-20">
                                            <div class="panel-heading">Twitter</div>
                                            <div class="panel-body">
                                                <div class="form-group p-0-15">
                                                    <div class="row">
                                                        <label for="seo-twitter-title" class="col-md-2 col-xs-12">Twitter
                                                            Title</label>
                                                        <div class="col-md-5 col-xs-12">
                                                            {!! Form::text('twitter[og:title]',($model)?$model->getSeoField('og:title','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$model)]) !!}

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group p-0-15">
                                                    <div class="row">
                                                        <label for="seo-twitter-desc" class="col-md-2 col-xs-12">Twitter
                                                            Description</label>
                                                        <div class="col-md-5 col-xs-12">
                                                            {!! Form::text('twitter[og:description]',($model)?$model->getSeoField('og:description','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$model)]) !!}

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group p-0-15">
                                                    <div class="row">
                                                        <label class="col-md-2 col-xs-12">Twitter Image</label>
                                                        <div class="col-md-5 col-xs-12">
                                                            {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($twitterSeo,'og:image',$model)]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="seo-general-content">
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
                                                                        Title display in Google is limited to a fixed
                                                                        width, yours is too long.
                                                                    </p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <label for="seo_metadesc">Meta description:</label>
                                                                <img src="/public/images/question-mark.png"
                                                                     alt="question">
                                                            </th>
                                                            <td>
                                                                {!! Form::textarea('general[og:description]',($model)?$model->getSeoField('og:title'):null,['class'=>'form-control','rows'=>2,'placeholder'=>getSeo($general,'og:description',$model)]) !!}
                                                                <div>The <code>meta</code> description will be limited
                                                                    to 156 chars, 156 chars left.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="seo-advanced">
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
                                                                <label for="seo_meta-robots-nofollow_0">Follow</label>
                                                                <input type="radio" id="seo_meta-robots-nofollow_1"
                                                                       value="1">
                                                                <label for="seo_meta-robots-nofollow_1">Nofollow</label>
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
                                                                    <option selected="selected" value="-">Site-wide
                                                                        default: None
                                                                    </option>
                                                                    <option value="none">None</option>
                                                                    <option value="noodp">NO ODP</option>
                                                                    <option value="noydir">NO YDIR</option>
                                                                    <option value="noimageindex">No Image Index</option>
                                                                    <option value="noarchive">No Archive</option>
                                                                    <option value="nosnippet">No Snippet</option>
                                                                </select>
                                                                <div>Advanced <code>meta</code> robots settings for this
                                                                    page.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <label for="seo_canonical">Canonical URL:</label>
                                                            </th>
                                                            <td>
                                                                <input type="text" id="seo_canonical" value=""
                                                                       class="form-control"><br>
                                                                <div>The canonical URL that this page should point to,
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
                                            <div class="col-md-3">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="extra" class="tab-pane basic-details-tab stock-extra-tab fade">
                        <div class="container-fluid p-25">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="basic-left basic-wall">
                                        <div class="all-list-extra">
                                            <ul class="get-all-extra-tab">
                                                @if($model)
                                                    @foreach($model->promotions as $promotion)
                                                        <li style="display: flex" data-stock-id="{{ $model->id }}" data-id="{{ $promotion->id }}" class="promotion-elm"><a
                                                                    href="#">{{ $promotion->name }}</a>
                                                            <div class="buttons">
                                                                <a href="javascript:void(0)" class="remove-promotion btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                            <input type="hidden" name="promotions[{{ $promotion->id }}][id]" value="{{ $promotion->id }}">
                                                            <input type="hidden" class="promotion_price" data-id="{{ $promotion->id }}" name="promotion_prices[{{ $promotion->id }}]" value="{{ $promotion->promotion_prices->pluck('price','variation_id')->toJson() }}">
                                                            <input type="hidden" class="promotion_type" data-id="{{ $promotion->id }}" name="promotions[{{ $promotion->id }}][type]" value="{{ $promotion->pivot->type }}">
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="button-add text-center">
                                            <a href="javascript:void(0)"
                                               class="btn btn-primary btn-block select-promotions"><i
                                                        class="fa fa-plus mr-10"></i>Add promotion</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="basic-center basic-wall">
                                        <div class="row">
                                            <div class="col-md-12 extra-variations">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.col -->
    </section>
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
        <div class="modal-dialog" role="document">
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

    <div class="modal fade" id="productsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select Products</h4>
                </div>
                <div class="modal-body">
                    <ul class="all-list modal-stickers--list">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="stickerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select Stickers</h4>
                </div>
                <div class="modal-body">
                    <ul class="all-list modal-stickers--list">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="variationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Variation form</h4>
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
@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
    <link rel="stylesheet" href="{{asset('public/admin_assets/css/nopagescroll.css?v='.rand(111,999))}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
    <style>
        .errors {
            color: red;
            font-style: italic;
        }

        .get-all-extra-tab .promotion-elm{
            box-shadow: 0 0 4px #ccc;
            margin-bottom: 10px;
            align-items: center;
            cursor:pointer;
            -webkit-transition: 0.5s ease;
            -moz-transition: 0.5s ease;
            -ms-transition: 0.5s ease;
            -o-transition: 0.5s ease;
            transition: 0.5s ease;
        }
        .get-all-extra-tab .promotion-elm.active,.get-all-extra-tab .promotion-elm:hover{
            background-color: #3eb3d7;
        }
        .get-all-extra-tab .promotion-elm.active>a,.get-all-extra-tab .promotion-elm:hover>a{
            color: #ffffff;
        }
        .get-all-extra-tab .promotion-elm>a{
            padding-left:5px;
            font-size: 16px;
            color: #000000;
        }
        .get-all-extra-tab .buttons{
            margin-left: auto;
        }

    </style>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script src="/public/js/tinymce/tinymce.min.js"></script>

    <script src="/public/js/custom/stock.js?v=" .rand(111,999)></script>
    <script>

        $(document).ready(function () {
            $(".tag-input-v").select2({ width: '100%' });
            setTimeout(function() {
                $('.get-all-extra-tab').find('.promotion-elm').first().trigger('click')
            },5);

            $("body").on('click', '.add-package-item', function () {
                AjaxCall(
                    "/admin/inventory/stock/add-package-variation",
                    {},
                    function (res) {
                        if (!res.error) {
                            $('.package-variation-box').append(res.html)
                        }
                    }
                );
            })

            $("body").on('click', '.submit-form', function () {
                $(".stock-form").submit();
            })

            function addAttributeToJSONNew($_this) {
                let id = $_this.find('.select-attribute').val();
                let inputOptions = $_this.find(`.input-items-value`);
                let inputOptionsValue = inputOptions.val();
                if(inputOptionsValue.length){
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

                list.each(function (i,e) {
                    var box = $(e).find('.variation-options-place');
                    var options = box.find('select');
                    box.empty();
                    var objData = {};
                    options.each(function (i,e) {
                        var attrId = $(e).data("attribute_id");
                        objData[attrId] = $(e).val();
                    });
                    var variation = $(e).data('variation');
                    AjaxCall(
                        "/admin/inventory/stock/render-variation-new-options",
                        {variation : variation, objData : objData, attributesJson: attributesJson},
                        function (res) {
                            if (!res.error) {
                                box.append(res.html)
                            }
                        }
                    );

                })
            }


            $("body").on("change",".tag-input-v", function (e) { changeVariationOptions() });

            $('body').on('change', '#variation-product-select', function () {
                var value = $(this).val();
                if (value == 'variation_product') {
                    $('.sipmle-product-wall').addClass('hide');
                    $('.packge-product-wall').addClass('hide');
                    $('.variation-product-wall').removeClass('hide');
                    $('.table-product-variotion').removeClass('hide');
                } else if (value == 'simple_product') {
                    $('.sipmle-product-wall').removeClass('hide');
                    $('.variation-product-wall').addClass('hide');
                    $('.table-product-variotion').addClass('hide');
                    $('.packge-product-wall').addClass('hide');

                } else if (value == 'package_product') {
                    $('.packge-product-wall').removeClass('hide');
                    $('.sipmle-product-wall').addClass('hide');
                    $('.variation-product-wall').addClass('hide');
                    $('.table-product-variotion').addClass('hide');
                } else {
                    $('.packge-product-wall').addClass('hide');
                    $('.sipmle-product-wall').addClass('hide');
                    $('.variation-product-wall').addClass('hide');
                    $('.table-product-variotion').addClass('hide');
                }
            });

            $('body').on('click', '.add-variation-row', function () {
                attributesJson = {};
                $(".get-all-attributes-tab")
                    .children()
                    .each(function () {
                        addAttributeToJSONNew($(this))
                    });
                AjaxCall(
                    "/admin/inventory/stock/add-variation",
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

                if(type == 'normal'){
                    list.each(function (i,e) {
                        var variation = $(e).data('variation');
                        promotionPrices[variation] = $(this).val();
                    })
                }else{
                    list.each(function (i,e) {
                        var variation = $(e).data('variation');
                        promotionPrices[variation] = $(".extra-price").val();
                    })
                }

                AjaxCall("/admin/inventory/stock/save-extra-option", {data: promotionPrices}, function (res) {
                    if (!res.error) {
                        $(".get-all-extra-tab").find('.promotion-elm').find(`.promotion_price[data-id='${promotionID}']`).val(res.data);
                        $(".get-all-extra-tab").find('.promotion-elm').find(`.promotion_type[data-id='${promotionID}']`).val(promotionType);
                    }
                });
            })

            $("body").on('click', '.promotion-elm', function (e) {
                if(e.target != this) return false;

                var id = $(this).data('id');
                var stock_id = $(this).data('stock-id');
                var type = $(this).find('.promotion_type').val();
                var price = $(this).find('.promotion_price').val();
                console.log(type);
                $('.get-all-extra-tab').find('.promotion-elm').removeClass('active');
                $(this).addClass('active');
                AjaxCall("/admin/inventory/stock/get-extra-option-variations", {stock_id:stock_id,id: id,type : type, price: price}, function (res) {
                    if (!res.error) {
                        $(".extra-variations").html(res.html);
                    }
                });
            })

            $("body").on('click', '.option-elm-attributes', function () {
                var data = $(this).find('.extra-item-data').val();
                var options = JSON.parse(data)
                console.log(data, options);
                AjaxCall("/admin/inventory/stock/get-extra-option-variations", {options: options.test_options}, function (res) {
                    if (!res.error) {

                    }
                });
            })


            $("body").on('click', '.get-all-extra-tab-event', function () {
                AjaxCall("/admin/inventory/stock/get-option-by-id", {id: null}, function (res) {
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
                AjaxCall("/admin/inventory/stock/add-extra-option", data, function (res) {
                    if (!res.error) {
                        $(".get-all-extra-tab").append(res.html);
                        $("#myExtraTabModal").modal('hide');
                        $("#v-option-form")[0].reset();
                    }
                });
            });

            $("body").on('click', '.delete-v-option', function () {
                $(this).closest('tr').remove();
                changeVariationOptions();
            });

            $("body").on('click', '.remove-extra-option', function () {
                $(this).closest('li').remove();
            });

            $("body").on('click', '.remove-promotion', function () {
                var id = $(this).closest('li').data('id')
                $(this).closest('li').remove();
                $(".extra-variations").find("[data-promotion-v='"+id+"']").remove();
            });

            $("body").on('click', '.add-new-v-option', function () {
                let $this = $(this);
                AjaxCall("/admin/inventory/stock/get-option-by-id", {id: null}, function (res) {
                    if (!res.error) {
                        $this.closest("table").find(".v-options-list").append(res.html);
                        $(".tag-input-v").select2({ width: '100%' });
                    }
                });
            });


            $("body").on('click', '.add-specification', function () {
                let $this = $(this);
                AjaxCall("/admin/inventory/stock/get-specifications", {id: null}, function (res) {
                    if (!res.error) {
                        $this.closest("table").find(".v-options-list").append(res.html);
                        $(".tag-input-v").select2({ width: '100%' });
                    }
                });
            });


            $("body").on('change', '.select-attribute', function () {
                var value = $(this).val();
                let vID = $(this).data('uid');
                if (value != '') {
                    AjaxCall("/admin/inventory/stock/get-option-by-id", {id: value}, function (res) {
                        if (!res.error) {
                            $(".select-attribute[data-uid=" + vID + "]").closest('.v-options-list-item').replaceWith(res.html);
                            $(".tag-input-v").select2({ width: '100%' });
                            changeVariationOptions();
                        }
                    });
                }
            });

            $("body").on('change', '.select-specification', function () {
                var value = $(this).val();
                let vID = $(this).data('uid');
                if (value != '') {
                    AjaxCall("/admin/inventory/stock/get-specifications", {id: value}, function (res) {
                        if (!res.error) {
                            $(".select-specification[data-uid=" + vID + "]").closest('.v-options-list-item').replaceWith(res.html);
                            $(".tag-input-v").select2({ width: '100%' });
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
                AjaxCall("/admin/get-stocks", {arr:arr, promotion: 0}, function (res) {
                    if (!res.error) {
                        $("#productsModal .modal-body .all-list").empty();
                        res.data.forEach(item => {
                            let html = `<li data-id="${item.id}" class="option-elm-modal"><a
                                                href="#">${item.name}
                                                </a> <a class="btn btn-primary add-related-event" data-name="${item.name}"
                                                data-id="${item.id}">ADD</a></li>`;
                            $("#productsModal .modal-body .all-list").append(html);
                        });
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
                AjaxCall("/admin/get-stocks", {arr:arr, promotion: 1}, function (res) {
                    if (!res.error) {
                        $("#productsModal .modal-body .all-list").empty();
                        res.data.forEach(item => {
                            let html = `<li data-id="${item.id}"><a
                                                href="#">${item.name}
                                                </a> <a class="btn btn-primary add-promotion" data-name="${item.name}"
                                                data-id="${item.id}">ADD</a></li>`;
                        $("#productsModal .modal-body .all-list").append(html);
                    });
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
                                                </a> <a class="btn btn-primary add-sticker-event" data-name="${item.name}"
                                                data-id="${item.id}">ADD</a></li>`;
                            $("#stickerModal .modal-body .all-list").append(html);
                        });
                        $("#stickerModal").modal();
                    }
                });
            });

            $("body").on("click", ".add-sticker-event", function () {
                let id = $(this).data("id");
                let name = $(this).data("name");
                $(".get-all-stickers-tab")
                    .append(`<li style="display: flex" data-id="${id}" class="option-elm-attributes"><a
                                href="#">${name}</a>
                                <div class="buttons">
                                <a href="javascript:void(0)" class="remove-all-attributes btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                                <input type="hidden" name="stickers[]" value="${id}">
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
                    data: {!! json_encode($data) !!}
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

        $('#treeview_json').on("changed.jstree", function (e, data) {
            if (data.node) {
                var selectedNode = $('#treeview_json').jstree(true).get_selected(true)
                var dataArr = [];
                for (var i = 0, j = selectedNode.length; i < j; i++) {
                    dataArr.push(selectedNode[i].id);
                    dataArr.push(selectedNode[i].parent);
                }

                var uniqueNames = [];

                if (dataArr.length > 0) {
                    $.each(dataArr, function (i, el) {
                        if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                    });
                }

                var index = uniqueNames.indexOf("#");
                if (index > -1) {
                    uniqueNames.splice(index, 1);
                }

                $("#categories_tree").val(JSON.stringify(uniqueNames));
            }
        });

        render_categories_tree()

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
                height: 500,
                theme: 'modern',
                plugins: 'print preview fullpage  searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                image_advtab: true,
                templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                ],
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css'
                ]
            });
        }

        initTinyMce(".tinyMcArea")
    </script>
@stop