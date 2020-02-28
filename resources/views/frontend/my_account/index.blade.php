@extends('layouts.frontend')
@section('content')
    <main class="main-content position-relative">
        <div class="my-account--selects">
            <div class="simple_select_wrapper">
                <select id="accounts--selects"
                        class="select-2 select-2--no-search main-select main-select-2arrows not-selected arrow-dark"
                        style="width: 100%">
                    <option value="{!! route('my_account') !!}">{!! __('account') !!}</option>
                    <option value="{!! route('messages') !!}">{!! __('notifications') !!}</option>
                    <option value="{!! route('my_account_favourites') !!}">{!! __('favorites') !!}</option>
                    <option value="{!! route('my_account_orders') !!}">{!! __('orders') !!}</option>
                    <option value="{!! route('my_account_address') !!}">{!! __('address') !!}</option>
                    <option value="{!! route('my_account_tickets') !!}">{!! __('tickets') !!}</option>
                    <option value="{!! route('my_account_referrals') !!}">{!! __('referrals') !!}</option>
                    <option value="{!! route('my_account_special_offers') !!}">{!! __('special_offer') !!}</option>
                    <option value="">{!! __('address') !!}</option>
                </select>
                {{--<select id="accounts"--}}
                {{--class="select-2 select-2--no-search main-select main-select-2arrows products-filter-wrap_select not-selected arrow-dark" style="width: 100%">--}}
                {{--<option value="{!! route('my_account') !!}">Account</option>--}}
                {{--<option>Brandos</option>--}}
                {{--<option>Eleaf</option>--}}
                {{--</select>--}}
            </div>
        </div>
        <div class="d-flex">
            {{--acoount sidebar--}}
            <div class="profile-sidebar profile-sidebar--inner-pages d-flex flex-column align-items-center">
                @include('frontend.my_account._partials.left_bar',['active'=>'my_account'])
                <div class="mt-auto">
                    {!! Form::open(['url'=>route('logout')]) !!}
                    <div class="text-center">
                        <button type="submit"
                                class="profile-sidebar_logout-btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase text-white pointer">
                            {!! __('logout') !!}
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>

            <div class="profile-inner-pg-right-cnt">
                <div class="profile-inner-pg-right-cnt_inner">
                    {{--<div class="col-md-4">--}}
                    {{--@include('frontend.my_account._partials.left_menu',['activeItem' => 'my_account'])--}}
                    {{--</div>--}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-xl-7 col-md-7">
                                    <div class="profile-info">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-4">
                                                <div class="profile-info_avatar-holder position-relative mb-3 mx-md-0 mx-auto">
                                                    {!! Form::open() !!}
                                                    <div class="dropzone"
                                                         data-image="{!! user_avatar() !!}" data-width="200" data-height="200" data-originalsize="false"
                                                         data-url="{!! route('profile_image_upload') !!}">
                                                        <input type="file" name="thumb"/>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                                {{--                                                  <div class="profile-info_avatar-holder position-relative mb-3 mx-md-0 mx-auto">--}}
                                                {{--                                                      <img class="img-fluid" src="img/profile.png" alt="">--}}
                                                {{--                                                      <a href="#"--}}
                                                {{--                                                         class="d-flex align-items-center justify-content-center profile-info_change-avatar-btn font-13 main-transition position-absolute">Change</a>--}}
                                                {{--                                                  </div>--}}

                                            </div>
                                            <div class="col-xl-9 col-lg-8">
                                                <div class="text-md-left text-center">
                                                    <h1 class="mb-2 font-20 font-main-bold text-uppercase">
                                                        <span class="d-inline-block mr-2">{{ $user->name }}</span>
                                                        <span>{{ $user->last_name }}</span>
                                                    </h1>
                                                    <div class="font-13 text-gray-clr">
                                                        <p class="mb-2">
                                                            <span class="d-inline-block mr-2">{{ $user->dob }}</span>
                                                            <span>{{ ($user->age) ? $user->age .' '.__('years') : null }}</span>

                                                        </p>
                                                        <p>{{ ucfirst($user->gender) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button trigger modal -->
                                        <div class="text-md-left text-center">
                                            <button type="button" class="btn btn-transp rounded-0" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                {!! __('change_password') !!}
                                            </button>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-xl-5 col-md-5 mb-md-0 mb-4">
                                    <!--profile status-->
                                    <div class="profile-status-wrap text-centet mb-3">
                                        <h2 class="profile-status-wrap_title font-20 font-main-bold text-uppercase text-center mb-3">
                                            {!! __('status') !!}</h2>
                                        <p>{!! __('verified_user') !!}</p>
                                    </div>
                                    @if(!$user->orders()->count() && !$user->referred_by)
                                        {!! Form::model($user,['url'=>route('post_my_account_referrals')]) !!}
                                    @endif
                                    <div class="form-group row no-gutters p-0">
                                        <label for="username" class="col-md-2 col-form-label">
                                           {!! __('referred_by') !!}
                                        </label>
                                        <div class="col-md-6">
                                            @if(!$user->orders()->count() && !$user->referred_by)
                                                {!! Form::text('referred_by',null,['class'=>'form-control '.($errors->has('referred_by') ? ' is-invalid' : '')]) !!}

                                                @if ($errors->has('referred_by'))
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $errors->first('referred_by') }}</strong></span>
                                                @endif
                                            @else
                                                <span class="form-control">{!! $user->referred_by !!}</span>
                                            @endif
                                        </div>
                                        @if(!$user->orders()->count() && !$user->referred_by)
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-success">{!! __('submit') !!}</button>
                                            </div>
                                        @endif
                                    </div>
                                    @if(!$user->orders()->count() && !$user->referred_by)
                                        {!! Form::close() !!}
                                    @endif
                                </div>

                            </div>
                            <div>
                                <div class="mb-5">
                                    @if($user->status)
                                        {!! Form::model($user,['url' => route('my_account_save_contact_data')]) !!}
                                    @else
                                        {!! Form::model($user) !!}
                                    @endif
                                    @if($user->status)
                                        {{--<div class="form-group row">--}}
                                        {{--<label for="username" class="col-md-4">--}}
                                        {{--First Name--}}
                                        {{--</label>--}}
                                        {{--<div class="col-md-8">--}}
                                        {{--<div class="form-control">{{ $user->name }}</div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group row">--}}
                                        {{--<label for="username" class="col-md-4">--}}
                                        {{--Last Name--}}
                                        {{--</label>--}}
                                        {{--<div class="col-md-8">--}}
                                        {{--<div class="form-control">{{ $user->last_name }}</div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}

                                        {{--<div class="form-group row">--}}
                                        {{--<label for="username" class="col-md-4">--}}
                                        {{--Date of birth--}}
                                        {{--</label>--}}
                                        {{--<div class="col-sm-6">--}}
                                        {{--<div class="form-control">{{ $user->dob }}</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-2">--}}
                                        {{--{{ ($user->age) ? $user->age .' years' : null }}--}}
                                        {{--</div>--}}
                                        {{--</div>--}}


                                        {{--<div class="form-group row">--}}
                                        {{--<label for="username" class="col-md-4">--}}
                                        {{--Gender--}}
                                        {{--</label>--}}
                                        {{--<div class="col-md-8">--}}
                                        {{--<div class="form-control">{{ ucfirst($user->gender) }}</div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                    @else
                                        <div class="profile-form">
                                            <div class="row">
                                                <div class="col-xl-8">
                                                    <div class="form-group row">
                                                        <label for="username" class="col-md-4">
                                                            {!! __('first_name') !!}
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                        <div class="col-md-8">
                                                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="username" class="col-md-4">
                                                            {!! __('last_name') !!}
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                        <div class="col-md-8">
                                                            {!! Form::text('last_name',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="username" class="col-md-4">
                                                            {!! __('date_of_birth') !!}
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                        <div class="col-sm-6">
                                                            <div class="input-group date">
                                                                {!! Form::text('dob',null,['placeholder' => __('date_of_birth'),
                                                              'id'=>'dob', 'class'=> 'form-control date']) !!}
                                                                <span class="input-group-btn">
<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
</span></div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            {{ ($user->age) ? $user->age .' '.__('years') : null }}
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="username" class="col-md-4">
                                                            {!! __('gender') !!}
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                        <div class="col-md-8">
                                                            {!! Form::select('gender',['male'=>__('male'),'female'=>__('female')],null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    @endif


                                    <div class="card account-card rounded-0 mb-5">
                                        <h2 class="card-title font-20"> {!! __('contact_details') !!}</h2>

                                        <div class="card-body">
                                            <div class="form-group row mail">
                                                <label for="username" class="col-md-4">
                                                    {!! __('email_address') !!}
                                                    <span class="required text-danger">*</span>
                                                </label>

                                                <div class="col-md-8">
                                                    {!! Form::email('email',null,['class'=>'form-control','id'=>'exampleInputEmail1','aria-describedby'=>"emailHelp"]) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="username" class="col-md-4">
                                                    {!! __('phone') !!}
                                                    <span class="required text-danger">*</span>
                                                </label>
                                                <div class="col-md-8">
                                                    {!! Form::text('phone',null,['class'=>'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{--<div class="card account-card rounded-0 mb-5">--}}
                                        {{--<h2 class="card-title font-20 mb-0">Billing Address</h2>--}}

                                        {{--<div class="card-body">--}}
                                            {{--{!! Form::model(@$billing_address,['class'=>'form-horizontal']) !!}--}}
                                            {{--<div class="form-group">--}}
                                            {{--<div class="row">--}}
                                            {{--<label for="text" class="control-label col-sm-4">Name</label>--}}
                                            {{--<div class="col-sm-8">--}}
                                            {{--<div class="row">--}}
                                            {{--<div class="col-sm-6">--}}
                                            {{--{!! Form::text('first_name',null,['class'=>'form-control']) !!}--}}
                                            {{--</div>--}}
                                            {{--<div class="col-sm-6">--}}
                                            {{--{!! Form::text('last_name',null,['class'=>'form-control']) !!}--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group">--}}
                                                {{--<div class="row">--}}
                                                    {{--<label for="text" class="control-label col-sm-4">Company--}}
                                                        {{--name</label>--}}
                                                    {{--<div class="col-sm-8">--}}
                                                        {{--{!! Form::text('company',null,['class'=>'form-control']) !!}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group">--}}
                                                {{--<div class="row">--}}
                                                    {{--<label for="text" class="control-label col-sm-4">1st Line--}}
                                                        {{--address</label>--}}
                                                    {{--<div class="col-sm-8">--}}
                                                        {{--{!! Form::text('first_line_address',null,['class'=>'form-control']) !!}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group">--}}
                                                {{--<div class="row">--}}
                                                    {{--<label for="text" class="control-label col-sm-4">2nd line--}}
                                                        {{--address</label>--}}
                                                    {{--<div class="col-sm-8">--}}
                                                        {{--{!! Form::text('second_line_address',null,['class'=>'form-control']) !!}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group hide">--}}
                                                {{--<div class="row">--}}
                                                    {{--<label for="text" class="control-label col-sm-4">City</label>--}}
                                                    {{--<div class="col-sm-8">--}}
                                                        {{--{!! Form::text('city',null,['class'=>'form-control']) !!}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group hide">--}}
                                                {{--<div class="row">--}}
                                                    {{--<label for="text" class="control-label col-sm-4">Region</label>--}}
                                                    {{--<div class="col-sm-8">--}}
                                                        {{--{!! Form::text('region',null,['class'=>'form-control','id' => 'regions']) !!}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group">--}}
                                                {{--<div class="row">--}}
                                                    {{--<label for="text" class="control-label col-sm-4">Post Code</label>--}}
                                                    {{--<div class="col-sm-8">--}}
                                                        {{--{!! Form::text('post_code',null,['class'=>'form-control']) !!}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group">--}}
                                                {{--<div class="row">--}}
                                                    {{--<label for="text" class="control-label col-sm-4">Country</label>--}}
                                                    {{--<div class="col-sm-8">--}}
                                                        {{--{!! Form::select('country',$countriesShipping,null,--}}
                                                        {{--['class'=>'select-2 select-2--no-search main-select account-country-select','id' => 'country','style' => 'width: 100%']) !!}--}}
                                                        {{--{!! Form::select('country',['' => 'SELECT'],null,['class'=>'form-control']) !!}--}}
                                                        {{--<select id="country"--}}
                                                                {{--class="select-2 select-2--no-search main-select account-country-select"--}}
                                                                {{--style="width: 100%">--}}

                                                            {{--<option class="selected">Armenia</option>--}}
                                                            {{--<option>UK</option>--}}
                                                            {{--<option>USA</option>--}}
                                                        {{--</select>--}}
                                                    {{--</div>--}}

                                                {{--</div>--}}
                                            {{--</div>--}}

                                            {{--{!! Form::hidden('type','billing_address') !!}--}}
                                            {{--{!! Form::hidden('id') !!}--}}
                                            {{--<div class="form-group row">--}}
                                            {{--<div class="col-sm-offset-4 col-sm-8">--}}
                                            {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--{!! Form::close() !!}--}}
                                        {{--</div>--}}

                                    {{--</div>--}}

                                    {{--<div class="form-group row">--}}
                                    {{--<label for="username" class="col-md-4">--}}
                                    {{--Country--}}
                                    {{--<span class="required text-danger">*</span>--}}
                                    {{--</label>--}}
                                    {{--<div class="col-md-8">--}}
                                    {{--{!! Form::text('country',null,['class'=>'form-control']) !!}--}}
                                    {{--</div>--}}
                                    {{--</div>--}}


                                    {{--<div class="form-group row avatar align-items-center mb-4 border-top border-bottom py-3">--}}
                                    {{--<span class="col-md-4">Avatar</span>--}}
                                    {{--<div class="col-md-8">--}}
                                    {{--<img width="150" src="/public/images/{!!$user->gender!!}.png" alt="">--}}
                                    {{--<div>--}}
                                    {{--<button type="button" class="btn btn-secondary">Change Avatar</button>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="form-group">

                                        <input type="submit" class="btn ntfs-btn rounded-0" value="{!! __('save_changes') !!}">
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                                {!! Form::model($newsletters,['class'=>'form-horizontal','url' => route('account_email_settings')]) !!}
                                {{--                                {!! Form::model('email_settings[22,21]',['class'=>'form-horizontal','url' => route('account_email_settings')]) !!}--}}
                                <div class="card account-card rounded-0 mb-5">
                                    <h2 class="card-title font-20">{!! __('email_settings') !!}</h2>

                                    <div class="card-body">
                                        <!--subscribe to-->
                                        <div>
                                            <p class="mb-2">{!! __('subscribe_to') !!}:</p>
                                            <div class="modal-accounts d-flex flex-column flex-sm-row align-items-start align-items-sm-center">
                                                @foreach($categories as $category)
                                                    <div class="position-relative mr-0 mr-sm-5 mb-3 mb-sm-0">
                                                        <input name="{{ ($category->slug != 'communications')
                                                                    ? 'email_settings[]' : '' }}"
                                                               class="form-check-input register-form_input-check"
                                                               type="checkbox"

                                                               value="{{ $category->id }}"
                                                               id="subscribeCheck{{ $category->id }}"
                                                                {{ ($category->slug == 'communications') ?
                                                                'checked="checked" disabled="disabled"'
                                                                : ((in_array($category->id,$newsletters)) ? 'checked="checked"':'') }}>
                                                        <label class="form-check-label text-gray-clr register-form_label pointer"
                                                               for="subscribeCheck{{ $category->id }}">
                                                            {{ $category->name }}
                                                            <span class="check-icon d-inline-flex align-items-center justify-content-center position-absolute">
                                            <svg viewBox="0 0 26 26" enable-background="new 0 0 26 26">
    <path d="m.3,14c-0.2-0.2-0.3-0.5-0.3-0.7s0.1-0.5 0.3-0.7l1.4-1.4c0.4-0.4 1-0.4 1.4,0l.1,.1 5.5,5.9c0.2,0.2 0.5,0.2 0.7,0l13.4-13.9h0.1v-8.88178e-16c0.4-0.4 1-0.4 1.4,0l1.4,1.4c0.4,0.4 0.4,1 0,1.4l0,0-16,16.6c-0.2,0.2-0.4,0.3-0.7,0.3-0.3,0-0.5-0.1-0.7-0.3l-7.8-8.4-.2-.3z"></path>
    </svg></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                                <div class="form-group mb-0">
                                                    <input type="submit" class="btn ntfs-btn rounded-0"
                                                           value="{!! __('save_settings') !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}


                            <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        {!! Form::open(['url'=>route('my_account_change_password')]) !!}
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{!! __('change_password') !!}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    <div class="form-group row username">
                                                        <label for="currentPass" class="col-md-4">
                                                            {!! __('current_password') !!}
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="password" name='current_password'
                                                                   class="form-control"
                                                                   id="currentPass">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row confirm">
                                                        <label for="exampleInputPassword2" class="col-md-4">
                                                            {!! __('new_password') !!}
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="password" name="password" class="form-control"
                                                                   id="exampleInputPassword2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row confirm">
                                                        <label for="exampleInputPassword3" class="one col-md-4">
                                                            {!! __('confirm_new_password') !!}
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="password" name="password_confirmation"
                                                                   class="form-control"
                                                                   id="exampleInputPassword3">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-transp rounded-0"
                                                        data-dismiss="modal">{!! __('close') !!}
                                                </button>
                                                <button type="submit" class="btn ntfs-btn rounded-0">{!! __('save_changes') !!}
                                                </button>
                                            </div>
                                        </div>


                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{--@include('frontend.my_account._partials.verify_bar.blade_old.php')--}}
        </div>
    </main>

@stop
@section('css')
    {!! Html::style('public/css/demo.html5imageupload.css') !!}
    <style>
        .table-tr-border-bottom-white {
            border-bottom: 1px solid #ffffff !important;
        }
        .profile-info_avatar-holder .dropzone{
            width: 100% !important;
            height: 100% !important;
            border: none;
        }
        .profile-info_avatar-holder > form {
            width: 100%;
            height: 100%;
        }
        .profile-info_avatar-holder .dropzone img.preview{
            height: 100%;
            object-fit: cover;
        }
        .profile-info_avatar-holder .dropzone.smalltext:after{
            content: 'Change';
            bottom: 0;
            height: 30px;
            background-color: #6a92e1;
            color: #fff;
            font-size: 13px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            -ms-transition: all .5s;
            -o-transition: all .5s;
            transition: all .5s;
        }
        .profile-info_avatar-holder .dropzone.smalltext:hover:after{
            height: 100%;
            color: #fff;
        }
    </style>
    {!! Html::style("public/admin_theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css") !!}
@stop

@section('js')
    {!! Html::script("public/admin_theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")!!}
    {!! Html::script('public/js/html5imageupload.js') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $(document).on('scroll', function () {
                let sumHead = $('.main-header').outerHeight() + $('.header-bottom').outerHeight();
                if ($(this).scrollTop() >= sumHead) {
                    $('.my-account--selects').addClass('fixing')
                } else {
                    $('.my-account--selects').removeClass('fixing')
                }
            })
            $("body").on('click', '.save-address-book', function () {
                var form = $(".address-book-form").serialize();
                AjaxCall(
                    "/my-account/save-address-book",
                    form,
                    res => {
                    if (
                !res.error
                )
                {
                    window.location.reload();
                }
            },
                error =>
                {
                    if (error.status == 422) {
                        $('.errors').html('');
                        for (var err in error.responseJSON.errors) {
                            $('.errors').append(error.responseJSON.errors[err] + '<br>');
                        }
                    }
                }
                )
                ;
            })

            $("#country").select2();
            $("#geo_country").select2();

            function getRegionsPackage() {
                let value = $("#country").val();
                AjaxCall(
                    "/get-regions-by-country",
                    {country: value},
                    res => {
                    let select = document.getElementById('regions');
                select.innerText = null;
                if (!res.error) {
                    $.each(res.data, function (index, value) {
                        var opt = document.createElement('option');
                        opt.value = res.data[value];
                        opt.innerHTML = res.data[value];
                        select.appendChild(opt);
                    })

                }
            }
            )
                ;
            }

            $("body").on('click', '.address-book-new', function () {
                AjaxCall(
                    "/my-account/address-book-form",
                    {},
                    res => {
                    if (
                !res.error
                )
                {
                    $(".address-form").html(res.html);
                    $("#geo_country_book").select2();
                    $("#newAddressModal").modal();
                }
            }
                )
                ;
            });

            $("body").on('change', '.edit-address', function () {
                var id = $(this).val();
                AjaxCall(
                    "/my-account/address-book-form",
                    {id: id},
                    res => {
                    if (
                !res.error
                )
                {
                    $(".selected-form").html(res.html);
                    $("#geo_country_book").select2();
                    //                    $("#newAddressModal").modal();
                }
            }
                )
                ;
            });

            function getRegions() {
                let value = $("#geo_country").val();
                AjaxCall(
                    "/get-regions-by-geozone",
                    {country: value},
                    res => {
                    let select = document.getElementById('geo_region');
                select.innerText = null;
                if (!res.error) {
                    var opt = document.createElement('option');
                    $.each(res.data, function (k, v) {
                        var option = $(opt).clone();
                        option.val(k);
                        option.text(v);
                        $(select).append(option);
                    });

                }
            }
            )
                ;
            }

            function renderAddressBook() {
                let value = $(".select-address").val();
                AjaxCall(
                    "/my-account/select-address-book",
                    {id: value},
                    res => {
                    if (
                !res.error
            )
                {
                    $(".render-address").html(res.html);
                }
            }
            )
                ;
            }

            $("body").on("change", ".select-address", function () {
                renderAddressBook();
            });

            $("body").on("change", "#country", function () {
                getRegionsPackage();
            });

            $("body").on("change", "#geo_country", function () {
                getRegions();
            });

            $("body").on("change", "#geo_country_book", function () {
                var value = $(this).val();
                let $_this = $(this);
                AjaxCall(
                    "/get-regions-by-geozone",
                    {country: value},
                    res => {
                    let select = $_this.closest('.address-book-form').find('.geo_region_book');
                $(select).empty();
                if (!res.error) {
                    console.log($(select).val());
                    var opt = document.createElement('option');
                    $.each(res.data, function (k, v) {
                        var option = $(opt).clone();
                        option.val(k);
                        option.text(v);
                        $(select).append(option);
                    });
                }
            }
                )
                ;
            });
        });


        $(function () {
            $("#dob").datepicker({
                format: 'yyyy-mm-dd',
                changeMonth: true,
                changeYear: true,
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                // maxYear: parseInt(moment().format('YYYY'),10)
            });
        });
    </script>
    {!! Html::script('public/js/my_account.js') !!}
@stop
