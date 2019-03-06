<div class="shopping-cart-content">
    <div class="shopping-cart-inner">
        <div class="d-flex flex-wrap">
            <div class="col-lg-9 pl-md-left">
                <div class="left-content main-scrollbar w-100">
                    @if($geoZone)
                        <span class="head"><sup>*</sup>Your shopping cost based on <span
                                    class="font-main-bold">{{ $geoZone->name }}</span></span>
                    @endif
                    <table class="table table-bordered shp-cart-table">
                        <thead class="thead-light">
                        <tr>
                            <th colspan="2" scope="col" class="text-uppercase">product</th>
                            <th scope="col" class="text-uppercase">qty</th>
                            <th scope="col" class="text-uppercase">price</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if(count($items))
                            @foreach($items as $key => $item)
                                @php
                                    $main = $item[$key];
                                    unset($item[$key]);
                                    $stock = $main->attributes->variation->stock;
                                @endphp
                                <tr>

                                    <td colspan="2" class="p-0">
                                        <div class="shp-cart-product d-flex flex-md-row flex-column">
                                            <div class="shp-cart-product_left d-flex flex-md-column justify-content-between mb-md-0 mb-3">
                                                <div class="shp-cart-table_img-holder">
                                                    <img src="{{ checkImage(media_image_tmb($stock->image)) }}"
                                                         alt=" {!! $stock->name !!}">
                                                </div>
                                                <span data-uid="{{ $main->id }}"
                                                      class="shp-cart-product_remove font-13 pointer remove-from-cart">Remove</span>
                                            </div>
                                            <div class="shp-cart-product_right">
                                                <h2 class="shp-cart-product_right_title font-main-bold font-20 text-uppercase">
                                                    {!! $stock->name !!}
                                                </h2>
                                                <ul class="list-unstyled mb-0">
                                                    <li class="shp-cart-product_row shp-cart-product_prd-1 d-flex justify-content-between">
                                                        <p class="mb-0"><span>{{ $main->attributes->variation->name }}
                                                                :</span>
                                                            <span class="font-main-bold">
                                                                @if($stock->type == 'variation_product')
                                                                    @foreach($main->attributes->variation->options as $voption)
                                                                        @if($voption->attribute_sticker)
                                                                            {{ $voption->attribute_sticker->sticker->name }}
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </span>
                                                        </p>
                                                        <span class="font-15 font-main-bold">{{ convert_price($main->price,$currency) }}
                                                        </span>
                                                    </li>
                                                    <li class="shp-cart-product_row shp-cart-product_extra font-main-bold font-15 text-uppercase">
                                                        Extra
                                                    </li>
                                                    @php
                                                        $countMessage = true;
                                                    @endphp

                                                    @if(count($item))
                                                        @php
                                                            $countMessage = false;
                                                        @endphp
                                                        @foreach($item as $vid)
                                                            @php
                                                                $variationOpt = $vid->attributes->variation;
                                                                $type = $vid->attributes->type;
                                                            @endphp
                                                            <li class="shp-cart-product_row d-flex justify-content-between position-relative">
                                                                <p class="mb-0">
                                                                    <span>{{ $variationOpt->stock->name }}</span>
                                                                    <span class="font-main-bold">
                                                                        @if($variationOpt->stock->type == 'variation_product')
                                                                            @foreach($variationOpt->options as $voption)
                                                                                @if($voption->attribute_sticker)
                                                                                    {{ $voption->attribute_sticker->sticker->name }}
                                                                                    {{ ($loop->last)?'':',' }}
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </span>
                                                                </p>
                                                                <span class="font-15 font-main-bold">
                                                                    @php
                                                                        $promotionPrice = ($variationOpt) ? $stock->promotion_prices()
                                                                        ->where('variation_id',$variationOpt->id)->first() : null;
                                                                    @endphp
                                                                    {!! ($promotionPrice) ? convert_price($promotionPrice->price,$currency) : (($variationOpt) ? convert_price($variationOpt->price,$currency) : convert_price(0,$currency)) !!}
                                                                </span>
                                                                @if($type == 'optional')
                                                                    <span class="shp-cart-product_close pointer position-absolute remove-from-cart"
                                                                          data-uid="{{ $vid->id }}">
                                                                        <svg viewBox="0 0 8 8" width="8px" height="8px">
                                                                            <path fill-rule="evenodd"
                                                                                  fill="rgb(171, 168, 182)"
                                                                                  d="M7.841,7.211 L4.615,3.985 L7.841,0.759 C8.015,0.585 8.015,0.304 7.841,0.130 C7.667,-0.044 7.386,-0.044 7.212,0.130 L3.985,3.356 L0.759,0.130 C0.584,-0.044 0.303,-0.044 0.129,0.130 C-0.045,0.304 -0.045,0.586 0.129,0.760 L3.356,3.985 L0.130,7.211 C-0.045,7.385 -0.045,7.666 0.130,7.840 C0.216,7.927 0.330,7.971 0.444,7.971 C0.558,7.971 0.672,7.927 0.759,7.840 L3.985,4.614 L7.212,7.840 C7.386,8.014 7.667,8.014 7.841,7.840 C7.928,7.753 7.972,7.639 7.972,7.526 C7.972,7.412 7.928,7.298 7.841,7.211 Z"/>
                                                                        </svg>
                                                                    </span>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    @endif

                                                    @if($countMessage)
                                                        <li>No Extra items</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </td>

                                    <td width="180" class="text-center">
                                        <div class="simple_select_wrapper">
                                            <div class="continue-shp-wrapp_qty position-relative"
                                                 style="margin-right: 0;">
                                                <!--minus qty-->
                                                <span data-type="minus" data-condition="{{ false }}"
                                                      data-uid="{{ $main->id }}"
                                                      class="d-inline-block pointer position-absolute continue-shp-wrapp_qty-minus qty-count qtycount">
                                                    <svg viewBox="0 0 20 3" width="20px" height="3px">
                                                        <path fill-rule="evenodd" fill="rgb(214, 217, 225)"
                                                              d="M20.004,2.938 L-0.007,2.938 L-0.007,0.580 L20.004,0.580 L20.004,2.938 Z"></path>
                                                    </svg>
                                                </span>


                                                <input data-uid="{{ $main->id }}"
                                                       class="qtycount field-input w-100 h-100 font-23 text-center border-0 product-qty-select"
                                                       min="number" name="" type="number" value="{{ $main->quantity }}">
                                                <!--plus qty-->
                                                <span data-type="plus" data-condition="{{ true }}"
                                                      data-uid="{{ $main->id }}" data-uid="{{ $main->id }}"
                                                      class="d-inline-block pointer position-absolute continue-shp-wrapp_qty-plus qty-count qtycount">
                                                    <svg viewBox="0 0 20 20" width="20px" height="20px">
                                                        <path fill-rule="evenodd" fill="rgb(211, 214, 223)"
                                                              d="M20.004,10.938 L11.315,10.938 L11.315,20.000 L8.696,20.000 L8.696,10.938 L-0.007,10.938 L-0.007,8.580 L8.696,8.580 L8.696,0.007 L11.315,0.007 L11.315,8.580 L20.004,8.580 L20.004,10.938 Z"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </td>


                                    <td width="180" class="shp-cart-table_price-td">
                                        <span class="d-flex font-main-bold font-28 card--inner-product_price position-relative">
                                            <span class="position-relative">{{ convert_price(\App\Services\CartService::getPriceSum($main->id),$currency) }}
                                                {{--<!--old price-->--}}
                                                {{--<span class="position-absolute align-self-end font-16 text-gray-clr card--inner-product_old-price old-price-bottom">$100</span>--}}
                                            </span>
                                        </span>
                                    </td>
                                </tr>

                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-3 pr-md-right">
                <div class="right-content">
                    <h3 class=" head font-main-bold font-20 text-uppercase">ORDER
                        SUMMARY</h3>
                    <div class="card order-summary">
                        <div class="card-header border-bottom-0 font-13">
                            You will earn <span class="font-main-bold">200 points.</span>
                        </div>
                        <div class="card-body border-top-0">
                            <div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="name">
                                    Sub Total
                                </div>
                                <div class="price font-main-bold">{!! convert_price(\Cart::getSubTotal(),$currency) !!}</div>
                            </div>
                            <div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="name">
                                    Tax
                                </div>
                                <div class="price font-main-bold">{!! convert_price(0,$currency) !!}</div>
                            </div>
                            <div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="name">
                                    Shipping {!! ($shipping) ? '('.$shipping->getAttributes()->courier->name.')' : '' !!}
                                </div>
                                <div class="price font-main-bold">{!! ($shipping) ? convert_price($shipping->getValue(),$currency) : convert_price(0,$currency) !!}</div>
                            </div>
                            <div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="name">
                                    Discount (Coupon)
                                </div>
                                <div class="price font-main-bold">{{ convert_price(0,$currency) }}</div>
                            </div>
                            <div class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="name">
                                    Total
                                </div>
                                <div class="price font-main-bold">{!! convert_price(\Cart::getTotal(),$currency) !!}</div>
                            </div>
                            <div class="coupon-code font-17 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="name">
                                    Coupon code
                                </div>
                                <div class="code">
                                    <input type="text" class="form-control" name="coupon_code" id="coupon_code">
                                </div>
                            </div>
                            <div class="checkout-btn text-center">
                                <a class="btn btn-primary text-uppercase font-15"
                                   href="{!! route('shop_check_out') !!}">
                                    CHECKOUT
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="secure d-flex flex-wrap justify-content-between align-items-center">
                        <span class="secure-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="26px">
                                <path fill-rule="evenodd" fill="rgb(81, 132, 229)"
                                      d="M12.000,26.000 C0.711,21.986 0.882,13.191 1.034,5.421 C1.043,4.954 1.052,4.502 1.057,4.059 C5.462,3.878 8.985,2.571 12.000,-0.000 C15.016,2.571 18.538,3.878 22.945,4.059 C22.950,4.502 22.959,4.954 22.969,5.421 C23.121,13.189 23.290,21.986 12.000,26.000 ZM21.282,5.596 C17.725,5.220 14.666,4.076 12.000,2.125 C9.335,4.076 6.276,5.220 2.720,5.596 C2.647,9.347 2.587,13.215 3.816,16.559 C5.134,20.144 7.742,22.594 12.000,24.232 C16.259,22.594 18.867,20.144 20.185,16.558 C21.415,13.213 21.355,9.346 21.282,5.596 ZM10.783,17.740 C10.783,17.740 10.288,17.352 10.126,17.226 L5.719,13.776 C5.716,13.772 5.716,13.772 5.713,13.769 L6.869,12.462 L10.576,15.367 L17.033,8.254 L18.365,9.386 L11.339,17.127 C11.164,17.316 10.783,17.740 10.783,17.740 Z"/>
                            </svg>
                        </span>
                        <p class="mb-0 font-12">
                            Full Refund if you don't receive your order. <br>
                            Full or Partial Refund, if the item is not as described.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>