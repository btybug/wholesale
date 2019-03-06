var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/*!
 * bootstrap-fileinput v4.3.4
 * http://plugins.krajee.com/file-input
 *
 * Author: Kartik Visweswaran
 * Copyright: 2014 - 2016, Kartik Visweswaran, Krajee.com
 *
 * Licensed under the BSD 3-Clause
 * https://github.com/kartik-v/bootstrap-fileinput/blob/master/LICENSE.md
 */!function (e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == (typeof module === "undefined" ? "undefined" : _typeof(module)) && module.exports ? module.exports = e(require("jquery")) : e(window.jQuery);
}(function (e) {
    "use strict";
    e.fn.fileinputLocales = {}, e.fn.fileinputThemes = {};var t, i, a, n, r, l, o, s, d, c, p, u, f, m, g, v, h, w, b, _, C, x, y, T, F, k, E, $, S, I, P, D, z, A, U, j, L, Z, B, O, R, M, N, H, q, W, V, K, G, X, Y, J, Q, ee, te, ie, ae, ne, re, le, oe, se, de, ce, pe, ue, fe, me;t = ".fileinput", i = "kvFileinputModal", a = 'style="width:{width};height:{height};"', n = '<param name="controller" value="true" />\n<param name="allowFullScreen" value="true" />\n<param name="allowScriptAccess" value="always" />\n<param name="autoPlay" value="false" />\n<param name="autoStart" value="false" />\n<param name="quality" value="high" />\n', r = '<div class="file-preview-other">\n<span class="{previewFileIconClass}">{previewFileIcon}</span>\n</div>', l = window.URL || window.webkitURL, o = function o(e, t, i) {
        return void 0 !== e && (i ? e === t : e.match(t));
    }, s = function s(e) {
        if ("Microsoft Internet Explorer" !== navigator.appName) return !1;if (10 === e) return new RegExp("msie\\s" + e, "i").test(navigator.userAgent);var t,
            i = document.createElement("div");return i.innerHTML = "<!--[if IE " + e + "]> <i></i> <![endif]-->", t = i.getElementsByTagName("i").length, document.body.appendChild(i), i.parentNode.removeChild(i), t;
    }, d = function d(e, i, a, n) {
        var r = n ? i : i.split(" ").join(t + " ") + t;e.off(r).on(r, a);
    }, c = { data: {}, init: function init(e) {
            var t = e.initialPreview,
                i = e.id;t.length > 0 && !ne(t) && (t = t.split(e.initialPreviewDelimiter)), c.data[i] = { content: t, config: e.initialPreviewConfig, tags: e.initialPreviewThumbTags, delimiter: e.initialPreviewDelimiter, previewFileType: e.initialPreviewFileType, previewAsData: e.initialPreviewAsData, template: e.previewGenericTemplate, showZoom: e.fileActionSettings.showZoom, showDrag: e.fileActionSettings.showDrag, getSize: function getSize(t) {
                    return e._getSize(t);
                }, parseTemplate: function parseTemplate(t, i, a, n, r, l, o) {
                    var s = " file-preview-initial";return e._generatePreviewTemplate(t, i, a, n, r, !1, null, s, l, o);
                }, msg: function msg(t) {
                    return e._getMsgSelected(t);
                }, initId: e.previewInitId, footer: e._getLayoutTemplate("footer").replace(/\{progress}/g, e._renderThumbProgress()), isDelete: e.initialPreviewShowDelete, caption: e.initialCaption, actions: function actions(t, i, a, n, r, l, o) {
                    return e._renderFileActions(t, i, a, n, r, l, o, !0);
                } };
        }, fetch: function fetch(e) {
            return c.data[e].content.filter(function (e) {
                return null !== e;
            });
        }, count: function count(e, t) {
            return c.data[e] && c.data[e].content ? t ? c.data[e].content.length : c.fetch(e).length : 0;
        }, get: function get(t, i, a) {
            var n,
                r,
                l,
                o,
                s,
                d,
                p = "init_" + i,
                u = c.data[t],
                f = u.config[i],
                m = u.content[i],
                g = u.initId + "-" + p,
                v = " file-preview-initial",
                h = re("previewAsData", f, u.previewAsData);return a = void 0 === a ? !0 : a, m ? (f && f.frameClass && (v += " " + f.frameClass), h ? (l = u.previewAsData ? re("type", f, u.previewFileType || "generic") : "generic", o = re("caption", f), s = c.footer(t, i, a, f && f.size || null), d = re("filetype", f, l), n = u.parseTemplate(l, m, o, d, g, s, p, null)) : n = u.template.replace(/\{previewId}/g, g).replace(/\{frameClass}/g, v).replace(/\{fileindex}/g, p).replace(/\{content}/g, u.content[i]).replace(/\{template}/g, re("type", f, u.previewFileType)).replace(/\{footer}/g, c.footer(t, i, a, f && f.size || null)), u.tags.length && u.tags[i] && (n = se(n, u.tags[i])), ae(f) || ae(f.frameAttr) || (r = e(document.createElement("div")).html(n), r.find(".file-preview-initial").attr(f.frameAttr), n = r.html(), r.remove()), n) : "";
        }, add: function add(t, i, a, n, r) {
            var l,
                o = e.extend(!0, {}, c.data[t]);return ne(i) || (i = i.split(o.delimiter)), r ? (l = o.content.push(i) - 1, o.config[l] = a, o.tags[l] = n) : (l = i.length - 1, o.content = i, o.config = a, o.tags = n), c.data[t] = o, l;
        }, set: function set(t, i, a, n, r) {
            var l,
                o,
                s = e.extend(!0, {}, c.data[t]);if (i && i.length && (ne(i) || (i = i.split(s.delimiter)), o = i.filter(function (e) {
                return null !== e;
            }), o.length)) {
                if (void 0 === s.content && (s.content = []), void 0 === s.config && (s.config = []), void 0 === s.tags && (s.tags = []), r) {
                    for (l = 0; l < i.length; l++) {
                        i[l] && s.content.push(i[l]);
                    }for (l = 0; l < a.length; l++) {
                        a[l] && s.config.push(a[l]);
                    }for (l = 0; l < n.length; l++) {
                        n[l] && s.tags.push(n[l]);
                    }
                } else s.content = i, s.config = a, s.tags = n;c.data[t] = s;
            }
        }, unset: function unset(e, t) {
            var i = c.count(e);if (i) {
                if (1 === i) return c.data[e].content = [], c.data[e].config = [], void (c.data[e].tags = []);c.data[e].content[t] = null, c.data[e].config[t] = null, c.data[e].tags[t] = null;
            }
        }, out: function out(e) {
            var t,
                i = "",
                a = c.data[e],
                n = c.count(e, !0);if (0 === n) return { content: "", caption: "" };for (var r = 0; n > r; r++) {
                i += c.get(e, r);
            }return t = a.msg(c.count(e)), { content: '<div class="file-initial-thumbs">' + i + "</div>", caption: t };
        }, footer: function footer(e, t, i, a) {
            var n = c.data[e];if (i = void 0 === i ? !0 : i, 0 === n.config.length || ae(n.config[t])) return "";var r = n.config[t],
                l = re("caption", r),
                o = re("width", r, "auto"),
                s = re("url", r, !1),
                d = re("key", r, null),
                p = re("showDelete", r, !0),
                u = re("showZoom", r, n.showZoom),
                f = re("showDrag", r, n.showDrag),
                m = s === !1 && i,
                g = n.isDelete ? n.actions(!1, p, u, f, m, s, d) : "",
                v = n.footer.replace(/\{actions}/g, g);return v.replace(/\{caption}/g, l).replace(/\{size}/g, n.getSize(a)).replace(/\{width}/g, o).replace(/\{indicator}/g, "").replace(/\{indicatorTitle}/g, "");
        } }, p = function p(e, t) {
        return t = t || 0, "number" == typeof e ? e : ("string" == typeof e && (e = parseFloat(e)), isNaN(e) ? t : e);
    }, u = function u() {
        return !(!window.File || !window.FileReader);
    }, f = function f() {
        var e = document.createElement("div");return !s(9) && (void 0 !== e.draggable || void 0 !== e.ondragstart && void 0 !== e.ondrop);
    }, m = function m() {
        return u() && window.FormData;
    }, g = function g(e, t) {
        e.removeClass(t).addClass(t);
    }, G = { showRemove: !0, showUpload: !0, showZoom: !0, showDrag: !0, removeIcon: '<i class="glyphicon glyphicon-trash text-danger"></i>', removeClass: "btn btn-xs btn-default", removeTitle: "Remove file", uploadIcon: '<i class="glyphicon glyphicon-upload text-info"></i>', uploadClass: "btn btn-xs btn-default", uploadTitle: "Upload file", zoomIcon: '<i class="glyphicon glyphicon-zoom-in"></i>', zoomClass: "btn btn-xs btn-default", zoomTitle: "View Details", dragIcon: '<i class="glyphicon glyphicon-menu-hamburger"></i>', dragClass: "text-info", dragTitle: "Move / Rearrange", dragSettings: {}, indicatorNew: '<i class="glyphicon glyphicon-hand-down text-warning"></i>', indicatorSuccess: '<i class="glyphicon glyphicon-ok-sign text-success"></i>', indicatorError: '<i class="glyphicon glyphicon-exclamation-sign text-danger"></i>', indicatorLoading: '<i class="glyphicon glyphicon-hand-up text-muted"></i>', indicatorNewTitle: "Not uploaded yet", indicatorSuccessTitle: "Uploaded", indicatorErrorTitle: "Upload Error", indicatorLoadingTitle: "Uploading ..." }, v = '{preview}\n<div class="kv-upload-progress hide"></div>\n<div class="input-group {class}">\n   {caption}\n   <div class="input-group-btn">\n       {remove}\n       {cancel}\n       {upload}\n       {browse}\n   </div>\n</div>', h = '{preview}\n<div class="kv-upload-progress hide"></div>\n{remove}\n{cancel}\n{upload}\n{browse}\n', w = '<div class="file-preview {class}">\n    {close}    <div class="{dropClass}">\n    <div class="file-preview-thumbnails">\n    </div>\n    <div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>\n    <div class="kv-fileinput-error"></div>\n    </div>\n</div>', _ = '<div class="close fileinput-remove">&times;</div>\n', b = '<i class="glyphicon glyphicon-file kv-caption-icon"></i>', C = '<div tabindex="500" class="form-control file-caption {class}">\n   <div class="file-caption-name"></div>\n</div>\n', x = '<button type="{type}" tabindex="500" title="{title}" class="{css}" {status}>{icon} {label}</button>', y = '<a href="{href}" tabindex="500" title="{title}" class="{css}" {status}>{icon} {label}</a>', T = '<div tabindex="500" class="{css}" {status}>{icon} {label}</div>', F = '<div id="' + i + '" class="file-zoom-dialog modal fade" tabindex="-1" aria-labelledby="' + i + 'Label"></div>', k = '<div class="modal-dialog modal-lg" role="document">\n  <div class="modal-content">\n    <div class="modal-header">\n      <div class="kv-zoom-actions pull-right">{toggleheader}{fullscreen}{borderless}{close}</div>\n      <h3 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h3>\n    </div>\n    <div class="modal-body">\n      <div class="floating-buttons"></div>\n      <div class="kv-zoom-body file-zoom-content"></div>\n{prev} {next}\n    </div>\n  </div>\n</div>\n', E = '<div class="progress">\n    <div class="{class}" role="progressbar" aria-valuenow="{percent}" aria-valuemin="0" aria-valuemax="100" style="width:{percent}%;">\n        {percent}%\n     </div>\n</div>', $ = " <br><samp>({sizeText})</samp>", S = '<div class="file-thumbnail-footer">\n    <div class="file-footer-caption" title="{caption}">{caption}{size}</div>\n    {progress} {actions}\n</div>', I = '<div class="file-actions">\n    <div class="file-footer-buttons">\n        {upload} {delete} {zoom} {other}    </div>\n    {drag}\n    <div class="file-upload-indicator" title="{indicatorTitle}">{indicator}</div>\n    <div class="clearfix"></div>\n</div>', P = '<button type="button" class="kv-file-remove {removeClass}" title="{removeTitle}" {dataUrl}{dataKey}>{removeIcon}</button>\n', D = '<button type="button" class="kv-file-upload {uploadClass}" title="{uploadTitle}">{uploadIcon}</button>', z = '<button type="button" class="kv-file-zoom {zoomClass}" title="{zoomTitle}">{zoomIcon}</button>', A = '<span class="file-drag-handle {dragClass}" title="{dragTitle}">{dragIcon}</span>', U = '<div class="file-preview-frame{frameClass}" id="{previewId}" data-fileindex="{fileindex}" data-template="{template}"', j = U + '><div class="kv-file-content">\n', L = U + ' title="{caption}" ' + a + '><div class="kv-file-content">\n', Z = "</div>{footer}\n</div>\n", B = "{content}\n", O = '<div class="kv-preview-data file-preview-html" title="{caption}" ' + a + ">{data}</div>\n", R = '<img src="{data}" class="kv-preview-data file-preview-image" title="{caption}" alt="{caption}" ' + a + ">\n", M = '<textarea class="kv-preview-data file-preview-text" title="{caption}" readonly ' + a + ">{data}</textarea>\n", N = '<video class="kv-preview-data" width="{width}" height="{height}" controls>\n<source src="{data}" type="{type}">\n' + r + "\n</video>\n", H = '<audio class="kv-preview-data" controls>\n<source src="{data}" type="{type}">\n' + r + "\n</audio>\n", q = '<object class="kv-preview-data file-object" type="application/x-shockwave-flash" width="{width}" height="{height}" data="{data}">\n' + n + " " + r + "\n</object>\n", W = '<object class="kv-preview-data file-object" data="{data}" type="{type}" width="{width}" height="{height}">\n<param name="movie" value="{caption}" />\n' + n + " " + r + "\n</object>\n", V = '<embed class="kv-preview-data" src="{data}" width="{width}" height="{height}" type="application/pdf">\n', K = '<div class="kv-preview-data file-preview-other-frame">\n' + r + "\n</div>\n", X = { main1: v, main2: h, preview: w, close: _, fileIcon: b, caption: C, modalMain: F, modal: k, progress: E, size: $, footer: S, actions: I, actionDelete: P, actionUpload: D, actionZoom: z, actionDrag: A, btnDefault: x, btnLink: y, btnBrowse: T }, Y = { generic: j + B + Z, html: j + O + Z, image: j + R + Z, text: j + M + Z, video: L + N + Z, audio: L + H + Z, flash: L + q + Z, object: L + W + Z, pdf: L + V + Z, other: L + K + Z }, Q = ["image", "html", "text", "video", "audio", "flash", "pdf", "object"], te = { image: { width: "auto", height: "160px" }, html: { width: "213px", height: "160px" }, text: { width: "213px", height: "160px" }, video: { width: "213px", height: "160px" }, audio: { width: "213px", height: "80px" }, flash: { width: "213px", height: "160px" }, object: { width: "160px", height: "160px" }, pdf: { width: "160px", height: "160px" }, other: { width: "160px", height: "160px" } }, J = { image: { width: "100%", height: "100%" }, html: { width: "100%", height: "100%", "min-height": "480px" }, text: { width: "100%", height: "100%", "min-height": "480px" }, video: { width: "auto", height: "100%", "max-width": "100%" }, audio: { width: "100%", height: "30px" }, flash: { width: "auto", height: "480px" }, object: { width: "auto", height: "100%", "min-height": "480px" }, pdf: { width: "100%", height: "100%", "min-height": "480px" }, other: { width: "auto", height: "100%", "min-height": "480px" } }, ie = { image: function image(e, t) {
            return o(e, "image.*") || o(t, /\.(gif|png|jpe?g)$/i);
        }, html: function html(e, t) {
            return o(e, "text/html") || o(t, /\.(htm|html)$/i);
        }, text: function text(e, t) {
            return o(e, "text.*") || o(t, /\.(xml|javascript)$/i) || o(t, /\.(txt|md|csv|nfo|ini|json|php|js|css)$/i);
        }, video: function video(e, t) {
            return o(e, "video.*") && (o(e, /(ogg|mp4|mp?g|webm|3gp)$/i) || o(t, /\.(og?|mp4|webm|mp?g|3gp)$/i));
        }, audio: function audio(e, t) {
            return o(e, "audio.*") && (o(t, /(ogg|mp3|mp?g|wav)$/i) || o(t, /\.(og?|mp3|mp?g|wav)$/i));
        }, flash: function flash(e, t) {
            return o(e, "application/x-shockwave-flash", !0) || o(t, /\.(swf)$/i);
        }, pdf: function pdf(e, t) {
            return o(e, "application/pdf", !0) || o(t, /\.(pdf)$/i);
        }, object: function object() {
            return !0;
        }, other: function other() {
            return !0;
        } }, ae = function ae(t, i) {
        return void 0 === t || null === t || 0 === t.length || i && "" === e.trim(t);
    }, ne = function ne(e) {
        return Array.isArray(e) || "[object Array]" === Object.prototype.toString.call(e);
    }, re = function re(e, t, i) {
        return i = i || "", t && "object" == (typeof t === "undefined" ? "undefined" : _typeof(t)) && e in t ? t[e] : i;
    }, ee = function ee(t, i, a) {
        return ae(t) || ae(t[i]) ? a : e(t[i]);
    }, le = function le() {
        return Math.round(new Date().getTime() + 100 * Math.random());
    }, oe = function oe(e) {
        return e.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&apos;");
    }, se = function se(t, i) {
        var a = t;return i ? (e.each(i, function (e, t) {
            "function" == typeof t && (t = t()), a = a.split(e).join(t);
        }), a) : a;
    }, de = function de(e) {
        var t = e.is("img") ? e.attr("src") : e.find("source").attr("src");l.revokeObjectURL(t);
    }, ce = function ce(e) {
        var t = e.lastIndexOf("/");return -1 === t && (t = e.lastIndexOf("\\")), e.split(e.substring(t, t + 1)).pop();
    }, pe = function pe() {
        return document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement;
    }, ue = function ue(e) {
        e && !pe() ? document.documentElement.requestFullscreen ? document.documentElement.requestFullscreen() : document.documentElement.msRequestFullscreen ? document.documentElement.msRequestFullscreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT) : document.exitFullscreen ? document.exitFullscreen() : document.msExitFullscreen ? document.msExitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitExitFullscreen && document.webkitExitFullscreen();
    }, fe = function fe(e, t, i) {
        if (i >= e.length) for (var a = i - e.length; a-- + 1;) {
            e.push(void 0);
        }return e.splice(i, 0, e.splice(t, 1)[0]), e;
    }, me = function me(t, i) {
        var a = this;a.$element = e(t), a._validate() && (a.isPreviewable = u(), a.isIE9 = s(9), a.isIE10 = s(10), a.isPreviewable || a.isIE9 ? (a._init(i), a._listen()) : a.$element.removeClass("file-loading"));
    }, me.prototype = { constructor: me, _init: function _init(t) {
            var i,
                a = this,
                n = a.$element;e.each(t, function (e, t) {
                switch (e) {case "minFileCount":case "maxFileCount":case "maxFileSize":
                        a[e] = p(t);break;default:
                        a[e] = t;}
            }), a.fileInputCleared = !1, a.fileBatchCompleted = !0, a.isPreviewable || (a.showPreview = !1), a.uploadFileAttr = ae(n.attr("name")) ? "file_data" : n.attr("name"), a.reader = null, a.formdata = {}, a.clearStack(), a.uploadCount = 0, a.uploadStatus = {}, a.uploadLog = [], a.uploadAsyncCount = 0, a.loadedImages = [], a.totalImagesCount = 0, a.ajaxRequests = [], a.isError = !1, a.ajaxAborted = !1, a.cancelling = !1, i = a._getLayoutTemplate("progress"), a.progressTemplate = i.replace("{class}", a.progressClass), a.progressCompleteTemplate = i.replace("{class}", a.progressCompleteClass), a.progressErrorTemplate = i.replace("{class}", a.progressErrorClass), a.dropZoneEnabled = f() && a.dropZoneEnabled, a.isDisabled = a.$element.attr("disabled") || a.$element.attr("readonly"), a.isUploadable = m() && !ae(a.uploadUrl), a.isClickable = a.browseOnZoneClick && a.showPreview && (a.isUploadable && a.dropZoneEnabled || !ae(a.defaultPreviewContent)), a.slug = "function" == typeof t.slugCallback ? t.slugCallback : a._slugDefault, a.mainTemplate = a.showCaption ? a._getLayoutTemplate("main1") : a._getLayoutTemplate("main2"), a.captionTemplate = a._getLayoutTemplate("caption"), a.previewGenericTemplate = a._getPreviewTemplate("generic"), a.resizeImage && (a.maxImageWidth || a.maxImageHeight) && (a.imageCanvas = document.createElement("canvas"), a.imageCanvasContext = a.imageCanvas.getContext("2d")), ae(a.$element.attr("id")) && a.$element.attr("id", le()), void 0 === a.$container ? a.$container = a._createContainer() : a._refreshContainer(), a.$dropZone = a.$container.find(".file-drop-zone"), a.$progress = a.$container.find(".kv-upload-progress"), a.$btnUpload = a.$container.find(".fileinput-upload"), a.$captionContainer = ee(t, "elCaptionContainer", a.$container.find(".file-caption")), a.$caption = ee(t, "elCaptionText", a.$container.find(".file-caption-name")), a.$previewContainer = ee(t, "elPreviewContainer", a.$container.find(".file-preview")), a.$preview = ee(t, "elPreviewImage", a.$container.find(".file-preview-thumbnails")), a.$previewStatus = ee(t, "elPreviewStatus", a.$container.find(".file-preview-status")), a.$errorContainer = ee(t, "elErrorContainer", a.$previewContainer.find(".kv-fileinput-error")), ae(a.msgErrorClass) || g(a.$errorContainer, a.msgErrorClass), a.$errorContainer.hide(), a.fileActionSettings = e.extend(!0, G, t.fileActionSettings), a.previewInitId = "preview-" + le(), a.id = a.$element.attr("id"), c.init(a), a._initPreview(!0), a._initPreviewActions(), a.options = t, a._setFileDropZoneTitle(), a.$element.removeClass("file-loading"), a.$element.attr("disabled") && a.disable(), a._initZoom();
        }, _validate: function _validate() {
            var e,
                t = this;return "file" === t.$element.attr("type") ? !0 : (e = '<div class="help-block alert alert-warning"><h4>Invalid Input Type</h4>You must set an input <code>type = file</code> for <b>bootstrap-fileinput</b> plugin to initialize.</div>', t.$element.after(e), !1);
        }, _errorsExist: function _errorsExist() {
            var t,
                i = this;return i.$errorContainer.find("li").length ? !0 : (t = e(document.createElement("div")).html(i.$errorContainer.html()), t.find("span.kv-error-close").remove(), t.find("ul").remove(), !!e.trim(t.text()).length);
        }, _errorHandler: function _errorHandler(e, t) {
            var i = this,
                a = e.target.error;a.code === a.NOT_FOUND_ERR ? i._showError(i.msgFileNotFound.replace("{name}", t)) : a.code === a.SECURITY_ERR ? i._showError(i.msgFileSecured.replace("{name}", t)) : a.code === a.NOT_READABLE_ERR ? i._showError(i.msgFileNotReadable.replace("{name}", t)) : a.code === a.ABORT_ERR ? i._showError(i.msgFilePreviewAborted.replace("{name}", t)) : i._showError(i.msgFilePreviewError.replace("{name}", t));
        }, _addError: function _addError(e) {
            var t = this,
                i = t.$errorContainer;e && i.length && (i.html(t.errorCloseButton + e), d(i.find(".kv-error-close"), "click", function () {
                i.fadeOut("slow");
            }));
        }, _resetErrors: function _resetErrors(e) {
            var t = this,
                i = t.$errorContainer;t.isError = !1, t.$container.removeClass("has-error"), i.html(""), e ? i.fadeOut("slow") : i.hide();
        }, _showFolderError: function _showFolderError(e) {
            var t,
                i = this,
                a = i.$errorContainer;e && (t = i.msgFoldersNotAllowed.replace(/\{n}/g, e), i._addError(t), g(i.$container, "has-error"), a.fadeIn(800), i._raise("filefoldererror", [e, t]));
        }, _showUploadError: function _showUploadError(e, t, i) {
            var a = this,
                n = a.$errorContainer,
                r = i || "fileuploaderror",
                l = t && t.id ? '<li data-file-id="' + t.id + '">' + e + "</li>" : "<li>" + e + "</li>";return 0 === n.find("ul").length ? a._addError("<ul>" + l + "</ul>") : n.find("ul").append(l), n.fadeIn(800), a._raise(r, [t, e]), a.$container.removeClass("file-input-new"), g(a.$container, "has-error"), !0;
        }, _showError: function _showError(e, t, i) {
            var a = this,
                n = a.$errorContainer,
                r = i || "fileerror";return t = t || {}, t.reader = a.reader, a._addError(e), n.fadeIn(800), a._raise(r, [t, e]), a.isUploadable || a._clearFileInput(), a.$container.removeClass("file-input-new"), g(a.$container, "has-error"), a.$btnUpload.attr("disabled", !0), !0;
        }, _noFilesError: function _noFilesError(e) {
            var t = this,
                i = t.minFileCount > 1 ? t.filePlural : t.fileSingle,
                a = t.msgFilesTooLess.replace("{n}", t.minFileCount).replace("{files}", i),
                n = t.$errorContainer;t._addError(a), t.isError = !0, t._updateFileDetails(0), n.fadeIn(800), t._raise("fileerror", [e, a]), t._clearFileInput(), g(t.$container, "has-error");
        }, _parseError: function _parseError(t, i, a) {
            var n = this,
                r = e.trim(i + ""),
                l = "." === r.slice(-1) ? "" : ".",
                o = void 0 !== t.responseJSON && void 0 !== t.responseJSON.error ? t.responseJSON.error : t.responseText;return n.cancelling && n.msgUploadAborted && (r = n.msgUploadAborted), n.showAjaxErrorDetails && o ? (o = e.trim(o.replace(/\n\s*\n/g, "\n")), o = o.length > 0 ? "<pre>" + o + "</pre>" : "", r += l + o) : r += l, n.cancelling = !1, a ? "<b>" + a + ": </b>" + r : r;
        }, _parseFileType: function _parseFileType(e) {
            var t,
                i,
                a,
                n,
                r = this;for (n = 0; n < Q.length; n += 1) {
                if (a = Q[n], t = re(a, r.fileTypeSettings, ie[a]), i = t(e.type, e.name) ? a : "", !ae(i)) return i;
            }return "other";
        }, _parseFilePreviewIcon: function _parseFilePreviewIcon(t, i) {
            var a,
                n,
                r = this,
                l = r.previewFileIcon;return i && i.indexOf(".") > -1 && (n = i.split(".").pop(), r.previewFileIconSettings && r.previewFileIconSettings[n] && (l = r.previewFileIconSettings[n]), r.previewFileExtSettings && e.each(r.previewFileExtSettings, function (e, t) {
                return r.previewFileIconSettings[e] && t(n) ? void (l = r.previewFileIconSettings[e]) : void (a = !0);
            })), t.indexOf("{previewFileIcon}") > -1 ? t.replace(/\{previewFileIconClass}/g, r.previewFileIconClass).replace(/\{previewFileIcon}/g, l) : t;
        }, _raise: function _raise(t, i) {
            var a = this,
                n = e.Event(t);if (void 0 !== i ? a.$element.trigger(n, i) : a.$element.trigger(n), n.isDefaultPrevented()) return !1;if (!n.result) return n.result;switch (t) {case "filebatchuploadcomplete":case "filebatchuploadsuccess":case "fileuploaded":case "fileclear":case "filecleared":case "filereset":case "fileerror":case "filefoldererror":case "fileuploaderror":case "filebatchuploaderror":case "filedeleteerror":case "filecustomerror":case "filesuccessremove":
                    break;default:
                    a.ajaxAborted = n.result;}return !0;
        }, _listenFullScreen: function _listenFullScreen(e) {
            var t,
                i,
                a = this,
                n = a.$modal;n && n.length && (t = n && n.find(".btn-fullscreen"), i = n && n.find(".btn-borderless"), t.length && i.length && (t.removeClass("active").attr("aria-pressed", "false"), i.removeClass("active").attr("aria-pressed", "false"), e ? t.addClass("active").attr("aria-pressed", "true") : i.addClass("active").attr("aria-pressed", "true"), n.hasClass("file-zoom-fullscreen") ? a._maximizeZoomDialog() : e ? a._maximizeZoomDialog() : i.removeClass("active").attr("aria-pressed", "false")));
        }, _listen: function _listen() {
            var t = this,
                i = t.$element,
                a = i.closest("form"),
                n = t.$container;d(i, "change", e.proxy(t._change, t)), t.showBrowse && d(t.$btnFile, "click", e.proxy(t._browse, t)), d(a, "reset", e.proxy(t.reset, t)), d(n.find(".fileinput-remove:not([disabled])"), "click", e.proxy(t.clear, t)), d(n.find(".fileinput-cancel"), "click", e.proxy(t.cancel, t)), t._initDragDrop(), t.isUploadable || d(a, "submit", e.proxy(t._submitForm, t)), d(t.$container.find(".fileinput-upload"), "click", e.proxy(t._uploadClick, t)), d(e(window), "resize", function () {
                t._listenFullScreen(screen.width === window.innerWidth && screen.height === window.innerHeight);
            }), d(e(document), "webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange", function () {
                t._listenFullScreen(pe());
            }), t._initClickable();
        }, _initClickable: function _initClickable() {
            var t,
                i = this;i.isClickable && (t = i.isUploadable ? i.$dropZone : i.$preview.find(".file-default-preview"), g(t, "clickable"), t.attr("tabindex", -1), d(t, "click", function (a) {
                var n = e(a.target);n.parents(".file-preview-thumbnails").length && !n.parents(".file-default-preview").length || (i.$element.trigger("click"), t.blur());
            }));
        }, _initDragDrop: function _initDragDrop() {
            var t = this,
                i = t.$dropZone;t.isUploadable && t.dropZoneEnabled && t.showPreview && (d(i, "dragenter dragover", e.proxy(t._zoneDragEnter, t)), d(i, "dragleave", e.proxy(t._zoneDragLeave, t)), d(i, "drop", e.proxy(t._zoneDrop, t)), d(e(document), "dragenter dragover drop", t._zoneDragDropInit));
        }, _zoneDragDropInit: function _zoneDragDropInit(e) {
            e.stopPropagation(), e.preventDefault();
        }, _zoneDragEnter: function _zoneDragEnter(t) {
            var i = this,
                a = e.inArray("Files", t.originalEvent.dataTransfer.types) > -1;return i._zoneDragDropInit(t), i.isDisabled || !a ? (t.originalEvent.dataTransfer.effectAllowed = "none", void (t.originalEvent.dataTransfer.dropEffect = "none")) : void g(i.$dropZone, "file-highlighted");
        }, _zoneDragLeave: function _zoneDragLeave(e) {
            var t = this;t._zoneDragDropInit(e), t.isDisabled || t.$dropZone.removeClass("file-highlighted");
        }, _zoneDrop: function _zoneDrop(e) {
            var t = this;e.preventDefault(), t.isDisabled || ae(e.originalEvent.dataTransfer.files) || (t._change(e, "dragdrop"), t.$dropZone.removeClass("file-highlighted"));
        }, _uploadClick: function _uploadClick(e) {
            var t,
                i = this,
                a = i.$container.find(".fileinput-upload"),
                n = !a.hasClass("disabled") && ae(a.attr("disabled"));if (!e || !e.isDefaultPrevented()) {
                if (!i.isUploadable) return void (n && "submit" !== a.attr("type") && (t = a.closest("form"), t.length && t.trigger("submit"), e.preventDefault()));e.preventDefault(), n && i.upload();
            }
        }, _submitForm: function _submitForm() {
            var e = this,
                t = e.$element,
                i = t.get(0).files;return i && e.minFileCount > 0 && e._getFileCount(i.length) < e.minFileCount ? (e._noFilesError({}), !1) : !e._abort({});
        }, _clearPreview: function _clearPreview() {
            var e = this,
                t = e.showUploadedThumbs ? e.$preview.find(".file-preview-frame:not(.file-preview-success)") : e.$preview.find(".file-preview-frame");t.remove(), e.$preview.find(".file-preview-frame").length && e.showPreview || e._resetUpload(), e._validateDefaultPreview();
        }, _initSortable: function _initSortable() {
            var t,
                i,
                a = this,
                n = a.$preview;window.Sortable && (t = n.find(".file-initial-thumbs"), i = { handle: ".drag-handle-init", dataIdAttr: "data-preview-id", draggable: ".file-preview-initial", onSort: function onSort(t) {
                    var i = t.oldIndex,
                        n = t.newIndex;a.initialPreview = fe(a.initialPreview, i, n), a.initialPreviewConfig = fe(a.initialPreviewConfig, i, n), c.init(a), a._raise("filesorted", { previewId: e(t.item).attr("id"), oldIndex: i, newIndex: n, stack: a.initialPreviewConfig });
                } }, t.data("sortable") && t.sortable("destroy"), e.extend(!0, i, a.fileActionSettings.dragSettings), t.sortable(i));
        }, _initPreview: function _initPreview(e) {
            var t,
                i = this,
                a = i.initialCaption || "";return c.count(i.id) ? (t = c.out(i.id), a = e && i.initialCaption ? i.initialCaption : t.caption, i.$preview.html(t.content), i._setCaption(a), i._initSortable(), void (ae(t.content) || i.$container.removeClass("file-input-new"))) : (i._clearPreview(), void (e ? i._setCaption(a) : i._initCaption()));
        }, _getZoomButton: function _getZoomButton(e) {
            var t = this,
                i = t.previewZoomButtonIcons[e],
                a = t.previewZoomButtonClasses[e],
                n = ' title="' + (t.previewZoomButtonTitles[e] || "") + '" ',
                r = n + ("close" === e ? ' data-dismiss="modal" aria-hidden="true"' : "");return "fullscreen" !== e && "borderless" !== e && "toggleheader" !== e || (r += ' data-toggle="button" aria-pressed="false" autocomplete="off"'), '<button type="button" class="' + a + " btn-" + e + '"' + r + ">" + i + "</button>";
        }, _getModalContent: function _getModalContent() {
            var e = this;return e._getLayoutTemplate("modal").replace(/\{heading}/g, e.msgZoomModalHeading).replace(/\{prev}/g, e._getZoomButton("prev")).replace(/\{next}/g, e._getZoomButton("next")).replace(/\{toggleheader}/g, e._getZoomButton("toggleheader")).replace(/\{fullscreen}/g, e._getZoomButton("fullscreen")).replace(/\{borderless}/g, e._getZoomButton("borderless")).replace(/\{close}/g, e._getZoomButton("close"));
        }, _listenModalEvent: function _listenModalEvent(e) {
            var t = this,
                i = t.$modal,
                a = function a(e) {
                return { sourceEvent: e, previewId: i.data("previewId"), modal: i };
            };i.on(e + ".bs.modal", function (n) {
                var r = i.find(".btn-fullscreen"),
                    l = i.find(".btn-borderless");t._raise("filezoom" + e, a(n)), "shown" === e && (l.removeClass("active").attr("aria-pressed", "false"), r.removeClass("active").attr("aria-pressed", "false"), i.hasClass("file-zoom-fullscreen") && (t._maximizeZoomDialog(), pe() ? r.addClass("active").attr("aria-pressed", "true") : l.addClass("active").attr("aria-pressed", "true")));
            });
        }, _initZoom: function _initZoom() {
            var t,
                a = this,
                n = a._getLayoutTemplate("modalMain"),
                r = "#" + i;a.$modal = e(r), a.$modal && a.$modal.length || (t = e(document.createElement("div")).html(n).insertAfter(a.$container), a.$modal = e("#" + i).insertBefore(t), t.remove()), a.$modal.html(a._getModalContent()), a._listenModalEvent("show"), a._listenModalEvent("shown"), a._listenModalEvent("hide"), a._listenModalEvent("hidden"), a._listenModalEvent("loaded");
        }, _initZoomButtons: function _initZoomButtons() {
            var t,
                i,
                a = this,
                n = a.$modal.data("previewId") || "",
                r = a.$preview.find(".file-preview-frame").toArray(),
                l = r.length,
                o = a.$modal.find(".btn-prev"),
                s = a.$modal.find(".btn-next");l && (t = e(r[0]), i = e(r[l - 1]), o.removeAttr("disabled"), s.removeAttr("disabled"), t.length && t.attr("id") === n && o.attr("disabled", !0), i.length && i.attr("id") === n && s.attr("disabled", !0));
        }, _maximizeZoomDialog: function _maximizeZoomDialog() {
            var t = this,
                i = t.$modal,
                a = i.find(".modal-header:visible"),
                n = i.find(".modal-footer:visible"),
                r = i.find(".modal-body"),
                l = e(window).height(),
                o = 0;i.addClass("file-zoom-fullscreen"), a && a.length && (l -= a.outerHeight(!0)), n && n.length && (l -= n.outerHeight(!0)), r && r.length && (o = r.outerHeight(!0) - r.height(), l -= o), i.find(".kv-zoom-body").height(l);
        }, _resizeZoomDialog: function _resizeZoomDialog(e) {
            var t = this,
                i = t.$modal,
                a = i.find(".btn-fullscreen"),
                n = i.find(".btn-borderless");if (i.hasClass("file-zoom-fullscreen")) ue(!1), e ? a.hasClass("active") || (i.removeClass("file-zoom-fullscreen"), t._resizeZoomDialog(!0), n.hasClass("active") && n.removeClass("active").attr("aria-pressed", "false")) : a.hasClass("active") ? a.removeClass("active").attr("aria-pressed", "false") : (i.removeClass("file-zoom-fullscreen"), t.$modal.find(".kv-zoom-body").css("height", t.zoomModalHeight));else {
                if (!e) return void t._maximizeZoomDialog();ue(!0);
            }i.focus();
        }, _setZoomContent: function _setZoomContent(t, i) {
            var a,
                n,
                r,
                l,
                o,
                s,
                c,
                p,
                u = this,
                f = t.attr("id"),
                m = u.$modal,
                v = m.find(".btn-prev"),
                h = m.find(".btn-next"),
                w = m.find(".btn-fullscreen"),
                b = m.find(".btn-borderless"),
                _ = m.find(".btn-toggleheader");n = t.data("template") || "generic", a = t.find(".kv-file-content"), r = a.length ? a.html() : "", l = t.find(".file-footer-caption").text() || "", m.find(".kv-zoom-title").html(l), o = m.find(".kv-zoom-body"), i ? (p = o.clone().insertAfter(o), o.html(r).hide(), p.fadeOut("fast", function () {
                o.fadeIn("fast"), p.remove();
            })) : o.html(r), c = u.previewZoomSettings[n], c && (s = o.find(".kv-preview-data"), g(s, "file-zoom-detail"), e.each(c, function (e, t) {
                s.css(e, t), (s.attr("width") && "width" === e || s.attr("height") && "height" === e) && s.removeAttr(e);
            })), m.data("previewId", f), d(v, "click", function () {
                u._zoomSlideShow("prev", f);
            }), d(h, "click", function () {
                u._zoomSlideShow("next", f);
            }), d(w, "click", function () {
                u._resizeZoomDialog(!0);
            }), d(b, "click", function () {
                u._resizeZoomDialog(!1);
            }), d(_, "click", function () {
                var e,
                    t = m.find(".modal-header"),
                    i = m.find(".modal-body .floating-buttons"),
                    a = t.find(".kv-zoom-actions"),
                    n = function n(e) {
                    var i = u.$modal.find(".kv-zoom-body"),
                        a = u.zoomModalHeight;m.hasClass("file-zoom-fullscreen") && (a = i.outerHeight(!0), e || (a -= t.outerHeight(!0))), i.css("height", e ? a + e : a);
                };t.is(":visible") ? (e = t.outerHeight(!0), t.slideUp("slow", function () {
                    a.find(".btn").appendTo(i), n(e);
                })) : (i.find(".btn").appendTo(a), t.slideDown("slow", function () {
                    n();
                })), m.focus();
            }), d(m, "keydown", function (e) {
                var t = e.which || e.keyCode;37 !== t || v.attr("disabled") || u._zoomSlideShow("prev", f), 39 !== t || h.attr("disabled") || u._zoomSlideShow("next", f);
            });
        }, _zoomPreview: function _zoomPreview(e) {
            var t,
                i = this;if (!e.length) throw "Cannot zoom to detailed preview!";i.$modal.html(i._getModalContent()), t = e.closest(".file-preview-frame"), i._setZoomContent(t), i.$modal.modal("show"), i._initZoomButtons();
        }, _zoomSlideShow: function _zoomSlideShow(t, i) {
            var a,
                n,
                r,
                l = this,
                o = l.$modal.find(".kv-zoom-actions .btn-" + t),
                s = l.$preview.find(".file-preview-frame").toArray(),
                d = s.length;if (!o.attr("disabled")) {
                for (n = 0; d > n; n++) {
                    if (e(s[n]).attr("id") === i) {
                        r = "prev" === t ? n - 1 : n + 1;break;
                    }
                }0 > r || r >= d || !s[r] || (a = e(s[r]), a.length && l._setZoomContent(a, !0), l._initZoomButtons(), l._raise("filezoom" + t, { previewId: i, modal: l.$modal }));
            }
        }, _initZoomButton: function _initZoomButton() {
            var t = this;t.$preview.find(".kv-file-zoom").each(function () {
                var i = e(this);d(i, "click", function () {
                    t._zoomPreview(i);
                });
            });
        }, _initPreviewActions: function _initPreviewActions() {
            var t = this,
                i = t.deleteExtraData || {},
                a = function a() {
                var e = t.isUploadable ? c.count(t.id) : t.$element.get(0).files.length;0 !== t.$preview.find(".kv-file-remove").length || e || (t.reset(), t.initialCaption = "");
            };t._initZoomButton(), t.$preview.find(".kv-file-remove").each(function () {
                var n = e(this),
                    r = n.data("url") || t.deleteUrl,
                    l = n.data("key");if (!ae(r) && void 0 !== l) {
                    var o,
                        s,
                        p,
                        u,
                        f = n.closest(".file-preview-frame"),
                        m = c.data[t.id],
                        v = f.data("fileindex");v = parseInt(v.replace("init_", "")), p = ae(m.config) && ae(m.config[v]) ? null : m.config[v], u = ae(p) || ae(p.extra) ? i : p.extra, "function" == typeof u && (u = u()), s = { id: n.attr("id"), key: l, extra: u }, o = e.extend(!0, {}, { url: r, type: "POST", dataType: "json", data: e.extend(!0, {}, { key: l }, u), beforeSend: function beforeSend(e) {
                            t.ajaxAborted = !1, t._raise("filepredelete", [l, e, u]), t.ajaxAborted ? e.abort() : (g(f, "file-uploading"), g(n, "disabled"));
                        }, success: function success(e, i, r) {
                            var o, d;return ae(e) || ae(e.error) ? (c.unset(t.id, v), o = c.count(t.id), d = o > 0 ? t._getMsgSelected(o) : "", t._raise("filedeleted", [l, r, u]), t._setCaption(d), f.removeClass("file-uploading").addClass("file-deleted"), void f.fadeOut("slow", function () {
                                t._clearObjects(f), f.remove(), a(), o || 0 !== t.getFileStack().length || (t._setCaption(""), t.reset());
                            })) : (s.jqXHR = r, s.response = e, t._showError(e.error, s, "filedeleteerror"), f.removeClass("file-uploading"), n.removeClass("disabled"), void a());
                        }, error: function error(e, i, n) {
                            var r = t._parseError(e, n);
                            s.jqXHR = e, s.response = {}, t._showError(r, s, "filedeleteerror"), f.removeClass("file-uploading"), a();
                        } }, t.ajaxDeleteSettings), d(n, "click", function () {
                        return t._validateMinCount() ? void e.ajax(o) : !1;
                    });
                }
            });
        }, _clearObjects: function _clearObjects(t) {
            t.find("video audio").each(function () {
                this.pause(), e(this).remove();
            }), t.find("img object div").each(function () {
                e(this).remove();
            });
        }, _clearFileInput: function _clearFileInput() {
            var t,
                i,
                a,
                n = this,
                r = n.$element;ae(r.val()) || (n.isIE9 || n.isIE10 ? (t = r.closest("form"), i = e(document.createElement("form")), a = e(document.createElement("div")), r.before(a), t.length ? t.after(i) : a.after(i), i.append(r).trigger("reset"), a.before(r).remove(), i.remove()) : r.val(""), n.fileInputCleared = !0);
        }, _resetUpload: function _resetUpload() {
            var e = this;e.uploadCache = { content: [], config: [], tags: [], append: !0 }, e.uploadCount = 0, e.uploadStatus = {}, e.uploadLog = [], e.uploadAsyncCount = 0, e.loadedImages = [], e.totalImagesCount = 0, e.$btnUpload.removeAttr("disabled"), e._setProgress(0), g(e.$progress, "hide"), e._resetErrors(!1), e.ajaxAborted = !1, e.ajaxRequests = [], e._resetCanvas();
        }, _resetCanvas: function _resetCanvas() {
            var e = this;e.canvas && e.imageCanvasContext && e.imageCanvasContext.clearRect(0, 0, e.canvas.width, e.canvas.height);
        }, _hasInitialPreview: function _hasInitialPreview() {
            var e = this;return !e.overwriteInitial && c.count(e.id);
        }, _resetPreview: function _resetPreview() {
            var e,
                t,
                i = this;c.count(i.id) ? (e = c.out(i.id), i.$preview.html(e.content), t = i.initialCaption ? i.initialCaption : e.caption, i._setCaption(t)) : (i._clearPreview(), i._initCaption()), i.showPreview && (i._initZoom(), i._initSortable());
        }, _clearDefaultPreview: function _clearDefaultPreview() {
            var e = this;e.$preview.find(".file-default-preview").remove();
        }, _validateDefaultPreview: function _validateDefaultPreview() {
            var e = this;e.showPreview && !ae(e.defaultPreviewContent) && (e.$preview.html('<div class="file-default-preview">' + e.defaultPreviewContent + "</div>"), e.$container.removeClass("file-input-new"), e._initClickable());
        }, _resetPreviewThumbs: function _resetPreviewThumbs(e) {
            var t,
                i = this;return e ? (i._clearPreview(), void i.clearStack()) : void (i._hasInitialPreview() ? (t = c.out(i.id), i.$preview.html(t.content), i._setCaption(t.caption), i._initPreviewActions()) : i._clearPreview());
        }, _getLayoutTemplate: function _getLayoutTemplate(e) {
            var t = this,
                i = re(e, t.layoutTemplates, X[e]);return ae(t.customLayoutTags) ? i : se(i, t.customLayoutTags);
        }, _getPreviewTemplate: function _getPreviewTemplate(e) {
            var t = this,
                i = re(e, t.previewTemplates, Y[e]);return ae(t.customPreviewTags) ? i : se(i, t.customPreviewTags);
        }, _getOutData: function _getOutData(e, t, i) {
            var a = this;return e = e || {}, t = t || {}, i = i || a.filestack.slice(0) || {}, { form: a.formdata, files: i, filenames: a.filenames, extra: a._getExtraData(), response: t, reader: a.reader, jqXHR: e };
        }, _getMsgSelected: function _getMsgSelected(e) {
            var t = this,
                i = 1 === e ? t.fileSingle : t.filePlural;return e > 0 ? t.msgSelected.replace("{n}", e).replace("{files}", i) : t.msgNoFilesSelected;
        }, _getThumbs: function _getThumbs(e) {
            return e = e || "", this.$preview.find(".file-preview-frame:not(.file-preview-initial)" + e);
        }, _getExtraData: function _getExtraData(e, t) {
            var i = this,
                a = i.uploadExtraData;return "function" == typeof i.uploadExtraData && (a = i.uploadExtraData(e, t)), a;
        }, _initXhr: function _initXhr(e, t, i) {
            var a = this;return e.upload && e.upload.addEventListener("progress", function (e) {
                var n = 0,
                    r = e.loaded || e.position,
                    l = e.total;e.lengthComputable && (n = Math.ceil(r / l * 100)), t ? a._setAsyncUploadStatus(t, n, i) : a._setProgress(Math.ceil(n));
            }, !1), e;
        }, _ajaxSubmit: function _ajaxSubmit(t, i, a, n, r, l) {
            var o,
                s = this;s._raise("filepreajax", [r, l]), s._uploadExtra(r, l), o = e.extend(!0, {}, { xhr: function xhr() {
                    var t = e.ajaxSettings.xhr();return s._initXhr(t, r, s.getFileStack().length);
                }, url: s.uploadUrl, type: "POST", dataType: "json", data: s.formdata, cache: !1, processData: !1, contentType: !1, beforeSend: t, success: i, complete: a, error: n }, s.ajaxSettings), s.ajaxRequests.push(e.ajax(o));
        }, _initUploadSuccess: function _initUploadSuccess(t, i, a) {
            var n,
                r,
                l,
                o,
                s,
                d,
                p,
                u,
                f = this;f.showPreview && "object" == (typeof t === "undefined" ? "undefined" : _typeof(t)) && !e.isEmptyObject(t) && void 0 !== t.initialPreview && t.initialPreview.length > 0 && (f.hasInitData = !0, s = t.initialPreview || [], d = t.initialPreviewConfig || [], p = t.initialPreviewThumbTags || [], n = !(void 0 !== t.append && !t.append), s.length > 0 && !ne(s) && (s = s.split(f.initialPreviewDelimiter)), f.overwriteInitial = !1, f.initialPreview.concat(s), f.initialPreviewThumbTags.concat(p), f.initialPreviewConfig.concat(d), void 0 !== i ? a ? (u = i.attr("data-fileindex"), f.uploadCache.content[u] = s[0], f.uploadCache.config[u] = d[0], f.uploadCache.tags[u] = p[0], f.uploadCache.append = n) : (l = c.add(f.id, s, d[0], p[0], n), r = c.get(f.id, l, !1), o = e(r).hide(), i.after(o).fadeOut("slow", function () {
                o.fadeIn("slow").css("display:inline-block"), f._initPreviewActions(), f._clearFileInput(), i.remove();
            })) : (c.set(f.id, s, d, p, n), f._initPreview(), f._initPreviewActions()));
        }, _initSuccessThumbs: function _initSuccessThumbs() {
            var t = this;t.showPreview && t._getThumbs(".file-preview-success").each(function () {
                var i = e(this),
                    a = i.find(".kv-file-remove");a.removeAttr("disabled"), d(a, "click", function () {
                    var e = t._raise("filesuccessremove", [i.attr("id"), i.data("fileindex")]);de(i), e !== !1 && i.fadeOut("slow", function () {
                        i.remove(), t.$preview.find(".file-preview-frame").length || t.reset();
                    });
                });
            });
        }, _checkAsyncComplete: function _checkAsyncComplete() {
            var t,
                i,
                a = this;for (i = 0; i < a.filestack.length; i++) {
                if (a.filestack[i] && (t = a.previewInitId + "-" + i, -1 === e.inArray(t, a.uploadLog))) return !1;
            }return a.uploadAsyncCount === a.uploadLog.length;
        }, _uploadExtra: function _uploadExtra(t, i) {
            var a = this,
                n = a._getExtraData(t, i);0 !== n.length && e.each(n, function (e, t) {
                a.formdata.append(e, t);
            });
        }, _uploadSingle: function _uploadSingle(t, i, a) {
            var n,
                r,
                l,
                o,
                s,
                d,
                p,
                u,
                f,
                m,
                v = this,
                h = v.getFileStack().length,
                w = new FormData(),
                b = v.previewInitId + "-" + t,
                _ = v.filestack.length > 0 || !e.isEmptyObject(v.uploadExtraData),
                C = { id: b, index: t };v.formdata = w, v.showPreview && (r = e("#" + b + ":not(.file-preview-initial)"), o = r.find(".kv-file-upload"), s = r.find(".kv-file-remove"), e("#" + b).find(".file-thumb-progress").removeClass("hide")), 0 === h || !_ || o && o.hasClass("disabled") || v._abort(C) || (m = function m(e, t) {
                v.updateStack(e, void 0), v.uploadLog.push(t), v._checkAsyncComplete() && (v.fileBatchCompleted = !0);
            }, l = function l() {
                var e = v.uploadCache;v.fileBatchCompleted && setTimeout(function () {
                    v.showPreview && (c.set(v.id, e.content, e.config, e.tags, e.append), v.hasInitData && (v._initPreview(), v._initPreviewActions())), v.unlock(), v._clearFileInput(), v._raise("filebatchuploadcomplete", [v.filestack, v._getExtraData()]), v.uploadCount = 0, v.uploadStatus = {}, v.uploadLog = [], v._setProgress(100);
                }, 100);
            }, d = function d(i) {
                n = v._getOutData(i), v.fileBatchCompleted = !1, v.showPreview && (r.hasClass("file-preview-success") || (v._setThumbStatus(r, "Loading"), g(r, "file-uploading")), o.attr("disabled", !0), s.attr("disabled", !0)), a || v.lock(), v._raise("filepreupload", [n, b, t]), e.extend(!0, C, n), v._abort(C) && (i.abort(), v._setProgressCancelled());
            }, p = function p(i, l, s) {
                n = v._getOutData(s, i), e.extend(!0, C, n), setTimeout(function () {
                    ae(i) || ae(i.error) ? (v.showPreview && (v._setThumbStatus(r, "Success"), o.hide(), v._initUploadSuccess(i, r, a)), v._raise("fileuploaded", [n, b, t]), a ? m(t, b) : v.updateStack(t, void 0)) : (v._showUploadError(i.error, C), v._setPreviewError(r, t), a && m(t, b));
                }, 100);
            }, u = function u() {
                setTimeout(function () {
                    v.showPreview && (o.removeAttr("disabled"), s.removeAttr("disabled"), r.removeClass("file-uploading")), a ? l() : (v.unlock(!1), v._clearFileInput()), v._initSuccessThumbs();
                }, 100);
            }, f = function f(n, l, o) {
                var s = v._parseError(n, o, a ? i[t].name : null);setTimeout(function () {
                    a && m(t, b), v.uploadStatus[b] = 100, v._setPreviewError(r, t), e.extend(!0, C, v._getOutData(n)), v._showUploadError(s, C);
                }, 100);
            }, w.append(v.uploadFileAttr, i[t], v.filenames[t]), w.append("file_id", t), v._ajaxSubmit(d, p, u, f, b, t));
        }, _uploadBatch: function _uploadBatch() {
            var t,
                i,
                a,
                n,
                r,
                l = this,
                o = l.filestack,
                s = o.length,
                d = {},
                c = l.filestack.length > 0 || !e.isEmptyObject(l.uploadExtraData);l.formdata = new FormData(), 0 !== s && c && !l._abort(d) && (r = function r() {
                e.each(o, function (e) {
                    l.updateStack(e, void 0);
                }), l._clearFileInput();
            }, t = function t(_t) {
                l.lock();var i = l._getOutData(_t);l.showPreview && l._getThumbs().each(function () {
                    var t = e(this),
                        i = t.find(".kv-file-upload"),
                        a = t.find(".kv-file-remove");t.hasClass("file-preview-success") || (l._setThumbStatus(t, "Loading"), g(t, "file-uploading")), i.attr("disabled", !0), a.attr("disabled", !0);
                }), l._raise("filebatchpreupload", [i]), l._abort(i) && (_t.abort(), l._setProgressCancelled());
            }, i = function i(t, _i, a) {
                var n = l._getOutData(a, t),
                    o = l._getThumbs(":not(.file-preview-error)"),
                    s = 0,
                    d = ae(t) || ae(t.errorkeys) ? [] : t.errorkeys;ae(t) || ae(t.error) ? (l._raise("filebatchuploadsuccess", [n]), r(), l.showPreview ? (o.each(function () {
                    var t = e(this),
                        i = t.find(".kv-file-upload");t.find(".kv-file-upload").hide(), l._setThumbStatus(t, "Success"), t.removeClass("file-uploading"), i.removeAttr("disabled");
                }), l._initUploadSuccess(t)) : l.reset()) : (l.showPreview && (o.each(function () {
                    var t = e(this),
                        i = t.find(".kv-file-remove"),
                        a = t.find(".kv-file-upload");return t.removeClass("file-uploading"), a.removeAttr("disabled"), i.removeAttr("disabled"), 0 === d.length ? void l._setPreviewError(t) : (-1 !== e.inArray(s, d) ? l._setPreviewError(t) : (t.find(".kv-file-upload").hide(), l._setThumbStatus(t, "Success"), l.updateStack(s, void 0)), void s++);
                }), l._initUploadSuccess(t)), l._showUploadError(t.error, n, "filebatchuploaderror"));
            }, n = function n() {
                l._setProgress(100), l.unlock(), l._initSuccessThumbs(), l._clearFileInput(), l._raise("filebatchuploadcomplete", [l.filestack, l._getExtraData()]);
            }, a = function a(t, i, _a) {
                var n = l._getOutData(t),
                    r = l._parseError(t, _a);l._showUploadError(r, n, "filebatchuploaderror"), l.uploadFileCount = s - 1, l.showPreview && (l._getThumbs().each(function () {
                    var t = e(this),
                        i = t.attr("data-fileindex");t.removeClass("file-uploading"), void 0 !== l.filestack[i] && l._setPreviewError(t);
                }), l._getThumbs().removeClass("file-uploading"), l._getThumbs(" .kv-file-upload").removeAttr("disabled"), l._getThumbs(" .kv-file-delete").removeAttr("disabled"));
            }, e.each(o, function (e, t) {
                ae(o[e]) || l.formdata.append(l.uploadFileAttr, t, l.filenames[e]);
            }), l._ajaxSubmit(t, i, n, a));
        }, _uploadExtraOnly: function _uploadExtraOnly() {
            var e,
                t,
                i,
                a,
                n = this,
                r = {};n.formdata = new FormData(), n._abort(r) || (e = function e(_e) {
                n.lock();var t = n._getOutData(_e);n._raise("filebatchpreupload", [t]), n._setProgress(50), r.data = t, r.xhr = _e, n._abort(r) && (_e.abort(), n._setProgressCancelled());
            }, t = function t(e, _t2, i) {
                var a = n._getOutData(i, e);ae(e) || ae(e.error) ? (n._raise("filebatchuploadsuccess", [a]), n._clearFileInput(), n._initUploadSuccess(e)) : n._showUploadError(e.error, a, "filebatchuploaderror");
            }, i = function i() {
                n._setProgress(100), n.unlock(), n._clearFileInput(), n._raise("filebatchuploadcomplete", [n.filestack, n._getExtraData()]);
            }, a = function a(e, t, i) {
                var a = n._getOutData(e),
                    l = n._parseError(e, i);r.data = a, n._showUploadError(l, a, "filebatchuploaderror");
            }, n._ajaxSubmit(e, t, i, a));
        }, _initFileActions: function _initFileActions() {
            var t = this;t.showPreview && (t._initZoomButton(), t.$preview.find(".kv-file-remove").each(function () {
                var i,
                    a,
                    n,
                    r,
                    l = e(this),
                    o = l.closest(".file-preview-frame"),
                    s = o.attr("id"),
                    p = o.attr("data-fileindex");d(l, "click", function () {
                    return r = t._raise("filepreremove", [s, p]), r !== !1 && t._validateMinCount() ? (i = o.hasClass("file-preview-error"), de(o), void o.fadeOut("slow", function () {
                        t.updateStack(p, void 0), t._clearObjects(o), o.remove(), s && i && t.$errorContainer.find('li[data-file-id="' + s + '"]').fadeOut("fast", function () {
                            e(this).remove(), t._errorsExist() || t._resetErrors();
                        }), t._clearFileInput();var r = t.getFileStack(!0),
                            l = c.count(t.id),
                            d = r.length,
                            u = t.showPreview && t.$preview.find(".file-preview-frame").length;0 !== d || 0 !== l || u ? (a = l + d, n = a > 1 ? t._getMsgSelected(a) : r[0] ? t._getFileNames()[0] : "", t._setCaption(n)) : t.reset(), t._raise("fileremoved", [s, p]);
                    })) : !1;
                });
            }), t.$preview.find(".kv-file-upload").each(function () {
                var i = e(this);d(i, "click", function () {
                    var e = i.closest(".file-preview-frame"),
                        a = e.attr("data-fileindex");e.hasClass("file-preview-error") || t._uploadSingle(a, t.filestack, !1);
                });
            }));
        }, _hideFileIcon: function _hideFileIcon() {
            this.overwriteInitial && this.$captionContainer.find(".kv-caption-icon").hide();
        }, _showFileIcon: function _showFileIcon() {
            this.$captionContainer.find(".kv-caption-icon").show();
        }, _getSize: function _getSize(e) {
            var t = parseFloat(e);if (null === e || isNaN(t)) return "";var i,
                a,
                n,
                r = this,
                l = r.fileSizeGetter;return "function" == typeof l ? n = l(e) : (i = Math.floor(Math.log(t) / Math.log(1024)), a = ["B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"], n = 1 * (t / Math.pow(1024, i)).toFixed(2) + " " + a[i]), r._getLayoutTemplate("size").replace("{sizeText}", n);
        }, _generatePreviewTemplate: function _generatePreviewTemplate(e, t, i, a, n, r, l, o, s, d) {
            var c,
                p,
                u = this,
                f = u._getPreviewTemplate(e),
                m = o || "",
                g = re(e, u.previewSettings, te[e]),
                v = u.slug(i),
                h = s || u._renderFileFooter(v, l, g.width, r);return d = d || n.slice(n.lastIndexOf("-") + 1), f = u._parseFilePreviewIcon(f, i), "text" === e || "html" === e ? (p = "text" === e ? oe(t) : t, c = f.replace(/\{previewId}/g, n).replace(/\{caption}/g, v).replace(/\{width}/g, g.width).replace(/\{height}/g, g.height).replace(/\{frameClass}/g, m).replace(/\{cat}/g, a).replace(/\{footer}/g, h).replace(/\{fileindex}/g, d).replace(/\{data}/g, p).replace(/\{template}/g, e)) : c = f.replace(/\{previewId}/g, n).replace(/\{caption}/g, v).replace(/\{frameClass}/g, m).replace(/\{type}/g, a).replace(/\{fileindex}/g, d).replace(/\{width}/g, g.width).replace(/\{height}/g, g.height).replace(/\{footer}/g, h).replace(/\{data}/g, t).replace(/\{template}/g, e), c;
        }, _previewDefault: function _previewDefault(t, i, a) {
            var n = this,
                r = n.$preview,
                o = r.find(".file-live-thumbs");if (n.showPreview) {
                var s,
                    d = t ? t.name : "",
                    c = t ? t.type : "",
                    p = a === !0 && !n.isUploadable,
                    u = l.createObjectURL(t);n._clearDefaultPreview(), s = n._generatePreviewTemplate("other", u, d, c, i, p, t.size), o.length || (o = e(document.createElement("div")).addClass("file-live-thumbs").appendTo(r)), o.append("\n" + s), a === !0 && n.isUploadable && n._setThumbStatus(e("#" + i), "Error");
            }
        }, _previewFile: function _previewFile(t, i, a, n, r) {
            if (this.showPreview) {
                var l,
                    o = this,
                    s = o._parseFileType(i),
                    d = i ? i.name : "",
                    c = o.slug(d),
                    p = o.allowedPreviewTypes,
                    u = o.allowedPreviewMimeTypes,
                    f = o.$preview,
                    m = p && p.indexOf(s) >= 0,
                    g = f.find(".file-live-thumbs"),
                    v = "text" === s || "html" === s || "image" === s ? a.target.result : r,
                    h = u && -1 !== u.indexOf(i.type);g.length || (g = e(document.createElement("div")).addClass("file-live-thumbs").appendTo(f)), "html" === s && o.purifyHtml && window.DOMPurify && (v = window.DOMPurify.sanitize(v)), m || h ? (l = o._generatePreviewTemplate(s, v, d, i.type, n, !1, i.size), o._clearDefaultPreview(), g.append("\n" + l), o._validateImage(t, n, c, i.type)) : o._previewDefault(i, n), o._initSortable();
            }
        }, _slugDefault: function _slugDefault(e) {
            return ae(e) ? "" : String(e).replace(/[\-\[\]\/\{}:;#%=\(\)\*\+\?\\\^\$\|<>&"']/g, "_");
        }, _readFiles: function _readFiles(t) {
            this.reader = new FileReader();var _i2,
                a = this,
                n = a.$element,
                r = a.$preview,
                s = a.reader,
                d = a.$previewContainer,
                c = a.$previewStatus,
                p = a.msgLoading,
                u = a.msgProgress,
                f = a.previewInitId,
                m = t.length,
                g = a.fileTypeSettings,
                v = a.filestack.length,
                h = a.maxFilePreviewSize && parseFloat(a.maxFilePreviewSize),
                w = r.length && (!h || isNaN(h)),
                b = function b(n, r, l, o) {
                var s = e.extend(!0, {}, a._getOutData({}, {}, t), { id: l, index: o }),
                    d = { id: l, index: o, file: r, files: t };return a._previewDefault(r, l, !0), a.isUploadable && a.addToStack(void 0), setTimeout(function () {
                    _i2(o + 1);
                }, 100), a._initFileActions(), a.removeFromPreviewOnError && e("#" + l).remove(), a.isUploadable ? a._showUploadError(n, s) : a._showError(n, d);
            };a.loadedImages = [], a.totalImagesCount = 0, e.each(t, function (e, t) {
                var i = a.fileTypeSettings.image || ie.image;i && i(t.type) && a.totalImagesCount++;
            }), _i2 = function i(e) {
                if (ae(n.attr("multiple")) && (m = 1), e >= m) return a.isUploadable && a.filestack.length > 0 ? a._raise("filebatchselected", [a.getFileStack()]) : a._raise("filebatchselected", [t]), d.removeClass("file-thumb-loading"), void c.html("");var _,
                    C,
                    x,
                    y,
                    T,
                    F,
                    k,
                    E = v + e,
                    $ = f + "-" + E,
                    S = t[e],
                    I = a.slug(S.name),
                    P = (S.size || 0) / 1e3,
                    D = "",
                    z = l.createObjectURL(S),
                    A = 0,
                    U = a.allowedFileTypes,
                    j = ae(U) ? "" : U.join(", "),
                    L = a.allowedFileExtensions,
                    Z = ae(L) ? "" : L.join(", ");if (ae(L) || (D = new RegExp("\\.(" + L.join("|") + ")$", "i")), P = P.toFixed(2), a.maxFileSize > 0 && P > a.maxFileSize) return T = a.msgSizeTooLarge.replace("{name}", I).replace("{size}", P).replace("{maxSize}", a.maxFileSize), void (a.isError = b(T, S, $, e));if (!ae(U) && ne(U)) {
                    for (y = 0; y < U.length; y += 1) {
                        F = U[y], x = g[F], k = void 0 !== x && x(S.type, I), A += ae(k) ? 0 : k.length;
                    }if (0 === A) return T = a.msgInvalidFileType.replace("{name}", I).replace("{types}", j), void (a.isError = b(T, S, $, e));
                }return 0 !== A || ae(L) || !ne(L) || ae(D) || (k = o(I, D), A += ae(k) ? 0 : k.length, 0 !== A) ? a.showPreview ? !w && P > h ? (a.addToStack(S), d.addClass("file-thumb-loading"), a._previewDefault(S, $), a._initFileActions(), a._updateFileDetails(m), void _i2(e + 1)) : (r.length && void 0 !== FileReader ? (c.html(p.replace("{index}", e + 1).replace("{files}", m)), d.addClass("file-thumb-loading"), s.onerror = function (e) {
                    a._errorHandler(e, I);
                }, s.onload = function (t) {
                    a._previewFile(e, S, t, $, z), a._initFileActions();
                }, s.onloadend = function () {
                    T = u.replace("{index}", e + 1).replace("{files}", m).replace("{percent}", 50).replace("{name}", I), setTimeout(function () {
                        c.html(T), a._updateFileDetails(m), _i2(e + 1);
                    }, 100), a._raise("fileloaded", [S, $, e, s]);
                }, s.onprogress = function (t) {
                    if (t.lengthComputable) {
                        var i = t.loaded / t.total * 100,
                            a = Math.ceil(i);T = u.replace("{index}", e + 1).replace("{files}", m).replace("{percent}", a).replace("{name}", I), setTimeout(function () {
                            c.html(T);
                        }, 100);
                    }
                }, _ = re("text", g, ie.text), C = re("image", g, ie.image), _(S.type, I) ? s.readAsText(S, a.textEncoding) : C(S.type, I) ? s.readAsDataURL(S) : s.readAsArrayBuffer(S)) : (a._previewDefault(S, $), setTimeout(function () {
                    _i2(e + 1), a._updateFileDetails(m);
                }, 100), a._raise("fileloaded", [S, $, e, s])), void a.addToStack(S)) : (a.addToStack(S), setTimeout(function () {
                    _i2(e + 1);
                }, 100), void a._raise("fileloaded", [S, $, e, s])) : (T = a.msgInvalidFileExtension.replace("{name}", I).replace("{extensions}", Z), void (a.isError = b(T, S, $, e)));
            }, _i2(0), a._updateFileDetails(m, !1);
        }, _updateFileDetails: function _updateFileDetails(e) {
            var t = this,
                i = t.$element,
                a = t.getFileStack(),
                n = s(9) && ce(i.val()) || i[0].files[0] && i[0].files[0].name || a.length && a[0].name || "",
                r = t.slug(n),
                l = t.isUploadable ? a.length : e,
                o = c.count(t.id) + l,
                d = l > 1 ? t._getMsgSelected(o) : r;t.isError ? (t.$previewContainer.removeClass("file-thumb-loading"), t.$previewStatus.html(""), t.$captionContainer.find(".kv-caption-icon").hide()) : t._showFileIcon(), t._setCaption(d, t.isError), t.$container.removeClass("file-input-new file-input-ajax-new"), 1 === arguments.length && t._raise("fileselect", [e, r]), c.count(t.id) && t._initPreviewActions();
        }, _setThumbStatus: function _setThumbStatus(e, t) {
            var i = this;if (i.showPreview) {
                var a = "indicator" + t,
                    n = a + "Title",
                    r = "file-preview-" + t.toLowerCase(),
                    l = e.find(".file-upload-indicator"),
                    o = i.fileActionSettings;e.removeClass("file-preview-success file-preview-error file-preview-loading"), "Error" === t && e.find(".kv-file-upload").attr("disabled", !0), "Success" === t && (e.find(".file-drag-handle").remove(), l.css("margin-left", 0)), l.html(o[a]), l.attr("title", o[n]), e.addClass(r);
            }
        }, _setProgressCancelled: function _setProgressCancelled() {
            var e = this;e._setProgress(100, e.$progress, e.msgCancelled);
        }, _setProgress: function _setProgress(e, t, i) {
            var a = this,
                n = Math.min(e, 100),
                r = 100 > n ? a.progressTemplate : i ? a.progressErrorTemplate : a.progressCompleteTemplate;t = t || a.$progress, ae(r) || (t.html(r.replace(/\{percent}/g, n)), i && t.find('[role="progressbar"]').html(i));
        }, _setFileDropZoneTitle: function _setFileDropZoneTitle() {
            var e,
                t = this,
                i = t.$container.find(".file-drop-zone"),
                a = t.dropZoneTitle;t.isClickable && (e = ae(t.$element.attr("multiple")) ? t.fileSingle : t.filePlural, a += t.dropZoneClickTitle.replace("{files}", e)), i.find("." + t.dropZoneTitleClass).remove(), t.isUploadable && t.showPreview && 0 !== i.length && !(t.getFileStack().length > 0) && t.dropZoneEnabled && (0 === i.find(".file-preview-frame").length && ae(t.defaultPreviewContent) && i.prepend('<div class="' + t.dropZoneTitleClass + '">' + a + "</div>"), t.$container.removeClass("file-input-new"), g(t.$container, "file-input-ajax-new"));
        }, _setAsyncUploadStatus: function _setAsyncUploadStatus(t, i, a) {
            var n = this,
                r = 0;n._setProgress(i, e("#" + t).find(".file-thumb-progress")), n.uploadStatus[t] = i, e.each(n.uploadStatus, function (e, t) {
                r += t;
            }), n._setProgress(Math.ceil(r / a));
        }, _validateMinCount: function _validateMinCount() {
            var e = this,
                t = e.isUploadable ? e.getFileStack().length : e.$element.get(0).files.length;return e.validateInitialCount && e.minFileCount > 0 && e._getFileCount(t - 1) < e.minFileCount ? (e._noFilesError({}), !1) : !0;
        }, _getFileCount: function _getFileCount(e) {
            var t = this,
                i = 0;return t.validateInitialCount && !t.overwriteInitial && (i = c.count(t.id), e += i), e;
        }, _getFileName: function _getFileName(e) {
            return e && e.name ? this.slug(e.name) : void 0;
        }, _getFileNames: function _getFileNames(e) {
            var t = this;return t.filenames.filter(function (t) {
                return e ? void 0 !== t : void 0 !== t && null !== t;
            });
        }, _setPreviewError: function _setPreviewError(e, t, i) {
            var a = this;void 0 !== t && a.updateStack(t, i), a.removeFromPreviewOnError ? e.remove() : a._setThumbStatus(e, "Error");
        }, _checkDimensions: function _checkDimensions(e, t, i, a, n, r, l) {
            var o,
                s,
                d,
                c,
                p = this,
                u = "Small" === t ? "min" : "max",
                f = p[u + "Image" + r];!ae(f) && i.length && (d = i[0], s = "Width" === r ? d.naturalWidth || d.width : d.naturalHeight || d.height, c = "Small" === t ? s >= f : f >= s, c || (o = p["msgImage" + r + t].replace("{name}", n).replace("{size}", f), p._showUploadError(o, l), p._setPreviewError(a, e, null)));
        }, _validateImage: function _validateImage(e, t, i, a) {
            var n,
                r,
                o,
                s = this,
                c = s.$preview,
                p = c.find("#" + t),
                u = p.find("img");i = i || "Untitled", u.length && d(u, "load", function () {
                r = p.width(), o = c.width(), r > o && (u.css("width", "100%"), p.css("width", "97%")), n = { ind: e, id: t }, s._checkDimensions(e, "Small", u, p, i, "Width", n), s._checkDimensions(e, "Small", u, p, i, "Height", n), s.resizeImage || (s._checkDimensions(e, "Large", u, p, i, "Width", n), s._checkDimensions(e, "Large", u, p, i, "Height", n)), s._raise("fileimageloaded", [t]), s.loadedImages.push({ ind: e, img: u, thumb: p, pid: t, typ: a }), s._validateAllImages(), l.revokeObjectURL(u.attr("src"));
            });
        }, _validateAllImages: function _validateAllImages() {
            var e,
                t,
                i,
                a,
                n,
                r,
                l,
                o = this,
                s = {};if (o.loadedImages.length === o.totalImagesCount && (o._raise("fileimagesloaded"), o.resizeImage)) {
                for (l = o.isUploadable ? o._showUploadError : o._showError, e = 0; e < o.loadedImages.length; e++) {
                    t = o.loadedImages[e], i = t.img, a = t.thumb, n = t.pid, r = t.ind, s = { id: n, index: r }, o._getResizedImage(i[0], t.typ, n, r) || (l(o.msgImageResizeError, s, "fileimageresizeerror"), o._setPreviewError(a, r));
                }o._raise("fileimagesresized");
            }
        }, _getResizedImage: function _getResizedImage(e, t, i, a) {
            var n,
                r,
                l = this,
                o = e.naturalWidth,
                s = e.naturalHeight,
                d = 1,
                c = l.maxImageWidth || o,
                p = l.maxImageHeight || s,
                u = o && s,
                f = l.imageCanvas,
                m = l.imageCanvasContext;if (!u) return !1;if (o === c && s === p) return !0;t = t || l.resizeDefaultImageType, n = o > c, r = s > p, d = "width" === l.resizePreference ? n ? c / o : r ? p / s : 1 : r ? p / s : n ? c / o : 1, l._resetCanvas(), o *= d, s *= d, f.width = o, f.height = s;try {
                return m.drawImage(e, 0, 0, o, s), f.toBlob(function (e) {
                    l._raise("fileimageresized", [i, a]), l.filestack[a] = e;
                }, t, l.resizeQuality), !0;
            } catch (g) {
                return !1;
            }
        }, _initBrowse: function _initBrowse(e) {
            var t = this;t.showBrowse ? (t.$btnFile = e.find(".btn-file"), t.$btnFile.append(t.$element)) : t.$element.hide();
        }, _initCaption: function _initCaption() {
            var e = this,
                t = e.initialCaption || "";return e.overwriteInitial || ae(t) ? (e.$caption.html(""), !1) : (e._setCaption(t), !0);
        }, _setCaption: function _setCaption(t, i) {
            var a,
                n,
                r,
                l,
                o = this,
                s = o.getFileStack();if (o.$caption.length) {
                if (i) a = e("<div>" + o.msgValidationError + "</div>").text(), r = s.length, l = r ? 1 === r && s[0] ? o._getFileNames()[0] : o._getMsgSelected(r) : o._getMsgSelected(o.msgNo), n = '<span class="' + o.msgValidationErrorClass + '">' + o.msgValidationErrorIcon + (ae(t) ? l : t) + "</span>";else {
                    if (ae(t)) return;a = e("<div>" + t + "</div>").text(), n = o._getLayoutTemplate("fileIcon") + a;
                }o.$caption.html(n), o.$caption.attr("title", a), o.$captionContainer.find(".file-caption-ellipsis").attr("title", a);
            }
        }, _createContainer: function _createContainer() {
            var t = this,
                i = e(document.createElement("div")).attr({ "class": "file-input file-input-new" }).html(t._renderMain());return t.$element.before(i), t._initBrowse(i), t.theme && i.addClass("theme-" + t.theme), i;
        }, _refreshContainer: function _refreshContainer() {
            var e = this,
                t = e.$container;t.before(e.$element), t.html(e._renderMain()), e._initBrowse(t);
        }, _renderMain: function _renderMain() {
            var e = this,
                t = e.isUploadable && e.dropZoneEnabled ? " file-drop-zone" : "file-drop-disabled",
                i = e.showClose ? e._getLayoutTemplate("close") : "",
                a = e.showPreview ? e._getLayoutTemplate("preview").replace(/\{class}/g, e.previewClass).replace(/\{dropClass}/g, t) : "",
                n = e.isDisabled ? e.captionClass + " file-caption-disabled" : e.captionClass,
                r = e.captionTemplate.replace(/\{class}/g, n + " kv-fileinput-caption");return e.mainTemplate.replace(/\{class}/g, e.mainClass + (!e.showBrowse && e.showCaption ? " no-browse" : "")).replace(/\{preview}/g, a).replace(/\{close}/g, i).replace(/\{caption}/g, r).replace(/\{upload}/g, e._renderButton("upload")).replace(/\{remove}/g, e._renderButton("remove")).replace(/\{cancel}/g, e._renderButton("cancel")).replace(/\{browse}/g, e._renderButton("browse"));
        }, _renderButton: function _renderButton(e) {
            var t = this,
                i = t._getLayoutTemplate("btnDefault"),
                a = t[e + "Class"],
                n = t[e + "Title"],
                r = t[e + "Icon"],
                l = t[e + "Label"],
                o = t.isDisabled ? " disabled" : "",
                s = "button";switch (e) {case "remove":
                    if (!t.showRemove) return "";break;case "cancel":
                    if (!t.showCancel) return "";a += " hide";break;case "upload":
                    if (!t.showUpload) return "";t.isUploadable && !t.isDisabled ? i = t._getLayoutTemplate("btnLink").replace("{href}", t.uploadUrl) : s = "submit";break;case "browse":
                    if (!t.showBrowse) return "";i = t._getLayoutTemplate("btnBrowse");break;default:
                    return "";}return a += "browse" === e ? " btn-file" : " fileinput-" + e + " fileinput-" + e + "-button", ae(l) || (l = ' <span class="' + t.buttonLabelClass + '">' + l + "</span>"), i.replace("{type}", s).replace("{css}", a).replace("{title}", n).replace("{status}", o).replace("{icon}", r).replace("{label}", l);
        }, _renderThumbProgress: function _renderThumbProgress() {
            return '<div class="file-thumb-progress hide">' + this.progressTemplate.replace(/\{percent}/g, "0") + "</div>";
        }, _renderFileFooter: function _renderFileFooter(e, t, i, a) {
            var n,
                r = this,
                l = r.fileActionSettings,
                o = l.showRemove,
                s = l.showDrag,
                d = l.showUpload,
                c = l.showZoom,
                p = r._getLayoutTemplate("footer"),
                u = a ? l.indicatorError : l.indicatorNew,
                f = a ? l.indicatorErrorTitle : l.indicatorNewTitle;return t = r._getSize(t), n = r.isUploadable ? p.replace(/\{actions}/g, r._renderFileActions(d, o, c, s, !1, !1, !1)).replace(/\{caption}/g, e).replace(/\{size}/g, t).replace(/\{width}/g, i).replace(/\{progress}/g, r._renderThumbProgress()).replace(/\{indicator}/g, u).replace(/\{indicatorTitle}/g, f) : p.replace(/\{actions}/g, r._renderFileActions(!1, !1, c, s, !1, !1, !1)).replace(/\{caption}/g, e).replace(/\{size}/g, t).replace(/\{width}/g, i).replace(/\{progress}/g, "").replace(/\{indicator}/g, u).replace(/\{indicatorTitle}/g, f), n = se(n, r.previewThumbTags);
        }, _renderFileActions: function _renderFileActions(e, t, i, a, n, r, l, o) {
            if (!(e || t || i || a)) return "";var s,
                d = this,
                c = r === !1 ? "" : ' data-url="' + r + '"',
                p = l === !1 ? "" : ' data-key="' + l + '"',
                u = "",
                f = "",
                m = "",
                g = "",
                v = d._getLayoutTemplate("actions"),
                h = d.fileActionSettings,
                w = d.otherActionButtons.replace(/\{dataKey}/g, p),
                b = n ? h.removeClass + " disabled" : h.removeClass;return t && (u = d._getLayoutTemplate("actionDelete").replace(/\{removeClass}/g, b).replace(/\{removeIcon}/g, h.removeIcon).replace(/\{removeTitle}/g, h.removeTitle).replace(/\{dataUrl}/g, c).replace(/\{dataKey}/g, p)), e && (f = d._getLayoutTemplate("actionUpload").replace(/\{uploadClass}/g, h.uploadClass).replace(/\{uploadIcon}/g, h.uploadIcon).replace(/\{uploadTitle}/g, h.uploadTitle)), i && (m = d._getLayoutTemplate("actionZoom").replace(/\{zoomClass}/g, h.zoomClass).replace(/\{zoomIcon}/g, h.zoomIcon).replace(/\{zoomTitle}/g, h.zoomTitle)), a && o && (s = "drag-handle-init " + h.dragClass, g = d._getLayoutTemplate("actionDrag").replace(/\{dragClass}/g, s).replace(/\{dragTitle}/g, h.dragTitle).replace(/\{dragIcon}/g, h.dragIcon)), v.replace(/\{delete}/g, u).replace(/\{upload}/g, f).replace(/\{zoom}/g, m).replace(/\{drag}/g, g).replace(/\{other}/g, w);
        }, _browse: function _browse(e) {
            var t = this;t._raise("filebrowse"), e && e.isDefaultPrevented() || (t.isError && !t.isUploadable && t.clear(), t.$captionContainer.focus());
        }, _change: function _change(t) {
            var i = this,
                a = i.$element;if (!i.isUploadable && ae(a.val()) && i.fileInputCleared) return void (i.fileInputCleared = !1);i.fileInputCleared = !1;var n,
                r,
                l,
                o,
                s,
                d,
                p = arguments.length > 1,
                u = i.isUploadable,
                f = 0,
                m = p ? t.originalEvent.dataTransfer.files : a.get(0).files,
                g = i.filestack.length,
                v = ae(a.attr("multiple")),
                h = v && g > 0,
                w = 0,
                b = function b(t, a, n, r) {
                var l = e.extend(!0, {}, i._getOutData({}, {}, m), { id: n, index: r }),
                    o = { id: n, index: r, file: a, files: m };return i.isUploadable ? i._showUploadError(t, l) : i._showError(t, o);
            };if (i.reader = null, i._resetUpload(), i._hideFileIcon(), i.isUploadable && i.$container.find(".file-drop-zone ." + i.dropZoneTitleClass).remove(), p) for (n = []; m[f];) {
                o = m[f], o.type || o.size % 4096 !== 0 ? n.push(o) : w++, f++;
            } else n = void 0 === t.target.files ? t.target && t.target.value ? [{ name: t.target.value.replace(/^.+\\/, "") }] : [] : t.target.files;if (ae(n) || 0 === n.length) return u || i.clear(), i._showFolderError(w), void i._raise("fileselectnone");if (i._resetErrors(), d = n.length, l = i._getFileCount(i.isUploadable ? i.getFileStack().length + d : d), i.maxFileCount > 0 && l > i.maxFileCount) {
                if (!i.autoReplace || d > i.maxFileCount) return s = i.autoReplace && d > i.maxFileCount ? d : l, r = i.msgFilesTooMany.replace("{m}", i.maxFileCount).replace("{n}", s), i.isError = b(r, null, null, null), i.$captionContainer.find(".kv-caption-icon").hide(), i._setCaption("", !0), void i.$container.removeClass("file-input-new file-input-ajax-new");l > i.maxFileCount && i._resetPreviewThumbs(u);
            } else !u || h ? (i._resetPreviewThumbs(!1), h && i.clearStack()) : !u || 0 !== g || c.count(i.id) && !i.overwriteInitial || i._resetPreviewThumbs(!0);i.isPreviewable ? i._readFiles(n) : i._updateFileDetails(1), i._showFolderError(w);
        }, _abort: function _abort(t) {
            var i,
                a = this;return a.ajaxAborted && "object" == _typeof(a.ajaxAborted) && void 0 !== a.ajaxAborted.message ? (i = e.extend(!0, {}, a._getOutData(), t), i.abortData = a.ajaxAborted.data || {}, i.abortMessage = a.ajaxAborted.message, a.cancel(), a._setProgress(100, a.$progress, a.msgCancelled), a._showUploadError(a.ajaxAborted.message, i, "filecustomerror"), !0) : !1;
        }, _resetFileStack: function _resetFileStack() {
            var t = this,
                i = 0,
                a = [],
                n = [];t._getThumbs().each(function () {
                var r = e(this),
                    l = r.attr("data-fileindex"),
                    o = t.filestack[l];-1 !== l && (void 0 !== o ? (a[i] = o, n[i] = t._getFileName(o), r.attr({ id: t.previewInitId + "-" + i, "data-fileindex": i }), i++) : r.attr({ id: "uploaded-" + le(), "data-fileindex": "-1" }));
            }), t.filestack = a, t.filenames = n;
        }, clearStack: function clearStack() {
            var e = this;return e.filestack = [], e.filenames = [], e.$element;
        }, updateStack: function updateStack(e, t) {
            var i = this;return i.filestack[e] = t, i.filenames[e] = i._getFileName(t), i.$element;
        }, addToStack: function addToStack(e) {
            var t = this;return t.filestack.push(e), t.filenames.push(t._getFileName(e)), t.$element;
        }, getFileStack: function getFileStack(e) {
            var t = this;return t.filestack.filter(function (t) {
                return e ? void 0 !== t : void 0 !== t && null !== t;
            });
        }, lock: function lock() {
            var e = this;return e._resetErrors(), e.disable(), e.showRemove && g(e.$container.find(".fileinput-remove"), "hide"), e.showCancel && e.$container.find(".fileinput-cancel").removeClass("hide"), e._raise("filelock", [e.filestack, e._getExtraData()]), e.$element;
        }, unlock: function unlock(e) {
            var t = this;return void 0 === e && (e = !0), t.enable(), t.showCancel && g(t.$container.find(".fileinput-cancel"), "hide"), t.showRemove && t.$container.find(".fileinput-remove").removeClass("hide"), e && t._resetFileStack(), t._raise("fileunlock", [t.filestack, t._getExtraData()]), t.$element;
        }, cancel: function cancel() {
            var t,
                i = this,
                a = i.ajaxRequests,
                n = a.length;if (n > 0) for (t = 0; n > t; t += 1) {
                i.cancelling = !0, a[t].abort();
            }return i._setProgressCancelled(), i._getThumbs().each(function () {
                var t = e(this),
                    a = t.attr("data-fileindex");t.removeClass("file-uploading"), void 0 !== i.filestack[a] && (t.find(".kv-file-upload").removeClass("disabled").removeAttr("disabled"), t.find(".kv-file-remove").removeClass("disabled").removeAttr("disabled")), i.unlock();
            }), i.$element;
        }, clear: function clear() {
            var t,
                i = this;return i.$btnUpload.removeAttr("disabled"), i._getThumbs().find("video,audio,img").each(function () {
                de(e(this));
            }), i._resetUpload(), i.clearStack(), i._clearFileInput(), i._resetErrors(!0), i._raise("fileclear"), i._hasInitialPreview() ? (i._showFileIcon(), i._resetPreview(), i._initPreviewActions(), i.$container.removeClass("file-input-new")) : (i._getThumbs().each(function () {
                i._clearObjects(e(this));
            }), i.isUploadable && (c.data[i.id] = {}), i.$preview.html(""), t = !i.overwriteInitial && i.initialCaption.length > 0 ? i.initialCaption : "", i._setCaption(t), i.$caption.attr("title", ""), g(i.$container, "file-input-new"), i._validateDefaultPreview()), 0 === i.$container.find(".file-preview-frame").length && (i._initCaption() || i.$captionContainer.find(".kv-caption-icon").hide()), i._hideFileIcon(), i._raise("filecleared"), i.$captionContainer.focus(), i._setFileDropZoneTitle(), i.$element;
        }, reset: function reset() {
            var e = this;return e._resetPreview(), e.$container.find(".fileinput-filename").text(""), e._raise("filereset"), g(e.$container, "file-input-new"), (e.$preview.find(".file-preview-frame").length || e.isUploadable && e.dropZoneEnabled) && e.$container.removeClass("file-input-new"), e._setFileDropZoneTitle(), e.clearStack(), e.formdata = {}, e.$element;
        }, disable: function disable() {
            var e = this;return e.isDisabled = !0, e._raise("filedisabled"), e.$element.attr("disabled", "disabled"), e.$container.find(".kv-fileinput-caption").addClass("file-caption-disabled"), e.$container.find(".btn-file, .fileinput-remove, .fileinput-upload, .file-preview-frame button").attr("disabled", !0), e._initDragDrop(), e.$element;
        }, enable: function enable() {
            var e = this;return e.isDisabled = !1, e._raise("fileenabled"), e.$element.removeAttr("disabled"), e.$container.find(".kv-fileinput-caption").removeClass("file-caption-disabled"), e.$container.find(".btn-file, .fileinput-remove, .fileinput-upload, .file-preview-frame button").removeAttr("disabled"), e._initDragDrop(), e.$element;
        }, upload: function upload() {
            var t,
                i,
                a,
                n = this,
                r = n.getFileStack().length,
                l = {},
                o = !e.isEmptyObject(n._getExtraData());if (n.minFileCount > 0 && n._getFileCount(r) < n.minFileCount) return void n._noFilesError(l);if (n.isUploadable && !n.isDisabled && (0 !== r || o)) {
                if (n._resetUpload(), n.$progress.removeClass("hide"), n.uploadCount = 0, n.uploadStatus = {}, n.uploadLog = [], n.lock(), n._setProgress(2), 0 === r && o) return void n._uploadExtraOnly();if (a = n.filestack.length, n.hasInitData = !1, !n.uploadAsync) return n._uploadBatch(), n.$element;for (i = n._getOutData(), n._raise("filebatchpreupload", [i]), n.fileBatchCompleted = !1, n.uploadCache = { content: [], config: [], tags: [], append: !0 }, n.uploadAsyncCount = n.getFileStack().length, t = 0; a > t; t++) {
                    n.uploadCache.content[t] = null, n.uploadCache.config[t] = null, n.uploadCache.tags[t] = null;
                }for (t = 0; a > t; t++) {
                    void 0 !== n.filestack[t] && n._uploadSingle(t, n.filestack, !0);
                }
            }
        }, destroy: function destroy() {
            var e = this,
                i = e.$container;return i.find(".file-drop-zone").off(), e.$element.insertBefore(i).off(t).removeData(), i.off().remove(), e.$element;
        }, refresh: function refresh(t) {
            var i = this,
                a = i.$element;return t = t ? e.extend(!0, {}, i.options, t) : i.options, i.destroy(), a.fileinput(t), a.val() && a.trigger("change.fileinput"), a;
        } }, e.fn.fileinput = function (t) {
        if (u() || s(9)) {
            var i = Array.apply(null, arguments),
                a = [];switch (i.shift(), this.each(function () {
                var n,
                    r = e(this),
                    l = r.data("fileinput"),
                    o = "object" == (typeof t === "undefined" ? "undefined" : _typeof(t)) && t,
                    s = o.theme || r.data("theme"),
                    d = {},
                    c = {},
                    p = o.language || r.data("language") || "en";l || (s && (c = e.fn.fileinputThemes[s] || {}), "en" === p || ae(e.fn.fileinputLocales[p]) || (d = e.fn.fileinputLocales[p] || {}), n = e.extend(!0, {}, e.fn.fileinput.defaults, c, e.fn.fileinputLocales.en, d, o, r.data()), l = new me(this, n), r.data("fileinput", l)), "string" == typeof t && a.push(l[t].apply(l, i));
            }), a.length) {case 0:
                    return this;case 1:
                    return a[0];default:
                    return a;}
        }
    }, e.fn.fileinput.defaults = { language: "en", showCaption: !0, showBrowse: !0, showPreview: !0, showRemove: !0, showUpload: !0, showCancel: !0, showClose: !0, showUploadedThumbs: !0, browseOnZoneClick: !1, autoReplace: !1, previewClass: "", captionClass: "", mainClass: "file-caption-main", mainTemplate: null, purifyHtml: !0, fileSizeGetter: null, initialCaption: "", initialPreview: [], initialPreviewDelimiter: "*$$*", initialPreviewAsData: !1, initialPreviewFileType: "image", initialPreviewConfig: [], initialPreviewThumbTags: [], previewThumbTags: {}, initialPreviewShowDelete: !0, removeFromPreviewOnError: !1, deleteUrl: "", deleteExtraData: {}, overwriteInitial: !0, layoutTemplates: X, previewTemplates: Y, previewZoomSettings: J, previewZoomButtonIcons: { prev: '<i class="glyphicon glyphicon-triangle-left"></i>', next: '<i class="glyphicon glyphicon-triangle-right"></i>', toggleheader: '<i class="glyphicon glyphicon-resize-vertical"></i>', fullscreen: '<i class="glyphicon glyphicon-fullscreen"></i>', borderless: '<i class="glyphicon glyphicon-resize-full"></i>', close: '<i class="glyphicon glyphicon-remove"></i>' }, previewZoomButtonClasses: { prev: "btn btn-navigate", next: "btn btn-navigate", toggleheader: "btn btn-default btn-header-toggle", fullscreen: "btn btn-default", borderless: "btn btn-default", close: "btn btn-default" }, allowedPreviewTypes: Q, allowedPreviewMimeTypes: null, allowedFileTypes: null, allowedFileExtensions: null, defaultPreviewContent: null, customLayoutTags: {}, customPreviewTags: {}, previewSettings: te, fileTypeSettings: ie, previewFileIcon: '<i class="glyphicon glyphicon-file"></i>', previewFileIconClass: "file-other-icon", previewFileIconSettings: {}, previewFileExtSettings: {}, buttonLabelClass: "hidden-xs", browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>&nbsp;', browseClass: "btn btn-primary", removeIcon: '<i class="glyphicon glyphicon-trash"></i>', removeClass: "btn btn-default", cancelIcon: '<i class="glyphicon glyphicon-ban-circle"></i>', cancelClass: "btn btn-default", uploadIcon: '<i class="glyphicon glyphicon-upload"></i>', uploadClass: "btn btn-default", uploadUrl: null, uploadAsync: !0, uploadExtraData: {}, zoomModalHeight: 480, minImageWidth: null, minImageHeight: null, maxImageWidth: null, maxImageHeight: null, resizeImage: !1, resizePreference: "width", resizeQuality: .92, resizeDefaultImageType: "image/jpeg", maxFileSize: 0, maxFilePreviewSize: 25600, minFileCount: 0, maxFileCount: 0, validateInitialCount: !1, msgValidationErrorClass: "text-danger", msgValidationErrorIcon: '<i class="glyphicon glyphicon-exclamation-sign"></i> ', msgErrorClass: "file-error-message", progressThumbClass: "progress-bar progress-bar-success progress-bar-striped active", progressClass: "progress-bar progress-bar-success progress-bar-striped active", progressCompleteClass: "progress-bar progress-bar-success", progressErrorClass: "progress-bar progress-bar-danger", previewFileType: "image", elCaptionContainer: null, elCaptionText: null, elPreviewContainer: null, elPreviewImage: null, elPreviewStatus: null, elErrorContainer: null, errorCloseButton: '<span class="close kv-error-close">&times;</span>', slugCallback: null, dropZoneEnabled: !0, dropZoneTitleClass: "file-drop-zone-title", fileActionSettings: {}, otherActionButtons: "", textEncoding: "UTF-8", ajaxSettings: {}, ajaxDeleteSettings: {}, showAjaxErrorDetails: !0 }, e.fn.fileinputLocales.en = { fileSingle: "file", filePlural: "files", browseLabel: "Browse &hellip;", removeLabel: "Remove", removeTitle: "Clear selected files", cancelLabel: "Cancel", cancelTitle: "Abort ongoing upload", uploadLabel: "Upload", uploadTitle: "Upload selected files", msgNo: "No", msgNoFilesSelected: "No files selected", msgCancelled: "Cancelled", msgZoomModalHeading: "Detailed Preview", msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) exceeds maximum allowed upload size of <b>{maxSize} KB</b>.', msgFilesTooLess: "You must select at least <b>{n}</b> {files} to upload.", msgFilesTooMany: "Number of files selected for upload <b>({n})</b> exceeds maximum allowed limit of <b>{m}</b>.", msgFileNotFound: 'File "{name}" not found!', msgFileSecured: 'Security restrictions prevent reading the file "{name}".', msgFileNotReadable: 'File "{name}" is not readable.', msgFilePreviewAborted: 'File preview aborted for "{name}".', msgFilePreviewError: 'An error occurred while reading the file "{name}".', msgInvalidFileType: 'Invalid type for file "{name}". Only "{types}" files are supported.', msgInvalidFileExtension: 'Invalid extension for file "{name}". Only "{extensions}" files are supported.', msgUploadAborted: "The file upload was aborted", msgValidationError: "Validation Error", msgLoading: "Loading file {index} of {files} &hellip;", msgProgress: "Loading file {index} of {files} - {name} - {percent}% completed.", msgSelected: "{n} {files} selected", msgFoldersNotAllowed: "Drag & drop files only! {n} folder(s) dropped were skipped.", msgImageWidthSmall: 'Width of image file "{name}" must be at least {size} px.', msgImageHeightSmall: 'Height of image file "{name}" must be at least {size} px.', msgImageWidthLarge: 'Width of image file "{name}" cannot exceed {size} px.', msgImageHeightLarge: 'Height of image file "{name}" cannot exceed {size} px.', msgImageResizeError: "Could not get the image dimensions to resize.", msgImageResizeException: "Error while resizing the image.<pre>{errors}</pre>", dropZoneTitle: "Drag & drop files here &hellip;", dropZoneClickTitle: "<br>(or click to select {files})", previewZoomButtonTitles: { prev: "View previous file", next: "View next file", toggleheader: "Toggle header", fullscreen: "Toggle full screen", borderless: "Toggle borderless mode", close: "Close detailed preview" } }, e.fn.fileinput.Constructor = me, e(document).ready(function () {
        var t = e("input.file[type=file]");t.length && t.fileinput();
    });
});
/*! formstone v1.4.8 [mediaquery.js] 2018-06-21 | GPL-3.0 License | formstone.it */
!function (e) {
    "function" == typeof define && define.amd ? define(["jquery", "./core"], e) : e(jQuery, Formstone);
}(function (e, t) {
    "use strict";
    function n() {
        v = { unit: s.unit };for (var e in u) {
            if (u.hasOwnProperty(e)) for (var t in l[e]) {
                if (l[e].hasOwnProperty(t)) {
                    var n = "Infinity" === t ? 1 / 0 : parseInt(t, 10),
                        i = e.indexOf("max") > -1;l[e][t].matches && (i ? (!v[e] || n < v[e]) && (v[e] = n) : (!v[e] || n > v[e]) && (v[e] = n));
                }
            }
        }
    }function i() {
        n(), m.trigger(h.mqChange, [v]);
    }function r(e) {
        var t = a(e.media),
            n = d[t],
            i = e.matches,
            r = i ? h.enter : h.leave;if (n && (n.active || !n.active && i)) {
            for (var o in n[r]) {
                n[r].hasOwnProperty(o) && n[r][o].apply(n.mq);
            }n.active = !0;
        }
    }function a(e) {
        return e.replace(/[^a-z0-9\s]/gi, "").replace(/[_\s]/g, "").replace(/^\s+|\s+$/g, "");
    }var o = t.Plugin("mediaquery", { utilities: { _initialize: function _initialize(t) {
                t = t || {};for (var n in u) {
                    u.hasOwnProperty(n) && (s[n] = t[n] ? e.merge(t[n], s[n]) : s[n]);
                }(s = e.extend(s, t)).minWidth.sort(f.sortDesc), s.maxWidth.sort(f.sortAsc), s.minHeight.sort(f.sortDesc), s.maxHeight.sort(f.sortAsc);for (var r in u) {
                    if (u.hasOwnProperty(r)) {
                        l[r] = {};for (var a in s[r]) {
                            if (s[r].hasOwnProperty(a)) {
                                var o = window.matchMedia("(" + u[r] + ": " + (s[r][a] === 1 / 0 ? 1e5 : s[r][a]) + s.unit + ")");o.addListener(i), l[r][s[r][a]] = o;
                            }
                        }
                    }
                }i();
            }, state: function state() {
                return v;
            }, bind: function bind(e, t, n) {
                var i = c.matchMedia(t),
                    o = a(i.media);d[o] || (d[o] = { mq: i, active: !0, enter: {}, leave: {} }, d[o].mq.addListener(r));for (var s in n) {
                    n.hasOwnProperty(s) && d[o].hasOwnProperty(s) && (d[o][s][e] = n[s]);
                }var m = d[o],
                    f = i.matches;f && m[h.enter].hasOwnProperty(e) ? (m[h.enter][e].apply(i), m.active = !0) : !f && m[h.leave].hasOwnProperty(e) && (m[h.leave][e].apply(i), m.active = !1);
            }, unbind: function unbind(e, t) {
                if (e) if (t) {
                    var n = a(t);d[n] && (d[n].enter[e] && delete d[n].enter[e], d[n].leave[e] && delete d[n].leave[e]);
                } else for (var i in d) {
                    d.hasOwnProperty(i) && (d[i].enter[e] && delete d[i].enter[e], d[i].leave[e] && delete d[i].leave[e]);
                }
            } }, events: { mqChange: "mqchange" } }),
        s = { minWidth: [0], maxWidth: [1 / 0], minHeight: [0], maxHeight: [1 / 0], unit: "px" },
        h = e.extend(o.events, { enter: "enter", leave: "leave" }),
        m = t.$window,
        c = m[0],
        f = o.functions,
        v = null,
        d = [],
        l = {},
        u = { minWidth: "min-width", maxWidth: "max-width", minHeight: "min-height", maxHeight: "max-height" };
});
/*! formstone v1.4.8 [touch.js] 2018-06-21 | GPL-3.0 License | formstone.it */
!function (e) {
    "function" == typeof define && define.amd ? define(["jquery", "./core"], e) : e(jQuery, Formstone);
}(function (e, t) {
    "use strict";
    function a(e) {
        e.preventManipulation && e.preventManipulation();var t = e.data,
            a = e.originalEvent;if (a.type.match(/(up|end|cancel)$/i)) s(e);else {
            if (a.pointerId) {
                var o = !1;for (var p in t.touches) {
                    t.touches[p].id === a.pointerId && (o = !0, t.touches[p].pageX = a.pageX, t.touches[p].pageY = a.pageY);
                }o || t.touches.push({ id: a.pointerId, pageX: a.pageX, pageY: a.pageY });
            } else t.touches = a.touches;a.type.match(/(down|start)$/i) ? n(e) : a.type.match(/move$/i) && i(e);
        }
    }function n(n) {
        var o = n.data,
            p = "undefined" !== e.type(o.touches) && o.touches.length ? o.touches[0] : null;p && o.$el.off(d.mouseDown), o.touching || (o.startE = n.originalEvent, o.startX = p ? p.pageX : n.pageX, o.startY = p ? p.pageY : n.pageY, o.startT = new Date().getTime(), o.scaleD = 1, o.passedAxis = !1), o.$links && o.$links.off(d.click);var u = c(o.scale ? d.scaleStart : d.panStart, n, o.startX, o.startY, o.scaleD, 0, 0, "", "");if (o.scale && o.touches && o.touches.length >= 2) {
            var h = o.touches;o.pinch = { startX: r(h[0].pageX, h[1].pageX), startY: r(h[0].pageY, h[1].pageY), startD: l(h[1].pageX - h[0].pageX, h[1].pageY - h[0].pageY) }, u.pageX = o.startX = o.pinch.startX, u.pageY = o.startY = o.pinch.startY;
        }o.touching || (o.touching = !0, o.pan && !p && X.on(d.mouseMove, o, i).on(d.mouseUp, o, s), t.support.pointer ? X.on([d.pointerMove, d.pointerUp, d.pointerCancel].join(" "), o, a) : X.on([d.touchMove, d.touchEnd, d.touchCancel].join(" "), o, a), o.$el.trigger(u));
    }function i(t) {
        var a = t.data,
            n = "undefined" !== e.type(a.touches) && a.touches.length ? a.touches[0] : null,
            i = n ? n.pageX : t.pageX,
            o = n ? n.pageY : t.pageY,
            p = i - a.startX,
            u = o - a.startY,
            h = p > 0 ? "right" : "left",
            g = u > 0 ? "down" : "up",
            X = Math.abs(p) > a.threshold,
            Y = Math.abs(u) > a.threshold;if (!a.passedAxis && a.axis && (a.axisX && Y || a.axisY && X)) s(t);else {
            !a.passedAxis && (!a.axis || a.axis && a.axisX && X || a.axisY && Y) && (a.passedAxis = !0), a.passedAxis && (f.killEvent(t), f.killEvent(a.startE));var v = !0,
                x = c(a.scale ? d.scale : d.pan, t, i, o, a.scaleD, p, u, h, g);if (a.scale) if (a.touches && a.touches.length >= 2) {
                var m = a.touches;a.pinch.endX = r(m[0].pageX, m[1].pageX), a.pinch.endY = r(m[0].pageY, m[1].pageY), a.pinch.endD = l(m[1].pageX - m[0].pageX, m[1].pageY - m[0].pageY), a.scaleD = a.pinch.endD / a.pinch.startD, x.pageX = a.pinch.endX, x.pageY = a.pinch.endY, x.scale = a.scaleD, x.deltaX = a.pinch.endX - a.pinch.startX, x.deltaY = a.pinch.endY - a.pinch.startY;
            } else a.pan || (v = !1);v && a.$el.trigger(x);
        }
    }function s(t) {
        var a = t.data,
            i = "undefined" !== e.type(a.touches) && a.touches.length ? a.touches[0] : null,
            s = i ? i.pageX : t.pageX,
            p = i ? i.pageY : t.pageY,
            r = s - a.startX,
            l = p - a.startY,
            u = new Date().getTime(),
            h = a.scale ? d.scaleEnd : d.panEnd,
            g = r > 0 ? "right" : "left",
            Y = l > 0 ? "down" : "up",
            v = Math.abs(r) > 1,
            x = Math.abs(l) > 1;if (a.swipe && u - a.startT < a.time && Math.abs(r) > a.threshold && (h = d.swipe), a.axis && (a.axisX && x || a.axisY && v) || v || x) {
            a.$links = a.$el.find("a");for (var m = 0, w = a.$links.length; m < w; m++) {
                o(a.$links.eq(m), a);
            }
        }var M = c(h, t, s, p, a.scaleD, r, l, g, Y);X.off([d.touchMove, d.touchEnd, d.touchCancel, d.mouseMove, d.mouseUp, d.pointerMove, d.pointerUp, d.pointerCancel].join(" ")), a.$el.trigger(M), a.touches = [], a.scale, i && (a.touchTimer = f.startTimer(a.touchTimer, 5, function () {
            a.$el.on(d.mouseDown, a, n);
        })), a.touching = !1;
    }function o(t, a) {
        t.on(d.click, a, p);var n = e._data(t[0], "events").click;n.unshift(n.pop());
    }function p(e) {
        f.killEvent(e, !0), e.data.$links.off(d.click);
    }function c(t, a, n, i, s, o, p, c, r) {
        return e.Event(t, { originalEvent: a, bubbles: !0, pageX: n, pageY: i, scale: s, deltaX: o, deltaY: p, directionX: c, directionY: r });
    }function r(e, t) {
        return (e + t) / 2;
    }function l(e, t) {
        return Math.sqrt(e * e + t * t);
    }function u(e, t) {
        e.css({ "-ms-touch-action": t, "touch-action": t });
    }var h = !t.window.PointerEvent,
        g = t.Plugin("touch", { widget: !0, defaults: { axis: !1, pan: !1, scale: !1, swipe: !1, threshold: 10, time: 50 }, methods: { _construct: function _construct(e) {
                if (e.touches = [], e.touching = !1, this.on(d.dragStart, f.killEvent), e.swipe && (e.pan = !0), e.scale && (e.axis = !1), e.axisX = "x" === e.axis, e.axisY = "y" === e.axis, t.support.pointer) {
                    var i = "";!e.axis || e.axisX && e.axisY ? i = "none" : (e.axisX && (i += " pan-y"), e.axisY && (i += " pan-x")), u(this, i), this.on(d.pointerDown, e, a);
                } else this.on(d.touchStart, e, a).on(d.mouseDown, e, n);
            }, _destruct: function _destruct(e) {
                this.off(d.namespace), u(this, "");
            } }, events: { pointerDown: h ? "MSPointerDown" : "pointerdown", pointerUp: h ? "MSPointerUp" : "pointerup", pointerMove: h ? "MSPointerMove" : "pointermove", pointerCancel: h ? "MSPointerCancel" : "pointercancel" } }),
        d = g.events,
        f = g.functions,
        X = t.$window;d.pan = "pan", d.panStart = "panstart", d.panEnd = "panend", d.scale = "scale", d.scaleStart = "scalestart", d.scaleEnd = "scaleend", d.swipe = "swipe";
});
/*! formstone v1.4.8 [carousel.js] 2018-06-21 | GPL-3.0 License | formstone.it */
!function (e) {
    "function" == typeof define && define.amd ? define(["jquery", "./core", "./mediaquery", "./touch"], e) : e(jQuery, Formstone);
}(function (e, t) {
    "use strict";
    function i() {
        z = e(L.base);
    }function n(e) {
        e.enabled && (N.clearTimer(e.autoTimer), e.enabled = !1, e.$subordinate.off(H.update), this.removeClass([X.enabled, X.animated].join(" ")).off(H.namespace), e.$canister.fsTouch("destroy").off(H.namespace).attr("style", "").css(G, "none"), e.$items.css({ width: "", height: "" }).removeClass([X.visible, L.item_previous, L.item_next].join(" ")), e.$images.off(H.namespace), e.$controlItems.off(H.namespace), e.$pagination.html("").off(H.namespace), f(e), e.useMargin ? e.$canister.css({ marginLeft: "" }) : e.$canister.css(E, ""), e.index = 0);
    }function a(e) {
        e.enabled || (e.enabled = !0, this.addClass(X.enabled), e.$controlItems.on(H.click, e, g), e.$pagination.on(H.click, L.page, e, p), e.$items.on(H.click, e, M), e.$subordinate.on(H.update, e, I), I({ data: e }, 0), e.$canister.fsTouch({ axis: "x", pan: !0, swipe: !0 }).on(H.panStart, e, C).on(H.pan, e, x).on(H.panEnd, e, w).on(H.swipe, e, T).on(H.focusIn, e, W).css(G, ""), o(e), e.$images.on(H.load, e, u), e.autoAdvance && (e.autoTimer = N.startTimer(e.autoTimer, e.autoTime, function () {
            m(e);
        }, !0)), s.call(this, e));
    }function s(t) {
        if (t.enabled) {
            var i, n, a, s, o;if (t.count = t.$items.length, t.count < 1) return f(t), void t.$canister.css({ height: "" });if (this.removeClass(X.animated), t.containerWidth = t.$container.outerWidth(!1), t.visible = b(t), t.perPage = t.paged ? 1 : t.visible, t.itemMarginLeft = parseInt(t.$items.eq(0).css("marginLeft")), t.itemMarginRight = parseInt(t.$items.eq(0).css("marginRight")), t.itemMargin = t.itemMarginLeft + t.itemMarginRight, isNaN(t.itemMargin) && (t.itemMargin = 0), t.itemWidth = (t.containerWidth - t.itemMargin * (t.visible - 1)) / t.visible, t.itemHeight = 0, t.pageWidth = t.paged ? t.itemWidth : t.containerWidth, t.matchWidth) t.canisterWidth = t.single ? t.containerWidth : (t.itemWidth + t.itemMargin) * t.count;else for (t.canisterWidth = 0, t.$canister.css({ width: 1e6 }), i = 0; i < t.count; i++) {
                t.canisterWidth += t.$items.eq(i).outerWidth(!0);
            }t.$canister.css({ width: t.canisterWidth, height: "" }), t.$items.css({ width: t.matchWidth ? t.itemWidth : "", height: "" }).removeClass([X.visible, X.item_previous, X.item_next].join(" ")), t.pages = [];var r,
                l = 0,
                c = 0,
                d = 0;for (a = 0, s = 0, n = e(), i = 0; i < t.count; i++) {
                r = t.$items.eq(i), l = t.matchWidth ? t.itemWidth + t.itemMargin : r.outerWidth(!0), c = r.outerHeight(), a + l > t.containerWidth + t.itemMargin && (o = (t.rtl ? n.eq(n.length - 1) : n.eq(0)).position().left, t.pages.push({ left: t.rtl ? o - (t.canisterWidth - a) : o, height: s, width: a, $items: n }), n = e(), s = 0, a = 0), n = n.add(r), a += l, d += l, c > s && (s = c), s > t.itemHeight && (t.itemHeight = s);
            }t.rtl ? n.eq(n.length - 1) : n.eq(0), o = t.canisterWidth - t.containerWidth - (t.rtl ? t.itemMarginLeft : t.itemMarginRight), t.pages.push({ left: t.rtl ? -o : o, height: s, width: a, $items: n }), t.pageCount = t.pages.length, t.paged && (t.pageCount -= t.count % t.visible), t.pageCount <= 0 && (t.pageCount = 1), t.maxMove = -t.pages[t.pageCount - 1].left, t.autoHeight ? t.$canister.css({ height: t.pages[0].height }) : t.matchHeight && t.$items.css({ height: t.itemHeight });var u = "";for (i = 0; i < t.pageCount; i++) {
                u += '<button type="button" class="' + X.page + '">' + (i + 1) + "</button>";
            }t.$pagination.html(u), t.pageCount <= 1 ? f(t) : v(t), t.$paginationItems = t.$pagination.find(L.page), h(t, t.index, !1), setTimeout(function () {
                t.$el.addClass(X.animated);
            }, 5);
        }
    }function o(e) {
        e.$items = e.$canister.children().not(":hidden").addClass(X.item), e.$images = e.$canister.find("img"), e.totalImages = e.$images.length;
    }function r(e, t) {
        e.$images.off(H.namespace), !1 !== t && e.$canister.html(t), e.index = 0, o(e), s.call(this, e);
    }function l(e, t, i, n, a) {
        e.enabled && (N.clearTimer(e.autoTimer), void 0 === a && (a = !0), h(e, t - 1, a, i, n));
    }function c(e) {
        var t = e.index - 1;e.infinite && t < 0 && (t = e.pageCount - 1), h(e, t);
    }function d(e) {
        var t = e.index + 1;e.infinite && t >= e.pageCount && (t = 0), h(e, t);
    }function u(e) {
        var t = e.data;t.resizeTimer = N.startTimer(t.resizeTimer, 1, function () {
            s.call(t.$el, t);
        });
    }function m(e) {
        var t = e.index + 1;t >= e.pageCount && (t = 0), h(e, t);
    }function g(t) {
        N.killEvent(t);var i = t.data,
            n = i.index + (e(t.currentTarget).hasClass(X.control_next) ? 1 : -1);N.clearTimer(i.autoTimer), h(i, n);
    }function p(t) {
        N.killEvent(t);var i = t.data,
            n = i.$paginationItems.index(e(t.currentTarget));N.clearTimer(i.autoTimer), h(i, n);
    }function h(t, i, n, a, s) {
        if (i < 0 && (i = t.infinite ? t.pageCount - 1 : 0), i >= t.pageCount && (i = t.infinite ? 0 : t.pageCount - 1), !(t.count < 1)) {
            t.pages[i] && (t.leftPosition = -t.pages[i].left), t.leftPosition = _(t, t.leftPosition), t.useMargin ? t.$canister.css({ marginLeft: t.leftPosition }) : !1 === n ? (t.$canister.css(G, "none").css(E, "translateX(" + t.leftPosition + "px)"), setTimeout(function () {
                t.$canister.css(G, "");
            }, 5)) : t.$canister.css(E, "translateX(" + t.leftPosition + "px)"), t.$items.removeClass([X.visible, X.item_previous, X.item_next].join(" "));for (var o = 0, r = t.pages.length; o < r; o++) {
                o === i ? t.pages[o].$items.addClass(X.visible).attr("aria-hidden", "false") : t.pages[o].$items.not(t.pages[i].$items).addClass(o < i ? X.item_previous : X.item_next).attr("aria-hidden", "true");
            }t.autoHeight && t.$canister.css({ height: t.pages[i].height }), !1 !== n && !0 !== a && i !== t.index && (t.infinite || i > -1 && i < t.pageCount) && t.$el.trigger(H.update, [i]), t.index = i, t.linked && !0 !== s && e(t.linked).not(t.$el)[y]("jumpPage", t.index + 1, !0, !0), $(t);
        }
    }function f(e) {
        e.$controls.removeClass(X.visible), e.$controlItems.removeClass(X.visible), e.$pagination.removeClass(X.visible);
    }function v(e) {
        e.$controls.addClass(X.visible), e.$controlItems.addClass(X.visible), e.$pagination.addClass(X.visible);
    }function $(e) {
        e.$paginationItems.removeClass(X.active).eq(e.index).addClass(X.active), e.infinite ? e.$controlItems.addClass(X.visible) : e.pageCount < 1 ? e.$controlItems.removeClass(X.visible) : (e.$controlItems.addClass(X.visible), e.index <= 0 ? e.$controlPrevious.removeClass(X.visible) : (e.index >= e.pageCount - 1 || !e.single && e.leftPosition === e.maxMove) && e.$controlNext.removeClass(X.visible));
    }function b(i) {
        var n = 1;if (i.single) return n;if ("array" === e.type(i.show)) for (var a in i.show) {
            i.show.hasOwnProperty(a) && (t.support.matchMedia ? i.show[a].mq.matches && (n = i.show[a].count) : i.show[a].width < t.fallbackWidth && (n = i.show[a].count));
        } else n = i.show;return i.fill && i.count < n ? i.count : n;
    }function C(t, i) {
        var n = t.data;if (N.clearTimer(n.autoTimer), !n.single) {
            if (n.useMargin) n.leftPosition = parseInt(n.$canister.css("marginLeft"));else {
                var a = n.$canister.css(E).split(",");n.leftPosition = parseInt(a[4]);
            }if (n.$canister.css(G, "none").css("will-change", "transform"), x(t), n.linked && !0 !== i) {
                var s = t.deltaX / n.pageWidth;n.rtl && (s *= -1), e(n.linked).not(n.$el)[y]("panStart", s);
            }
        }n.isTouching = !0;
    }function x(t, i) {
        var n = t.data;if (!n.single && (n.touchLeft = _(n, n.leftPosition + t.deltaX), n.useMargin ? n.$canister.css({ marginLeft: n.touchLeft }) : n.$canister.css(E, "translateX(" + n.touchLeft + "px)"), n.linked && !0 !== i)) {
            var a = t.deltaX / n.pageWidth;n.rtl && (a *= -1), e(n.linked).not(n.$el)[y]("pan", a);
        }
    }function w(t, i) {
        var n = t.data,
            a = Math.abs(t.deltaX),
            s = k(n, t),
            o = !1;if (n.didPan = !1, 0 == s) o = n.index;else {
            if (!n.single) {
                var r,
                    l,
                    c = Math.abs(n.touchLeft),
                    d = !1,
                    u = n.rtl ? "right" : "left";if (t.directionX === u) for (r = 0, l = n.pages.length; r < l; r++) {
                    d = n.pages[r], c > Math.abs(d.left) + 20 && (o = r + 1);
                } else for (r = n.pages.length - 1, l = 0; r >= l; r--) {
                    d = n.pages[r], c < Math.abs(d.left) && (o = r - 1);
                }
            }!1 === o && (o = a < 50 ? n.index : n.index + s);
        }o !== n.index && (n.didPan = !0), n.linked && !0 !== i && e(n.linked).not(n.$el)[y]("panEnd", o), P(n, o);
    }function T(t, i) {
        var n = t.data,
            a = k(n, t),
            s = n.index + a;n.linked && !0 !== i && e(n.linked).not(n.$el)[y]("swipe", t.directionX), P(n, s);
    }function P(e, t) {
        e.$canister.css(G, "").css("will-change", ""), h(e, t), e.isTouching = !1;
    }function M(t) {
        var i = t.data,
            n = e(t.currentTarget);if (!i.didPan && (n.trigger(H.itemClick), i.controller)) {
            var a = i.$items.index(n);I(t, a), i.$subordinate[y]("jumpPage", a + 1, !0);
        }
    }function W(t) {
        var i = t.data;if (i.enabled && !i.isTouching) {
            N.clearTimer(i.autoTimer), i.$container.scrollLeft(0);var n,
                a = e(t.target);a.hasClass(X.item) ? n = a : a.parents(L.item).length && (n = a.parents(L.item).eq(0));for (var s = 0; s < i.pageCount; s++) {
                if (i.pages[s].$items.is(n)) {
                    h(i, s);break;
                }
            }
        }
    }function I(e, t) {
        var i = e.data;if (i.controller) {
            var n = i.$items.eq(t);i.$items.removeClass(X.active), n.addClass(X.active);for (var a = 0; a < i.pageCount; a++) {
                if (i.pages[a].$items.is(n)) {
                    h(i, a, !0, !0);break;
                }
            }
        }
    }function _(e, t) {
        return isNaN(t) ? t = 0 : e.rtl ? (t > e.maxMove && (t = e.maxMove), t < 0 && (t = 0)) : (t < e.maxMove && (t = e.maxMove), t > 0 && (t = 0)), t;
    }function k(e, t) {
        return Math.abs(t.deltaX) < Math.abs(t.deltaY) ? 0 : e.rtl ? "right" === t.directionX ? 1 : -1 : "left" === t.directionX ? 1 : -1;
    }var q = t.Plugin("carousel", { widget: !0, defaults: { autoAdvance: !1, autoHeight: !1, autoTime: 8e3, contained: !0, controls: !0, customClass: "", fill: !1, infinite: !1, labels: { next: "Next", previous: "Previous", controls: "Carousel {guid} Controls", pagination: "Carousel {guid} Pagination" }, matchHeight: !1, matchWidth: !0, maxWidth: 1 / 0, minWidth: "0px", paged: !1, pagination: !0, rtl: !1, show: 1, single: !1, theme: "fs-light", useMargin: !1 }, classes: ["ltr", "rtl", "viewport", "wrapper", "container", "canister", "item", "item_previous", "item_next", "controls", "controls_custom", "control", "control_previous", "control_next", "pagination", "page", "animated", "enabled", "visible", "active", "auto_height", "contained", "single"], events: { itemClick: "itemClick", update: "update" }, methods: { _construct: function _construct(s) {
                var r;s.didPan = !1, s.carouselClasses = [X.base, s.theme, s.customClass, s.rtl ? X.rtl : X.ltr], s.maxWidth = s.maxWidth === 1 / 0 ? "100000px" : s.maxWidth, s.mq = "(min-width:" + s.minWidth + ") and (max-width:" + s.maxWidth + ")", s.customControls = "object" === e.type(s.controls) && s.controls.previous && s.controls.next, s.customPagination = "string" === e.type(s.pagination), s.id = this.attr("id"), s.id ? s.ariaId = s.id : (s.ariaId = s.rawGuid, this.attr("id", s.ariaId)), t.support.transform || (s.useMargin = !0);var l = "",
                    c = "",
                    d = [X.control, X.control_previous].join(" "),
                    u = [X.control, X.control_next].join(" ");s.controls && !s.customControls && (s.labels.controls = s.labels.controls.replace("{guid}", s.numGuid), l += '<div class="' + X.controls + '" aria-label="' + s.labels.controls + '" aria-controls="' + s.ariaId + '">', l += '<button type="button" class="' + d + '" aria-label="' + s.labels.previous + '">' + s.labels.previous + "</button>", l += '<button type="button" class="' + u + '" aria-label="' + s.labels.next + '">' + s.labels.next + "</button>", l += "</div>"), s.pagination && !s.customPagination && (s.labels.pagination = s.labels.pagination.replace("{guid}", s.numGuid), c += '<div class="' + X.pagination + '" aria-label="' + s.labels.pagination + '" aria-controls="' + s.ariaId + '" role="navigation">', c += "</div>"), s.autoHeight && s.carouselClasses.push(X.auto_height), s.contained && s.carouselClasses.push(X.contained), s.single && s.carouselClasses.push(X.single), this.addClass(s.carouselClasses.join(" ")).wrapInner('<div class="' + X.wrapper + '" aria-live="polite"><div class="' + X.container + '"><div class="' + X.canister + '"></div></div></div>').append(l).wrapInner('<div class="' + X.viewport + '"></div>').append(c), s.$viewport = this.find(L.viewport).eq(0), s.$container = this.find(L.container).eq(0), s.$canister = this.find(L.canister).eq(0), s.$pagination = this.find(L.pagination).eq(0), s.$controlPrevious = s.$controlNext = e(""), s.customControls ? (s.$controls = e(s.controls.container).addClass([X.controls, X.controls_custom].join(" ")), s.$controlPrevious = e(s.controls.previous).addClass(d), s.$controlNext = e(s.controls.next).addClass(u)) : (s.$controls = this.find(L.controls).eq(0), s.$controlPrevious = s.$controls.find(L.control_previous), s.$controlNext = s.$controls.find(L.control_next)), s.$controlItems = s.$controlPrevious.add(s.$controlNext), s.customPagination && (s.$pagination = e(s.pagination).addClass([X.pagination])), s.$paginationItems = s.$pagination.find(L.page), s.index = 0, s.enabled = !1, s.leftPosition = 0, s.autoTimer = null, s.resizeTimer = null;var m = this.data(j + "-linked");s.linked = !!m && "[data-" + j + '-linked="' + m + '"]', s.linked && (s.paged = !0);var g = this.data(j + "-controller-for") || "";if (s.$subordinate = e(g), s.$subordinate.length && (s.controller = !0), "object" === e.type(s.show)) {
                    var p = s.show,
                        h = [],
                        f = [];for (r in p) {
                        p.hasOwnProperty(r) && f.push(r);
                    }f.sort(N.sortAsc);for (r in f) {
                        f.hasOwnProperty(r) && h.push({ width: parseInt(f[r]), count: p[f[r]], mq: window.matchMedia("(min-width: " + parseInt(f[r]) + "px)") });
                    }s.show = h;
                }o(s), e.fsMediaquery("bind", s.rawGuid, s.mq, { enter: function enter() {
                        a.call(s.$el, s);
                    }, leave: function leave() {
                        n.call(s.$el, s);
                    } }), i(), s.carouselClasses.push(X.enabled), s.carouselClasses.push(X.animated);
            }, _destruct: function _destruct(t) {
                N.clearTimer(t.autoTimer), N.clearTimer(t.resizeTimer), n.call(this, t), e.fsMediaquery("unbind", t.rawGuid), t.id !== t.ariaId && this.removeAttr("id"), t.$controlItems.removeClass([L.control, X.control_previous, L.control_next, L.visible].join(" ")).off(H.namespace), t.$images.off(H.namespace), t.$canister.fsTouch("destroy"), t.$items.removeClass([X.item, X.visible, L.item_previous, L.item_next].join(" ")).unwrap().unwrap().unwrap().unwrap(), t.controls && !t.customControls && t.$controls.remove(), t.customControls && t.$controls.removeClass([X.controls, X.controls_custom, X.visible].join(" ")), t.pagination && !t.customPagination && t.$pagination.remove(), t.customPagination && t.$pagination.html("").removeClass([X.pagination, X.visible].join(" ")), this.removeClass(t.carouselClasses.join(" ")), i();
            }, _resize: function _resize(e) {
                N.iterate.call(z, s);
            }, disable: n, enable: a, jump: l, previous: c, next: d, jumpPage: l, previousPage: c, nextPage: d, jumpItem: function jumpItem(e, t, i, n, a) {
                if (e.enabled) {
                    N.clearTimer(e.autoTimer);var s = e.$items.eq(t - 1);void 0 === a && (a = !0);for (var o = 0; o < e.pageCount; o++) {
                        if (e.pages[o].$items.is(s)) {
                            h(e, o, a, i, n);break;
                        }
                    }
                }
            }, reset: function reset(e) {
                e.enabled && r.call(this, e, !1);
            }, resize: s, update: r, panStart: function panStart(e, t) {
                if (N.clearTimer(e.autoTimer), !e.single) {
                    if (e.rtl && (t *= -1), e.useMargin) e.leftPosition = parseInt(e.$canister.css("marginLeft"));else {
                        var i = e.$canister.css(E).split(",");e.leftPosition = parseInt(i[4]);
                    }e.$canister.css(G, "none"), x({ data: e, deltaX: e.pageWidth * t }, !0);
                }e.isTouching = !0;
            }, pan: function pan(e, t) {
                if (!e.single) {
                    e.rtl && (t *= -1);var i = e.pageWidth * t;e.touchLeft = _(e, e.leftPosition + i), e.useMargin ? e.$canister.css({ marginLeft: e.touchLeft }) : e.$canister.css(E, "translateX(" + e.touchLeft + "px)");
                }
            }, panEnd: function panEnd(e, t) {
                P(e, t);
            }, swipe: function swipe(e, t) {
                T({ data: e, directionX: t }, !0);
            } } }),
        j = q.namespace,
        y = q.namespaceClean,
        L = q.classes,
        X = L.raw,
        H = q.events,
        N = q.functions,
        z = [],
        E = t.transform,
        G = t.transition;
});
$(".carousel_1").carousel({
    pagination: false,
    controls: false
});
$(".carousel_2").carousel({
    controls: false,
    pagination: false,
    autoAdvance: true,
    show: {
        "0px": 1,
        "500px": 2,
        "980px": 3
    }
});
