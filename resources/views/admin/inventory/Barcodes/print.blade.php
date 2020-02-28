@extends('layouts.admin')
@section('content')
    <div class="form-group row">
        <div class="col-md-8">
            <div class="row">
                {!! DNS1D::getBarcodeHTML($barcode->code, "EAN13",3,100,"black", true); !!}
            </div>
        </div>
    </div>
@stop
@section('js')

@stop
