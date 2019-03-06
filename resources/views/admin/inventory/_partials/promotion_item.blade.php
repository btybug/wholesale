<div data-promotion-v="{{ $model->id }}" class="extra-item-data">
    {!! Form::model($promotion,['url' => route('admin_stock_sales_save'),'id' => 'promotion-form']) !!}
    {!! Form::hidden('stock_id',$model->id) !!}
    {!! Form::hidden('slug',($promotion) ? $promotion->slug: uniqid()) !!}
    @if(! $promotion)
        <div class="row mb-4">
            <h3>Create new</h3>
        </div>
    @endif
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="row">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-6">
                    @if($promotion)
                       <div class="form-control">{{  $promotion->name }} </div>
                    @else
                        {!! Form::text('name',null,['class' => 'form-control']) !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @if(! $promotion)
                <button type="button" class="btn btn-primary save-extra-variations pull-right " data-type="normal">
                    Save
                </button>
            @endif
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="row">
                <label class="col-sm-2 control-label" for="input-date-start">Date Start</label>
                <div class="col-sm-6">
                    @if($promotion)
                        {{ BBgetDateFormat($promotion->start_date,'m/d/Y') }}
                    @else
                        <div class="input-group date">
                            {!! Form::text('start_date',null,['placeholder' => 'Date Start',
                          'id'=>'input-date-start', 'class'=> 'form-control','data-date-format'=>'YYYY-MM-DD']) !!}
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <label class="col-sm-2 control-label" for="input-date-end">Date End</label>
                <div class="col-sm-6">
                    @if($promotion)
                        {{ BBgetDateFormat($promotion->end_date,'m/d/Y') }}
                    @else
                        <div class="input-group date">
                            {!! Form::text('end_date',null,['placeholder' => 'Date end',
                          'id'=>'input-date-end', 'class'=> 'form-control','data-date-format'=>'YYYY-MM-DD']) !!}
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span></div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($model->variations)
        @if($model->type == 'simple_product')
            @php
                $single_variation = ($model && $model->variations) ? $model->variations->first() : null;
                $promotionPrice = $model->promotion_prices()->where('variation_id',$single_variation->id)->first();
            @endphp

            <table class="table table-style table-bordered" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Qty</th>
                    <th>Old Price</th>
                    <th>New Price</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        {{ ($single_variation) ? $single_variation->name : null }}
                    </td>
                    <td>
                        {{ ($single_variation) ? $single_variation->variation_id : null }}
                    </td>
                    <td>
                        {!! (isset($item['qty'])) ? $item['qty'] : 0 !!}
                    </td>
                    <td>
                        {!! ($promotionPrice) ? $promotionPrice->price : ($single_variation) ? $single_variation->price : null !!}
                    </td>
                    <td>
                        @php
                            $salePrice = ($promotion) ? ( ($single_variation) ? $single_variation->sale()->where('slug',$promotion->slug)->first() :  null) : null;
                        @endphp
                        @if($promotion)
                            {{  ($salePrice) ? $salePrice->price : 0 }}
                        @else
                            {!! Form::text("extra_product[$single_variation->id][price]",
                                ($salePrice) ? $salePrice->price : 0
                            ,
                            ['class' => 'form-control extra-item','data-variation' => $single_variation->id]) !!}
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="text-right">
                <button class="btn btn-danger">Cancel Promotion</button>
            </div>
        @elseif($model->type == 'variation_product')

            <table id="variations-table" class="table table-style table-bordered"
                   cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Attributes</th>
                    <th>SKU</th>
                    <th>Qty</th>
                    <th>Old Price</th>
                    <th>New Price</th>
                </tr>
                </thead>
                <tbody class="all-list-attrs">
                @foreach($model->variations()->with('options')->get() as $variation)
                    <tr>
                        <td>
                            {!! $variation->name !!}
                        </td>
                        <td class="variation-options-place">
                            @foreach($variation->options as $items)
                                <p><strong> {{ \App\Models\Attributes::getById($items->attributes_id) }}
                                        :</strong> {{ \App\Models\Stickers::getById($items->options_id) }}</p>
                            @endforeach
                        </td>
                        <td>
                            {{ $variation->variation_id }}
                        </td>
                        <td>
                            {!! (isset($item['qty'])) ? $item['qty'] : null !!}
                        </td>
                        <td>
                            @php
                                $promotionPrice = $model->promotion_prices()->where('variation_id',$variation->id)->first();
                                $salePrice = ($promotion) ? $variation->sale()->where('slug',$promotion->slug)->first() : null
                            @endphp
                            {!! ($promotionPrice) ? $promotionPrice->price : ($variation) ? $variation->price : null !!}
                        </td>
                        <td>
                            @if($promotion)
                                {{  ($salePrice) ? $salePrice->price : 0 }}
                            @else
                            {!! Form::text("extra_product[$variation->id][price]",
                            ($salePrice) ? $salePrice->price : 0,
                            ['class' => 'form-control extra-item','data-variation' => $variation->id]) !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        @elseif($model->type == 'package_product')
            <div class="row mb-4">
                <div class="col-md-8">
                    @php
                        $variation = ($model && count($model->variations)) ? $model->variations->first() : null;
                        $promotionPrice = $model->promotion_prices()->where('variation_id',$variation->id)->first();

                        $salePrice = ($promotion) ? ( ($variation) ? $variation->sale()->where('slug',$promotion->slug)->first() :  null) : null;
                    @endphp

                    <div class="row">
                        <label class="col-md-2">Old Price:</label>
                        <div class="col-sm-6">
                            {!! ($promotionPrice) ? $promotionPrice->price : ($variation) ? $variation->price : null !!}
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-2">New Price:</label>
                        <div class="col-sm-6">
                            @if($promotion)
                                {{  ($salePrice) ? $salePrice->price : 0 }}
                            @else
                            {!! Form::text("extra_product[$variation->id][price]",
                            ($salePrice) ? $salePrice->price : 0,
                ['class' => 'form-control extra-item extra-price','data-variation' => ($variation) ? $variation->id : null]) !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-style table-bordered" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Qty</th>
                </tr>
                </thead>
                <tbody class="package-variation-box">
                @foreach($model->variations as $package_variation)
                    <tr>
                        <td>
                            {!! ($package_variation) ? $package_variation->name : null !!}
                        </td>
                        <td>
                            {!! ($package_variation) ? $package_variation->variation_id : null !!}
                        </td>
                        <td>
                            {!! ($package_variation && $package_variation->qty) ? $package_variation->qty : 0 !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    @else
        NO Variations
    @endif
    {!! Form::close() !!}
    @if($promotion)
        <div class="row mb-4">
            @if(! $promotion->canceled)
            <div class="text-right">
                <button data-id="{{ $model->id }}" data-slug="{{ $promotion->slug }}" class="btn btn-danger cancel-promotion">Cancel Promotion</button>
            </div>
            @endif
            <p><strong>Created : </strong> {{ BBgetDateFormat($promotion->created_at) }}</p>
            @if($promotion->canceled)
                <p><strong>Updated : </strong> {{ BBgetDateFormat($promotion->updated_at) }}</p>
            @endif
        </div>
    @endif
</div>
