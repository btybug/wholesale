@extends('layouts.frontend')
@section('content')
    <div class="landings_page-wrapper">
        <div class="container main-max-width">
            <div class="row">
                @foreach($items as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="landings-single-item">
                            <div class="row">
                                <div class="col-sm-7 pr-sm-0 pr-3">
                                    <div class="landings-single-item-photo">
                                        <img src="{{ $item->image }}"/>
                                    </div>
                                </div>
                                <div class="col-sm-5 pl-sm-0 pl-3">
                                    <div class="landings-single-item-title">
                                        <span class="font-main-bold font-18 text-main-clr">{{ $item->name }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
@section('css')
@stop
@section('js')

@stop
