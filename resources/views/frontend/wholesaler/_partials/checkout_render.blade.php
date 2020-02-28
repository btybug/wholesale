<div id="singleProductPageCnt" class="shopping-cart-content">
    <div class="shopping-cart-inner">
        <div class="d-flex flex-wrap">
            <div class="col-lg-10 pl-0">
                <div class="shopping__cart-tab-details">
                    <div class="row">
                        <div class="col-md-6 detail-left-col">
                            <div class="cart-details">
                                <div class="d-flex align-items-center cart-details-head">
                                    <span class="cart-details-avatar">
                                        <span class="icon-avatar">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="41px" height="41px" viewBox="0 0 41 41">
                                            <path fill-rule="evenodd" opacity="0.502" fill="rgb(0, 0, 0)"
                                                  d="M34.996,26.504 C32.763,24.271 30.105,22.619 27.206,21.618 C30.311,19.479 32.351,15.899 32.351,11.852 C32.351,5.317 27.035,-0.000 20.500,-0.000 C13.965,-0.000 8.648,5.317 8.648,11.852 C8.648,15.899 10.689,19.479 13.794,21.618 C10.895,22.619 8.237,24.271 6.004,26.504 C2.132,30.376 -0.000,35.524 -0.000,41.000 L3.203,41.000 C3.203,31.462 10.962,23.703 20.500,23.703 C30.037,23.703 37.797,31.462 37.797,41.000 L41.000,41.000 C41.000,35.524 38.868,30.376 34.996,26.504 ZM20.500,20.500 C15.731,20.500 11.852,16.620 11.852,11.852 C11.852,7.083 15.731,3.203 20.500,3.203 C25.269,3.203 29.148,7.083 29.148,11.852 C29.148,16.620 25.269,20.500 20.500,20.500 Z"/>
                                        </svg>
                                        </span>
                                    </span>
                                    <span class="font-28 lh-1 text-tert-clr name">
                                        {!! Auth::user()->name !!}
                                        {!! Auth::user()->last_name !!}
                                    </span>
                                </div>
                                <div class="row cart-details-address">
                                    <div class="col-md-4">
                                        <h3 class="title">{!! __('shipping_address') !!}</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="address-info">
                                            <div class="select-wall product__select-wall">
                                                {!! Form::select('address_book',[null => 'Select']+$address->toArray(),$address_id,
                                                ['class' => 'select-2 select-2--no-search main-select not-selected arrow-dark select2-hidden-accessible select-address',
                                                "style" => 'width: 100%']) !!}

                                            </div>
                                            <div class="main-info">
                                                @if($default_shipping)
                                                    <span>{!! $default_shipping->company !!}</span>
                                                    <span>{!! $default_shipping->first_line_address !!}</span>
                                                    <span>{!! $default_shipping->second_line_address !!}</span>
                                                    <span>{!! $default_shipping->city !!}</span>
                                                    <span>{!! $countriesShipping[$default_shipping->country] !!}</span>
                                                    <span>{!! getRegionByZone(@$default_shipping->country)[$default_shipping->region] !!}</span>
                                                    <span>{!! $default_shipping->post_code !!}</span>
                                                @endif
                                            </div>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#addNewAddress"
                                               class="font-18 bg-blue-clr text-sec-clr add-address-btn address-book-new">
                                                {!! __('add_new_address') !!}</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="cart-details-special">
                                    <h3 class="title">
                                        {!! __('special_notes') !!}
                                    </h3>
                                    <textarea name="" cols="30" rows="10" class="note"></textarea>
                                    <p class="font-16 text-tert-clr note-info">
                                        {!! __('check_out_area_desc') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 detail-right-col">
                            @include("frontend.wholesaler._partials.shipping_options")
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 pr-md-right">
                <div class="right-content">
                    @include("frontend.wholesaler._partials.order_summary",['checkout' => true,"back_route" => route("wholesaler_my_cart")])
                </div>
            </div>
        </div>
    </div>
</div>

