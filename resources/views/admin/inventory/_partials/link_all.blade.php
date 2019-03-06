    @if(count($results))
        @foreach($results as $key => $items)
            @php
                $uniqueShortID = shortUniqueID();
            @endphp
            <div class="list-attrs-single-item" style="display: flex; justify-content: space-between;">
                <div>
                    <button variation-id="{!! $uniqueShortID !!}" type="button" class="variation-select"><i class="fa fa-list"></i></button>
                    {!! Form::hidden("variations[".$uniqueShortID."]",json_encode(['variation_id' => $uniqueShortID]),['id' => 'variation_'.$uniqueShortID]) !!}
                    {{--{!! Form::hidden("variation_options[".$uniqueShortID."][variation_id]",$uniqueShortID) !!}--}}
                </div>
                @foreach($data as $generalKey => $options)
                    @php
                    $linked = $items[$loop->index];
                    @endphp
                    {!! Form::hidden("variation_options[".$uniqueShortID."][".$generalKey."][attributes_id]",$generalKey) !!}
                    {!! Form::hidden("variation_options[".$uniqueShortID."][".$generalKey."][options_id]",$linked) !!}
                    <div class="form-group">
                        <label for="exampleFormControlSelect{{ $generalKey }}">{{ \App\Models\Attributes::getById($generalKey) }}</label>
                        <select class="form-control" id="exampleFormControlSelect{{ $generalKey }}">
                            @foreach($options as $option)
                                <option value="{{ $option }}" @if($linked == $option) selected @endif>{{ \App\Models\Attributes::getById($option) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
                <div>
                    <button type="button" class="remvoe-variations-select"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        @endforeach
    @endif
