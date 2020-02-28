@extends('layouts.admin')
@section('content')
    <input type="hidden" id="core-folder" value="{!! $folder->id !!}">
    <!-- Modal -->
<div class="modal fade" id="moveMediaModal" tabindex="-1" role="dialog" aria-labelledby="moveMediaModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="moveMediaModalTitle">Move</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body tree_container">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary move-disabled-js">Move</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addFolderModal" tabindex="-1" role="dialog" aria-labelledby="addFolderModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFolderModalTitle">Add Folder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body tree_container">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="folderNameValue">Folder Name</span>
        </div>
        <input type="text" class="form-control folderNameValue" aria-label="Default" aria-describedby="folderNameValue">
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary add-folder-js">Add</button>
      </div>
    </div>
  </div>
</div>
  <div id="page-wrapper" class="gray-bg">

    <div class="wrapper wrapper-content h-100">
      <div class="row dis-flex media-page--wrapper">
        <div class="col-xl-2 col-md-3 col-sm-4 col-xs-12 h-100 left--media-col">
          <div class="ibox scrollbar_custom float-e-margins over-auto">
            <div class="ibox-content {!! $settings['leftcontainer']??null !!}">
              <div class="file-manager">

{{--                <h5><a class="pull-right {!! $settings['addbutton']??null !!}" data-toggle="collapse"--}}
{{--                       role="button" href="#createFolder">--}}
{{--                    <i class="fa fa-plus" aria-hidden="true"></i></a>--}}
{{--                  <p>ADD FOLDERS</p>--}}
{{--                  <span data-media="selected"></span></h5>--}}
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
                </script>
                <!-- <div bb-media-click="get_folder_items" data-core="true" class="dd-item" draggable="true" data-id="{!! $folder->id !!}" style="background-color: #3c8dbc; width: 100%; text-align: center; color: white; margin-top: 50px; margin-bottom: -49px; cursor: pointer">{!! strtoupper($folder->name) !!}</div> -->
                <div class="folder-list media__folder-list" id="folder-list2" data-media="folder" data-menudata="">
                  <div class="media-tree_leaf-wrapper" style="display: flex; justify-content: space-between;">
                    <ol class="first-branch">
                      <li class="tree_leaf leaf filter" data-id="1" data-name="Drive" id="item_1" bb-media-type="folder">
                        <div class="tree_leaf_content active" bb-media-click="get_folder_items" draggable="true">
                            <span class="icon-folder-opening"></span>
                            <span class="icon-folder-name"><i class="fa fa-folder"></i></span>
                            Drive2
                        </div>
                      
                        <ol class="tree_branch" id="fff">

                        </ol>
                      </li>
                    </ol>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>

            </div>
          </div>

        </div>
        <div class="col-xl-10 col-md-9 col-sm-8 col-xs-12 h-100 right--media-col">
          <div class=" right--media-col-wrapper">
            <div class="row m-0">
              <div class="col-lg-12 m-b-10 text-right d-flex p-0" style="justify-content: space-between;">
                <div class="upload-content" style="width: 100%;">
                  <div class="upload--head d-flex justify-content-between  mb-20 mt15">
                  <button  type="button" class="btn btn-info ml-3" data-toggle="modal" data-target="#addFolderModal">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                      ADD FOLDER</button>

                      <!-- <div class="pl-3"><a class="{!! $settings['addbutton']??null !!} btn btn-info" data-toggle="collapse"
                             role="button" href="#createFolder">
                              <i class="fa fa-plus" aria-hidden="true"></i><span class="pl-1">ADD FOLDERS</span></a>
                          <span data-media="selected"></span></div> -->
                      <div class="pl-3">
                          <button class="btn btn-danger delete_items">
                              <i class="far fa-trash-alt"></i>
                              Delete
                          </button>
                          <button  type="button" class="btn btn-info" data-toggle="modal" data-target="#moveMediaModal">
                              <i class="fas fa-arrows-alt"></i>
                              Move
                          </button>
                          <button class="btn btn-warning copy-button" bb-media-click="copy_images">
                              <i class="far fa-copy"></i>
                              Copy</button>
                          <button type="button" class="btn btn-primary uploader_button" data-role="btnUploader"
                                  bb-media-click="show_uploader">
                              <i class="fas fa-cloud-upload-alt"></i>
                              Uploader
                          </button>
                      </div>
                  </div>
                  <div class="uploader-container mt15  mb-20 d-none">
                    <input id="uploader" class="file-loading" data-folder-id="{!! 1 !!}" multiple name="item[]"
                           type="file" data-upload-url="{!! route('media_upload') !!}">
                  </div>
                  <div class="remover-container mb-20 mt15 d-none" >
                    <div class="close remover-remove">×</div>
                    <div class="remover-container-zone">
                      <div class="remover-container-content">
                        <p class="remove_title" style="margin: 85px auto;">Drag & drop files you want to delete...</p>
                        <div class="row">
                          <div class="col-10">
                            <div class="row images_container">

                            </div>
                          </div>
                          <div class="col-2 remove-button_container">

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row m-0 collapse show-uploder" data-targetiuploder="folder">
              <div class="col-lg-12 m-b-15"></div>
            </div>
            <div class="m-0 {!! $settings['rightcontainer']??null !!} over-auto scrollbar_custom media_right_content">
              <div class="col-sm-12 mb-20">

                <div class="bread-crumbs d-flex " style="justify-content: space-between;">
                  <nav aria-label="breadcrumb">
                    <ol class="bread-crumbs-list breadcrumb">
                      <li class="breadcrumb-item bread-crumbs-list-item active" data-crumbs-id="1"
                          data-id="1" bb-media-click="get_folder_items"><a href="javascript:void(0);">Drive</a></li>
                    </ol>
                  </nav>
                  {{--<ul class="bread-crumbs-list breadcrumb" style="margin: 0">--}}
                    {{--<li class="bread-crumbs-list-item active" data-crumbs-id="1"--}}
                        {{--data-id="1" bb-media-click="get_folder_items" >--}}
                      {{--<a>Drive</a>--}}
                    {{--</li>--}}
                  {{--</ul>--}}

