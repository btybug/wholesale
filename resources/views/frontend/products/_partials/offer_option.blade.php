<div>
    @if($vSettings->display_as == 'menu')
        <div class="select-wall product__select-wall">
            @if($vSettings->type == 'package_product')
                <span
                    class="d-flex align-items-center justify-content-center text-sec-clr align-self-center remove-single_product-item">
                <i class="fas fa-times"></i>
            </span>
            @endif
            <select name="variations[{{ $vSettings->variation_id }}][]"
                    id="single_v_select_{{ $vSettings->id.uniqid() }}"
                    data-count="{{ $vSettings->count_limit }}" data-id="{{ $vSettings->id }}"
                    style="width: 100%"
                    class="select-variation-option select-2 select-2--no-search main-select not-selected arrow-dark select2-hidden-accessible single-product-select">
                @foreach($variation as $item)
                    <option value="{{ $item->id }}" @if(isset($selected) && $selected->id == $item->id) selected
                            @endif data-out="{{ out_of_stock($item) }}">
                        {{ $item->name }}
                        <b>{{ out_of_stock_msg($item) }}</b>
                    </option>
                @endforeach
            </select>
        </div>
    @elseif($vSettings->type == 'filter')
        <div class="select-wall product__select-wall">
            <span
                class="d-flex align-items-center justify-content-center text-sec-clr align-self-center remove-single_product-item">
                <i class="fas fa-times"></i>
            </span>
            <span class="font-sec-light font-26">{{ $selected->name }}</span>
        </div>
    @elseif($vSettings->display_as == 'list' && $vSettings->type == 'single')
        <div class="d-flex flex-wrap special__popup-main-product-item-radio mb-3">
            @foreach($variation as $item)
                @php
                    $x = uniqid();
                @endphp
                <div class="product_radio-single">
                    <div class="custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input"
                               @if(isset($selected) && $selected->id == $item->id) checked
                               @endif data-out="{{ out_of_stock($item) }}"
                               id="single_v_select_{{ $item->id.$x }}"
                               name="special_offers[{{ $item->variation_id }}][]" value="{{ $item->id }}">
                        <label class="custom-label"  for="single_v_select_{{ $item->id.$x }}">
                            <span class="font-sec-ex-light font-26 count">{{ $item->name }}</span>
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif($vSettings->display_as == 'list' && $vSettings->type == 'package_product')
        <div class="d-flex flex-wrap special__popup-main-product-item-radio mb-3">
            @php
                $x = uniqid();
            @endphp
            <div class="product_radio-single">
                <div class="custom-radio custom-control-inline">
                    <input type="checkbox" class="custom-control-input"
                           data-out="{{ out_of_stock($selected) }}"
                           id="single_v_select_{{ $selected->id.$x }}"
                           name="special_offers[{{ $selected->variation_id }}][]" value="{{ $selected->id }}">
                    <label class="custom-label checkbox-select"  for="single_v_select_{{ $selected->id.$x }}">
                        <span class="font-sec-ex-light font-26 count">{{ $selected->name }}</span>
                    </label>
                </div>
            </div>
        </div>
    @elseif($vSettings->display_as == 'popup' && $vSettings->type == 'package_product')
        <div class="select-wall product__select-wall">
            <span
                class="d-flex align-items-center justify-content-center text-sec-clr align-self-center remove-single_product-item">
            <i class="fas fa-times"></i>
            </span>
            <span class="font-sec-light font-26">{{ $selected->name }}</span>
        </div>
        {{--<div class="d-flex flex-wrap product__single-item-info-size">--}}
        {{--<div class="product_radio-single">--}}
        {{--@php--}}
        {{--$x = uniqid();--}}
        {{--@endphp--}}
        {{--<div--}}
        {{--class="custom-radio custom-control-inline">--}}
        {{--<input type="checkbox"--}}
        {{--data-out="{{ out_of_stock($selected) }}"--}}
        {{--class="custom-control-input"--}}
        {{--id="single_v_select_{{ $selected->id.$x}}" name="variations[{{ $vSettings->variation_id }}][]"--}}
        {{--value="{{ $selected->id }}">--}}
        {{--<label class="custom-label checkbox-select"--}}
        {{--for="single_v_select_{{ $selected->id.$x }}">--}}
        {{--<span class="font-sec-ex-light font-26 count">{{ $selected->name }}</span>--}}
        {{--</label>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
    @endif

</div>
@php
    $price = 0;
@endphp
@if($selected->price_per =='item' && ! $selected->stock->type)
    @if($selected->price_type == 'static')
        @php
            $price = $selected->price;
        @endphp
    @else
        @if($selected->discount_type == 'range')
            @php
                $qty = (isset($qty))?:1;
                $discount = $selected->discounts()->where('from','<=',$qty)->where('to','>=',$qty)->first();
            @endphp
            @if($discount)
                @php
                    $price = $discount->price*$qty;
                @endphp
            @endif
        @elseif($selected->discount_type == 'fixed')
            @php
                $discount = $selected->discounts()->first();
            @endphp
            @if($discount)
                @php
                    $price = $discount->price;
                @endphp
            @endif
        @endif
    @endif
@endif

<div class="d-flex justify-content-center get-single-price" data-single-price="{{ $price }}">
    @if($selected->price_type != 'static' && $selected->discount_type == 'range')
        <div class="d-flex flex-column w-100 align-items-center">
            <span class="text-tert-clr">*Quality Discount</span>
            <div class="product__single-item-inp-num">
                <div class="quantity">
                    {!! Form::number('qty',1,['class' => 'product-qty product-qty_per_price input-qty',
                        'data-id' => $selected->id,'min' => 1,'step' => 1]) !!}
                    <div class="inp-icons">
                        <span class="inp-up"></span>
                        <span class="inp-down"></span>
                    </div>
                </div>
            </div>
        </div>
    @elseif($selected->price_type != 'static' && $selected->discount_type == 'fixed')
        <div
            class="d-flex flex-column w-100 align-items-center">
            <span class="text-tert-clr">*Quality Discount</span>
            <div class="select-wall product__select-wall w-100">
                <select name="qty" id="" data-id="{{ $selected->id }}"
                        class="select-2 select-2--no-search main-select not-selected arrow-dark select2-hidden-accessible product-qty product-qty_per_price select-qty"
                        style="width: 100%">
                    @if(count($selected->discounts))
                        @foreach($selected->discounts as $d)
                            <option value="{{ $d->id }}">Pack of {{ $d->qty }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    @endif
</div>

@if($vSettings->display_as == 'popup' && $vSettings->type == 'package_product')
<div>
    <div class="d-none product__single-item-info-price lh-1" data-single-price="{{ $price }}">
        <span class="font-40">

        </span>
    </div>
</div>
@endif
