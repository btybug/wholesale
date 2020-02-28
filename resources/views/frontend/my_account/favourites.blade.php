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
                @include('frontend.my_account._partials.left_bar',['active'=>'my_account_favourites'])
                <div class="mt-auto">
                    {!! Form::open(['url'=>route('logout')]) !!}
                    <div class="text-center">
                        <button type="submit" class="profile-sidebar_logout-btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase text-white pointer">Logout</button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
    <div class="profile-inner-pg-right-cnt">
        <div class="profile-inner-pg-right-cnt_inner h-100">
           <div class="row flex-lg-row flex-column-reverse">
               <div class="col-lg-9">
                   @include("frontend.products._partials.products_render",['products' => $user->favorites])
               </div>
               <div class="col-lg-3 mb-xl-0 mb-4">
               </div>
           </div>
        </div>
    </div>
            {{--@include('frontend.my_account._partials.verify_bar.blade.php')--}}

        </div>
    </main>
@stop
@section('js')
    <script>
        $("body").on('click', '.product-card_like-icon', function () {
            let url;
            let is_active = $(this).hasClass("active");

            url = (is_active) ? "/my-account/delete_favourites" : "/my-account/add_favourites";

            let variation_id = $(this).attr("data-id");
            let _this = $(this);
            console.log(`${variation_id}  ---->  `, _this);
            if (variation_id) {
                $.ajax({
                    type: "post",
                    url: url,
                    cache: false,
                    data: {
                        id: variation_id
                    },
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        console.log(data);
                        if (!data.error) {
                            _this.toggleClass("active")
                        } else {
                            alert("error");
                        }
                    }
                })
            }
        });
    </script>
@stop
