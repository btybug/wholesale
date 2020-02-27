<div class="">
    <h3> Edit Item</h3>
    {!! Form::model($model,['url' => route('post_admin_items_edit_row_save')]) !!}
    <div class="form-group row">
        <label for="text2" class="col-4 col-form-label">Name</label>
        <div class="col-8">
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        <label for="text2" class="col-4 col-form-label">Short Description</label>
        <div class="col-8">
            {!! Form::text('short_description',null,['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        <label for="text1" class="col-4 col-form-label">Price</label>
        <div class="col-8">
            {!! Form::number('default_price',null,['class'=>'form-control','min'=>0,'step'=>0.01]) !!}
        </div>
    </div>
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Brand</label>
        <div class="col-8">
            {!! Form::select('brand_id',$brands,null,['class'=>'custom-select','style' => 'width:100%']) !!}
        </div>
    </div>
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Categories</label>
        <div class="col-8">
            {!! Form::select('categories[]',$categories,$model->categories()->pluck('id','id'),['class'=>'custom-select','style' => 'width:100%','multiple'=>true]) !!}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-4">Status</label>
        <div class="col-8">
            <div class="custom-control custom-radio custom-control-inline">
                {!! Form::radio('status',1,null,['class'=>'','id'=>$model->id.'_published']) !!}
                <label for="{!! $model->id !!}_published'" class="">Published</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                {!! Form::radio('status',0,null,['class'=>'','id'=>$model->id.'_draft']) !!}
                <label for="{!! $model->id !!}_draft" class="">Draft</label>
            </div>
        </div>
    </div>
    {!! Form::hidden('id') !!}
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary edit_item_custom">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}

</div>
