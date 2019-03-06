<div class="product-single-info_row poptions-group" data-promotion="{{ $promotion->id }}">
    <h3 class="product-single-info_title d-flex align-items-center font-main-bold font-20 text-uppercase text-tert-clr">
        {{ $promotion->name }}
        @if(! $promotion->pivot->type)
            <div class="custom-control custom-checkbox products_custom_check">
                {!! Form::checkbox('',1,null,['class' => 'optional_checkbox custom-control-input product-single-info_title-check','id' => "optionalCheckbox$promotion->id"]) !!}

                <label class="custom-control-label product-single-info_title-label product-single-info_check-label pointer" for="optionalCheckbox{{$promotion->id}}"></label>
            </div>

            <input type="hidden" value="" class="variation_items optional_item">
        @else
            <input type="hidden" value="" class="variation_items required_item">
        @endif
    </h3>
    <div class="d-flex flex-wrap align-items-center extra-product {{ (! $promotion->pivot->type) ? 'products_closed' :'' }}">
        @if($promotion->type == 'variation_product')
            <div class="col-sm-10 pl-0">
                @foreach($promotion->type_attrs as $promotionAttr)
                    @php
                        $poptions = $promotion->type_attrs_pivot()->with('sticker')->where('attributes_id',$promotionAttr->id)->get();
                    @endphp
                    @if(\View::exists('frontend.products._partials.singleExtra.'.$promotionAttr->pivot->type))
                        @include('frontend.products._partials.singleExtra.'.$promotionAttr->pivot->type)
                    @endif
                @endforeach
            </div>
            <div class="col-sm-2 pl-sm-3 p-0 text-sm-center">
                <span class="d-inline-block font-35 font-sec-bold text-uppercase ml-auto price-place-promotion"></span>
            </div>
        @else
            @php
                $variation = (count($promotion->variations)) ? $promotion->variations->first() : null;
                $promotionPrice = ($variation) ? $model->promotion_prices()->where('variation_id',$variation->id)->first() : null;
            @endphp
            <div>
                {{ $variation->name }}:
            </div>
            <span class="d-inline-block font-35 font-sec-bold text-uppercase ml-auto price-place-promotion">
                  @php
                      $price = ($promotionPrice) ? $promotionPrice->price : (($variation) ? $variation->price : null)
                  @endphp
                {{ convert_price($price,$currency) }}
            </span>
        @endif
    </div>
</div>



