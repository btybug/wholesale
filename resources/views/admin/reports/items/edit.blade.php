
    <div class="accordion" id="accordionExample">
        @foreach($items as $item)
            <div class="card">
                <div class="card-header" id="heading{!! $item->id !!}">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{!! $item->id !!}"
                                aria-expanded="true" aria-controls="collapse{!! $item->id !!}">
                            {!! $item->name !!}
                        </button>
                    </h2>
                </div>

                <div id="collapse{!! $item->id !!}" class="collapse" aria-labelledby="heading{!! $item->id !!}"
                     data-parent="#accordionExample">
                    <div class="card-body">
                        {!! Form::model($item) !!}
                            <div class="form-group row">
                                <label for="text2" class="col-4 col-form-label">Name</label>
                                <div class="col-8">
                                    {!! Form::text('name',null,['class'=>'form-control']) !!}
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
                                    {!! Form::select('brand_id',$brands,null,['class'=>'custom-select']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="select" class="col-4 col-form-label">Categories</label>
                                <div class="col-8">
                                    {!! Form::select('categories',$categories,$item->categories->pluck('id'),['class'=>'custom-select','multiple'=>true]) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-4">Status</label>
                                <div class="col-8">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        {!! Form::radio('status',1,null,['class'=>'','id'=>$item->id.'_published']) !!}
                                        <label for="{!! $item->id !!}_published'" class="">Published</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        {!! Form::radio('status',0,null,['class'=>'','id'=>$item->id.'_draft']) !!}
                                        <label for="{!! $item->id !!}_draft" class="">Draft</label>
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
                </div>
            </div>
        @endforeach
    </div>
