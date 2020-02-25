@if($variation->count_limit ==1 && $variation->min_count_limit)
    @if($variation->display_as == "popup" || $variation->display_as == "filter_popup")
        <div class="col-sm-12 pl-0 m-l-5 menu-item-selected mb-2" data-discount-type="{{ $variation->discount_type }}" data-id="{{ $variation->id }}"
             data-price="{{ convert_price($variation->price,$currency,false,true) }}">
            <div class="d-flex flex-wrap align-items-center ">
                <div class="col-sm-7">
                    <a href="javascript:void(0)" data-el-id="{{ $selectElementId }}"
                       class="btn btn-sm delete-menu-item cl-red"><i class="fa fa-times"></i></a>
                    {{ $variation->name }}
                </div>
                <div class="col-sm-3">
                    <div class="continue-shp-wrapp_qty position-relative product-counts-wrapper w-100 invisible">
                        <!--minus qty-->
                        <span class="d-flex align-items-center h-100 pointer position-absolute product-count-minus">
                            <svg viewBox="0 0 20 3" width="20px" height="3px">
                                <path fill-rule="evenodd" fill="rgb(214, 217, 225)"
                                      d="M20.004,2.938 L-0.007,2.938 L-0.007,0.580 L20.004,0.580 L20.004,2.938 Z"></path>
                            </svg>
                        </span>
                    @if($variation->price_per == "product")
                        {!! Form::number('qty',1,['class' => 'field-input w-100 h-100 font-23 text-center border-0 form-control product-qty product-qty_per_price none-touchable','data-id' => $variation->id,'min' => 1]) !!}
                    @else
                        {!! Form::number('qty',1,['class' => 'field-input w-100 h-100 font-23 text-center border-0 form-control product-qty none-touchable','data-id' => $variation->id,'min' => 1]) !!}
                    @endif
                    <!--plus qty-->
                        <span class="d-flex align-items-center h-100 pointer position-absolute product-count-plus">
                            <svg viewBox="0 0 20 20" width="20px" height="20px">
                                <path fill-rule="evenodd" fill="rgb(211, 214, 223)"
                                      d="M20.004,10.938 L11.315,10.938 L11.315,20.000 L8.696,20.000 L8.696,10.938 L-0.007,10.938 L-0.007,8.580 L8.696,8.580 L8.696,0.007 L11.315,0.007 L11.315,8.580 L20.004,8.580 L20.004,10.938 Z"></path>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="col-sm-2 pl-sm-3 p-0 text-sm-center">
                    @if($variation->price_per =='item' && ! $variation->stock->type)
                        <span class="d-inline-block font-35 font-sec-bold text-uppercase ml-auto price-placee lh-1">
              {{ convert_price($variation->price,$currency, false) }}
            </span>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="col-sm-12 pl-0 menu-item-selected mb-2" data-id="{{ $variation->id }}"
             data-price="{{ convert_price($variation->price,$currency,false,true) }}">
            <div class="d-flex flex-wrap align-items-center ">
                <div class="invisible position-absolute" style="width: 0;height: 0">
                    <div class="continue-shp-wrapp_qty position-relative product-counts-wrapper w-100">
                        {!! Form::number('qty',1,['class' => 'field-input w-100 h-100 font-23 text-center border-0 form-control product-qty','data-id' => $variation->id,'min' => 1]) !!}
                    </div>
                </div>
                <div class="col-sm-12 pl-sm-3 p-0 text-sm-center">
                    @if($variation->price_per =='item' && !$variation->stock->type)
                        <span class="d-inline-block font-35 font-sec-bold text-uppercase ml-auto price-placee lh-1">
              {{ convert_price($variation->price,$currency, false) }}
            </span>
                    @endif
                </div>
            </div>
        </div>
    @endif
@else
    <div class="col-sm-12 pl-0 m-l-5 menu-item-selected mb-2" data-discount-type="{{ $variation->discount_type }}" data-id="{{ $variation->id }}"
         data-price="{{ convert_price($variation->price,$currency,false,true) }}">
        <div class="d-flex flex-wrap align-items-center ">
            <div class="col-sm-7">
                <a href="javascript:void(0)" data-el-id="{{ $selectElementId }}"
                   class="btn btn-sm delete-menu-item cl-red"><i class="fa fa-times"></i></a>
                {{ $variation->name }}
            </div>
            <div class="col-sm-3">
                @if($variation->price_type == 'static')
                    <div class="continue-shp-wrapp_qty position-relative product-counts-wrapper w-100">
                        <!--minus qty-->
                        <span class="d-flex align-items-center h-100 pointer position-absolute product-count-minus">
                            <svg viewBox="0 0 20 3" width="20px" height="3px">
                                <path fill-rule="evenodd" fill="rgb(214, 217, 225)"
                                      d="M20.004,2.938 L-0.007,2.938 L-0.007,0.580 L20.004,0.580 L20.004,2.938 Z"></path>
                            </svg>
                        </span>
                    @if($variation->price_per == "product")
                        {!! Form::number('qty',1,['class' => 'field-input w-100 h-100 font-23 text-center border-0 form-control product-qty product-qty_per_price none-touchable','data-id' => $variation->id,'min' => 1]) !!}
                    @else
                        {!! Form::number('qty',1,['class' => 'field-input w-100 h-100 font-23 text-center border-0 form-control product-qty none-touchable','data-id' => $variation->id,'min' => 1]) !!}
                    @endif
                    <!--plus qty-->
                        <span class="d-flex align-items-center h-100 pointer position-absolute product-count-plus">
                            <svg viewBox="0 0 20 20" width="20px" height="20px">
                                <path fill-rule="evenodd" fill="rgb(211, 214, 223)"
                                      d="M20.004,10.938 L11.315,10.938 L11.315,20.000 L8.696,20.000 L8.696,10.938 L-0.007,10.938 L-0.007,8.580 L8.696,8.580 L8.696,0.007 L11.315,0.007 L11.315,8.580 L20.004,8.580 L20.004,10.938 Z"></path>
                            </svg>
                        </span>
                    </div>
                @else
                    @if($variation->discount_type == 'range')
                        {!! Form::number('qty',1,['class' => 'field-input w-100 h-100 font-23 text-center form-control product-qty product-qty_per_price ','data-id' => $variation->id,'min' => 1]) !!}
                    @elseif($variation->discount_type == 'fixed')
                        @php
                            $discounts = $variation->discounts()->pluck('qty','id')->all();
                        @endphp
                        {!! Form::select('qty',$discounts,null,['class' => 'field-input w-100 h-100 font-23 text-center form-control product-qty product-qty_per_price ','data-id' => $variation->id]) !!}
                    @endif
                @endif
            </div>
            <div class="col-sm-2 pl-sm-3 p-0 text-sm-center">
                @if($variation->price_per =='item' && ! $variation->stock->type)
                    <span class="d-inline-block font-35 font-sec-bold text-uppercase ml-auto price-placee lh-1">
              {{ convert_price($variation->price,$currency, false) }}
            </span>
                @endif
            </div>
        </div>
    </div>
@endif
