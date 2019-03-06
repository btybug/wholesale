@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="panel panel-default users-log-wrapper">
        <div class="panel-heading">
            <div class="clearfix">
               <div class="d-flex pull-left">
                   <img class="profile-user-img img-responsive d-inline-block" src="{!!user_avatar()!!}" alt="avatar">
                   <div class="d-inline-block ml-10">
                       {!! Form::hidden('user_id',$user->id,['id' => 'userID']) !!}
                       <h3 class="profile-username mt-0 mb-5">{!! $user->name.' '.$user->last_name !!}</h3>

                       <p class="text-muted mb-0">{!! ($user->role)?$user->role->title:'User' !!}</p>
                   </div>
               </div>

                <div class="form-group pull-right">
                    {!! Form::open(['url'=>route('post_admin_users_reset_pass')]) !!}
                        {!! Form::hidden('email',$user->email) !!}
                        <button type="submit" class="btn btn-warning">Send reset password email</button>
                    {!! Form::close() !!}
                </div>

                <div class="pull-right mr-10">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#msgModal">Send message</button>
                    <div id="msgModal" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Send message</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('admin.widgets.quick_email')
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>

        <div class="panel-body">

            <div class="row d-flex">
                <div class="col-md-2">
                    <!-- Profile Image -->
                    <div class="box box-primary m-0 users-log-wrapper_col">
                        <div class="box-body box-profile">
                        </div>
                        <!-- /.box-body -->
                        <ul class=" nav nav-pills nav-stacked admin-profile-left">
                            <li class="active">
                                <a href="#users_account" data-toggle="tab">Account</a>
                            </li>
                            <li>
                                <a href="#users_messages" data-toggle="tab">Messages</a>
                            </li>
                            <li>
                                <a href="#users_favourites" data-toggle="tab">Favourites</a>
                            </li>
                            <li>
                                <a href="#users_orders" data-toggle="tab">Orders</a>
                            </li>
                            <li>
                                <a href="#users_address" data-toggle="tab">Address</a>
                            </li>
                            <li>
                                <a href="#users_tickets" data-toggle="tab">Tickets</a>
                            </li>
                            <li>
                                <a href="#users_referrals" data-toggle="tab">Referrals</a>
                            </li>
                            <li>
                                <a href="#users_offer" data-toggle="tab">Special Offer</a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-10">
                        {{--<ul class="nav nav-tabs">--}}
                        {{--<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>--}}
                        {{--<li><a href="#passwordDiv" data-toggle="tab">Password</a></li>--}}
                        {{--</ul>--}}
                        <div class="tab-content users-log-wrapper_tab-content">
                            <div id="users_account" class="tab-pane fade in active">
                                <div class="panel panel-default mb-0">
                                    <div class="panel-body">
                                        <!-- The timeline -->
                                        {!! Form::model($user,['class'=>'']) !!}
                                        {!! Form::hidden('id') !!}

                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 control-label">First Name</label>

                                            <div class="col-sm-10">
                                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 control-label">Last Name</label>
                                            <div class="col-sm-10">
                                                {!! Form::text('last_name',null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 control-label">E-mail </label>

                                            <div class="col-sm-10">
                                                {!! Form::text('email',null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 control-label">Phone</label>
                                            <div class="col-sm-10">
                                                {!! Form::text('phone',null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 control-label">Country</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('country',$countries,null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 control-label">Gender</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('gender',['male'=>'Male','female'=>'Female'],null,['class'=>'form-control']) !!}

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 control-label">Status</label>
                                            <div class="col-sm-10">
                                                {!! Form::hidden('status',null) !!}
                                                @if($user->email_verified_at == null)
                                                    <div class="form-control">Email Not Verified</div>
                                                @elseif($user->email_verified_at && ! $user->status)
                                                    <div class="form-control">ID Not Verified</div>
                                                @elseif($user->email_verified_at && $user->status)
                                                    <div class="form-control">Active</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 control-label">Membership</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('role_id',[null=>'No Membership']+$roles,null,['class'=>'form-control']) !!}

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-offset-2 col-sm-10 text-right">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}


                                        @if($user->verification_type && $user->verification_image)
                                            {!! Form::open() !!}
                                        <div class="row">
                                            <div class="form-group col-md-10">
                                                <div class="row">
                                                <label for="inputExperience" class="col-sm-4 control-label">Uploaded Doc : {{ strtoupper(str_replace('_'," ",$user->verification_type)) }}</label>
                                                <div class="col-sm-8">
                                                    <img class="img" src="{{ $user->verification_image }}" width="100"/>
                                                </div>
                                                </div>
                                                <div class="">
                                                    <button type="button" class="btn btn-info">View</button>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-2">
                                                @if(! $user->status)
                                                    <div>
                                                        <button type="button" class="btn btn-success approve-verify">Approve</button>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn btn-danger reject-verify">Reject</button>
                                                    </div>
                                                @else
                                                    <div>
                                                        <div class="alert alert-success">Verified</div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                            {!! Form::close() !!}
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div id="users_messages" class="tab-pane fade">
                                <div class="panel panel-default mb-0">
                                    <div class="panel-body">
                                        <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Url</th>
                                                <th>Method</th>
                                                <th>Ip</th>
                                                <th>Iso Code</th>
                                                <th>Country</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>State Name</th>
                                                <th>Timezone</th>
                                                <th>Agent</th>
                                                <th>Date</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="users_favourites" class="tab-pane fade">
                                <div class="panel panel-default mb-0">
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>
                            <div id="users_orders" class="tab-pane fade">
                                <div class="panel panel-default mb-0">
                                    <div class="panel-body">
                                        <table id="orders-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>Amount</th>
                                                <th>Country</th>
                                                <th>Region</th>
                                                <th>City</th>
                                                <th>Status</th>
                                                <th>Shipping method</th>
                                                <th>Payment Method</th>
                                                <th>Currency</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="users_address" class="tab-pane fade">
                                <div class="panel panel-default mb-0">
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <ul class="nav nav-pills nav-fill" role="tablist">
                                                <li>
                                                    <a class="btn btn-info nav-link nav-link--new-address active" id="billingAddress-tab"
                                                       data-toggle="tab" href="#billingAddress" role="tab" aria-controls="billingAddress"
                                                       aria-selected="true" aria-expanded="true">Billing Address</a>
                                                </li>
                                                <li>
                                                    <a class="btn btn-info nav-link nav-link--new-address" id="addressBook-tab"
                                                       data-toggle="tab"
                                                       href="#addressBook" role="tab" aria-controls="addressBook">Address Book</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane active in p-4" id="billingAddress" role="tabpanel"
                                                     aria-labelledby="billingAddress-tab">
                                                    {!! Form::model($billing_address,['class'=>'form-horizontal','url' => route('admin_users_address')]) !!}
                                                    {!! Form::hidden('user_id',$user->id) !!}
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="text" class="control-label col-sm-4">Name</label>
                                                            <div class="col-sm-8">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        {!! Form::text('first_name',null,['class'=>'form-control']) !!}
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        {!! Form::text('last_name',null,['class'=>'form-control']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="text" class="control-label col-sm-4">Company name</label>
                                                            <div class="col-sm-8">
                                                                {!! Form::text('company',null,['class'=>'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="text" class="control-label col-sm-4">1st Line address</label>
                                                            <div class="col-sm-8">
                                                                {!! Form::text('first_line_address',null,['class'=>'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="text" class="control-label col-sm-4">2nd line address</label>
                                                            <div class="col-sm-8">
                                                                {!! Form::text('second_line_address',null,['class'=>'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="text" class="control-label col-sm-4">Country</label>
                                                            <div class="col-sm-8">
                                                                {!! Form::select('country',['' => 'SELECT'] + $countries,null,['class'=>'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <label for="text" class="control-label col-sm-4">Regions</label>
                                                            <div class="col-sm-8">
                                                                {!! Form::text('region',null,['class'=>'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <label for="text" class="control-label col-sm-4">City</label>
                                                            <div class="col-sm-8">
                                                                {!! Form::text('city',null,['class'=>'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="text" class="control-label col-sm-4">Post Code</label>
                                                            <div class="col-sm-8">
                                                                {!! Form::text('post_code',null,['class'=>'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {!! Form::hidden('type','billing_address') !!}
                                                    {!! Form::hidden('id') !!}
                                                    <div class="form-group row">
                                                        <div class="col-sm-offset-4 col-sm-8">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                                <div class="tab-pane fade p-4" id="addressBook" role="tabpanel"
                                                     aria-labelledby="addressBook-tab">
                                                    <div class="panel panel-default">

                                                        <div class="panel-body">
                                                            <div>
                                                                <div class="p-5">

                                                                    <div class="form-group row mb-5">
                                                                        <div class="col-md-5">
                                                                            <h5>
                                                                                <label for="selectAddress" class="control-label text-muted">Select
                                                                                    your address</label>
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-md-7 d-flex">
                                                                            {!! Form::select('address_book',$address,($default_shipping)?$default_shipping->id:null,['class' => 'form-control edit-address']) !!}
                                                                            <button type="button"
                                                                                    class="nav-link nav-link--new-address btn btn-info address-book-new">
                                                                                + Add New
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="border py-3 px-4">
                                                                        <div class="selected-form">
                                                                            @include("frontend.my_account._partials.new_address",['address_book'=>$default_shipping,'default' => true])
                                                                        </div>
                                                                        {{--<button type="submit" class="btn btn-primary edit-address">Edit</button>--}}
                                                                        <button type="button" class="btn btn-danger edit-address">Delete
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            {{--Inner Tab Content--}}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="users_tickets" class="tab-pane fade">
                                <div class="panel panel-default mb-0">
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>
                            <div id="users_referrals" class="tab-pane fade">
                                <div class="panel panel-default mb-0">
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>
                            <div id="users_offer" class="tab-pane fade">
                                <div class="panel panel-default mb-0">
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>

                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
    </div>

    <div class="modal fade" id="newAddressModal" tabindex="-1" role="dialog"
         aria-labelledby="newAddressModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Address Book</h5>
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
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
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
        $(function () {
            $("body").on('click', '.reject-verify', function () {
                var user_id = $("#userID").val()
                AjaxCall(
                    "/admin/users/reject-verify",
                    { user_id: user_id},
                   function (res) {
                       window.location.reload();
                   }
                );
            });

            $("body").on('click', '.approve-verify', function () {
                var user_id = $("#userID").val()
                AjaxCall(
                    "/admin/users/approve-verify",
                    { user_id: user_id},
                   function (res) {
                       window.location.reload();
                   }
                );
            });


            $("body").on('click', '.save-address-book', function () {
                var form = $(".address-book-form").serialize();
                var user_id = $("#userID").val()

                AjaxCall(
                    "/admin/users/save-address-book",
                    form + "&user_id="+user_id,
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
                var user_id = $("#userID").val()
                AjaxCall(
                    "/admin/users/address-book-form",
                    { user_id: user_id},
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
                var user_id = $("#userID").val()
                AjaxCall(
                    "/admin/users/address-book-form",
                    {id: id, user_id: user_id},
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

            $('#users-table').DataTable({
                ajax:  "{!! route('datatable_user_activity',$user->id) !!}",
                columns: [
                    {data: 'id',name: 'id'},
                    {data: 'url',name: 'url'},
                    {data: 'method', name: 'method'},
                    {data: 'ip', name: 'ip'},
                    {data: 'iso_code', name: 'iso_code'},
                    {data: 'country', name: 'country'},
                    {data: 'city', name: 'city'},
                    {data: 'state', name: 'state'},
                    {data: 'state_name', name: 'state_name'},
                    {data: 'timezone', name: 'timezone'},
                    {data: 'agent', name: 'agent'},
                    {data: 'created_at', name: 'created_at'},
                ],
                order: [ [0, 'desc'] ]
            });

            $('#orders-table').DataTable({
                    ajax: "{!! route('datatable_user_orders',$user->id) !!}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'user', name: 'user'},
                        {data: 'amount', name: 'amount'},
                        {data: 'country', name: 'country'},
                        {data: 'region', name: 'region'},
                        {data: 'city', name: 'city'},
                        {data: 'status', name: 'status'},
                        {data: 'shipping_method', name: 'shipping_method'},
                        {data: 'payment_method', name: 'payment_method'},
                        {data: 'currency', name: 'currency'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'actions', name: 'actions'}
                    ],
                    order: [ [0, 'desc'] ]
                });
        });

    </script>
@stop
