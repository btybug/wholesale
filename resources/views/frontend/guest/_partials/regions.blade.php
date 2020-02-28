<select id="city" readonly="true" class="form-control">
    <option selected>{!! __('choose') !!}...</option>
    @foreach($regions as $region)

        <option value="{!! $region !!}"
                >{!! $region !!}</option>
    @endforeach
</select>
