<div id="singleProductPageCnt" class="shopping-cart-content">
    <div class="shopping-cart-inner">
        <div class="d-flex flex-wrap">
            <div class="col-lg-10 pl-0">

                    <div class="d-flex shopping-cart-head">
                        {{--                    <div class="shopping-cart-head-back-btn">--}}

                        {{--                    </div>--}}
                        <ul class="nav nav-pills">
                            <li class="nav-item col-md-3">
                                <a class="item active d-flex align-items-center justify-content-between"
                                   ref="javascript:void(0);">
                                    <span class="font-sec-reg text-main-clr num">1</span>
                                    <span
                                        class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('shopping_cart') !!}</span>
                                    <span class="icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                                </a>
                            </li>
                            <li class="nav-item col-md-3">
                                <a class="item d-flex align-items-center justify-content-between"
                                   href="javascript:void(0);">
                                    <span class="font-sec-reg text-main-clr num">2</span>
                                    <span class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('checkout') !!}</span>
                                    <span class="icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                                </a>
                            </li>
                            <li class="nav-item col-md-3">
                                <a class="item d-flex align-items-center justify-content-between"
                                   href="javascript:void(0);">
                                    <span class="font-sec-reg text-main-clr num">3</span>
                                    <span class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('payment') !!}</span>
                                    <span class="icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                                </a>
                            </li>
                            <li class="nav-item col-md-3">
                                <a class="item d-flex align-items-center justify-content-between"
                                   href="javascript:void(0);">
                                    <span class="font-sec-reg text-main-clr num">4</span>
                                    <span
                                        class="name text-uppercase font-main-bold font-16 text-truncate">{!! __('confirmation') !!}</span>
                                    <span class="icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="19px">
<path fill-rule="evenodd" fill="rgb(81, 229, 109)"
      d="M7.636,15.030 L1.909,9.075 L-0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
