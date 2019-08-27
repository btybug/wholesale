<div class="filters-select-wizard" id="{!! $uniqId !!}" data-type="{!! $type !!}" data-toggle="modal"
     data-group="{!! $group !!}" data-name="{!! $name.(($is_multiple)?'[]':null) !!}"
     data-multiple="{!! $is_multiple !!}" data-action="{!! $category->id !!}">

    {!! Form::open(['id'=>'filter-form']) !!}
    {!! Form::hidden('type',$type) !!}
    {!! Form::hidden('group',$group) !!}
    {!! Form::hidden('category_id', $category->id) !!}
    <div class="row flex-column justify-content-center mb-2">
        <div class="col-sm-6">
            <div class="form-group row">
                <label class="col-md-4 col-xs-12">{!! $category->name !!}</label>
                <div class="col-md-8">
                    {!! Form::select('filters[]',[null=>'Select Parent']+$category->filters()->get()->pluck('name','id')->toArray(),null,
                    ['class'=>'form-control filter-select','required'=>true]) !!}
                </div>

            </div>
            <div class="filter-children-selects row flex-column">

            </div>
        </div>

    </div>
    {!! Form::close() !!}
    <div class="releted__products-panel">
        <div>

            <div class="product-body">
                <div class="get-all-attributes-tab filter-children-items">

                </div>
            </div>

        </div>
    </div>
</div>
