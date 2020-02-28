@php

    $variation = $o['variation'];
    $item = \App\Models\Items::find($variation['item_id']);
    $locations = ($item) ? $item->locations : [];
    $collected = $order->collections()->where('unique_id',$o['unique_id'])->first();

@endphp

<div class="table-responsive  @if($count > 0) table-mt @endif">
    <table class="table table-bordered">
        @if($count == 0)
        <thead>
            <tr>
                <th scope="col">Item</th>
                <th scope="col"></th>
                <th scope="col">QTY</th>
                <th scope="col">Warehouse</th>
                <th scope="col">Shelf</th>
                <th scope="col">Rack</th>
                <th scope="col">Barcode</th>
                <th scope="col"></th>
            </tr>
        </thead>
        @endif
        <tbody>
        <tr class="collect-item">
            <td class="photo-td w-20">
                <div class="photo">
                    <img src="{{ $o['image'] }}" alt="product">
                </div>
            </td>
            <td class="title-td w-50">
                <div class="font-16 lh-1 title-block">
                    <p class="text-tert-clr text-uppercase">
                        {!! $o['title'] !!}
                    </p>
                    <p class="mb-0">
                        @if(isset($o['variation']['item']))
                            {{ $o['variation']['item']['short_name'] }}
                        @endif

                        @if($o['discount'] && $variation['discount_type'] == 'fixed')
                            ({{ "Pack of ".$o['discount']['qty'] }})
                        @endif
                    </p>
                </div>
            </td>

            <td class="qty-td w-20">
                <div class="d-flex flex-column align-items-center qty-block">
                    <span class="font-sec-light font-16 lh-1">QTY</span>
                    <div class="product__single-item-inp-num">
                        <div class="quantity">
                            <input type="number" readonly="" step="1" class="itm-qty" value="{{ $o['qty'] }}">
                        </div>
                    </div>
                </div>
            </td>
            <td class="warehouse-td align_middle w-25">
                @if(count($locations) > 1)
                    <select class="form-control warehouse">
                        @foreach($locations  as $location)
                            <option value="{{ $location->warehouse_id }}">{{ $location->warehouse->name }}</option>
                        @endforeach
                    </select>
                @else
                    @php
                    $location = (count($locations)) ? $locations->first() : null
                    @endphp
                    {!! Form::hidden('',($location) ? $location->warehouse->id :null,['class' => 'warehouse']) !!}
                    <span class="font-sec-reg font-20 text-tert-clr lh-1">{{ ($location) ? $location->warehouse->name : "No Warehouse" }}</span>
                @endif

            </td>
            <td class="shilf-td align_middle w-20">
                @if(count($locations) > 1)
                    <select class="form-control rack">
                        @foreach($locations  as $location)
                            <option value="{{ $location->rack_id }}">{{ $location->rack->name }}</option>
                        @endforeach
                    </select>
                @else
                    @php
                        $location = (count($locations)) ? $locations->first() : null
                    @endphp
                    {!! Form::hidden('',($location) ? $location->rack->id : null,['class' => 'rack']) !!}

                    <span class="font-sec-reg font-20 text-main-clr lh-1">{{ ($location) ? $location->rack->name : "No rack" }}</span>
                @endif
            </td>
            <td class="rak-td align_middle w-20">
                @if(count($locations) > 1)
                    <select class="form-control shelve">
                        @foreach($locations  as $location)
                            <option value="{{ $location->shelve_id }}">{{ $location->shelve->name }}</option>
                        @endforeach
                    </select>
                @else
                    @php
                        $location = (count($locations)) ? $locations->first() : null
                    @endphp
                    {!! Form::hidden('',($location) ? $location->shelve->id : null,['class' => 'shelve']) !!}

                    <span class="font-sec-reg font-20 text-red-clr lh-1">{{ ($location) ? $location->shelve->name : "No shelve" }}</span>
                @endif
            </td>
            <td class="barcode-td align_middle w-25">
                <span class="barcode-block">{{ $item->barcode->code }}</span>
            </td>
            <td class="last-td w-25 @if($collected) active @endif">
                <div class="check-block">
                    <span class="check-icon @if(! $collected) d-none @endif">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24px" height="19px">
                        <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                              d="M7.636,15.030 L1.909,9.075 L0.000,11.060 L7.636,19.000 L24.000,1.985 L22.091,0.000 L7.636,15.030 Z"/>
                        </svg></span>
                    <span class="square-icon check-collecting @if($collected)  d-none @endif" data-item="{{ $item->id }}" data-unique="{{ $o['unique_id'] }}" ></span>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
