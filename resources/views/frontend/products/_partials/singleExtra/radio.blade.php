<div class="single-product-row-repeatable d-flex align-items-center">
    <p class="product-single-info_label text-uppercase mb-0 col-sm-2  pl-0 mr-0">{!! $promotionAttr->name !!}:</p>
    @if(count($poptions))
        <div class="col-sm-10 px-sm-3 px-0">
            <div class="d-flex flex-md-row flex-column">
                @foreach($poptions as $item)
                    <div class="product-single-info_custom-control custom-control custom-radio">
                        <input  data-name="{{ $promotionAttr->id }}" type="radio" id="pr{{ $item->id.$pkey }}" class="custom-control-input select-variation-radio-poption"
                                name="pr{{ $promotionAttr->id.$pkey }}"  value="{{ $item->sticker->id }}" {{ ($loop->first) ? 'checked' : '' }} >
                        <label class="product-single-info_radio-label custom-control-label font-15 text-gray-clr pointer" for="pr{{ $item->id.$pkey }}">{{ $item->sticker->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>