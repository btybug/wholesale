@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
                <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="info-tab" href="{!! route('admin_store_attributes') !!}" role="tab"
                           aria-controls="general" aria-selected="true" aria-expanded="true">Attributes</a>
                    </li>
                    @ok('admin_tools_stickers')
                    <li class="nav-item">
                        <a class="nav-link " id="general-tab" href="{!! route('admin_tools_stickers') !!}" role="tab"
                           aria-controls="accounts" aria-selected="true" aria-expanded="true">Stickers</a>
                    </li>
                    @endok
                </ul>
            </div>

            <div class="tab-content w-100">
                <div class="card panel panel-default">
{{--                    <div class="card-header panel-heading clearfix">--}}
{{--                        <h2 class="m-0 pull-left">Attributes</h2>--}}
{{--                    </div>--}}
                    <div class="d-flex justify-content-between px-4 mt-2">
                        <div>
                            <select name="table_head" id="table_head_id" multiple>
                                <option value="#" data-column="0" data-name="id">#</option>
                                <option value="Name" data-column="1" data-name="name">Name</option>
                                <option value="category" data-column="2" data-name="category">Category</option>
                                <option value="image" data-column="3" data-name="image">Image</option>
                                <option value="icon" data-column="4" data-name="icon">Icon</option>
                                <option value="filter" data-column="5" data-name="filter">Render Style</option>
                                <option value="display_as" data-column="6" data-name="display_as">Is Filter</option>
                                <option value="Added/Last Modified Date" data-column="7" data-name="created_at">Added/Last Modified Date</option>
                                <option value="Actions" data-column="8" data-name="actions">Actions</option>
                            </select>
                        </div>
                        <div class="ml-1">
                            @ok('admin_store_attributes_new')<div class="pull-right"><a class="btn btn-primary pull-right" href="{!! route('admin_store_attributes_new') !!}">Add new</a></div>@endok

                        </div>
                    </div>

                    <div class="card-body panel-body pt-0">

                        <table id="attributes-table" class="table table-style table-bordered " cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Icon</th>
                                <th>Is Filter</th>
                                <th>Render Style</th>
                                <th>Added/Last Modified Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
@stop
@section('js')
                <script>
                    $(function () {
                        function tableInit(storageName, selectData, selectId, tableData, tableId, ajaxUrl) {
                            if(!localStorage.getItem(storageName)) {
                                localStorage.setItem(storageName, JSON.stringify(selectData))
                            }

                            let selId = JSON.parse(localStorage.getItem(storageName)).map((el) => {
                                return el.id;
                            });

                            $(selectId).selectpicker({
                                // actionsBox: true,
                                dropupAuto: true,
                                // header: 'Select',
                                liveSearch: true,
                                liveSearchPlaceholder: 'Search',
                                multipleSeparator: ' | ',
                                style: 'btn-default',
                                // width: 'auto'
                            });
                            $(selectId).selectpicker('val', selId);
                            var tableHeadArray = tableData;

                            tableArray = tableHeadArray.map((head) => {
                                const id = head.data;
                                var visible = JSON.parse(localStorage.getItem(storageName)).find((el) => {
                                    return el.name === id;
                                });
                                if(visible) {
                                    return head;
                                } else {
                                    return {
                                        ...head,
                                        visible: false
                                    };
                                }
                            });
                            var table = $(tableId).DataTable({
                                ajax: ajaxUrl,
                                "processing": true,
                                "serverSide": true,
                                "bPaginate": true,
                                "scrollX": true,
                                dom: '<"d-flex justify-content-between align-items-baseline"lfB><rtip>',
                                displayLength: 10,
                                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                                buttons: [
                                    'csv', 'excel', 'pdf', 'print'
                                ],
                                columns: tableHeadArray
                            });

                            function init() {
                                var selected_items = [];
                                $(`${selectId} option`).each(function() {
                                    var column = table.column($(this).attr('data-column'));
                                    if($(this).is(':selected')) {
                                        selected_items.push({
                                            id: $(this).val(),
                                            text: $(this).val(),
                                            name: $(this).attr("data-name")
                                        });
                                        column.visible(true);
                                    } else {
                                        column.visible(false);
                                    }
                                });
                                console.log(selected_items, 'selected_items')
                                localStorage.setItem(storageName, JSON.stringify(selected_items))
                            }

                            init();

                            $(selectId).on('changed.bs.select', function (e) {
                                init();
                            });

                            $('#attributes-table thead tr').clone(true).appendTo( '#attributes-table thead' );
                            $('#attributes-table thead tr:eq(1) th').each( function (i) {
                                var title = $(this).text();
                                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

                                $( 'input', this ).on( 'keyup change', function () {
                                    if ( table.column(i).search() !== this.value ) {
                                        table
                                            .column(i)
                                            .search( this.value )
                                            .draw();
                                    }
                                } );
                            } );
                        }


                        tableInit(
                            "datatable_all_attributes",
                            [
                                {id: '#', text: '#', name: 'id'},
                                {id: 'Name', text: 'Name', name: 'attributes_translations.name'},
                                {id: 'Category', text: 'Category', name: 'category'},
                                {id: 'image', text: 'image', name: 'image'},
                                {id: 'icon', text: 'icon', name: 'icon'},
                                {id: 'filter', text: 'Is Filter', name: 'filter'},
                                {id: 'display_as', text: 'Render Style', name: 'display_as'},
                                {id: 'Added/Last Modified Date', text: 'Added/Last Modified Date', name: 'created_at'},
                                {id: 'Actions', text: 'Actions', name: 'actions'}
                            ],
                            '#table_head_id',
                            [
                                {data: 'id',name: 'id'},
                                {data: 'name', name: 'attributes_translations.name'},
                                {data: 'category', name: 'categories_translations.name'},
                                {data: 'image', name: 'image'},
                                {data: 'icon', name: 'icon'},
                                {data: 'filter', name: 'filter'},
                                {data: 'display_as', name: 'display_as'},
                                {data: 'created_at', name: 'created_at'},
                                {data: 'actions', name: 'actions'}
                            ],
                            '#attributes-table',
                            "{!! route('datatable_all_attributes') !!}"
                        )






                        {{--var table = $('#attributes-table').DataTable({--}}
                        {{--ajax:  "{!! route('datatable_all_attributes') !!}",--}}
                        {{--"processing": true,--}}
                        {{--"serverSide": true,--}}
                        {{--"bPaginate": true,--}}
                        {{--dom: 'Bfrtip',--}}
                        {{--buttons: [--}}
                        {{--'csv', 'excel', 'pdf', 'print'--}}
                        {{--],--}}
                        {{--columns: [--}}
                        {{--{data: 'id',name: 'id'},--}}
                        {{--{data: 'name', name: 'attributes_translations.name'},--}}
                        {{--{data: 'category', name: 'category'},--}}
                        {{--{data: 'image', name: 'image'},--}}
                        {{--{data: 'icon', name: 'icon'},--}}
                        {{--{data: 'filter', name: 'filter'},--}}
                        {{--{data: 'display_as', name: 'display_as'},--}}
                        {{--{data: 'created_at', name: 'created_at'},--}}
                        {{--{data: 'actions', name: 'actions'}--}}
                        {{--],--}}
                        {{--orderCellsTop: true,--}}
                        {{--fixedHeader: true--}}
                        {{--});--}}
                    });

                </script>
@stop
