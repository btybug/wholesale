<div class="d-flex flex-wrap special__popup-content" data-key="{{ $key }}" data-product-id="{{ $vape->id }}">
    <div class="d-flex flex-column special__popup-content-left">
        <div class="special__popup-content-scroll">
            <ul class="row special__popup-main-products-list">
                @if($vape->special_offers && count($vape->special_offers))
                    @foreach($vape->special_offers as $offer)
                        @include("frontend.products._partials.render_offer_price_form",['model' => $offer])
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="mt-auto special__popup-content-left-bottom">
            <div class="d-flex inner">
                <a href="javascript:void(0)" class="font-sec-light font-26 text-uppercase bottom-btn-cart no-btn">
                    {!! __('no_thank_you') !!}
                </a>
                <a href="javascript:void(0)"
                   class="font-sec-light font-26 text-uppercase bg-blue-clr bottom-btn-cart">
                    {!! __('add_to_cart') !!}
                </a>
            </div>
        </div>

    </div>
    <div class="d-flex flex-column special__popup-content-right">
        <div class="special__popup-content-scroll">
            <div class="special__popup-content-right-item">
                <div class="font-sec-reg font-26 text-sec-clr special__popup-content-right-head">
                    {!! __('selected_product') !!}
                </div>
                <div class="d-flex flex-wrap special__popup-content-right-product">
                    <div class="special__popup-content-right-product-photo">
                        <div class="inner-photo">
                            <img src="{!! $vape->image !!}" alt="product">
                        </div>
                    </div>
                    <div class="special__popup-content-right-product-content">
                        <div class="font-21 special__popup-content-right-product-title">
                            {{ $vape->name }}
                        </div>
                        <div class="d-flex flex-wrap special__popup-content-right-product-bottom">
                            <span class="text-main-clr special__popup-content-right-product-price">
                               {{ convert_price($price*$qty,get_currency())  }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="special__popup-content-right-item added-offers">
                <div class="font-sec-reg font-26 text-sec-clr special__popup-content-right-head">
                    {!! __('added_offers') !!}
                </div>
                @if(isset($extras) && count($extras))
                    @foreach($extras as $item_key => $extra)
                        @include("frontend.products._partials.add_offer",['offer' => $extra['offer'],'price'  => $extra['price'],'item_key' => $extra['key']])
                    @endforeach
                @endif
            </div>

            <a href="#" class="text-main-clr special__popup-content-right-item-more">
                <div class="d-flex flex-column align-items-center item-more-inner">
                    <span class="icon"><i class="fas fa-plus"></i></span>
                    <span class="font-26 lh-1">{!! __('add_more_offers') !!}</span>
                </div>
            </a>
        </div>
        <div class="mt-auto special__popup-content-right-bottom">
            <div class="d-flex text-tert-clr lh-1">
                <span class="font-48 offer-total-price">{!! get_symbol() !!}0</span>
            </div>
        </div>
    </div>
</div>
