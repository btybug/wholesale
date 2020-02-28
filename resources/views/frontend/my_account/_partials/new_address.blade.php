{!! Form::model($address_book,['class'=>'checkout-form address-book-form','url' => route('post_my_account_address_book_save')]) !!}
<div class="errors">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>


<div class="form-group d-flex flex-md-row flex-column align-items-md-center justify-content-between">
    <label for="fullName" class="checkout-form_label text-gray-clr mb-0 pl-md-0 pl-3">{!! __('first_name') !!}<span
                class="form-required-icon text-quatr-clr font-main-bold">&nbsp;&#42;</span></label>
    <div class="col-md-9">
        <div class="checkout-form_input-group">   <!--gets form-has-err class-->
            {!! Form::text('first_name',null,['class'=>'form-control checkout-form_input-text']) !!}
            <p class="err-msg">name is not valid</p>
        </div>

    </div>
</div>

<div class="form-group d-flex flex-md-row flex-column align-items-md-center justify-content-between">
    <label for="fullName" class="checkout-form_label text-gray-clr mb-0 pl-md-0 pl-3">{!! __('last_name') !!}<span
                class="form-required-icon text-quatr-clr font-main-bold">&nbsp;&#42;</span></label>
    <div class="col-md-9">
        <div class="checkout-form_input-group">   <!--gets form-has-err class-->
            {{--<input id="fullName" type="text" class="form-control checkout-form_input-text">--}}
            {!! Form::text('last_name',null,['class'=>'form-control checkout-form_input-text']) !!}
            <p class="err-msg">name is not valid</p>
        </div>

    </div>
</div>

<div class="form-group d-flex flex-md-row flex-column align-items-md-center justify-content-between">
    <label for="companyName" class="checkout-form_label text-gray-clr mb-0 pl-md-0 pl-3">{!! __('company_name') !!}</label>
    <div class="col-md-9">
        <div class="checkout-form_input-group">   <!--gets form-has-err class-->
            {!! Form::text('company',null,['class'=>'form-control checkout-form_input-text']) !!}
            <p class="err-msg">{!! __('name_not_valid') !!}</p>
        </div>

    </div>
</div>
<div class="form-group d-flex flex-md-row flex-column align-items-md-center justify-content-between">
    <label for="address1" class="checkout-form_label text-gray-clr mb-0 pl-md-0 pl-3">{!! __('address') !!} 1<span
                class="form-required-icon text-quatr-clr font-main-bold">&nbsp;&#42;</span></label>
    <div class="col-md-9">
        <div class="checkout-form_input-group">   <!--gets form-has-err class-->
            {!! Form::text('first_line_address',null,['class'=>'form-control checkout-form_input-text']) !!}
            <p class="err-msg">{!! __('address_not_valid') !!}</p>
        </div>

    </div>
</div>
<div class="form-group d-flex flex-md-row flex-column align-items-md-center justify-content-between">
    <label for="address2" class="checkout-form_label text-gray-clr mb-0 pl-md-0 pl-3">
        {!! __('address') !!} 2<span class="form-required-icon text-quatr-clr font-main-bold">&nbsp;&#42;</span>
    </label>
    <div class="col-md-9">
        <div class="checkout-form_input-group">   <!--gets form-has-err class-->
            {!! Form::text('second_line_address',null,['class'=>'form-control checkout-form_input-text']) !!}
            <p class="err-msg">{!! __('address_not_valid') !!}</p>
        </div>

    </div>
</div>

<div class="form-group d-flex flex-md-row flex-column align-items-md-center justify-content-between">
    <label for="city" class="checkout-form_label text-gray-clr mb-0 pl-md-0 pl-3">city<span
                class="form-required-icon text-quatr-clr font-main-bold">&nbsp;&#42;</span></label>
    <div class="col-md-9">
        <div class="checkout-form_input-group">   <!--gets form-has-err class-->
            {!! Form::text('city',null,['class'=>'form-control checkout-form_input-text']) !!}
            <p class="err-msg">{!! __('city_not_valid') !!}</p>
        </div>

    </div>
</div>

