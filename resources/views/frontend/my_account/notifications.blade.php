@extends('layouts.frontend')
@section('content')
    <main class="main-content position-relative">
        <div class="my-account--selects">
            <div class="simple_select_wrapper">
                <select id="accounts--selects"
                        class="select-2 select-2--no-search main-select main-select-2arrows not-selected arrow-dark"
                        style="width: 100%">
                    <option value="{!! route('my_account') !!}">Account</option>
                    <option value="{!! route('messages') !!}">Notifications</option>
                    <option value="{!! route('my_account_favourites') !!}">Favorites</option>
                    <option value="{!! route('my_account_orders') !!}">Orders</option>
                    <option value="{!! route('my_account_address') !!}">Address</option>
                    <option value="{!! route('my_account_tickets') !!}">Tickets</option>
                    <option value="{!! route('my_account_referrals') !!}">Referals</option>
                    <option value="{!! route('my_account_special_offers') !!}">Special Offers</option>
                    <option value="">Address</option>
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
                @include('frontend.my_account._partials.left_bar')

                <div class="mt-auto">
                    {!! Form::open(['url'=>route('logout')]) !!}
                    <div class="text-center">
                        <button type="submit"
                                class="profile-sidebar_logout-btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase text-white pointer">
                            Logout
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>

            <div class="profile-inner-pg-right-cnt">
                <div class="profile-inner-pg-right-cnt_inner h-100">
                    <div class="col-md-9 clearfix">
                        <div class="col-md-6 float-left">
                            <h3>Notifications</h3>
                        </div>
                        <div class="col-md-6 float-right">
                            <div class="notification-actions-bar d-none">
                                <a href="javascript:void(0)"
                                   class="btn btn-danger delete-selected-notifications">Delete</a>
                                <a href="javascript:void(0)" class="btn btn-info mark-us-unread">Mark us Unread</a>
                                <a href="javascript:void(0)" class="btn btn-warning mark-us-read">Mark us Read</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <table class="table table-striped table-ntfs">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <input name="notifications-all" id="message-checkbox-all" type="checkbox">
                                </th>
                                <th scope="col">Date</th>
                                <th scope="col">Notification</th>
                                <th scope="col">Type</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody id="notification-list">
                            @include('frontend.my_account._partials.notification_list')
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            {{--@include('frontend.my_account._partials.verify_bar.blade_old.php')--}}
        </div>
    </main>

    {{-- Modal --}}
    <div class="modal fade notif-modal" id="notif_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="row no-gutters h-100">
                    <div class="col-md-4">
                        <div class="modal_left-img-holder h-100" style="background-image: url(/public/img/temp/modal-login-bg.jpg)"></div>
                    </div>
                    <div class="col-md-8">
                      <div class="modal-body h-100 d-flex flex-column">
                          <h2 class="text-uppercase text-main-clr font-20 modal-title mb-2">Message</h2>


                          <p class="text-gray-clr modal-body-info">  </p>

                          <div class="text-right mt-auto">
                              <button type="button" class="ntfs-btn btn rounded-0 font-14" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                    </div>
                </div>





            </div>
        </div>
    </div>

    {{--<div class="modal fade" id="notif_modal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">--}}
        {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="row no-gutters modal-content_inner">--}}
                    {{--<div class="col-md-4 col-sm-2">--}}
                        {{--<div class="modal_left-img-holder h-100" style="background-image: url(/public/img/temp/modal-login-bg.jpg)"></div>--}}
                    {{--</div>--}}

                    {{--<div class="col-md-8 col-sm-10">--}}
                        {{--<div class="modal-body">--}}
                            {{--<h2 class="text-uppercase text-main-clr font-20 modal-title">Message</h2>--}}
                            {{--<p class="font-13 text-gray-clr modal-body-info">  </p>--}}
                        {{--</div>--}}
                        {{--<div class="modal-footer">--}}
                            {{--<button type="button" class="ntfs-btn btn btn-info rounded-0" data-dismiss="modal">Close</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@stop

@section("js")
    <script src={{asset("public/js/my-account/notifications.js")}}></script>
@stop