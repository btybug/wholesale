@php
    $variations = collect($model->variations()->required()->get())->groupBy('variation_id');
@endphp
<li class="col-xl-3 col-md-6">
    <div class="special__popup-main-product-item" data-id="{{ $model->id }}">
        <div class="special__popup-main-product-item-photo">
            <img src="{!! checkImage($model->image) !!}" alt="product">
        </div>
        <h3 class="lh-1 text-tert-clr font-26 special__popup-main-product-item-title">
            {{ $model->name }}
        </h3>

        @if(count($variations))
            @foreach($variations as $variation)
                @php
                    $vSettings = $variation->first();
                @endphp
                @if($vSettings->type == 'filter')
                    @include("frontend.products._partials.special_offer.filter_popup")
                @elseif($vSettings->type == 'single')
                    @if(\View::exists("frontend.products._partials.special_offer.single.$vSettings->display_as"))
                        @include("frontend.products._partials.special_offer.single.$vSettings->display_as")
                    @endif
                @else
                    @if(\View::exists("frontend.products._partials.special_offer.multy.$vSettings->display_as"))
                        @include("frontend.products._partials.special_offer.multy.$vSettings->display_as")
                    @endif
                @endif
            @endforeach
        @endif

        {{--<div--}}
            {{--class="d-flex align-items-center flex-wrap special__popup-main-product-item-qty">--}}
            {{--<span class="font-sec-light font-24 qty">QTY</span>--}}
            {{--<div class="product__single-item-inp-num">--}}
                {{--<div class="quantity">--}}
                    {{--<input type="number" min="1" max="9" step="1" value="1">--}}
                    {{--<div class="inp-icons">--}}
                        {{--<span class="inp-up"></span>--}}
                        {{--<span class="inp-down"></span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="special__popup-main-product-item-price">
            <span class="font-40 product__single-item_price">
                
            </span>
        </div>
        {{--<a href="#"--}}
           {{--class="font-sec-light font-26 text-sec-clr text-uppercase special__popup-main-product-item-btn remove-btn">--}}
            {{--Remove--}}
        {{--</a>--}}
        <a href="javascript:void(0)"
           class="font-sec-light font-26 text-sec-clr text-uppercase special__popup-main-product-item-btn add-btn">
            {!! __('add') !!}
        </a>
    </div>
</li>



