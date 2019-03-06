<div class="col-sm-12">
    <table class="table table-bordered table--order-dtls order-table">
        <thead>
        <tr>
            <td></td>
            <td class="text-left">Product</td>
            <td>
                <div class="head-stock-price">
                    <div>
                        Stocks
                    </div>
                    <div>
                        Price
                    </div>
                </div>
            </td>
            <td class="text-right">Quantity</td>
            <td class="text-right">Unit Price</td>
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
                    <td class="w-5" align="center">
                        <a data-uid="{{ $main->id }}" href="javascript:void(0)"
                           class="btn btn-danger btn-sm remove-from-cart"><i
                                    class="fa fa-times"></i></a>
                    </td>
                    <td class="text-left w-20">
                        <div class="product-name">
                            <img src="{{ $stock->image }}"
                                 alt="{{ $stock->name }}">
                            <div class="name">{{ $stock->name }}</div>
                        </div>
                    </td>
                    <td class="stock-price">
                        <div class="stock-row">
                            <div class="left">
                                <div class="stock-name">
                                    <span>{{ $main->attributes->variation->name }}</span>
                                </div>
                                <div class="d-flex flex-wrap">
                                    @if($stock->type == 'variation_product')
                                        @foreach($main->attributes->variation->options as $voption)
                                            <div class="h5 mr-1"><span
                                                        class="badge badge-secondary">{{ $voption->option->name }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="right">
                                <div class="stock-count">
                                    <span>${{ $main->price }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="extra-stock">
                            <h4>Extra</h4>
                            @php
                                $countMessage = true;
                            @endphp
                            @if($main->attributes->requiredItems && count($main->attributes->requiredItems))
                                @php
                                    $countMessage = false;
                                @endphp
                                @foreach($main->attributes->requiredItems as $vid)
                                    <div class="stock-row">
                                        @php
                                            $variationReq = \App\Services\CartService::getVariation($vid)
                                        @endphp
                                        <div class="left">
                                            <div class="stock-name">
                                                <span> {{ $variationReq->stock->name }}</span>
                                            </div>
                                            <div class="d-flex flex-wrap">
                                                @if($variationReq->stock->type == 'variation_product')
                                                    @foreach($variationReq->options as $voption)
                                                        <div class="h5 mr-1"><span
                                                                    class="badge badge-secondary">{{ $voption->option->name }}</span>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="right extra-del">
                                            @php
                                                $promotionPrice = ($variationReq) ? $variationReq->stock->promotion_prices()
                                                ->where('variation_id',$variationReq->id)->first() : null;
                                            @endphp
                                            <div class="stock-count">
                                                <span> {!! ($promotionPrice) ? "$" . $promotionPrice->price : (($variationReq) ? "$" . $variationReq->price : 0) !!}</span>
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
                                    <div class="stock-row">
                                        @php
                                            $variationOpt = $vid->attributes->variation
                                        @endphp
                                        <div class="left">
                                            <div class="stock-name">
                                                <span>  {{ $variationOpt->stock->name }}</span>
                                            </div>
                                            <div class="d-flex flex-wrap">
                                                @if($variationOpt->stock->type == 'variation_product')
                                                    @foreach($variationOpt->options as $voption)
                                                        <div class="h5 mr-1"><span
                                                                    class="badge badge-primary">{{ $voption->option->name }}</span>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="right extra-del">
                                            @php
                                                $promotionPrice = ($variationOpt) ? $variationOpt->stock->promotion_prices()
                                                ->where('variation_id',$variationOpt->id)->first() : null;
                                            @endphp
                                            <div class="stock-count">
                                                <span> {!! ($promotionPrice) ? "$" . $promotionPrice->price : (($variationOpt) ? "$" . $variationOpt->price : 0) !!}</span>
                                            </div>
                                            <div>
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

                    </td>
                    <td class="Qty w-8" align="center">
                        <div class="input-group">
                          <span data-condition="{{ false }}" data-uid="{{ $main->id }}"
                                class="qtycount">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                          </span>
                            <input name="quantity[]" type="text" readonly
                                   value="{{ $main->quantity }}"
                                   class="form-control qty">
                            <span data-condition="{{ true }}" data-uid="{{ $main->id }}"
                                  class="qtycount">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                              </span>
                        </div>
                    </td>
                    <td class="w-8" align="center"> ${{ \App\Services\CartService::getPriceSum($main->id) }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

</div>