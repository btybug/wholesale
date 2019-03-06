<div class="row">
    <div class="col-12 col-lg-8 cart-left">
        <div class="row">
            <form method='POST' id="update_cart_form"
                  action='http://demo.laravelcommerce.com/updateCart'>
                <div class="table-responsive">
                    <table class="table table-bordered cart-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th align="left">Product</th>
                            <th align="right">Qty</th>
                            <th align="right">Price</th>
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
                                    <td valign="center" align="center">
                                        <a data-uid="{{ $main->id }}" href="javascript:void(0)"
                                           class="btn btn-danger btn-sm remove-from-cart"><i
                                                    class="fa fa-times"></i></a>
                                    </td>
                                    <td class="table-product">
                                        <div class="d-flex">
                                            <div class="col-4 p-0">
                                                <div class="image-name">
                                                    <img class="img-responsive w-100" src="{{ $stock->image }}" alt=" {!! $stock->name !!}">
                                                    <div class="name">
                                                        {!! $stock->name !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="procudt-info">
                                                    <div class="procudt-main">

                                                        <div class="single">
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                            <span class="title">
                                                                {{ $main->attributes->variation->name }}
                                                            </span>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="d-flex flex-wrap">
                                                                        @if($stock->type == 'variation_product')
                                                                            @foreach($main->attributes->variation->options as $voption)
                                                                                <div class="h5 mr-1"><span class="badge badge-secondary">{{ $voption->attribute_sticker->sticker->name }}</span></div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2 align-self-center">
                                                                    <div class="h5"><span class="badge badge-secondary">${{ $main->price }}</span></div>
                                                                </div>
                                                                <div class="col-sm-2">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="product-extra">
                                                        <h4>Extra</h4>
                                                        @php
                                                            $countMessage = true;
                                                        @endphp
                                                        @if($main->attributes->requiredItems && count($main->attributes->requiredItems))
                                                            @php
                                                                $countMessage = false;
                                                            @endphp
                                                            @foreach($main->attributes->requiredItems as $vid)
                                                                <div class="single">
                                                                    @php
                                                                        $variationReq = \App\Services\CartService::getVariation($vid)
                                                                    @endphp
                                                                    <div class="row">
                                                                        <div class="col-sm-2">
                                                                    <span class="title">
                                                                        {{ $variationReq->stock->name }}
                                                                    </span>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="d-flex flex-wrap">
                                                                                @if($variationReq->stock->type == 'variation_product')
                                                                                    @foreach($variationReq->options as $voption)
                                                                                        <div class="h5 mr-1"><span class="badge badge-secondary">{{ $voption->attribute_sticker->sticker->name }}</span></div>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-2 align-self-center">
                                                                            @php
                                                                                $promotionPrice = ($variationReq) ? $variationReq->stock->promotion_prices()
                                                                                ->where('variation_id',$variationReq->id)->first() : null;
                                                                            @endphp
                                                                            <div class="h5"><span class="badge badge-secondary">
                                                                            {!! ($promotionPrice) ? "$" . $promotionPrice->price : (($variationReq) ? "$" . $variationReq->price : 0) !!}
                                                                        </span></div>
                                                                        </div>
                                                                        <div class="col-sm-2">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif

                                                        @if(count($item))
                                                            @php
                                                                $countMessage = false;
                                                            @endphp
                                                            @foreach($item as $vid)
                                                                <div class="single">
                                                                    @php
                                                                        $variationOpt = $vid->attributes->variation
                                                                    @endphp
                                                                    <div class="row">
                                                                        <div class="col-sm-2">
                                                                    <span class="title">
                                                                        {{ $variationOpt->stock->name }}
                                                                    </span>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="d-flex flex-wrap">
                                                                                @if($variationOpt->stock->type == 'variation_product')
                                                                                    @foreach($variationOpt->options as $voption)
                                                                                        <div class="h5 mr-1"><span class="badge badge-primary">{{ $voption->option->name }}</span></div>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-sm-2 align-self-center">
                                                                            @php
                                                                                $promotionPrice = ($variationOpt) ? $variationOpt->stock->promotion_prices()
                                                                                ->where('variation_id',$variationOpt->id)->first() : null;
                                                                            @endphp
                                                                            <div class="h5"><span class="badge badge-secondary">
                                                                            {!! ($promotionPrice) ? "$" . $promotionPrice->price : (($variationOpt) ? "$" . $variationOpt->price : 0) !!}
                                                                        </span></div>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <a data-uid="{{ $variationOpt->id }}" href="javascript:void(0)"
                                                                               class="btn btn-danger btn-sm remove-from-cart"><i
                                                                                        class="fa fa-times"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif

                                                        @if($countMessage)
                                                            <h5>No Extra items</h5>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td valign="center" align="center" class="Qty w-8">
                                        <div class="input-group">
                                              <span data-condition="{{ false }}" data-uid="{{ $main->id }}"
                                                    class="input-group-btn qtycount">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                              </span>
                                            <input name="quantity[]" type="text" readonly
                                                   value="{{ $main->quantity }}"
                                                   class="form-control qty">
                                            <span data-condition="{{ true }}" data-uid="{{ $main->id }}" class="input-group-btn qtycount">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                              </span>
                                        </div>
                                    </td>
                                    <td valign="center" align="center" class="w-8">
                                <span>
                                    ${{ \App\Services\CartService::getPriceSum($main->id) }}
                                </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="row button back-update-btn">
            <div class="col-12 col-sm-6">
                <div class="row">
                    <a href="http://demo.laravelcommerce.com/shop" class="btn btn-dark">Back To
                        Shopping</a>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="row justify-content-end">
                    <button class="btn btn-dark" id="update_cart">Update Cart</button>
                </div>
            </div>
        </div>
        <div class="row button back-update-btn">
            @if($geoZone)
                <span>*</span> Your Shipping cost based on &nbsp;<strong> {{ $geoZone->name }} </strong>
            @endif
        </div>
    </div>
    <div class="col-12 col-lg-4 cart-right">
        <div class="order-summary-outer">
            <div class="order-summary">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th align="left" colspan="2">Order Summary</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td align="left"><span>Sub Total</span></td>
                            <td align="right" id="subtotal">
                                ${!! \Cart::getSubTotal() !!}
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><span>Tax</span></td>
                            <td align="right" id="subtotal">$0</td>
                        </tr>
                        <tr>
                            <td align="left">
                                <span>Shipping {!! ($shipping) ? '('.$shipping->getAttributes()->courier->name.')' : '' !!}</span>
                            </td>
                            <td align="right" id="subtotal">${!! ($shipping) ? $shipping->getValue():0 !!}</td>
                        </tr>
                        <tr>
                            <td align="left"><span>Discount (Coupon)</span></td>
                            <td align="right" id="discount">$0</td>
                        </tr>
                        <tr>
                            <td class="last" align="left"><span>Total</span></td>
                            <td class="last" align="right" id="total_price">
                                ${!! \Cart::getTotal() !!}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="coupons">
                <!-- applied copuns -->

                <form id="apply_coupon" class="form-validate">
                    <div class="form-group">
                        <label>Coupon Code</label>
                        <input type="text" name="coupon_code" class="form-control" id="coupon_code">

                        <div id="coupon_error" class="help-block" style="display: none"></div>
                        <div id="coupon_require_error" class="help-block" style="display: none">Please
                            enter
                            a valid coupon code
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-dark">Apply Coupon</button>
                </form>


            </div>

            <div class="buttons">
                <a href="{!! route('shop_check_out') !!}" class="btn btn-block btn-secondary">Proceed
                    To Checkout</a>
            </div>
        </div>
    </div>


</div>