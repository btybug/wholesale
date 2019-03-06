<div class="d-flex flex-column align-items-center product-single-info_colors-outer">
    <label class="product-single-info_label text-uppercase mb-0 col-sm-2  pl-0 mr-0">{!! $promotionAttr->name !!}</label>
    <div class="col-sm-10 px-sm-3 px-0">
        <div class="product-single-colors">
            <div class="d-flex flex-wrap">
                @if(count($poptions))
                    @foreach($poptions as $item)
                        <div class="product-single-colors_item cl-blue">
                            <input type="radio"  name="color{{ $promotionAttr->id }}" value="{{ $item->sticker->id }}" data-name="{{ $promotionAttr->id }}"
                                   id="clo{{ $item->id.$pkey }}" {{ ($loop->first) ? 'checked' : '' }}  class="select-variation-radio-poption"/>
                            <label class="pointer d-inline-block mb-0" for="clo{{ $item->id.$pkey }}" style="background-color: {{ $item->sticker->color }}"></label>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>