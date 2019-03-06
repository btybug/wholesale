@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="m-0 pull-left">Notification</h2>
            @ok('create_admin_emails_notifications_send_email')
            <div class="text-right">
                <a class="btn btn-primary" href="{!! route('create_admin_emails_notifications_send_email') !!}">Create notification</a>
            </div>
            @endok
        </div>
        <div class="panel-body">
            <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>From</th>
                    <th>Subject</th>
                    <th>Created At</th>
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
            var datatable = $('#users-table').DataTable(
                {
                    ajax: "{!! route('datatable_all_custom_emails') !!}",
                    "processing": true,
                    "serverSide": true,
                    "bPaginate": true,
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'status', name: 'status'},
                        {data: 'category_id', name: 'category_id'},
                        {data: 'from', name: 'from'},
                        {data: 'subject', name: 'subject'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'actions', name: 'actions'}
                    ],
                    order: [ [1, 'ASC'] ]
                }
            );
            $('body').on('click', '.send-now', function () {
                var data = {'id': $(this).attr('data-id')};
                $.ajax({
                    url: "{!! route('admin_emails_notifications_send_now') !!}",
                    type: 'POST',
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        $('.error-box').html('');
                        if (data.error == false) {
                            datatable.ajax.reload();
                        }
                    },
                    error: function (data) {
                        // alert(data.err);
                    }
                });
            });
            $('body').on('click', '.copy-message', function () {
                var data = {'id': $(this).attr('data-id')};
                $.ajax({
                    url: "{!! route('admin_emails_notifications_copy') !!}",
                    type: 'POST',
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function (data) {
                        $('.error-box').html('');
                        if (data.error == false) {
                            datatable.ajax.reload();
                        }
                    },
                    error: function (data) {
                        // alert(data.err);
                    }
                });
            });

        });


    </script>
@stop