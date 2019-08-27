@if(count($items))
    @foreach($items as $item)
        @php
            $uniqueID = uniqid();
        @endphp
        <tr>
            <td>
                {!! Form::select("variations[$main_unique][variations][$uniqueID][item_id]",$stockItems,$item->id,['class' => 'form-control v-item-change']) !!}
            </td>
            <td>
                {!! Form::text("variations[$main_unique][variations][$uniqueID][name]",$item->name,['class' => 'form-control v-name']) !!}
                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][id]",null) !!}
            </td>
            <td>
                <span class="v-qty">0</span>
                {!! Form::hidden("variations[$main_unique][variations][$uniqueID][qty]",null) !!}
            </td>
            <td>
                {!! media_button("variations[$main_unique][variations][$uniqueID][image]",$item->image ) !!}
            </td>

            <td class="package_price @if(! $main || ($main && $main->price_per == 'product')) hide @endif d-flex">
                <div class="col-md-6">
                    {!! Form::select("variations[$main_unique][variations][$uniqueID][price_type]",['' => 'Choose','static' => 'Static','discount' => 'Discount'],
                    ($package_variation) ? $package_variation->price_type : null,['class' => 'form-control price-type-change']) !!}
                </div>
                <div class="col-md-6">
                    <div class="price-static @if($package_variation && $package_variation->price_type =='static') show @else hide @endif">
                        {!! Form::number("variations[$main_unique][variations][$uniqueID][price]",($package_variation) ? $package_variation->price : null,['class' => 'form-control v-price']) !!}
                    </div>
                    <div class="price-discount @if($package_variation && $package_variation->price_type =='discount') show @else hide @endif">
                        <a data-main="{{ $main_unique }}" data-group="{{ $uniqueID }}" href="javascript:void(0)" class="btn btn-info add-discount">Discount price</a>
                        <div class="discount-data-v" data-d-v="{{ $uniqueID }}">
                            @if($package_variation && count($package_variation->discounts))
                                @include("admin.stock._partials.discount_data",['ajax' => false])
                            @endif
                        </div>
                    </div>
                </div>
            </td>

            <td>
                <button type="button" class="btn btn-danger delete-package-option delete-v-option_button"><i
                        class="fa fa-trash"></i></button>
            </td>
        </tr>
    @endforeach
@endif
