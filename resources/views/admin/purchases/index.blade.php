@extends('layouts.admin',['activePage'=>'purchases'])
@section('content')
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Purchase Table</h4>
                <p class="card-category"> Here is a subtitle for this table</p>
            </div>
            <div class="card-body panel-body">
                <table id="items-table" class="table table-style table-bordered table-items-wrapper" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>QTY</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Order number</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
@stop
@section('js')
    <script>
        $(function () {
            $('#items-table').DataTable({
                ajax: "{!! route('datatable_all_purchase') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                // "ordering": false,
                dom: 'Bfrtip',
                'columnDefs': [{
                    'targets': 0, /* column index */
                    'orderable': false, /* true or false */

                }],
                buttons: [
                    {extend: 'csv', className: 'btn btn-primary'},
                    {extend: 'excel', className: 'btn btn-info'},
                    {extend: 'pdf', className: 'btn btn-success'},
                    {extend: 'print', className: 'btn btn-warning'},
                    // 'csv', 'excel', 'pdf', 'print',
                    {
                        text: 'Purchase',
                        action: function (e, dt, node, config) {
                            console.log(555);
                            $('form#purchase-form').submit();
                        }
                    }
                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'qty', name: 'qty'},
                    {data: 'price', name: 'price'},
                    {data: 'amount', name: 'amount'},
                    {data: 'order_number', name: 'order_number'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        })
    </script>
@stop
