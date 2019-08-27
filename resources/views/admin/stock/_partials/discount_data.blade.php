@if(isset($ajax) && $ajax == false)
    {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount_type]",$package_variation->discount_type,['data-type-discount' => 'discount_type']) !!}
    @foreach($package_variation->discounts as $key => $datum)
        @if($package_variation->discount_type == 'range')
            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][from]",$datum->from,['data-type-discount' => 'discount','data-key' => $key]) !!}
            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][to]",$datum->to,['data-type-discount' => 'discount','data-key' => $key]) !!}
            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][price]",$datum->price,['data-type-discount' => 'discount','data-key' => $key]) !!}
        @else
            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][qty]",$datum->qty,['data-type-discount' => 'discount','data-key' => $key]) !!}
            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][price]",$datum->price,['data-type-discount' => 'discount','data-key' => $key]) !!}
        @endif
    @endforeach
@else
    @if(count($data))
        @foreach($data as $key => $datum)
            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount_type]",$type,['data-type-discount' => 'discount_type']) !!}
            @if($type == 'range')
                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][from]",$datum['from'],['data-type-discount' => 'discount','data-key' => $key]) !!}
                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][to]",$datum['to'],['data-type-discount' => 'discount','data-key' => $key]) !!}
                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][price]",$datum['price'],['data-type-discount' => 'discount','data-key' => $key]) !!}
            @else
                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][qty]",$datum['qty'],['data-type-discount' => 'discount','data-key' => $key]) !!}
                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][price]",$datum['price'],['data-type-discount' => 'discount','data-key' => $key]) !!}
            @endif
        @endforeach
    @endif
@endif
