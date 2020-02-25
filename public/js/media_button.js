// var _global_folder_id = null;

// $(document).ready(function() {
//     window.retryDrawing = function() {
//         var jsondata = {
//             folder_id: _global_folder_id,
//             files: true,
//             access_token: "string"
//         };
//         postSendAjax("/api-media/get-folder-childs", jsondata, getfolder);
//     };
//     /*$('.file-box').each(function() {
//              animationHover(this, 'pulse');
//              });*/
//     postSendAjax = function(url, data, success, error) {
//         data.folder_id ? (_global_folder_id = data.folder_id) : "drive";
//         $.ajax({
//             type: "post",
//             url: url,
//             cache: false,
//             datatype: "json",
//             data: data,
//             headers: {
//                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
//             },
//             success: function(data) {
//                 if (success) {
//                     success(data);
//                 }
//                 return data;
//             },
//             error: function(errorThrown) {
//                 if (error) {
//                     error(errorThrown);
//                 }
//                 return errorThrown;
//             }
//         });
//     };

//     ajaxMedia = function(url, data, success, error) {
//         $.ajax({
//             type: "post",
//             url: url,
//             cache: false,
//             datatype: "json",
//             data: data,
//             headers: {
//                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
//             },
//             success: function(data) {
//                 if (success) {
//                     success(data);
//                 }
//                 return data;
//             },
//             error: function(errorThrown) {
//                 if (error) {
//                     error(errorThrown);
//                 }
//                 return errorThrown;
//             }
//         });
//     };

//     var selectedFolder = "";
//     var activefolderid = "";
//     var mainfoderid = false;
//     var editbuttonclass = null;
//     var settingbuttonclass = null;
//     var deletebuttonclass = null;

    // var getfolderli = function(datajosn) {
    //     if (!datajosn) return false;
    //     var htmlli = $('<li data-treefolder="' + datajosn.id + '"></li>');
    //     var dragdiv = $("<div></div>");
    //     var htmla = $(
    //         '<a href="' +
    //             datajosn.path +
    //             '" data-dropnewitem="' +
    //             datajosn.name +
    //             '" data-media="getitem"><i class="fa fa-folder"></i> ' +
    //             datajosn.name +
    //             "</a>"
    //     );
    //     var editfolder = $(
    //         '<button class="btn btn-default btn-xs pull-right ' +
    //             editbuttonclass +
    //             '" type="button" data-name="' +
    //             datajosn.name +
    //             '" data-mediaedit="' +
    //             datajosn.id +
    //             '" data-media="editfolder"><i class="fa fa-pencil" aria-hidden="true"></i></button>'
    //     );
    //     var setingfolder = $(
    //         '<button class="btn btn-default btn-xs pull-right m-r-5 ' +
    //             settingbuttonclass +
    //             '" type="button" data-name="' +
    //             datajosn.name +
    //             '" data-mediaedit="' +
    //             datajosn.id +
    //             '" data-media="settingfolder"><i class="fa fa-cog" aria-hidden="true"></i></button>'
    //     );
    //     var deletefolder = $(
    //         '<button class="btn btn-default btn-xs pull-right m-r-5 ' +
    //             deletebuttonclass +
    //             '" type="button" data-name="' +
    //             datajosn.name +
    //             '" data-mediaedit="' +
    //             datajosn.id +
    //             '" data-media="deletefolder"><i class="fa fa-trash-o" aria-hidden="true"></i></button>'
    //     );
    //
    //     dragdiv.append(editfolder);
    //     dragdiv.append(setingfolder);
    //     dragdiv.append(deletefolder);
    //     $.each(datajosn, function(key, val) {
    //         htmla.attr("data-" + key, val);
    //     });
    //
    //     dragdiv.append(htmla);
    //     htmlli.append(dragdiv);
    //     return htmlli;
    // };
