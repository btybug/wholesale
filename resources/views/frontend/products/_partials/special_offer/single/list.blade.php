<div
    class="font-sec-light text-main-clr font-24 lh-1 special__popup-main-product-item-sec-title pr-wrap {{$vSettings->type}}"
data-group-id="{{ $vSettings->variation_id }}"
data-req="{{ $vSettings->is_required }}" data-id="{{ $vSettings->id }}" data-limit="{{ $vSettings->count_limit }}"
data-per-price="{{ $vSettings->price_per }}"
data-price="{{ convert_price($vSettings->price,$currency,false,true) }}"
data-min-limit="{{ $vSettings->min_count_limit }}">
    {{ $vSettings->title }}
    @if(! isset($selected))
        @php $selected = $variation->first(); @endphp
    @endif
    <div class="d-flex flex-wrap align-items-end mb-2 product__single-item-info-bottom">
        @include("frontend.products._partials.offer_option")
    </div>
</div>


{{--<div class="select-wall product__select-wall">--}}
    {{--<select name="" id=""--}}
            {{--class="select-2 select-2--no-search main-select not-selected arrow-dark select2-hidden-accessible"--}}
            {{--style="width: 100%">--}}
        {{--<option value="">12 mg Nicotine</option>--}}
        {{--<option value="">1 mg Nicotine</option>--}}
    {{--</select>--}}
{{--</div>--}}


{{--<div class="product__single-item-info mb-3 limit {{$vSettings->type}}"--}}
     {{--data-group-id="{{ $vSettings->variation_id }}"--}}
     {{--data-req="{{ $vSettings->is_required }}" data-id="{{ $vSettings->id }}" data-limit="{{ $vSettings->count_limit }}"--}}
     {{--data-per-price="{{ $vSettings->price_per }}"--}}
     {{--data-price="{{ convert_price($vSettings->price,$currency,false,true) }}"--}}
     {{--data-min-limit="{{ $vSettings->min_count_limit }}">--}}

    {{--<div--}}
        {{--class="d-flex flex-wrap align-items-center lh-1 product__single-item-info-top">--}}
        {{--<div class="col-md-9 pl-0">--}}
            {{--<span class="font-sec-light font-26">{{ $vSettings->title }}</span>--}}
        {{--</div>--}}
        {{--<div class="col-md-3 d-flex justify-content-end pr-0">--}}
            {{--@if($vSettings->price_per == 'product')--}}
                {{--<div class="product__single-item-info-price" data-single-price="{{ $vSettings->price }}">--}}
                    {{--<span class="font-40 product__single-item_price">--}}
                            {{--{{ convert_price($vSettings->price,$currency, false) }}--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="d-flex flex-wrap align-items-end mb-2 product__single-item-info-bottom"--}}
         {{--data-single-price="{{ $selected->price }}">--}}
        {{--@include("frontend.products._partials.stock_variation_option")--}}
    {{--</div>--}}
{{--</div>--}}


