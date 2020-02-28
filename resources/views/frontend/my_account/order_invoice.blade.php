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
                    <div class="row flex-lg-row flex-column-reverse">
                        <div class="col-lg-9">
                            <div class="table-responsive">
                                <table class="table table-bordered table--order-dtls">
                                    <thead>
                                    <tr>
                                        <td class="text-left">Product</td>
                                        <td class="text-left">Items</td>
                                        <td class="text-right">Quantity</td>
                                        <td class="text-right">Unit Price</td>
                                        <td class="text-right">Total</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->items()->where("is_refunded",false)->get() as $item)
                                        <tr>
                                            <td class="text-left">
                                                <a class="font-20 text-tert-clr main-transition"
                                                   href="">{!! $item->name !!}</a>
                                            </td>
                                            <td class="text-left">
                                                @if(! $order->type)
                                                @php
                                                    $options=$item->options;
                                                        $lastElement = end($options);
                                                @endphp

                                                <b>
                                                    @foreach($options['options'] as $key=>$option)
                                                        <div class="row">
                                                            @if(count($option['options']))
                                                                <div class="col-md-8">
                                                                    @foreach($option['options'] as $op)
                                                                        <p>
                                                                            {{ @$op['variation']['item']['short_name'] }}
                                                                        </p>
                                                                    @endforeach
                                                                </div>
                                                                <div class="col-md-4">
                                                                    {{ convert_price($option['price'],$currency) }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </b>
                                                <p>
                                                    <b>
                                                        @foreach($options['extras'] as $key=>$option)
                                                            <div class="col-md-12">
                                                                <h3>Extras</h3>
                                                            </div>
                                                            <div class="row">
                                                                @if(count($option['options']))
                                                                    <div class="col-md-8">
                                                @foreach($option['options'] as $op)
                                                    <p>
                                                        {{ $op['variation']['item']['short_name'] }}
                                                    </p>
                                    @endforeach

                            </div>
                            <div class="col-md-4">
                                {{ convert_price($option['price'],$currency) }}
                            </div>
                            @endif
                        </div>
                        @endforeach
                        </b>
                        </p>
                        @endif
                        </td>
                        <td class="text-right">{!! $item->qty !!}</td>
                        <td class="text-right">{!! convert_price($item->amount/$item->qty,$currency) !!}</td>
                        <td class="text-right">{!! convert_price($item->amount,$currency) !!}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">Sub-Total</td>
                            <td class="text-right">{!! convert_price($order->amount-$order->shipping_price,$currency) !!} </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Shipping ({!! $order->shipping_method !!})</td>
                            <td class="text-right">{!! convert_price($order->shipping_price,$currency) !!}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Total</td>
                            <td class="text-right">{!! convert_price($order->amount,$currency) !!}</td>
                        </tr>
                        </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        {{--@include('frontend.my_account._partials.verify_bar.blade_old.php')--}}

        </div>
    </main>
@stop
