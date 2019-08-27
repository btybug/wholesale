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
                   <div class="col-md-7 ">
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
                                           <label class="col-sm-3">Attachments</label>
                                           <div class="col-sm-9">
                                               {!! Form::file('attachments[]',['multiple' => true]) !!}
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-5 ">
                       <div class="view-product-wall list-group">
                           <div class="author-wall wall ">
                               <div class="row">
                                   {{Form::label('author', 'Author',['class' => 'col-sm-3'])}}
                                   <div class="col-sm-9">
                                       {{ Auth::user()->name }}
                                   </div>
                               </div>
                           </div>
                           <div class="status-wall wall ">
                               <div class="row">
                                   {{Form::label('user', 'User',['class' => 'col-sm-3'])}}
                                   <div class="col-sm-9">
                                       {!! Form::select('user_id',$users,null,
                                                   ['class' => 'form-control','id'=> 'user']) !!}
                                   </div>
                               </div>
                           </div>
                           <div class="status-wall wall ">
                               <div class="row">
                                   {{Form::label('status', 'Status',['class' => 'col-sm-3'])}}
                                   <div class="col-sm-9">
                                       {!! Form::select('status_id',$statuses,null,
                                                   ['class' => 'form-control','id'=> 'status']) !!}
                                   </div>
                               </div>
                           </div>
                           <div class="tag-wall wall ">
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
                           <div class="status-wall wall ">
                               <div class="row">
                                   {{Form::label('category_id', 'Category',['class' => 'col-sm-3'])}}
                                   <div class="col-sm-9">
                                       {!! Form::select('category_id',['' => 'Select'] + $categories,null,
                                                   ['class' => 'form-control','id'=> 'category']) !!}
                                   </div>
                               </div>
                           </div>
                           <div id="category-related">

                           </div>
                           <div class="status-wall wall ">
                               <div class="row">
                                   {{Form::label('priority_id', 'Priority',['class' => 'col-sm-3'])}}
                                   <div class="col-sm-9">
                                       {!! Form::select('priority_id',$priorities,null,
                                                   ['class' => 'form-control','id'=> 'priority']) !!}
                                   </div>
                               </div>
                           </div>
                           <div class="status-wall wall ">
                               <div class="row">
                                   {{Form::label('staff', 'Responsible staff',['class' => 'col-sm-3'])}}
                                   <div class="col-sm-9">
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

    <script src="/public/js/tinymce/tinymce.min.js"></script>
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

    <script src="/public/admin_theme/blog_new.js"></script>

@stop
