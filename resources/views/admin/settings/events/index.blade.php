@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered table-dark">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach(config('events') as $key=>$event)
                <tr>
                    <td>{!! $key !!}</td>
                    <td>{!! $event['description'] !!}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