</svg>
                                </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                @if(! \Cart::isEmpty())
                    <div class="shopping__cart-tab-main new__scroll h-100">
                        @foreach(\Cart::getContent() as $key => $item)
                            @php
                                $stock = $item->attributes->product;
                            @endphp
                            <div class="shopping__cart-tab-table-wall position-relative" data-uid="{{$key}}">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td class="photo-td">
                                                <div class="product-photo-col">
                                                    <img src="{{ checkImage($stock->image) }}"
                                                         alt=" {!! $stock->name !!}">

                                                    {{--<img src="{{ checkImage(media_image_tmb($stock->image)) }}"--}}
                                                         {{--alt=" {!! $stock->name !!}">--}}
                                                </div>
                                            </td>
                                            <td class="info-td">
                                                <div class="product-info-col">
                                                    <h3 class="font-sec-reg font-28 text-tert-clr lh-1 text-uppercase first-title">
                                                        {!! $stock->name !!} </h3>
                                                    <div
                                                        class="font-sec-reg font-26 text-main-clr lh-1 sec-title">
                                                        {!! $stock->short_description !!}
                                                    </div>
                                                    <div class="d-flex align-items-center edit-favourite">
                                                    <span class="icon">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            width="32px" height="31px" viewBox="0 0 31 32">
                                                    <path fill-rule="evenodd" stroke-width="2px"
                                                          stroke="rgb(53, 53, 53)" opacity="0.702"
                                                          fill="rgb(255, 255, 255)"
                                                          d="M21.852,2.990 C19.636,2.990 17.428,4.080 15.999,5.846 C14.571,4.080 12.363,2.990 10.147,2.990 C6.125,2.990 3.001,6.258 3.001,10.466 C3.001,15.639 7.419,19.857 14.178,26.113 L15.999,28.011 L17.821,26.113 C24.580,19.857 28.998,15.639 28.998,10.466 C28.998,6.258 25.875,2.990 21.852,2.990 L21.852,2.990 Z"/>
                                                    </svg>
                                                    </span>
                                                        <a href="#"
                                                           class="text-tert-clr font-18 lh-1 edit-link">{!! __('edit') !!}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="main-info-td">
                                                <div class="product-main-info">
                                                    <ul class="list-unstyled mb-0">
                                                        @foreach($item->attributes->variations as $option)

                                                            @if($option['group']->price_per =='product' || $option['group']->discount)
                                                                <li class="single-row-product">
                                                                    <div class="d-flex flex-column w-100 col-9 p-0">
                                                                        @if(count($option['options']))
                                                                            @foreach($option['options'] as $voption)

                                                                                <div class="w-100">
                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-sm-8 font-15 font-main-bold">
                                                                                            {{ $voption['option']->item->short_name }}

                                                                                        </div>
                                                                                        <div
                                                                                            class="col-sm-2 font-main-bold pl-prod-qty-opt                                                                                                                                                                                    ">
                                                                                            <span>x {{ $voption['qty'] }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    <div
                                                                        class="font-15 font-main-bold align-self-center col-3 pr-0 text-right">
                                                                        {!!  convert_price($option['price'],$currency, false)  !!}
                                                                    </div>
                                                                </li>
                                                            @else
                                                                @if(count($option['options']))
                                                                    @foreach($option['options'] as $voption)
                                                                        @php
                                                                            if($voption['option']->price_per == 'discount'){
                                                                                $price = 0;
                                                                            }else{
                                                                                if($voption['option']->price_type == 'fixed'){
                                                                                    $price = 0;
                                                                                    $discount = \App\Models\StockVariationDiscount::find($voption['discount_id']);
                                                                                    if($discount){
                                                                                        $price = $discount->price;
                                                                                    }
                                                                                }else if($voption['option']->price_type == 'range'){
                                                                                    $price = 0;
                                                                                    $discount = $voption['option']->discounts()->where('from','<=',$voption['qty'])->where('to','>=',$voption['qty'])->first();
                                                                                    if($discount){
                                                                                        $price = $discount->price* $voption['qty'];
                                                                                    }
                                                                                }else if($voption['option']->price_type == 'dynamic'){
                                                                                    $price = $voption['option']->item->default_price * $voption['qty'];
                                                                                }else{
                                                                                    $price = $voption['option']->price * $voption['qty'];
                                                                                }
                                                                            }

                                                                        @endphp
                                                                        <li class="single-row-product">
                                                                            <div
                                                                                class="d-flex flex-column w-100 col-9 p-0">
                                                                                <div class="w-100">
                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-sm-8 font-15 font-main-bold">
                                                                                            {{ $voption['option']->item->short_name }}
                                                                                            @if(isset($discount) && $voption['option']->price_type == 'fixed')
                                                                                                ({{ "Pack of $discount->qty" }})
                                                                                            @endif
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-sm-2 font-main-bold pl-prod-qty-opt                                                                                                                                                                                    ">
                                                                                            <span>x {!! $voption['qty'] !!}</span>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div
                                                                                class="font-15 font-main-bold align-self-center col-3 pr-0 text-right">
                                                                                {!!  convert_price($price,$currency, false)  !!}
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                @else
                                                                    <li class="single-row-product">
                                                                        <div
                                                                            class="d-flex flex-column w-100 col-9 p-0">
                                                                            <div class="w-100">
                                                                                <div class="row">
                                                                                    <div
                                                                                        class="col-sm-8 font-15 font-main-bold">
                                                                                        {{ $option['group']->item->short_name }}

                                                                                    </div>
                                                                                    <div
                                                                                        class="col-sm-2 font-main-bold pl-prod-qty-opt                                                                                                                                                                                    ">
                                                                                        <span>x 0</span>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div
                                                                            class="font-15 font-main-bold align-self-center col-3 pr-0 text-right">
                                                                            {!!  convert_price($option['price'],$currency, false)  !!}
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                            @endif

                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </td>
                                            <td class="qty-td">
                                                <div class="d-flex align-items-center qty-col">
                                                    <span class="font-sec-light font-24 lh-1">{!! __('qty') !!}</span>
                                                    <div class="product__single-item-inp-num">
                                                        <div class="quantity">
                                                            <input type="number" min="1" step="1"
                                                                   value="{{ $item->quantity }}">
                                                            <div class="inp-icons">
                                                                <span class="inp-up"></span>
                                                                <span class="inp-down"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="price-td">
                                                <div class="price-col">
                                                    <span class="lh-1 text-tert-clr">
                                                        {{ convert_price(\App\Services\CartService::getPriceSum($item->id),$currency,true) }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                        @if(! $stock->is_offer)
                                            <tfoot>
                                            <tr>
                                                <td colspan="5">
                                                    <div class=" d-flex footer">
                                                        <div class="add-offers font-26 font-sec-reg" style="width: min-content">{!! __('added_offers') !!}
                                                        </div>
                                                        <ul class="d-flex flex-wrap list-product">
                                                            @if($item->attributes->has('extra') && isset($item->attributes->extra['data']))
                                                            @foreach($item->attributes->extra['data'] as $extra)
                                                                    <li class="single-wall">
                                                                        <div class="photo-item">
                                                                            <img src="{{ checkImage($extra['offer']->image) }}"
                                                                                 alt="product">
                                                                        </div>
                                                                        <div class="info-product">
                                                                            <h6 class="font-21 text-tert-clr title">
                                                                            {{ $extra['offer']->item->short_name }}
                                                                            </h6>
                                                                            <div
                                                                                class="d-flex align-items-center price-wall">
                                                                                <span class="price">
                                                                                    {!! convert_price($extra['price'],$currency) !!}
                                                                                </span>
                                                                                <a  href="javascript:void(0)" data-section-id="{{ $key }}" data-uid="{{ $extra['key'] }}" class="remove-btn remove-extra-from-cart">
                                                                                    {!! __('remove') !!}
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            @else
                                                                <li class="single-wall no-product">
                                                                    <span class="font-26">{!! __('no_offer_added') !!}</span>
                                                                </li>
                                                            @endif

                                                        </ul>
                                                        <a href="javascript:void(0)" data-uid="{{ $key }}"
                                                           class="d-flex flex-column align-items-center justify-content-center text-sec-clr bg-blue-clr add-offers-btn">
                                                                            <span class="icon"><i
                                                                                    class="fas fa-plus"></i></span>
                                                            <div class="text" style="width: min-content">
                                                                {!! __('added_offers') !!}
                                                            </div>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        @endif
                                    </table>
                                </div>

                                <a href="javascript:void(0)" data-uid="{{ $key }}" class="remove-btn remove-from-cart">
                                    Remove
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-lg-2 pr-md-right">
                <div class="right-content order-summary">
                    {{--                        SUMMARY</h3>--}}
                    @include("frontend.shop._partials.order_summary",['page' =>'cart','submit_route' => route("shop_check_out"),"back_route" => route("home")])
                </div>
            </div>
        </div>
    </div>
</div>