<div class="form-group d-flex flex-md-row flex-column align-items-md-center justify-content-between">
    <label for="region" class="checkout-form_label text-gray-clr mb-0 pl-md-0 pl-3">{!! __('region') !!}<span
                class="form-required-icon text-quatr-clr font-main-bold">&nbsp;&#42;</span></label>
    <div class="col-md-9">
        <div class="checkout-form_input-group">   <!--gets form-has-err class-->
            {!! Form::select('region',getRegionByZone(@$address_book->country),null,
            ['class'=>'form-control select-2 select-2--no-search main-select main-select-2arrows checkout-form_select geo_region_book',
            'id' => 'geo_region_book','style' => 'width: 100%;']) !!}

            <p class="err-msg">{!! __('region_not_valid') !!}</p>
        </div>

    </div>
</div>

<div class="form-group d-flex flex-md-row flex-column align-items-md-center justify-content-between">
    <label for="posatalCode" class="checkout-form_label text-gray-clr mb-0 pl-md-0 pl-3">{!! __('zip_postal_code') !!}<span
                class="form-required-icon text-quatr-clr font-main-bold">&nbsp;&#42;</span></label>
    <div class="col-md-9">
        <div class="checkout-form_input-group">   <!--gets form-has-err class-->
            {!! Form::text('post_code',null,['class'=>'form-control checkout-form_input-text']) !!}

            <p class="err-msg">{!! __('code_not_valid') !!}</p>
        </div>

    </div>
</div>

<div class="form-group d-flex flex-md-row flex-column align-items-md-center justify-content-between">
    <label for="country" class="checkout-form_label text-gray-clr mb-0 pl-md-0 pl-3">{!! __('country') !!}<span
                class="form-required-icon text-quatr-clr font-main-bold">&nbsp;&#42;</span></label>
    <div class="col-md-9">
        <div class="checkout-form_input-group">   <!--gets form-has-err class-->
            {!! Form::select('country',$countriesShipping,null,['class'=>'select-2 select-2--no-search main-select main-select-2arrows checkout-form_select geo_country_book',
            'id' => 'geo_country_book','style' => 'width: 100%;']) !!}
            <p class="err-msg">{!! __('country_not_valid') !!}</p>
        </div>

    </div>
</div>



<div class="d-flex flex-md-row flex-column align-items-md-center justify-content-between">
    <div class="d-flex align-items-center pl-md-0 pl-3 mb-md-0 mb-3">
        <div class="position-relative modal-accounts">
            {!! Form::hidden('make_default',0) !!}
            {!! Form::checkbox('make_default',1,null,['class' => 'form-check-input register-form_input-check','id'=>'defaultCheckModal']) !!}
            <label class="form-check-label text-gray-clr pointer" for="defaultCheckModal">
                {!! __('set_as_default') !!}
                <span class="check-icon d-inline-flex align-items-center justify-content-center position-absolute">
                                            <svg viewBox="0 0 26 26" enable-background="new 0 0 26 26">
                                                <path d="m.3,14c-0.2-0.2-0.3-0.5-0.3-0.7s0.1-0.5 0.3-0.7l1.4-1.4c0.4-0.4 1-0.4 1.4,0l.1,.1 5.5,5.9c0.2,0.2 0.5,0.2 0.7,0l13.4-13.9h0.1v-8.88178e-16c0.4-0.4 1-0.4 1.4,0l1.4,1.4c0.4,0.4 0.4,1 0,1.4l0,0-16,16.6c-0.2,0.2-0.4,0.3-0.7,0.3-0.3,0-0.5-0.1-0.7-0.3l-7.8-8.4-.2-.3z"/>
                                            </svg>
                                        </span>
            </label>
        </div>
    </div>
    {!! Form::hidden('type','address_book') !!}
    {!! Form::hidden('id') !!}
    <div class="col-md-9 d-flex flex-sm-row flex-column-reverse justify-content-sm-end">
        <button type="button" class="btn btn-danger btn-transp text-uppercase btn-submit btn-submit-cancel font-15 mr-sm-3 rounded-0">{!! __('cancel') !!}</button>
        <button type="button" class="btn btn-info ntfs-btn save-address-book rounded-0">{!! __('submit') !!}</button>
    </div>
</div>

{!! Form::close() !!}
