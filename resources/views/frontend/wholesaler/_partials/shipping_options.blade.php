<div class="cart-delivery">
    <div class="head-delivery">
        <h3 class="title">{!! __('delivery_method') !!}</h3>
        <p class="delivery-sec-title font-18">{!! __('select_delivery_method') !!}</p>
    </div>

    @if($delivery)
        @if(count($delivery->options))
            @foreach($delivery->options as $option)
                <div class="method">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input select-shipping-method"
                               data-delivery="{{ $delivery->id }}"
                               {!! ($shipping && $shipping->getAttributes()->id == $option->id) ? 'checked="checked"' : "" !!}
                               id="deliveryRadios{{ $option->id }}" name="courier_change" value="{!! $option->id !!}">
                        <label class="custom-control-label" for="deliveryRadios{{ $option->id }}">
                                                                <span class="d-flex method-wrap pointer">
                                                                    <span class="method-left">
                                                                         <span class="photo">
<img src="{!! $option->courier->image !!}" alt="brand">
                                                                </span>
                                                                    </span>
                                                                     <span class="method-right">
                                                                         <span class="method-item-title">{!! $option->courier->name !!}</span>
                                                                         <span class="font-main-light method-item-info">{!! __('Shipping') !!}: <span
                                                                                 class="text-red-clr">{{ convert_price($option->cost,$currency) }}</span></span>
                                                                         <span class="font-main-light method-item-info">{!! __('delivery_time') !!}: {!! $option->time !!} {!! __('days') !!}</span>

                                                                    </span>
                                                                </span>
                            <span class="check-line"></span>
                        </label>
                    </div>
                </div>
            @endforeach
        @endif
    @endif
</div>
