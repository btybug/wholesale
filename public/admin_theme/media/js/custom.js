var _global_folder_id = 1;
var url = {
    getFolderCildrens: "/api/api-media/get-folder-childs",
    jsTree: "/api/api-media/jstree"
};
var globalArr = [];
var multiple = false;
var inputId = "";

shortAjax = function(url, data, success, error) {
    $.ajax({
        type: "post",
        url: url,
        cache: false,
        datatype: "json",
        data: data,
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        },
        success: function(data) {
            if (success) {
                success(data);
            }
            return data;
        },
        error: function(errorThrown) {
            if (error) {
                error(errorThrown);
            }
            return errorThrown;
        }
    });
};

function App() {
    var self = this;
    var prevFolder = [];
    var globalFolderId = 1;
    this.multipleImages = [];
    this.htmlMaker = {
        makeFolder: function(data) {
            return `<div data-id="${data.id}"  class="file ">
            <a href="#"  data-id="${
                data.id
            }" bb-media-type="folder" bb-media-click="get_folder_items" data-media="getitem">
                <span class="corner"></span>

                <div class="icon">
                    <i class="fa fa-folder"></i>
                </div>
                <div class="file-name">
                <span class="icon-file"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                <span class="file-title">${data.title}</span>
                    <!--<small>Added: ${data.updated_at}</small>-->
                </div>
            </a>
        </div>`;
        },
        makeImage: function(data) {
            return `<div data-id="${data.id}" data-relative-url="${
                data.relativeUrl
            }" class="file">
        <a  bb-media-click="select_item" >
            <span class="corner"></span>

            <div class="icon">
                <img width="180px" data-lightbox="image" src="${data.url}">
            </div>
            <div class="file-name">
            <span class=" -file"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
            <span class="file-title">${data.real_name}</span>
            </div>
            <!--<small>Added: ${data.updated_at}</small>-->
        </a>
    </div>`;
        },
        makeTreeFolder: function(data) {
            return `<li  bb-media-type="tree-folder" data-trre-id="${
                data.id
            }" data-id="${
                data.id
            }" style="display: flex; justify-content: space-between;">
<div style="display: flex;"><div><i tree-type="close" class="fa fa-folder"></i></div>
                  <div style="margin-right: 5px">
                  <span data-id="${
                      data.id
                  }" bb-media-click="get_folder_items">${data.title}</span>
                  </div></div>
                  <div>
                    <button bb-media-click="remove_tree_folder" class="btn btn-xs btn-danger text-white"><i class="fa fa-trash"></i></button>
                    <button class="btn btn-xs btn-primary text-white"><i class="fa fa-cog"></i></button>
                    <button class="btn btn-xs btn-warning text-white"><i class="fa fa-pencil"></i></button>
                  </div>
                </li>`;
        },
        makeBreadCrumbsItem(item) {
            return ` <li class="bread-crumbs-list-item disabled" data-crumbs-id="${
                item.id
            }" data-id="${item.id}" bb-media-click="get_folder_items" >
            <a>${item.slug}</a>
            </li>`;
        },
        editNameModal(id, name) {
            return `<div class="modal fade show custom_modal_edit" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change title</h4>
        </div>
        <div class="modal-body">
              <input class="form-control edit-title-input" value="${name}">
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                <button type="button" data-id=${id} class="btn btn-primary btn-save" bb-media-click="save_edited_title">Save changes</button>
        </div>
      </div>

    </div>
  </div>`;
        },
        fullInfoModal(data, countId) {
            return `<div class="adminmodal modal fade in" style="display: block" id="imageload" tabindex="-1" role="dialog" aria-labelledby="imageloadLabel">
            <div class="modal-dialog modal-lg row" role="document">
                <div class="modal-content col-md-8 p-0">
                    <div class="modal-header" style="overflow: visible;">
                        <button type="button" bb-media-click="close_full_modal" class="close" data-dismiss="modal" aria-label="Close"><i class="iconaction iconClose"></i></button>
                        <button type="button" class="btn btn-action-popup" title="Edit image" data-dismiss="modal" data-toggle="modal" data-target="#imageeditMode"><i class="iconaction iconEditImageGrey"></i></button>
                        <button type="button" class="btn btn-action-popup" title="Download"  data-slideshow="download" ><i class="iconaction iconDownloadGrey"></i></button>

                    </div>
                    <div class="modal-body text-center">
                    <div class="modal-title">

                    <img src="${
                        data.url
                    }" data-slideshow="typeext" style="width:100%">
                    <div style="display: flex; justify-content: space-between;">
                    <button href="#" type="button" role="button" ${
                        countId === 0 ? "disabled" : ""
                    } data-id="${countId -
                1}" class="popuparrow" bb-media-click="modal_load_image" ><i class="fa fa-arrow-left"></i></button>

                    <span data-slideshow="title">${data.real_name}</span>
                    <button class="popuparrow" href="#" type="button" role="button" ${
                        countId ===
                        document.querySelectorAll(".image-container").length - 1
                            ? "disabled"
                            : ""
                    } data-id="${countId +
                1}" bb-media-click="modal_load_image"  data-id=""><i class="fa fa-arrow-right"></i></button>
                    </div>
                    </div>
                    <div class="modal-footer col-md-8">


            </div>
                    </div>
                </div>
                <div class="popupDetail col-md-4 p-0">
                    <div class="row p-t-10 p-b-10">
                        <div class="col-xs-4 col-md-4">
                            <button class="btn btn-default btn-block active" type="button" data-tabaction="details">Details</button>
                        </div>
                        <div class="col-xs-4 col-md-4">
                            <button class="btn btn-default btn-block" type="button" data-tabaction="seo">SEO</button>
                        </div>
                        <div class="col-xs-4 col-md-4">
                            <button class="btn btn-default btn-block" type="button">Option 3</button>
                        </div>
                    </div>
                    <div class="row rowsection collapse in" data-tabcontent="details">
                        <div class="col-xs-12 col-md-12">
                            <h4><i class="fa fa-bars text-primary"></i> ${
                                data.real_name
                            } <div class="btn-group">
                            <button type="button" style="background-color: black;" class="btn btn-action-popup dropdown-toggle" title="Rename" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="iconaction iconRenameGrey"></i></button>
                            <div class="dropdown-menu form-inline row width-sm p-l-0 p-r-0" aria-labelledby="dLabel">
                                <div class="form-group col-sm-7 p-l-5">
                                    <input name="rename_img" id="rename_img" type="text" class="form-control" placeholder="File name will be come here" value="${
                                        data.real_name
                                    }"  data-slideshow="renameval">
                                </div>
                                <div class="form-group col-sm-5 p-r-5">
                                    <button class="btn btn-success btn-block" data-slideshow="save">Save</button>
                                </div>
                            </div>
                        </div> </h4>
                            <div class="table-responsive">
                                <table class="table tableborder0">
                                    <tr>
                                        <th width="30%">Type</th>
                                        <td><img src="" data-slideshow="typeext"> <span data-slideshow="ext">${
                                            data.extension
                                        }</span></td>
                                    </tr>
                                    <tr>
                                        <th>Size</th>
                                        <td><span data-slideshow="size">${
                                            data.size
                                        } </span></td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td><i class="fa fa-folder"></i> <span data-slideshow="location">${
                                            data.folder.title
                                        }</span></td>
                                    </tr>
                                    <tr>
                                        <th>Uploaded By</th>
                                        <td><span data-slideshow="uploaded_by">I don't have this value</span></td>
                                    </tr>
                                    <tr>
                                        <th>Created</th>
                                        <td><span data-slideshow="created_at">${
                                            data.created_at
                                        }</span></td>
                                    </tr>
                                    <tr>
                                        <th>Opened</th>
                                        <td><span data-slideshow="updated_at">${
                                            data.updated_at
                                        }</span></td>
                                    </tr>
                                    <tr>
                                        <th>Version</th>
                                        <td>
                                            <div class=" col-xs-3 p-l-0">
                                                <select class="form-control"  data-slideshow="version"></select>
                                            </div>
                                            <button type="button" class="btn btn-default p-l-5 p-r-5" data-action="makeasDefault">Make as Default</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row rowsection collapse"  data-tabcontent="seo">
                        <div class="loadingimg lodingSeo hide" data-loadin="seo"></div>
                        <div class="col-xs-12 col-md-12">
                            <h4><i class="fa fa-bars text-primary"></i> Seo Detail</h4>
                            <div class="table-responsive">
                                <table class="table tableborder0">

                                    <tr>
                                        <th width="23%">Alt Tags</th>
                                        <td>
                                            <input type="text" data-slideshow="alt_tags" class="form-control hide" value="" >
                                            <div class="altTagsdata"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width="23%">Keywords</th>
                                        <td>
                                            <input type="text" data-slideshow="keywords" class="form-control" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width="23%">Caption</th>
                                        <td>
                                            <input type="text" data-slideshow="caption" class="form-control" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="23%">Description</th>
                                        <td><textarea name="description" data-slideshow="description" class="form-control"></textarea>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="23%">Alt Text</th>
                                        <td>
                                            <input type="text" data-slideshow="alt_text" class="form-control" >
                                        </td>
                                    </tr>


                                    <tr>
                                        <th></th>
                                        <td>

                                            <button type="button" class="btn btn-default p-l-5 p-r-5" data-action="saveSeo">Save Detail</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row rowsection hide" data-slideshow="getlink">
                        <div class="col-xs-12 col-md-12">
                            <h4><i class="glyphicon glyphicon-link text-primary"></i> GET lINKS</h4>
                            <div class="btn-group btn-group-justified btn-tab p-b-15" role="group" aria-label="">
                                <div class="btn-group" role="group" data-gl='core'> <a href="#slideOrginalLink" class="btn btn-default active" data-toggle="tab">Orginal</a> </div>
                                <div class="btn-group" role="group" data-gl='sm'> <a href="#slidesmallThumb" class="btn btn-default" data-toggle="tab">Small thumb</a> </div>
                                <div class="btn-group" role="group" data-gl='md'> <a href="#slideMedThumb" class="btn btn-default" data-toggle="tab">Med thumb</a> </div>
                                <div class="btn-group" role="group" data-gl='lg'> <a href="#slideLargeThumb" class="btn btn-default" data-toggle="tab">Large thumb</a> </div>
                            </div>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="slideOrginalLink">
                                    <div class="form-horizontal">
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slidedirectlinkcore" class="col-sm-3 control-label text-left">Direct Link</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slidedirectlinkcore" data-getlink="directlinkcore" value="Orginal/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slidedirectlinkcore"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slidedownloadlink" class="col-sm-3 control-label text-left">Download Link</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slidedownloadlink" data-getlink="downloadcore" value="Orginal/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slidedownloadlink"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slideembedHTML" class="col-sm-3 control-label text-left">Embed HTML</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slideembedHTML" data-getlink="linkcore" value="Orginal/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slideembedHTML"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slideembedForum" class="col-sm-3 control-label text-left">Embed Forum</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slideembedForum" data-getlink="Forumcore" value="Orginal/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slideembedForum"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="slidesmallThumb">
                                    <div class="form-horizontal">
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slideDirectlinksm" class="col-sm-3 control-label text-left">Direct Link</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slideDirectlinksm" data-getlink="directlinksm" value="smallthumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slideDirectlinksm"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slidedownloadlinksm" class="col-sm-3 control-label text-left">Download Link</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slidedownloadlinksm" data-getlink="downloadsm" value="smallthumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slidedownloadlinksm"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slideembedHTMLsm" class="col-sm-3 control-label text-left">Embed HTML</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slideembedHTMLsm" data-getlink="linksm" value="smallthumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slideembedHTMLsm"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slideembedForumsm" class="col-sm-3 control-label text-left">Embed Forum</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slideembedForumsm" data-getlink="Forumsm" value="smallthumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slideembedForumsm"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="slideMedThumb">
                                    <div class="form-horizontal">
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slidedirectlinkmt" class="col-sm-3 control-label text-left">Direct Link</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slidedirectlinkmt" data-getlink="directlinkmd" value="MedThumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slidedirectlinkmt"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slidedownloadlinkmt" class="col-sm-3 control-label text-left">Download Link</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slidedownloadlinkmt" data-getlink="downloadmd" value="MedThumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slidedownloadlinkmt"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slideembedHTMLmt" class="col-sm-3 control-label text-left">Embed HTML</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slideembedHTMLmt" data-getlink="linkmd" value="MedThumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slideembedHTMLmt"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slideembedForummt" class="col-sm-3 control-label text-left">Embed Forum</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slideembedForummt" data-getlink="Forummd" value="MedThumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red"  data-clipboard-target="#slideembedForummt"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="slideLargeThumb">
                                    <div class="form-horizontal">
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slidedirectlinklg" class="col-sm-3 control-label text-left">Direct Link</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="directlinklg" data-getlink="directlinklg"  value="slideLargeThumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red"  data-clipboard-target="#directlinklg"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slidedownloadlinklg" class="col-sm-3 control-label text-left">Download Link</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slidedownloadlinklg" data-getlink="downloadlg" value="LargeThumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slidedownloadlinklg"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slideembedHTMLlg" class="col-sm-3 control-label text-left">Embed HTML</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slideembedHTMLlg" data-getlink="linklg" value="LargeThumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red" data-clipboard-target="#slideembedHTMLlg"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group m-l-0 m-r-0">
                                            <label for="slideembedForumlg" class="col-sm-3 control-label text-left">Embed Forum</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="text" class="form-control" id="slideembedForumlg" data-getlink="Forumlg" value="LargeThumb/view/photo/sgpxlqrjttlt0z1d/Child.jpg" readonly>
                                                <div class="input-group-addon addon-red"  data-clipboard-target="#slideembedForumlg"><i class="iconCopys"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        },
        makePreviewImgThumb(item, multiple) {
            return `<div class="img-thumb-container"  style="margin: 10px;"><div class="inner"><img src="${item}" width=200 > <span data-src="${item}" class="remove-thumb-img" data-is-multiple="${multiple}"><i  class="fa fa-trash"></i> </span></div></div>`;
        },
        makeHiddenInputForMultiple(item, name) {
            return `<input type="hidden" class="multipale-hidden-inputs" name="${name}" value="${item}"></input>`;
        }
    };
    this.helpers = {
        makeBreadCrumbs(id) {
            let check = false;
            let breadCrumbsListItems = document.querySelectorAll(
                ".bread-crumbs-list-item"
            );
            let singleItem = document.querySelector(`[data-crumbs-id="${id}"]`);
            breadCrumbsListItems.forEach((item, index) => {
                if (check) {
                    item.remove();
                    return;
                }
                if (item == singleItem) {
                    item.classList.add("disabled");
                    item.classList.remove("active");
                    check = true;
                } else {
                    item.classList.add("active");
                    item.classList.remove("disabled");
                }
            });
        },
        showUploaderContainer() {
            document
                .querySelector(".uploader-container")
                .classList.toggle("d-none");
        },
        makeDnD() {
            document
                .querySelectorAll(
                    `[data-type="main-container"] [draggable="true"]`
                )
                .forEach(elm => {
                    elm.addEventListener("dragstart", function(e) {
                        let crt = this.cloneNode(true);
                        crt.className += " start";
                        crt.style.position = "absolute";
                        crt.style.top = "-10000px";
                        crt.style.right = "-10000px";
                        document.body.appendChild(crt);
                        let id = this.getAttribute("data-id");
                        e.dataTransfer.setDragImage(crt, 0, 0);
                        // e.dataTransfer.effectAllowed = "copy"; // only dropEffect='copy' will be dropable
                        e.dataTransfer.setData("node_id", id); // required otherwise doesn't work
                        // setTimeout(() => (this.className = "invisible"), 0);
                    });
                });

            document.querySelectorAll(".folder-container").forEach(folder => {
                folder.addEventListener("dragover", function(e) {
                    if (e.preventDefault) e.preventDefault(); // allows us to drop
                    e.dataTransfer.dropEffect = "copy";
                    this.classList.add("over");
                    return false;
                });
                folder.addEventListener("dragleave", function(e) {
                    if (e.preventDefault) e.preventDefault(); // allows us to drop
                    this.classList.remove("over");
                    return false;
                });
                folder.addEventListener("drop", function(e) {
                    this.classList.remove("over");
                    let nodeId = e.dataTransfer.getData("node_id");
                    let parrentId = e.target
                        .closest(".file")
                        .getAttribute("data-id");
                    self.requests.transferImage(
                        {
                            item_id: Number(nodeId),
                            folder_id: Number(parrentId),
                            access_token: "string"
                        },
                        false
                    );
                });
            });
        },
        hideAllActiveImages() {
            document.querySelectorAll(".image-container").forEach(node => {
                node.classList.remove("active");
            });
        },
        makeMultiplaImagesAndInputs(arr) {
            let placeholder = document.querySelector(
                `.multiple-image-box-${inputId}`
            );
            let hiddenInput = document.querySelector(`.${inputId}`);
            let hiddenInputName = hiddenInput.getAttribute("data-name");
            let parent = hiddenInput.parentNode;
            // placeholder.innerHTML = "";
            arr.forEach(img => {
                placeholder.innerHTML += self.htmlMaker.makePreviewImgThumb(
                    img,
                    multiple
                );
                parent.innerHTML += self.htmlMaker.makeHiddenInputForMultiple(
                    img,
                    hiddenInputName
                );
            });
        }
    };
    this.requests = {
        drawingItems(
            obj = {
                folder_id: globalFolderId,
                files: true,
                access_token: "string"
            },
            tree = true,
            cb
        ) {
            shortAjax("/api/api-media/get-folder-childs", obj, res => {
                if (!res.error) {
                    let mainContainer = document.querySelector(
                        `[data-type="main-container"]`
                    );
                    // let breadCrumbsList = document.querySelector(
                    //     ".bread-crumbs-list"
                    // );
                    // breadCrumbsList.innerHTML += self.htmlMaker.makeBreadCrumbsItem(
                    //     res.settings
                    // );
                    // treeFolderContainer.innerHTML = "";
                    mainContainer.innerHTML = "";
                    let treeFolderContainer = document.querySelector(
                        ".folder-list"
                    );

                    res.data.items.forEach((image, index) => {
                        let html = `<div class="col-md-3 col-sm-6 col-xs-12"><div data-image="${index}" class="file-box image-container">${self.htmlMaker.makeImage(
                            image
                        )}</div></div>`;
                        mainContainer.innerHTML += html;
                    });
                    res.data.childs.forEach((folder, index) => {
                        let html = `<div class="col-md-3 col-sm-6 col-xs-12"><div class="file-box folder-container">${self.htmlMaker.makeFolder(
                            folder
                        )}</div></div>`;
                        mainContainer.innerHTML += html;
                        // if (tree) {
                        //     treeFolderContainer.innerHTML += self.htmlMaker.makeTreeFolder(
                        //         folder
                        //     );
                        // } else {
                        //     cb(self.htmlMaker.makeTreeFolder(folder));
                        // }
                    });

                    globalFolderId = res.settings.id;

                    // self.helpers.makeBreadCrumbs(res.settings.id);
                    // self.helpers.makeDnD();
                    cb ? cb() : null;
                }
            });
        },
        removeTreeFolder(obj = {}, cb) {
            shortAjax("/api/api-media/get-remove-folder", obj, res => {
                if (!res.error) {
                    cb();
                    self.requests.drawingItems();
                }
            });
        },
        editImageName(obj = {}, cb) {
            shortAjax("/api/api-media/rename-item", obj, res => {
                if (!res.error) {
                    cb(res);
                }
            });
        },
        transferImage(obj = {}, cb) {
            shortAjax("/api/api-media/transfer-item", obj, res => {
                if (!res.error) {
                    self.requests.drawingItems();
                }
            });
        },
        addNewFolder(obj = {}, cb) {
            shortAjax("/api/api-media/get-create-folder-child", obj, res => {
                if (!res.error) {
                    self.requests.drawingItems();
                }
            });
        },
        getImageDetails(obj = {}, cb) {
            shortAjax("/api/api-media/get-item-details", obj, function(res) {
                if (!res.error) {
                    cb(res.data);
                }
            });
        }
    };

    this.getInitailData = function() {
        this.requests.drawingItems();
    };
    this.init = function() {
        $("#uploader")
            .fileinput({
                uploadAsync: false,
                maxFileCount: 5,
                browseOnZoneClick: true,
                showUpload: false,
                showUploadedThumbs: false,
                uploadExtraData: function() {
                    return {
                        _token: $("meta[name='csrf-token']").attr("content"),
                        folder_id: globalFolderId
                    };
                }
            })
            .on("filebatchselected", function(event, files) {
                $("#uploader").fileinput("upload");
            })
            .on("filebatchuploadsuccess", function(event, files) {
                self.requests.drawingItems();
                self.helpers.showUploaderContainer();
                $("#uploader").fileinput("clear");
            });
        this.getInitailData();
    };
    this.events = {
        remove_tree_folder(elm, e) {
            e.stopPropagation();
            e.preventDefault();
            let id = elm.closest("li").attr("data-id");
            self.requests.removeTreeFolder(
                {
                    folder_id: Number(id),
                    trash: 0,
                    access_token: "string"
                },
                () => elm.closest("li").remove()
            );
        },
        remove_folder(elm, e) {
            e.stopPropagation();
            e.preventDefault();
            let id = elm.closest(".file").attr("data-id");
            self.requests.removeTreeFolder(
                {
                    folder_id: Number(id),
                    trash: 0,
                    access_token: "string"
                },
                () => elm.closest("li").remove()
            );
        },
        get_folder_items(elm, e) {
            let id = elm[0].getAttribute("data-id");
            prevFolder.push(globalFolderId);
            self.requests.drawingItems(
                {
                    folder_id: Number(id),
                    files: true,
                    access_token: "string"
                },
                true
            );
        },
        add_new_folder(elm, e) {
            let name = document.querySelector(".new-folder-input").value;
            self.requests.addNewFolder(
                {
                    folder_id: globalFolderId,
                    folder_name: name,
                    access_token: "string"
                },
                true
            );
        },
        open_full_modal(elm, e) {
            e.stopPropagation();
            e.preventDefault();
            let id = e.target.closest(".file").getAttribute("data-id");
            let countId = e.target
                .closest(".file-box")
                .getAttribute("data-image");
            self.requests.getImageDetails({ item_id: id }, res => {
                document.body.innerHTML += self.htmlMaker.fullInfoModal(
                    res,
                    Number(countId)
                );
            });
        },
        select_item(elm, e) {
            let id = e.target.closest(".file").getAttribute("data-id");
            if (e.type === "dblclick") {
                e.target.closest(".file-box").classList.remove("active");
                let countId = e.target
                    .closest(".file-box")
                    .getAttribute("data-image");
                self.requests.getImageDetails({ item_id: id }, res => {
                    document.body.innerHTML += self.htmlMaker.fullInfoModal(
                        res,
                        Number(countId)
                    );
                });
            } else if (e.type === "click") {
                if (multiple) {
                    e.target.closest(".file-box").classList.toggle("active");
                    let relativeInput = document.querySelector(
                        ".file-realtive-url"
                    );
                    relativeInput.value = "";
                    self.multipleImages = [];
                    document
                        .querySelectorAll(".image-container.active")
                        .forEach(node => {
                            let url = node
                                .querySelector("[data-relative-url]")
                                .getAttribute("data-relative-url");
                            relativeInput.value += url + ",";
                            self.multipleImages.push(url);
                        });
                } else {
                    self.helpers.hideAllActiveImages();
                    e.target.closest(".file-box").classList.toggle("active");
                    document.querySelector(
                        ".file-realtive-url"
                    ).value = e.target
                        .closest(".file")
                        .getAttribute("data-relative-url");
                }
            }
        },
        open_images(elm, e) {
            console.log(multiple);
            if (multiple) {
                self.helpers.makeMultiplaImagesAndInputs(self.multipleImages);
            } else {
                let urlValue = document.querySelector(".file-realtive-url")
                    .value;
                console.log(inputId);
                document.querySelector(`.${inputId}`).value = urlValue;
                document.querySelector(`.${inputId}_media_single_img`).src = urlValue;
                // document.querySelector(`.${inputId}`).value = urlValue;
            }
            document.querySelector(".file-realtive-url").value = "";
            self.helpers.hideAllActiveImages();
        },
        modal_load_image(elm, e) {
            if (!e.target.closest("button").disabled) {
                let id = e.target.closest("button").getAttribute("data-id");
                let imageId = document
                    .querySelector(`[data-image="${id}"] [data-id]`)
                    .getAttribute("data-id");
                self.requests.getImageDetails({ item_id: imageId }, res => {
                    e.target.closest(".modal").remove();
                    document.body.innerHTML += self.htmlMaker.fullInfoModal(
                        res,
                        Number(id)
                    );
                });
            }
        },
        remove_image(elm, e) {
            e.preventDefault();
            e.stopPropagation();
            let id = e.target.closest(".file").getAttribute("data-id");
            self.requests.transferImage(
                {
                    item_id: Number(id),
                    folder_id: 2,
                    access_token: "string"
                },
                false
            );
        },
        edit_image(elm, e) {
            e.preventDefault();
            e.stopPropagation();
            let id = e.target.closest(".file").getAttribute("data-id");
            let name = e.target
                .closest(".file")
                .querySelector(".file-name")
                .textContent.trim();
            document.body.innerHTML += self.htmlMaker.editNameModal(id, name);
        },
        save_edited_title(elm, e) {
            let itemId = e.target.getAttribute("data-id");
            let name = document.querySelector(".edit-title-input").value;
            self.requests.editImageName(
                {
                    item_id: Number(itemId),
                    item_name: name,
                    access_token: "string"
                },
                false
            );
        },
        show_uploader(elm, e) {
            self.helpers.showUploaderContainer();
        },
        close_full_modal(elm, e) {
            e.target.closest(".modal").remove();
        },
        open_uploader(elm, e) {
            document
                .querySelector(".uploader-container")
                .classList.remove("d-none");

            document
                .querySelector(".media-modal-content-upload")
                .classList.add("d-block");
        },
        folder_level_up(elm, e) {
            if (prevFolder.length) {
                let id =
                    prevFolder.length === 1
                        ? 1
                        : prevFolder[prevFolder.length - 1];
                self.requests.drawingItems(
                    {
                        folder_id: Number(id),
                        files: true,
                        access_token: "string"
                    },
                    true,
                    res => {
                        prevFolder.pop();
                    }
                );
            }
        }
    };
}
const app = new App();
app.init();

$("body").on("click dblclick", `[bb-media-click]`, function(e) {
    let attr = $(this).attr("bb-media-click");
    app.events[attr]($(this), e);
});

$("body").on("click", `[data-tabaction]`, function(e) {
    let id = $(this).attr("data-tabaction");
    $("body")
        .find(`[data-tabcontent]`)
        .removeClass("in");
    $("body")
        .find(`[data-tabcontent="${id}"]`)
        .addClass("in");
});

$("body").on("click", ".bestbetter-modal-open button", function() {
    app.requests.drawingItems({
        folder_id: 1,
        files: true,
        access_token: "string"
    });
    let value = $(this).attr("data-multiple");
    inputId = $(this).attr("id");
    multiple = JSON.parse(value);
    $(".img").removeClass("active");
});

$("body").on("click", ".remove-thumb-img", function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    let realInput = $(`.${id}`);

    let src = $(this).attr("data-src");
    $(".multipale-hidden-inputs").each(function() {
        if ($(this).val() === src) {
            $(this).remove();
        }
    });
    let cn = realInput.attr("data-count") - 1;
    realInput.val(cn + " selected");
    realInput.attr("data-count", cn);

    $(this)
        .closest(".img-thumb-container")
        .remove();
});

// $("#jstree_html")
//     .on("changed.jstree", function(e, data) {
//         console.log(data);
//         var i,
//             j,
//             r = [];
//         for (i = 0, j = data.selected.length; i < j; i++) {
//             r = data.instance.get_node(data.selected[i]).id;
//         }
//         $(`[name="folder_id"]`).val(r);
//         var jsondata = { folder_id: r, files: 1, access_token: "string" };
//         _global_folder_id = r;
//         console.log(url.getFolderCildrens);
//         postSendAjax(url.getFolderCildrens, jsondata, getfolder);
//     })
//     .jstree({
//         core: {
//             data: {
//                 type: "POST",
//                 url: url.jsTree,
//                 dataType: "json", // needed only if you do not supply JSON headers
//                 data: { folder_id: 1 },
//                 headers: {
//                     "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
//                 },
//                 success: function(data) {
//                     $(".media-modal-main-content").empty();
//                     listFolders(data.children);
//                     listFiles(data.items);
//                 }
//             }
//         }
//     });
// var getfolder = function(data) {
//     lists(data.data);
// };

// function listFolders(data) {
//     $.each(data, function(k, v) {
//         var folder = $("#media-modal-folder").html();
//         folder = folder.replace("{name}", v.name);
//         $(".media-modal-main-content").append(folder);
//     });
// }

// function listFiles(data) {
//     function makeImage(data) {
//         return `<div draggable="true" data-id="${data.id}" class="file">
//     <a  bb-media-click="select_item" >
//         <span class="corner"></span>

//         <div class="icon">
//             <img width="180px" data-lightbox="image" src="${data.url}">
//             <i class="fa fa-file"></i>
//         </div>
//         <div class="file-name">
//             ${data.real_name}
//             <br>

//         </div>
//         <small>Added: ${data.updated_at}</small>
//         <div class="file-actions">
//           <button bb-media-click="remove_image" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
//           <button class="btn btn-sm btn-primary"><i class="fa fa-cog"></i></button>
//           <button bb-media-click="edit_image" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
//       </div>
//     </a>
// </div>`;
//     }
//     $.each(data, function(k, v) {
//         // var folder = $("#media-modal-files").html();
//         // folder = folder.replace("{name}", v.real_name);
//         // folder = folder.replace(/{data-item-id}/g, v.id);
//         // folder = folder.replace("{relative_path}", v.relativeUrl);
//         // folder = folder.replace(/{url}/g, v.url);

//         $(".media-modal-main-content").append(makeImage(v));
//     });
// }

// function lists(data) {
//     $(".media-modal-main-content").empty();
//     listFolders(data.childs);
//     listFiles(data.items);
// }

// $(".upload-btn").click(function() {
//     $(".media-modal-content-upload").css("display", "block");
//     $(".media-modal-main-content").css("display", "none");
// });

// $("body").on("click", ".item-for-upload", function(e) {
//     let tempStr = "";

//     globalArr = [];
//     e.preventDefault();
//     if (multiple) {
//         $(this)
//             .closest(".img")
//             .toggleClass("active");
//     } else {
//         $(".img").removeClass("active");
//         $(this)
//             .closest(".img")
//             .addClass("active");
//     }

//     $(".img.active").each(function() {
//         let value = $(this)
//             .find(".item-for-upload")
//             .attr("data-relative-url");
//         tempStr += value + ",";
//         globalArr.push(value);
//     });
//     $("body")
//         .find(".file-realtive-url")
//         .val(tempStr);
// });
// const makePreviewImgThumb = (item, multiple) => {
//     return `<div class="img-thumb-container"  style="margin: 10px;"><div class="inner"><img src="${item}" width=200 > <span data-src="${item}" class="remove-thumb-img" data-is-multiple="${multiple}"><i  class="fa fa-trash"></i> </span></div></div>`;
// };
// $("body").on("click", ".open-btn", function(e) {
//     e.preventDefault();

//     if (multiple) {
//         let realInput = $(`.${id}`);
//         let name = realInput.attr("data-name");
//         let parrent = realInput.parent();
//         globalArr.forEach(item => {
//             parrent.append(
//                 `<input type="hidden" class="multipale-hidden-inputs" name="${name}" value="${item}">`
//             );
//             $(".multiple-image-box-" + `${id}`).append(
//                 makePreviewImgThumb(item, multiple)
//             );
//             var cn = +realInput.attr("data-count") + 1;
//             realInput.val(cn + " selected");
//             realInput.attr("data-count", cn);
//         });
//     } else {
//         $(`.${id}`).val(globalArr[0]);
//     }

//     $("#myModal").modal("hide");
// });

// // $("body").on("click", ".remove-item-for-media", function() {
// //     let id = $(this).attr("data-item-id");
// //     postSendAjax(
// //         "/api/api-media/transfer-item",
// //         { folder_id: 2, item_id: id, slug: "trush" },
// //         function(res) {}
// //     );
// // });
