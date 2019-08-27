<div class="package-box" style="    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: -4px 4px 18px 7px #ada9a9;
    overflow: hidden;
    clear: both;">
    <div class="basic-center basic-wall" data-id="{{ $main_unique }}">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $main->title }}</h3>
                <div class="row @if($main && $main->price_per == 'item') hide @endif">
                    <div class="col-md-3">
                        OLD Price : {!! Form::text("variations[$main_unique][common_price]",
                                                                ($main) ? $main->common_price : null,['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3">
                        NEW Price : {!! Form::text("variations[$main_unique][new_price]",null,['class' => 'form-control']) !!}
                    </div>

                </div>
            </div>
            <table class="table table-style table-bordered mt-2" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>Item</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th class="package_price @if(! $main || ($main && $main->price_per == 'product')) hide @endif">Price</th>
                </tr>
                </thead>
                <tbody class="filter-variation-box">
                @if($main && count($v))
                    @foreach($v as $package_variation)
                        @include('admin.stock._partials.promotions.variation_package_item')
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

