@if($package_variation->price_type == 'range')

    <div class="range-box">
        @foreach($package_variation->discounts()->orderBy('ordering','asc')->get() as $key => $datum)
            <div class="row discount-item">
                <div class="col-sm-3">
                    <label>From</label>
                    {!! Form::number("variations[$main_unique][variations][$uniqueID][discount][$key][from]",$datum->from,['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    <label>To</label>
                    {!! Form::number("variations[$main_unique][variations][$uniqueID][discount][$key][to]",$datum->to,['class' => 'form-control']) !!}
                </div>
                <div class="col-xl-4 col-sm-3">
                    <label>Price/Item</label>
                    {!! Form::number("variations[$main_unique][variations][$uniqueID][discount][$key][price]",$datum->price,['class' => 'form-control']) !!}
                </div>
                <div class="col-xl-2 col-sm-3 mt-sm-0 mt-2 align-self-end">
                    <button class="btn btn-danger remove-discount-item">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][ordering]",($main) ? $main->ordering : null,
               ['class' => 'sort-discount-hidden-field','placeholder' => 'Sort']) !!}
            </div>
        @endforeach
    </div>
    <div class="col-xl-2 offset-xl-10 col-sm-3 offset-sm-9 pl-sm-4 pl-xl-4 pl-0">
        <a class="btn btn-primary add-range-discount add-discount-field" href="javascript:void(0)"><i
                class="fa fa-plus"></i></a>
    </div>
@else
    <div class="fixed-box">


        @foreach($package_variation->discounts()->orderBy('ordering','asc')->get() as $key => $datum)
            <div class="row discount-item ">
                <div class="col-xl-5 col-sm-4">
                    <label>Qty</label>
                    {!! Form::number("variations[$main_unique][variations][$uniqueID][discount][$key][qty]",$datum->qty,['class' => 'form-control']) !!}
                </div>

                <div class="col-xl-5 col-sm-4">
                    <label>Total price</label>
                    {!! Form::number("variations[$main_unique][variations][$uniqueID][discount][$key][price]",$datum->price,['class' => 'form-control']) !!}
                </div>
                <div class="col-xl-2 col-sm-4 mt-sm-0 mt-2 align-self-end">
                    <button class="btn btn-danger remove-discount-item">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][ordering]",($main) ? $main->ordering : null,
               ['class' => 'sort-discount-hidden-field','placeholder' => 'Sort']) !!}
            </div>
        @endforeach
    </div>
    <div class="col-xl-2 offset-xl-10 col-sm-4 offset-sm-8 pl-sm-3 pl-xl-4 pl-0">
        <a class="btn btn-primary add-fixed-discount add-discount-field" href="javascript:void(0)"><i
                class="fa fa-plus"></i></a>
    </div>
@endif


{{--@if(isset($ajax) && $ajax == false)--}}
{{--    {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount_type]",$package_variation->discount_type,['data-type-discount' => 'discount_type']) !!}--}}
{{--    @foreach($package_variation->discounts as $key => $datum)--}}
{{--        @if($package_variation->discount_type == 'range')--}}
{{--            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][from]",$datum->from,['data-type-discount' => 'discount','data-key' => $key]) !!}--}}
{{--            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][to]",$datum->to,['data-type-discount' => 'discount','data-key' => $key]) !!}--}}
{{--            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][price]",$datum->price,['data-type-discount' => 'discount','data-key' => $key]) !!}--}}
{{--        @else--}}
{{--            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][qty]",$datum->qty,['data-type-discount' => 'discount','data-key' => $key]) !!}--}}
{{--            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][price]",$datum->price,['data-type-discount' => 'discount','data-key' => $key]) !!}--}}
{{--        @endif--}}
{{--    @endforeach--}}
{{--@else--}}
{{--    @if(count($data))--}}
{{--        @foreach($data as $key => $datum)--}}
{{--            {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount_type]",$type,['data-type-discount' => 'discount_type']) !!}--}}
{{--            @if($type == 'range')--}}
{{--                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][from]",$datum['from'],['data-type-discount' => 'discount','data-key' => $key]) !!}--}}
{{--                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][to]",$datum['to'],['data-type-discount' => 'discount','data-key' => $key]) !!}--}}
{{--                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][price]",$datum['price'],['data-type-discount' => 'discount','data-key' => $key]) !!}--}}
{{--            @else--}}
{{--                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][qty]",$datum['qty'],['data-type-discount' => 'discount','data-key' => $key]) !!}--}}
{{--                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][discount][$key][price]",$datum['price'],['data-type-discount' => 'discount','data-key' => $key]) !!}--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    @endif--}}
{{--@endif--}}
