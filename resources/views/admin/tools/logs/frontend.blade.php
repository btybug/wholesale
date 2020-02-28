@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
        <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link " id="info-tab" href="{!! route('admin_staff') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Staff</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="shipping-tab" href="{!! route('admin_tools_logs') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">Activity Log Frontend</a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" id="payment_gateways" href="{!! route('admin_tools_logs_backend') !!}" role="tab"
                   aria-controls="shipping" aria-selected="false">Activity Log Backend</a>
            </li>
        </ul>
    </div>

            <div class="" id="myTabContent">
                    <div class="card">
                        <div class="d-flex justify-content-between px-4 mt-2">
                            <div>
                                <select name="table_head" id="table_head_id" class="selectpicker" multiple>
                                    <option value="User" data-column="0" data-name="user">User</option>
                                    <option value="Url" data-column="1" data-name="url">Url</option>
                                    <option value="Method" data-column="2" data-name="method">Method</option>
                                    <option value="Ip" data-column="3" data-name="ip">Ip</option>
                                    <option value="Iso Code" data-column="4" data-name="iso_code">Iso Code</option>
                                    <option value="Country" data-column="5" data-name="country">Country</option>
                                    <option value="City" data-column="6" data-name="city">City</option>
                                    <option value="State" data-column="7" data-name="state">State</option>
                                    <option value="State Name" data-column="8" data-name="state_name">State Name</option>
                                    <option value="Timezone" data-column="9" data-name="timezone">Timezone</option>
                                    <option value="Agent" data-column="10" data-name="agent">Agent</option>
                                    <option value="Date" data-column="11" data-name="created_at">Date</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table id="users-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Url</th>
                                    <th>Method</th>
                                    <th>Ip</th>
                                    <th>Iso Code</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>State Name</th>
                                    <th>Timezone</th>
                                    <th>Agent</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

            </div>


</div>
    @stop

@section('js')
    <script>

        $(document).ready(function() {

            // function tableInit(storageName, selectData, selectId, tableData, tableId, ajaxUrl) {
            //     if(!localStorage.getItem(storageName)) {
            //         localStorage.setItem(storageName, JSON.stringify(selectData))
            //     }
            //
            //     let selId = JSON.parse(localStorage.getItem(storageName)).map((el) => {
            //         return el.id;
            //     });
            //
            //     $(selectId).selectpicker({
            //         // actionsBox: true,
            //         dropupAuto: true,
            //         // header: 'Select',
            //         liveSearch: true,
            //         liveSearchPlaceholder: 'Search',
            //         multipleSeparator: ' | ',
            //         style: 'btn-default',
            //         // width: 'auto'
            //     });
            //     $(selectId).selectpicker('val', selId);
            //     var tableHeadArray = tableData;
            //
            //     tableArray = tableHeadArray.map((head) => {
            //         const id = head.data;
            //         var visible = JSON.parse(localStorage.getItem(storageName)).find((el) => {
            //             return el.name === id;
            //         });
            //         if(visible) {
            //             return head;
            //         } else {
            //             return {
            //                 ...head,
            //                 visible: false
            //             };
            //         }
            //     });
            //     var table = $(tableId).DataTable({
            //         ajax: ajaxUrl,
            //         "processing": true,
            //         "serverSide": true,
            //         "bPaginate": true,
            //         dom: 'Bfrtip',
            //         buttons: [
            //             'csv', 'excel', 'pdf', 'print'
            //         ],
            //         columns: tableHeadArray,
            //         order: [ [0, 'desc'] ]
            //     });
            //
            //     function init() {
            //         var selected_items = [];
            //         $(`${selectId} option`).each(function() {
            //             var column = table.column($(this).attr('data-column'));
            //             if($(this).is(':selected')) {
            //                 selected_items.push({
            //                     id: $(this).val(),
            //                     text: $(this).val(),
            //                     name: $(this).attr("data-name")
            //                 });
            //                 column.visible(true);
            //             } else {
            //                 column.visible(false);
            //             }
            //         });
            //         console.log(selected_items, 'selected_items')
            //         localStorage.setItem(storageName, JSON.stringify(selected_items))
            //     }
            //
            //     init();
            //
            //     $(selectId).on('changed.bs.select', function (e) {
            //         init();
            //     });
            // }

            $(function () {
                $('#users-table').DataTable({
                    ajax:  "{!! route('datatable_frontend_activity') !!}",
                    dom: '<"d-flex justify-content-between align-items-baseline"lfB><rtip>',
                    displayLength: 10,
                    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                    "scrollX": true,
                    buttons: [
                        'csv', 'excel', 'pdf', 'print'
                    ],
                    columns: [
                        {data: 'user',name: 'user'},
                        {data: 'url',name: 'url'},
                        {data: 'method', name: 'method'},
                        {data: 'ip', name: 'ip'},
                        {data: 'iso_code', name: 'iso_code'},
                        {data: 'country', name: 'country'},
                        {data: 'city', name: 'city'},
                        {data: 'state', name: 'state'},
                        {data: 'state_name', name: 'state_name'},
                        {data: 'timezone', name: 'timezone'},
                        {data: 'agent', name: 'agent'},
                        {data: 'created_at', name: 'created_at'},
                    ],
                    order: [ [0, 'desc'] ]
                });
            });

            {{--tableInit(--}}
            {{--    "staff_activity_log_frontend_table",--}}
            {{--    [--}}
            {{--        {id: 'User',name: 'user'},--}}
            {{--        {id: 'Url',name: 'url'},--}}
            {{--        {id: 'Method', name: 'method'},--}}
            {{--        {id: 'Ip', name: 'ip'},--}}
            {{--        {id: 'Iso Code', name: 'iso_code'},--}}
            {{--        {id: 'Country', name: 'country'},--}}
            {{--        {id: 'City', name: 'city'},--}}
            {{--        {id: 'State', name: 'state'},--}}
            {{--        {id: 'State Name', name: 'state_name'},--}}
            {{--        {id: 'Timezone', name: 'timezone'},--}}
            {{--        {id: 'Agent', name: 'agent'},--}}
            {{--        {id: 'Date', name: 'created_at'}--}}
            {{--    ],--}}
            {{--    '#table_head_id',--}}
            {{--    [--}}
            {{--        {data: 'user',name: 'user'},--}}
            {{--        {data: 'url',name: 'url'},--}}
            {{--        {data: 'method', name: 'method'},--}}
            {{--        {data: 'ip', name: 'ip'},--}}
            {{--        {data: 'iso_code', name: 'iso_code'},--}}
            {{--        {data: 'country', name: 'country'},--}}
            {{--        {data: 'city', name: 'city'},--}}
            {{--        {data: 'state', name: 'state'},--}}
            {{--        {data: 'state_name', name: 'state_name'},--}}
            {{--        {data: 'timezone', name: 'timezone'},--}}
            {{--        {data: 'agent', name: 'agent'},--}}
            {{--        {data: 'created_at', name: 'created_at'},--}}
            {{--    ],--}}
            {{--    '#users-table',--}}
            {{--    "{!! route('datatable_frontend_activity') !!}"--}}
            {{--);--}}

        });

    </script>
@stop
