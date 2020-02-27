@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div><h3>Stock Multiple Edit</h3></div>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Short description</th>
                    <th>Long description</th>
                    <th>Brand</th>
                    <th>Categories</th>
                    <th>Status</th>
                </tr>
                </thead>
                {!! Form::open(['id' => 'rowsEditForm']) !!}
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                {!! Form::text("items[$item->id][name]",$item->name,['class'=>'form-control']) !!}
                            </td>
                            <td>
                                {!! Form::text("items[$item->id][short_description]",$item->short_description,['class'=>'form-control']) !!}
                            </td>
                            <td>
                                {!! Form::textarea("items[$item->id][long_description]",$item->long_description,['class'=>'form-control long-description']) !!}
                            </td>

                            <td>
                                {!! Form::select("items[$item->id][brand_id]",$brands,$item->brand_id,['class'=>'custom-select','style' => 'width:100%']) !!}
                            </td>
                            <td>
                                {!! Form::select("items[$item->id][categories][]",$categories,$item->categories()->pluck('id','id'),['class'=>'custom-select','style' => 'width:100%','multiple'=>true]) !!}
                            </td>
                            <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio("items[$item->id][status]",1,($item->status == 1)?true:false,['class'=>'','id'=>$item->id.'_published']) !!}
                                    <label for="{!! $item->id !!}_published'" class="">Published</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    {!! Form::radio("items[$item->id][status]",0,($item->status == 0)?true:false,['class'=>'','id'=>$item->id.'_draft']) !!}
                                    <label for="{!! $item->id !!}_draft" class="">Draft</label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    {!! Form::close() !!}
                </tbody>
                <tfoot>
                 <tr>
                     <td colspan="5">
                         <button type="button" class="saveRows btn btn-primary float-right">Save</button>
                     </td>
                 </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop
@section('css')
    <link href="/public/plugins/select2/select2.min.css" rel="stylesheet"/>
@stop
@section('js')
    <script src="/public/plugins/select2/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.1.2/tinymce.min.js" integrity="sha256-DdWABQXQvgw5MFqHCMQ34eo2D3GTcL6xA36LVz1sAmQ=" crossorigin="anonymous"></script>
    <script>
        $('.custom-select').select2();

        $("body").on('click',".saveRows",function () {
            let form = $('#rowsEditForm').serialize();

            AjaxCall("{!! route('post_admin_stock_edit_row_many_save') !!}", form, function (res) {
                if (!res.error) {
                    window.location.href = "/admin/stock";
                }
            });
        })

        $(function () {
            tinymce.init({
                selector: ".long-description",
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
        })
    </script>
@stop