//     var img_extensions = { jpg: true, jpeg: true, png: true, gif: true };
//     var getitmeimage = function(datajosn) {
//         var html = $('[data-template="itemthumb"]').html();
//         html = html.replace(/{original_name}/g, datajosn.original_name);
//         html = html.replace(/{real_name}/g, datajosn.real_name);
//         html = html.replace(/{extension}/g, datajosn.extension);
//         html = html.replace(/{size}/g, datajosn.size);
//         html = html.replace(/{id}/g, datajosn.id);
//         if (img_extensions.hasOwnProperty(datajosn.extension)) {
//             html = html.replace(/{url}/g, datajosn.url);
//         } else {
//             html = html.replace(
//                 /{url}/g,
//                 "/images/" + datajosn.extension + ".png"
//             );
//         }
//         html = html.replace(/{created_at}/g, datajosn.created_at);
//         html = html.replace(/{updated_at}/g, datajosn.updated_at);
//         $.each(datajosn, function(key, val) {});
//         return html;
//     };
//     var getitmeFolder = function(datajosn) {
//         var html = $('[data-template="foldertumb"]').html();
//         html = html.replace(/{title}/g, datajosn.title);
//         html = html.replace(/{id}/g, datajosn.id);
//         html = html.replace(/{updated_at}/g, datajosn.updated_at);
//         html = html.replace(/{created_at}/g, datajosn.created_at);
//         $.each(datajosn, function(key, val) {});
//         return html;
//     };
//     const HTMLmakeBreadCrumbs = data => {
//         `<a href="#" data-id="" data-dropnewitem="" data-media="getitem" class="ui-droppable"><i class="fa fa-folder"></i> Parent Folder</a>`;
//     };
//     var getfolder = function(data) {
//         if (!data.error) {
//             if (data.data) {
//                 if (!mainfoderid) {
//                     mainfoderid = data.data.id;
//                 }
//                 var appedndata = "";
//                 activefolderid = data.data.id;
//                 let url = data.data.url;
//                 let index = url.indexOf("drive");
//                 let arrOfParrentElements = url.substring(index).split("/");
//                 $('[data-targetiuploder="folder"]').collapse("hide");
//                 //selectedFolder = ' '+ data.data.name;
//                 selectedFolder =
//                     '/ <a href="' +
//                     data.data.path +
//                     '" data-id="' +
//                     data.data.parent_id +
//                     '" data-dropnewitem="' +
//                     data.data.parent_id +
//                     '" data-media="getitem"><i class="fa fa-folder"></i> Parent Folder</a> / ' +
//                     data.data.title +
//                     " ";
//                 var parentid = data.data.parent_id;
//                 if (data.data.parent_id == null) {
//                     selectedFolder = " " + data.data.name;
//                 }
//                 $('[data-media="selected"]').html(selectedFolder);
//                 $('[data-media="folderitem"]').empty();
//                 var appendselecter = $(
//                     'li[data-treefolder="' + activefolderid + '"]'
//                 );
//                 $('[data-media="folder"] li').removeClass("active");
//                 appendselecter.addClass("active");

//                 if (parentid == null || parentid == "0") {
//                     appendselecter = $('[data-media="folder"]');
//                 }
//                 var noitemandfoder = true;

//                 if (data.data.childs) {
//                     if (data.data.childs != "") {
//                         noitemandfoder = false;
//                         if (!appendselecter.children("ul").is("ul")) {
//                             appendselecter.append("<ul></ul>");
//                         }
//                         $.each(data.data.childs, function(key, val) {
//                             $('[data-media="folderitem"]').append(
//                                 getitmeFolder(val)
//                             );

//                             if (parentid == null || parentid == 0) {
//                                 if (
//                                     $('li[data-treefolder="' + val.id + '"]')
//                                         .length == 0
//                                 ) {
//                                     appendselecter.append(getfolderli(val));
//                                 }
//                             } else {
//                                 if (
//                                     $('li[data-treefolder="' + val.id + '"]')
//                                         .length == 0
//                                 ) {
//                                     appendselecter
//                                         .children("ul:first")
//                                         .append(getfolderli(val));
//                                 }
//                             }
//                         });
//                     }
//                 } else {
//                 }
//                 if (data.data.items) {
//                     if (data.data.items != "") {
//                         noitemandfoder = false;
//                         $.each(data.data.items, function(key, val) {
//                             $('[data-media="folderitem"]').append(
//                                 getitmeimage(val)
//                             );
//                         });
//                     }
//                 } else {
//                 }
//                 if (noitemandfoder) {
//                     $('[data-media="folderitem"]').append(
//                         '<h2>Sorry, No have any item or any sub Folder in <b class="text-danger">' +
//                             data.data.title +
//                             "</b> Folder</h2>"
//                     );
//                 }
//                 //$('[data-media="folder"]').html(appedndata)
//                 draganddrop();
//             }
//         } else {
//             alert(JSON.stringify(data.message));
//         }
//     };

