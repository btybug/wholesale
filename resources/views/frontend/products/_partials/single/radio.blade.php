<div class="single-product-row-repeatable d-flex align-items-center">
    <p class="product-single-info_label text-uppercase mb-0 col-sm-2 pl-0 mr-0">{!! $modelattr->name !!}:</p>
    @if(count($options))
        <div class="col-sm-10 px-sm-3 px-0">
            <div class="d-flex flex-md-row flex-column">
                @foreach($options as $item)
                    <div class="product-single-info_custom-control custom-control custom-radio">
                        <input type="radio" id="rm{{ $item->id }}" class="custom-control-input select-variation-radio-option" data-name="{{ $modelattr->id }}"
                               name="rate{{ $modelattr->id }}"  value="{{ $item->sticker->id }}" {{ ($loop->first) ? 'checked' : '' }} >
                        <label class="product-single-info_radio-label custom-control-label font-15 text-gray-clr pointer" for="rm{{ $item->id }}">{{ $item->sticker->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
