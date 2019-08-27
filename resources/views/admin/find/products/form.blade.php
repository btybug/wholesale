{!! Form::open(['class' => 'form-horizontal','url' => route('find_product_results'),'id' => 'findForm']) !!}
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="barcode" class="col-sm-2 col-form-label">Product name</label>
                <div class="col-sm-10">
                    {!! Form::text('name',null,['class' => 'form-control','placeholder' => 'product name']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="barcode" class="col-sm-2 col-form-label">Product slug</label>
                <div class="col-sm-10">
                    {!! Form::text('slug',null,['class' => 'form-control','placeholder' => 'product slug']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="product-name" class="col-sm-2 col-form-label">Brands</label>
                <div class="col-sm-10">
                    {!! Form::select('brands[]',$brands,null,['class' => 'form-control brands','multiple' => true]) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="product-id" class="col-sm-2 col-form-label">Categories</label>
                <div class="col-sm-10">
                    {!! Form::select('categories[]',$categories,null,['class' => 'form-control categories','multiple' => true]) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="product-name" class="col-sm-2 col-form-label">Price start</label>
                <div class="col-sm-10">
                    {!! Form::number('amount[]',null,['class' => 'form-control','placeholder' => 'product price start']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="product-name" class="col-sm-2 col-form-label">Price to</label>
                <div class="col-sm-10">
                    {!! Form::number('amount[]',null,['class' => 'form-control','placeholder' => 'product price to']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="text" id="find-date__ranged" name="date" class="form-control" value="" placeholder="Date" aria-label="Recipient's date with two button addons" aria-describedby="button-addon4">
                        <div class="input-group-append" id="button-addon4">
                            <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"
                                    title="Date range">
                                <i class="fa fa-calendar"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
