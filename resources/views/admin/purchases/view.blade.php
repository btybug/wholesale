@extends('layouts.account',['activePage'=>'orders'])
@section('content')
    <div class="row">
        <div class="card-body">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="d-flex justify-content-between card-header card-header-primary">
                        <div>
                            <h4 class="card-title mt-0">The Selected Items</h4>
                        </div>
                    </div>
                    <div class="card-body">
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
                                            {!! $item['name'] !!}
                                        </td>
                                        <td>
                                            {!! number_format($item['price'],1,'.',',')!!}$
                                        </td>
                                        <td>
                                            {!! $item['qty'] !!}
                                        </td>
                                        <td>
                                            {!! $item['qty'] * $item['price']!!}
                                        </td>
                                        <td>
                                            {!! $item['note']!!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
