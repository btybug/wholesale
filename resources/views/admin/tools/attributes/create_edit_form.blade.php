@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    {!! Form::model($model,['class'=>'']) !!}
    <div class="inventory_attributes container-fluid">
        <div class="row flex-column">
            <div class="card panel panel-default mb-3">
                <div class="card-header panel-heading d-flex flex-wrap justify-content-between">
                    <h2 class="m-0 pull-left">{{ ($model) ? $model->name : "Add Attribute" }}</h2>
                    <div class="button-save">
                        {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                        <a class="btn btn-default"
                           href="{!! route('admin_store_attributes') !!}">Back</a>
                    </div>
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

                <div class="card-body panel-body basic-details-tab">
                       <div class="row">
                           <div class="col-xl-8 col-lg-7 col-md-6">
                               <div class="basic-wall">
                                   @if(count(get_languages()))
                                       <ul class="nav nav-tabs">
                                           @foreach(get_languages() as $language)
                                               <li class="nav-item "><a class="nav-link @if($loop->first) active @endif" data-toggle="tab"
                                                                                              href="#{{ strtolower($language->code) }}">
                                                       <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                   </a></li>
                                           @endforeach
                                       </ul>
                                   @endif
                                   <div class="tab-content">
                                       @if(count(get_languages()))
                                           @foreach(get_languages() as $language)
                                               <div id="{{ strtolower($language->code) }}"
                                                    class="tab-pane fade  @if($loop->first) in active show @endif">
                                                   <div class="form-group row">
                                                       <label class="col-xl-2 col-lg-4 control-label"><span data-toggle="tooltip"
                                                                                                   title=""
                                                                                                   data-original-title="Attribute Name Title">Attribute Name</span></label>
                                                       <div class="col-xl-10 col-lg-8">
                                                           {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($model,strtolower($language->code),'name'),['class'=>'form-control']) !!}
                                                       </div>
                                                   </div>
                                                   <div class="form-group row">
                                                       <label class="col-xl-2 col-lg-4 control-label"><span data-toggle="tooltip"
                                                                                                   title=""
                                                                                                   data-original-title="Attribute description">Attribute Description</span></label>
                                                       <div class="col-xl-10 col-lg-8">
                                                           {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($model,strtolower($language->code),'description'),['class'=>'form-control']) !!}
                                                       </div>
                                                   </div>
                                               </div>
                                           @endforeach
                                       @endif
                                   </div>
                                   <div class="form-group row">
                                       <label class="col-xl-2 col-lg-4 control-label" for="input-total"><span data-toggle="tooltip"
                                                                                                     title=""
                                                                                                     data-original-title="Icon Title">Icon</span></label>
                                       <div class="col-xl-10 col-lg-8">
                                           {!! Form::text('icon',null,['class'=>'form-control icon-picker']) !!}
                                       </div>
                                       <div class="col-md-1 text-center font-icon-added">
                                           <i id="font-show-area"></i>
                                       </div>
                                   </div>

                                   <div class="form-group row">
                                       <label class="col-xl-2 col-lg-4 control-label" for="input-total"><span data-toggle="tooltip"
                                                                                                     title=""
                                                                                                     data-original-title="Image Title">Image</span></label>
                                       <div class="col-xl-10 col-lg-8">
                                           {!! media_button('image',$model) !!}
                                       </div>
                                   </div>

                               </div>

                           </div>

                           <div class="col-xl-4 col-lg-5 col-md-6">
                               <div class="basic-wall mb-3">
                                   <div class="right_col">
                                       <div class="form-group row">
                                           <label class="col-xl-3 col-lg-4 col-md-5 col-3 control-label" for="input-total">
                                               <span data-toggle="tooltip" title="" data-original-title="Filter">Filter</span></label>
                                           <div class="col-xl-9 col-lg-8 col-md-7 col-9 filter--display">
                                               YES {!! Form::radio('filter',1,null) !!}
                                               NO {!! Form::radio('filter',0,null) !!}
                                           </div>
                                       </div>
                                       <div class="card panel panel-default panel-display-as">
                                           <div class="card-header panel-heading">
                                               <div class="row">
                                                   <div class="col-sm-7 col-4 pl-0 align-self-center">
                                                       Display as
                                                   </div>
                                                   <div class="col-sm-5 col-8 p-0">
                                                       {!! Form::select('display_as',[
                                                           'radio' => 'Radio',
                                                           'select' => 'Select',
                                                           'checkbox' => 'Checkbox',
                                                           'multy_select' => 'Multi select',
                                                           'color' => 'Color',

                                                       ],null,['class' => 'form-control display_as-select']) !!}
                                                   </div>
                                                   {{--'multi_select_tag' => 'Multi select tag',--}}
                                               </div>
                                           </div>

                                           <div class="card-body panel-body">
                                               <div class="right-main-content">
                                                   <div class="display-as-wall d-none" data-displayas="radio">
                                                       @if($model && count($model->children))
                                                           <h3>{{ $model->name }}</h3>
                                                           @foreach($model->children as $item)
                                                               <div class="form-group row bord-top bg-light attr-option"
                                                                    data-item-id="{!! $item->id !!}" data-parent-id="{!! $model->id !!}">
                                                                   <div class="col-sm-1">
                                                                       <input type="radio" id="radio-{!! $item->id !!}" name="radio_item">
                                                                   </div>
                                                                   <div class="col-sm-11">
                                                                       <label for="radio-{!! $item->id !!}"> {!! $item->name !!}</label>
                                                                   </div>
                                                               </div>
                                                           @endforeach
                                                       @else
                                                           No Options
                                                       @endif
                                                   </div>
                                                   <div class="display-as-wall d-none" data-displayas="select">
                                                       <h3>Courier</h3>
                                                       <select name="" id="" class="form-control">
                                                           @if($model &&  count($model->children))
                                                               @foreach($model->children as $item)
                                                                   <option class="form-group attr-option" data-item-id="{!! $item->id !!}"
                                                                           data-parent-id="{!! $model->id !!}">
                                                                       {!! $item->name !!}

                                                                   </option>
                                                               @endforeach
                                                           @else
                                                               No Options
                                                           @endif
                                                       </select>

                                                   </div>
                                                   <div class="display-as-wall d-none" data-displayas="checkbox">
                                                       <h3>Courier</h3>
                                                       @if($model &&  count($model->children))
                                                           @foreach($model->children as $item)
                                                               <div class="form-group row bord-top bg-light attr-option"
                                                                    data-item-id="{!! $item->id !!}" data-parent-id="{!! $model->id !!}">
                                                                   <div class="col-sm-1">
                                                                       <input type="checkbox" id="checkbox-{!! $item->id !!}">
                                                                   </div>
                                                                   <div class="col-sm-11">
                                                                       <label for="checkbox-{!! $item->id !!}"> {!! $item->name !!}</label>
                                                                   </div>
                                                               </div>
                                                           @endforeach
                                                       @else
                                                           No Options
                                                       @endif
                                                   </div>
                                                   <div class="display-as-wall d-none" data-displayas="multy_select">
                                                       <h3>Courier</h3>
                                                       <div class="multi_select_tag_wall">
                                                           <div class="row">
                                                               <label class="col-sm-3 control-label" for="input-category">Tags</label>
                                                               <div class="col-sm-9">
                                                                   <input type="text" name="" value="" placeholder="Tags"
                                                                          id="input-category" class="form-control" autocomplete="off">
                                                                   <ul class="dropdown-menu"></ul>
                                                                   <div id="coupon-category" class="well well-sm view-coupon">
                                                                       <ul class="coupon-category-list">
                                                                       </ul>
                                                                   </div>
                                                                   <input type="hidden" class="search-hidden-input" value=""
                                                                          id="category-names">

                                                               </div>
                                                           </div>
                                                       </div>

                                                   </div>
                                                   <div class="display-as-wall d-none" data-displayas="color">
                                                       <h3>Courier</h3>
                                                       Color

                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                               </div>
                               <div class="basic-wall">
                                   <div class="form-group">
                                       <label class="control-label pl-sm-0">Categories</label>
                                       {!! Form::hidden('categories',(isset($checkedCategories))
                                       ? json_encode($checkedCategories) : null,['id' => 'categories_tree']) !!}
                                       <div id="treeview_json"></div>
                                   </div>
                               </div>
                           </div>
                       </div>

                </div>


            </div>
            <div class="card panel panel-default">
                <div class="card-header panel-heading d-flex flex-wrap justify-content-between ">
                    {{--<h2>Options {{ $model->name }} </h2>--}}
                    <h2 class="m-0 pull-left">Attributes</h2>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary pull-right select-stickers"><i class="fa fa-plus fa-sm mr-10"></i>Add attribute</button>
                    </div>
                </div>
                <div class="card-body panel-body">
                    <div class="d-flex flex-wrap get-all-stickers-tab">
                        @if(isset($model) && count($model->stickers))
                            @foreach($model->stickers as $sticker)
                                <div class="inventory-attr-item" data-id="{{ $sticker->id }}">
                                    <h3 class="text">{!! $sticker->name !!}</h3>
                                    <button type="button" class="btn btn-danger remove-all-attributes"><i class="fa fa-close"></i></button>
                                    <input type="hidden" name="stickers[]" value="{{ $sticker->id }}">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}


    <!-- <div class="modal fade" id="stickerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Stickers</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="search-attr" class="col-sm-2 col-form-label">Search</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control search-attr"  placeholder="Search">
                        </div>
                    </div>
                    <ul class="all-list modal-stickers--list">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Done</button>
                </div> -->
            <!-- </div> -->
            <!-- /.modal-content -->
        <!-- </div> -->
        <!-- /.modal-dialog -->
    <!-- </div> -->
    <!-- /.modal -->

    <div class="modal fade select-stickers__modal" id="stickerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Stickers</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="search-attr" class="col-sm-2 col-form-label">Search</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control search-attr"  placeholder="Search">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center mb-2">
                        <input type="checkbox" class="all_select_products_js" style="margin: 0 18.240px"/>
                        <p class="mb-0">Select All</p>
                    </div>
                    <ul class="all-list modal-stickers--list">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary done_select_stickers_js" data-dismiss="modal">Done</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('js')
    <script src="https://farbelous.io/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
        // $("body").on("keyup",".search-attr", function() {
        //     var value = $(this).val().toLowerCase();
        //     $("ul.modal-stickers--list .option-elm-modal").filter(function() {
        //         $(this).toggle($(this).find('a.searchable').data('name').toLowerCase().indexOf(value) > -1)
        //     });
        // });

        $('.filter--display input:radio[name="filter"]').change(function() {
            var filter = $(this).filter(':checked').val();

            if(filter === '1') {
                $('.panel-display-as').removeClass('hide')
            }else {
                $('.panel-display-as').addClass('hide')
            }
        });



        $("body").on('click', '.remove-all-attributes', function () {
            $(this).closest('.inventory-attr-item').remove();
        });

        // $("body").on('click', '.select-stickers', function () {
        //     let arr = [];
        //     $(".get-all-stickers-tab")
        //         .children()
        //         .each(function () {
        //             arr.push($(this).attr("data-id"));
        //         });
        //     AjaxCall("/admin/tools/stickers/get-all", {arr}, function (res) {
        //         if (!res.error) {
        //             $("#stickerModal .modal-body .all-list").empty();
        //             res.data.forEach(item => {
        //                 let html = `<li data-id="${item.id}" class="option-elm-modal"><a
        //                                         href="#">${item.name}
        //                                         </a> <a class="btn btn-primary add-related-event searchable" data-name="${item.name}"
        //                                         data-id="${item.id}">ADD</a></li>`;
        //                 $("#stickerModal .modal-body .all-list").append(html);
        //             });
        //             $("#stickerModal").modal();
        //         }
        //     });
        // });

        // $("body").on("click", ".add-related-event", function () {
        //     let id = $(this).data("id");
        //     let name = $(this).data("name");
        //     $(".get-all-stickers-tab")
        //         .append(`<div class="inventory-attr-item" data-id="${id}">
        //                                     <h3 class="text">${name}</h3>
        //                                     <button  type="button" class="btn btn-danger remove-all-attributes "><i class="fa fa-close"></i></button>
        //                                     <input type="hidden" name="stickers[]" value="${id}">
        //                                 </div>`);
        //     $(this)
        //         .parent()
        //         .remove();
        // });

        $('body').on('change', '.inventory_attributes .display_as-select', function () {
            $(".display-as-wall").addClass("d-none")
            $(`[data-displayas="${$(this).val()}"]`).removeClass("d-none")

        });
        $('.icon-picker').iconpicker();
        $("body").on("click", ".iconpicker-item", function () {
            let value = $(".icon-picker").val()
            $("#font-show-area").attr("class", value)
        })

        $("body").on("click", ".attr-option", function () {
            var id = $(this).data('item-id');
            var parentId = $(this).data('parent-id');
            AjaxCall("/admin/tools/attributes/options-show-form", {id: id, parentId: parentId}, function (res) {
                if (!res.error) {
                    $(".options-form").html(res.html);
                    $('.icon-picker').iconpicker();
                }
            });
        });

        $("body").on("click", ".delete-option", function () {
            var id = $(this).data('item-id');
            AjaxCall("/admin/tools/attributes/options-delete", {id: id}, function (res) {
                if (!res.error) {
                    $(".options-form").html('');
                    $("body").find('.attr-option').each(function () {
                        if ($(this).attr('data-item-id') == id) {
                            $(this).remove()
                        }
                    })
                    // $('.icon-picker').iconpicker();
                }
            });
        });

    </script>
    <script>
        $(document).ready(function () {
            function render_categories_tree() {
                $("#treeview_json").jstree({
                    "checkbox": {
                        "three_state": false,
                        "cascade": 'undetermined',
                        "keep_selected_style": false
                    },
                    plugins: ["wholerow", "checkbox", "types"],
                    core: {
                        themes: {
                            responsive: !1
                        },
                        data: {!! json_encode($data) !!}
                    },
                    types: {
                        "default": {
                            icon: "fa fa-folder text-primary fa-lg"
                        },
                        file: {
                            icon: "fa fa-file text-success fa-lg"
                        }
                    }
                })
            }
            $('#treeview_json').on("changed.jstree", function (e, data) {
                if (data.node) {
                    var selectedNode = $('#treeview_json').jstree(true).get_selected(true)
                    var dataArr = [];
                    for (var i = 0, j = selectedNode.length; i < j; i++) {
                        dataArr.push(selectedNode[i].id);
                        dataArr.push(selectedNode[i].parent);
                    }

                    var uniqueNames = [];

                    if (dataArr.length > 0) {
                        $.each(dataArr, function (i, el) {
                            if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                        });
                    }

                    var index = uniqueNames.indexOf("#");
                    if (index > -1) {
                        uniqueNames.splice(index, 1);
                    }

                    $("#categories_tree").val(JSON.stringify(uniqueNames));
                }
            });
            render_categories_tree()
        })
    </script>
@stop
@section("css")
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="stylesheet" href="https://farbelous.io/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
    <style>
        #font-show-area {
            font-size: 50px;
            margin-top: 15px;
        }
        .basic-details-tab .basic-wall{
            height: auto;
        }
    </style>
@stop
