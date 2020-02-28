<div class="product__single-wrapper" data-id="{{ $vape->id }}">
    {!! Form::hidden('vape_id',$vape->id,['id' => 'vpid']) !!}
    <div class="single-product-dtls-wrap w-100 " id="requiredProducts">
        <div class="row">
            <div class="col-lg-6 product-single-view-outer mr-0 w-100">
                <div class="product-card_view product-card_view--single position-relative">
                    <!--product main image-->
                    @if($vape->image)
                        <div class="h-100">
                            <img class="single-product_top-img"
                                 src="{!! checkImage($vape->image) !!}"
                                 alt="{!! @getImage( $vape->image)->seo_alt !!}">
                        </div>
                    @endif
                <!--new label-->
                    {{--                                                <span--}}
                    {{--                                                    class="new-label product-card_new-label d-inline-block text-uppercase font-main-bold font-16 text-sec-clr position-absolute">new</span>--}}
                <!--sale label-->
                    {{--                                                <span--}}
                    {{--                                                    class="sale-label product-card_sale-label d-inline-block text-uppercase font-main-bold font-16 text-sec-clr position-absolute">-10%</span>--}}
                </div>
            </div>
            <div class="col-lg-6 product-single-info-outer">
                <div class="product-single-info">
                    <input type="hidden" value="{{ $vape->id }}" data-p="{{ $vape->type }}"
                           id="vpid">

                    <div class="product__single-item">
                        <div
                            class="d-flex flex-wrap align-items-center justify-content-between product__single-item-top">
                            <div
                                class="d-flex align-items-center justify-content-center product_btn-discount">
                                                            <span
                                                                class="font-sec-reg font-26 text-sec-clr">QTY Discount</span>
                            </div>
                            <div class="font-main-light font-20">
                                The more you order the more you get
                            </div>
                            <a href="#" class="font-20 text-tert-clr top_details">Offer
                                Details</a>
                        </div>

                        @include("admin.inventory._partials.render_price_form",['model' => $vape])
                    </div>
                    <div
                        class="d-flex flex-wrap align-items-center justify-content-between product__single-delivery">
                        <div
                            class="d-flex align-items-center product__single-delivery-left">
                            <div
                                class="font-sec-reg text-main-clr font-28 lh-1 product__single-delivery-title">
                                Delivery
                            </div>
                            <div class="product__single-delivery-select">
                                <div class="select-wall product__select-wall">
                                    <select name="" id=""
                                            class="select-2 select-2--no-search main-select not-selected arrow-dark select2-hidden-accessible"
                                            style="width: 250px">
                                        <option value="">United Kingdom</option>
                                        <option value="">Armenia</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div
                            class="d-flex align-items-center product__single-delivery-right">
                            <div class="product__single-delivery-free font-20 lh-1">
                                Free on orders over £10
                            </div>
                            <a href="#"
                               class="product__single-delivery-details font-20 text-tert-clr lh-1">More
                                Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="d-flex align-items-center ml-lg-auto continue-shp-wrapp_right">
        <div class="continue-shp-wrapp_qty position-relative">
            <!--minus qty-->
            <span data-type="minus"
                  class="d-inline-block pointer position-absolute continue-shp-wrapp_qty-minus qty-count">
                            <svg viewBox="0 0 20 3" width="20px" height="3px">
                                <path fill-rule="evenodd" fill="rgb(214, 217, 225)"
                                      d="M20.004,2.938 L-0.007,2.938 L-0.007,0.580 L20.004,0.580 L20.004,2.938 Z"/>
                            </svg>
                        </span>
        {!! Form::number('',1,['class' => 'field-input w-100 h-100 font-23 text-center border-0 product-qty-select none-touchable ','min' => 'number']) !!}
        <!--plus qty-->
            <span data-type="plus"
                  class="d-inline-block pointer position-absolute continue-shp-wrapp_qty-plus qty-count">
                            <svg viewBox="0 0 20 20" width="20px" height="20px">
                                <path fill-rule="evenodd" fill="rgb(211, 214, 223)"
                                      d="M20.004,10.938 L11.315,10.938 L11.315,20.000 L8.696,20.000 L8.696,10.938 L-0.007,10.938 L-0.007,8.580 L8.696,8.580 L8.696,0.007 L11.315,0.007 L11.315,8.580 L20.004,8.580 L20.004,10.938 Z"/>
                            </svg>
                        </span>
        </div>
        <a href="#"
           class="btn-add-to-cart-manual product-card_btn d-inline-flex align-items-center justify-content-between text-center font-15 text-sec-clr text-uppercase"
           data-toggle="modal" data-target="#specialPopUpModal">
            <span class="product-card_btn-text">add to cart</span>
            <span class="d-inline-block ml-auto">
                            <svg viewBox="0 0 18 22" width="18px" height="22px">
                                <path fill-rule="evenodd" opacity="0.8" fill="rgb(255, 255, 255)"
                                      d="M14.305,3.679 L14.305,0.003 L3.694,0.003 L3.694,3.679 L-0.004,3.679 L-0.004,21.998 L18.003,21.998 L18.003,3.679 L14.305,3.679 ZM4.935,1.216 L13.064,1.216 L13.064,3.679 L4.935,3.679 L4.935,1.216 ZM16.761,20.785 L1.238,20.785 L1.238,4.891 L3.694,4.891 L3.694,7.329 L4.935,7.329 L4.935,4.891 L13.064,4.891 L13.064,7.329 L14.305,7.329 L14.305,4.891 L16.761,4.891 L16.761,20.785 Z"></path>
                            </svg>
                        </span>
        </a>
        <span
            class="product-card_price d-inline-block font-sec-bold font-41 text-tert-clr lh-1 position-relative">
                        <span class="price-place-summary">
{{--                            @if($vape->type)--}}
                            {{--                                {{ convert_price($vape->price,$currency, false)}}--}}
                            {{--                            @endif--}}
                        </span>
                    </span>
    </div>



</div>
