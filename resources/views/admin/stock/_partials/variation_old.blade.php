@php
    $isModelExists = ($model && isset($v) && count($v)) ? true : false;
    $main_unique = ($isModelExists) ? $v->first()->variation_id :uniqid();
    $main = ($isModelExists) ? $v->first() : null;
@endphp
<div class="card panel panel-default stock-page" data-unqiue="{{ $main_unique }}">
    <div class="card-header panel-heading clearfix d-flex pr-0 stock-page--head">
        <div class="col-sm-6 d-flex flex-wrap head-left px-0 py-2">
            <div class="col-xl-3">
                {!! Form::text("variations[$main_unique][title]",($main) ? $main->title : null,['class' => 'form-control mr-1','placeholder' => 'Enter title ...']) !!}
            </div>
            <div class="col-xl-6 my-xl-0 my-1">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::select("variations[$main_unique][type]",['' => 'Select','package_product' => 'Multiple items','filter' => 'Filters','single' => 'Single item'
               ],($main) ? $main->type : null,
               ['class' => 'form-control variation-product-select']) !!}
                    </div>
                    <div class="col-md-6 mt-md-0 mt-1 filter-option {{ ($main && $main->type =='filter') ? '' : 'hide' }}">
                        {!! Form::select("variations[$main_unique][filter_category_id]",['' => 'Select Filter']+$filters,($main) ? $main->filter_category_id : null,
                        ['class' => 'form-control filter-select']) !!}
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                {!! Form::number("variations[$main_unique][ordering]",($main) ? $main->ordering : null,
                ['class' => 'form-control','placeholder' => 'Sort']) !!}
            </div>
        </div>
        <div class="col-sm-5 d-flex justify-content-end p-0">
            <div class="col-md-12 px-md-3 px-0 multi-option {{ ($main && ($main->type =='package_product' || $main->type =='filter' )) ? '' : 'hide' }}">
                <div class="row h-100 align-items-center">
                    <div class="col-lg-5">
                        <div class="row">
                            <label class="col-xl-6 col-form-label">
                                Min Limit :
                            </label>
                            <div class="col-xl-6 align-self-center">
                                {!! Form::number("variations[$main_unique][min_count_limit]",
                                (($main) ? $main->min_count_limit : null),['class' => 'form-control']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-7 mb-lg-0 mb-1">
                        <div class="row">
                            <div class="col-xl-8 col-form-label">
                                How Many items user can select :
                            </div>
                            <div class="col-xl-4 align-self-center">
                                {!! Form::number("variations[$main_unique][count_limit]",
                                                                ($main) ? $main->count_limit : null,['class' => 'form-control']) !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-1 col d-flex pr-0 head-right justify-content-end">
            {!! Form::hidden("variations[$main_unique][is_required]",$required) !!}
            <button type="button" class="btn btn-danger delete-v-option"><i class="fa fa-times"></i></button>
        </div>
</div>
<div class="card-body panel-body">
<div class="row">
<div class="col-sm-12 type-place">
    <div class="product-wall">
        @if($main && $main->type =='package_product')
            @include('admin.stock._partials.package_item')
        @elseif($main && $main->type =='single')
            @include('admin.stock._partials.simple_item')
        @elseif($main && $main->type =='filter')
            @include('admin.stock._partials.filter_item')
        @endif
    </div>
</div>
</div>
</div>
</div>


