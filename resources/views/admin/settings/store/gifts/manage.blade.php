@extends('layouts.admin')
@section('content')
    <div class="create-or-update">
        {!! Form::model(null,['class'=>'form-horizontal']) !!}
        <div class=" pull-right">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
            @if(count(get_languages()))
                <ul class="nav nav-tabs">
                    @foreach(get_languages() as $language)
                        <li class="@if($loop->first) active @endif"><a data-toggle="tab"
                                                                       href="#{{ strtolower($language->code) }}">
                                <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                            </a></li>
                    @endforeach
                </ul>
            @endif
                <div class="tab-content">
                    @if(count(get_languages()))
                        @foreach(get_languages() as $language)
                            <div id="{{ strtolower($language->code) }}"
                                 class="tab-pane fade  @if($loop->first) in active @endif">
                                <div class="form-group">
                                    <div class="">
                                        <label class="col-md-3 control-label">Title</label>
                                        <div class="col-md-9">
                                            {!! Form::text('translatable['.strtolower($language->code).'][title]',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            <div class="form-group">
                <div class="">
                    <label class="col-md-3 control-label">Icon</label>
                    <div class="col-md-9">
                        {!! Form::text('icon',null,['class'=>'form-control icon-picker']) !!}
                    </div>
                </div>
            </div>
                <div class="form-group">
                <div class="">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-9 row">
                        <div class="col-md-6">
                            <label class="col-md-3 control-label">start</label>
                            <div class="col-md-9">
                                {!! Form::date('start_date',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-3 control-label">end</label>
                            <div class="col-md-9">
                                {!! Form::date('end_date',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <label class="col-md-3 control-label">Based on</label>
                    <div class="col-md-9">
                        {!! Form::select('based_on',[
                        'create_product'=>'Available for create product',
                        'product'=>'Product',
                        'order_amount'=>'Order Amount',
                        'promo_code'=>'Promo code',
                        ],null,['id'=>'based-on', 'class'=>'form-control']) !!}
                    </div>
                </div>

            </div>
            <div class="based-on-container">

            </div>

            <div class="form-group">
                <div class="">
                    <label class="col-md-3 control-label">Free Juices count</label>
                    <div class="col-md-9">
                        {!! Form::number('free_juices_count',null,['class'=>'form-control','min'=>1,'step'=>1]) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3">

                </div>
                <div class="col-md-9">
                    <div class="can-selected-radio">
                        <h4>Can be selected </h4>
                        <label class="radio-inline">
                            {!! Form::radio('choice_type','all_juices',true) !!}All
                        </label>
                        <label class="radio-inline">
                            {!! Form::radio('choice_type','choose_juices') !!}Choose
                        </label>
                        <label class="radio-inline">
                            {!! Form::radio('choice_type','query_juices') !!}Query
                        </label>
                        <div class="radio-wall-container"></div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">

    <link rel="stylesheet" href="https://farbelous.io/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">

    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script src="https://farbelous.io/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js"></script>

    <script>

    $('.icon-picker').iconpicker();
        var HTML ={
            product: `@include('admin.settings.store.gifts.products')`,
            order_amount:  `@include('admin.settings.store.gifts.order_amount')`,
            promo_code: `@include('admin.settings.store.gifts.promo_code')`,
            all_juices:``,
            query_juices:  `@include('admin.settings.store.gifts.query_juices')`,
            query_juices_tr:  `@include('admin.settings.store.gifts.query_juices_tr')`,
            choose_juices: `@include('admin.settings.store.gifts.choose_juices')`,
        }
    </script>
    <script src="{{asset('public/js/custom/gifts.js')}}"></script>


@stop