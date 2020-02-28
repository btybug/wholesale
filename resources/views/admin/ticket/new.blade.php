@extends('layouts.admin')
@section('content-header')

@stop

@section('content')
    <div class="stock-page">
        {!! Form::model($model,['url' => route('admin_tickets_new_save'), 'id' => 'ticket_form','files' => true]) !!}
        {!! Form::hidden('id',null) !!}
       <div class="card panel panel-default">

           <div class="card-header panel-heading clearfix">
               <h2 class="mt-0 pull-left">New ticket</h2>

               <div class="pull-right btn-save">
                   {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
               </div>
           </div>

           <div class="card-body panel-body">

               <div class="row sortable-panels">
                   <div class="col-xl-7 col-sm-6">
                       <div class="form-group">
                           <div class="row">
                               <div class="col-sm-12">
                                   <div class="form-group">
                                       <div class="form-group">
                                           <label>Subject</label>
                                           {!! Form::text('subject',null,['class'=>'form-control']) !!}
                                       </div>
                                       <div class="form-group">
                                           <label>Summary</label>
                                           {!! Form::textarea('summary',null,['class'=>'form-control','cols'=>30,'rows'=>2]) !!}
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <div class="form-group row">
                                           <label class="col-lg-3">Attachments</label>
                                           <div class="col-lg-9">
                                               {!! Form::file('attachments[]',['multiple' => true]) !!}
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-xl-5 col-sm-6">
                       <div class="view-product-wall list-group">
                           <div class="author-wall wall ">
                               <div class="row form-group">
                                   {{Form::label('author', 'Author',['class' => 'col-lg-3'])}}
                                   <div class="col-lg-9">
                                       {{ Auth::user()->name }}
                                   </div>
                               </div>
                           </div>
                           <div class="status-wall wall form-group">
                               <div class="row">
                                   {{Form::label('user', 'User',['class' => 'col-lg-3'])}}
                                   <div class="col-lg-9">
                                       {!! Form::select('user_id',$users,null,
                                                   ['class' => 'form-control','id'=> 'user']) !!}
                                   </div>
                               </div>
                           </div>
                           <div class="status-wall wall form-group">
                               <div class="row">
                                   {{Form::label('status', 'Status',['class' => 'col-lg-3'])}}
                                   <div class="col-lg-9">
                                       {!! Form::select('status_id',$statuses,null,
                                                   ['class' => 'form-control','id'=> 'status']) !!}
                                   </div>
                               </div>
                           </div>
                           <div class="tag-wall wall form-group">
                               <div class="row">
                                   <label class="col-lg-3 control-label" for="input-category"><span
                                               data-toggle="tooltip" title=""
                                               data-original-title="Choose all products under selected category.">Tags</span></label>
                                   <div class="col-lg-9">
                                       <input type="text" name="" value="" placeholder="Tags"
                                              id="input-tags" class="form-control" autocomplete="off">
                                       <ul class="dropdown-menu"></ul>
                                       <div id="coupon-category" class="well well-sm view-coupon">
                                           <ul class="coupon-tags-list">
                                               @if($model && $model->tags)
                                                   @php
                                                       $tags = json_decode($model->tags, true);
                                                   @endphp

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
                           <div class="status-wall wall form-group">
                               <div class="row">
                                   {{Form::label('category_id', 'Category',['class' => 'col-lg-3'])}}
                                   <div class="col-lg-9">
                                       {!! Form::select('category_id',['' => 'Select'] + $categories,null,
                                                   ['class' => 'form-control','id'=> 'category']) !!}
                                   </div>
                               </div>
                           </div>
                           <div id="category-related">

                           </div>
                           <div class="status-wall wall form-group">
                               <div class="row">
                                   {{Form::label('priority_id', 'Priority',['class' => 'col-lg-3'])}}
                                   <div class="col-lg-9">
                                       {!! Form::select('priority_id',$priorities,null,
                                                   ['class' => 'form-control','id'=> 'priority']) !!}
                                   </div>
                               </div>
                           </div>
                           <div class="status-wall wall form-group">
                               <div class="row">
                                   {{Form::label('staff', 'Responsible staff',['class' => 'col-lg-3'])}}
                                   <div class="col-lg-9">
                                       {!! Form::select('staff_id',$staff,null,
                                                   ['class' => 'form-control','id'=> 'staff']) !!}
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
        {!! Form::close() !!}

    </div>
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
    <script src="/public/js/tiket.js"></script>

    <script>

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
                    data: {!! json_encode([]) !!}
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
                spellchecker_dialog: true,
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
    <script>


    </script>

    <script src="/public/admin_theme/blog_new.js"></script>

@stop
