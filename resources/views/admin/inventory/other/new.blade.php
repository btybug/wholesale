@extends('layouts.admin')
@section('content')
    <div class="coupons_new_page card panel panel-default">
        <div class="card-header panel-heading">
            <h3 class="m-0">Others Form</h3>
        </div>
        <div class="card-body panel-body">
            <div class="col-xl-8">
                {!! Form::model($model,['url' => route('post_admin_inventory_others_new'),'id' => 'form-coupon','class' => '']) !!}
                {!! Form::hidden('id') !!}
                <div class="form-group row required">
                    <label class="col-md-2 control-label" for="input-code">
                        <span data-toggle="tooltip" title="" data-original-title="">Item</span></label>
                    <div class="col-md-10">
                        @if($model)
                            <div class="form-control">{{ $model->item->name }}</div>
                            {!! Form::hidden('item_id',null) !!}
                        @else
                            {!! Form::select('item_id',$items,null,[ 'class'=> 'form-control select-sku tag-input-v']) !!}
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table--store-settings">
                            <thead>
                            <tr class="bg-my-light-pink">
                                <th>Warehouse</th>
                                <th>Rack</th>
                                <th>Shelve</th>
                                <th>QTY</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody class="v-options-list-locations">
                                @include('admin.store.purchase.locations')
                            </tbody>

                            <tfoot>
                            <tr class="add-new-ship-filed-container">
                                <td colspan="5" class="text-right">
                                    <button type="button" class="btn btn-primary add-location"><i
                                            class="fa fa-plus-circle "></i>
                                    </button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 control-label" for="supplier">
                        Reason</label>
                    <div class="col-md-10">
                        {!! Form::select('reason',[
                        'Lost'=>'Lost',
                        'Damaged'=>'Damaged',
                        'Returned'=>'Returned',
                        'Faulty'=>'Faulty',
                        'Shelf life'=>'Shelf life',
                        'Confiscated'=>'Confiscated',
                        'Gift'=>'Gift',
                        'Marketing or designer needs '=>'Marketing or designer needs',
                        'Admin needs'=>'Admin needs',
                        'Stolen'=>'Stolen',
                        ],null,[ 'class'=> 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="supplier">
                        Notes</label>
                    <div class="col-md-10">
                        {!! Form::textarea('notes',null,[ 'class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 control-label" for="input-status"></label>
                    <div class="col-md-10 text-right">
                        {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            @if($model)
                <div class="col-md-12">
                    <h3>Edit history (Log)</h3>
                    <div class="col-xs-12">
                        <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Qty</th>
                                <th>Reason</th>
                                <th>Moderator</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            @endif
        </div>

    </div>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(".tag-input-v").select2({ width: '100%' });

        $(document).ready(function () {
            $("body").on('click', '.add-location', function () {
                AjaxCall(
                    "{{ route('admin_item_locations') }}",
                    {},
                    function (res) {
                        if (!res.error) {
                            $('.v-options-list-locations').append(res.html)
                        }
                    }
                );
            });

            $("body").on('click', '.delete-v-option_button', function () {
                $(this).closest('tr').remove();
            });

            $("body").on('change','.warehouse',function () {
                let w_id = $(this).val();
                let parent = $(this).closest(".location-item");
                render_racks(w_id,parent)
            })

            $("body").on('change','.rack',function () {
                let r_id = $(this).val();
                let parent = $(this).closest(".location-item");

                render_shelves(r_id,parent)
            })

            function render_racks(w_id,parent){
                parent.find(".rack").html('<option value="0">Select Rack</option>');
                parent.find(".shelve").html('<option value="0">Select Shelve</option>');
                if(w_id){
                    AjaxCall("{{ route('admin_warehouses_rack_by_warehouse') }}", {w_id: w_id}, function (res) {
                        if (!res.error) {
                            parent.find(".rack").empty();
                            var html = '<option value="0">Select Rack</option>';
                            for (var prop in res.data) {
                                html += '<option value="'+res.data[prop].id+'">'+res.data[prop].name+'</option>';
                            }

                            parent.find(".rack").append(html);
                        }
                    });
                }

            }

            function render_shelves(r_id,parent){
                parent.find(".shelve").html('<option value="0">Select Shelve</option>');
                if(r_id){
                    AjaxCall("{{ route('admin_warehouses_shelve_by_rack') }}", {r_id: r_id}, function (res) {
                        if (!res.error) {
                            parent.find(".shelve").empty();

                            var html = '<option value="0">Select Shelve</option>';
                            for (var prop in res.data) {
                                html += '<option value="'+res.data[prop].id+'">'+res.data[prop].name+'</option>';
                            }

                            parent.find(".shelve").append(html);
                        }
                    });
                }
            }
        })
    </script>
@if($model)
    <script>
        $(function () {
            $('#stocks-table').DataTable({
                ajax: "{!! route('datatable_all_others',$model->id) !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                "scrollX": true,
                dom: 'Bflrtip',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'item_id', name: 'item_id'},
                    {data: 'qty', name: 'qty'},
                    {data: 'reason', name: 'reason'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                ],
                order: [ [0, 'desc'] ]
            });
        });

    </script>
@endif


    @stop
