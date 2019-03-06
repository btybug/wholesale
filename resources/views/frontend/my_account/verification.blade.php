@extends('layouts.frontend')
@section('content')
    <main class="page-main-content main-content">
        <div class="d-flex h-100">
    @include('frontend._partials.left_bar')

            <div class="main-right-wrapp">
                <div class="container mt-5">
                    <div class="registration-area">
                        {!! Form::open(['files'=>true]) !!}
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="select">Document Type</label>
                            <div class="col-10">
                                {!! Form::select('verification_type',[
                                null=>'Select Type',
                                'passport'=>'Passport',
                                'driving_license'=>'Driving license',
                                'national_id'=>'National ID'
                                ],null,['class'=>($errors->has('verification_type') ? 'custom-select form-control is-invalid' : 'custom-select '),'id'=>'verification_type']) !!}
                                @if ($errors->has('verification_type'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('verification_type') }}</strong>
                                </span>
                                @endif
                                <input type="hidden" class="form-control{{ $errors->has('verification_image') ? ' is-invalid' : '' }}">
                                @if ($errors->has('verification_image'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('verification_image') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="upload d-none">
                            <div class="form-group row">
                                <label for="text" class="col-2 col-form-label">Upload Image</label>
                                <div class="col-10">
                                    {!! Form::file('verification_image',['class'=>($errors->has('verification_image') ? ' is-invalid' : '')]) !!}

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-2 col-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
            @include('frontend.my_account._partials.verify_bar.blade_old.php')

        </div>
    </main>
@stop
@section('js')
    <script>
        $(function () {
            $('#verification_type').on('change',function () {
                if($(this).val()){
                    $('.upload').removeClass('d-none');
                }else {
                    $('.upload').addClass('d-none');
                }
            })
        })
    </script>
    @stop