<div class="card order-summary">
    <div class="card-header text-tert-clr font-26">
        {!! __('order_summary') !!}
    </div>
    <div class="card-body border-top-0">
        <div
            class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
            <div class="name">
                {!! __('sub_total') !!}
            </div>
            <div
                class="price font-main-bold">{!! convert_price(\Cart::session('wholesaler')->getSubTotal(),$currency, false) !!}</div>
        </div>
        <div
            class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
            <div class="name">
                {!! __('tax') !!}
            </div>
            <div
                class="price font-main-bold">{!! convert_price(0,$currency, false) !!}</div>
        </div>
        <div
            class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
            <div class="name">
                {!! __('shipping') !!} {!! ($shipping) ? '('.$shipping->getAttributes()->courier->name.')' : '' !!}
            </div>
            <div
                class="w-100 d-flex flex-wrap justify-content-between align-items-center row_with-select">
                <div class="select-wall">
                    <select name="" id=""
                            class="select-2 select-2--no-search main-select not-selected arrow-dark select2-hidden-accessible"
                            style="width: 175px">
                        <option value="">{!! __('united_kingdom') !!}</option>
                        <option value="">{!! __('armenia') !!}</option>
                    </select>
                </div>
                <div
                    class="price font-main-bold">{!! ($shipping) ? convert_price($shipping->getValue(),$currency, false) :
                    convert_price(0,$currency, false) !!}</div>
            </div>

        </div>
        <div
            class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center">
            <div
                class="w-100 d-flex flex-wrap justify-content-between align-items-center">
                <div class="name">
                    {!! __('coupon_discount') !!}
                </div>
                @php
                    $coupons = \Cart::session('wholesaler')->getConditionsByType('coupon');
                @endphp
                @if($coupons && count($coupons))
                    @foreach($coupons as $c)
                        <div class="price font-main-bold">
                            {{ $c->getValue() }}
                        </div>
                    @endforeach
                @else

                @endif
            </div>
            <div class="w-100 row_with-select">
                <div class="code">
                    <input type="text" class="form-control" name="coupon_code"
                           id="coupon_code">
                    <div id="coupon_require_error"></div>
                </div>
            </div>

        </div>
        <div
            class="single-row font-17 d-flex flex-wrap justify-content-between align-items-center border-bottom-0">
            <div class="name">
                {!! __('total') !!}
            </div>
            <div
                class="price text-tert-clr font-main-bold">{!! convert_price(\Cart::session('wholesaler')->getTotal(),$currency, false) !!}</div>
        </div>

        <div class="order-summary-btn-wall text-center mb-2 @if(isset($pyp)) checkout-btn @endif">
            @if(! isset($pyp))
                @if(isset($checkout) && $checkout)
                    @if(Auth::check())
                        @if($default_shipping)
                            <a class="order-summary-btn font-sec-reg text-uppercase font-24 text-sec-clr shop-detail-btn go-to-payment"
                               href="javascript:void(0)">
                                {!! __('checkout') !!}
                            </a>
                        @else

                            <a class="order-summary-btn font-sec-reg text-uppercase font-24 text-sec-clr shop-detail-btn address-book-new"
                               href="javascript:void(0)">
                                {!! __('checkout') !!}
                            </a>
                        @endif
                    @endif
                @else
                    <a class="order-summary-btn font-sec-reg text-uppercase font-24 text-sec-clr shop-detail-btn"
                       href="{{ @$submit_route }}">
                        {!! __('shopping_details') !!}
                    </a>
                @endif
            @endif

        </div>
        <div class="order-summary-btn-wall text-center">
            <a class="order-summary-btn font-sec-reg text-uppercase font-24 text-main-clr back-btn"
               href="{{ @$back_route }}">
                {!! __('back') !!}
            </a>
        </div>
    </div>
</div>
