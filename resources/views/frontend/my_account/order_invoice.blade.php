@extends('layouts.frontend')
@section('content')
    <main class="main-content position-relative">
        <div class="d-flex">
            {{--acoount sidebar--}}
            <div class="profile-sidebar profile-sidebar--inner-pages d-flex flex-column align-items-center">
                @include('frontend.my_account._partials.left_bar')
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
                   <table class="table table-bordered table--order-dtls">
                       <thead>
                       <tr>
                           <td class="text-left">Product</td>
                           <td class="text-left">SKU</td>
                           <td class="text-right">Quantity</td>
                           <td class="text-right">Unit Price</td>
                           <td class="text-right">Total</td>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($order->items as $item)
                           <tr>
                               <td class="text-left">
                                   <a class="font-20 text-tert-clr main-transition" href="">{!! $item->name !!}</a>
                               </td>
                               <td class="text-left">
                                   {!! $item->sku !!}<br>
                                   @php
                                       $options=$item->options;
                                           $lastElement = end($options);
                                   @endphp
                                   <b>
                                       @foreach($options as $key=>$option)
                                           {!! $key !!}: {!! $option !!} @if($option!=$lastElement) , @endif
                                       @endforeach
                                   </b>

                               </td>
                               <td class="text-right">{!! $item->qty !!}</td>
                               <td class="text-right">$@convert($item->amount/$item->qty)</td>
                               <td class="text-right">$@convert($item->amount)</td>
                           </tr>
                       @endforeach
                       <tr>
                           <td colspan="4" class="text-right">Sub-Total</td>
                           <td class="text-right">$@convert($order->amount-$order->shipping_price)</td>
                       </tr>
                       <tr>
                           <td colspan="4" class="text-right">Shipping ({!! $order->shipping_method !!})</td>
                           <td class="text-right">$@convert($order->shipping_price)</td>
                       </tr>
                       <tr>
                           <td colspan="4" class="text-right">Total</td>
                           <td class="text-right">$@convert($order->amount)</td>
                       </tr>
                       </tbody>
                   </table>
               </div>

           </div>
        </div>
    </div>
            {{--@include('frontend.my_account._partials.verify_bar.blade_old.php')--}}

        </div>
    </main>
@stop