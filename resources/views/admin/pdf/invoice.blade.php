<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! env('SITE_NAME','ADMIN') !!}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{asset('public/css/invoice.css?v='.rand(111,999))}}">
    <style>
        @font-face {
            font-family: 'Oswald-Regular';
            src: {{ url('/public/fonts/Oswald-Regular.eot') }};
            src: {{ url('/public/fonts/Oswald-Regular.eot?#iefix') }} format('embedded-opentype'),
            {{ url('/public/fonts/Oswald-Regular.woff2') }} format('woff2'),
            {{ url('/public/fonts/Oswald-Regular.woff') }} format('woff'),
            {{ url('/public/fonts/Oswald-Regular.ttf') }} format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Roboto-Regular';
            src: {{ url('/public/fonts/Roboto-Regular.eot') }};
            src: {{ url('/public/fonts/Roboto-Regular.eot?#iefix') }} format('embedded-opentype'),
        {{ url('/public/fonts/Roboto-Regular.woff2')  }} format('woff2'),
            {{url('/public/fonts/Roboto-Regular.woff')  }} format('woff'),
            {{ url('/public/fonts/Roboto-Regular.ttf')  }} format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Roboto-Medium';
            src: {{url('/public/fonts/Roboto-Medium.eot')}};
            src: {{url('/public/fonts/Roboto-Medium.eot?#iefix')}} format('embedded-opentype'),
            {{url('/public/fonts/Roboto-Medium.woff2')}} format('woff2'),
            {{url('/public/fonts/Roboto-Medium.woff')}} format('woff'),
            {{url('/public/fonts/Roboto-Medium.ttf')}} format('truetype');
            font-weight: 500;
            font-style: normal;
        }
    </style>
