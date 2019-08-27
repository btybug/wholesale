@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="card panel panel-default">

        <div class="card-header panel-heading clearfix">
            <div class="pull-left">
                <h2 class="m-0">Manage</h2>
            </div>
        </div>
        <div class="card-body panel-body">
            <div class="table-responsive">
                <table class="table table-hover ">
                    <thead>
                    <th>
                        Name
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        QTY
                    </th>
                    <th>
                        Total
                    </th>
                    <th>
                        Note
                    </th>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                {!! $item->parent->name !!}
                            </td>
                            <td>
                                {!! number_format($item->price,1,'.',',')!!}$
                            </td>
                            <td>
                                {!! $item->qty !!}
                            </td>
                            <td>
                                {!! $item->qty * $item->price!!}
                            </td>
                            <td>
                                {!! $item->note!!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
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
