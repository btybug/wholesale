@extends('layouts.admin')
@section('content')
    {!! Form::open() !!}
        <div class="form-group row">
            <div class="col-md-8">
                <div class="row">
                    <label for="text" class="col-4 col-form-label">Code</label>
                    <div class="col-8">
                        <div class="d-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-code"></i>
                                    </div>
                                </div>
                                <input id="text" name="code" type="text" class="form-control">
                            </div>
                            <button  type="button" id="generate-code" class="btn btn-primary">Generate</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
 {!! Form::close() !!}
@stop
@section('js')
    <script>
        $(function () {
            $('#generate-code').on('click',function () {
                $('input[name=code]').val(makeid(15))
            })
            function makeid(length) {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

                for (var i = 0; i < length; i++)
                    text += possible.charAt(Math.floor(Math.random() * possible.length));

                return text;
            }
        });



    </script>
    @stop
