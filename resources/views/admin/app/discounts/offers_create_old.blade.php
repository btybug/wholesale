@extends('layouts.admin',['activePage'=>'others'])
@section('content')
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="d-flex justify-content-between card-header card-header-primary">
                <div>
                    <h4 class="card-title mt-0">Offers</h4>
                </div>
            </div>
            {!! Form::model($model, ['id' => 'form-discount','class' => 'form-horizontal']) !!}
            <div class="card-body">
                <div class="row mx-0 mb-3">
                    {!! Form::select('type',[null=>'Select Type','buy_x_get'=>'Buy X Get Y'],null,['class'=>'form-control col-sm-3','id'=>'offers_select']) !!}
                </div>
                <div class="buy_x_get d-none content-select-wrap">
                    <div class="col-md-8">

                        {!! Form::hidden('id') !!}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <label for="offer_name" class="col-sm-4 col-form-label">Offer Name</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('name',null,['class'=>'form-control','id'=>'offer_name']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <div class="col-md-2">
                                If Customer Buy
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                    {!! Form::text('if_by',($model)?$model->data['if_by']:null,['class'=>'form-control','id'=>'customer_buy']) !!}

                                    </div>
                                    <div class="col-md-6">
                                    {!! Form::select('items[]',$items,($model)?$model->data['items']:null,['class'=>'form-control select_to_2_js','style'=>'width:100%']) !!}

                                    </div>
                                    <div class="col-md-2 text-right">
                                        <button class="btn btn-block btn-primary">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                            He will get free
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                    {!! Form::text('get_free',($model)?$model->data['get_free']:null,['class'=>'form-control','id'=>'get_free']) !!}

                                    </div>
                                    <div class="col-md-6">
                                    {!! Form::select('gifts[]',$items,($model)?$model->data['gifts']:null,['class'=>'form-control select_to_2_js','style'=>'width:100%']) !!}

                                    </div>
                                    <div class="col-md-2 text-right">
                                        <button class="btn btn-block btn-primary">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="text-left">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('css')
    <link href="/public/plugins/select2/select2.min.css" rel="stylesheet"/>
@stop
@section('js')
    <script src="/public/plugins/select2/select2.full.min.js"></script>
    <script>
        $(document).ready(function () {
            if($('#offers_select').val()){
                $('body').find('.'+$('#offers_select').val()).removeClass('d-none');
            }
           

            $('body').on('change', '#offers_select', function () {
                if ($(this).val() === 'buy_x_get') {
                    $(this).closest('.card-body').find(`.${$(this).val()}`).removeClass('d-none')
                } else {
                    $(this).closest('.card-body').find('.content-select-wrap').addClass('d-none')
                }
            });

            $('.select_to_2_js').select2();
        })
    </script>
@stop
