<li class="col-sm-6 col-xl-3">
    <div class="products__item-wrapper main-transition">
        <div class="products__item-wrapper-inner">
            <a href="#" class="products__item-top">
                    <span class="d-block products__item-photo-brand-name">
                        <span class="font-sec-reg text-uppercase d-block text-center text-truncate products__item-brand-name font-16 text-sec-clr lh-1">
                            {{ $item->barcode->code }}
                        </span>
                        <span class="position-relative products__item-photo d-block">
                            <img src="{{ (media_image_tmb($item->image)) }}" alt="product">
                        </span>
                    </span>
                <span class="products__item-main-content">
                    {{--<span class="products__item-photo-thumb">--}}
                    {{--<span class="products__item-photo-thumb-item active-slider">--}}
                    {{--<img src="{{ (media_image_tmb($product->image)) }}" alt="{{ $product->name }}">--}}
                    {{--</span>--}}
                    {{--@if($product->variations)--}}
                    {{--@php $count = 0; @endphp--}}
                    {{--@foreach($product->variations()->take(3)->get() as $variation)--}}
                    {{--@if($variation->image)--}}
                    {{--@php $count++; @endphp--}}
                    {{--<span class="products__item-photo-thumb-item">--}}
                    {{--<img src="{{ (media_image_tmb($variation->image)) }}" alt="{{ $variation->name }}">--}}
                    {{--</span>--}}
                    {{--@endif--}}
                    {{--@endforeach--}}
                    {{--@endif--}}
                    {{--</span>--}}
                    <span class="products__item-content-inner">
                        <span class="font-sec-reg font-21 text-main-clr products__item-title text-truncate">
                            {{ str_limit($item->name,27) }}
                        </span>
                        <span class="font-main-light font-15 products__item-desc">
                            {{ str_limit($item->short_description,50) }}
                        </span>
                        <span class="d-flex flex-wrap justify-content-between align-items-center products__item-price-discount">
                            <span class="d-flex flex-wrap align-items-center products__item-discount-all">

                            </span>
                            <span class="d-flex flex-wrap products__item-prices">
                                <span class="font-sec-bold font-24 text-tert-clr products__item-main-price">
                                        {{ convert_price($item->default_price,$currency, false) }}
                                </span>
                            </span>
                        </span>
                    </span>
                </span>
            </a>
            <div  class="flex-wrap justify-content-between align-items-center products__item-bottom">
                <a href="javascript:void(0)" data-id="{{ $item->id }}"
                   class="d-flex align-items-center justify-content-center font-15 text-tert-clr text-uppercase products__item-view-more add-to-cart">
                    {!! __('add_to_cart') !!}
                </a>
            </div>
        </div>
    </div>
</li>
