<div class="product__single-item-info mb-3 limit {{$vSettings->type}}"
     data-group-id="{{ $vSettings->variation_id }}"
     data-req="{{ $vSettings->is_required }}" data-id="{{ $vSettings->id }}" data-limit="{{ $vSettings->count_limit }}"
     data-per-price="{{ $vSettings->price_per }}"
     data-price="{{ convert_price($vSettings->price,$currency,false,true) }}"
     data-min-limit="{{ $vSettings->min_count_limit }}">

    <div
        class="d-flex flex-wrap align-items-center lh-1 product__single-item-info-top">
        <div class="col-md-9 pl-0">
            <span class="font-sec-light font-26">{{ $vSettings->title }}</span>
        </div>
        <div class="col-md-3 d-flex justify-content-end pr-0">
            @if($vSettings->price_per == 'product')
                <div class="product__single-item-info-price" data-single-price="{{ $vSettings->price }}">
                    <span class="font-40 product__single-item_price">
                            {{ convert_price($vSettings->price,$currency, false) }}
                    </span>
                </div>
            @endif
        </div>
    </div>
    @if(! isset($selected))
        @php $selected = $variation->first(); @endphp
    @endif
    @if(count($variation))
        @foreach($variation as $selected)
            <div class="d-flex flex-wrap align-items-end mb-2 product__single-item-info-bottom"
                 data-single-price="{{ ($selected->price_type == 'dynamic')? $selected->item->default_price:$selected->price }}">
                @include("frontend.products._partials.stock_variation_option")
            </div>
        @endforeach
    @endif
</div>
