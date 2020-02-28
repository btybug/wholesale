@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between w-100 admin-general--tabs-wrapper">
        <ul class="nav nav-tabs new-main-admin--tabs mb-3 admin-general--tabs" id="myTab" role="tablist">
            <li class="nav-item ">
                <a class="nav-link " id="general-tab" href="{!! route('admin_settings_translations') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Products</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " id="items-tab" href="{!! route('admin_settings_translations_items') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Items</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link active" id="attr-tab" href="{!! route('admin_settings_translations_attrs') !!}" role="tab"
                   aria-controls="general" aria-selected="true" aria-expanded="true">Attributes</a>
            </li>
        </ul>
        </div>
        <div class="tab-content">
            {!! Form::open(['class'=>'form-horizontal']) !!}
            <div class="card panel panel-default mb-3">
                <div class="card-body panel-body">

                    <div class="form-group">
                        <div class="accordion" id="accordionTranslation">
                            @foreach($attrs as $attr)
                                <div class="card">
                                    <div class="card-header" id="heading{!! $attr->id !!}">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{!! $attr->id !!}" aria-expanded="true" aria-controls="collapse{!! $attr->id !!}">
                                                <h6>{!! $attr->name !!} translation</h6>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse{!! $attr->id !!}" class="collapse" aria-labelledby="heading{!! $attr->id !!}" data-parent="#accordionTranslation">
                                        <div class="card-body">
                                            <div class="text-right mb-2">
                                                {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                                            </div>
                                            @if(count(get_languages()))
                                                <ul class="nav nav-tabs">
                                                    @foreach(get_languages() as $language)
                                                        <li class="nav-item"><a
                                                                class="nav-link @if($loop->first) active @endif"
                                                                data-toggle="tab"
                                                                href="#{{ strtolower($language->code).$attr->id }}">
                                                                            <span
                                                                                class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                                            </a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            <div class="tab-content mt-20">
                                                @if(count(get_languages()))
                                                    @foreach(get_languages() as $language)
                                                        <div id="{{ strtolower($language->code).$attr->id }}"
                                                             class="tab-pane fade  @if($loop->first) in active show @endif">
                                                            <div class="form-group row mt-3">
                                                                <label
                                                                    class="col-xl-2 control-label col-form-label text-xl-right"><span
                                                                        data-toggle="tooltip"
                                                                        title=""
                                                                        data-original-title="Attribute Name Title">Product Name</span></label>
                                                                <div class="col-xl-10">
                                                                    {!! Form::text('translatable['.$attr->id.']['.strtolower($language->code).'][name]',get_translated($attr,strtolower($language->code),'name'),['class'=>'form-control']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mt-3">
                                                                <label
                                                                    class="col-xl-2 control-label col-form-label text-xl-right"><span
                                                                        data-toggle="tooltip"
                                                                        title=""
                                                                        data-original-title="Short Description">Description</span></label>
                                                                <div class="col-xl-10">
                                                                    {!! Form::textarea('translatable['.$attr->id.']['.strtolower($language->code).'][description]',get_translated($attr,strtolower($language->code),'description'),['class'=>'form-control','cols'=>30,'rows'=>2]) !!}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
            {!! Form::close() !!}
            <p class="pull-right">
                {!! $attrs->links('vendor.pagination.bootstrap-4',['filterModel' => []]) !!}
            </p>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">

@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.1.2/tinymce.min.js" integrity="sha256-DdWABQXQvgw5MFqHCMQ34eo2D3GTcL6xA36LVz1sAmQ=" crossorigin="anonymous"></script>

    <script>
        $(function () {
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

            function makeid() {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

                for (var i = 0; i < 9; i++)
                    text += possible.charAt(Math.floor(Math.random() * possible.length));

                return text;
            }
        })
    </script>

@stop
