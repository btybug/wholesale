@php
    $uniqueID = uniqid();
@endphp
<tr class="p-2 border-dark">
    <td>
        <div class="form-control">
            {!! ($package_variation) ? $package_variation->item->name : null !!}
        </div>
    </td>
    <td>
        <div class="form-control">
            {!! ($package_variation) ? $package_variation->name : null !!}
        </div>
        {!! Form::hidden("variations[$main_unique][variations][$uniqueID][id]",($package_variation) ? $package_variation->id : null) !!}
    </td>
    <td>
        <span class="v-qty">{!! ($package_variation && $package_variation->qty) ? $package_variation->qty : 0 !!}</span>
        {!! Form::hidden("variations[$main_unique][variations][$uniqueID][qty]",($package_variation) ? $package_variation->qty : null) !!}
    </td>
    <td class="package_price @if($main && $main->price_per == 'product') hide @endif ">
        <div class="col-md-12 d-flex">
            <div
                class="d-flex flex-wrap price-static @if($package_variation && $package_variation->price_type =='static') show @else hide @endif">
                <div class="col-md-6">
                    Old Price
                    <div class="form-control">
                        {!! ($package_variation) ? $package_variation->price : null !!}
                    </div>
                </div>
                <div class="col-md-6">
                    New Price
                    @if($promotion)
                        @php
                            $salePrice = ($promotion) ? ( ($package_variation) ? $package_variation->sale()->where('slug',$promotion->slug)->first() :  null) : null;
                        @endphp
                        {{  ($salePrice) ? $salePrice->price : 0 }}
                    @else
                        {!! Form::text("extra_product[$package_variation->id][price]",
                            0,['class' => 'form-control']) !!}
                    @endif
                </div>
            </div>
            <div
                class="price-discount @if($package_variation && $package_variation->price_type =='discount') show @else hide @endif">
                <a data-main="{{ $main_unique }}" data-group="{{ $uniqueID }}" href="javascript:void(0)"
                   class="btn btn-info add-discount">Discount price</a>
                <div class="discount-data-v" data-d-v="{{ $uniqueID }}">
                    @if($package_variation && count($package_variation->discounts))
                        @include("admin.stock._partials.discount_data",['ajax' => false])
                    @endif
                </div>
            </div>
        </div>
    </td>
</tr>
