<li class="shp-cart-product_row d-flex justify-content-between position-relative pr-0 py-2 border-bottom">
                     <span class="pointer remove-from-cart"
                           data-uid="{{ $extra['group']->variation_id }}">
            <svg viewBox="0 0 8 8" width="8px" height="8px">
                <path fill-rule="evenodd"
                      fill="rgb(171, 168, 182)"
                      d="M7.841,7.211 L4.615,3.985 L7.841,0.759 C8.015,0.585 8.015,0.304 7.841,0.130 C7.667,-0.044 7.386,-0.044 7.212,0.130 L3.985,3.356 L0.759,0.130 C0.584,-0.044 0.303,-0.044 0.129,0.130 C-0.045,0.304 -0.045,0.586 0.129,0.760 L3.356,3.985 L0.130,7.211 C-0.045,7.385 -0.045,7.666 0.130,7.840 C0.216,7.927 0.330,7.971 0.444,7.971 C0.558,7.971 0.672,7.927 0.759,7.840 L3.985,4.614 L7.212,7.840 C7.386,8.014 7.667,8.014 7.841,7.840 C7.928,7.753 7.972,7.639 7.972,7.526 C7.972,7.412 7.928,7.298 7.841,7.211 Z"/>
        </svg>
    </span>
    <div class="m-0 row w-100">
        <div class="col-sm-3 pl-0  font-main-bold">{{ $extra['group']->title }}: </div>
        <div class="col-sm-9 pr-0 font-main-bold">
            <div class="d-flex justify-content-between">
                <div class="w-100">
                    @if($extra['group']->type == 'package_product' || $extra['group']->type == 'filter')
                        @if(count($extra['options']))
                            @foreach($extra['options'] as $voption)
                                <div class="row">
                                    <div class="col-sm-6 pl-2 font-15 font-main-bold">
                                        {{ $voption->name }}
                                    </div>

                                    <div class="col-sm-2
                                                                                        @if($extra['group']->price_per=='product')
                                        pl-prod-qty
@else
                                        pl-qty
@endif
                                        ">
                                        <span>x 1</span>
                                    </div>

                                    @if($extra['group']->price_per =='item')
                                        <div class="col-sm-4 font-15 font-main-bold text-right">
                                            @php
                                                $promotionPrice = $stock->promotion_prices()
                                                ->where('variation_id',$voption->id)->first();
                                            @endphp
                                            {!! ($promotionPrice) ? convert_price($promotionPrice->price,$currency) : convert_price($voption->price,$currency) !!}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    @endif
                </div>
                @if($extra['group']->price_per =='product')
                    <div class="font-15 font-main-bold align-self-center">
                        @php
                            $promotionPrice = ($extra['group']) ? $stock->promotion_prices()
                            ->where('variation_id',$extra['group']->id)->first() : null;
                        @endphp
                        {!! ($promotionPrice) ? convert_price($promotionPrice->price,$currency) : (($extra['group']) ? convert_price($extra['group']->price,$currency) : convert_price(0,$currency)) !!}
                    </div>
                @endif
            </div>
        </div>

    </div>


</li>
