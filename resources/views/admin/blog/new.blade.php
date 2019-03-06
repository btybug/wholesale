@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="m-0">Add / Edit Post</h2>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#info">Info</a></li>
                <li><a data-toggle="tab" href="#seo">SEO</a></li>
            </ul>
            {!! Form::model($post,['url' => route('admin_new_post'), 'id' => 'post_form','files' => true]) !!}
            <div class="tab-content tabs_content">
                <div id="info" class="tab-pane tab_info fade in active">

                    {!! Form::hidden('id',null) !!}
                    <div class="text-right btn-save pt-25">
                        <button type="button" class="btn btn-success btn-view">View Product</button>
                        {!! Form::submit('Save',['class' => 'btn btn-info']) !!}
                    </div>
                    <div class="row sortable-panels">
                        <div class="col-md-9 ">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            {{Form::label('purl', 'Post Url',['class' => 'col-sm-3'])}}
                                            <div class="col-sm-9">
                                                <label>news/</label>
                                                {{Form::text('url', null,['class' =>'form-control','id'=>'purl','placeholder' => 'Enter URL ...'])}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            @if(count(get_languages()))
                                                <ul class="nav nav-tabs tab_lang_horizontal">
                                                    @foreach(get_languages() as $language)
                                                        <li class="@if($loop->first) active @endif"><a data-toggle="tab"
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
                                                             class="tab-pane fade  @if($loop->first) in active @endif">
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                {!! Form::text('translatable['.strtolower($language->code).'][title]',get_translated($post,strtolower($language->code),'title'),['class'=>'form-control']) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Short Description</label>
                                                                {!! Form::textarea('translatable['.strtolower($language->code).'][short_description]',get_translated($post,strtolower($language->code),'short_description'),['class'=>'form-control','cols'=>30,'rows'=>2]) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Long Description</label>
                                                                {!! Form::textarea('translatable['.strtolower($language->code).'][long_description]',get_translated($post,strtolower($language->code),'long_description'),['class'=>'form-control tinyMcArea','cols'=>30,'rows'=>10]) !!}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{--<div class="form-group row">--}}
                                                {{--<label class="col-sm-3">Featured image</label>--}}
                                                {{--<div class="col-sm-9">--}}
                                                    {{--{!! media_button('image',$post) !!}--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                                <div class="panel panel-default">
                                                    <div class="panel-heading clearfix">
                                                        <p class="pull-left">Gallery images</p>
                                                        <div class="pull-right">
                                                            {!! media_button('gallery',$post,true) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            {{--<div class="form-group row">--}}
                                                {{--<label class="col-sm-3">Gallery images</label>--}}
                                                {{--<div class="col-sm-9">--}}
                                                    {{--{!! media_button('gallery',$post,true) !!}--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        </div>

                                        <div class="panel panel-default mt-20 releted__products-panel">
                                            <div class="panel-heading d-flex justify-content-between align-items-center">
                                        <span>
                                            Related Products
                                        </span>
                                                <button type="button" class="btn btn-info select-products"><i class="fa fa-plus fa-sm mr-10"></i>Add Product</button>
                                            </div>
                                            <div class="panel-body product-body">
                                                <ul class="get-all-attributes-tab row">
                                                    @if(isset($post) && count($post->stocks))
                                                        @foreach($post->stocks as $stock)
                                                            <li data-id="{{ $stock->id }}"
                                                                class="option-elm-attributes col-md-3">
                                                                <div class="wrap-item">
                                                                <a href="#">
                                                                    <span><img src="https://alternatevape.com/wp-content/uploads/2011/05/alternate-vape-products-cbd-vape.jpg" alt=""></span>
                                                                    <span class="name">{!! $stock->name !!}</span>
                                                                </a>
                                                                <div class="buttons">
                                                                    <a href="javascript:void(0)"
                                                                       class="remove-all-attributes btn btn-sm btn-danger">
                                                                        <i class="fa fa-trash"></i></a>
                                                                </div>
                                                                <input type="hidden" name="stocks[]" value="{{ $stock->id }}">
                                                                </div></li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div class="view-product-wall">
                                <div class="author-wall wall">
                                    <div class="row">
                                        {{Form::label('author', 'Author',['class' => 'col-sm-3'])}}
                                        <div class="col-sm-9">
                                            {!! Form::select('user_id',$authors,null,
                                                        ['class' => 'form-control','id'=> 'status']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="status-wall wall">
                                    <div class="row">
                                        {{Form::label('status', 'Status',['class' => 'col-sm-3'])}}
                                        <div class="col-sm-9">
                                            {!! Form::select('status',[0 => 'Draft',1 => 'Published'],null,
                                                        ['class' => 'form-control','id'=> 'status']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-wall wall">
                                    <div class="row">
                                        {{Form::label('comment', 'Enable comment',['class' => 'col-sm-3'])}}
                                        <div class="col-sm-9">
                                            YES {!! Form::radio('comment_enabled',1,true,['class' => '']) !!}
                                            NO {!! Form::radio('comment_enabled',0,null,['class' => '']) !!}
                                        </div>
                                    </div>
                                </div>
                            <!-- <div class="tag-wall wall">
                            <div class="row">
                                {{--{{Form::label('tags', 'Tags',['class' => 'col-sm-3'])}}--}}
                                    <div class="col-sm-9">
{{--{{Form::text('tags', null,['class' =>'form-control','id'=>'tags','data-role'=>'tagsinput'])}}--}}
                                    </div>
                                </div>
                            </div> -->
                                <div class="tag-wall wall">
                                    <div class="row">
                                        <label class="col-sm-3 control-label" for="input-category"><span
                                                    data-toggle="tooltip" title=""
                                                    data-original-title="Choose all products under selected category.">Tags</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="" value="" placeholder="Tags"
                                                   id="input-tags" class="form-control" autocomplete="off">
                                            <ul class="dropdown-menu"></ul>
                                            <div id="coupon-category" class="well well-sm view-coupon">
                                                <ul class="coupon-tags-list">
                                                    @if($post && $post->tags)
                                                        <?php
                                                        $tags = json_decode($post->tags, true);
                                                        ?>
                                                        @foreach($tags as $tag)
                                                            <li><span class="remove-search-tag"><i
                                                                            class="fa fa-minus-circle"></i></span>{{ $tag }}
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            {!! Form::hidden('tags',null,['id' => 'tags-names','class' => 'search-hidden-input']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="category-wall wall">
                                    <div class="row">
                                        <label class="col-sm-3 control-label" for="input-category"><span
                                                    data-toggle="tooltip" title=""
                                                    data-original-title="Choose all products under selected category.">Category</span></label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                {!! Form::hidden('categories',(isset($checkedCategories))
                                                ? json_encode($checkedCategories) : null,['id' => 'categories_tree']) !!}
                                                <div id="treeview_json"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading clearfix">
                                    <p class="pull-left mb-0">
                                        <b data-toggle="tooltip" title="" data-original-title="Change featured image">Featured image</b>
                                    </p>
                                    <div class="pull-right text-right">
                                            {!! media_button('image',$post,false,'drive',
                                           "<div class='edit-featured-img-outer'><img src='{img_path_for_media}' class='img img-responsive {data_id}' /></div>"
                                       ) !!}


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="seo" class="tab-pane tab_seo fade">
                    <div class="text-right btn-save pt-25">
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                    <div class="panel panel-default mt-20">
                        <div class="panel-heading">FB</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <label for="seo-facebook-title" class="col-md-2 col-xs-12">Facebook Title</label>
                                    <div class="col-md-5 col-xs-12">
                                        {!! Form::text('fb[og:title]',($post)?$post->getSeoField('og:title','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:title',$post)]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="seo-facebook-desc" class="col-md-2 col-xs-12">Facebook Description</label>
                                    <div class="col-md-5 col-xs-12">
                                        {!! Form::text('fb[og:description]',($post)?$post->getSeoField('og:description','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'og:description',$post)]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-2 col-xs-12">Facebook Image</label>
                                    <div class="col-md-5 col-xs-12">
                                        {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($fbSeo,'og:image',$post)]) !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default mt-20">
                        <div class="panel-heading">Twitter</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <label for="seo-twitter-title" class="col-md-2 col-xs-12">Twitter Title</label>
                                    <div class="col-md-5 col-xs-12">
                                        {!! Form::text('twitter[og:title]',($post)?$post->getSeoField('og:title','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$post)]) !!}

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="seo-twitter-desc" class="col-md-2 col-xs-12">Twitter Description</label>
                                    <div class="col-md-5 col-xs-12">
                                        {!! Form::text('twitter[og:description]',($post)?$post->getSeoField('og:description','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'og:description',$post)]) !!}

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-2 col-xs-12">Twitter Image</label>
                                    <div class="col-md-5 col-xs-12">
                                        {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($twitterSeo,'og:image',$post)]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="seo-general-content">
                                <table class="form-table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">
                                            <label for="seo_focuskw">Focus Keyword:</label>
                                            <img src="/public/images/question-mark.png" alt="question">
                                        </th>
                                        <td>
                                            {!! Form::text('general[og:keywords]',($post)?$post->getSeoField('og:keywords'):null,['class'=>'form-control','placeholder'=>getSeo($general,'og:keywords',$post)]) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="seo_title">SEO Title:</label>
                                            <img src="/public/images/question-mark.png" alt="question">
                                        </th>
                                        <td>
                                            {!! Form::text('general[og:title]',($post)?$post->getSeoField('og:title'):null,['class'=>'form-control','placeholder'=>getSeo($general,'og:title',$post)]) !!}
                                            <br>
                                            <div>
                                                <p><span class="wrong">Warning:</span>
                                                    Title display in Google is limited to a fixed width, yours is too long.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="seo_metadesc">Meta description:</label>
                                            <img src="/public/images/question-mark.png" alt="question">
                                        </th>
                                        <td>
                                            {!! Form::textarea('general[og:description]',($post)?$post->getSeoField('og:title'):null,['class'=>'form-control','rows'=>2,'placeholder'=>getSeo($general,'og:description',$post)]) !!}
                                            <div>The <code>meta</code> description will be limited to 156 chars, 156 chars left.
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="seo-advanced">
                                <table class="form-table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">
                                            <label for="seo_meta-robots-noindex">Meta Robots Index:</label>
                                        </th>
                                        <td>
                                            {!! Form::select('robot[robots]',[null=>isset($robot)?(($robot->robots)?'As default Index':'As default No Index'):null,'1'=>'Index','0'=>'No Index'],($post)?$post->getSeoField('robots','robot'):null,['class'=>'']) !!}

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Meta Robots Follow</th>
                                        <td>
                                            <input type="radio" checked="checked" id="seo_meta-robots-nofollow_0"
                                                   value="0">
                                            <label for="seo_meta-robots-nofollow_0">Follow</label>
                                            <input type="radio" id="seo_meta-robots-nofollow_1"
                                                   value="1">
                                            <label for="seo_meta-robots-nofollow_1">Nofollow</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="seo_meta-robots-adv">Meta Robots Advanced:</label>
                                        </th>
                                        <td>
                                            <select multiple="multiple" size="7" style="height: 144px;"
                                                    id="seo_meta-robots-adv"
                                                    class="">
                                                <option selected="selected" value="-">Site-wide default: None</option>
                                                <option value="none">None</option>
                                                <option value="noodp">NO ODP</option>
                                                <option value="noydir">NO YDIR</option>
                                                <option value="noimageindex">No Image Index</option>
                                                <option value="noarchive">No Archive</option>
                                                <option value="nosnippet">No Snippet</option>
                                            </select>
                                            <div>Advanced <code>meta</code> robots settings for this page.</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="seo_canonical">Canonical URL:</label>
                                        </th>
                                        <td>
                                            <input type="text" id="seo_canonical" value=""
                                                   class="form-control"><br>
                                            <div>The canonical URL that this page should point to, leave empty to default to
                                                permalink. <a target="_blank"
                                                              href="#">Cross
                                                    domain canonical</a> supported too.
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-3">

                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="modal fade releted-products-add-modal" id="productsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select products</h4>
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
@section('css')
    <link rel="stylesheet" href="{{asset('public/admin_theme/flagstrap/css/flags.css')}}">
    <link rel="stylesheet" href="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.css">
    <link rel="stylesheet" href="{{asset('public/admin_theme/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>

    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')

    <script src="{{asset('public/admin_theme/flagstrap/js/jquery.flagstrap.js')}}"></script>
    <script src="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.js"></script>
    <script src="{{asset('public/admin_theme/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <script src="/public/js/tinymce/tinymce.min.js"></script>
    <script>
        $(function () {
            $("body").on('click', '.select-products', function () {
                let arr = [];
                $(".get-all-attributes-tab")
                    .children()
                    .each(function () {
                        arr.push($(this).attr("data-id"));
                    });
                AjaxCall("/admin/get-stocks", {arr}, function (res) {
                    if (!res.error) {
                        $("#productsModal .modal-body .all-list").empty();
                        res.data.forEach(item => {
                            let html = `<li data-id="${item.id}" class="option-elm-modal"><div><a
                                                href="#">${item.name}
                                                </a> <a class="btn btn-primary add-attribute-event" data-name="${item.name}"
                                                data-id="${item.id}">ADD</a></div></li>`;
                        $("#productsModal .modal-body .all-list").append(html);
                    });
                        $("#productsModal").modal();
                    }
                });
            });


            $("body").on("click", ".add-attribute-event", function () {
                let id = $(this).data("id");
                let name = $(this).data("name");
                $(".get-all-attributes-tab")
                    .append(`<li  data-id="${id}" class="option-elm-attributes col-md-3"><div class="wrap-item"><a
                                href="#">
<span><img src="https://alternatevape.com/wp-content/uploads/2011/05/alternate-vape-products-cbd-vape.jpg" alt=""></span>
<span class="name">${name}</span>

                                </a>
                                <div class="buttons">
                                <a href="javascript:void(0)" class="remove-all-attributes btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                                <input type="hidden" name="stocks[]" value="${id}">
                                </div></li>`);
                $(this)
                    .parent()
                    .remove();
            });
        });

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

        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax = arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }

        function initTinyMce(e) {
            tinymce.init({
                selector: e,
                height: 500,
                theme: 'modern',
                plugins: 'print preview fullpage  searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                image_advtab: true,
                templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                ],
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css'
                ]
            });
        }

        initTinyMce(".tinyMcArea")
        /*$('form').submit(function(e) {
         tinymce.get().forEach(item => {
         console.log(item.id)
         let html = item.getBody().innerHTML
         $(`#${item.id}`).val(html)
         console.log($(`#${item.id}`).val())
         })
         // DO STUFF...
         e.preventDefault()
         return false; // return false to cancel form action
         });*/
    </script>
    <script>


    </script>
    <script>
        $(function () {
            $(".sortable-panels").sortable();
            $(".sortable-panels").disableSelection();
        });
    </script>
    <script src="/public/admin_theme/blog_new.js"></script>

@stop