//     var createnewfolder = function(datajson) {
//         if (!datajson.error) {
//             var parentid = datajson.data.parent_id;
//             var appendselecter = $(
//                 'li[data-treefolder="' + activefolderid + '"]'
//             );
//             if ($('li[data-treefolder="' + parentid + '"]').length == 0) {
//                 appendselecter = $('[data-media="folder"]');
//             }
//             if (!appendselecter.children("ul").is("ul")) {
//                 appendselecter.append("<ul></ul>");
//             }

//             if ($('li[data-treefolder="' + parentid + '"]').length > 0) {
//                 if (
//                     $('li[data-treefolder="' + datajson.data.id + '"]')
//                         .length == 0
//                 ) {
//                     appendselecter.children("ul:first").append(getfolderli());
//                     $('[data-media="folderitem"]').append(
//                         getitmeFolder(datajson.data)
//                     );
//                 }
//             } else {
//                 if (
//                     $('li[data-treefolder="' + datajson.data.id + '"]')
//                         .length == 0
//                 ) {
//                     $('[data-media="folderitem"]').append(
//                         getitmeFolder(datajson.data)
//                     );
//                     appendselecter.append(getfolderli(datajson.data));
//                 }
//             }

//             draganddrop();
//             $("#createFolder").collapse("hide");
//             $('[data-mediafield="addfolder"]').val(" ");
//         } else {
//             alert(JSON.stringify(datajson.message));
//         }
//     };
//     var renameFolder = function(datajson) {
//         if (!datajson.error) {
//             alert(JSON.stringify(datajson));
//         } else {
//             alert(JSON.stringify(datajson.message));
//         }
//     };

//     var sortFolder = function(datajson) {
//         if (!datajson.error) {
//             if (datajson.data) {
//                 $('[data-folderid="' + datajson.data.id + '"]').remove();
//             }
//             //alert(JSON.stringify(datajson))
//         } else {
//             alert(JSON.stringify(datajson.message));
//         }
//     };

//     var itemmove = function(datajson) {
//         if (!datajson.error) {
//             $('[data-dragitem="' + datajson.data.id + '"]').remove();
//         } else {
//             alert(JSON.stringify(datajson.message));
//         }
//     };

//     var testajax = function(datajson) {
//         if (!datajson.error) {
//             alert(JSON.stringify(datajson));
//         } else {
//             alert(JSON.stringify(datajson.message));
//         }
//     };

//     var settingFolder = function(datajson) {
//         if (!datajson.error) {
//             var jsoninfo = datajson.data;

//             $("#foldersetting").modal("show");

//             //alert(JSON.stringify(datajson))
//             $('[data-selectmenu="action"]').val(jsoninfo.settings.action);
//             $('[data-selectmenu="function"]').val(jsoninfo.settings.function);
//             $('[data-selectmenu="description"]').val(
//                 jsoninfo.settings.description
//             );
//             $('[data-selectmenu="Uploader"]').change();
//             $("[data-selectmenu]").selectpicker();
//         } else {
//             alert(JSON.stringify(datajson.message));
//         }
//     };

//     function uploadersmedia(d) {
//         if (typeof d == "object") {
//             if (!d.error && d.data) {
//                 var options = "";
//                 $.each(d.data, function(key, value) {
//                     options +=
//                         '<option value="' +
//                         value.slug +
//                         '">' +
//                         value.title +
//                         "</option>";
//                 });
//                 $('[data-selectmenu="Uploader"]').html(options);
//             }
//         }
//     }

//     //var getfloderid = {folder_id:'1','access_token':'string'  }
//     var getfolderSlug = $('input[data-type="folder"]').val();
//     var jsondata = { slug: getfolderSlug, files: true, access_token: "string" };
//     postSendAjax("/api-media/get-folder-childs", jsondata, getfolder);

//     ajaxMedia("/api/api-media/get-media-uploaders", {}, uploadersmedia);
//     $('[data-selectmenu="Uploader"]').change(function() {
//         var getvalue = $(this).val();
//         var htmlsdata = function(d) {
//             if (d.html) {
//                 $('[data-settingmodal="uploder"]').html(d.html);
//             }
//         };
//         ajaxMedia(
//             "/api/api-media/get-media-uploaders-settings",
//             { slug: getvalue },
//             htmlsdata
//         );
//     });

