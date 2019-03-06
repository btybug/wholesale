<div class="select-product wall-select">
    <div class="form-group">
        <div class="">
            <label class="col-md-3 control-label">Select Product</label>
            <div class="col-md-9">
                {!! Form::select('products',$products,null,['class'=>'form-control','id'=>'select-product-option']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="">
            <label class="col-md-3 control-label">Count</label>
            <div class="col-md-9">
                {!! Form::number('product_count',null,['class'=>'form-control','min'=>1,'step'=>1]) !!}
            </div>
        </div>
    </div>
</div>