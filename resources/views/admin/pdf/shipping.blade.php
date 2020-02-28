<h3 class="font-sec-reg font-18 item-title">Shipping
    Address</h3>
<div class="d-inline-block text-left">
    <p class="font-main-light font-13 text-wrap">{!! $order->user->name ." " .$order->user->last_name !!}</p>
    <p class="font-main-light font-13 text-wrap">{{ $order->shippingAddress->company }}</p>
    <p class="font-main-light font-13 text-wrap">
        {!! $order->shippingAddress->first_line_address ." ".$order->shippingAddress->second_line_address  !!}</p>
    <p class="font-main-light font-13 text-wrap">{!! $order->shippingAddress->city !!}</p>
    <p class="font-main-light font-13 text-wrap">{!! $order->shippingAddress->post_code !!}</p>
    <p class="font-main-light font-13 text-wrap mb-0">{!! $order->shippingAddress->country !!}</p>
</div>
