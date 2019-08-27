@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">

        <div class="card-header panel-heading clearfix">
            <div class="pull-left">
                <h2 class="m-0">Requests</h2>
            </div>
        </div>
        <div class="card-body panel-body">
            <div class="table-responsive">
            <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <table class="table table-hover ">
                    <thead>
                    <th>
                        Status
                    </th>
                    <th>
                        Site
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                       Customer
                    </th>
                    <th>
                        Purchase date
                    </th>
                    <th>
                        Delivery Date
                    </th>
                    <th>
                        Actions
                    </th>
                    </thead>
                    <tbody>

                    @foreach($exports as $export)
                        <tr>
                            <td>
                                {!! \App\Models\Exports::$status[$export->status] !!}
                            </td>
                            <td>
                                {!! $export->site_id !!}
                            </td>
                            <td>
                                {!! $export->getPrice() !!}
                            </td>
                            <td>
                                {!! $export->customer_id !!}
                            </td>
                            <td>
                                {!! BBgetDateFormat($export->created_at) !!}
                            </td>
                            <td>
                                {!! BBgetDateFormat($export->delivery_date) !!}
                            </td>
                            <td>
                                <a class='btn btn-info' href="{!! route('admin_wholesallers_view',$export->id) !!}" class="table-del-link">view</a>
                                <a class='btn btn-success' href="{!! route('admin_wholesallers_manage',$export->id) !!}" class="table-del-link">Manage</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </table>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function () {
            {{--$('#users-table').DataTable({--}}
                {{--ajax: "{!! route('datatable_all_users') !!}",--}}
                {{--"processing": true,--}}
                {{--"serverSide": true,--}}
                {{--"bPaginate": true,--}}
                {{--dom: 'Bfrtip',--}}
                {{--buttons: [--}}
                    {{--'csv', 'excel', 'pdf', 'print'--}}
                {{--],--}}
                {{--columns: [--}}
                    {{--{data: 'id', name: 'id'},--}}
                    {{--{data: 'name', name: 'name'},--}}
                    {{--{data: 'last_name', name: 'last_name'},--}}
                    {{--{data: 'email', name: 'email'},--}}
                    {{--{data: 'membership', name: 'membership'},--}}
                    {{--{data: 'phone', name: 'phone'},--}}
                    {{--{data: 'country', name: 'country'},--}}
                    {{--{data: 'gender', name: 'gender'},--}}
                    {{--{data: 'status', name: 'status'},--}}
                    {{--{data: 'verification_type', name: 'verification_type'},--}}
                    {{--{data: 'customer_number', name: 'customer_number'},--}}
                    {{--{data: 'created_at', name: 'created_at'},--}}
                    {{--{data: 'actions', name: 'actions'}--}}
                {{--]--}}
            {{--});--}}
        });

    </script>
@stop
