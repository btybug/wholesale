//********shortAjax********start
const shortAjax = function (URL, obj = {}, cb) {
  fetch(URL, {
    method: "post",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
      "X-CSRF-Token": $('input[name="_token"]').val()
    },
    credentials: "same-origin",
    body: JSON.stringify(obj)
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (json) {
      return cb(json);
    })
    .catch(function (error) {
      console.log(error);
    });
};
//********shortAjax********end

//********normAjax********start
const normAjax = function (URL, obj = {}, cb) {
  $.ajax({
    type: "post",
    url: URL,
    cache: false,
    datatype: "json",
    data: obj,
    headers: {
      "X-CSRF-TOKEN": $('input[name="_token"]').val()
    },
    success: function (data) {
      if (success) {
        cb(data);
      }
      return data;
    },
    error: function (errorThrown) {
      if (error) {
        error(errorThrown);
      }
      return errorThrown;
    }
  });
};
//********normAjax********end

/*
 Helpers
 **TYPES**
 data-type="main-container" || Main container,  for applying all content
 **EVENTS**
 bb-media-click="fodler" || Get current folder item if bb-media-type="folder"
 */

//********App********start
//App includes all methods for media page
const App = function() {
  let globalFolderId = document.getElementById('core-folder').value;
  this.selectedImage = [];

  //********App -> htmlMaker********start
  //htmlMaker includes all methods to create html markup

  this.htmlMaker = {
    tree: null,
    dragElementOfTree: null,
    currentId: null,
    currentSelectedFolder: null,
    currentDragedId: null,
    currentParentOfDrag: null,
    currentDragTreeElementId: null,

    //********App -> htmlMaker -> makeFolder********start
    makeFolder: (data) => {
      return (`<div draggable="true"  data-id="${data.id}"  class="file" style="position: relative">
            <a href="#"  data-id="${
          data.id
          }" bb-media-type="folder" bb-media-click="get_folder_items" data-media="getitem">
                <span class="corner"></span>

                <div class="icon">
                    <i class="fa fa-folder"></i>
                </div>
                <div class="file-name">
                <span class="icon-file"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                <span class="file-title click-no title-change"  contenteditable="true">${data.title}</span>
                    <!--<small>Added: ${data.updated_at}</small>-->
                </div>
                <span class="dropdown file-actions d-none" style="position: absolute; right: 5px; top: 5px; max-width: 100px;">
                  <button class="btn btn-sm btn-default dropdown-toggle click-no" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 0 10px">
                    <i class="fa fa-ellipsis-h click-no" aria-hidden="true"></i>
                  </button>
                  <span  class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1" style="min-width: 100%;box-shadow: 0 0 4px #777;padding: 6px;margin-top: auto;">
                    <button class="btn btn-sm btn-danger dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px" bb-media-click="remove_folder">
                      <i class="fa fa-trash" style="color:#ffffff"></i>
                    </button>
                    <button class="btn btn-sm btn-primary dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px"><i class="fa fa-cog"></i></button>
                    <button class="btn btn-sm btn-warning dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom:0" bb-media-click="edit_item"><i class="fa fa-pencil"></i></button>
                  </span>
                </span>
            </a>
        </div>`);
    },
    //********App -> htmlMaker -> makeFolder********end

    //********App -> htmlMaker -> makeImage********start
    makeImage: (data) => {
      return (`<div draggable="true" data-id="${data.id}" class="file" >
        <a  bb-media-click="select_item" bb-media-type="image">
            <span class="corner"></span>

            <div class="icon">
                <img width="180px" data-lightbox="image" src="/public/media/tmp/${data.original_name}">
                <i class="fa fa-file"></i>
            </div>
            <div class="file-name">
            <span class="icon-file"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
            <span class="file-title title-change" contenteditable="true" >${data.real_name}</span>
            </div>
            <!--<small>Added: ${data.updated_at}</small>-->
            <span class="dropdown file-actions d-none" style="position: absolute; right: 5px; top: 5px; max-width: 100px;">
              <button class="btn btn-sm btn-default dropdown-toggle click-no" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 0 10px">
                <i class="fa fa-ellipsis-h click-no" aria-hidden="true"></i>
              </button>
              <span  class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1" style="min-width: 100%;box-shadow: 0 0 4px #777;padding: 6px;margin-top: auto;">
                <button class="btn btn-sm btn-danger dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px" bb-media-click="remove_image">
                  <i class="fa fa-trash" style="color:#ffffff"></i>
                </button>
                <button class="btn btn-sm btn-primary dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px" bb-media-click="open_full_modal"><i class="fa fa-cog"></i></button>
                <button class="btn btn-sm btn-warning dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom:0" bb-media-click="edit_item"><i class="fa fa-pencil"></i></button>
              </span>
            </span>
        </a>
    </div>`);
    },
    //********App -> htmlMaker -> makeImage********end

      makeHtmlItem: (data) => {
        console.log(data, 'nhang')
          return (`<div draggable="true" data-id="${data.id}" class="file" data-type="${data.extension}" >
        <a  bb-media-click="select_item" bb-media-type="image">
            <span class="corner"></span>

            <div class="icon">
                <img width="180px" data-lightbox="image" src="/public/images/html.jpg">
                <i class="fa fa-file"></i>
            </div>
            <div class="file-name" data-url="${data.url}" data-id="${data.id}" data-key="${data.key}">
            <span class="icon-file"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
            <span class="file-title title-change" contenteditable="true" >${data.real_name}</span>
            </div>
            <!--<small>Added: ${data.updated_at}</small>-->
            <span class="dropdown file-actions d-none" style="position: absolute; right: 5px; top: 5px; max-width: 100px;">
              <button class="btn btn-sm btn-default dropdown-toggle click-no" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 0 10px">
                <i class="fa fa-ellipsis-h click-no" aria-hidden="true"></i>
              </button>
              <span  class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1" style="min-width: 100%;box-shadow: 0 0 4px #777;padding: 6px;margin-top: auto;">
                <button class="btn btn-sm btn-danger dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px" bb-media-click="remove_image">
                  <i class="fa fa-trash" style="color:#ffffff"></i>
                </button>
                <button class="btn btn-sm btn-primary dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px" bb-media-click="open_full_modal"><i class="fa fa-cog"></i></button>
                <button class="btn btn-sm btn-warning dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom:0" bb-media-click="edit_item"><i class="fa fa-pencil"></i></button>
              </span>
            </span>
        </a>
    </div>`);
      },

    makeTreeLeaf: (id, name) => {
      return (`<li class="dd-item mjs-nestedSortable-leaf" data-id=${id} data-name="${name}" id="item_${id}" bb-media-type="folder">
                  <div class="dd-handle oooo" bb-media-click="get_folder_items" draggable="true">${name}</div>
                  <span class="dropdown file-actions d-none" style="position: absolute; right: 10px; top: -8px; max-width: 100px;">
                  <button class="btn btn-sm btn-default dropdown-toggle click-no" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 0 10px">
                    <i class="fa fa-ellipsis-h click-no" aria-hidden="true"></i>
                  </button>
                  <span  class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1" style="min-width: 100%;box-shadow: 0 0 4px #777;padding: 6px;margin-top: auto;">
                    <button class="btn btn-sm btn-danger dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px" bb-media-click="remove_folder">
                      <i class="fa fa-trash" style="color:#ffffff"></i>
                    </button>
                    <button class="btn btn-sm btn-primary dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px"><i class="fa fa-cog"></i></button>
                    <button class="btn btn-sm btn-warning dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom:0" bb-media-click="edit_item"><i class="fa fa-pencil"></i></button>
                  </span>
                </span>
                </li>`);
    },

    makeTreeBranch: (id, name, children, makeTree) => {
      return (`<li class="dd-item mjs-nestedSortable-branch mjs-nestedSortable-expanded" data-name="${name}" data-id=${id} id="item_${id}" bb-media-type="folder">
                <div class="oooo" bb-media-click="get_folder_items" draggable="true">
                  <div class="disclose oooo"><span class="closer"></span></div>
                  <div class="dd-handle oooo">${name}</div>
                  <span class="dropdown file-actions d-none" style="position: absolute; right: 10px; top: -8px; max-width: 100px;">
                  <button class="btn btn-sm btn-default dropdown-toggle click-no" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 0 10px">
                    <i class="fa fa-ellipsis-h click-no" aria-hidden="true"></i>
                  </button>
                  <span  class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1" style="min-width: 100%;box-shadow: 0 0 4px #777;padding: 6px;margin-top: auto;">
                    <button class="btn btn-sm btn-danger dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px" bb-media-click="remove_folder">
                      <i class="fa fa-trash" style="color:#ffffff"></i>
                    </button>
                    <button class="btn btn-sm btn-primary dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px"><i class="fa fa-cog"></i></button>
                    <button class="btn btn-sm btn-warning dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom:0" bb-media-click="edit_item"><i class="fa fa-pencil"></i></button>
                  </span>
                </span>
                </div>
                <ol class="dd-list">${makeTree(children).join(' ')}</ol>
               </li>`);
    },

    makeTreeBranchInsteadLeaf: (id, branchName, leafName) => {
      return (`<div class="oooo" bb-media-click="get_folder_items"  draggable="true">
                 <div class="disclose oooo"><span class="closer"></span></div>
                 <div class="dd-handle oooo">${branchName}</div>
               </div>
               <ol class="dd-list">
                 <li class="dd-item mjs-nestedSortable-leaf" data-id=${id} data-name="${leafName}" id="item_${id}" >
                   <div class="dd-handle oooo" bb-media-click="get_folder_items"  draggable="true">${leafName}</div>
                 </li>
               </ol>`);
    },

    treeMove: (nodeId, parentId) => {
      if(Number(parentId) === 1) {
        $('#folder-list2>ol').append($(`li.dd-item[data-id="${nodeId}"]`));
      } else {
        if($(`li.dd-item[data-id="${parentId}"]>ol`).length !== 0) {
          $(`li.dd-item[data-id="${parentId}"]>ol`).append($(`li.dd-item[data-id="${nodeId}"]`));
        } else {
          const ol = $('<ol></ol>');
          ol.addClass('dd-list');
          $(`li.dd-item[data-id="${parentId}"]`).addClass('mjs-nestedSortable-branch mjs-nestedSortable-expanded');
          $(`li.dd-item[data-id="${parentId}"]>div`).replaceWith(`<div class="oooo" bb-media-click="get_folder_items"  draggable="true">
                 <div class="disclose oooo"><span class="closer"></span></div>
                 <div class="dd-handle oooo">${$(`li.dd-item[data-id="${parentId}"]`).text().trim().split(' ')[0].trim()}</div>
                 <span class="dropdown file-actions d-none" style="position: absolute; right: 10px; top: -8px; max-width: 100px;">
                  <button class="btn btn-sm btn-default dropdown-toggle click-no" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 0 10px">
                    <i class="fa fa-ellipsis-h click-no" aria-hidden="true"></i>
                  </button>
                  <span  class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1" style="min-width: 100%;box-shadow: 0 0 4px #777;padding: 6px;margin-top: auto;">
                    <button class="btn btn-sm btn-danger dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px" bb-media-click="remove_folder">
                      <i class="fa fa-trash" style="color:#ffffff"></i>
                    </button>
                    <button class="btn btn-sm btn-primary dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom: 3px"><i class="fa fa-cog"></i></button>
                    <button class="btn btn-sm btn-warning dropdown-item" style="display: block;color: #fff;padding: 0px 10px;margin-bottom:0" bb-media-click="edit_item"><i class="fa fa-pencil"></i></button>
                  </span>
                </span>
               </div>`)
          $(`li.dd-item[data-id="${parentId}"]`).append(ol);
          $(`li.dd-item[data-id="${parentId}"]>ol`).append($(`li.dd-item[data-id="${nodeId}"]`));
        }
      }
      if($(`li.dd-item[data-id="${this.dragElement}"]>ol`).children().length === 0) {
        $(`li.dd-item[data-id="${this.dragElement}"]`).replaceWith(this.htmlMaker.makeTreeLeaf(this.dragElement, $(`li.dd-item[data-id="${this.dragElement}"]`).text().trim().split(' ')[0].trim()));
      }

      this.events.dndForTree();

      document.querySelectorAll('.disclose').forEach((el)=>{el.onclick = function() {
        $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
      }});
    },


    //********App -> htmlMaker -> makeTreeFolder********start
    makeTreeFolder: (data, el) => {
      const self = this;
      const {makeTreeLeaf, makeTreeBranch} = this.htmlMaker;
      let {currentParentOfDrag, currentDragTreeElementId} = this.htmlMaker;
      const {dndForTree} = this.events;
      const {transferFolder} = this.requests;
      console.log(data, 'hariva');

      function makeTree (data) {
        const getTreeData = (data) => {
          return data.map((el) => {
            const children = el.children.length === 0 ? null : getTreeData(el.children);
            return {id: el.key, title: el.title, children: children};
          });
        };
        return data && data.map((el)=>{
          return !el.children || el.children.length === 0 ? makeTreeLeaf(el.key, el.name) : makeTreeBranch(el.key, el.name, el.children, makeTree);
        });
      };

      $(el).children().html(makeTree(data).join(' '));

      $('document').ready(() => {
        $(el + '>ol').nestedSortable({
          disableNesting: 'no-nest',
          forcePlaceholderSize: true,
          handle: 'div',
          helper: 'clone',
          items: 'li',
          opacity: .6,
          placeholder: 'placeholder',
          tabSize: 15,
          tolerance: 'pointer',
          toleranceElement: '> div',
          isTree: true,
          startCollapsed: true,
          update: function (ev, data) {

            const id = $(ev.originalEvent.target).closest('li').attr('data-id') || currentDragTreeElementId;
            const treeArray = $(this).nestedSortable('toArray');
            const parent_id = treeArray.filter((el) => el.id === id)[0].parent_id;
            let parentId = null;
            $(this).nestedSortable('toArray').map((el)=>{
              (el.id && Number(el.id)) === Number(id) && (parentId = el.parent_id);
            });

            const getData = (treeData) => {
              return treeData && treeData.map((el) => {
                return {key: el.id, name: $(`li.dd-item[data-id="${el.id}"]`).text().trim().split(' ')[0].trim(), children: el.children && getData(el.children)};
              });
            };

            const findParent = (treeData, p_id) => {
              var parent;
              !Array.isArray(findParent.children) && (findParent.children = []);
              parent = treeData && treeData.find((el) => {
                    el.children && findParent.children.push(...el.children);
                return Number(el.id) === Number(p_id);
              });

              if(parent) {
                return parent;
              } else {
                const p = findParent(findParent.children, p_id);
                if(p) {
                  return p;
                }
              }
            };

            const parentTransformToLeaf = () => {
              $(currentParentOfDrag.find('ol')[0]).children().length === 0 &&
                $(currentParentOfDrag[0]).replaceWith(makeTreeLeaf(currentParentOfDrag.attr('data-id'), currentParentOfDrag.text().trim()));
            };
            const dataOfBranch = parentId && getData([findParent($(this).nestedSortable('toHierarchy'), parentId)]);
            const leafTransformToParent = (data) => {
              $(`li.dd-item[data-id="${parent_id}"]`).replaceWith(makeTreeBranch(parent_id, $(`li.dd-item[data-id="${parent_id}"]`).text().trim().split(' ')[0].trim(), data[0].children, makeTree));
            };

            parentId === null && (function () {
              transferFolder(
                  {
                    folder_id: Number(id),
                    parent_id: Number(1),
                    access_token: "string"
                  }
              );
            })();
            transferFolder(
                {
                  folder_id: Number(id),
                  parent_id: Number(parentId),
                  access_token: "string"
                }
            );

            dndForTree();

            parentTransformToLeaf();
            parentId && leafTransformToParent(dataOfBranch);

            findParent.children = [];
            document.querySelectorAll('.disclose').forEach((el)=>{el.onclick = function() {
              $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
            }});
          },
          change: function(ev, data) {
          },
          sort: function (ev, data) {
          },
          revert: function() {
          },
          relocate: function() {
            dndForTree();
          },
          start: function (ev, data) {
            currentParentOfDrag = $(ev.originalEvent.target).closest('li').parent().closest('li');
            currentDragTreeElementId = $(ev.originalEvent.target).closest('li').attr('data-id');
          },
          stop: function(ev, data) {
            // $('#page-wrapper .over-auto').css('overflow', 'auto');
          },
          out: function(ev, data) {
            // $('#page-wrapper .over-auto').css('overflow', 'unset');
          },
          over: function () {
            // $('#page-wrapper .over-auto').css('overflow', 'auto');
          }
        });

      });

      dndForTree();

      document.querySelectorAll('.disclose').forEach((el)=>{el.onclick = function() {
        $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
      }});
    },
    //********App -> htmlMaker -> makeTreeFolder********end

    //********App -> htmlMaker -> makeBreadCrumbsItem********start
    makeBreadCrumbsItem: (key, name, state) => {
      return (`<li class="breadcrumb-item bread-crumbs-list-item ${state}" data-id="${key}" data-crumbs-id="${key}" 
                    bb-media-click="get_folder_items" >
                 <a>${name}</a>
               </li>`);
    },
    //********App -> htmlMaker -> makeBreadCrumbsItem********end

    //********App -> htmlMaker -> editNameModal********start
    editNameModal: (id, name, flag) => {
      return (`<div class="modal fade show d-block custom_modal_edit" id="myModal" role="dialog">
                <div class="modal-dialog">
            
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Change title</h4>
                      <button type="button" class="close" data-dismiss="modal" bb-media-click="close_name_modal">&times;</button>
                    </div>
                    <div class="modal-body">
                          <input class="form-control edit-title-input" value="${name}">
                    </div>
                    <div class="modal-footer">
                     <button bb-media-click="close_name_modal" type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                            <button type="button" data-id="${id}" flag="${flag}" class="btn btn-primary btn-save" bb-media-click="save_edited_title">Save changes</button>
                    </div>
                  </div>
            
                </div>
              </div>`);
    },

    remove_modal: (id, name, iorf) => {
      return (`<div class="modal fade show d-block custom_modal_edit" id="myModal" role="dialog">
                <div class="modal-dialog" role="document">
            
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Remove images</h4>
                      <button type="button" class="close" data-dismiss="modal" bb-media-click="close_name_modal">&times;</button>
                    </div>
                    <div class="modal-body">
                          <p>Do You want to remove ${iorf === 'image' ? (name.length === 0 ? 'selected images' : 'image') : 'folder'} ${name}?</p>
                    </div>
                    <div class="modal-footer">
                     <button bb-media-click="close_name_modal" type="button" class="btn btn-primary btn-save" data-dismiss="modal">Close</button>
                            <button type="button" data-id=${id} class="btn btn-secondary btn-close" bb-media-click="${iorf === 'image' ? 'remove_image_req' : 'remove_folder_req'}">Remove</button>
                    </div>
                  </div>
            
                </div>
              </div>`);
    },
    //********App -> htmlMaker -> editNameModal********end

    //********App -> htmlMaker -> fullInfoModal********start
    fullInfoModal: (data, countId) => {
      return `<div class="adminmodal modal fade show d-block in" style="display: block" id="imageload" tabindex="-1" role="dialog" aria-labelledby="imageloadLabel">
            <div class="modal-dialog modal-lg row" role="document">
                <div class="modal-content col-md-9 p-0">
                    <div class="modal-header" style="overflow: visible;">
                        <button type="button" bb-media-click="close_full_modal" class="close" data-dismiss="modal" aria-label="Close"><i class="iconaction iconClose"></i></button>`

                        // <button type="button" class="btn btn-action-popup" title="Edit image" data-dismiss="modal" data-toggle="modal" data-target="#imageeditMode"><i class="iconaction iconEditImageGrey"></i></button>
                        // <button type="button" class="btn btn-action-popup" title="Download"  data-slideshow="download" ><i class="iconaction iconDownloadGrey"></i></button>

        +`</div>
                    <div class="modal-body text-center">
                    <div class="modal-title">
                    <img src="${data.url}" data-slideshow="typeext" style="width:100%">
                    </div>
                    </div>
                       <div class="modal-footer col-md-9">
<div style="display: flex; justify-content: space-between;width:100%">
                    <button href="#" type="button" role="button" ${
              countId === 0 ? "disabled" : ""
              } data-id="${countId - 1}" class="btn btn-info popuparrow go-prev-image" bb-media-click="modal_load_image" ><i class="fa fa-arrow-left"></i></button>

                    <span data-slideshow="title">${data.real_name}</span>
                    <button class="btn btn-info popuparrow go-next-image" href="#" type="button" role="button" ${
              countId ===
              document.querySelectorAll(".image-container").length - 1
                  ? "disabled"
                  : ""
              } data-id="${countId +
          1}" bb-media-click="modal_load_image"  data-id=""><i class="fa fa-arrow-right"></i></button>
                    </div>

            </div>
                </div>
                <div class="popupDetail col-md-3 p-0">
                    <div class="row p-t-10 p-b-10 justify-content-center">
                        <div class="text-center">`+
                            // <button class="btn btn-default btn-block active" type="button" data-tabaction="details">Details</button>
          `<h4>${data.real_name}</h4></div>` +
          // <div class="col-xs-4 col-md-4">
          //     <button class="btn btn-default btn-block" type="button" data-tabaction="seo">SEO</button>
          // </div>
          // <div class="col-xs-4 col-md-4">
          //     <button class="btn btn-default btn-block" type="button">Option 3</button>
          // </div>
          `</div>
                    <div class="row rowsection collapse in show" data-tabcontent="details">
                        <div class="col-xs-12 col-md-12">
                            
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
              (Number(data.size)/1024).toFixed(2)
              } KB</span></td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td><i class="fa fa-folder"></i> <span data-slideshow="location">${
              data.storage.title
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
                                    </tr>` +
          // <tr>
          //     <th>Version</th>
          //     <td>
          //         <div class=" col-xs-3 p-l-0">
          //             <select class="form-control"  data-slideshow="version"></select>
          //         </div>
          //         <button type="button" class="btn btn-default p-l-5 p-r-5" data-action="makeasDefault">Make as Default</button>
          //     </td>
          // </tr>
          `</table>
                            </div>
                            <div class="table-responsive">
                            <form>
                                <table class="table tableborder0">

                                    <tr>
                                        
                                        <td>
                                            <input type="text" data-slideshow="alt_tags" class="form-control hide" value="" >
                                            <div class="altTagsdata"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width="23%">Keywords</th>
                                        <td>
                                            <input type="text" data-slideshow="keywords" name="seo_keywords" class="form-control" value="${data.seo_keywords}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width="23%">Caption</th>
                                        <td>
                                            <input type="text" data-slideshow="caption" name="seo_caption" class="form-control" value="${data.seo_caption}" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="23%">Description</th>
                                        <td><textarea name="seo_description" data-slideshow="description" class="form-control">${data.seo_description}</textarea>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="23%">Alt Text</th>
                                        <td>
                                            <input type="text" data-slideshow="alt_text" class="form-control" name="seo_alt" value="${data.seo_alt}">
                                        </td>
                                    </tr>


                                    <tr>
                                        <th></th>
                                        <td>

                                            <button type="button" class="btn btn-default p-l-5 p-r-5" bb-media-click="save_seo" data-action="saveSeo">Save Detail</button>
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" name='item_id'  value="${data.id}">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row rowsection collapse"  data-tabcontent="seo">
                        <div class="loadingimg lodingSeo hide" data-loadin="seo"></div>
                        <div class="col-xs-12 col-md-12">
                            <h4><i class="fa fa-bars text-primary"></i> Seo Detail</h4>
                            <div class="table-responsive">
                            <form>
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
                                            <input type="text" data-slideshow="keywords" name="seo_keywords" class="form-control" value="${data.seo_keywords}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width="23%">Caption</th>
                                        <td>
                                            <input type="text" data-slideshow="caption" name="seo_caption" class="form-control" value="${data.seo_caption}" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="23%">Description</th>
                                        <td><textarea name="seo_description" data-slideshow="description" class="form-control">${data.seo_description}</textarea>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="23%">Alt Text</th>
                                        <td>
                                            <input type="text" data-slideshow="alt_text" class="form-control" name="seo_alt" value="${data.seo_alt}">
                                        </td>
                                    </tr>


                                    <tr>
                                        <th></th>
                                        <td>

                                            <button type="button" class="btn btn-default p-l-5 p-r-5" bb-media-click="save_seo" data-action="saveSeo">Save Detail</button>
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" name='item_id'  value="${data.id}">
                                </form>
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
    //********App -> htmlMaker -> fullInfoModal********end

    copy_modal: (id) => {
      return (`<div class="modal fade show d-block custom_modal_edit" id="myModal" role="dialog">
                <div class="modal-dialog">
            
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Copy images</h4>
                      <button type="button" class="close" data-dismiss="modal" bb-media-click="close_name_modal">&times;</button>
                    </div>
                    <div class="modal-body">
                          <p>Do You want to copy selected images?</p>
                    </div>
                    <div class="modal-footer">
                     <button bb-media-click="close_name_modal" type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                            <button type="button" data-id=${id} class="btn btn-primary btn-save" bb-media-click="copy_images_req">Copy</button>
                    </div>
                  </div>
            
                </div>
              </div>`);
    }
  };
  //********App -> htmlMaker********end

  //********App -> helpers********start
  this.helpers = {
    //********App -> helpers -> makeBreadCrumbs********start
    makeBreadCrumbs: (id, res) => {
      const self = this;
      const breadCrumbsList = document.querySelector(".bread-crumbs-list");
      breadCrumbsList.innerHTML = `<li class="breadcrumb-item bread-crumbs-list-item active" data-id="1" data-crumbs-id="1"
                                        bb-media-click="get_folder_items" >
                                     <a>Drive</a>
                                   </li>`;
      $('document').ready(() => {
var count = 0;
        const getTreeData = (data, id) => {

          const element = data.find((el) => {
            return Number(el.id) === Number(id);
          });

          !Array.isArray(getTreeData.breadCrumbsData) && (getTreeData.breadCrumbsData = []);
          element && getTreeData.breadCrumbsData.unshift({id: element.id, name: element.name});
          element && (Number(element.parent_id) !== 1) && getTreeData(data, element.parent_id);
          count++;
        };


        const treeData = $('#folder-list2>ol').nestedSortable('toArray');
        treeData.shift();
        treeData[0] && (treeData[0].parent_id = "1");
        getTreeData(treeData, id);

        getTreeData.breadCrumbsData.length > 0 && getTreeData.breadCrumbsData
            .map((el, index) => {
              index === getTreeData.breadCrumbsData.length-1 ?
                  breadCrumbsList.innerHTML += self.htmlMaker.makeBreadCrumbsItem(el.id, el.name, 'disabled') :
                  breadCrumbsList.innerHTML += self.htmlMaker.makeBreadCrumbsItem(el.id, el.name, 'active');
            });
      });
    },
    //********App -> helpers -> makeBreadCrumbs********end

    //********App -> helpers -> showUploaderContainer********start
    showUploaderContainer: () => {
      // const self = this;
      document
          .querySelector(".uploader-container")
          .classList.toggle("d-none");
      $('.remover-container').addClass('d-none');

      document
          .querySelector(".fileinput-remove").onclick = this.helpers.showUploaderContainer;
      return false;
    },
    showRemoverContainer: () => {
      document
          .querySelector(".remover-container")
          .classList.toggle("d-none");
      return false;
    },
    //********App -> helpers -> showUploaderContainer********end

    //********App -> helpers -> makeDnD********start
    makeDnD: () => {
      const self = this;
      document
        .querySelectorAll(`[data-type="main-container"] [draggable="true"]`)
        .forEach(elm => {
          elm.addEventListener("dragstart", function (e) {
            function findAncestor (el, cls) {
              while ((el = el.parentElement) && !el.classList.contains(cls));
              return el;
            };
            if(self.selectedImage.length !== 0 && findAncestor(e.target, 'image-container').classList.contains('active')) {
              const selected = document.createElement('div');
              selected.setAttribute('node_id', 1);
              selected.style.display = 'flex';
              selected.style.flexWrap = 'wrap';
              selected.style.width = '320px';

              self.selectedImage.map((id) => {
                let cloneNode = document.querySelector(`.image-container [data-id="${id}"]`).cloneNode(true);
                cloneNode.style.width = '80px';
                cloneNode.style.marginRight = '10px';
                cloneNode.style.marginBottom = '10px';
                selected.appendChild(cloneNode);
              });

              selected.className += " start";
              selected.style.position = "absolute";
              selected.style.top = "-10000px";
              selected.style.right = "-10000px";

              document.body.appendChild(selected);
              const id = this.getAttribute("data-id");
              e.dataTransfer.setDragImage(selected, 0, 0);
              // e.dataTransfer.effectAllowed = "copy"; // only dropEffect='copy' will be dropable
              e.dataTransfer.setData("node_id", JSON.stringify({data: self.selectedImage, item: 'image'})); // required otherwise doesn't work
              // setTimeout(() => (this.className = "invisible"), 0);
              // self.htmlMaker.currentId = id;
            } else if(!e.target.classList.contains('title-change')) {
              const width = elm.clientWidth;
              const height = elm.clientHeight;

              const crt = this.cloneNode(true);
              crt.className += " start";
              crt.style.position = "absolute";
              crt.style.top = "-10000px";
              crt.style.right = "-10000px";
              crt.style.width = width + 'px';
              crt.style.height= height + "px";
              document.body.appendChild(crt);
              const id = this.getAttribute("data-id");
              e.dataTransfer.setDragImage(crt, 0, 0);
              // e.dataTransfer.effectAllowed = "copy"; // only dropEffect='copy' will be dropable
              e.dataTransfer.setData("node_id", JSON.stringify({data: id, item: $(e.target).closest('[bb-media-type]').attr('bb-media-type')})); // required otherwise doesn't work
              self.dragElement = $(`li.dd-item[data-id="${id}"]`).closest('li').parent().closest('li').length !== 0 ? $(`li.dd-item[data-id="${id}"]`).closest('li').parent().closest('li').attr('data-id') : 1;
              // setTimeout(() => (this.className = "invisible"), 0);
              self.htmlMaker.currentId = id;
            }
          });
          elm.addEventListener("dragend", function() {
            $('.start').remove();
          });
        });

      document.querySelectorAll(".folder-container").forEach(folder => {
        folder.addEventListener("dragover", function (e) {
          if (e.preventDefault) e.preventDefault(); // allows us to drop
          e.dataTransfer.dropEffect = "copy";
          this.classList.add("over");
          return false;
        });
        folder.addEventListener("dragleave", function (e) {
          if (e.preventDefault) e.preventDefault(); // allows us to drop
          this.classList.remove("over");
          return false;
        });
        folder.addEventListener("drop", function (e) {
          this.classList.remove("over");
          console.log(JSON.parse(e.dataTransfer.getData("node_id")))
          let nodeId = self.htmlMaker.dragElementOfTree || JSON.parse(e.dataTransfer.getData("node_id")).data;
          let parentId = e.target
              .closest(".file")
              .getAttribute("data-id");
          if(Array.isArray(nodeId)) {
            nodeId.map((id)=> {
                self.requests.transferImage(
                  {
                    item_id: Number(id),
                    folder_id: Number(parentId),
                    access_token: "string"
                  }
                );
            });
          } else {
            if(self.htmlMaker.dragElementOfTree || $('.folderitems').find(`[data-id="${nodeId}"]`)[0].closest('.folder-container')) {
              self.requests.transferFolder(
                {
                  folder_id: Number(nodeId),
                  parent_id: Number(parentId),
                  access_token: "string"
                },
                  () => {
                    self.htmlMaker.treeMove(nodeId, parentId);
                  }
              );
            } else {
              self.requests.transferImage(
                {
                  item_id: Number(nodeId),
                  folder_id: Number(parentId),
                  access_token: "string"
                }
              );
            }
          }
          self.htmlMaker.dragElementOfTree = null;
          self.htmlMaker.currentId = null;
          self.selectedImage.length = 0;
        });
      });
    }
    //********App -> helpers -> makeDnD********end
  };
  //********App -> helpers********end

  //********App -> requests********start
  this.requests = {

    //********App -> requests -> drawingItems********start
    drawingItems: (obj = {
                     folder_id: globalFolderId,
                     files: true,
                     access_token: "string"
                   },
                   tree = false,
                   cb) => {
      shortAjax("/api/api-media/get-folder-childs", obj, res => {
        if (!res.error) {
          const mainContainer = document.querySelector(
              `[data-type="main-container"]`
          );
          mainContainer.innerHTML = "";
            res.data.children.forEach((folder, index) => {
            var html = `<div class="file-box folder-container col-lg-2 col-md-3 col-sm-6 col-xs-12">${this.htmlMaker.makeFolder(
                folder
            )}</div>`;
            mainContainer.innerHTML += html;
          });
            res.data.items.forEach((file, index) => {
              let html;
              if(file.extension === "html") {
                  html = `<div data-image="${index}" class="file-box image-container col-lg-2 col-md-3 col-sm-6 col-xs-12">${this.htmlMaker.makeHtmlItem(
                      file
                  )}</div>`;
              } else {
                  html = `<div data-image="${index}" class="file-box image-container col-lg-2 col-md-3 col-sm-6 col-xs-12">${this.htmlMaker.makeImage(
                      file
                  )}</div>`;
              }
            mainContainer.innerHTML += html;
          });
          if (tree) {
              console.log(res)
            this.htmlMaker.makeTreeFolder(res.data.children, '#folder-list2');
          }
          globalFolderId = res.settings.id;
          this.helpers.makeBreadCrumbs(res.settings.id, res);
          this.helpers.makeDnD();
          this.selectedImage.length = 0;
          cb ? cb() : null;
        }
      });
    },
    //********App -> requests -> drawingItems********end

    //********App -> requests -> removeTreeFolder********start
    removeTreeFolder: (obj = {}, cb) => {
      shortAjax("/api/api-media/get-remove-folder", obj, res => {
        if (!res.error) {
          cb();
          // this.requests.drawingItems(undefined, true);
        }
      });
    },
    //********App -> requests -> removeTreeFolder********end

    //********App -> requests -> saveSeo********start
    saveSeo: (obj = {}, cb) => {
      normAjax("/api/api-media/save-seo", obj, res => {
        if (!res.error) {
          cb();
        }
      });
    },
    //********App -> requests -> saveSeo********end

    //********App -> requests -> editImageName********start
    editImageName: (obj = {}, cb) => {
      shortAjax("/api/api-media/rename-item", obj, res => {
        if (!res.error) {
          (typeof cb) === "function" && cb(res);
        }
      });
    },
    //********App -> requests -> editImageName********end

    //********App -> requests -> editImageName********start
    editFolderName: (obj = {}, cb) => {
      shortAjax("/api/api-media/rename-folder", obj, res => {
        if (!res.error) {
          // cb(res);
        }
      });
    },
    //********App -> requests -> editImageName********end

    //********App -> requests -> transferImage********start
    transferImage: (obj = JSON.stringify({}), cb) => {
      shortAjax("/api/api-media/transfer-item", obj, res => {
        if (!res.error) {
          this.requests.drawingItems();
        }
      });
    },
    //********App -> requests -> transferImage********end

    //********App -> requests -> transferFolder********start
    transferFolder: (obj = {}, cb) => {
      shortAjax("/api/api-media/get-sort-folder", obj, res => {
        if (!res.error) {
          this.requests.drawingItems();
          cb && cb();
        }
      });
    },
    //********App -> requests -> transferFolder********end

    //********App -> requests -> removeImage********start
    removeImage: (obj = {}, cb, cb2) => {
      shortAjax("/api/api-media/get-remove-item", obj, res => {
        if (!res.error) {
          this.requests.drawingItems(undefined,undefined,cb2);
          cb();
        }
      });
    },
    //********App -> requests -> removeImage********end

    //********App -> requests -> addNewFolder********start
      addNewFolder: (obj = {}, cb) => {
        shortAjax("/api/api-media/get-create-folder-child", obj, res => {
          if (!res.error) {
            this.requests.drawingItems();
            cb(res);
          }
        });
      },
    //********App -> requests -> addNewFolder********end

    //********App -> requests -> getImageDetails********start
      getImageDetails: (obj = {}, cb) => {
        shortAjax("/api/api-media/get-item-details", obj, res => {
          if (!res.error) {
            cb(res.data);
          }
        });
      },

      copyImages: (obj = {}, cb) => {
        shortAjax("/api/api-media/copy-item", {item_id: obj}, res => {
          if (!res.error) {
            typeof cb === "function" && cb(res.data);
          }
        });
      }

    //********App -> requests -> getImageDetails********end

  };
  //********App -> requests********end

  //********App -> getInitailData********start
  this.getInitailData = () => {
    this.requests.drawingItems(undefined, true);
  };
  //********App -> getInitailData********end

  //********App -> init********start
  this.init = () => {
    $("#uploader").fileinput({
      uploadAsync: false,
      maxFileCount: 10,
      showUpload: true,
      showUploadedThumbs: false,
      initialPreviewAsData: true,
      browseOnZoneClick: true,
      uploadExtraData: () => {
        return {
          _token: $("meta[name='csrf-token']").attr("content"),
          folder_id: globalFolderId
        };
      }
    })
    .on("filebatchselected", (event, files) => {
      $("#uploader").fileinput("upload");
    })
    .on("filebatchuploadsuccess", (event, files) => {
        document.querySelector('.navbar').innerHTML = files.files[0]
      this.requests.drawingItems();
      this.helpers.showUploaderContainer();
      $("#uploader").fileinput("clear");
    });
    this.getInitailData();

    $("#remover").fileinput({
      uploadAsync: false,
      showUpload: false, // hide upload button
      showRemove: false, // hide remove button
      // overwriteInitial: false, // append files to initial preview
      minFileCount: 1,
      maxFileCount: 50,
      showUploadedThumbs: false,
      initialPreviewAsData: true,
    }).on("filebatchselected", function(event, files) {

    });
  };
  //********App -> init********end

  //********App -> events********start
  this.events = {

    //********App -> events -> save_seo********start
    save_seo: (elm, e) => {
      e.stopPropagation();
      e.preventDefault();
      this.requests.saveSeo($(elm).closest('form').serializeArray());
    },
    //********App -> events -> save_seo********end

    remove_folder: (elm, e) => {
      e.stopPropagation();
      e.preventDefault();
      const id = (elm.closest(".file") ? elm.closest(".file").getAttribute("data-id") : elm.closest(".dd-item").getAttribute("data-id")),
            name = e.target
              .closest(".file") ? e.target
              .closest(".file")
              .querySelector(".file-name")
              .textContent.trim() : elm.closest('.dd-item').querySelector('.dd-handle').innerText;
      $('#modal_area').html(this.htmlMaker.remove_modal(id, name));
    },

    //********App -> events -> remove_folder********start
    remove_folder_req: (elm, e) => {
      e.stopPropagation();
      e.preventDefault();

      const id = e.target.getAttribute("data-id") || (elm.closest(".file") ? elm.closest(".file").getAttribute("data-id") : elm.closest(".dd-item").getAttribute("data-id"));
      if(!id) return;
      const tree = $('#folder-list2>ol'),
            leaf = tree.find(`[data-id="${id}"]`),
            {makeTreeLeaf} = this.htmlMaker,
            {close_name_modal} = this.events,
            {removeTreeFolder} = this.requests;

      removeTreeFolder(
        {
          folder_id: Number(id),
          trash: 1,
          access_token: "string"
        },
        () => {
          !elm.closest(".folder-container") ? $(`div[data-id=${'' + id}]`).closest(".folder-container").remove() : elm.closest(".folder-container").remove();
          close_name_modal();

          const ol = leaf.closest('ol');
          const li = leaf.closest('li');
          const key = ol.closest('li').attr('data-id');
          const name = ol.closest('li').children('div')[0] ? ol.closest('li').children('div')[0].innerText : null;

          li.remove();
          name && ol.children().length === 0 && ol.closest('li').replaceWith(makeTreeLeaf(key, name));

          if(globalFolderId === 1) {
            tree.find(`[data-id="${id}"]`).remove();

          }
          // const ol = leaf.closest('ol');
          // const li = leaf.closest('li');
          // const key = ol.closest('li').attr('data-id');
          // const name = ol.closest('li').children('div')[0].innerText;
          // console.log('leaf :', leaf, 'ol: ', ol, 'li: ', li, 'key: ', key, 'name: ', name);
          //
          // li.remove();
          // ol.children().length === 0 && ol.closest('li').replaceWith(makeTreeLeaf(key, name));
        }
      );
    },
    //********App -> events -> remove_folder********end

    //********App -> events -> get_folder_items********start
    get_folder_items: (elm, e) => {
      const self = this;
      console.log('self', e.target)
      !$(e.target).hasClass('closer') && (function(){
        const id = elm.closest("[data-id]").getAttribute("data-id");
        globalFolderId = id;
        if (id && !elm.classList.contains("disabled")) {
          self.requests.drawingItems(
              {
                folder_id: Number(id),
                files: true,
                access_token: "string"
              },
              $(e.target).data('core') === true,
              () => self.htmlMaker.currentId = id
          );
        }
      })();
    },
    //********App -> events -> get_folder_items********end

    //********App -> events -> get_folder_items_tree********start
    get_folder_items_tree: (id, e) => {
      if (id) {
        this.requests.drawingItems(
          {
            folder_id: Number(id),
            files: true,
            access_token: "string"
          }
        );
      }
    },
    //********App -> events -> get_folder_items_tree********end

    //********App -> events -> add_new_folder********start
    add_new_folder: (elm, e) => {

      const {makeTreeLeaf, makeTreeBranchInsteadLeaf} = this.htmlMaker,
            inputElement = document.querySelector(".new-folder-input"),
            name = inputElement.value,
            tree = $('#folder-list2>ol'),
            leaf = tree.find(`[data-id="${globalFolderId}"]`),
            createTree = (res) => {
              if(globalFolderId === 1) {
                tree.append(makeTreeLeaf(res.data.key, name));

                return true;
              }
              const text = leaf.children()[0].innerText;
              leaf.find('ol').length === 0 && leaf.children()[0].parentNode.removeChild(leaf.children()[0])

              leaf.find('ol').length === 0 ?
                  leaf.removeClass('mjs-nestedSortable-leaf')
                      .addClass('mjs-nestedSortable-branch mjs-nestedSortable-expanded')
                      .append(makeTreeBranchInsteadLeaf(res.data.key, text, name))
                  : $(leaf.find('ol')[0]).append(makeTreeLeaf(res.data.key, name))
              document.
              querySelectorAll('.disclose')
                  .forEach((el)=>{el.onclick = function() {
                    $(this).closest('li')
                        .toggleClass('mjs-nestedSortable-collapsed')
                        .toggleClass('mjs-nestedSortable-expanded');
                  };});
            };
      this.requests.addNewFolder(
          {
            folder_id: globalFolderId,
            folder_name: name,
            access_token: "string"
          },
          createTree
      );
      inputElement.value = '';
    },
    //********App -> events -> add_new_folder********end

    //********App -> events -> open_full_modal********start
    open_full_modal: (elm, e) => {
      e.stopPropagation();
      e.preventDefault();
      const id = e.target.closest(".file").getAttribute("data-id");
      const countId = e.target
          .closest(".file-box")
          .getAttribute("data-image");
      this.requests.getImageDetails({item_id: id}, res => {
        $('#modal_area').html(this.htmlMaker.fullInfoModal(
            res,
            Number(countId)
        ));
        $("body").on("click dblclick", `[bb-media-click]`, function (e) {
          if(!e.target.classList.contains('click-no')) {
            const attr = $(this).attr("bb-media-click");
            app.events[attr](this, e);
          }
        });
      });
    },
    //********App -> events -> open_full_modal********end

    //********App -> events -> select_item********start
    select_item: (elm, e) => {
      const id = e.target.closest(".file").getAttribute("data-id");
      if (e.type === "dblclick") {
          if($(e.target).closest('.file').data('type') === 'html') {

              $.ajax({
                  type: "get",
                  url: $(e.target).closest('.file').find('[data-url]').data('url'),
                  cache: false,
                  data: 1,
                  headers: {
                      "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                  },
                  success: function (data) {
                      // $('#modal-id .modal-body').append(data);
                      // $('#modal-id').modal('show');
                  }
              });

          } else {
              e.target.closest(".file-box").classList.remove("active");
              const countId = e.target
                  .closest(".file-box")
                  .getAttribute("data-image");
              this.requests.getImageDetails({item_id: id}, res => {
                  $('#modal_area').html(this.htmlMaker.fullInfoModal(
                      res,
                      Number(countId)
                  ));
                  return $('body').append(html);
              });
          };

      } else if (e.type === "click") {
        e.target.closest(".file-box").classList.toggle("active");
        if(this.selectedImage.includes(id)) {
          const index = this.selectedImage.indexOf(id);
          this.selectedImage.splice(index, 1);
        } else {
          this.selectedImage.push(id);
        }
      }
    },
    //********App -> events -> select_item********end

    //********App -> events -> modal_load_image********start
    modal_load_image: (elm, e) => {
      if (!e.target.closest("button").disabled) {
        const id = e.target.closest("button").getAttribute("data-id");
        const imageId = document
            .querySelector(`[data-image="${id}"] [data-id]`)
            .getAttribute("data-id");
        this.requests.getImageDetails({item_id: imageId}, res => {
          document.querySelectorAll(".adminmodal ").forEach(item => item.remove());
          $('#modal_area').html(this.htmlMaker.fullInfoModal(
              res,
              Number(id)
          ));
        });
      }
    },
    //********App -> events -> modal_load_image********end

    //********App -> events -> remove_image********start
    remove_image: (elm, e, elements) => {
      e.preventDefault();
      e.stopPropagation();
      elements && (e = elements);
      const id = this.selectedImage.length === 0 || (e.target.closest(".file") && !this.selectedImage.includes(e.target.closest(".file").getAttribute("data-id"))) ? e.target.closest(".file").getAttribute("data-id") : this.selectedImage;
      const name = this.selectedImage.length === 0  || (e.target.closest(".file") && !this.selectedImage.includes(e.target.closest(".file").getAttribute("data-id"))) ? e.target
          .closest(".file")
          .querySelector(".file-name")
          .textContent.trim() : '';
      const modal = this.htmlMaker.remove_modal(id, name, 'image');
      $('#modal_area').html(modal);
    },

    remove_image_req: (elm, e) => {
      const itemId = this.selectedImage.length === 0 || (e.target.getAttribute("data-id").indexOf(',') < 0 && !this.selectedImage.includes(e.target.getAttribute("data-id"))) ? e.target.getAttribute("data-id") : this.selectedImage;
      this.requests.removeImage(
        {
          item_id: this.selectedImage.length === 0 || (e.target.getAttribute("data-id").indexOf(',') < 0 && !this.selectedImage.includes(e.target.getAttribute("data-id"))) ? Number(itemId) : this.selectedImage,
          trash: true,
          access_token: "string"
        },
        this.events.close_name_modal
      );
    },

    copy_images: (elm, e) => {
      this.selectedImage.length > 0 &&  $('#modal_area').html(this.htmlMaker.copy_modal(this.selectedImage));
    },

    copy_images_req: (elm, ev) => {
      this.requests.copyImages(this.selectedImage, ()=> {
          this.requests.drawingItems();
          this.events.close_name_modal();
      });
    },

    // remove_image_items: (e) => {
    //   e.preventDefault();
    //   e.stopPropagation();
    //   selectedImage.length !== 0 ? selectedImage.map((id) => {
    //     this.requests.removeImage(
    //         {
    //           item_id: Number(id),
    //           trash: false,
    //           access_token: "string"
    //         }
    //     );
    //   }) : this.events.show_remover();
    // },
    //********App -> events -> remove_image********end

    //********App -> events -> edit_item********start
    edit_item: (elm, e) => {
      e.preventDefault();
      e.stopPropagation();

      const id = e.target.closest(".file") ? e.target.closest(".file").getAttribute("data-id") : e.target.closest(".dd-item").getAttribute("data-id");
      const name = e.target
          .closest(".file") ? e.target
          .closest(".file")
          .querySelector(".file-name")
          .textContent.trim() : $(e.target).closest(".dd-item").find('[bb-media-click="get_folder_items"]').text().trim();
      const flag = $(e.target.closest(".file")).find('[bb-media-type]').attr('bb-media-type') || (e.target.closest(".dd-item") && 'folder');
      $('#modal_area').html(this.htmlMaker.editNameModal(id, name, flag));
    },
    //********App -> events -> edit_item********end

    //********App -> events -> save_edited_title********start
    save_edited_title: (elm, e) => {
      const itemId = e.target.getAttribute("data-id");
      const name = document.querySelector(".edit-title-input").value;
      const flag = e.target.getAttribute("flag");
      if(flag === "image") {
        this.requests.editImageName(
            {
              item_id: Number(itemId),
              item_name: name,
              access_token: "string"
            },
            () => {
              $(`.file[data-id="${itemId}"]`).find('.file-title').html(name);
              this.events.close_name_modal();
            }
        );
      } else if(flag === "folder") {
        this.requests.editFolderName(
            {
              folder_id: Number(itemId),
              folder_name: name,
              access_token: "string"
            },
            () => {
              $(`.file[data-id="${itemId}"]`).find('.file-title').html(name);
              this.events.close_name_modal();
            }
        );
      }
    },
    //********App -> events -> save_edited_title********end

    //********App -> events -> show_uploader********start
    show_uploader: (elm, e) => {
      this.helpers.showUploaderContainer();
    },
    show_remover: () => {
      this.helpers.showRemoverContainer();
    },
    //********App -> events -> show_uploader********end

    //********App -> events -> close_full_modal********start
    close_full_modal: (elm, e) => {
      e.target.closest(".modal").remove();
    },
    //********App -> events -> close_full_modal********end

    //********App -> events -> folder_level_up********start
    folder_level_up: (elm, e) => {
      const allActiveBreadCrumbs = document.querySelectorAll(
          ".bread-crumbs-list-item.active"
      );
      if (allActiveBreadCrumbs.length) {
        const oneLevelUpID = allActiveBreadCrumbs[
          allActiveBreadCrumbs.length - 1
            ].getAttribute("data-id");
        this.requests.drawingItems(
          {
            folder_id: Number(oneLevelUpID),
            files: true,
            access_token: "string"
          }
        );
      }
    },
    //********App -> events -> folder_level_up********end

    //********App -> events -> close_name_modal********start
    close_name_modal: (elm, e) => {
      // this.requests.drawingItems(undefined, true);
      $(".custom_modal_edit").remove();
      $('.folderitems').on('mouseenter mouseleave', 'div.file', function(ev) {
        if(ev.type === 'mouseenter') {
          $(this).find('.file-actions').removeClass('d-none');
        } else if(ev.type === 'mouseleave') {
          $(this).find('.file-actions').addClass('d-none').removeClass('open');
        }
      });
      $('.remover-container-zone').removeClass('file-highlighted');
    },
    //********App -> events -> close_name_modal********end

    dndForTree: () => {
      const self = this;

      document.querySelectorAll(".dd-item").forEach(folder => {
        // folder.setAttribute('draggable',"true")
        folder.addEventListener("dragover", function (e) {
          if (e.preventDefault) e.preventDefault(); // allows us to drop
          e.stopPropagation();
          e.dataTransfer.dropEffect = "copy";
          this.classList.add("over");
          // this.children[0].style.backgroundColor = '#4389c5';
          return false;
        });
        folder.addEventListener("dragleave", function (e) {
          if (e.preventDefault) e.preventDefault(); // allows us to drop
          e.stopPropagation();

          // this.children[0].style.backgroundColor = 'white';
          // this.children[0].style.color = '#294656';
          this.classList.remove("over");
          return false;
        });
        folder.addEventListener("drop", function (e) {
          e.stopPropagation();
          this.classList.remove("over");
          let nodeId = JSON.parse(e.dataTransfer.getData("node_id")).data;

          let parentId = e.target
              .closest(".file") ? e.target
              .closest(".file")
              .getAttribute("data-id") : e.target.closest(".dd-item").getAttribute("data-id");
          if(Array.isArray(nodeId)) {
            nodeId.map((id)=> {
              self.requests.transferImage(
                  {
                    item_id: Number(id),
                    folder_id: Number(parentId),
                    access_token: "string"
                  }
              );
            });
          } else {
            if($('.folderitems').find(`[data-id="${nodeId}"]`)[0].closest('.folder-container')) {
              self.requests.transferFolder(
                  {
                    folder_id: Number(nodeId),
                    parent_id: Number(parentId),
                    access_token: "string"
                  },
                  () => {
                    self.htmlMaker.treeMove(nodeId, parentId);
                  }
              );
            } else {
              self.requests.transferImage(
                  {
                    item_id: Number(nodeId),
                    folder_id: Number(parentId),
                    access_token: "string"
                  }
              );
            }
          }
          self.htmlMaker.dragElementOfTree = null;
          self.htmlMaker.currentId = null;
          self.selectedImage.length = 0;
        });
      });
    }

  };
  //********App -> events********end

};
//********App********end

const app = new App();
app.init();

function isJson(str) {
  try {
    JSON.parse(str);
  } catch (e) {
    return str;
  }
  return JSON.parse(str);
}

$("body").on("click dblclick", `[bb-media-click]`, function (e) {
  if(!e.target.classList.contains('click-no')) {
    const attr = $(this).attr("bb-media-click");
    app.events[attr](this, e);
  }
});

$("body").on("click", `[data-tabaction]`, function (e) {
  const id = $(this).attr("data-tabaction");
  $("body")
      .find(`[data-tabcontent]`)
      .removeClass("in");
  $("body")
      .find(`[data-tabcontent="${id}"]`)
      .addClass("in");
});

$('.new-folder-input').on('keypress', function (ev) {
  ev.keyCode === 13 && $('[bb-media-click="add_new_folder"]').click();
});

$('.folderitems, .dd-list').on('mouseover mouseout', 'div.file, li.dd-item', function(ev) {
  if(ev.type === 'mouseover') {
    $($(ev.target).closest("[data-id]").find('.file-actions')[0]).removeClass('d-none');
  } else if(ev.type === 'mouseout') {
    $($(ev.target).closest("[data-id]").find('.file-actions')[0]).addClass('d-none').removeClass('open');
  }
});

$('body').on('blur', '[contenteditable]', function(ev) {
  const itemId = ev.target.closest('div[data-id]').getAttribute('data-id');
  const name = this.textContent;
  const imgOrFolder = $(this).closest('[bb-media-click="get_folder_items"]').length;
  if(imgOrFolder === 0) {
    app.requests.editImageName(
        {
          item_id: Number(itemId),
          item_name: name,
          access_token: "string"
        }
    );
  } else {
    app.requests.editFolderName(
        {
          folder_id: Number(itemId),
          folder_name: name,
          access_token: "string"
        }
    );
  }
  // app.events.save_edited_title()
});

$('.delete_items').on('click', (ev) => {

  const toggle = () => {
    $('.remover-container').toggleClass('d-none');
    $('.uploader-container').addClass('d-none');
  };
  app.selectedImage.length !== 0 ? app.events.remove_image(undefined, ev) : toggle();
});

const removeCheckedImage = (el) => {
  const id = $(el.closest('[data-id]')).attr('data-id');
  $(el).closest('.folderitems').remove();
  $(`.media_right_content .folderitems [data-id="${id}"]`).closest('.file-box').removeClass('checked-for-remove');
  $('.images_container').children().length === 0
  && $('.remove-button_container').empty() && $('.remover-container-content').append('<p class="remove_title" style="margin: 85px auto;">Drag & drop files you want to delete...</p>');
};

const removeImages = () => {
  const checkedImagesArray = [];
  const uncheckedImagesArray = [];
  $.each($('.check-image'), (index, image) => {
    $(image).prop("checked") ? checkedImagesArray.push($(image).closest('[data-id]').attr('data-id')) : uncheckedImagesArray.push($(image).closest('[data-id]').attr('data-id'));
  });
  app.requests.removeImage(
      {
        item_id: checkedImagesArray,
        trash: true,
        access_token: "string"
      }, () => {
        checkedImagesArray.map((imageId) => {
          $('.remover-container-content').find(`[data-id="${imageId}"]`).closest('.folderitems').remove();
        });
        $('.remover-container-content').find('.folderitems').length === 0
        && $('.remove-button_container').empty() && $('.remover-container-content').append('<p class="remove_title" style="margin: 85px auto;">Drag & drop files you want to delete...</p>');
      },
      () => {
        uncheckedImagesArray.map((imageId) => {
          $(`.media_right_content .folderitems .image-container [data-id="${imageId}"]`).closest('.file-box').addClass('checked-for-remove').removeClass('active');
          app.selectedImage.length = 0;
        });
      }
  );
};

const checkImage = (checkedImage) => {
  !$(checkedImage).prop("checked") && $('.checkbox-all').prop('checked', false);
  if($(checkedImage).prop("checked")) {
    $('.images_container input[type="checkbox"]').toArray().every((el) => $(el).prop('checked') === true) && $('.checkbox-all').prop('checked', true);
  }
};

const checkedAll = (checkboxAll) => {
  $(checkboxAll).prop("checked") ? $.each($('.images_container input[type="checkbox"]'), (index, el) => {$(el).prop('checked', true);}) : $.each($('.images_container input[type="checkbox"]'), (index, el) => {$(el).prop('checked', false);});
};

const removeList = () => {
  $('.remove-button_container').empty();
  $('.images_container').empty();
  $('.remover-container-content').prepend('<p class="remove_title" style="margin: 85px auto;">Drag & drop files you want to delete...</p>');
  $('.checked-for-remove').removeClass('checked-for-remove');
};

const removeImageDrop = (ev, data) => {
    const imgTag = $(document.querySelector(`.image-container [data-id="${data}"]`)).find('img');
    imgTag.attr('draggable', 'false');
    const name = $(document.querySelector(`.image-container [data-id="${data}"]`)).find('.file-title').text().trim();
    const div = `<div class="folderitems col-xl-2 col-sm-6" draggable="false">
                  <div class="file-box image-container">
                      <div draggable="false" data-id="${data}" class="file file-remove" >
                          <a  bb-media-type="image">
                              <span class="corner"></span>
                              <div class="icon position-relative">
                                  ${imgTag[0].outerHTML}
                                  <i class="fa fa-file"></i>
                                  <span class="position-absolute btn btn-danger btn-sm rounded-0" style="right:0;top: 0; line-height: 0" onclick="removeCheckedImage(this)">
                                    <i class="fa fa-times" style="font-size: 12px;"></i>
                                  </span>
                              </div>
                              <div class="file-name">
                                <span class="icon-file"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
                                <span class="file-title" style="width: 100%; font-size: 20px">${name}</span>
                                <span><input type="checkbox" class="check-image" checked onchange="checkImage(this)"></span>
                              </div>
                          </a>
                      </div>
                  </div>
                </div>`;
    $(ev.target).closest('div').find('p.remove_title').remove();
    $('.remover-container-content .images_container').prepend(div);
    $('.remover-container-content').find('.remove-checked-item').length === 0
    && $('.remove-button_container').append(`
        <div class="d-flex flex-column">
          <button class="remove-checked-item btn btn-danger" onclick="removeImages()">Delete</button>
          <button class="remove-in-list btn btn-info my-2" onclick="removeList()">List Remove</button>
          <input type="checkbox" onchange="checkedAll(this)" checked class="checkbox-all align-self-center">
        </div>`);
    $(`.media_right_content .folderitems .image-container [data-id="${data}"]`).closest('.file-box').addClass('checked-for-remove').removeClass('active');
    app.selectedImage.length = 0;
};

const drop = (ev, cb) => {
  ev.preventDefault();

  const data = isJson(ev.originalEvent.dataTransfer.getData('node_id'));
  const flag = data.item || 'image';
  console.log(data)
  if(flag === 'image') {
    // console.log(data.data)
    if(Array.isArray(data.data)) {
      data.data.map(el=>{
        console.log($('.remover-container-content').find(`[data-id="${el}"]`), 'hellllllllllll')
        if($('.remover-container-content').find(`[data-id="${el}"]`).length === 0) {

          removeImageDrop(ev, el);
        }
      });
    } else {
      console.log($('.remover-container-content').find(`[data-id="${data.data}"]`), 'lehhhhhhhhhhhhhh')
      if($('.remover-container-content').find(`[data-id="${data.data}"]`).length === 0) {

        removeImageDrop(ev, data.data);
      }
    }
  } else if(flag === 'folder') {
    alert('You may not add folders in DnD area!');
  }
  cb();
};

function removeHighlight() {
  $('.remover-container-zone').removeClass('file-highlighted');
}

$('.remover-container-zone').on('dragover dragleave', (ev) => {
  ev.preventDefault();
  if(ev.type === 'dragover') {
    $('.remover-container-zone').addClass('file-highlighted');
  }else if(ev.type === 'dragleave') {
    $('.remover-container-zone').removeClass('file-highlighted');
  }
});

$('.remover-container-zone').on('drop', (ev) => drop(ev, removeHighlight));


$('body').on('click', '.copy-button', (ev) => {
  app.selectedImage.length !== 0 && app.events.copy_images(app.selectedImage, ev);
});

document
    .querySelector('.remover-container .remover-remove')
    .onclick = function() {
      $('.remover-container').toggleClass('d-none');
    };
