<div class="product-single-info_row options-group" data-main-stock="{{ $model->id }}">
    <div class="d-flex flex-wrap align-items-center">
        <div class="col-sm-10 pl-0">
            @if($model->type == 'variation_product')
                @foreach($model->type_attrs as $modelattr)
                    @php
                        $options = $model->type_attrs_pivot()->with('sticker')->where('attributes_id',$modelattr->id)->get();
                    @endphp

                    @if(\View::exists('frontend.products._partials.single.'.$modelattr->pivot->type))
                        @include('frontend.products._partials.single.'.$modelattr->pivot->type)
                    @endif
                @endforeach
            @endif
        </div>
        <div class="col-sm-2 pl-sm-3 p-0 text-sm-center">

            <span class="d-inline-block font-35 font-sec-bold text-uppercase ml-auto price-place"></span>
        </div>
    </div>

</div>

<input type="hidden" value="" id="variation_uid">
@if(count($model->promotions))
    @foreach($model->promotions as $pkey => $promotion)
        @include('frontend.products._partials.render_promotion')
    @endforeach
@endif

