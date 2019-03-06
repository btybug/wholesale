@if(count($attributesJson))
    @foreach($attributesJson as $key => $items)
        {!! Form::hidden("variations[$variation][options][".$key."][attributes_id]",$key,['class' => 'option-class']) !!}
        @php
            $selectedValue = (isset($objData[$key])) ? $objData[$key] : null;
        @endphp
        <select data-attribute_id="{{ $key }}"
                name="variations[{{ $variation }}][options][{{ $key }}][options_id]"
                class="form-control">
            @foreach($items as $option)
                <option {{ ($selectedValue == $option) ? 'selected' : '' }} value="{{ $option }}">{{ \App\Models\Stickers::getById($option) }}</option>
            @endforeach
        </select>
    @endforeach
@endif