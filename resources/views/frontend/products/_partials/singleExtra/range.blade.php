<div class="d-flex align-items-center product-single-info_range-outer">
    <label class="product-single-info_label text-uppercase mb-0 col-sm-2 pl-0 mr-0">{!! $promotionAttr->name !!}:</label>
    <div class="col-sm-10 px-sm-3 px-0">
        <div class="range-steps d-flex">
            @if(count($poptions))
                @foreach($poptions as $item)
                    <div class="range-steps_item {{ ($loop->first) ? 'active' : '' }}">
                        <label for="pr{{ $item->id.$pkey }}"></label>
                        <input data-name="{{ $promotionAttr->id }}"  type="radio" class="select-variation-radio-poption" id="pr{{ $item->id.$pkey }}"
                               {{ ($loop->first) ? 'checked' : '' }} value="{{ $item->sticker->id }}" name="pr{{ $promotionAttr->id.$pkey }}">
                        <span class="range-steps_count font-15 font-sec-bold">{{ $item->sticker->name }}</span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>