</head>
<body>
<div class="invoice__wrapper">

    <div class="invoice__wrapper-header"></div>

    <div class="invoice__wrapper-main-content clearfix">
        <div class="invoice__content-logo clearfix">
                                        <span class="icon">
                   <img src="{{ url(get_site_logo()) }}" alt="{{ get_site_name() }}">
                </span>
        </div>
        <div
            class="invoice__content-info">
            <div class="invoice__content-info-left">
                <p class="title">To:</p>
                <p class="bold-title">{{ $order->user->name. " ".$order->user->last_name }}</p>
                <p>{{ $order->shippingAddress->company }}</p>
                <p>{!! $order->shippingAddress->first_line_address ." ".$order->shippingAddress->second_line_address  !!}</p>
                <p>{!! $order->shippingAddress->post_code !!}</p>
                <p>{!! $order->shippingAddress->city !!}, {!! $order->shippingAddress->country !!}</p>
            </div>
            <div class="invoice__content-info-right">
                <p>{{ $settings->first_address. ' '.$settings->second_address }}</p>
                <p>{{ $settings->city .',' }} {{ $settings->post_code }}</p>
                <p>{{ $settings->country }}</p>

                <p>Company number: 47655666</p>
                <p>VAT number: 978886765766</p>
            </div>
        </div>
        <h1 class="main-title">INVOICE</h1>
        <div class="invoice__table-wrap">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" class="product-th">Product</th>
                        <th scope="col">Description</th>
                        <th scope="col" class="text-center">Quantity</th>
                        <th scope="col" class="text-center">VAT</th>
                        <th scope="col" class="text-center">Total</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($order->items()->where('is_refunded',false)->get() as $item)
                        <tr>
                            <td class="product-td">
                                {{ $item->name }}
                            </td>
                            <td class="desc-td">
                                @if($order->type)
                                <div class="single-item">
                                    <span class="single-item-name">
                                         {{ $item->name }}
                                    </span>
                                    <span class="single-item-price">{!! convert_price($item->price,$order->currency) !!}</span>
                                </div>
                                @else
                                    @if(count($item->options['options']))
                                    @foreach($item->options['options'] as $option)
                                        @foreach($option['options'] as $op)

                                            <div class="single-item">
                                                <span class="single-item-name">
                                                    {{ $op['title'] }}
                                                    @if(isset($op['variation']['item']))
                                                        {{ " - " .$op['variation']['item']['short_name'] }}
                                                    @endif

                                                    @if($op['discount'] && $op['variation']['discount_type'] == 'fixed')
                                                        ({{ "Pack of ".$op['discount']['qty'] }})
                                                    @endif
                                                </span>

                                                <span class="single-item-price">{!! convert_price($option['price'],$order->currency) !!}</span>
                                            </div>
                                        @endforeach
                                    @endforeach
                                    @php
                                    $extraPrice = 0;
                                    @endphp
                                    @foreach($item->options['extras'] as $extra)
                                        @foreach($extra['options'] as $ext)
                                                @php
                                                    if($ext['discount']){
                                                        if($ext['variation']['discount_type'] =='fixed'){
                                                            $price = $ext['discount']['price'];
                                                        }else{
                                                            $price = $ext['discount']['price']* $ext['qty'];
                                                        }
                                                    }else{
                                                        $price = $ext['variation']['price'] * $ext['qty'];
                                                    }
                                                @endphp
                                                <div class="single-item">
                                                    <span class="single-item-name">
                                                        {{ $ext['title'] }}
                                                        @if(isset($ext['variation']['item']))
                                                            {{ " - " .$ext['variation']['item']['short_name'] }}
                                                        @endif

                                                        @if($ext['discount'] && $ext['variation']['discount_type'] == 'fixed')
                                                            ({{ "Pack of ".$ext['discount']['qty'] }})
                                                        @endif
                                                    </span>
                                                    @php
                                                        $extraPrice +=$price;
                                                    @endphp
                                                    <span class="single-item-price">{!! convert_price($price,$order->currency) !!}</span>
                                                </div>
                                        @endforeach
                                    @endforeach
                                @endif
                                @endif
                            </td>
                            <td class="qty-td text-center">
                                <span>x {{ $item->qty }}</span>
                            </td>
                            <td class="vat-td text-center">
                                <span> {{ convert_price(0,$order->currency) }}</span>
                            </td>
                            <td class="total-td text-center">
                                @if($order->type)
                                    <span class="price">  {!! convert_price($item->amount,$order->currency) !!}</span>
                                @else
                                     <span class="price">  {!! convert_price($item->price+$extraPrice,$order->currency) !!}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="invoice__content-paid-price">
            <div class="invoice__content-paid">
                <img src="{{ url('/public/img/temp/paid-invoice.png') }}" alt="paid">
            </div>
            <div class="invoice__content-price">
                <div class="invoice__content-price-item clearfix">
                    <span class="name">Sub Total</span>
                    <span class="price">{{ convert_price($order->items()->where('is_refunded',false)->sum('amount'),$order->currency) }}</span>
                </div>
                <div class="invoice__content-price-item clearfix">
                    <span class="name">Total VAT</span>
                    <span class="price">  {{ convert_price(0,$order->currency) }}</span>
                </div>
                <div class="invoice__content-price-item clearfix">
                    <span class="name">Shipping</span>
                    <span class="price"> {{ convert_price($order->shipping_price,$order->currency) }}
                    </span>
                </div>
                <div class="invoice__content-price-item total-amount-wall clearfix">
                    <span class="name total-name">Total Amount</span>
                    <span class="price total-price">
                        <span>{{ convert_price($order->amount,$order->currency) }}
                        </span>
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="invoice__wrapper-footer clearfix">
        <ul class="left-list">
            <li>{{ $settings->first_address }}</li>
            <li>{{ $settings->second_address }}</li>
            <li> {{ $settings->post_code }}</li>
            <li>{{ $settings->city .', ' }}{{ $settings->country }}</li>

            {{--<li>The Vapors Hub Ltd, GM</li>--}}
            {{--<li>Wilkinson Way, Blackburn</li>--}}
            {{--<li>Lancashire, BB1 2EH</li>--}}
            {{--<li>London, UK</li>--}}
        </ul>
        <ul class="right-list">
            <li>TheVaporsHub.com</li>
            <li> {{ $settings->email }}</li>
            <li>Tel: {{ $settings->phone }}</li>
        </ul>
    </div>
</div>

</body>
</html>



