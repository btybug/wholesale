<div id="singleProductPageCnt" class="shopping-cart-content-wholesaler">
    <div class="shopping-cart-inner">
        <div class="d-flex flex-wrap">
            <div class="col-lg-10 pl-0">
                @if(! \Cart::session('wholesaler')->isEmpty())
                    <div class="shopping__cart-tab-main new__scroll h-100">
                        @foreach(\Cart::session('wholesaler')->getContent() as $key => $item)
                            @php
                                $stock = $item->attributes->item;
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

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="main-info-td">

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
                                                        {{ convert_price($item->price * $item->quantity,$currency,true) }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>

                                    </table>
                                </div>

                                <a href="javascript:void(0)" data-uid="{{ $item->id }}" class="remove-btn remove-from-cart">
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
                    @include("frontend.wholesaler._partials.order_summary",['submit_route' => route("wholesaler_check_out"),
                    "back_route" => route("wholesaler")])
                </div>
            </div>
        </div>
    </div>
</div>
