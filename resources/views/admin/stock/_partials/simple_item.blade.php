<div class="package-box">
    <div class="basic-center basic-wall shadow-none" data-id="{{ $main_unique }}">
        <div class="w-100">
            <div class="">
                <div class="row">
                    {{--<div class="col-md-2">--}}
                    {!! Form::hidden("variations[$main_unique][min_count_limit]",1) !!}
                    {!! Form::hidden("variations[$main_unique][count_limit]",1) !!}
                    {{--</div>--}}
                    {{--<div class="col-md-2">--}}
                    {{--How Many items user can select : {!! Form::number("variations[$main_unique][count_limit]",--}}
                    {{--($main) ? $main->count_limit : null,['class' => 'form-control']) !!}--}}
                    {{--</div>--}}
                    <div class="col-lg-12">
                        <label>Display as: </label>
                        {!! Form::select("variations[$main_unique][display_as]",
                        ['menu' => 'Select Box','list' => 'Radio'],($main) ? $main->display_as : null,['class' => 'form-control display-change']) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{--<div class="package-box">--}}
{{--    <div class="basic-center basic-wall" data-id="{{ $main_unique }}">--}}
{{--        <div class="w-100">--}}
{{--            <div class="">--}}
{{--                <div class="row">--}}
{{--                    --}}{{--<div class="col-md-2">--}}
{{--                    {!! Form::hidden("variations[$main_unique][min_count_limit]",1) !!}--}}
{{--                    {!! Form::hidden("variations[$main_unique][count_limit]",1) !!}--}}
{{--                    --}}{{--</div>--}}
{{--                    --}}{{--<div class="col-md-2">--}}
{{--                    --}}{{--How Many items user can select : {!! Form::number("variations[$main_unique][count_limit]",--}}
{{--                    --}}{{--($main) ? $main->count_limit : null,['class' => 'form-control']) !!}--}}
{{--                    --}}{{--</div>--}}
{{--                    <div class="col-lg-2">--}}
{{--                        Display as: {!! Form::select("variations[$main_unique][display_as]",--}}
{{--                        ['menu' => 'Select Box','list' => 'Radio'],($main) ? $main->display_as : null,['class' => 'form-control display-change']) !!}--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-2">--}}
{{--                        <div class="section_price">--}}
{{--                            Price--}}
{{--                            per: {!! Form::select("variations[$main_unique][price_per]",['product' => 'Section','item' => 'Item'],($main) ? $main->price_per : null,['class' => 'form-control price_per']) !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-2">--}}
{{--                        <div class="section_price product_price @if($main && $main->price_per == 'item') hide @endif">--}}
{{--                            Price : {!! Form::text("variations[$main_unique][common_price]",--}}
{{--                                                                ($main) ? $main->common_price : null,['class' => 'form-control']) !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 mt-lg-0 mt-1">--}}
{{--                        <button class="btn btn-primary pull-right select-items"--}}
{{--                                type="button">--}}
{{--                            <i class="fa fa-plus"></i> Add new--}}
{{--                        </button>--}}
{{--                        --}}{{--add-package-item--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="table-responsive">--}}
{{--                <table class="table table-style table-bordered mt-2" cellspacing="0"--}}
{{--                       width="100%">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Item</th>--}}
{{--                        <th>Name</th>--}}
{{--                        <th>Qty</th>--}}
{{--                        <th>Image</th>--}}
{{--                        <th class="package_price @if(! $main || ($main && $main->price_per == 'product')) hide @endif">Price</th>--}}
{{--                        <th>Actions</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody class="package-variation-box">--}}
{{--                    @if($main && count($v))--}}
{{--                        @foreach($v as $package_variation)--}}
{{--                            @include('admin.inventory._partials.variation_package_item')--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
