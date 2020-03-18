@php
    $isModelExists = ($model && isset($v) && count($v)) ? true : false;
    $main_unique = ($isModelExists) ? $v->first()->variation_id :uniqid();
    $main = ($isModelExists) ? $v->first() : null;
@endphp
<div class="form-group required-single_wall">



    <div class="card panel panel-default stock-page" data-unqiue="{{ $main_unique }}">
        <div class="card-header panel-heading clearfix d-flex pr-0 stock-page--head">
            <div class="pl-2 py-2">
                 <span class="stock-edit-page-collapse-icon" data-toggle="collapse" data-target="#collapseStock{{$main_unique}}" aria-expanded="false" aria-controls="collapseStock{{$main_unique}}">
                <i class="far fa-caret-square-up fa-2x"></i>
            </span>
            </div>
            <div class="stock-edit-price-tab-ordering">
                {!! Form::hidden("variations[$main_unique][ordering]",($main) ? $main->ordering : null,
               ['class' => 'form-control','placeholder' => 'Sort']) !!}
{{--                <div class="row">--}}
{{--                    <div class="col-md-3">--}}
{{--                        <label class="col-form-label">Ordering</label>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-9">--}}

{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="col-xl-4 col-lg-5 align-self-center">
                <div class="row">
                    <label class="col-form-label col-xl-3 col-sm-4 col-4 px-md-3 px-0">Section Title</label>
                    <div class="col-xl-5 col-sm-7 col-8 align-self-center">
                        {!! Form::text("variations[$main_unique][title]",($main) ? $main->title : null,['class' => 'form-control mr-1','placeholder' => 'Enter title ...']) !!}
                    </div>
                </div>

            </div>
            <div class="col-sm-1 ml-auto col d-flex pr-0 head-right justify-content-end">
                {!! Form::hidden("variations[$main_unique][is_required]",$required) !!}
                <button type="button" class="btn btn-danger delete-v-option"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div id="collapseStock{{$main_unique}}" class="collapse" aria-labelledby="heading{{$main_unique}}" data-parent="#accordionStockEdit">
            <div class="card-body panel-body">
                <div class="row mb-2">
                    <div class="col-xl-5 col-lg-7 col-md-12 head-left">
                        <div class="">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Item Options:</label>
                                    {!! Form::select("variations[$main_unique][type]",['single' => 'Single item',
                                        'package_product' => 'Multiple items','filter' => 'Filters','filter_discount' => 'Filter Discounts'
                           ],($main) ? $main->type : null,
                           ['class' => 'form-control variation-product-select']) !!}
                                </div>
                                <div class="col-sm-4">
                                    <div class="">
                                        <div class="type-place">
                                            <div class="product-wall">
                                                @if($main && $main->type =='package_product')
                                                    @include('admin.stock._partials.package_item')
                                                @elseif($main && $main->type =='single')
                                                    @include('admin.stock._partials.simple_item')
                                                @elseif($main && $main->type =='filter')
                                                    @include('admin.stock._partials.filter_item')
                                                @elseif($main && $main->type =='filter_discount')
                                                    @include('admin.stock._partials.filter_discount')
                                                @else
                                                    @include('admin.stock._partials.simple_item')
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-sm-4 filter-option {{ ($main && ($main->type =='filter' || $main->type == 'filter_discount')) ? '' : 'hide' }}">
                                    <label>Select Filter</label>
                                    {!! Form::select("variations[$main_unique][filter_category_id]",['' => '-----']+$filters,($main) ? $main->filter_category_id : null,
                                    ['class' => 'form-control filter-select']) !!}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-7 col-lg-5 col-md-12 d-flex justify-content-end p-0">
                        <div
                            class="w-100 multi-option {{ ($main && ($main->type =='package_product' || $main->type =='filter' )) ? '' : 'hide' }}">
                            <div class="h-100 align-items-center mb-md-0 mb-2">
                                <div class="col-xl-6 col-lg-10 col-sm-7">
                                    <div class="">

                                        <div class="align-self-center p-0">
                                            <label>
                                                Limit :
                                            </label>
                                            <div class="row">
                                                <div class="col-xl-4 col-5">
                                                    {!! Form::number("variations[$main_unique][min_count_limit]",
                                            (($main) ? $main->min_count_limit : null),['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-xl-2 col-2 d-flex justify-content-center align-self-center">
                                                    To
                                                </div>
                                                <div class="col-xl-4 col-5">
                                                    {!! Form::number("variations[$main_unique][count_limit]",
                                                                                                                           ($main) ? $main->count_limit : null,['class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-3 mb-md-0 mb-1">
                                    <div class="row">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="product-wall">
                            <div class="text-right">
                                <button class="btn btn-primary select-items"
                                        type="button">
                                    <i class="fa fa-plus"></i> Add new
                                </button>
                                {{--add-package-item--}}
                            </div>
                            <div class="w-100">
                                <div class="table-responsive stock-items-tabs-main-wrapper">

                                    <div class="stock-items-tabs-wall-head d-flex">
                                        <div class="stock-items-tab-head-name col-lg-6 col-3 pl-0">
                                            Item
                                        </div>
                                        <div class="stock-items-tab-head-price d-flex flex-wrap col-lg-6 col-9 ">
                                            <div class="col-sm-9 py-2">
                                                <div class="section_price">
                                                    <div class="row">
                                                        <label class="col-form-label col-lg-4 col-sm-5 pl-0">Price per:</label>
                                                        <div class="col-lg-8 col-sm-7 pl-0">
                                                            {!! Form::select("variations[$main_unique][price_per]",['product' => 'Section',
                                                            'item' => 'Item','discount' => 'Discount'],($main) ? $main->price_per : null,['class' => 'form-control price_per']) !!}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 py-2 pl-0">
                                                <div
                                                    class="section_price product_price @if($main && $main->price_per == 'item') hide @endif">
                                                    {!! Form::text("variations[$main_unique][common_price]",
                                                                    ($main) ? $main->common_price : null,['class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="stock-items-tab-head-action">
                                            Actions
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <div class="col-md-6 py-2 discount-price @if($main && $main->price_per == 'discount')  @else d-none @endif">

                                        </div>
                                        <div class="col-md-6 py-2 discount-price @if($main && $main->price_per == 'discount')  @else d-none @endif">
                                            <div class="d-flex flex-wrap">
                                                <div class="fixed-box" data-main="{{ $main_unique }}">
                                                    @if($main && $main->price_per == 'discount')
                                                        @foreach($main->discounts()->orderBy('ordering','asc')->get() as $key => $datum)
                                                            <div class="row discount-item d-flex flex-wrap">
                                                                <div class="col-xl-5 col-sm-4">
                                                                    <label>Qty</label>
                                                                    {!! Form::number("variations[$main_unique][discount][$key][qty]",$datum->qty,['class' => 'form-control']) !!}
                                                                </div>

                                                                <div class="col-xl-5 col-sm-4">
                                                                    <label>Total price</label>
                                                                    {!! Form::number("variations[$main_unique][discount][$key][price]",$datum->price,['class' => 'form-control']) !!}
                                                                </div>
                                                                <div class="col-xl-2 col-sm-4 mt-sm-0 mt-2 align-self-end">
                                                                    <button class="btn btn-danger remove-discount-item">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                                {!! Form::hidden("variations[$main_unique][discount][$key][ordering]",$datum->ordering,
                                                               ['class' => 'sort-discount-hidden-field','placeholder' => 'Sort']) !!}
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="row discount-item d-flex flex-wrap">
                                                            <div class="col-xl-5 col-sm-4">
                                                                <label>Qty</label>
                                                                {!! Form::number("variations[$main_unique][discount][0][qty]",null,['class' => 'form-control']) !!}
                                                            </div>

                                                            <div class="col-xl-5 col-sm-4">
                                                                <label>Total price</label>
                                                                {!! Form::number("variations[$main_unique][discount][0][price]",null,['class' => 'form-control']) !!}
                                                            </div>
                                                            <div class="col-xl-2 col-sm-4 mt-sm-0 mt-2 align-self-end">
                                                                <button class="btn btn-danger remove-discount-item">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                            </div>
                                                            {!! Form::hidden("variations[$main_unique][discount][0][ordering]",1,
                                                           ['class' => 'sort-discount-hidden-field','placeholder' => 'Sort']) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-xl-2 offset-xl-10 col-sm-4 offset-sm-8 pl-sm-3 pl-xl-4 pl-0">
                                                    <a class="btn btn-primary add-section-discount add-discount-field" href="javascript:void(0)"><i
                                                            class="fa fa-plus"></i></a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div
                                        class="@if($main && $main->type =='package_product') package-variation-box @elseif($main && $main->type =='single') package-variation-box @elseif($main && $main->type =='filter') filter-variation-box @else package-variation-box @endif">
                                        @if($main && count($v))
                                            @foreach($v as $package_variation)
                                                @include('admin.inventory._partials.variation_package_item')
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
{{--<div class="card panel panel-default stock-page" data-unqiue="{{ $main_unique }}">--}}
{{--    <div class="card-header panel-heading clearfix d-flex pr-0 stock-page--head">--}}
{{--        <div class="col-sm-6 d-flex flex-wrap head-left px-0 py-2">--}}
{{--            <div class="col-xl-3">--}}
{{--                {!! Form::text("variations[$main_unique][title]",($main) ? $main->title : null,['class' => 'form-control mr-1','placeholder' => 'Enter title ...']) !!}--}}
{{--            </div>--}}
{{--            <div class="col-xl-6 my-xl-0 my-1">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-6">--}}
{{--                        {!! Form::select("variations[$main_unique][type]",['' => 'Select','package_product' => 'Multiple items','filter' => 'Filters','single' => 'Single item'--}}
{{--               ],($main) ? $main->type : null,--}}
{{--               ['class' => 'form-control variation-product-select']) !!}--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6 mt-md-0 mt-1 filter-option {{ ($main && $main->type =='filter') ? '' : 'hide' }}">--}}
{{--                        {!! Form::select("variations[$main_unique][filter_category_id]",['' => 'Select Filter']+$filters,($main) ? $main->filter_category_id : null,--}}
{{--                        ['class' => 'form-control filter-select']) !!}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-3">--}}
{{--                {!! Form::number("variations[$main_unique][ordering]",($main) ? $main->ordering : null,--}}
{{--                ['class' => 'form-control','placeholder' => 'Sort']) !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-5 d-flex justify-content-end p-0">--}}
{{--            <div class="col-md-12 px-md-3 px-0 multi-option {{ ($main && ($main->type =='package_product' || $main->type =='filter' )) ? '' : 'hide' }}">--}}
{{--                <div class="row h-100 align-items-center">--}}
{{--                    <div class="col-lg-5">--}}
{{--                        <div class="row">--}}
{{--                            <label class="col-xl-6 col-form-label">--}}
{{--                                Min Limit :--}}
{{--                            </label>--}}
{{--                            <div class="col-xl-6 align-self-center">--}}
{{--                                {!! Form::number("variations[$main_unique][min_count_limit]",--}}
{{--                                (($main) ? $main->min_count_limit : null),['class' => 'form-control']) !!}--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="col-lg-7 mb-lg-0 mb-1">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-xl-8 col-form-label">--}}
{{--                                How Many items user can select :--}}
{{--                            </div>--}}
{{--                            <div class="col-xl-4 align-self-center">--}}
{{--                                {!! Form::number("variations[$main_unique][count_limit]",--}}
{{--                                                                ($main) ? $main->count_limit : null,['class' => 'form-control']) !!}--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-1 col d-flex pr-0 head-right justify-content-end">--}}
{{--            {!! Form::hidden("variations[$main_unique][is_required]",$required) !!}--}}
{{--            <button type="button" class="btn btn-danger delete-v-option"><i class="fa fa-times"></i></button>--}}
{{--        </div>--}}
{{--</div>--}}
{{--<div class="card-body panel-body">--}}
{{--<div class="row">--}}
{{--<div class="col-sm-12 type-place">--}}
{{--    <div class="product-wall">--}}
{{--        @if($main && $main->type =='package_product')--}}
{{--            @include('admin.stock._partials.package_item')--}}
{{--        @elseif($main && $main->type =='single')--}}
{{--            @include('admin.stock._partials.simple_item')--}}
{{--        @elseif($main && $main->type =='filter')--}}
{{--            @include('admin.stock._partials.filter_item')--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}


