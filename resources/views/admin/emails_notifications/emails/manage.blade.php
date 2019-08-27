@extends('layouts.admin')

@section('content')
    <div class="card panel panel-default">
        <div class="card-header panel-heading clearfix">
            <div class="pull-left">
                <h3>Email</h3>
                {!! Form::model($model) !!}
            </div>
            <div class="pull-right">
                <div class="text-right btn-save">
                    {!! media_button('template',null,false,'html') !!}
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>

        <div class="card-body panel-body">
            <div class="row">
                <div class="tab-content tabs_content col-md-9">
                    <div id="home" class="tab-pane tab_info fade in active show">

                        <div class="sortable-panels">
                            <div class="form-group">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item ">
                                        <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1">To User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2">To Admin</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-content-store-settings overflow-visible">
                                    <div class="tab-pane fade active in show" id="tab1"
                                         aria-labelledby="tab1-tab">
                                        <div class="form-group row">
                                            {{Form::label('from', 'From',['class' => 'col-sm-3'])}}
                                            <div class="col-sm-9">
                                                {{Form::select('from',$froms,null,['class' =>'form-control','id'=>'from'])}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {{Form::label('to', 'To',['class' => 'col-sm-3'])}}
                                            <div class="col-sm-9">
                                                {{Form::text(null,'{user}' ,['class' =>'form-control','id'=>'from','readonly','disabled'])}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            @if(count(get_languages()))
                                                <ul class="nav nav-tabs">
                                                    @foreach(get_languages() as $language)
                                                        <li class="nav-item"><a class="nav-link @if($loop->first) active @endif" data-toggle="tab"
                                                                                                       href="#{{ strtolower($language->code) }}">
                                                                <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                            </a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            <div class="tab-content pt-25">
                                                @if(count(get_languages()))
                                                    @foreach(get_languages() as $language)
                                                        <div id="{{ strtolower($language->code) }}"
                                                             class="tab-pane fade  @if($loop->first) in active show @endif">
                                                            <div class="form-group row">
                                                                {{Form::label('subject_'.strtolower($language->code), 'Subject',['class' => 'col-sm-3'])}}
                                                                <div class="col-sm-9">
                                                                    {{Form::text('translatable['.strtolower($language->code).'][subject]',get_translated($model,strtolower($language->code),'subject') ,['class' =>'form-control','id'=>'subject_am','placeholder' => __('Subject')])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                {{Form::label('content_'.strtolower($language->code), 'Content',['class' => 'col-sm-12'])}}
                                                                <div class="col-sm-12">
                                                                    {{Form::textarea('translatable['.strtolower($language->code).'][content]',get_translated($model,strtolower($language->code),'content') ,['class' =>'form-control content_editor','cols'=>30,'rows'=>2,'placeholder' => __('Content')])}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                        <div class="form-group row">
                                            {{Form::label('admin_from', 'From',['class' => 'col-sm-3'])}}
                                            <div class="col-sm-9">
                                                {{Form::select('admin[from]',$froms,($admin_model)?$admin_model->from:null,['class' =>'form-control','id'=>'admin_from'])}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {{Form::label('to_admin', 'To',['class' => 'col-sm-3'])}}
                                            <div class="col-sm-9">
                                                {{Form::select('admin[to]',$froms,($admin_model)?$admin_model->to:null,['class' =>'form-control','id'=>'to_admin'])}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {{Form::label('to_admin', 'CC',['class' => 'col-sm-3'])}}
                                            <div class="col-sm-9">
                                                {{Form::select('admin[cc][]',$froms,($admin_model)?explode(',',$admin_model->cc):null,['class' =>'form-control','id'=>'admin-cc','multiple'=>'multiple'])}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            @if(count(get_languages()))
                                                <ul class="nav nav-tabs">
                                                    @foreach(get_languages() as $language)
                                                        <li class="nav-item"><a class="nav-link @if($loop->first) active @endif" data-toggle="tab"
                                                                                                       href="#{{ strtolower($language->code) }}">
                                                                <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                            </a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            <div class="tab-content pt-25">
                                                @if(count(get_languages()))
                                                    @foreach(get_languages() as $language)
                                                        <div id="{{ strtolower($language->code) }}"
                                                             class="tab-pane fade  @if($loop->first) in active show @endif">
                                                            <div class="form-group row">
                                                                {{Form::label('subject_'.strtolower($language->code), 'Subject',['class' => 'col-sm-3'])}}
                                                                <div class="col-sm-9">
                                                                    {{Form::text('admin[translatable]['.strtolower($language->code).'][subject]',get_translated($admin_model,strtolower($language->code),'subject') ,['class' =>'form-control','id'=>'admin_subject_am','placeholder' => __('Subject')])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                {{Form::label('content_'.strtolower($language->code), 'Content',['class' => 'col-sm-12'])}}
                                                                <div class="col-sm-12">
                                                                    {{Form::textarea('admin[translatable]['.strtolower($language->code).'][content]',get_translated($admin_model,strtolower($language->code),'content') ,['class' =>'form-control content_editor','cols'=>30,'rows'=>2,'placeholder' => __('Content')])}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @if(isset($shortcodes->relatedShortcoders[$model->slug]))
                        <table class="table table-striped table--email-temp mb-50">
                            <thead>
                            <tr class="table--email-temp_top">
                                <th colspan="3">Specific shortcodes for this type</th>
                            </tr>
                            <tr class="table--email-temp_bottom">
                                <th></th>
                                <th>Code</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($shortcodes->relatedShortcoders[$model->slug] as $shortcode)
                                <tr>
                                    <td><i class="fa fa-file-text-o table--email-temp_icon" aria-hidden="true"></i></td>
                                    <td><b>{!! '['.$shortcode['code'].']' !!}</b></td>
                                    <td>{!! $shortcode['description'] !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                    <table class="table table-striped table--email-temp">
                        <thead>
                        <tr class="table--email-temp_top">
                            <th colspan="3">Common Shortcodes</th>
                        </tr>
                        <tr class="table--email-temp_bottom">
                            <th></th>
                            <th>Property</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shortcodes->mailShortcodes as $shortcode)
                            <tr>
                                <td><i class="fa fa-file-text-o table--email-temp_icon" aria-hidden="true"></i></td>
                                <td><b>{!! '['.$shortcode['code'].']' !!}</b></td>
                                <td>{!! $shortcode['description'] !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="form-group row">
                        {{Form::label('is_active', 'Status',['class' => 'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::select('is_active',[1=>'Active',0=>'Inactive'] ,null,['class' =>'form-control','id'=>'to_admin'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email_type" class="col-sm-3">Type</label>
                        <div class="col-sm-9">
                            {!! Form::select('category_id',$categories,null,['class'=>'form-control','id'=>'email_type']) !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="/public/js/tinymce/tinymce.min.js"></script>
    <script>
        $("#admin-cc").select2({width: '100%', tags: true});
        function initTinyMce(e) {
            tinymce.init({
                selector: e,
                height: 500,
                // file_picker_types: 'file image media',
                // automatic_uploads: true,


                // Example content CSS (should be your site CSS)

//                 file_picker_callback: function(cb, value, meta) {
//                     var input = document.createElement('input');
//                     input.setAttribute('type', 'file');
//                     input.setAttribute('accept', 'image/*');
//                     input.onchange = function() {
//                         var file = this.files[0];
//                         var reader = new FileReader();
//                         reader.readAsDataURL(file);
//                         reader.onload = function () {
//
//                             var name = file.name.split('.')[0];
//                             var blobCache = tinymce.activeEditor.editorUpload.blobCache;
//                             var blobInfo = blobCache.create(name, file, reader.result);
//                             blobCache.add(blobInfo);
//
// // Provide file and text for the link dialog
//                             if (meta.filetype == 'file') {
//                                 cb(blobInfo.blobUri(), {text: name, target: '_blank'});
//                             }
//
// // Provide image and alt text for the image dialog
//                             if (meta.filetype == 'image') {
//                                 cb(blobInfo.blobUri(), {alt: file.name, title: name});
//                             }
//
// // Provide alternative source and posted for the media dialog
//                             if (meta.filetype == 'media') {
//                                 cb(blobInfo.blobUri(), {source: blobInfo.blobUri(), poster: 'image.jpg'});
//                             }
//                         };
//                     };
//                     input.click();
//                     },

                // menubar: "insert",
                // visualblocks_default_state: true,
                // object_resizing : false,
                // fullpage_default_doctype: "<!DOCTYPE html>",
                theme: 'modern',
                plugins: ['toc codesample print preview code fullpage bbcode searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help','htmlloader'],
                convert_newlines_to_brs : false,
                force_p_newlines : true,
                force_br_newlines : false,
                remove_linebreaks : true,
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | htmlloader | template',
                image_advtab: true,

                templates: {!! \App\Models\Media\Items::TinyMceTemplates() !!},
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css'
                ]
            });
        }

        initTinyMce(".content_editor");
        $('#form').submit(function () {
            tinyMCE.triggerSave();
            // DO STUFF...
            return true; // return false to cancel form action
        });
    </script>
@stop
