@extends('layouts.admin')
@section('content')
    <div class="card panel panel-default">
        {!! Form::model($model) !!}
        <div class="card-body panel-body">
            <div class="tab-content tabs_content">

                <div id="home" class="tab-pane tab_info fade in active show">

                    <div class="sortable-panels">
                        <div class="form-group">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1">To User</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2">To Admin</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-content-store-settings">
                                <div class="tab-pane fade active in show" id="tab1"
                                     aria-labelledby="tab1-tab">
                                    <div class="form-group row">
                                        {{Form::label('from', 'From',['class' => 'col-sm-3'])}}
                                        <div class="col-md-9">

                                            {{Form::text('from',$model->from,['class' =>'form-control','id'=>'from','readonly'])}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {{Form::label('to', 'To',['class' => 'col-sm-3'])}}
                                        <div class="col-sm-9">
                                            @foreach($model->users->pluck('name') as $user)
                                                <span class="badge badge-dark">{!! $user !!}</span>
                                            @endforeach
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
                                                            {{--                                                            {{Form::label('subject_'.strtolower($language->code), 'Subject',['class' => 'col-sm-3'])}}--}}
                                                            <label class="col-sm-3">
                                                                {{__('Subject')}}
                                                            </label>
                                                            <div class="col-sm-9">
                                                                {{--{{Form::text('translatable['.strtolower($language->code).'][subject]',get_translated($model,strtolower($language->code),'subject'),['class' =>'form-control','id'=>'subject_am','placeholder' => __('Subject')])}}--}}

                                                                <div class="form-control">{!! get_translated($model,strtolower($language->code),'subject') !!}</div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            {{--{{Form::label('content_'.strtolower($language->code), 'Content',['class' => 'col-sm-3'])}}--}}
                                                            <label class="col-sm-3">{{__('Content')}}</label>
                                                            <div class="col-sm-9">
                                                                {{--{{Form::textarea('translatable['.strtolower($language->code).'][content]',get_translated($model,strtolower($language->code),'content') ,['class' =>'form-control content_editor','cols'=>30,'rows'=>2,'placeholder' => __('Content')])}}--}}
                                                                <div class="">
                                                                    {!! get_translated($model,strtolower($language->code),'content') !!}
                                                                </div>
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
                                            {{Form::text('from',$model->from,['class' =>'form-control','id'=>'from','readonly'])}}
                                            {{--                                            {{Form::select('admin[from]',$froms,null,['class' =>'form-control','id'=>'admin_from'])}}--}}
                                        </div>
                                    </div>
                                    {{--<div class="form-group row">--}}
                                    {{--{{Form::label('to_admin', 'To',['class' => 'col-sm-3'])}}--}}
                                    {{--<div class="col-sm-9">--}}
                                    {{--{{Form::select('admin[to]',$users,null,['class' =>'form-control','id'=>'to_admin'])}}--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
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
                                                            <label class="col-sm-3">{{__('Subject')}}</label>
                                                            {{--{{Form::label('subject_'.strtolower($language->code), 'Subject',['class' => 'col-sm-3'])}}--}}
                                                            <div class="col-sm-9">
                                                                {{--{{Form::text('admin[translatable]['.strtolower($language->code).'][subject]',null ,['class' =>'form-control','id'=>'admin_subject_am','placeholder' => __('Subject')])}}--}}
                                                                {!! get_translated($admin_model,strtolower($language->code),'subject') !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3">{{__('Conent')}}</label>
                                                            <div class="col-sm-9">
                                                                {{--{{Form::textarea('admin[translatable]['.strtolower($language->code).'][content]',null ,['class' =>'form-control content_editor','cols'=>30,'rows'=>2,'placeholder' => __('Content')])}}--}}
                                                                {!! get_translated($admin_model,strtolower($language->code),'content') !!}
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

        </div>
        {!! Form::close() !!}
    </div>
@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.1.2/tinymce.min.js" integrity="sha256-DdWABQXQvgw5MFqHCMQ34eo2D3GTcL6xA36LVz1sAmQ=" crossorigin="anonymous"></script>
    <script>
        $(".tag-input-v").select2({width: '100%'});
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
        initTinyMce(".content_editor");
        $('#form').submit(function () {
            tinyMCE.triggerSave()
            // DO STUFF...
            return true; // return false to cancel form action
        });
        $('body').on('click', '.create', function () {
            $('body').find('#form')
                .attr('action', '{!! route('post_create_admin_emails_notifications_send_email') !!}')
                .submit();
        });
        $('body').on('click', '.send_now', function () {
            $('body').find('#form')
                .attr('action', '{!! route('post_create_send_admin_emails_notifications_send_email') !!}')
                .submit();
        });
    </script>
@stop
