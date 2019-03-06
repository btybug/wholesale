@extends('layouts.frontend')
@section('content')
<main class="main-content">
    <div class="col-md-8">
        {!! Form::open([]) !!}
        <div class="d-flex flex-wrap">
            <div class="col-sm-8 col-lg-9 pl-xl-0">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label input-label" for="contact-me-name">Name</label>
                            {!! Form::text('name',old('name'),['class' => $errors->has('name') ? 'form-control form-custom--control is-invalid' : 'form-control form-custom--control','placeholder' => 'Name']) !!}
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label input-label" for="contact-me-phone">Phone</label>
                            {!! Form::text('phone',old('phone'),['class' => $errors->has('phone') ? 'form-control form-custom--control is-invalid' : 'form-control form-custom--control','placeholder' => 'Phone']) !!}
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label input-label" for="contact-me-email">E-Mail</label>
                            {!! Form::email('email',old('email'),['class' => $errors->has('email') ? 'form-control form-custom--control is-invalid' : 'form-control form-custom--control','placeholder' => 'Email Address']) !!}
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label input-label" for="contact-me-email">Category</label>
                            {!! Form::select('category',[
                            'about_team' => 'Team'
                            ],old('category'),['class' => $errors->has('category') ? 'form-control form-custom--control is-invalid' : 'form-control form-custom--control','placeholder' => 'Select Category']) !!}
                            @if ($errors->has('category'))
                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label input-label" for="contact-me-message">Message</label>
                            {!! Form::textarea('message',old('message'),['class'=> $errors->has('message') ? 'form-control form-custom--control is-invalid' : 'form-control form-custom--control','placeholder' => 'Message','style' => 'height: 150px']) !!}
                            @if ($errors->has('message'))
                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row justify-content-sm-center justify-content-xl-start text-center text-xl-left">
                    <div class="col-sm-8 col-md-6">
                        <button class="btn btn-block btn-send text-uppercase" type="submit">send message</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-3 pr-xl-0 pt-sm-0 pt-2">
                <div class="text-center text-xl-left">
                    <address class="contact-info d-md-inline-block text-left">
                        <div class="d-flex flex-row unit">
                            <div class="unit-left mr-2"><span class="icon fa fa-map-marker"></span></div>
                            <div class="unit-body"><a href="#" class="text-main-clr">8901 Marmora Road, Glasgow, D04
                                    89GR</a></div>
                        </div>
                        <div class="d-flex flex-row unit">
                            <div class="unit-left mr-2"><span class="icon fa fa-phone"></span></div>
                            <div class="unit-body"><a href="tel:#" class="text-main-clr">1-800-1234-567</a></div>
                        </div>
                        <div class="d-flex flex-row unit">
                            <div class="unit-left mr-2"><span class="icon fa fa-envelope"></span></div>
                            <div class="unit-body"><a href="mailto:#" class="text-main-clr">info@ourteam.org</a></div>
                        </div>
                    </address>
                </div>
                <div class="text-center text-xl-left">
                    <ul class="d-flex flex-wrap social-icons justify-content-lg-end justify-content-center">
                        <li><a href="#"
                               class="d-flex align-items-center justify-content-center rounded-circle text-main-clr"><i
                                        class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="#"
                               class="d-flex align-items-center justify-content-center rounded-circle text-main-clr"><i
                                        class="fab fa-twitter"></i></a></li>
                        <li><a href="#"
                               class="d-flex align-items-center justify-content-center rounded-circle text-main-clr"><i
                                        class="fab fa-facebook-f"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</main>
@stop