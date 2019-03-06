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
            {{--@include('frontend._partials.left_bar')--}}

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
                <div class="col-md-12">
                    <div class="form-horizontal float-right">

                        <div class="form-group row">
                            <label class="col-md-6 control-label" for="customer_number">Your customer number</label>
                            <div class="col-md-6">
                                <input readonly id="customer_number" value="{!! $user->customer_number !!}"  type="text"  class="form-control input-md">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-inner-pg-right-cnt_inner h-100">

                    <div class="col-md-9 clearfix">
                        <div class="col-md-6 float-left">
                            <h3>Referrals</h3>
                        </div>
                        <div class="col-md-6 float-right">
                            <div class="notification-actions-bar d-none">
                                <a href="javascript:void(0)"
                                   class="btn btn-danger delete-selected-notifications">Delete</a>
                                <a href="javascript:void(0)" class="btn btn-info mark-us-read">Mark us Read</a>
                                <a href="javascript:void(0)" class="btn btn-warning mark-us-unread">Mark us Unread</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Referred user</th>
                                <th scope="col">Active</th>
                                <th scope="col">Offers</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->referral_bonuses as $referral)
                                <tr>
                                    <td>{!! $referral->name.' '.$referral->name !!}</td>

                                    <td>{!! $referral->orders()->count()?'YES':'NO' !!}</td>
                                    <td>{!! (!$referral->pivot->status)? $referral->orders()->count()?'<a href="'.route('my_account_referrals_claim_bonus',$referral->pivot->id).'">claim offer</a>':'Pending':'Sorted' !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
@stop