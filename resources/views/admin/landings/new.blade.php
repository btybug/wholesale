@extends('layouts.admin')
@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading d-flex justify-content-between">
            <h2 class="m-0 pull-left">@if($model) Edit @else Create @endif Landing</h2>
        </div>
        <div class="card-body panel-body">
            {!! Form::model($model) !!}
            {!! Form::hidden('id',null) !!}
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="text" class="col-form-label">Name</label>
                        {!! Form::text('name',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="text" class="col-form-label">Url (starts with /landings)</label>
                        {!! Form::text('url',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="text" class="col-form-label">Upload content Html</label>
                        {!! media_button('content',$model) !!}
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@stop
@section('js')
    <script>

    </script>
@stop