//     $('[data-role="btnUploader"]').click(function() {
//         var afterajax = function(d) {
//             if (d.error) {
//                 alert(JSON.stringify(d.message));
//             } else {
//                 if (d.html) {
//                     var htmlsdata = $("<div></div>");
//                     htmlsdata.append(d.html);
//                     var token = $("input[name='_token']").val();
//                     var dataid = { folder_id: activefolderid, _token: token };

//                     htmlsdata
//                         .find("input[data-upload-url]")
//                         .attr("data-upload-extra-data", JSON.stringify(dataid));
//                     //alert(htmlsdata.html())
//                     $('[data-targetiuploder="folder"] > div').html(
//                         htmlsdata.html()
//                     );
//                     $('[data-targetiuploder="folder"]').collapse("show");
//                 }
//             }
//         };
//         ajaxMedia(
//             "/api/api-media/get-media-uploader-rendered",
//             { folder_id: activefolderid },
//             afterajax
//         );
//     });

//     $('[data-settingmodal="save"]').click(function() {
//         var getformdata = $('[data-settingmodal="setting"]').serializeArray();
//         var getuploaderdata = $(
//             '[data-settingmodal="uploder"]'
//         ).serializeArray();
//         var data = {
//             folder_settings: {},
//             uploader_data: {},
//             folder_id: $('[data-selectmenu="folder_id"]').val()
//         };

//         $.each(getformdata, function(key, val) {
//             var name = val.name;
//             data.folder_settings[name] = val.value;
//         });
//         $.each(getuploaderdata, function(key, val) {
//             var name = val.name;
//             data.uploader_data[name] = val.value;
//         });

//         var afterajax = function(d) {};

//         ajaxMedia("/api/api-media/get-edit-folder-settings", data, afterajax);
//     });

//     function createnestd() {
//         var sortselected = "";
//         var sortparent = "";
//         $('[data-media="folder"]').nestedSortable({
//             forcePlaceholderSize: true,
//             handle: "div",
//             helper: "clone",
//             items: "li",
//             listType: "ul",
//             opacity: 0.6,
//             placeholder: "placeholder",
//             revert: 250,
//             tabSize: 25,
//             tolerance: "pointer",
//             toleranceElement: "> div",
//             isTree: true,
//             expandOnHover: 700,
//             startCollapsed: false,
//             isAllowed: function(placeholder, placeholderParent, currentItem) {
//                 sortselected = $(currentItem).data("treefolder");
//                 sortparent = $(placeholderParent)
//                     .closest("[data-treefolder]")
//                     .data("treefolder");
//                 return true;
//             },
//             relocate: function(event, ui) {
//                 if (!sortparent) {
//                     sortparent = mainfoderid;
//                 }
//                 var jsondata = {
//                     folder_id: sortselected,
//                     parent_id: sortparent,
//                     access_token: "string"
//                 };
//                 postSendAjax(
//                     "/api/api-media/get-sort-folder",
//                     jsondata,
//                     sortFolder
//                 );
//                 console.log(
//                     "change item" + sortselected + " parent" + sortparent
//                 );
//             }
//         });
//     }

//     function draganddrop() {
//         $("[data-dragitem], [data-folderid]").draggable({
//             revert: true,
//             helper: function(n) {
//                 return (
//                     document.body.classList.add("dragging"),
//                     '<div id="photo-file-drag" class="photo-file-drag" data-type="' +
//                         $(this).data("mediatype") +
//                         '" data-id="' +
//                         $(this).data("id") +
//                         '"><i class="fa fa-picture-o"></i> ' +
//                         $(this).data("name") +
//                         "</div>"
//                 );
//             }
//         });
//         $("[data-folderid], a[data-dropnewitem]").droppable({
//             accept: "[data-dragitem], [data-folderid]",
//             hoverClass: "draggable-over",
//             drop: function(event, ui) {
//                 var targetfolderid = $(this).data("id");
//                 var itemid = $(".photo-file-drag").data("id");
//                 var type = $(".photo-file-drag").data("type");
//                 console.log(
//                     "change item" + itemid + " Folderd" + targetfolderid
//                 );
//                 if (type == "folder") {
//                     var jsondata = {
//                         folder_id: itemid,
//                         parent_id: targetfolderid,
//                         access_token: "string"
//                     };
//                     postSendAjax(
//                         "/api/api-media/get-sort-folder",
//                         jsondata,
//                         sortFolder
//                     );
//                 } else if (type == "item") {
//                     var jsondata = {
//                         folder_id: targetfolderid,
//                         item_id: itemid,
//                         access_token: "string"
//                     };
//                     postSendAjax(
//                         "/api/api-media/get-sort-item",
//                         jsondata,
//                         itemmove
//                     );
//                 }
//                 $(".photo-file-drag").remove();
//             },
//             tolerance: "pointer"
//         });
//     }

