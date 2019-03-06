@extends('layouts.admin')
@section('content')
  <div id="page-wrapper" class="gray-bg">

    <div class="wrapper wrapper-content h-100">
      <div class="row dis-flex">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 h-100 left--media-col">
          <div class="ibox scrollbar_custom float-e-margins over-auto">
            <div class="ibox-content {!! $settings['leftcontainer']??null !!}">
              <div class="file-manager">

                {{--<h5>Show:</h5>--}}
                {{--<a href="#" class="file-control active">Ale</a>--}}
                {{--<a href="#" class="file-control">Documents</a>--}}
                {{--<a href="#" class="file-control">Audio</a>--}}
                {{--<a href="#" class="file-control">Images</a>--}}
                {{--<div class="hr-line-dashed"></div>--}}
                {{--<button class="btn btn-info btn-block upload-file_button {!! $settings['uploadbutton']??null !!}">--}}
                {{--Upload Files--}}
                {{--</button>--}}
                {{--<div class="hr-line-dashed">--}}


                {{--</div>--}}

                <h5><a class="pull-right {!! $settings['addbutton']??null !!}" data-toggle="collapse"
                       role="button" href="#createFolder">
                    <i class="fa fa-plus" aria-hidden="true"></i></a>
                  <a bb-media-click="get_folder_items" data-id="1">FOLDERS</a>
                  <span data-media="selected"></span></h5>
                <div class="collapse" id="createFolder">
                  <div class="input-group">
                    <input type="text" class="form-control new-folder-input" data-mediafield="addfolder"
                           placeholder="Folder name">
                    <span class="input-group-btn">
                                      <button class="btn btn-primary-reset-back" type="button"
                                              bb-media-click="add_new_folder" data-media="addfolder">Add</button>
                                    </span>
                  </div><!-- /input-group -->
                </div>
                <script>
                  // $('.new-folder-input').addEventListener('keypress', function(ev) {
                  //     ev.keyCode === 13 && $('[bb-media-click="add_new_folder"]').click()
                  // })
                </script>
                <div class="folder-list" id="folder-list" style="padding: 0;" data-media="folder">

                </div>
                {{--<h5 class="tag-title">Tags</h5>--}}
                {{--<ul class="tag-list" style="padding: 0">--}}
                {{--<li><a href="">Family</a></li>--}}
                {{--<li><a href="">Work</a></li>--}}
                {{--<li><a href="">Home</a></li>--}}
                {{--<li><a href="">Children</a></li>--}}
                {{--<li><a href="">Holidays</a></li>--}}
                {{--<li><a href="">Music</a></li>--}}
                {{--<li><a href="">Photography</a></li>--}}
                {{--<li><a href="">Film</a></li>--}}
                {{--</ul>--}}
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="trash-icon-btn">
              <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 h-100 right--media-col">
          <div class="over-auto scrollbar_custom right--media-col-wrapper">
            <div class="row m-0">
              <div class="col-lg-12 m-b-10 text-right d-flex" style="justify-content: space-between;">
                {{--<ul class="multiple-actions">--}}
                {{--<li><button class="btn btn-danger"><i class="fa fa-trash"></i></button></li>--}}
                {{--<li><button class="btn btn-info"><i class="fa fa-share"></i></button></li>--}}
                {{--<li><button class="btn btn-primary"><i class="fa fa-clone"></i></button></li>--}}
                {{--</ul>--}}
                <div class="upload-content" style="width: 100%;">
                  <div class="upload--head  mb-20 mt15">
                      <button class="btn btn-danger delete_items" >Delete</button>
                      <button class="btn btn-info">Move</button>
                      <button class="btn btn-warning">Copy</button>
                      <button type="button" class="btn btn-primary uploader_button" data-role="btnUploader"
                              bb-media-click="show_uploader">Uploader
                      </button>
                  </div>
                  <div class="uploader-container mt15  mb-20 d-none">
                    <input id="uploader" class="file-loading" data-folder-id="{!! 1 !!}" multiple name="item[]"
                           type="file" data-upload-url="{!! route('media_upload') !!}">
                  </div>
                  <div class="remover-container mb-20 mt15 d-none" >
                    <div class="remover-container-zone">
                      <div class="remover-container-content">
                        Drag & drop files you want to delete...
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row m-0 collapse show-uploder" data-targetiuploder="folder">
              <div class="col-lg-12 m-b-15"></div>
            </div>
            <div class="row m-0 {!! $settings['rightcontainer']??null !!} media_right_content">
              <div class="col-xs-12 mb-20">

                <div class="bread-crumbs d-flex" style="justify-content: space-between;">
                  <ul class="bread-crumbs-list breadcrumb" style="margin: 0">
                    <li class="bread-crumbs-list-item active" data-crumbs-id="1"
                        data-id="1" bb-media-click="get_folder_items" >
                      <a>Drive</a>
                    </li>
                  </ul>
                  <button type="button" class="btn btn-info" bb-media-click="folder_level_up"><i class="fa fa-level-up"
                                                                                                 aria-hidden="true"></i>
                  </button>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row m-0 d-flex flex-wrap folderitems" style="position: relative;" data-media="folderitem"
                   data-type="main-container">
              </div>


            </div>
          </div>

        </div>
      </div>
    </div>

  </div>

  <!-- Modal -->
  <div id="foldersetting" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Settings <span data-settingmodal="settingtitel"></span></h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#bbsettingfoler">Folder Settings</a>
            </li>
            <li><a data-toggle="tab" href="#bbuploadersetting">Uploader Settings</a>
            </li>
          </ul>
          <div class="tab-content p-15">
            <div id="bbsettingfoler" class="tab-pane active">
              <input name="folder_id" data-selectmenu="folder_id" type="hidden">
              <form data-settingmodal="setting">

                <div class="form-group">
                  <label for="Action">Action</label>
                  <select class="form-control" multiple data-selectmenu="action" name="action">
                    <option value="all_access">all_access</option>
                    <option value="no_access">no_access</option>
                    <option value="edit">edit</option>
                    <option value="delete">delete</option>
                    <option value="upload">upload</option>
                    <option value="create_folder">create_folder</option>
                    <option value="create_item">create_item</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="function">Function</label>
                  <select class="form-control" name="function" data-selectmenu="function">
                    <option value="">fucntion</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" rows="3" name="description"
                            data-selectmenu="description"></textarea>

                </div>
                <div class="form-group hide">
                  <label for="uploader">Uploader</label>
                  <select class="form-control" name="uploader_slug" data-selectmenu="Uploader-s">

                  </select>

                </div>
              </form>
            </div>
            <div id="bbuploadersetting" class="tab-pane">
              <form data-settingmodal="uploder">

              </form>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-settingmodal="save" data-dismiss="modal">Save
          </button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <div id="modal_area"></div>

  {!! Form::hidden(null,'drive',['data-type'=>'folder']) !!}
