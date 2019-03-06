<div>
    <p class="mb-5">According to your shipping address... Select one of these options:</p>
    <ul class="list-unstyled mb-0 profile-form row">
        @if($delivery)
            @if(count($delivery->options))
                @foreach($delivery->options as $option)
                    <li class="col-md-3">
                        <input data-delivery="{{ $delivery->id }}" class="form-check-input register-form_input-radio select-shipping-method"
                               {!! ($shipping && $shipping->getAttributes()->id == $option->id) ? 'checked="checked"' : "" !!}
                               type="radio" name="courier_change" value="{!! $option->id !!}" id="deliveryRadios{{ $option->id }}">
                        <label class="form-check-label mb-0 d-flex text-main-clr pointer" for="deliveryRadios{{ $option->id }}">
                            <span class="d-inline-flex flex-column">
                                <span class="delivery-icon">
                            <img src="img/dhl.png" alt="">
                            </span>
                            <span class="font-main-bold mb-1">       {!! $option->courier->name !!}</span>
                                <span class="font-12"><span class="text-gray-clr">Shipping:</span> <span>{{ convert_price($option->cost,$currency) }}</span></span>
                                <span class="font-12"><span class="text-gray-clr">Delivery Time:</span> <span> {!! $option->time !!} days</span></span>
                            </span>
                        </label>
                    </li>
                @endforeach
            @endif
        @endif
    </ul>
</div>