//     createnestd();
//     $("body")
//         .on("click", '[data-media="getitem"]', function(e) {
//             e.preventDefault();
//             var fid = $(this).data("id");
//             if (fid == null) {
//                 fid = 1;
//             }
//             var jsondata = {
//                 folder_id: fid,
//                 files: true,
//                 access_token: "string"
//             };
//             postSendAjax(
//                 "/api-media/get-folder-childs",
//                 jsondata,
//                 getfolder
//             );
//         })
//         .on("click", '[data-media="addfolder"]', function() {
//             var getFoldername = $('[data-mediafield="addfolder"]').val();
//             if (getFoldername != "") {
//                 var jsondata = {
//                     folder_id: activefolderid,
//                     folder_name: getFoldername,
//                     access_token: "string"
//                 };
//                 postSendAjax(
//                     "/api/api-media/get-create-folder-child",
//                     jsondata,
//                     createnewfolder
//                 );
//             }
//         })
//         .on("click", '[data-media="editfolder"]', function() {
//             var editfodlerid = $(this).data("mediaedit");
//             var editfodlername = $(this).data("name");
//             /*bootbox.prompt("Rename "+editfodlername +" Folder", function(result){
//                  if(result){
//                  var jsondata = {folder_id:editfodlerid, folder_name:result, access_token:'string'}
//                  postSendAjax('/api-media/get-edit-folder', jsondata, renameFolder);
//                  }
//                  });*/
//         })
//         .on("click", '[data-media="settingfolder"]', function() {
//             var editfodlerid = $(this).data("mediaedit");
//             var editfodlername = $(this).data("name");
//             var jsondata = { folder_id: editfodlerid, access_token: "string" };
//             $('[data-selectmenu="folder_id"]').val(editfodlerid);
//             postSendAjax(
//                 "/api/api-media/get-folder-info",
//                 jsondata,
//                 settingFolder
//             );
//             /*bootbox.prompt("Rename "+editfodlername +" Folder", function(result){
//                  if(result){

//                  }
//                  });*/
//         })
//         .on("click", '[data-media="deletefolder"]', function() {
//             var editfodlerid = $(this).data("mediaedit");
//             var editfodlername = $(this).data("name");
//             var deleteoption =
//                 '<div class="form-group">' +
//                 '<select class="form-control" data-selectmenu="delete"><option value="delete">Delete</option><option value="trash">move too trash</option></select>' +
//                 "</div>";
//             var moveoption =
//                 '<div class="form-group  hide" data-movetype="move">' +
//                 '<label for="function">Move to</label>' +
//                 '<select class="form-control" data-selectmenu="function"><option>select option</option></select>' +
//                 "</div>";

//             var deleteFolder = function(datajson) {
//                 if (!datajson.error) {
//                     $('[data-treefolder="' + editfodlerid + '"]').remove();
//                     $('[data-folderid="' + editfodlerid + '"]').remove();
//                 } else {
//                     alert(JSON.stringify(datajson.message));
//                 }
//             };
//             var jsondata = {
//                 folder_id: editfodlerid,
//                 trash: 0,
//                 access_token: "string"
//             };
//             if ($('[data-selectmenu="delete"]').val() == "trash") {
//                 jsondata["trash"] = 1;
//             }
//             postSendAjax(
//                 "/api/api-media/get-remove-folder",
//                 jsondata,
//                 deleteFolder
//             );
//             // bootbox.dialog({
//             //     title: "Delete " + editfodlername,
//             //     message: deleteoption,
//             //     buttons: {
//             //         confirm: {
//             //             label: "Save",
//             //             className: "btn-success",
//             //             callback: function() {
//             //                 if (
//             //                     $('[data-selectmenu="delete"]').val() == "trash"
//             //                 ) {
//             //                     jsondata["trash"] = 1;
//             //                 }
//             //             }
//             //         },
//             //         cancel: {
//             //             label: "cancel",
//             //             className: "btn-danger"
//             //         }
//             //     }
//             // });

//             $("[data-selectmenu]").selectpicker();
//         });
// });
