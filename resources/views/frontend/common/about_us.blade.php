@extends('layouts.frontend')
@section('content')
    <h3>About US</h3>

    <div>
        {!! @$model->description !!}
    </div>
@stop