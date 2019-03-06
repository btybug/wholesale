<div class="status-wall wall">
    <div class="row form-group">
        {{Form::label('product_id', 'Product',['class' => 'col-sm-3'])}}
        <div class="col-sm-9">
            {!! Form::select('product_id',\App\Models\Stock::all()->pluck('name','id'),null,['class'=>'form-control']) !!}
        </div>
    </div>
</div>
