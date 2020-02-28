@extends('layouts.admin')
@section('content-header')

@stop
@section('content')

    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <select name="category" id="" class="btn btn-info mb-1">
                <option value="" selected disabled="">Choose Category</option>
                <option value="stock">Stock</option>
                <option value="post">Post</option>
            </select>

            <input type="file" class="form-control hidden" id="exl_file" name="exl_file">
            <label for="exl_file" class="btn btn-info mb-1"><i class="fa fa-download mr-10" aria-hidden="true"></i>Choose File</label>

            <button class="btn btn-success mb-1" type="submit">
                <i class="fa fa-download" aria-hidden="true"></i>
                Import
            </button>
        </div>
    </form>

    <div class="row">
        @foreach($imports as $import)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="files">
                        <div class="delete_file text-center" data-id="{{$import["id"]}}">X</div>
                        <div class="category text-center bg-info text-white" data-id="{{$import["id"]}}">{{$import["category"]}}</div>
                        <div class="view_button text-center bg-info __view text-white" data-target="#view_modal" data-id="{{$import["id"]}}">View</div>
                        @if($import["is_imported"])
                            <div class="btn btn-info import_file" data-id="{{$import["id"]}}">Imported</div>
                        @else
                            <div class="btn btn-success import_file __open_modal" data-toggle="modal" data-target="#import_modal" data-id="{{$import["id"]}}">Import</div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal to save-->
    <div id="import_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                {{--<div class="modal-header">--}}

                {{--</div>--}}
                <div class="modal-body">
                    <h1 class="text-center">Are You Sure to Import this file ?</h1>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success __import_file" data-id="">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal to view-->
    <div id="view_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-center">File Content</h1>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 150px;">Close</button>
                </div>
            </div>

        </div>
    </div>













    <style>
        .card{
            margin-bottom: 20px;
        }
        .files {
            position: relative;
            background: url("/public/img/excel.png");
            width: 100%;
            height: 200px;
            -webkit-background-size:cover;
            background-size: cover;
            border: 1px solid #227547;
        }
        .delete_file{
            position: absolute;
            display: none;
            top: -10px;
            right: -10px;
            background: red;
            color: #ffffff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
        }

        .files:hover .delete_file{
            display: block;
            cursor: pointer;
        }

        .category{
            position: absolute;
            bottom: 0;
            right: 0;
            width: 49%;
            font-size: 18px;
            padding: 5px 0;
        }

        .view_button{
            position: absolute;
            bottom: 0;
            left: 0;
            width: 49%;
            font-size: 18px;
            padding: 5px 0;
            cursor: pointer;
        }

        .import_file {
            position: absolute;
            display: none;
            right: 0;
            left: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            width: 90px;
            height: 35px;
        }

        .files:hover .import_file{
            display: block;
            cursor: pointer;
        }
        .modal-footer .btn{
            width: 49%;
        }
        .table>tr>td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        @media (min-width: 768px){
            #view_modal .modal-dialog {
                width: calc(100% - 120px);
                margin: 30px auto;
            }
        }



    </style>
@stop
@section('js')
    <script>
        $(document).ready(function () {
            $(".delete_file").click(function(){
                let id = $(this).data("id");
                console.log(id);

                $.ajax({
                    type: "post",
                    url: "/admin/import/delete-file",
                    cache: false,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        if (!data.error) {
                            location.reload()
                        } else {
                            alert('error')
                        }
                    }
                });
            });

            $(".__open_modal").click(function(){
                let id = $(this).data("id");
                $(".__import_file").attr("data-id", id);
            });

            $(".__import_file").click(function(){
                let id = $(this).data("id");
//                console.log(id);
                $.ajax({
                    type: "post",
                    url: "/admin/import/add-file",
                    cache: false,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        if (!data.error) {
                            location.reload()
                        } else {
                            alert('error')
                        }
                    }
                });
            })

            $("body").on("click",".__view",function(){
                let id = $(this).data("id");

                $.ajax({
                    type: "post",
                    url: "/admin/import/view_file",
                    cache: false,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        if (!data.error) {
                            $("#view_modal table").empty()
                            data.forEach(function(element) {
                                let tr = $("<tr></tr>");
                                element.forEach(function(el) {
                                    if(el == null){
                                        return
                                    }
                                    if(el!=null && (typeof el == "string") && (el.slice(-5) == ".jpeg" || el.slice(-4) == ".png" || el.slice(-4) == ".jpg")){
                                        var td = $("<td><img src='"+el+"'  width='200'></td>");
                                    }else{
                                        var td = $("<td>"+el+"</td>");
                                    }
                                    tr.append(td);
                                    console.log(el);
                                });
                                $("#view_modal table").append(tr)
                                $("#view_modal").modal()
//                                console.log(element);
                            });
                        } else {
                            alert('error')
                        }
                    }
                });
            })
        });
    </script>
@stop

@section("style")

@stop
