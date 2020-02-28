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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{--@include('frontend._partials.left_bar')--}}

                {{--acoount sidebar--}}
                <div class="profile-sidebar profile-sidebar--inner-pages d-flex flex-column align-items-center">
                    @include('frontend.my_account._partials.left_bar',['active'=>'my_account_address'])
                    {{--@include('frontend.my_account._partials.left_bar')--}}
                    <div class="mt-auto">
                        {!! Form::open(['url'=>route('logout')]) !!}
                        <div class="text-center">
                            <button type="submit" class="profile-sidebar_logout-btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase text-white pointer">{!! __('logout') !!}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>

            <div class="profile-inner-pg-right-cnt">
                <div class="profile-inner-pg-right-cnt_inner h-100">
                   <div class="row">
                       <div class="col-lg-9">
                           {{--<ul class="nav nav-pills nav-fill" role="tablist">--}}
                               {{--<li>--}}
                                   {{--<a class="btn btn-info nav-link nav-link--new-address active" id="billingAddress-tab"--}}
                                      {{--data-toggle="tab" href="#billingAddress" role="tab" aria-controls="billingAddress"--}}
                                      {{--aria-selected="true" aria-expanded="true">Billing Address</a>--}}
                               {{--</li>--}}
                               {{--<li class="active">--}}
                                   {{--<a class="btn btn-info nav-link nav-link--new-address" id="addressBook-tab"--}}
                                      {{--data-toggle="tab"--}}
                                      {{--href="#addressBook" role="tab" aria-controls="addressBook">Address Book</a>--}}
                               {{--</li>--}}
                           {{--</ul>--}}

                           <div class="tab-content">
                               {{--<div class="tab-pane fade active in show p-4" id="billingAddress" role="tabpanel"--}}
                                    {{--aria-labelledby="billingAddress-tab">--}}
                                   {{--{!! Form::model($billing_address,['class'=>'form-horizontal']) !!}--}}
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
                                           {{--<label for="text" class="control-label col-sm-4">Company name</label>--}}
                                           {{--<div class="col-sm-8">--}}
                                               {{--{!! Form::text('company',null,['class'=>'form-control']) !!}--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                   {{--</div>--}}
                                   {{--<div class="form-group">--}}
                                       {{--<div class="row">--}}
                                           {{--<label for="text" class="control-label col-sm-4">1st Line address</label>--}}
                                           {{--<div class="col-sm-8">--}}
                                               {{--{!! Form::text('first_line_address',null,['class'=>'form-control']) !!}--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                   {{--</div>--}}
                                   {{--<div class="form-group">--}}
                                       {{--<div class="row">--}}
                                           {{--<label for="text" class="control-label col-sm-4">2nd line address</label>--}}
                                           {{--<div class="col-sm-8">--}}
                                               {{--{!! Form::text('second_line_address',null,['class'=>'form-control']) !!}--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                   {{--</div>--}}
                                   {{--<div class="form-group">--}}
                                       {{--<div class="row">--}}
                                           {{--<label for="text" class="control-label col-sm-4">Country</label>--}}
                                           {{--<div class="col-sm-8">--}}
                                               {{--{!! Form::select('country',['' => 'SELECT'] + $countries,null,['class'=>'form-control']) !!}--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                   {{--</div>--}}
                                   {{--<div class="form-group hide">--}}
                                       {{--<div class="row">--}}
                                           {{--<label for="text" class="control-label col-sm-4">Regions</label>--}}
                                           {{--<div class="col-sm-8">--}}
                                               {{--{!! Form::text('region',null,['class'=>'form-control','id' => 'regions']) !!}--}}
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
                                   {{--<div class="form-group">--}}
                                       {{--<div class="row">--}}
                                           {{--<label for="text" class="control-label col-sm-4">Post Code</label>--}}
                                           {{--<div class="col-sm-8">--}}
                                               {{--{!! Form::text('post_code',null,['class'=>'form-control']) !!}--}}
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

                                       <div>

                                           <div class="form-group mb-5">
                                               <label for="selectAddress" class="control-label text-muted font-22">{!! __('default_shipping_address') !!}</label>
                                               <div class="row">
                                                   <div class="col-md-5 d-flex">
                                                       {!! Form::select('address_book',$address,($default_shipping)?$default_shipping->id:null,['class' => 'form-control select-2 select-2--no-search main-select main-select-2arrows checkout-form_select edit-address']) !!}
                                                       <button type="button"
                                                               class="nav-link nav-link--new-address btn ntfs-btn address-book-new rounded-0 ml-4">
                                                           + {!! __('add_new') !!}
                                                       </button>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="border py-3 px-4">
                                               <div class="selected-form mb-3">
                                                   @include("frontend.my_account._partials.new_address",['address_book'=>$default_shipping,'default' => true])
                                               </div>
                                               {{--<button type="submit" class="btn btn-primary edit-address">Edit</button>--}}
                                               <div class="col-md-9 offset-md-3 text-right">
                                                   <button type="button" class="btn btn-transp edit-address rounded-0">{!! __('delete') !!}</button>
                                               </div>
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


    <div class="modal fade" id="newAddressModal" tabindex="-1" role="dialog"
         aria-labelledby="newAddressModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{!! __('address_book') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body address-form">

                </div>
            </div>
        </div>
    </div>

@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <style>
        .errors {
            color:red;
        }
    </style>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
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
                    // window.location.reload();
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
                    $("body").find(".geo_region_book").select2();
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
                            $("body").find(".address-book-form .geo_region_book").select2();

                            // $("#newAddressModal").modal();
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
                    let select = $("body").find('#geo_region');
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
                    $(select).empty()
                    if (!res.error) {
                        console.log($(select).val())
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
        })
    </script>
@endsection
