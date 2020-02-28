@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="col-md-12">
        <div class="card panel panel-default">
            <div class="card-header panel-heading head-space-between">
                {!! Form::model($category,['url'=>route('post_admin_tools_filters_edit_category',$category->id),'class'=>'w-100']) !!}
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::text('translatable['.strtolower(app()->getLocale()).'][name]',$category->name,['class'=>'form-control mb-1','required'=>true,'placeholder'=>'Filter Name']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::text('translatable['.strtolower(app()->getLocale()).'][description]',$category->description,['class'=>'form-control mb-1','required'=>true,'placeholder'=>'Filter Name']) !!}

                        </div>

                    </div>
                    <div class="button-area text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
            <div class="card-body panel-body">
                <div class="d-flex flex-wrap justify-content-between mb-1">
                    <button type="button" class="btn btn-primary add-filter"><i class="fa fa-plus fa-sm mr-10"></i>Add
                        New
                    </button>
                    {!! Form::button('View Result',['class' => 'btn btn-primary','data-toggle'=>"modal",'data-target'=>"#view-result"]) !!}
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div id="tree1"></div>
                    </div>
                    <div class="col-md-8">
                        <div class="content-area filter-form-place">
                            <h4 class="text-center dddd">New Filter</h4>
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
            </div>

        </div>

    </div>
    <div class="modal fade" id="itemsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade releted-products-add-modal" id="view-result" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{!! $category->description !!}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id'=>'filter-form']) !!}
                    <div class="d-flex flex-wrap justify-content-center mb-2">
                        <div class="col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-4 col-xs-12">{!! $category->name !!}</label>
                                <div class="col-md-8">
                                    {!! Form::select('filters[]',[null=>'Select Parent']+$category->filters()->get()->pluck('name','id')->toArray(),null,['class'=>'form-control filter-select','required'=>true]) !!}
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="filter-children-selects row">

                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="releted__products-panel">
                        <div>

                            <div class="product-body">
                                <ul class="get-all-attributes-tab row filter-children-items">

                                </ul>
                            </div>
                            {{--<div class="modal-footer justify-content-between">--}}
                                {{--<button type="button" class="btn btn-secondary">Back</button>--}}
                                {{--<span>Sone text</span>--}}
                                {{--<button type="button" class="btn btn-secondary">Next</button>--}}
                            {{--</div>--}}
                        </div>
                    </div>


                </div>
                <div class="modal-footer">


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('js')
    <script src="https://mbraak.github.io/jqTree/tree.jquery.js"></script>
    <script src="/public/plugins/select2/select2.full.min.js"></script>
    <script src="https://farbelous.io/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js"></script>
    <script>
        var data = {!! json_encode(\App\Models\Filters::recursiveItems($category->filters),true) !!};
        $("#tree1").tree({
            data: data,
            autoOpen: true,
            saveState: true,
        });
        $('body').on('click', '.btn-submit-form', function () {
            $('.filter-form-place .updated-form').submit()
        });
        $("body").on('click', '.select-products', function () {
            let parent = $('.get-all-attributes-tab').find('li');
            let existings = [];
            parent.each(function (i, e) {
                existings.push($(e).data('id'));
            });
            AjaxCall("{{ route('admin_stock_package_variation_items') }}", {
                items: existings,
                uniqueId: parent.attr('data-unqiue')
            }, function (res) {
                if (!res.error) {
                    $("#itemsModal .modal-content").html(res.html);
                    // $("#itemsModal #searchStickers").select2();
                    $("#itemsModal").modal();
                }
            });
        });

        $("body").on("input", "#itemsModal #searchStickers", function () {
            let stickers = $(this).val();

                $("body").find('.option-elm-modal').each(function() {
                    var instance = new Mark($(this).find('.name-item span'));
                    if(!stickers) {
                        $(this).removeClass('d-none');
                        instance.unmark({
                            "element": "span",
                            "className": "highlight_mark"
                        });
                    } else {
                        if ($(this).data('name').toLowerCase().includes(stickers.toLowerCase())) {
                            $(this).removeClass('d-none');

                            instance.unmark({
                                "element": "span",
                                "className": "highlight_mark"
                            });
                            instance.mark(stickers, {
                                "element": "span",
                                "className": "highlight_mark"
                            });
                        } else {
                            instance.unmark({
                                "element": "span",
                                "className": "highlight_mark"
                            });
                            $(this).addClass('d-none');
                        }
                    }




                });


            // let ids = res.data.map(function(item) {
            //     return item.id;
            // });

            {{--let data_id = $(this).attr('data-section-id');--}}

            {{--let $_this = $('body').find('[data-unqiue="' + data_id + '"]');--}}
            {{--let existings = [];--}}
            {{--$_this.find('.v-item-change')--}}
            {{--    .each(function (i, e) {--}}
            {{--        existings.push($(e).val());--}}
            {{--    });--}}
            {{--AjaxCall("{{ route('admin_stock_search_items') }}", {--}}
            {{--    items: existings,--}}
            {{--    stickers: stickers--}}
            {{--}, function (res) {--}}
            {{--    if (!res.error) {--}}
            {{--        $("#itemsModal .modal-stickers--list").html(res.html);--}}
            {{--    }--}}
            {{--});--}}

            {{--AjaxCall("{{ route('datatable_all_items_in_modal') }}", {--}}
            {{--    "draw": "1",--}}
            {{--    "columns": [--}}

            {{--        {--}}
            {{--            "data": "id",--}}
            {{--            "name": "id",--}}
            {{--            "searchable": "false",--}}
            {{--            "orderable": "false"--}}
            {{--        },--}}
            {{--        {--}}
            {{--            "data": "name",--}}
            {{--            "name": "item_translations.name",--}}
            {{--            "searchable": "true",--}}
            {{--            "orderable": "true"--}}
            {{--        },{--}}
            {{--            "data": "category",--}}
            {{--            "name": "categories_translations.name",--}}
            {{--            "searchable": "true",--}}
            {{--            "orderable": "true"--}}
            {{--        },{--}}
            {{--            "data": "barcode",--}}
            {{--            "name": "barcodes.code",--}}
            {{--            "searchable": "true",--}}
            {{--            "orderable": "true"--}}
            {{--        },--}}
            {{--        {--}}
            {{--            "data": "image",--}}
            {{--            "name": "image",--}}
            {{--            "searchable": "false",--}}
            {{--            "orderable": "false"--}}
            {{--        }--}}
            {{--    ],--}}
            {{--    "order": [--}}
            {{--        {--}}
            {{--            "column": "0",--}}
            {{--            "dir": "asc"--}}
            {{--        }--}}
            {{--    ],--}}
            {{--    "start": "0",--}}
            {{--    "length": "-1",--}}
            {{--    "search": {--}}
            {{--        "value": stickers === '' ? null : stickers,--}}
            {{--        "regex": "false"--}}
            {{--    },--}}
            {{--    "_": "1573066032263"--}}
            {{--}, function (res) {--}}

                // let ids = res.data.map(function(item) {
                //     return item.id;
                // });
                //
                // if(stickers == '') {
                //     $('body').find('.option-elm-modal').removeClass('d-none');
                // } else {
                //     $('body').find('.option-elm-modal').each(function() {
                //         if(ids.indexOf($(this).data('id').toString()) === -1) {
                //             $(this).addClass('d-none');
                //         } else {
                //             $(this).removeClass('d-none');
                //         }
                //     });
                // }
            // })
        });

        {{--$("body").on("input", "#itemsModal #searchStickers", function () {--}}
            {{--let stickers = $(this).val();--}}
            {{--let data_id = $(this).attr('data-section-id');--}}

            {{--console.log(stickers);--}}
            {{--let $_this = $('body').find('[data-unqiue="' + data_id + '"]');--}}
            {{--let existings = [];--}}
            {{--$_this.find('.v-item-change')--}}
                {{--.each(function (i, e) {--}}
                    {{--existings.push($(e).val());--}}
                {{--});--}}
            {{--AjaxCall("{{ route('admin_stock_search_items') }}", {items: existings, stickers: stickers}, function (res) {--}}
                {{--if (!res.error) {--}}
                    {{--$("#itemsModal .modal-stickers--list").html(res.html);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}


        $('body').on('click', '#itemsModal .option-elm-modal', function () {
            $(this).toggleClass('active')
        });


        $("body").on('click', '.add-filter', function () {
            AjaxCall("{!! route('admin_tools_filters_form') !!}", {category_id: "{!! $category->id !!}"}, function (res) {
                if (!res.error) {
                    $(".filter-form-place").html(res.html);
                    $('.icon-picker').iconpicker();
                    $("#select-stickers").select2();
                }
            });
        });
        $("body").on('change', '.filter-select', function () {
            let data = $('form#filter-form').serialize();
            AjaxCall("{!! route('admin_tools_filters_next') !!}", data, function (res) {
                if (!res.error) {
                    switch (res.type) {
                        case 'filter':
                            $('.filter-children-items').empty();
                            $('.filter-children-selects').html(res.html);
                            break;
                        case 'items':
                            $('.filter-children-selects').html(res.html);
                            $('.filter-children-items').html(res.items_html);
                            $('#view-result .modal-footer').html('<div class="d-flex flex-wrap justify-content-between mb-1">\n' +
                                '<button type="button" class="btn btn-primary"><i class="fa fa-plus fa-sm mr-10"></i>Add</button>\n' +
                                '</div>');
                            break;
                    }
                }
            });
        });
        $("body").on('click', '.detach-item', function () {
            let _this = $(this);
            AjaxCall($(this).data('href'), {slug: $(this).data('key')}, function (res) {
                if (!res.error) {
                    $(_this).closest('li').remove()
                }
            });
        });

        $("#tree1").bind("tree.click", function (e) {
            AjaxCall("{!! route('admin_tools_filters_form') !!}", {
                id: e.node.parent_id,
                child_id: e.node.id,
                category_id: e.node.category_id
            }, function (res) {
                if (!res.error) {
                    $(".filter-form-place").html(res.html);
                    $('.icon-picker').iconpicker();
                    $("#select-stickers").select2();

                }
            });
        });


        $("body").on("click", ".add-package-items", function () {
            $("#itemsModal").modal('hide');
            let items = $('#itemsModal').find('.all-list li.active');
            $.each(items, function (k, v) {
                let id = $(v).data("id");
                let name = $(v).data("name");
                let img = $(v).find('img').attr('src');
                $(".get-all-attributes-tab")
                    .append(`<li  data-id="${id}" class="option-elm-attributes col-md-3"><div class="wrap-item"><a
                                href="#">
<span><img src="${img}" alt=""></span>
<span class="name">${name}</span>

                                </a>
                                <div class="buttons">
                                <a href="javascript:void(0)" class="remove-all-attributes btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                                <input type="hidden" name="items[]" value="${id}">
                                </div></li>`);
                $(this)
                    .parent()
                    .remove();
            });
        });
    </script>
@stop
@section("css")
    <link rel="stylesheet" href="/public/css/custom.css">
    <link rel="stylesheet" href="https://mbraak.github.io/jqTree/jqtree.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="stylesheet" href="https://farbelous.io/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
    <link href="/public/plugins/select2/select2.min.css" rel="stylesheet"/>
    <style>
        .highlight_mark {
            background-color: #33b5e5;
        }

        #itemsModal .items-box {
            flex: 1;
        }

        .head-space-between {
            display: flex;
            justify-content: space-between;
        }

        .head-space-between h2 {
            margin: 0;
        }

        .head-space-between .icon-plus {
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

        .filter-form-place {
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

        .filter-form-place .mt-10 {
            margin-top: 10px;
        }

        #view-result .modal-lg {
            max-width: 80%;
        }
    </style>
@stop
