{!! Form::open(['class' => 'form-horizontal','url' =>url('admin/find/products'),'id' => 'findForm','method'=>'GET']) !!}
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="barcode" class="col-sm-2 col-form-label">Product name</label>
                <div class="col-sm-10">
                    {!! Form::text('name',@$data['name'],['class' => 'form-control','placeholder' => 'product name']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="barcode" class="col-sm-2 col-form-label">Product slug</label>
                <div class="col-sm-10">
                    {!! Form::text('slug',@$data['slug'],['class' => 'form-control','placeholder' => 'product slug']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="product-name" class="col-sm-2 col-form-label">Brands</label>
                <div class="col-sm-10">
                    {!! Form::select('brands[]',$brands,@$data['brands'],['class' => 'form-control brands','multiple' => true]) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="product-id" class="col-sm-2 col-form-label">Categories</label>
                <div class="col-sm-10">
                    {!! Form::select('categories[]',$categories,@$data['categories'],['class' => 'form-control categories','multiple' => true]) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="product-name" class="col-sm-2 col-form-label">Price start</label>
                <div class="col-sm-10">
                    {!! Form::number('amount[]',@$data['amount'][0],['class' => 'form-control','placeholder' => 'product price start']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="product-name" class="col-sm-2 col-form-label">Price to</label>
                <div class="col-sm-10">
                    {!! Form::number('amount[]',@$data['amount'][1],['class' => 'form-control','placeholder' => 'product price to']) !!}
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
        <div class="col-sm-6">
            <div class="form-group row">
                <label class="col-md-4 control-label" for="radios">Status</label>
                <div class="col-md-4">
                    <div class="radio">
                        <label for="radios-0">
                            <input type="radio" name="status" id="radios-0" value="1"
                                   @if( @$data['status']==='1')checked="checked" @endif>
                            Published
                        </label>
                    </div>
                    <div class="radio">
                        <label for="radios-1">
                            <input type="radio" name="status" id="radios-1" value="3"
                                   @if( @$data['status']==='3')checked="checked" @endif>
                            Draft
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Find</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
