@if(\Cart::isEmpty())
    <!--Empty Card Message-->
    <p id="cartSidebarEmptyMsg" class="cart-sidebar_item-empty-msg text-sec-clr text-center font-sec-bold font-20">Cart is Empty</p>
@else
    @foreach(\Cart::getContent() as $item)
        @php
            $stock = $item->attributes->variation->stock
        @endphp
    <!--Repeating cart item-->
    <div class="cart-sidebar_item text-sec-clr w-100 position-relative">
        <div class="row mb-3">
            <div class="col-5">
                <div class="cart-sidebar_item-img-holder">
                    <img
                         src="{{ checkImage($stock->image) }}"
                         alt="{!! $stock->name !!}">
                </div>
            </div>
            <div class="col-7">
                <h3 class="font-20 font-sec-bold">{!! $stock->name !!}</h3>
                <div class="font-main-light text-sec-clr">
                    @if($stock->type == 'variation_product')
                        @foreach($item->attributes->variation->options as $voption)
                            @if($voption->attribute_sticker)
                            <span class="d-block">{{ $voption->attribute_sticker->attr->name }} : {{ $voption->attribute_sticker->sticker->name }}</span>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-5">
                <div class="form-group mb-0">
                    <label class="cart-product-qty-label text-white font-main-light" for="cartProductqQty-1">QTY&nbsp;:&nbsp;</label>
                    {!! Form::number('',$item->quantity,['class' => 'cart-product-qty-select qty-input','min' => '1','data-uid' => $item->id]) !!}
                </div>
            </div>
            <div class="col-7">
                <span class="d-block cart-product-price font-24 font-sec-bold cart-product-price">{{ convert_price($item->price,$currency) }}</span>
            </div>
        </div>
        <a data-uid="{{ $item->id }}" class="remove-from-cart cart-sidebar_item-close d-inline-block position-absolute pointer d-flex align-items-center justify-content-center">
                <svg width="16px" height="16px" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                          d="M15.120,-0.000 L7.996,7.177 L0.818,0.053 L-0.000,0.879 L7.177,8.003 L0.053,15.180 L0.879,16.000 L8.003,8.823 L15.180,15.946 L16.000,15.121 L8.822,7.997 L15.946,0.820 L15.120,-0.000 Z"/>
                </svg>
            </a>
    </div>
    @endforeach
@endif


<!--Subtotal-->
<div class="mt-auto w-100">
    <div class="d-flex align-items-center justify-content-end w-100 mb-4">
        <span class="d-inline-block font-18 text-sec-clr mr-3">Subtotal:</span>
        <span class="d-block cart-product-price font-24 font-sec-reg text-sec-clr">{{  convert_price(\Cart::getSubTotal(),$currency) }}</span>
    </div>
    <!--cart btn-s-->
    <div class="d-flex justify-content-between w-100">
        <a href="{!! route('shop_my_cart') !!}" class="cart-sidebar_view-btn btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase text-sec-clr rounded-0 pointer">View Cart</a>
        @if(! \Cart::isEmpty())
            <a href="{!! route('shop_check_out') !!}" class="cart-sidebar_check-btn btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase rounded-0 text-tert-clr pointer">Checkout</a>
        @endif
    </div>

</div>

