@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default users-log-wrapper bg-transparent border-0">
        <div class="card-header panel-heading d-flex flex-wrap justify-content-between">
            <div class="d-flex">
                <img class="profile-user-img img-responsive d-inline-block" src="{!!user_avatar($user->id)!!}" alt="avatar">
                <div class="d-inline-block ml-10">
                    {!! Form::hidden('user_id',$user->id,['id' => 'userID']) !!}
                    <h3 class="profile-username mt-0 mb-1">{!! $user->name.' '.$user->last_name !!}</h3>

                    <p class="text-muted mb-0">{!! ($user->role)?$user->role->title:'User' !!}</p>
                </div>
            </div>
            <div class="d-flex">
               @if(! $user->email_verified_at)
                    <div class="form-group ">
                        {!! Form::open(['url'=>route('admin_users_approve')]) !!}
                        {!! Form::hidden('id',$user->id) !!}
                        <button type="submit" class="btn btn-success">Verify</button>
                        {!! Form::close() !!}
                    </div>
                @endif

{{--                    <div class="form-group ml-1">--}}
{{--                        {!! Form::open(['url'=>route('admin_users_reject')]) !!}--}}
{{--                        {!! Form::hidden('id',$user->id) !!}--}}
{{--                        <button type="submit" class="btn btn-danger">Block</button>--}}
{{--                        {!! Form::close() !!}--}}
{{--                    </div>--}}
                <div class="pull-right ml-1">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#msgModal">Send
                        message
                    </button>
                    <div id="msgModal" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
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
            <div class="w-100">

                @if($user->isWholeseler())
                    @if(! $user->wholesaler_status)
                        <div class="form-group ">
                            {!! Form::open(['url'=>route('admin_users_wholesaler_approve')]) !!}
                                {!! Form::hidden('id',$user->id) !!}
                                <button type="submit" class="btn btn-success">Approve Wholesaler</button>
                            {!! Form::close() !!}
                        </div>
                    @else
                        <div class="form-group ">
                            {!! Form::open(['url'=>route('admin_users_wholesaler_reject')]) !!}
                            {!! Form::hidden('id',$user->id) !!}
                            <button type="submit" class="btn btn-danger">Block Wholesaler</button>
                            {!! Form::close() !!}
                        </div>
                    @endif
                @endif


            </div>

        </div>

        <div class="card-body panel-body px-0">

            <div class="row d-flex">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-3 col-4 pr-sm-3 pr-0">
                    <!-- Profile Image -->
                    <div class="box box-primary m-0 users-log-wrapper_col" style="min-height: auto">
                        <div class="box-body box-profile">
                        </div>
                        <!-- /.box-body -->
                        <ul class=" nav nav-pills flex-column nav-stacked admin-profile-left">
                            <li class="nav-item w-100">
                                <a class="nav-link rounded-0 active text-truncate" href="#users_account" data-toggle="tab">Account</a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link rounded-0 text-truncate" href="#users_logs" data-toggle="tab">Logs</a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link rounded-0 text-truncate" href="#users_favourites" data-toggle="tab">Favourites</a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link rounded-0 text-truncate" href="#users_orders" data-toggle="tab">Orders</a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link rounded-0 text-truncate" href="#users_address" data-toggle="tab">Address</a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link rounded-0 text-truncate" href="#users_tickets" data-toggle="tab">Tickets</a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link rounded-0 text-truncate" href="#users_referrals" data-toggle="tab">Referrals</a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link rounded-0 text-truncate" href="#users_offer" data-toggle="tab">Special Offer</a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link rounded-0 text-truncate" href="#users_special-note" data-toggle="tab">Special
                                    note</a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-9 col-8">
                    {{--<ul class="nav nav-tabs">--}}
                    {{--<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>--}}
                    {{--<li><a href="#passwordDiv" data-toggle="tab">Password</a></li>--}}
                    {{--</ul>--}}
                    <div class="tab-content users-log-wrapper_tab-content">
                        <div id="users_account" class="tab-pane fade in active show">
                            {!! Form::model($user,['class'=>'']) !!}
                            {!! Form::hidden('id') !!}
                            <div class="card panel panel-default mb-0">
                                <div class="card-header">
                                    Account

                                    <button type="submit" class="btn btn-success float-right">Update</button>

                                </div>
                                <div class="card-body panel-body">
                                    <!-- The timeline -->


                                    <div class="form-group row">
                                        <label for="inputName" class="col-xl-2 col-lg-3 control-label">First Name</label>

                                        <div class="col-xl-10 col-lg-9">
                                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-xl-2 col-lg-3 control-label">Last Name</label>
                                        <div class="col-xl-10 col-lg-9">
                                            {!! Form::text('last_name',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-xl-2 col-lg-3 control-label">E-mail </label>

                                        <div class="col-xl-10 col-lg-9">
                                            {!! Form::text('email',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-xl-2 col-lg-3 control-label">Phone</label>
                                        <div class="col-xl-10 col-lg-9">
                                            {!! Form::text('phone',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-xl-2 col-lg-3 control-label">Country</label>
                                        <div class="col-xl-10 col-lg-9">
                                            {!! Form::select('country',$countries,null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-xl-2 col-lg-3 control-label">Gender</label>
                                        <div class="col-xl-10 col-lg-9">
                                            {!! Form::select('gender',['male'=>'Male','female'=>'Female'],null,['class'=>'form-control']) !!}

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-xl-2 col-lg-3 control-label">Status</label>
                                        <div class="col-xl-10 col-lg-9">
                                            @if($user->email_verified_at == null)
                                                {!! Form::hidden('status',null) !!}
                                                <div class="form-control">Email Not Verified</div>
                                            @else
                                               {!! Form::select('status',[0 => 'Suspend',1=>'Active'],null,['class' => 'form-control']) !!}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-xl-2 col-lg-3 control-label">Password</label>
                                        <div class="col-xl-10 col-lg-9">
                                            {!! Form::open(['url'=>route('post_admin_users_reset_pass')]) !!}
                                            {!! Form::hidden('email',$user->email) !!}
                                            <button type="submit" class="btn btn-warning">Send reset password email</button>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}

                            @if($user->verification_type && $user->verification_image)
                                {!! Form::open() !!}
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <div class="row">
                                            <label for="inputExperience" class="col-sm-4 control-label">Uploaded
                                                Doc
                                                : {{ strtoupper(str_replace('_'," ",$user->verification_type)) }}</label>
                                            <div class="col-sm-8">
                                                <img class="img" src="{{ $user->verification_image }}"
                                                     width="100"/>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn btn-info">View</button>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        @if(! $user->status)
                                            <div>
                                                <button type="button" class="btn btn-success approve-verify">
                                                    Approve
                                                </button>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-danger reject-verify">
                                                    Reject
                                                </button>
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
                        <div id="users_logs" class="tab-pane fade">
                            <div class="card-header">
Logs
                            </div>
                            <div class="card panel panel-default mb-0">
                                <div class="card-body panel-body">
                                    <table id="users-table" class="table table-style table-bordered" cellspacing="0"
                                           width="100%">
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
                            <div class="card panel panel-default mb-0">
                                <div class="card-header">Favourites</div>
                                <div class="card-body panel-body">

                                </div>
                            </div>
                        </div>
                        <div id="users_orders" class="tab-pane fade">
                            <div class="card panel panel-default mb-0">
                                <div class="card-header">Orders</div>
                                <div class="card-body panel-body">
                                    <table id="orders-table" class="table table-style table-bordered" cellspacing="0"
                                           width="100%">
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
                            <div class="card panel panel-default mb-0">
                                <div class="card-header">
                                    Address
                                </div>
                                <div class="card-body panel-body">
                                        <ul class="nav nav-pills nav-fill" role="tablist">
                                            <li class="mr-1">
                                                <a class="btn btn-info nav-link nav-link--new-address active"
                                                   id="billingAddress-tab"
                                                   data-toggle="tab" href="#billingAddress" role="tab"
                                                   aria-controls="billingAddress"
                                                   aria-selected="true" aria-expanded="true">Billing Address</a>
                                            </li>
                                            <li>
                                                <a class="btn btn-info nav-link nav-link--new-address"
                                                   id="addressBook-tab"
                                                   data-toggle="tab"
                                                   href="#addressBook" role="tab" aria-controls="addressBook">Address
                                                    Book</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active in mt-4" id="billingAddress" role="tabpanel"
                                                 aria-labelledby="billingAddress-tab">
                                                {!! Form::model($billing_address,['class'=>'form-horizontal','url' => route('admin_users_address')]) !!}
                                                {!! Form::hidden('user_id',$user->id) !!}
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label for="text"
                                                               class="control-label col-lg-2 col-form-label">Name</label>
                                                        <div class="col-lg-10">
                                                            <div class="row">
                                                                <div class="col-sm-6 mb-sm-0 mb-1">
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
                                                        <label for="text"
                                                               class="control-label col-lg-2 col-form-label">Company
                                                            name</label>
                                                        <div class="col-lg-10">
                                                            {!! Form::text('company',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label for="text"
                                                               class="control-label col-lg-2 col-form-label">1st
                                                            Line
                                                            address</label>
                                                        <div class="col-lg-10">
                                                            {!! Form::text('first_line_address',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label for="text"
                                                               class="control-label col-lg-2 col-form-label">2nd
                                                            line
                                                            address</label>
                                                        <div class="col-lg-10">
                                                            {!! Form::text('second_line_address',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label for="text"
                                                               class="control-label col-lg-2 col-form-label">Country</label>
                                                        <div class="col-lg-10">
                                                            {!! Form::select('country',['' => 'SELECT'] + $countries,null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <label for="text"
                                                               class="control-label col-lg-2 col-form-label">Regions</label>
                                                        <div class="col-lg-10">
                                                            {!! Form::text('region',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <label for="text"
                                                               class="control-label col-lg-2 col-form-label">City</label>
                                                        <div class="col-lg-10">
                                                            {!! Form::text('city',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label for="text"
                                                               class="control-label col-lg-2 col-form-label">Post
                                                            Code</label>
                                                        <div class="col-lg-10">
                                                            {!! Form::text('post_code',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                {!! Form::hidden('type','billing_address') !!}
                                                {!! Form::hidden('id') !!}
                                                <div class="form-group row">
                                                    <div class="">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                            <div class="tab-pane fade" id="addressBook" role="tabpanel"
                                                 aria-labelledby="addressBook-tab">
                                                            <div class="mt-3">
                                                                <div class="form-group row mb-5">
                                                                    <div class="col-lg-5">
                                                                        <h5>
                                                                            <label for="selectAddress"
                                                                                   class="control-label text-muted">Select
                                                                                your address</label>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-lg-7 d-flex flex-nowrap">
                                                                        {!! Form::select('address_book',$address,($default_shipping)?$default_shipping->id:null,['class' => 'form-control edit-address']) !!}
                                                                        <button type="button"
                                                                                class="nav-link nav-link--new-address btn btn-info btn-sm address-book-new flex--none">
                                                                            + Add New
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="selected-form">
                                                                        @include("frontend.my_account._partials.new_address",['address_book'=>$default_shipping,'default' => true])
                                                                    </div>
                                                                    {{--<button type="submit" class="btn btn-primary edit-address">Edit</button>--}}
                                                                    <button type="button"
                                                                            class="btn btn-danger edit-address mt-2">Delete
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        {{--Inner Tab Content--}}
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div id="users_tickets" class="tab-pane fade">
                            <div class="card panel panel-default mb-0">
                                <div class="card-header">
                                    Tickets
                                </div>
                                <div class="card-body panel-body">

                                </div>
                            </div>
                        </div>
                        <div id="users_referrals" class="tab-pane fade">
                            <div class="card panel panel-default mb-0">
                                <div class="card-header">Referrals</div>
                                <div class="card-body panel-body">

                                </div>
                            </div>
                        </div>
                        <div id="users_offer" class="tab-pane fade">
                            <div class="card panel panel-default mb-0">
                                <div class="card-header">Special Offer</div>
                                <div class="card-body panel-body">

                                </div>
                            </div>
                        </div>
                        <div id="users_special-note" class="tab-pane fade">
                            <div class="card panel panel-default mb-0">
                                <div class="card-header">Special Note</div>
                                <div class="card-body panel-body ">
                                    <div class="special-note-wall-box">
                                        @include('admin.users._partials.user_notes')
                                    </div>

                                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#specialAddNoteModal">
                                        <i class="fa fa-plus mr-10"></i>Add note
                                    </button>
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
    <!-- Modal -->
    <div class="modal fade" id="specialAddNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Add note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include("admin.users._partials.new_note")
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-note">Save changes</button>
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
            color: red;
        }
    </style>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(function () {
            $("body").on('click', '.save-note', function () {
                let form = $("#specialAddNoteModal form");
                AjaxCall(
                    "{{ route('admin_notes_form_save') }}",
                    form.serialize(),
                    function (res) {
                        if(!res.error){
                            $(".special-note-wall-box").html(res.html);
                            document.getElementById('noteForm').reset();
                            $("#specialAddNoteModal").modal('hide');
                        }
                    }
                );
            });

            $("body").on('click', '.reject-verify', function () {
                var user_id = $("#userID").val()
                AjaxCall(
                    "/admin/users/reject-verify",
                    {user_id: user_id},
                    function (res) {
                        window.location.reload();
                    }
                );
            });

            $("body").on('click', '.approve-verify', function () {
                var user_id = $("#userID").val()
                AjaxCall(
                    "/admin/users/approve-verify",
                    {user_id: user_id},
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
                    form + "&user_id=" + user_id,
                    res => {
                        if (
                            !res.error
                        ) {
                            window.location.reload();
                        }
                    },
                    error => {
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
                    {user_id: user_id},
                    res => {
                        if (
                            !res.error
                        ) {
                            $(".address-form").html(res.html);
                            $("#geo_country_book").select2();
                            $("#newAddressModal").modal();
                        }
                    }
                )
                ;
            });
            $("#geo_country_book").select2();
            $("body").on('change', '.edit-address', function () {
                var id = $(this).val();
                var user_id = $("#userID").val()
                AjaxCall(
                    "/admin/users/address-book-form",
                    {id: id, user_id: user_id},
                    res => {
                        if (
                            !res.error
                        ) {
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
                        ) {
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
                ajax: "{!! route('datatable_user_activity',$user->id) !!}",
                dom: 'Bflrtip',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                "scrollX": true,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'url', name: 'url'},
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
                order: [[0, 'desc']]
            });

            $('#orders-table').DataTable({
                ajax: "{!! route('datatable_user_orders',$user->id) !!}",
                dom: 'Bflrtip',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                "scrollX": true,
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
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
                order: [[0, 'desc']]
            });
        });

    </script>
@stop
