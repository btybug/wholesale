@extends('layouts.admin')

@section('content')
    {!! Form::model($post,['url' => route('admin_new_post'), 'id' => 'post_form','files' => true]) !!}
    <div class="card panel panel-default bg-transparent border-0">
        <div class="card-header panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2 class="m-0">{{ ($post) ? $post->title : "Add Post" }}</h2>
            <div class="btn-save mt-1">
                <button type="button" class="btn btn-success btn-view">View Product</button>
                {!! Form::submit('Save',['class' => 'btn btn-info']) !!}
            </div>
        </div>
        <div class="card-body panel-body px-0">
            <ul class="nav nav-tabs new-main-admin--tabs mb-3">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#info">Info</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#seo">SEO</a></li>
            </ul>

            <div class="tab-content tabs_content">
                <div id="info" class="tab-pane tab_info fade in active show">

                    {!! Form::hidden('id',null) !!}

                    <div class="row sortable-panels">
                        <div class="col-lg-8 col-md-7 col-sm-8">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <div class="card mb-3">
                                            <div class="card-header">
                                                Main
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    @if(count(get_languages()))
                                                        <ul class="nav nav-tabs tab_lang_horizontal">
                                                            @foreach(get_languages() as $language)
                                                                <li class="nav-item"><a class="nav-link @if($loop->first) active @endif" data-toggle="tab"
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
                                                                        <label class="col-md-2 col-form-label">Title</label>
                                                                        <div class="col-md-10">
                                                                            {!! Form::text('translatable['.strtolower($language->code).'][title]',get_translated($post,strtolower($language->code),'title'),['class'=>'form-control']) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        {{Form::label('purl', 'Post Url',['class'=>'col-md-2 col-form-label'])}}
                                                                        <div class="col-md-10">
                                                                            {{Form::text('translatable['.strtolower($language->code).'][url]', get_translated($post,strtolower($language->code),'url'),['class' =>'form-control','id'=>'purl','placeholder' => 'Enter URL ...'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-2 col-form-label">Short Description</label>
                                                                        <div class="col-md-10">
                                                                            {!! Form::textarea('translatable['.strtolower($language->code).'][short_description]',get_translated($post,strtolower($language->code),'short_description'),['class'=>'form-control','cols'=>30,'rows'=>2]) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-2 col-form-label">Long Description</label>
                                                                        <div class="col-md-10">
                                                                            {!! Form::textarea('translatable['.strtolower($language->code).'][long_description]',get_translated($post,strtolower($language->code),'long_description'),['class'=>'form-control tinyMcArea','cols'=>30,'rows'=>10]) !!}

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            {{--<div class="form-group row">--}}
                                                {{--<label class="col-sm-3">Featured image</label>--}}
                                                {{--<div class="col-sm-9">--}}
                                                    {{--{!! media_button('image',$post) !!}--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                                <div class="card panel panel-default">
                                                    <div class="card-header panel-heading clearfix">
                                                        <p>Gallery images</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div>
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

                                        <div class="card panel panel-default mt-20 releted__products-panel">
                                            <div class="card-header panel-heading d-flex justify-content-between align-items-center">
                                        <span>
                                            Related Products
                                        </span>
                                                <button type="button" class="btn btn-primary select-products"><i class="fa fa-plus fa-sm mr-10"></i>Add Product</button>
                                            </div>
                                            <div class="card-body panel-body product-body">
                                                <ul class="get-all-attributes-tab row">
                                                    @if(isset($post) && count($post->stocks))
                                                        @foreach($post->stocks as $stock)
                                                            <li data-id="{{ $stock->id }}"
                                                                class="option-elm-attributes col-xl-3 col-lg-4 col-sm-6 mb-2">
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
                        <div class="col-lg-4 col-md-5 col-sm-4">
                            <div class="view-product-wall mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Panel
                                    </div>
                                    <div class="card-body">
                                        <div class="author-wall wall border-0 bg-transparent p-0">
                                            <div class="row">
                                                {{Form::label('author', 'Author',['class' => 'col-xl-3'])}}
                                                <div class="col-xl-9">
                                                    {!! Form::select('user_id',$authors,null,
                                                                ['class' => 'form-control','id'=> 'status']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="status-wall wall border-0 bg-transparent p-0">
                                            <div class="row">
                                                {{Form::label('status', 'Status',['class' => 'col-xl-3'])}}
                                                <div class="col-xl-9">
                                                    {!! Form::select('status',[0 => 'Draft',1 => 'Published'],null,
                                                                ['class' => 'form-control','id'=> 'status']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-wall wall border-0 bg-transparent p-0">
                                            <div class="row">
                                                {{Form::label('comment', 'Enable comment',['class' => 'col-xl-3'])}}
                                                <div class="col-xl-9">
                                                    YES {!! Form::radio('comment_enabled',1,true,['class' => '']) !!}
                                                    NO {!! Form::radio('comment_enabled',0,null,['class' => '']) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="category-wall wall border-0 bg-transparent p-0">
                                            <div class="row">
                                                <label class="col-xl-3 control-label" for="input-category"><span
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="Choose all products under selected category.">Category</span></label>
                                                <div class="col-xl-9">
                                                    <div class="form-group">
                                                        {!! Form::hidden('categories',(isset($checkedCategories))
                                                        ? json_encode($checkedCategories) : null,['id' => 'categories_tree']) !!}
                                                        <div id="treeview_json"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card panel panel-default">
                                <div class="card-header panel-heading clearfix">
                                    <p class="pull-left mb-0">
                                        <b data-toggle="tooltip" title="" data-original-title="Change featured image">Featured image</b>
                                    </p>
                                </div>
                                <div class="card-body blog-img-card-body">
                                    {!! media_button('image',$post,false,'drive',
                                           "<div class='edit-featured-img-outer'><img src='{img_path_for_media}' class='img img-responsive {data_id}' /></div>"
                                       ) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="seo" class="tab-pane tab_seo fade">
                    <div class="text-right btn-save pt-25">
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                    <div class="card panel panel-default mt-20">
                        <div class="card-header panel-heading">FB</div>
                        <div class="card-body panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <label for="seo-facebook-title" class="col-xl-2 col-lg-3 col-sm-4">Facebook Title</label>
                                    <div class="col-xl-5 col-lg-9 col-sm-8">
                                        {!! Form::text('fb[title]',($post)?$post->getSeoField('title','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'title',$post)]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="seo-facebook-desc" class="col-xl-2 col-lg-3 col-sm-4">Facebook Description</label>
                                    <div class="col-xl-5 col-lg-9 col-sm-8">
                                        {!! Form::text('fb[description]',($post)?$post->getSeoField('description','fb'):null,['class'=>'form-control','placeholder'=>getSeo($fbSeo,'description',$post)]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-3 col-sm-4">Facebook Image</label>
                                    <div class="col-xl-5 col-lg-9 col-sm-8">
                                        {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($fbSeo,'image',$post)]) !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card panel panel-default mt-20">
                        <div class="card-header panel-heading">Twitter</div>
                        <div class="card-body panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <label for="seo-twitter-title" class="col-xl-2 col-lg-3 col-sm-4">Twitter Title</label>
                                    <div class="col-xl-5 col-lg-9 col-sm-8">
                                        {!! Form::text('twitter[title]',($post)?$post->getSeoField('title','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'description',$post)]) !!}

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="seo-twitter-desc" class="col-xl-2 col-lg-3 col-sm-4">Twitter Description</label>
                                    <div class="col-xl-5 col-lg-9 col-sm-8">
                                        {!! Form::text('twitter[description]',($post)?$post->getSeoField('description','twitter'):null,['class'=>'form-control','placeholder'=>getSeo($twitterSeo,'description',$post)]) !!}

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-3 col-sm-4">Twitter Image</label>
                                    <div class="col-xl-5 col-lg-9 col-sm-8">
                                        {!! Form::text(null,null,['class'=>'form-control','readonly','disabled','placeholder'=>getSeo($twitterSeo,'image',$post)]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
SEO
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-9">
                                    <div class="seo-general-content">
                                        <div class="table-responsive">
                                            <table class="form-table">
                                                <tbody>
                                                <tr>
                                                    <th scope="row">
                                                        <label for="seo_focuskw">Focus Keyword:</label>
                                                        <img src="/public/images/question-mark.png" alt="question">
                                                    </th>
                                                    <td>
                                                        {!! Form::text('general[keywords]',($post)?$post->getSeoField('keywords'):null,['class'=>'form-control','placeholder'=>getSeo($general,'keywords',$post)]) !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <label for="seo_title">SEO Title:</label>
                                                        <img src="/public/images/question-mark.png" alt="question">
                                                    </th>
                                                    <td>
                                                        {!! Form::text('general[title]',($post)?$post->getSeoField('title'):null,['class'=>'form-control','placeholder'=>getSeo($general,'title',$post)]) !!}
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
                                                        {!! Form::textarea('general[description]',($post)?$post->getSeoField('title'):null,['class'=>'form-control','rows'=>2,'placeholder'=>getSeo($general,'description',$post)]) !!}
                                                        <div>The <code>meta</code> description will be limited to 156 chars, 156 chars left.
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="seo-advanced">
                                        <div class="table-responsive">
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
                                </div>
                                <div class="col-xl-3">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    {!! Form::close() !!}
    <div class="modal fade releted-products-add-modal" id="productsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select products</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="search-attr" class="col-sm-2 col-form-label">Search</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="search-attr" placeholder="Search">
                        </div>
                    </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.1.2/tinymce.min.js" integrity="sha256-DdWABQXQvgw5MFqHCMQ34eo2D3GTcL6xA36LVz1sAmQ=" crossorigin="anonymous"></script>
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
                plugins: 'print preview fullpage   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   imagetools textpattern noneditable help    charmap   quickbars  emoticons ',
  //   imagetools_cors_hosts: ['picsum.photos'],
  //   tinydrive_token_provider: function (success, failure) {
  //     success({ token: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJqb2huZG9lIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.Ks_BdfH4CWilyzLNk8S2gDARFhuxIauLa8PwhdEQhEo' });
  //   },
  //   tinydrive_demo_files_url: '/docs/demo/tiny-drive-demo/demo_files.json',
  //   tinydrive_dropbox_app_key: 'jee1s9eykoh752j',
  //   tinydrive_google_drive_key: 'AIzaSyAsVRuCBc-BLQ1xNKtnLHB3AeoK-xmOrTc',
  //   tinydrive_google_drive_client_id: '748627179519-p9vv3va1mppc66fikai92b3ru73mpukf.apps.googleusercontent.com',
  mobile: {
      plugins: 'print preview fullpage   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   textpattern noneditable help   charmap  quickbars  emoticons '
  },
  menu: {
      tc: {
      title: 'TinyComments',
      items: 'addcomment showcomments deleteallconversations'
      }
  },
  menubar: '',
  //   'file edit view insert format tools table tc help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist  | forecolor backcolor    removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media  template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
  autosave_ask_before_unload: true,
  //   autosave_interval: "30s",
  //   autosave_prefix: "{path}{query}-{id}-",
  //   autosave_restore_when_empty: false,
  //   autosave_retention: "2m",
  image_advtab: true,
  content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tiny.cloud/css/codepen.min.css'
  ],
  link_list: [
      { title: 'My page 1', value: 'http://www.tinymce.com' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
      { title: 'My page 1', value: 'http://www.tinymce.com' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
      { title: 'None', value: '' },
      { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  height: 400,
  //   file_picker_callback: function (callback, value, meta) {
  //     /* Provide file and text for the link dialog */
  //     if (meta.filetype === 'file') {
  //       callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
  //     }

  //     /* Provide image and alt text for the image dialog */
  //     if (meta.filetype === 'image') {
  //       callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
  //     }

  //     /* Provide alternative source and posted for the media dialog */
  //     if (meta.filetype === 'media') {
  //       callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
  //     }
  //   },
  templates: [
          { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
      { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
      { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 600,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_drawer: 'sliding',
  spellchecker_dial true,
  spellchecker_whitelist: ['Ephox', 'Moxiecode'],
  tinycomments_mode: 'embedded',
  content_style: ".mymention{ color: gray; }",
  contextmenu: "link image imagetools table configurepermanentpen",
  mentions_selector: '.mymention',
  //   mentions_fetch: mentions_fetch,
  //   mentions_menu_hover: mentions_menu_hover,
  //   mentions_menu_complete: mentions_menu_complete,
  //   mentions_select: mentions_select,
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
    <script src="/public/admin_theme/blog_new.js"></script>

@stop