@stop
@section('css')
  {{--@push("css")--}}
  {{--{!! Html::style("/resources/assets/js/animate/css/animate.css") !!}--}}
  {!! Html::style("public/media_template/css/media-plus.css?v='.rand(111,999))") !!}
  {!! Html::style("public/media_template/css/style.css?v='.rand(111,999))") !!}
  {!! Html::style("public/admin_theme/media/css/lightbox.css") !!}
  {!! Html::style("public/js/bootstrap-select/css/bootstrap-select.min.css") !!}
  {!! Html::style("public/js/tag-it/css/jquery.tagit.css") !!}
  {{--@endpush--}}
  <style>
    .active > .file {
      border: 1px solid #000000;
      box-shadow: 0px 0 4px 3px #f39c12;
    }

    .show {
      opacity: 1 !important
    }

    .d-none {
      display: none !important;
    }

    .folder-container.over {
      border: 1px solid yellow;
    }

    .file.start {
      border: 2px dashed #00c0ef;
      max-height: 200px;
      max-width: 200px;
    }

    #coverup {
      background: white;
      width: 170px;
      height: 100px;
      position: absolute;
      top: 0;
      right: 0;
      z-index: 2;
    }

    .multiple-actions {
      list-style: none;
      display: flex;
      padding: 0;
      margin: 0;
    }

    .multiple-actions .btn {
      margin-left: 4px;
    }

    #imageload .modal-content {
      height: 100%;
    }

    #imageload .modal-body {
      height: calc(100% - 80px);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .bread-crumbs-list .disabled > a {
      color: gray !important;
    }

    .title-change {
      outline: none;
      cursor: text;
    }

    .title-change:hover {
      box-shadow: 0 0 2px white;
    }

  </style>
  {!!  Html::style('public/js/bootstrap-fileinput/css/fileinput.min.css') !!}

@stop
@section("js")
  {!! Html::script('public/js/bootstrap-fileinput/js/fileinput.min.js') !!}
  {!! Html::script("public/js/nestedSortable/jquery.mjs.nestedSortable.js") !!}
  {!! Html::script("public/admin_theme/media/js/lightbox.js") !!}
  {!! Html::script("public/js/bootstrap-select/js/bootstrap-select.min.js") !!}
  {!! Html::script("public/js/tag-it/js/tag-it.js") !!}
  {{--{!! Html::script("public/js/media_button.js") !!}--}}
  {!! Html::script("public/js/media_button_new.js?v=".rand(999,99999)) !!}
  {{--    {!! Html::script("public/js/bundle/media.js",['type' => 'module']) !!}--}}

  <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/draggable.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.ui-deps.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.edit.js"></script>
  {{--<script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.filter.js"></script>--}}
  <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.dnd5.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.glyph.js"></script>

  <script>
    $('document').ready(
        function() {
          $('body').on('click', '.file-drop-zone-title', function() {
            $(".btn.btn-file>input[type='file']").click();
          });

//          $('[role="treeitem"]').on('mouseenter', function() {
//            console.log('hello');
//            this.css('background-color', 'red')
//          })
        }
    )
  </script>
@stop
