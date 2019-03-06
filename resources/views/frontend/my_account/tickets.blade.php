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
            <div class="profile-sidebar profile-sidebar--inner-pages d-flex flex-column align-items-center">
                @include('frontend.my_account._partials.left_bar')
                <div class="mt-auto">
                    {!! Form::open(['url'=>route('logout')]) !!}
                    <div class="text-center">
                        <button type="submit" class="profile-sidebar_logout-btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase text-white pointer rounded-0">Logout</button>
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
                       <a class="btn ntfs-btn rounded-0" href="{!! route('my_account_tickets_new') !!}">Open ticket</a>
                   </div>
                   <table class="table table-ntfs table-bordered table-striped table-responsive-lg order-table">
                       <thead>
                       <tr>
                           <th class="text-capitalize">ticket ID</th>
                           <th class="text-capitalize">submited</th>
                           <th class="text-capitalize">updated on</th>
                           <th class="text-capitalize">status</th>
                           <th class="text-capitalize">action</th>
                       </tr>
                       </thead>
                       <tbody>
                       @if(count($tickets))
                           @foreach($tickets as $ticket)
                               <tr>
                                   <td>#{{ $ticket->id }}</td>
                                   <td>{!! BBgetDateFormat($ticket->created_at) . ' ' . BBgetTimeFormat($ticket->created_at); !!}</td>
                                   <td>{!! BBgetDateFormat($ticket->updated_at) . ' ' . BBgetTimeFormat($ticket->updated_at); !!}</td>
                                   <td>
                                <span style="background: {{ ($ticket->status->color)??'cornflowerblue' }}"
                                      class="btn order-table_btn order-table_btn--status rounded-0">{!! $ticket->status->name !!} </span>
                                   </td>
                                   <td>
                                       <div class="mb-2">
                                           <a href="{!! route('my_account_tickets_view',$ticket->id) !!}"
                                              class="btn ntfs-btn order-table_btn rounded-0">View</a>
                                       </div>
                                   </td>
                               </tr>
                           @endforeach
                       @else
                           <tr>
                               <td colspan="5">No Tickets</td>
                           </tr>
                       @endif
                       </tbody>
                   </table>
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