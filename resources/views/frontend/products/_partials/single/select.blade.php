<div class="single-product-row-repeatable d-flex align-items-center">
    <label for="singlePacksField{{ $modelattr->id }}" class="product-single-info_label text-uppercase mb-0 col-sm-2 pl-0 mr-0">{!! $modelattr->name !!}:</label>
    <div class="col-sm-10 px-sm-3 px-0">
        <select id="singlePacksField{{ $modelattr->id }}" data-id="productPack{{ $modelattr->id }}" data-name="{{ $modelattr->id }}"
                class="select-variation-option select-2 select-2--no-search main-select main-select-2arrows single-product-select product-pack-select" style="width: 453px">
            @foreach($options as $item)
                <option value="{{ $item->sticker->id }}">{{ $item->sticker->name }}</option>
            @endforeach
        </select>
    </div>
</div>
