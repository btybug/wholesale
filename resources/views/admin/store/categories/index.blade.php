@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="button-area text-right mb-20">
                <a class="btn btn-primary add-category" href="javascript:void(0)">Add new</a>
            </div>
        </div>
        <div class="col-md-4">
            <div id="tree1"></div>
        </div>
        <div class="col-md-8">
            <div class="content-area category-form-place">
                {{--@include('admin.store.categories.create_or_update')--}}
                <h4 class="text-center">New Category</h4>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@stop
@section('js')
    <script src="https://mbraak.github.io/jqTree/tree.jquery.js"></script>
    <script src="https://farbelous.io/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js"></script>
    <script>
        $("body").on('click','.add-category',function () {
            AjaxCall("/admin/store/categories/get-form", {id: null}, function (res) {
                if(! res.error){
                    $(".category-form-place").html(res.html);
                    $('.icon-picker').iconpicker();
                }
            });
        });

        $('.icon-picker').iconpicker();
        $("body").on("click", ".iconpicker-item", function () {
            let value = $(".icon-picker").val()
            $("#font-show-area").attr("class", value)
        })
        window.AjaxCall = function postSendAjax(url, data, success, error) {
            $.ajax({
                type: "post",
                url: url,
                cache: false,
                datatype: "json",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function (data) {
                    if (success) {
                        success(data);
                    }
                    return data;
                },
                error: function (errorThrown) {
                    if (error) {
                        error(errorThrown);
                    }
                    return errorThrown;
                }
            });
        };

        var data = {!! json_encode(\App\Models\Category::recursiveItems($categories),true) !!};

        $("#tree1").tree({
            data: data,
            //   dataUrl: {
            //     url: '/example_data.json',
            //     headers: {'abc': 'def'}
            // },
            autoOpen: true,
            saveState: true,
            dragAndDrop: true,
            onDragStop: function (e, node) {
                let id = e.id
                let parentId = e.parent.id
                // var tree_json = $("#tree1").tree("toJson");
                AjaxCall("/admin/store/categories/update-parent", {id, parentId}, function (res) {
                    $(".category-form-place").html('');
                });
            }
        });

        $("#tree1").bind("tree.click", function (e) {
            AjaxCall("/admin/store/categories/get-form", {id: e.node.id}, function (res) {
                if(! res.error){
                    $(".category-form-place").html(res.html);
                    $('.icon-picker').iconpicker();
                }
            });
        });
    </script>
@stop
@section("css")
    <link rel="stylesheet" href="https://mbraak.github.io/jqTree/jqtree.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="stylesheet" href="https://farbelous.io/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
    <style>
        #font-show-area {
            font-size: 50px;
            margin-top: 15px;
        }
        .category-form-place{
            padding: 15px;
            background-color: white;
            box-shadow: 0 0 4px #ccc;
        }
        #tree1{
            background-color: #ffffff;
            border: 1px solid #ccc;
            box-shadow: 0 0 4px #ccc;
        }
        #tree1 ul.jqtree-tree li.jqtree-selected > .jqtree-element{
            padding: 10px 5px;
        }
        #tree1 ul.jqtree-tree .jqtree-element{
            padding: 10px 5px;
            border-bottom: 1px solid #ccc;
        }
        #tree1 ul.jqtree-tree .jqtree-title {
            outline: none;
        }
        #tree1 ul.jqtree-tree .jqtree-toggler{
            color: #3c8dbc;
        }
    </style>
@stop