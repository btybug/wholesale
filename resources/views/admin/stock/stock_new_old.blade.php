@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <section class="content-top">
        <div class="row m-0">
            <div class="col-md-4">
                <input type="text" placeholder="Product Name" class="form-control" value="{{ @$model->name }}" readonly>
            </div>
            <div class="col-md-4">
                <input type="text" placeholder="SKU" class="form-control" value="{{ @$model->sku }}" readonly>
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
                    <li><a data-toggle="tab" href="#media">Media</a></li>
                    <li><a data-toggle="tab" href="#attributes">Technical</a></li>
                    <li><a data-toggle="tab" href="#logistic">Logistic</a></li>
                    <li><a data-toggle="tab" href="#variations">Variations</a></li>
                    <li><a data-toggle="tab" href="#seo">Seo</a></li>
                </ul>
            </div>

            <!-- /.col -->
            {!! Form::model($model,['class'=>'form-horizontal','url' => route('admin_stock_save')]) !!}
            {!! Form::hidden('id',null) !!}
            <div class="col-md-12 pt-25">
                {!! Form::submit('Save',['class' => 'btn btn-info pull-right']) !!}
            </div>
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
                                                <div class="tab-content">
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
                    <div id="media" class="tab-pane basic-details-tab media-new-tab fade ">
                        <div class="container-fluid p-25">
                            <div class="row d-flex">
                                <div class="col-md-3">
                                    <div class="basic-left basic-wall h-100">
                                        <div class="all-list">
                                            <ul class="nav nav-tabs media-list">
                                                <li><a data-toggle="tab" href="#mediaotherimage">Other images</a></li>
                                                <li class="active"><a data-toggle="tab" href="#mediavideos">Videos</a>
                                                <li><a data-toggle="tab" href="#mediastickers">Stickers</a></li>
                                                <li><a data-toggle="tab" href="#mediarelatedproducts">Related Products</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="basic-center basic-wall scrollbar_media_tab">
                                        <div class="tab-content">
                                            <div id="mediaotherimage" class="tab-pane fade ">
                                                {!! media_button('other_images',$model,true) !!}
                                            </div>
                                            <div id="mediavideos" class="tab-pane fade in active">
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
                                                    <div class="media-videos-preview" style="display: flex">
                                                        @if(isset($model->videos) && $model->videos && count($model->videos))
                                                            @foreach($model->videos as $video)
                                                                <div class="video-single-item" style="display: flex">
                                                                    <iframe width="200" height="200" src="https://www.youtube.com/embed/{{ $video }}">
                                                                    </iframe><div><button class="btn btn-danger remove-video-single-item">
                                                                    <i class="fa fa-trash"></i></button></div><input type="hidden" name="videos[]" value="{{ $video }}"> </div>
                                                            @endforeach
                                                        @endif

                                                    </div>
                                                </div>

                                            </div>
                                            <div id="mediastickers" class="tab-pane fade ">
                                                <div class="panel-heading d-flex justify-content-between align-items-center">
                                                    <span>
                                                       Stickers
                                                    </span>
                                                    <button type="button" class="btn btn-info select-stickers">Select</button>
                                                </div>
                                                <div class="panel-body product-body">
                                                    <ul class="get-all-stickers-tab">
                                                        @if(isset($model) && count($model->stickers))
                                                            @foreach($model->stickers as $sticker)
                                                                <li style="display: flex" data-id="{{ $sticker->id }}"
                                                                    class="option-elm-attributes">
                                                                    <a href="#">{!! $sticker->name !!}</a>
                                                                    <div class="buttons">
                                                                        <a href="javascript:void(0)"
                                                                           class="remove-all-attributes btn btn-sm btn-danger">
                                                                            <i class="fa fa-trash"></i></a>
                                                                    </div>
                                                                    <input type="hidden" name="stickers[]" value="{{ $sticker->id }}">
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <div id="mediarelatedproducts" class="tab-pane fade ">
                                                <div class="panel-heading d-flex justify-content-between align-items-center">
                                                    <span>
                                                        Related Products
                                                    </span>
                                                    <button type="button" class="btn btn-info select-products">Select</button>
                                                </div>
                                                <div class="panel-body product-body">
                                                    <ul class="get-all-products-tab">
                                                        @if(isset($model) && count($model->related_products))
                                                            @foreach($model->related_products as $related_product)
                                                                <li style="display: flex" data-id="{{ $related_product->id }}"
                                                                    class="option-elm-attributes">
                                                                    <a href="#">{!! $related_product->name !!}</a>
                                                                    <div class="buttons">
                                                                        <a href="javascript:void(0)"
                                                                           class="remove-all-attributes btn btn-sm btn-danger">
                                                                            <i class="fa fa-trash"></i></a>
                                                                    </div>
                                                                    <input type="hidden" name="related_products[]" value="{{ $related_product->id }}">
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div id="attributes" class="tab-pane basic-details-tab  fade attributes_tab">
                        <div class="container-fluid p-25">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="basic-left basic-wall">
                                        <div class="all-list-attributes">
                                            <ul class="get-all-attributes-tab">
                                                @if(isset($attrs) && count($attrs))
                                                    @foreach($attrs as $attribute)
                                                        <li style="display: flex"
                                                            data-option-container="{!! $attribute->id !!}"
                                                            data-id="{!! $attribute->id !!}"
                                                            class="option-elm-attributes"><a
                                                                    href="#">{!! $attribute->name !!}</a>
                                                            <div class="buttons">
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-sm all-option-add-variations {{ ($attribute->is_shared) ? 'btn-primary' : 'btn-success' }}"><i
                                                                            class="fa fa-money"></i></a>
                                                                <a href="javascript:void(0)"
                                                                   class="remove-all-attributes btn btn-sm btn-danger"><i
                                                                            class="fa fa-trash"></i></a>
                                                            </div>
                                                            <input type="hidden" name="attributes[{!! $attribute->id !!}][attributes_id]"
                                                                   value="{!! $attribute->id !!}">
                                                            <input type="hidden" class="is-shared-attributes" name="attributes[{!! $attribute->id !!}][is_shared]"
                                                            value="{!! $attribute->is_shared !!}">
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="button-add text-center">
                                            <a href="javascript:void(0)"
                                               class="btn btn-primary btn-block get-all-attributes-tab-event"><i
                                                        class="fa fa-plus mr-10"></i>Add new
                                                option</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="basic-center basic-wall">
                                        <ul class="choset-attributes">
                                            @if(isset($attrs) && count($attrs))
                                                @foreach($attrs as $attribute)
                                                    @php
                                                        $opptionAttr = $model->stockAttrs()->where('attributes_id',$attribute->id)->first();
                                                    @endphp
                                                    <div style="height: 50px" data-attr-id="{{$attribute->id}}"
                                                         class="attributes-container-{{$attribute->id}} main-attr-container">
                                                        <input data-id="{{$attribute->id}}"
                                                               class="attributes-item-input-{{$attribute->id}}"
                                                               value="{{ implode(',',$opptionAttr->children()->with('attr')->get()->pluck('attr.name')->all()) }}">
                                                        <input type="hidden" class="input-items-value" name="options[{{$attribute->id}}]"
                                                               value="{{ implode(',',$opptionAttr->children()->with('attr')->get()->pluck('attr.id')->all()) }}">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="logistic" class="tab-pane basic-details-tab stock-new-tab fade">
                        <div class="container-fluid p-25">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="basic-left basic-wall">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <fieldset>
                                                        <legend>Packaging Size</legend>
                                                        <div class="form-group">
                                                                <label for="packaging_length"
                                                                       class=" col-sm-2">Length</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control"
                                                                           name=""
                                                                           id="packaging_length" type="text">
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="packaging_width"
                                                                   class="col-sm-2">Width</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control"
                                                                       name=""
                                                                       id="packaging_width" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="packaging_height"
                                                                   class="col-sm-2">Height</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control"
                                                                       name=""
                                                                       id="packaging_height" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="packaging_weight"
                                                                   class="col-sm-2">Weight</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control"
                                                                       name=""
                                                                       id="packaging_weight" type="text">
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="variations" class="tab-pane basic-details-tab stock-variations-tab fade">
                        <div class="container-fluid p-25">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="basic-center basic-wall">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="all-list-attrs" style="min-height:300px;">
                                                    @if($model)
                                                        @include('admin.inventory._partials.link_all_edit')
                                                    @endif
                                                </div>
                                                <div class="button-add text-center">
                                                    <div class="col-md-6">
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-primary btn-block get-variation"><i
                                                                    class="fa fa-plus mr-10"></i>More
                                                            option</a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-success btn-block get-all-variations"><i
                                                                    class="fa fa-plus mr-10"></i>Link all
                                                            option</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 variation-settings">
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
                                            <div class="text-right btn-save">
                                                <button type="submit" class="btn btn-info">Save</button>
                                            </div>
                                            <div class="panel panel-default mt-20">
                                                <div class="panel-heading">FB</div>
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <div class="row m-0">
                                                            <label for="seo-facebook-title" class="col-md-2 col-xs-12">Facebook Title</label>
                                                            <div class="col-md-5 col-xs-12">
                                                                <input class="form-control" placeholder="Lorem Ipsum" name="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row m-0">
                                                            <label for="seo-facebook-desc" class="col-md-2 col-xs-12">Facebook Description</label>
                                                            <div class="col-md-5 col-xs-12">
                                                                <input class="form-control" placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s," name="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row m-0">
                                                            <label class="col-md-2 col-xs-12">Facebook Image</label>
                                                            <div class="col-md-5 col-xs-12">
                                                                <input class="form-control" readonly="" disabled="" placeholder="" type="text">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default mt-20">
                                                <div class="panel-heading">Twitter</div>
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <div class="row m-0">
                                                            <label for="seo-twitter-title" class="col-md-2 col-xs-12">Twitter Title</label>
                                                            <div class="col-md-5 col-xs-12">
                                                                <input class="form-control" placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ice the 1500s," name="" type="text">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row m-0">
                                                            <label for="seo-twitter-desc" class="col-md-2 col-xs-12">Twitter Description</label>
                                                            <div class="col-md-5 col-xs-12">
                                                                <input class="form-control" placeholder="Lorem Ipsum is simply dummy text of txt ever since the 1500s," name="" type="text">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row m-0">
                                                            <label class="col-md-2 col-xs-12">Twitter Image</label>
                                                            <div class="col-md-5 col-xs-12">
                                                                <input class="form-control" readonly="" disabled="" placeholder="" type="text">
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
                                                                    <img src="/public/images/question-mark.png" alt="question">
                                                                </th>
                                                                <td>
                                                                    <input class="form-control" placeholder="" name="general[og:keywords]" type="text">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">
                                                                    <label for="seo_title">SEO Title:</label>
                                                                    <img src="/public/images/question-mark.png" alt="question">
                                                                </th>
                                                                <td>
                                                                    <input class="form-control" placeholder="Lorem Ipsum" name="general[og:title]" type="text">
                                                                    <br>
                                                                    <div>
                                                                        <p><span class="wrong">Warning:</span>
                                                                            Title display in Google is limited to a fixed width, yours is too long.
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">
                                                                    <label for="seo_metadesc">Meta description:</label>
                                                                    <img src="/public/images/question-mark.png" alt="question">
                                                                </th>
                                                                <td>
                                                                    <textarea class="form-control" rows="2" placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s," name="" cols="50"></textarea>
                                                                    <div>The <code>meta</code> description will be limited to 156 chars, 156 chars left.
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
                                                                    <label for="seo_meta-robots-noindex">Meta Robots Index:</label>
                                                                </th>
                                                                <td>
                                                                    <select class="" name=""><option value="" selected="selected">As default Index</option><option value="1">Index</option><option value="0">No Index</option></select>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Meta Robots Follow</th>
                                                                <td>
                                                                    <input type="radio" checked="checked" id="seo_meta-robots-nofollow_0" value="0">
                                                                    <label for="seo_meta-robots-nofollow_0">Follow</label>
                                                                    <input type="radio" id="seo_meta-robots-nofollow_1" value="1">
                                                                    <label for="seo_meta-robots-nofollow_1">Nofollow</label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">
                                                                    <label for="seo_meta-robots-adv">Meta Robots Advanced:</label>
                                                                </th>
                                                                <td>
                                                                    <select multiple="multiple" size="7" style="height: 144px;" id="seo_meta-robots-adv" class="">
                                                                        <option selected="selected" value="-">Site-wide default: None</option>
                                                                        <option value="none">None</option>
                                                                        <option value="noodp">NO ODP</option>
                                                                        <option value="noydir">NO YDIR</option>
                                                                        <option value="noimageindex">No Image Index</option>
                                                                        <option value="noarchive">No Archive</option>
                                                                        <option value="nosnippet">No Snippet</option>
                                                                    </select>
                                                                    <div>Advanced <code>meta</code> robots settings for this page.</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">
                                                                    <label for="seo_canonical">Canonical URL:</label>
                                                                </th>
                                                                <td>
                                                                    <input type="text" id="seo_canonical" value="" class="form-control"><br>
                                                                    <div>The canonical URL that this page should point to, leave empty to default to
                                                                        permalink. <a target="_blank" href="#">Cross
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
                </div>

            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>

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
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select Products</h4>
                </div>
                <div class="modal-body">
                    <div class="all-list">
                        <ul>

                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="stickerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select Stickers</h4>
                </div>
                <div class="modal-body">
                    <div class="all-list">
                        <ul>

                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('css')
    <link rel="stylesheet" href="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.css">
    <link rel="stylesheet" href="{{asset('public/admin_theme/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
    <link rel="stylesheet" href="{{asset('public/admin_assets/css/nopagescroll.css?v='.rand(111,999))}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

