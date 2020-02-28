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
            <div class="profile-sidebar profile-sidebar--inner-pages d-flex flex-column align-items-center">
                @include('frontend.my_account._partials.left_bar',['active'=>'my_account_tickets'])
                <div class="mt-auto">
                    {!! Form::open(['url'=>route('logout')]) !!}
                    <div class="text-center">
                        <button type="submit" class="profile-sidebar_logout-btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase text-white pointer rounded-0">{!! __('logout') !!}</button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>

            {{--@include('frontend._partials.left_bar')--}}
    <div class="profile-inner-pg-right-cnt">
        <div class="profile-inner-pg-right-cnt_inner h-100">
           <div class="row">
               <div class="col-lg-9">
                   <div class="mb-4">
                       <a class="btn ntfs-btn rounded-0" href="{!! route('my_account_tickets_new') !!}">{!! __('open_ticket') !!}</a>
                   </div>
                   <div class="table-responsive">
                       <table class="table table-ntfs table-bordered table-striped order-table">
                           <thead>
                           <tr>
                               <th class="text-capitalize">{!! __('ticket_id') !!}</th>
                               <th class="text-capitalize">{!! __('subject') !!}</th>
                               <th class="text-capitalize">{!! __('submitted') !!}</th>
                               <th class="text-capitalize">{!! __('updated_on') !!}</th>
                               <th class="text-capitalize">{!! __('status') !!}</th>
                               <th class="text-capitalize">{!! __('action') !!}</th>
                           </tr>
                           </thead>
                           <tbody>
                           @if(count($tickets))
                               @foreach($tickets as $ticket)
                                   <tr>
                                       <td>#{{ $ticket->id }}</td>
                                       <td>#{{ $ticket->subject }}</td>
                                       <td>{!! BBgetDateFormat($ticket->created_at) . ' ' . BBgetTimeFormat($ticket->created_at); !!}</td>
                                       <td>{!! BBgetDateFormat($ticket->updated_at) . ' ' . BBgetTimeFormat($ticket->updated_at); !!}</td>
                                       <td>
                                <span style="background: {{ ($ticket->status->color)??'cornflowerblue' }}"
                                      class="btn order-table_btn order-table_btn--status rounded-0">{!! $ticket->status->name !!} </span>
                                       </td>
                                       <td>
                                           <div class="mb-2">
                                               <a href="{!! route('my_account_tickets_view',$ticket->id) !!}"
                                                  class="btn ntfs-btn order-table_btn rounded-0 text-capitalize">{!! __('view') !!}</a>
                                           </div>
                                       </td>
                                   </tr>
                               @endforeach
                           @else
                               <tr>
                                   <td colspan="5">{!! __('no_tickets') !!}</td>
                               </tr>
                           @endif
                           </tbody>
                       </table>
                   </div>
                   <div class="col-md-12 my-4">
                       {!! $tickets->links('vendor.pagination.default') !!}
                   </div>
               </div>
           </div>

        </div>
    </div>
            {{--@include('frontend.my_account._partials.verify_bar.blade_old.php')--}}

        </div>
    </main>
@stop
