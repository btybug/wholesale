<div class="col-sm-6">
    <select name="items[]" required style="width: 100%;"
            class="select-2 main-select main-select-2arrows single-product-select product--select-items select2-hidden-accessible">
      <option value=""></option>
        @foreach($items as $item)
            <option value="{{ $item->id }}" data-out="{{ out_of_stock($item) }}">
                {{ $item->name }}
                <b>{{ out_of_stock_msg($item) }}</b>
            </option>
        @endforeach
    </select>
</div>
