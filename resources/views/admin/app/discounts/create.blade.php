@extends('layouts.admin',['activePage'=>'others'])
@section('content')

        <div class="col-md-12">
            <div class="card card-plain">
                <div class="d-flex justify-content-between card-header card-header-primary">
                    <div>
                        <h4 class="card-title mt-0">Admin discount</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-8">
                        {!! Form::model($model, ['id' => 'form-discount','class' => 'form-horizontal']) !!}
                        {!! Form::hidden('id') !!}
                        <div class="form-group row required">
                            <label class="col-md-2 control-label" for="input-code">
                                <span data-toggle="tooltip" title="" data-original-title="">Name</span></label>
                            <div class="col-md-10">
                                {!! Form::text('name',null,[ 'class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row required">
                            <label class="col-md-2 control-label" for="input-code">
                                <span data-toggle="tooltip" title="" data-original-title="">Discount type</span></label>
                            <div class="col-md-10">
                                {!! Form::select('type',[0=> 'Percentage',1=> 'Fixed Amount'],null,[ 'class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label" for="input-discount">Discount amount</label>
                            <div class="col-md-10">
                                {!! Form::number('amount',null,['placeholder' => 'Amount','class'=> 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label" for="input-status"></label>
                            <div class="col-md-10 text-right">
                                {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@stop

@section('js')
    <script>

    </script>
@stop
