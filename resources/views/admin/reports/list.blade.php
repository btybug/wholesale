@extends('layouts.admin')
@section('content-header')
@stop

@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading d-flex flex-wrap justify-content-between">
            <div class="">
                <h2 class="m-0">Reports</h2>
            </div>
            <div class=>
                @ok('admin_reports_new')<div class="pull-right "><a class="btn btn-primary pull-right" href="{!! route('admin_reports_new') !!}">Add new</a></div>@endok
            </div>
        </div>
        <div class="card-body panel-body">
            <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    {!! HTML::script('/public/js/google/analytic/date-range-selector.js') !!}
    <script>


    </script>
@stop
