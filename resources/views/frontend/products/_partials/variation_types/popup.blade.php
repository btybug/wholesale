<div class="product__single-item-info mb-3 limit {{$vSettings->type}}"
     data-group-id="{{ $vSettings->variation_id }}"
     data-req="{{ $vSettings->is_required }}" data-id="{{ $vSettings->id }}" data-limit="{{ $vSettings->count_limit }}"
     data-per-price="{{ $vSettings->price_per }}"
     data-price="{{ convert_price($vSettings->price,$currency,false,true) }}"
     data-min-limit="{{ $vSettings->min_count_limit }}">

    <div
        class="d-flex flex-wrap align-items-center lh-1 product__single-item-info-top">
        <div class="col-md-9 pl-0">
            <a href="javascript:void(0)" class="font-sec-light font-22 text-uppercase  product_select-link-btn  popup-select" data-group="{{ $vSettings->variation_id }}">
                Select Products
            </a>
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
    
</div>
