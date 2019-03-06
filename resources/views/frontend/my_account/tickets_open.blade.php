@extends('layouts.frontend')
@section('content')
    <main class="main-content position-relative">
        <div class="d-flex">
            {{--@include('frontend._partials.left_bar')--}}

            {{--acoount sidebar--}}
            <div class="profile-sidebar profile-sidebar--inner-pages d-flex flex-column align-items-center">
                @include('frontend.my_account._partials.left_bar')
                <div class="mt-auto">
                    {!! Form::open(['url'=>route('logout')]) !!}
                    <div class="text-center">
                        <button type="submit" class="profile-sidebar_logout-btn d-inline-flex align-items-center justify-content-center font-14 text-uppercase text-white pointer">Logout</button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>

            <div class="profile-inner-pg-right-cnt">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="profile-inner-pg-right-cnt_inner">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Sorry!</strong> There were more problems with your equest.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {!! Form::model(null,['url' => route('my_account_tickets_new_post'), 'id' => 'ticket_form','files' => true]) !!}
                            {!! Form::hidden('id',null) !!}
                            <div class="text-right btn-save">
                                {!! Form::submit('Save',['class' => 'btn btn-info']) !!}
                            </div>
                            <div class="row sortable-panels">
                                <div class="col-md-9 ">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="status-wall wall">
                                                        <div class="row form-group">
                                                            {{Form::label('subject', 'Subject',['class' => 'col-sm-3'])}}
                                                            <div class="col-sm-9">
                                                                {!! Form::text('subject',null,['class'=>'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group " id="category-related">

                                                    </div>
                                                    <div class="status-wall wall">
                                                        <div class="row form-group">
                                                            {{Form::label('summary', 'Summary',['class' => 'col-sm-3'])}}
                                                            <div class="col-sm-9">
                                                                {!! Form::textarea('summary',null,['class'=>'form-control','cols'=>30,'rows'=>2]) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3">Attachments</label>
                                                        <div class="col-sm-9">
                                                            {!! Form::file('attachments[]',['multiple' => true]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="view-product-wall">
                                        <div class="status-wall wall">
                                            <div class="row">
                                                {{Form::label('category_id', 'Category',['class' => 'col-sm-3'])}}
                                                <div class="col-sm-9">
                                                    {!! Form::select('category_id',[null=>'Select Category']+$categories,null,
                                                                ['class' => 'form-control','id'=> 'category']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            {{--@include('frontend.my_account._partials.verify_bar.blade_old.php')--}}

        </div>
    </main>
@stop

@section('css')
    <link rel="stylesheet" href="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.css">
    <link rel="stylesheet" href="{{asset('public/admin_theme/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')

    <script src="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.js"></script>
    <script src="{{asset('public/admin_theme/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="/public/admin_theme/blog_new.js"></script>
    <script src="/public/js/tiket.js"></script>

@stop
