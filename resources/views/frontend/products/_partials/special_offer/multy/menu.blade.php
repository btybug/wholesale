<div class="mb-3 limit pr-wrap {{$vSettings->type}}"
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

        </div>
    </div>
    @if(! isset($selected))
        @php $selected = $variation->first(); @endphp
    @endif
    <div class="d-flex flex-wrap align-items-end mb-2 product__single-item-info-bottom"
         data-single-price="{{ $selected->price }}">
        @include("frontend.products._partials.offer_option")
    </div>

    @if($vSettings->count_limit > 1)
    <div class="product__single-item-add-new">
        <a href="#"
           class="d-flex justify-content-center align-self-center text-tert-clr font-18 product__single-item-add-new-btn">
            <span class="icon-plus"><i class="fas fa-plus"></i></span>
            <span>Add New</span>
        </a>
    </div>
    @endif
</div>
