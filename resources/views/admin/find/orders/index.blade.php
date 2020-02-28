@extends('layouts.admin')
@section('content-header')
@stop
@section('content')
    <div class="admin-find-wrapper">
        <div class="find-form">
            @include('admin.find.orders.form')
        </div>

        <div class="find-wrapper-results mt-5">
            <div class="find-wrapper-results-head">
                <h3>Results</h3>
                <div class="find-wrapper-results-head-right">

                    <select class="form-control mr-3">
                        <option value="">Action</option>
                        <option value="">Print Barcode</option>
                        <option value="">Print Qr Code</option>
                    </select>
                    <button class="btn btn-warning btn-edit ">GO</button>
                </div>
            </div>

            <div class="find-wrapper-results-content">
                @include('admin.find.orders.results')
            </div>

        </div>
    </div>
@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/public/js/DataTables/css/editor.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="/public/js/DataTables/css/editor.dataTables.css">
    <link rel="stylesheet" href="/public/js/DataTables/css/editor.bootstrap.css">
@stop
@section('js')

    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    {{--    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>

    <script src="{{url('public/js/DataTables/js/editor.bootstrap4.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>

    <script src="{{url('public/js/DataTables/js/editor.bootstrap.min.js')}}"></script>
    <script src="{{url('public/js/DataTables/js/editor.select2.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(function () {
            $("body").find("#customer").select2();
            $("body").find("#payment_method").select2();
            $("body").find("#status").select2();
            $("body").find(".barcodes").select2();

            {{$dataTable->generateScripts()}}
        })
    </script>
@stop
