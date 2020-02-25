<div class="product__single-item-info mb-3 limit {{$vSettings->type}}"
     data-group-id="{{ $vSettings->variation_id }}"
     data-req="{{ $vSettings->is_required }}" data-id="{{ $vSettings->id }}" data-limit="{{ $vSettings->count_limit }}"
     data-per-price="{{ $vSettings->price_per }}"
     data-price="{{ convert_price($vSettings->price,$currency,false,true) }}"
     data-min-limit="{{ $vSettings->min_count_limit }}">

    <div
        class="d-flex flex-wrap align-items-center lh-1 product__single-item-info-top">
        <div class="col-md-9 pl-0">
            <span class="font-sec-light font-26">{{ $vSettings->title }}</span>
        </div>
        <div class="col-md-3 d-flex justify-content-end pr-0">
            @if($vSettings->price_per == 'product')
                <div class="product__single-item-info-price" data-single-price="{{ $vSettings->price }}">
                    <span class="font-40 product__single-item_price">
                            {{ convert_price($vSettings->price,$currency, false) }}
                    </span>
                </div>
            @endif
        </div>
    </div>
    @if(! isset($selected))
        @php $selected = $variation->first(); @endphp
    @endif
    <div class="d-flex flex-wrap align-items-end mb-2 product__single-item-info-bottom"
         data-single-price="{{ ($selected->price_type == 'dynamic')? $selected->item->default_price:$selected->price }}">
        {!! filter_button(@$vSettings->filter->slug,@$vSettings->variation_id,'Select options','filter',true,@$vSettings->display_as) !!}
    </div>
    <div class="product-single-info_row-items">
    </div>
</div>



{{--<div class="col-sm-10 pl-0 limit" data-limit="{{ $vSettings->count_limit }}" data-id="{{ $vSettings->id }}"  data-price="{{ convert_price($vSettings->price,$currency,false,true) }}" data-per-price="{{  $vSettings->price_per }}" data-min-limit="{{ $vSettings->min_count_limit }}" data-req="{{ $vSettings->is_required }}">--}}
    {{--<div class="col-sm-12 pl-0 d-flex">--}}
      {{--@if(! $vSettings->is_required)--}}
        {{--{!! Form::checkbox('checkbox',1,null,['class' => 'custom-control-input req_check ','id' => 'opt'.$vSettings->id]) !!}--}}
        {{--<label class="product-single-info_check-label custom-control-label font-15 text-gray-clr pointer "--}}
               {{--for="opt{{ $vSettings->id }}">--}}
          {{--<h4>--}}
            {{--@if($vSettings->min_count_limit == 1 && $vSettings->count_limit == 1)--}}
              {{--{{ $vSettings->title }} (you can select one option)--}}
            {{--@else--}}
              {{--{{ $vSettings->title }} (select {{ $vSettings->min_count_limit }} - {{ $vSettings->count_limit }} options)--}}
            {{--@endif--}}
          {{--</h4>--}}
        {{--</label>--}}
      {{--@else--}}
        {{--<h4>--}}
          {{--@if($vSettings->min_count_limit == 1 && $vSettings->count_limit == 1)--}}
            {{--{{ $vSettings->title }} (you can select one option)--}}
          {{--@else--}}
            {{--{{ $vSettings->title }} (select {{ $vSettings->min_count_limit }} - {{ $vSettings->count_limit }} options)--}}
          {{--@endif</h4>--}}
      {{--@endif--}}
    {{--</div>--}}
    {{--<div class="wall--wrapper">--}}
      {{--{!! filter_button(@$vSettings->filter->slug,@$vSettings->variation_id,'Select options','filter',true,@$vSettings->display_as) !!}--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="col-sm-2 pl-sm-3 p-0 text-sm-center">--}}
    {{--@if($vSettings->price_per == 'product' && ! $vSettings->stock->type)--}}
        {{--<span class="d-inline-block font-35 font-sec-bold text-uppercase ml-auto price-placee">--}}
            {{--@if($vSettings->is_required)--}}
             {{--{{ convert_price($vSettings->price,$currency, false) }}--}}
            {{--@else--}}
              {{--Nothing selected--}}
            {{--@endif--}}
        {{--</span>--}}
    {{--@endif--}}
{{--</div>--}}

{{--<div class="selected-menu-options">--}}

{{--</div>--}}
