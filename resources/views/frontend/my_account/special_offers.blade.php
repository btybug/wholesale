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
            {{--@include('frontend._partials.left_bar')--}}

            {{--profile sidebar--}}
            <div class="profile-sidebar profile-sidebar--inner-pages d-flex flex-column align-items-center">
                @include('frontend.my_account._partials.left_bar')
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
                <div class="profile-inner-pg-right-cnt_inner h-100">
                    <div class="col-lg-9">
                        <div class="notification-actions-bar d-none">
                            <a href="javascript:void(0)" class="btn btn-transp delete-selected-notifications mr-3">{!! __('elete') !!}</a>
                            <a href="javascript:void(0)" class="btn btn-transp mark-us-read mr-3">{!! __('mark_us') !!} <span class="text-uppercase">Read</span></a>
                            <a href="javascript:void(0)" class="btn btn-transp mark-us-unread">{!! __('mark_us') !!}<span class="text-uppercase">Unread</span></a>
                        </div>
                        @foreach($coupons as $coupon)
                            <div class="col-ld-3 m-3">
                                {!! $coupon->renderVoucher() !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{--@include('frontend.my_account._partials.verify_bar.blade_old.php')--}}
        </div>
    </main>

    {{-- Modal --}}
@stop
