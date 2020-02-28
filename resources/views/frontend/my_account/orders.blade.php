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

            {{--acoount sidebar--}}
            <div class="profile-sidebar profile-sidebar--inner-pages d-flex flex-column align-items-center">
                @include('frontend.my_account._partials.left_bar',['active'=>'my_account_orders'])
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
                    <div class="row flex-lg-row flex-column-reverse">
                        <div class="col-lg-9">
                            <div class="table-responsive">
                                <table class="table-ntfs table table-bordered table-striped order-table">
                                    <thead>
                                    <tr>
                                        <th class="text-capitalize">{!! __('order_number') !!}</th>
                                        <th class="text-capitalize">{!! __('order_date') !!}</th>
                                        <th class="text-capitalize">{!! __('number_of_products') !!}</th>
                                        <th class="text-capitalize">{!! __('total_amount') !!}</th>
                                        <th class="text-capitalize">{!! __('type') !!}</th>
                                        <th class="text-capitalize">{!! __('status') !!}</th>
                                        <th class="text-capitalize">{!! __('action') !!}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user->orders as $order)
                                        <tr>
                                            <td>#{{ $order->order_number }}</td>
                                            <td>{!! BBgetDateFormat($order->created_at).' '.BBgetTimeFormat($order->created_at)  !!}</td>
                                            <td>{!! $order->items()->where("is_refunded",false)->count() !!}</td>
                                            <td>{!! convert_price($order->amount,get_currency()) !!}</td>
                                            <td>{!! ($order->type) ? 'Wholesaler' : 'User' !!}</td>
                                            <td>
                                                @if($order->history->first()['status'] && $order->history->first()['status']['name'])
                                                    <button type="button"
                                                            class="btn order-table_btn order-table_btn--status text-sec-clr rounded-0"  style="background: {!! $order->history->first()['status']['color'] !!}">
                                                        {!! $order->history->first()->status->name !!}
                                                    </button>
                                                @else
                                                    {!! __('no_status') !!}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{!! route('my_account_order_invoice',$order->id) !!}"
                                                   class="btn ntfs-btn text-sec-clr order-table_btn mr-2 rounded-0">{!! __('view') !!}</a>
                                                <a href="{!! route('my_account_order_reviews',$order->id) !!}"
                                                   class="btn ntfs-btn text-sec-clr order-table_btn mr-2 rounded-0">{!! __('review') !!}</a>

                                                <button type="button" class="btn btn-transp order-table_btn rounded-0">{!! __('purchase') !!}</button>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{--@include('frontend.my_account._partials.verify_bar.blade_old.php')--}}

        </div>
    </main>
@stop
