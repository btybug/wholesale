<div class="col-sm-12">
    <div class="col-lg-10 pl-0">
        @if(! \Cart::session(\App\Models\Orders::ORDER_NEW_SESSION_ID)->isEmpty())
            <div class="shopping__cart-tab-main new__scroll h-100">
                @foreach(\Cart::session(\App\Models\Orders::ORDER_NEW_SESSION_ID)->getContent() as $key => $item)
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
                                            <img src="{{ checkImage($stock->image) }}" width="200"
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
                                                   class="text-tert-clr font-18 lh-1 edit-link">Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="main-info-td">
                                        <div class="product-main-info">
                                            <ul class="list-unstyled mb-0">
                                                @foreach($item->attributes->variations as $option)

                                                    @if($option['group']->price_per =='product')
                                                        <li class="single-row-product">
                                                            <div class="d-flex flex-column w-100 col-9 p-0">
                                                                @if(count($option['options']))
                                                                    @foreach($option['options'] as $voption)

                                                                        <div class="w-100">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-sm-8 font-15 font-main-bold">
                                                                                    {{ $voption['option']->name }}

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
                                                                {!!  convert_price($option['group']->price,$currency, false)  !!}
                                                            </div>
                                                        </li>
                                                    @else
                                                        @if(count($option['options']))
                                                            @foreach($option['options'] as $voption)
                                                                @php
                                                                    if($voption['option']->price_type == 'discount'){
                                                                        if($voption['option']->discount_type =='fixed'){
                                                                            $price = 0;
                                                                            $discount = \App\Models\StockVariationDiscount::find($voption['discount_id']);
                                                                            if($discount){
                                                                                $price = $discount->price;
                                                                            }
                                                                        }else{
                                                                            $price = 0;
                                                                            $discount = $voption['option']->discounts()->where('from','<=',$voption['qty'])->where('to','>=',$voption['qty'])->first();
                                                                            if($discount){
                                                                                $price = $discount->price* $voption['qty'];
                                                                            }
                                                                        }
                                                                    }else{
                                                                        $price = $voption['option']->price * $voption['qty'];
                                                                    }
                                                                @endphp
                                                                <li class="single-row-product">
                                                                    <div
                                                                        class="d-flex flex-column w-100 col-9 p-0">
                                                                        <div class="w-100">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-sm-8 font-15 font-main-bold">
                                                                                    {{ $voption['option']->name }}
                                                                                    @if(isset($discount) && $voption['option']->discount_type == 'fixed')
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
                                                        @endif
                                                    @endif

                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="qty-td">
                                        <div class="d-flex align-items-center qty-col">
                                            <span class="font-sec-light font-24 lh-1">QTY</span>
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
                                {{--@if(! $stock->is_offer)--}}
                                    {{--<tfoot>--}}
                                    {{--<tr>--}}
                                        {{--<td colspan="5">--}}
                                            {{--<div class=" d-flex footer">--}}
                                                {{--<div class="add-offers font-26 font-sec-reg">Added <br/>Offers--}}
                                                {{--</div>--}}
                                                {{--<ul class="d-flex flex-wrap list-product">--}}
                                                    {{--@if($item->attributes->has('extra') && isset($item->attributes->extra['data']))--}}
                                                        {{--@foreach($item->attributes->extra['data'] as $extra)--}}
                                                            {{--<li class="single-wall">--}}
                                                                {{--<div class="photo-item">--}}
                                                                    {{--<img src="{{ checkImage($extra['offer']->image) }}"--}}
                                                                         {{--alt="product">--}}
                                                                {{--</div>--}}
                                                                {{--<div class="info-product">--}}
                                                                    {{--<h6 class="font-21 text-tert-clr title">--}}
                                                                        {{--{{ $extra['offer']->name }}--}}
                                                                    {{--</h6>--}}
                                                                    {{--<div--}}
                                                                        {{--class="d-flex align-items-center price-wall">--}}
                                                                                {{--<span class="price">--}}
                                                                                    {{--{!! convert_price($extra['price'],$currency) !!}--}}
                                                                                {{--</span>--}}
                                                                        {{--<a  href="javascript:void(0)" data-section-id="{{ $key }}" data-uid="{{ $extra['key'] }}" class="remove-btn remove-extra-from-cart">--}}
                                                                            {{--Remove--}}
                                                                        {{--</a>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</li>--}}
                                                        {{--@endforeach--}}
                                                    {{--@else--}}
                                                        {{--<li class="single-wall no-product">--}}
                                                            {{--<span class="font-26">No offer is added</span>--}}
                                                        {{--</li>--}}
                                                    {{--@endif--}}

                                                {{--</ul>--}}
                                                {{--<a href="javascript:void(0)" data-uid="{{ $key }}"--}}
                                                   {{--class="d-flex flex-column align-items-center justify-content-center text-sec-clr bg-blue-clr add-offers-btn">--}}
                                                                            {{--<span class="icon"><i--}}
                                                                                    {{--class="fas fa-plus"></i></span>--}}
                                                    {{--<div class="text">--}}
                                                        {{--Added <br/>Offers--}}
                                                    {{--</div>--}}
                                                {{--</a>--}}
                                            {{--</div>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                    {{--</tfoot>--}}
                                {{--@endif--}}
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

</div>