@stop
@section('js')
    <script src="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.js"></script>
    <script src="{{asset('public/admin_theme/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script src="/public/js/custom/stock.js?v=" .rand(111,999)></script>
    <script>
        $(document).ready(function () {
            $("body").on('click', '.select-products', function () {
                let arr = [];
                $(".get-all-products-tab")
                    .children()
                    .each(function () {
                        arr.push($(this).attr("data-id"));
                    });
                AjaxCall("/admin/get-stocks", {arr}, function (res) {
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

            $("body").on("click", ".add-related-event", function () {
                let id = $(this).data("id");
                let name = $(this).data("name");
                $(".get-all-products-tab")
                    .append(`<li style="display: flex" data-id="${id}" class="option-elm-attributes"><a
                                href="#">${name}</a>
                                <div class="buttons">
                                <a href="javascript:void(0)" class="remove-all-attributes btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                                <input type="hidden" name="related_products[]" value="${id}">
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
    function render_categories_tree(){
        $("#treeview_json").jstree({
        "checkbox" : {
            "three_state": false,
            "cascade": 'undetermined',
            "keep_selected_style" : false
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
        if(data.node) {
            var selectedNode = $('#treeview_json').jstree(true).get_selected(true)
            var dataArr = [];
            for (var i = 0, j = selectedNode.length; i < j; i++) {
                dataArr.push(selectedNode[i].id);
                dataArr.push(selectedNode[i].parent);
            }

            var uniqueNames = [];

            if(dataArr.length > 0){
                $.each(dataArr, function(i, el){
                    if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
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
            while ((ax= arr.indexOf(what)) !== -1) {
                arr.splice(ax, 1);
            }
        }
        return arr;
    }

    {{--// var tree2 =[{!! getModuleRoutes('GET','admin')->toJson(1) !!}]--}}
    {{--// var tree =[{!! //json_encode(['nodes' => $categories]) !!}]--}}
    // $('#treeview_json').treeview({
    //     data: tree,
    //     showCheckbox: true,
    //     onNodeChecked: function(event, node) {
    //         if(typeof node.parentId !== "undefined") {
    //             checkParent(node.parentId, "#treeview_json")
    //         }
    //     },
    //     onNodeUnchecked: function (event, node) {
    //         unCheckChildren(node.nodeId, "#treeview_json")
    //     }
    // });
    // function checkParent(id, selecetor) {
    //         let parrentId = id;
    //         $(selecetor).treeview('checkNode', [ parrentId, { silent: true } ]);
    //         if(parrentId){
    //             let parent = $('#treeview_json').treeview('getNode', parrentId);
    //             let pId = parent.parentId
    //             checkParent(pId, selecetor)
    //         }

    //     }
    // function unCheckChildren(id, selecetor){
    //     let currentNode = $('#treeview_json').treeview('getNode', id);
    //     $(selecetor).treeview('uncheckNode', [ id, { silent: true } ]);
    //     if (currentNode.nodes){
    //         Object.values(currentNode.nodes).forEach(item => {
    //             unCheckChildren(item.nodeId, selecetor )
    //         })
    //     }


    // }
    </script>
    <script>
        $(document).ready(function () {
            function guid() {
                return "ss".replace(/s/g, s4);
            }

            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(7)
                    .substring(1);
            }

            $("body").on('change', '.select-stock-type', function () {
                var type = $(this).val();
                var generatedString = type + '-' + guid();
                $('#sku').val(generatedString);
                $('#stock-sku').html(generatedString);
            })
        });
    </script>
@stop