<li class="col-sm-6 col-xl-3">
    <div class="products__item-wrapper main-transition">
        <div class="products__item-wrapper-inner">
            @php
            $category = $product->categories()->whereNull('categories.parent_id')->where('status',true)->first();
            @endphp
            <a href="{{ route('product_single', ['type' =>($category)?$category->slug:'vape', 'slug' => $product->slug]) }}"
               @if(isset($related)) target="__blank" @endif
               class="products__item-top">
                    <span class="d-block products__item-photo-brand-name">
                        <span class="font-sec-reg text-uppercase d-block text-center text-truncate products__item-brand-name font-16 text-sec-clr lh-1">
                            @if($product->brand)
                                {{ $product->brand->name }}
                            @else
                                {!! __('no_brand') !!}
                            @endif
                        </span>
                        <span class="position-relative products__item-photo d-block">
                            <img src="{{ (media_image_tmb(checkImage($product->image,'stock'))) }}" alt="{{ $product->name }}" title="{{ $product->name }}">
                            {{--<span class="position-absolute font-main-bold font-16 products__item-photo-inner products__item-new">new</span>--}}
                            {{--<span class="position-absolute font-main-bold font-16 products__item-photo-inner products__item-less">-50%</span>--}}
                        </span>
                    </span>
                <span class="products__item-main-content">
                    <span class="products__item-photo-thumb">
                         <span class="products__item-photo-thumb-item active-slider" title="{{ $product->name }}">
                            <img src="{{ (media_image_tmb($product->image)) }}" alt="{{ $product->name }}" title="{{ $product->name }}">
                         </span>
                        @if($product->other_images && count($product->other_images))
                            @php $count = 0; @endphp
                            @foreach($product->other_images as $other_image)
                                @if($count == 3)
                                    @break
                                @endif
                                    @php $count++; @endphp
                                    <span class="products__item-photo-thumb-item" title="Extra Image {{ $count }}">
                                        <img src="{{ (media_image_tmb(checkImage($other_image['image'],'stock'))) }}" alt="{{ $other_image['alt'] }}" title="{{ $other_image['alt'] }}">
                                    </span>
                            @endforeach
                        @endif
                    </span>
                    <span class="products__item-content-inner">
                        <span class="font-sec-reg font-21 text-main-clr products__item-title">
                            {{ str_limit($product->name,50) }}
                        </span>
                        <span class="font-main-light font-15 products__item-desc">
                            {{ str_limit($product->short_description,50) }}
                        </span>
                        <span class="d-flex flex-wrap justify-content-between align-items-center products__item-price-discount">
                            <span class="d-flex flex-wrap align-items-center products__item-discount-all">
                                @if(count($product->stickers))
                                    @foreach($product->stickers()->orderBy('ordering')->take(2)->get() as $sticker)
                                         <span class="products__item-discount" title="{{ $sticker->name }}">
                                             <img src="{{ $sticker->image }}" alt="{{ $sticker->name }}">
                                         </span>
                                    @endforeach
                                @endif
                            </span>
                            <span class="d-flex flex-wrap products__item-prices">
                                @if($product->new_price)
                                    <span class="font-sec-reg text-gray-clr font-18 align-self-end products__item-sec-price">
                                         {{ convert_price($product->new_price,$currency, false) }}
                                    </span>
                                    <span class="font-sec-bold font-24 text-tert-clr products__item-main-price">
                                        {{ convert_price($product->price,$currency, false) }}
                                    </span>
                                @else
                                    @php
                                    $firstVariation = ($product->variations && count($product->variations))?$product->variations()->orderBy('ordering','asc')->first():null;
                                    @endphp
                                    <span class="font-sec-bold font-24 text-tert-clr products__item-main-price">
                                        @php
                                            $price = 0;
                                        @endphp
                                        @if($firstVariation)
                                            @if($firstVariation->price_per == 'product')
                                                @if($firstVariation->common_price)
                                                   @php $price = $firstVariation->common_price ;@endphp
                                                @endif
                                            @else
                                                @if($firstVariation->price_type == 'dynamic')
                                                    @php $price = $firstVariation->item->default_price; @endphp
                                                @elseif($firstVariation->price_type == 'fixed')
                                                    @php
                                                        $discount = $firstVariation->discounts()->orderBy('qty','asc')->first();
                                                        $price = ($discount)?$discount->price:0;
                                                    @endphp
                                                @elseif($firstVariation->price_type == 'range')
                                                    @php
                                                        $discount = $firstVariation->discounts()->orderBy('from','asc')->first();
                                                        $price = ($discount)?$discount->price:0;
                                                    @endphp
                                                @else
                                                    @if($firstVariation->price)
                                                        @php  $price = $firstVariation->price; @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endif

                                        {{ convert_price($price,$currency, false) }}
                                    </span>
                                @endif
                            </span>
                        </span>
                    </span>
                </span>
            </a>
            <div  class="flex-wrap justify-content-between align-items-center products__item-bottom">
                <a href="{{ route('product_single', ['type' =>($category)?$category->slug:'vape', 'slug' => $product->slug]) }}"
                   @if(isset($related)) target="__blank" @endif
                   class="d-flex align-items-center justify-content-center font-15 text-tert-clr text-uppercase products__item-view-more">
                    {!! __('view_more') !!}
                </a>
                @if(Auth::check())
                <span class="products__item-favourite product-card_like-icon {{ ($product->in_favorites()->where('user_id',\Auth::id())->first())?'active':null}}">
                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="20px" height="18px"
                                            viewBox="0 0 20 18"
                                        >
                                            <path fill-rule="evenodd" opacity="0.949" fill="rgb(227, 230, 237)"
                                                  d="M14.700,-0.002 C13.057,-0.002 11.419,0.767 10.360,2.016 C9.300,0.767 7.663,-0.002 6.020,-0.002 C3.036,-0.002 0.720,2.306 0.720,5.281 C0.720,8.936 3.996,11.916 9.009,16.336 L10.360,17.678 L11.711,16.336 C16.723,11.916 19.999,8.936 19.999,5.281 C19.999,2.306 17.684,-0.002 14.700,-0.002 L14.700,-0.002 Z"/>
                                        </svg>
                </span>
                @endif
            </div>
        </div>
    </div>
</li>
