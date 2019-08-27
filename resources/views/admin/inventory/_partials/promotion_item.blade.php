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
                <button type="button" class="btn btn-info save-extra-variations pull-right " data-type="normal">
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
    @if($model && isset($variations))
        @foreach($variations as $v)
            @php
                $isModelExists = ($model && isset($v) && count($v)) ? true : false;
                $main_unique = ($isModelExists) ? $v->first()->variation_id :uniqid();
                $main = ($isModelExists) ? $v->first() : null;
            @endphp
            <div class="col-sm-12 type-place">
                <div class="product-wall">
                    @if($main && $main->type =='package_product')
                        @include('admin.stock._partials.promotions.package_item')
                    @elseif($main && $main->type =='single')
                        @include('admin.stock._partials.promotions.simple_item')
                    @elseif($main && $main->type =='filter')
                        @include('admin.stock._partials.promotions.filter_item')
                    @endif
                </div>
            </div>
        @endforeach
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