{{--                  <button type="button" class="btn btn-info" bb-media-click="folder_level_up"><i class="fas fa-level-up-alt"></i>--}}
{{--                  </button>--}}
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control search_item_js" placeholder="search">
                        <span class="h5 ml-2 text-white mb-0"><i class="fas fa-search"></i></span>
                    </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="m-0 d-flex flex-wrap folderitems w-100" style="position: relative;" data-media="folderitem"
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
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Settings <span data-settingmodal="settingtitel"></span></h4>
      </div>
      <!-- Modal content-->
      <div class="modal-content">
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











    .media-tree_leaf-wrapper .tree_leaf {
  /*border: 2px solid silver;*/
  /*padding: 10px;*/
  list-style: none;
  /*background: gray;*/
}

.media-tree_leaf-wrapper .tree_branch {
  /* border: 1px solid silver;
  padding: 10px;
  list-style: none;
  background: silver; */
}

.media-tree_leaf-wrapper .tree_leaf .tree_leaf_with_branch {
  /*border: 1px solid silver;*/
  /*padding: 10px;*/
  list-style: none;
  /*background: silver;*/
}

/* .root {
  width: 500px;
} */


/*.items_container {*/
/*  width: 50%;*/
/*  background: gray;*/
/*  display: flex;*/
/*  flex-wrap: wrap;*/
/*}*/

/*.item {*/
/*  border: 1px solid silver;*/
/*  padding: 10px;*/
/*  list-style: none;*/
/*  background: silver;*/
/*  width: 50px;*/
/*  height: 50px;*/
/*  margin: 10px;*/
/*}*/

.media-tree_leaf-wrapper .background-class {
  background-color: rgba(0,0,0,.01);
}

.media-tree_leaf-wrapper .tree_leaf_content.active{
  background-color: #e8f0fe;
  color: #1967d2;
  font-weight: 600;
}
.media-tree_leaf-wrapper .icon-folder-opening{
  width: 25px;
  display: block;
  padding-left: 10px;
  flex: none;
}
.media-tree_leaf-wrapper .folder-item--title{
  text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
.media-tree_leaf-wrapper .icon-folder-name{
  width: 40px;
}
.media-tree_leaf-wrapper .tree_leaf_content.active .icon-folder-opening{
  color: #5f6368;
}

.media-tree_leaf-wrapper .tree_leaf_content{
  display: flex;
  align-items: center;
  padding: 10px 0;
  cursor: pointer;
  color: #5f6368;
  border-radius: 0 20px 20px 0;
  border: 1px solid transparent;
}

.media-tree_leaf-wrapper .tree_leaf_content.over{
  border: 1px solid #33b5e5;
}

.media-tree_leaf-wrapper .tree_leaf_content:not(.active):hover{
  background-color: rgba(0,0,0,.04);
}
.media-tree_leaf-wrapper .tree_branch{
  /*padding: 0;*/
  padding-left: 22px;
}
.media-tree_leaf-wrapper .tree_leaf_without_branch .tree_leaf_content{
  /*padding-left: 40px;*/
}

.closed_branch {
  display: none;
  /* visibility: hidden;
  height: 5px; */
}
.media-tree_leaf-wrapper .first-branch{
  padding: 0;
    width: 100%;
}
.media-page--wrapper .ibox-content {
  padding-left: 0;
}

.media-page--wrapper .folder-item--title {
  user-select: none;
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
  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.ui-deps.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.edit.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.filter.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.dnd5.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.30.2/dist/modules/jquery.fancytree.glyph.js"></script> -->
  <!-- {!! Html::script("public/plugins/tree/jquery.nestable.min.js") !!} -->
  <!-- {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>--}} -->
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
@stop
