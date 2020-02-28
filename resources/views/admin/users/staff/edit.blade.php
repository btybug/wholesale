@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default users-log-wrapper bg-transparent border-0">
        <div class="card-header panel-heading d-flex justify-content-between">
            <h2 class="m-0">{{ ($user) ? $user->name . ' ' . $user->last_name : "Admin Profile" }} </h2>
{{--            <nav aria-label="breadcrumb m-0 d-inline-flex">--}}
{{--                <ol class="breadcrumb mb-0 bg-transparent">--}}
{{--                    <li class="breadcrumb-item"><a href="http://demo0.laravelcommerce.com/admin/dashboard/this_month"><i class="fa fa-dashboard"></i>--}}
{{--                            Dashboard</a></li>--}}
{{--                    <li class="breadcrumb-item active" aria-current="page">Admin Profile</li>--}}
{{--                </ol>--}}
{{--            </nav>--}}
            <div class="d-flex flex-wrap">
                <div class="form-group mr-1">
                    <div class="">
                        <button type="button" class="btn btn-success update-staff">Update</button>
                    </div>
                </div>
                <div class="form-group text-right">
                    {!! Form::open(['url'=>route('post_admin_users_reset_pass')]) !!}
                    {!! Form::hidden('email',$user->email) !!}
                    <button type="submit" class="btn btn-warning">Send reset password email</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="card-body panel-body px-0">
            <div class="row">
                <div class="col-xl-3 col-sm-4">
                    <!-- Profile Image -->
                    <div class="box box-primary mar-0">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle"
                                 src="{{ user_avatar($user->id) }}"
                                 alt="{!! $user->name.' '.$user->last_name !!}">
                                {!! Form::hidden('user_id',$user->id,['id' => 'userID']) !!}
                            <h3 class="profile-username text-center">{!! $user->name.' '.$user->last_name !!}</h3>

                            <p class="text-muted text-center">{!! ($user->role)?$user->role->title:'User' !!}</p>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <ul class=" nav nav-pills flex-column nav-stacked admin-profile-left tabs-colors">
                        <li class="nav-item">
                            <a class="nav-link active" href="#users_profile" data-toggle="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#users_logs" data-toggle="tab">Logs</a>
                        </li>
                    </ul>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-9 col-sm-8">
                        {{--<ul class="nav nav-tabs">--}}
                        {{--<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>--}}
                        {{--<li><a href="#passwordDiv" data-toggle="tab">Password</a></li>--}}
                        {{--</ul>--}}
                        <div class="tab-content">
                            <div id="users_profile" class="tab-pane fade in active show">
                                <div class="card panel panel-default">
                                    <div class="card-header panel-heading">
                                        <h3 class="m-0">Profile</h3>
                                    </div>
                                    <div class="card-body panel-body">
                                        <ul class="nav nav-tabs mb-2" id="myTabProfile" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="tabUserProfile-tab" data-toggle="tab" href="#tabUserProfile" role="tab" aria-controls="tabUserProfile" aria-selected="true">Profile</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tabUserProfileChangePassword-tab" data-toggle="tab" href="#tabUserProfileChangePassword" role="tab" aria-controls="tabUserProfileChangePassword" aria-selected="false">Change Password</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContentProfile">
                                            <div class="tab-pane fade show active" id="tabUserProfile" role="tabpanel" aria-labelledby="tabUserProfile-tab">
                                                <!-- The timeline -->
                                                {!! Form::model($user,['class'=>'staff-form']) !!}
                                                {!! Form::hidden('id') !!}

                                                <div class="form-group row">
                                                    <label for="inputName" class="col-lg-2 control-label">First Name</label>

                                                    <div class="col-lg-10">
                                                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-lg-2 control-label">Last Name</label>
                                                    <div class="col-lg-10">
                                                        {!! Form::text('last_name',null,['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-lg-2 control-label">E-mail </label>

                                                    <div class="col-lg-10">
                                                        {!! Form::text('email',null,['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-lg-2 control-label">Phone</label>
                                                    <div class="col-lg-10">
                                                        {!! Form::text('phone',null,['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-lg-2 control-label">Country</label>
                                                    <div class="col-lg-10">
                                                        {!! Form::select('country',$countries,null,['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-lg-2 control-label">Gender</label>
                                                    <div class="col-lg-10">
                                                        {!! Form::select('gender',['male'=>'Male','female'=>'Female'],null,['class'=>'form-control']) !!}

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-lg-2 control-label">Status</label>
                                                    <div class="col-lg-10">
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
                                                    <label for="inputExperience" class="col-lg-2 control-label">Membership</label>
                                                    <div class="col-lg-10">
                                                        {!! Form::select('role_id',[null=>'No Membership']+$roles,null,['class'=>'form-control']) !!}

                                                    </div>
                                                </div>


                                                {{--                                        <div class="form-group row">--}}
                                                {{--                                            <div class="col-lg-12 text-right">--}}
                                                {{--                                                <button type="submit" class="btn btn-success">Update</button>--}}
                                                {{--                                            </div>--}}
                                                {{--                                        </div>--}}
                                                {!! Form::close() !!}



                                                @if($user->verification_type && $user->verification_image)
                                                    {!! Form::open() !!}
                                                    <div class="row">
                                                        <div class="form-group col-lg-8">
                                                            <div class="row">
                                                                <label for="inputExperience" class="col-lg-4 control-label">Uploaded Doc : {{ strtoupper(str_replace('_'," ",$user->verification_type)) }}</label>
                                                                <div class="col-lg-8">
                                                                    <img class="img" src="{{ $user->verification_image }}" width="100"/>
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <button type="button" class="btn btn-info">View</button>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-4 ml-lg-auto">
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
                                            <div class="tab-pane fade" id="tabUserProfileChangePassword" role="tabpanel" aria-labelledby="tabUserProfileChangePassword-tab">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-8">
                                                        <div class="card">
                                                            <div class="card-header">Change Password with Current Password Validation</div>

                                                            <div class="card-body">
                                                                <form method="POST" action="{{ route('change.password') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                           value="{!! $user->id !!}">
                                                                    @foreach ($errors->all() as $error)
                                                                        <p class="text-danger">{{ $error }}</p>
                                                                    @endforeach

                                                                    <div class="form-group row">
                                                                        <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                                                                        <div class="col-md-6">
                                                                            <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                                                        <div class="col-md-6">
                                                                            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                                                                        <div class="col-md-6">
                                                                            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-primary">
                                                                                Update Password
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div id="users_logs" class="tab-pane fade">
                                <div class="card panel panel-default">
                                    <div class="card-header panel-heading">
                                        <h3 class="m-0">Logs</h3>
                                    </div>
                                    <div class="card-body panel-body">
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

            $('button.update-staff').on('click', function () {
                $('form.staff-form').submit();
            });
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
                dom: 'Bflrtip',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                "scrollX": true,
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
                    order: [ [0, 'desc'] ]
                });
        });

    </script>
@stop
