@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
        <div class="card panel panel-default">
            <div class="card-header panel-heading head-space-between">
                <h2>{!! ucfirst(str_replace("_"," ",$type)) !!} Category</h2>
                <div class="button-area text-right">
                    <a class="btn btn-primary add-category" href="javascript:void(0)"><span class="icon-plus"><i class="fa fa-plus"></i></span>Add new</a>
                </div>
            </div>
            <div class="card-body panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div id="tree1"></div>
                    </div>
                    <div class="col-md-8">
                        <div class="content-area category-form-place">
                            {{--@include('admin.store.categories.create_or_update')--}}
                            <h4 class="text-center dddd">New Category</h4>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="nav nav-tabs">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    <div class="modal fade releted-products-add-modal" id="productsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select products</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <ul class="all-list">

                    </ul>
                </div>
                {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>--}}
                {{--</div>--}}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('js')
    <script src="https://mbraak.github.io/jqTree/tree.jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://farbelous.io/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js"></script>
    <script>
        $('body').on('click', '.del-save--btn .btn-submit-form', function () {
            $('.category-form-place .updated-form').submit()
        })
        $("#select-stickers").select2();
        $("body").on('click', '.add-category', function () {
            AjaxCall("/admin/tools/categories/get-form/{{ $type }}", {id: null}, function (res) {
                if (!res.error) {
                    $(".category-form-place").html(res.html);
                    $('.icon-picker').iconpicker();
                    $("#select-stickers").select2();
                }
            });
        });


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
            autoOpen: true,
            saveState: true,
            dragAndDrop: true,
            onDragStop: function (e, node) {
                let id = e.id
                let parentId = e.parent.id
                AjaxCall("/admin/tools/filters/update-parent", {id, parentId}, function (res) {
                    $(".category-form-place").html('');
                });
            }
        });

        $("#tree1").bind("tree.click", function (e) {
            AjaxCall("/admin/tools/categories/get-form/{{ $type }}", {id: e.node.id}, function (res) {
                if (!res.error) {
                    $(".category-form-place").html(res.html);
                    $('.icon-picker').iconpicker();
                    $("#select-stickers").select2();

                }
            });
        });
    </script>
@stop
@section("css")
    <link rel="stylesheet" href="https://mbraak.github.io/jqTree/jqtree.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="stylesheet" href="https://farbelous.io/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <style>
        .head-space-between{
            display: flex;
            justify-content: space-between;
        }
        .head-space-between h2{
            margin: 0;
        }
        .head-space-between .icon-plus{
            margin-right: 5px;
        }

        .del-save--btn {
            display: flex;
            justify-content: flex-end;
        }

        .del-save--btn .m-r-5 {
            margin-right: 5px;
        }

        #font-show-area {
            font-size: 50px;
            margin-top: 15px;
        }

        .category-form-place {
            padding: 15px;
            background-color: white;
            box-shadow: 0 0 4px #ccc;
        }

        #tree1 {
            background-color: #ffffff;
            border: 1px solid #ccc;
            box-shadow: 0 0 4px #ccc;
        }

        #tree1 ul.jqtree-tree li.jqtree-selected > .jqtree-element {
            padding: 10px 5px;
        }

        #tree1 ul.jqtree-tree .jqtree-element {
            padding: 10px 5px;
            border-bottom: 1px solid #ccc;
        }

        #tree1 ul.jqtree-tree .jqtree-title {
            outline: none;
        }

        #tree1 ul.jqtree-tree .jqtree-toggler {
            color: #3c8dbc;
        }

        .category-form-place .mt-10 {
            margin-top: 10px;
        }
    </style>
@stop
