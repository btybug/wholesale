@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
<div class="card panel panel-default">
    <div class="card-header panel-heading">
        <h2 class="m-0">{{ ($model) ? $model->title : "Create campaign" }}</h2>
    </div>
        <div class="card-body panel-body">
        <div class="">

            {!! Form::model($model) !!}
                <!-- Password input-->
                <div class="form-group row">
                    <label class="col-md-2" for="passwordinput">Title</label>
                    <div class="col-md-10">
                        {!! Form::text('title',null,['class'=>'form-control input-md']) !!}
                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group row">
                    <label class="col-md-2" for="passwordinput">Description</label>
                    <div class="col-md-10">
                        {!! Form::textarea('description',null,['class'=>'form-control input-md']) !!}
                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group row">
                    <label class="col-md-2" for="passwordinput">SQL query</label>
                    <div class="col-md-10">
                        {!! Form::textarea('sql_query',null,['class'=>'form-control input-md','id' => 'query-log','readonly' => true]) !!}
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group row">
                    <div class="col-sm-12 text-right">
                        <button id="singlebutton" type="submit" class="btn btn-info save-role">Save</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="">
            {!! Form::open(['url' => route('admin_search'),'id' => 'filterForm']) !!}
                <!-- Password input-->
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label class="col-xl-2" for="passwordinput">Name</label>
                            <div class="col-xl-10">
                                {!! Form::text('name',null,['class'=>'form-control input-md']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label class="col-xl-2" for="passwordinput">Last Name</label>
                            <div class="col-xl-10">
                                {!! Form::text('last_name',null,['class'=>'form-control input-md']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label class="col-xl-2" for="passwordinput">Gender</label>
                            <div class="col-xl-10">
                                {!! Form::select('gender',['' => 'Select','male' => 'Male','female' => 'Female'],null,['class'=>'form-control input-md']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label class="col-xl-2" for="passwordinput">Country</label>
                            <div class="col-xl-10">
                                {!! Form::select('country[]',$countries,null,['class'=>'form-control select2-input','multiple' => true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label class="col-xl-2" for="passwordinput">start age</label>
                            <div class="col-xl-10">
                                {!! Form::number('start_age',null,['class'=>'form-control input-md','min' => 0]) !!}
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label class="col-xl-2" for="passwordinput">end age</label>
                            <div class="col-xl-10">
                                {!! Form::number('end_age',null,['class'=>'form-control input-md','min' => 0]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label class="col-xl-2 control-label" for="input-date-start">Registered Date start</label>
                            <div class="col-xl-4">
                                <div class="input-group date">
                                    {!! Form::text('start_date',null,['placeholder' => 'start date',
                                  'id'=>'input-date-start', 'class'=> 'form-control']) !!}
                                    <span class="input-group-btn">
<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <label class="col-xl-2 control-label" for="input-date-start">Registered Date end</label>
                            <div class="col-xl-4">
                                <div class="input-group date">
                                    {!! Form::text('end_date',null,['placeholder' => 'end date',
                                  'id'=>'input-date-end', 'class'=> 'form-control']) !!}
                                    <span class="input-group-btn">
<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
</span></div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Button -->
                <div class="form-group row">
                    <div class="col-sm-12 text-right">
                        <button type="button" class="btn btn-info search-btn">Search</button>
                    </div>
                </div>


                <div class="form-group">
                    <table id="orders-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer number</th>
                            <th>Name</th>
                            <th>Last_name</th>
                            <th>Email</th>
                            <th>Email verified at</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>DOB</th>
                            <th>Created at</th>
                        </tr>
                        </thead>
                    </table>
                </div>
           {!! Form::close() !!}
        </div>
    </div>


</div>

@stop

@section("css")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

@stop


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        var table=  $('#orders-table').DataTable({
            ajax: "{!! route('datatable_all_channel_customers') !!}",
            dom: 'Bflrtip',
            displayLength: 10,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            "scrollX": true,
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'customer_number', name: 'customer_number'},
                {data: 'name', name: 'name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'email_verified_at', name: 'email_verified_at'},
                {data: 'phone', name: 'phone'},
                {data: 'country', name: 'country'},
                {data: 'gender', name: 'gender'},
                {data: 'age', name: 'age'},
                {data: 'dob', name: 'dob'},
                {data: 'created_at', name: 'created_at'}
            ],
            order: [[0, 'desc']]
        });

        $("body").on('click','.search-btn',function () {
            var data = $("#filterForm").serialize();
            AjaxCall("/admin/search", data, function (res) {
                table.clear().rows.add(res.data).draw();
                $("#query-log").html(res.sql)
            });
        })
    </script>
    <script>
        $(function () {
            $(".select2-input").select2({ width: '100%' });

            $('#input-date-start').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
                // minYear: 1901,
                // maxYear: parseInt(moment().format('YYYY'),10)
            });

            $('#input-date-end').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
                // minYear: 1901,
                // maxYear: parseInt(moment().format('YYYY'),10)
            });
        });

    </script>
@stop
