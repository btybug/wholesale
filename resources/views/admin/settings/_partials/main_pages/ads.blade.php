
<div class="form-group">
    {!! Form::model($models['single_post'],['class'=>'form-horizontal']) !!}
    {!! Form::hidden('type','single_post') !!}
    {!! Form::hidden('p','single_post') !!}
    {!! Form::hidden('id',null) !!}
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <p class="d-inline-block">Single Post Ads</p>
            <div class="pull-right">
                <button class="btn btn-info">Save</button>
                <button type="button" class="btn btn-primary add-new-social-input">
                    <i
                        class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group d-flex flex-wrap align-items-center social-media-group">
                @if(isset($models['single_post']) && $models['single_post'] && isset($models['single_post']->data) && @json_decode($models['single_post']->data,true))
                    @php
                        $data = json_decode($models['single_post']->data,true);
                    @endphp
                    @foreach($data['images'] as $key => $banner)
                        <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                            <div class="col-xl-7 p-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        {!! media_button('single_post[images][]',$banner) !!}

                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="single_post[urls][]" class="form-control" id="staticEmail" value="{!! $data['urls'][$key] !!}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="single_post[tags][]" class="form-control" id="staticEmail" value="{!! $data['tags'][$key] !!}">
                                    </div>
                                </div>


                            </div>
                            <div class="col-xl-3">
                                <button class="plus-icon remove-new-banner-input btn btn-danger">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                        <div class="col-xl-7 p-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {!! media_button('single_post[images][]') !!}

                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                <div class="col-sm-10">
                                    <input type="text" name="single_post[urls][]" class="form-control" id="staticEmail">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                <div class="col-sm-10">
                                    <input type="text" name="single_post[tags][]" class="form-control" id="staticEmail">
                                </div>
                            </div>


                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<div class="form-group">
    {!! Form::model($models['single_product'],['class'=>'form-horizontal']) !!}
    {!! Form::hidden('type','single_product') !!}
    {!! Form::hidden('p','single_product') !!}
    {!! Form::hidden('id',null) !!}
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <p class="d-inline-block">Single Product Ads</p>
            <div class="pull-right">
                <button class="btn btn-info">Save</button>
                <button type="button" class="btn btn-primary add-new-social-input-product">
                    <i
                        class="fa fa-plus"></i></button>

            </div>
        </div>
        <div class="card-body">
            <div class="form-group d-flex flex-wrap align-items-center social-media-group-product">
                @if(isset($models['single_product']) && $models['single_product'] && isset($models['single_product']->data) && @json_decode($models['single_product']->data,true))
                    @php
                        $data = json_decode($models['single_product']->data,true);
                    @endphp
                    @foreach($data['images'] as $key => $banner)
                        <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                            <div class="col-xl-7 p-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        {!! media_button('single_product[images][]',$banner) !!}

                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="single_product[urls][]" class="form-control" id="staticEmailproduct" value="{!! $data['urls'][$key] !!}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="single_product[tags][]" class="form-control" id="staticEmailproduct" value="{!! $data['tags'][$key] !!}">
                                    </div>
                                </div>


                            </div>
                            <div class="col-xl-3">
                                <button class="plus-icon remove-new-banner-input btn btn-danger">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                        <div class="col-xl-7 p-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {!! media_button('single_product[images][]') !!}

                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                <div class="col-sm-10">
                                    <input type="text" name="single_product[urls][]" class="form-control" id="staticEmail">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                <div class="col-sm-10">
                                    <input type="text" name="single_product[tags][]" class="form-control" id="staticEmail">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<div class="form-group">
    {!! Form::model($models['my_account'],['class'=>'form-horizontal']) !!}
    {!! Form::hidden('type','my_account') !!}
    {!! Form::hidden('p','my_account') !!}
    {!! Form::hidden('id',null) !!}
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <p class="d-inline-block">My account Ads</p>
            <div class="pull-right">
                <button class="btn btn-info">Save</button>

                <button type="button" class="btn btn-primary add-new-social-input-my_account">
                    <i
                        class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group d-flex flex-wrap align-items-center social-media-group-my_account">
                @if(isset($models['my_account']) && $models['my_account'] && isset($models['my_account']->data) && @json_decode($models['my_account']->data,true))
                    @php
                        $data = json_decode($models['my_account']->data,true);
                    @endphp
                    @foreach($data['images'] as $key => $banner)
                        <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                            <div class="col-xl-7 p-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        {!! media_button('my_account[images][]',$banner) !!}

                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="my_account[urls][]" class="form-control" id="staticEmail" value="{!! $data['urls'][$key] !!}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="my_account[tags][]" class="form-control" id="staticEmail" value="{!! $data['tags'][$key] !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <button class="plus-icon remove-new-banner-input btn btn-danger">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                        <div class="col-xl-7 p-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {!! media_button('my_account[images][]') !!}

                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                <div class="col-sm-10">
                                    <input type="text" name="my_account[urls][]" class="form-control" id="staticEmailAcc">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                <div class="col-sm-10">
                                    <input type="text" name="my_account[tags][]" class="form-control" id="staticEmailAcc">
                                </div>
                            </div>


                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<div class="form-group">
    {!! Form::model($models['confirmation_page'],['class'=>'form-horizontal']) !!}
    {!! Form::hidden('type','confirmation_page') !!}
    {!! Form::hidden('p','confirmation_page') !!}
    {!! Form::hidden('id',null) !!}
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <p class="d-inline-block">Confirmation page Ads</p>
            <div class="pull-right">
                <button class="btn btn-info">Save</button>

                <button type="button" class="btn btn-primary add-new-social-input-confirmation_page">
                    <i
                        class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group d-flex flex-wrap align-items-center social-media-group-confirmation_page">
                @if(isset($models['confirmation_page']) && $models['confirmation_page'] && isset($models['confirmation_page']->data) && @json_decode($models['confirmation_page']->data,true))
                    @php
                        $data = json_decode($models['confirmation_page']->data,true);
                    @endphp
                    @foreach($data['images'] as $key => $banner)
                        <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                            <div class="col-xl-7 p-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        {!! media_button('confirmation_page[images][]',$banner) !!}

                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="confirmation_page[urls][]" class="form-control" id="staticEmailconfirmation_page" value="{!! $data['urls'][$key] !!}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="confirmation_page[tags][]" class="form-control" id="staticEmailconfirmation_page" value="{!! $data['tags'][$key] !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <button class="plus-icon remove-new-banner-input btn btn-danger">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                        <div class="col-xl-7 p-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {!! media_button('my_account[images][]') !!}

                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                <div class="col-sm-10">
                                    <input type="text" name="my_account[urls][]" class="form-control" id="staticEmail">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                <div class="col-sm-10">
                                    <input type="text" name="my_account[tags][]" class="form-control" id="staticEmail">
                                </div>
                            </div>


                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>


<div class="form-group">
    {!! Form::model($models['lef_faq_ads'],['class'=>'form-horizontal']) !!}
    {!! Form::hidden('type','lef_faq_ads') !!}
    {!! Form::hidden('p','lef_faq_ads') !!}
    {!! Form::hidden('id',null) !!}
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <p class="d-inline-block">Left Faq page Ads</p>
            <div class="pull-right">
                <button class="btn btn-info">Save</button>

                <button type="button" class="btn btn-primary add-new-social-input-lef_faq_ads">
                    <i
                        class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group d-flex flex-wrap align-items-center social-media-group-lef_faq_ads">
                @if(isset($models['lef_faq_ads']) && $models['lef_faq_ads'] && isset($models['lef_faq_ads']->data) && @json_decode($models['lef_faq_ads']->data,true))
                    @php
                        $data = json_decode($models['lef_faq_ads']->data,true);
                    @endphp
                    @foreach($data['images'] as $key => $banner)
                        <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                            <div class="col-xl-7 p-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        {!! media_button('lef_faq_ads[images][]',$banner) !!}

                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="lef_faq_ads[urls][]" class="form-control" value="{!! $data['urls'][$key] !!}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="lef_faq_ads[tags][]" class="form-control" value="{!! $data['tags'][$key] !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <button class="plus-icon remove-new-banner-input btn btn-danger">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                        <div class="col-xl-7 p-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {!! media_button('lef_faq_ads[images][]') !!}

                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lef_faq_ads[urls][]" class="form-control" id="staticEmail">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lef_faq_ads[tags][]" class="form-control" id="staticEmail">
                                </div>
                            </div>


                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<div class="form-group">
    {!! Form::model($models['right_faq_ads'],['class'=>'form-horizontal']) !!}
    {!! Form::hidden('type','right_faq_ads') !!}
    {!! Form::hidden('p','right_faq_ads') !!}
    {!! Form::hidden('id',null) !!}
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <p class="d-inline-block">Right Faq page Ads</p>
            <div class="pull-right">
                <button class="btn btn-info">Save</button>

                <button type="button" class="btn btn-primary add-new-social-input-right_faq_ads">
                    <i
                        class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group d-flex flex-wrap align-items-center social-media-group-right_faq_ads">
                @if(isset($models['right_faq_ads']) && $models['right_faq_ads'] && isset($models['right_faq_ads']->data) && @json_decode($models['right_faq_ads']->data,true))
                    @php
                        $data = json_decode($models['right_faq_ads']->data,true);
                    @endphp
                    @foreach($data['images'] as $key => $banner)
                        <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                            <div class="col-xl-7 p-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        {!! media_button('right_faq_ads[images][]',$banner) !!}

                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="right_faq_ads[urls][]" class="form-control" value="{!! $data['urls'][$key] !!}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="right_faq_ads[tags][]" class="form-control" value="{!! $data['tags'][$key] !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <button class="plus-icon remove-new-banner-input btn btn-danger">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
                        <div class="col-xl-7 p-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {!! media_button('right_faq_ads[images][]') !!}

                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                                <div class="col-sm-10">
                                    <input type="text" name="right_faq_ads[urls][]" class="form-control" id="staticEmail">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                                <div class="col-sm-10">
                                    <input type="text" name="right_faq_ads[tags][]" class="form-control" id="staticEmail">
                                </div>
                            </div>


                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script type="template" id="add-more-banners">
    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
        <div class="col-sm-7 p-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    {!! media_button('single_post[images][]',$model) !!}

                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                <div class="col-sm-10">
                    <input type="text" name="single_post[urls][]" class="form-control" id="staticEmail" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                <div class="col-sm-10">
                    <input type="text" name="single_post[tags][]" class="form-control" id="staticEmail" value="">
                </div>
            </div>


        </div>
        <div class="col-sm-3">
            <button class="plus-icon remove-new-banner-input btn btn-danger">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
</script>

<script type="template" id="add-more-lef_faq_ads">
    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
        <div class="col-sm-7 p-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    {!! media_button('lef_faq_ads[images][]',$model) !!}

                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                <div class="col-sm-10">
                    <input type="text" name="lef_faq_ads[urls][]" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                <div class="col-sm-10">
                    <input type="text" name="lef_faq_ads[tags][]" class="form-control" value="">
                </div>
            </div>


        </div>
        <div class="col-sm-3">
            <button class="plus-icon remove-new-banner-input btn btn-danger">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
</script>

<script type="template" id="add-more-right_faq_ads">
    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
        <div class="col-sm-7 p-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    {!! media_button('right_faq_ads[images][]',$model) !!}

                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                <div class="col-sm-10">
                    <input type="text" name="right_faq_ads[urls][]" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                <div class="col-sm-10">
                    <input type="text" name="right_faq_ads[tags][]" class="form-control" value="">
                </div>
            </div>


        </div>
        <div class="col-sm-3">
            <button class="plus-icon remove-new-banner-input btn btn-danger">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
</script>

<script type="template" id="add-more-banners-product">
    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
        <div class="col-sm-7 p-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    {!! media_button('single_product[images][]',$model) !!}

                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                <div class="col-sm-10">
                    <input type="text" name="single_product[urls][]" class="form-control" id="staticEmail" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                <div class="col-sm-10">
                    <input type="text" name="single_product[tags][]" class="form-control" id="staticEmail" value="">
                </div>
            </div>


        </div>
        <div class="col-sm-3">
            <button class="plus-icon remove-new-banner-input btn btn-danger">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
</script>

<script type="template" id="add-more-banners-my_account">
    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
        <div class="col-xl-7 p-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    {!! media_button('my_account[images][]',$model) !!}

                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                <div class="col-sm-10">
                    <input type="text" name="my_account[urls][]" class="form-control" id="staticEmail" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                <div class="col-sm-10">
                    <input type="text" name="my_account[tags][]" class="form-control" id="staticEmail" value="">
                </div>
            </div>


        </div>
        <div class="col-sm-3">
            <button class="plus-icon remove-new-banner-input btn btn-danger">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
</script>


<script type="template" id="add-more-banners-confirmation_page">
    <div class="col-md-12 mb-2 d-flex flex-wrap banner-item">
        <div class="col-xl-7 p-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    {!! media_button('confirmation_page[images][]',$model) !!}

                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="staticEmail" class="col-sm-2 col-form-label">Url</label>
                <div class="col-sm-10">
                    <input type="text" name="confirmation_page[urls][]" class="form-control" id="staticEmailconfirmation_page" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tag</label>
                <div class="col-sm-10">
                    <input type="text" name="confirmation_page[tags][]" class="form-control" id="staticEmailconfirmation_page" value="">
                </div>
            </div>


        </div>
        <div class="col-sm-3">
            <button class="plus-icon remove-new-banner-input btn btn-danger">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
</script>

@section('js')
    <script>
        $("body").on("click", ".add-new-social-input", function () {
            var uid = Math.random().toString(36).substr(2, 9);
            var html = $("#add-more-banners").html();
            html = html.replace(/{count}/g, uid);
            $(".social-media-group").append(html);
        });
        $("body").on("click", ".remove-new-banner-input", function () {
            $(this).closest(".banner-item").remove();
        });

        $("body").on("click", ".add-new-social-input-product", function () {
            var uid = Math.random().toString(36).substr(2, 9);
            var html = $("#add-more-banners-product").html();
            html = html.replace(/{count}/g, uid);
            $(".social-media-group-product").append(html);
        });

        $("body").on("click", ".add-new-social-input-my_account", function () {
            var uid = Math.random().toString(36).substr(2, 9);
            var html = $("#add-more-banners-my_account").html();
            html = html.replace(/{count}/g, uid);
            $(".social-media-group-my_account").append(html);
        });

        $("body").on("click", ".add-new-social-input-confirmation_page", function () {
            var uid = Math.random().toString(36).substr(2, 9);
            var html = $("#add-more-banners-confirmation_page").html();
            html = html.replace(/{count}/g, uid);
            $(".social-media-group-confirmation_page").append(html);
        });

        $("body").on("click", ".add-new-social-input-lef_faq_ads", function () {
            var uid = Math.random().toString(36).substr(2, 9);
            var html = $("#add-more-lef_faq_ads").html();
            html = html.replace(/{count}/g, uid);
            $(".social-media-group-lef_faq_ads").append(html);
        });

        $("body").on("click", ".add-new-social-input-right_faq_ads", function () {
            var uid = Math.random().toString(36).substr(2, 9);
            var html = $("#add-more-right_faq_ads").html();
            html = html.replace(/{count}/g, uid);
            $(".social-media-group-right_faq_ads").append(html);
        });

    </script>
@stop

