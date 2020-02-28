@extends('layouts.admin')
@section('content-header')

@stop

@section('content')
  <div class="row">
      <div class="col-md-9">
          <div id="post-body-content" class="edit-form-section">
              <div id="namediv" class="stuffbox">
                  <h3><label for="name">Author</label></h3>
                  <div class="inside">
                      <table class="form-table editcomment">
                          <tbody>
                          <tr>
                              <td class="first">Name:</td>
                              <td><input type="text" name="newcomment_author" size="30" value="abokamal" id="name"></td>
                          </tr>
                          <tr>
                              <td class="first">
                                  E-mail (<a href="mailto:tariq@ukprintplus.co.uk">send e-mail</a>):</td>
                              <td><input type="text" name="newcomment_author_email" size="30" value="tariq@ukprintplus.co.uk" id="email"></td>
                          </tr>
                          <tr>
                              <td class="first">
                                  URL:</td>
                              <td><input type="text" id="newcomment_author_url" name="newcomment_author_url" size="30" class="code" value=""></td>
                          </tr>
                          </tbody>
                      </table>
                      <br>
                  </div>
              </div>

              <div id="postdiv" class="postarea">
                  <div id="wp-content-wrap" class="wp-core-ui wp-editor-wrap html-active"><link rel="stylesheet" id="editor-buttons-css" href="http://ukprintplus.co.uk/wp-includes/css/editor.min.css?ver=4.2.21" type="text/css" media="all">
                      <div id="wp-content-editor-container" class="wp-editor-container"><div id="qt_content_toolbar" class="quicktags-toolbar"><input type="button" id="qt_content_strong" class="ed_button button button-small" value="b"><input type="button" id="qt_content_em" class="ed_button button button-small" value="i"><input type="button" id="qt_content_link" class="ed_button button button-small" value="link"><input type="button" id="qt_content_block" class="ed_button button button-small" value="b-quote"><input type="button" id="qt_content_del" class="ed_button button button-small" value="del"><input type="button" id="qt_content_ins" class="ed_button button button-small" value="ins"><input type="button" id="qt_content_img" class="ed_button button button-small" value="img"><input type="button" id="qt_content_ul" class="ed_button button button-small" value="ul"><input type="button" id="qt_content_ol" class="ed_button button button-small" value="ol"><input type="button" id="qt_content_li" class="ed_button button button-small" value="li"><input type="button" id="qt_content_code" class="ed_button button button-small" value="code"><input type="button" id="qt_content_close" class="ed_button button button-small" title="Close all open tags" value="close tags"></div><textarea class="wp-editor-area" rows="20" cols="40" name="content" id="content">lkmmklmlk</textarea></div>
                  </div>

                  <input type="hidden" id="closedpostboxesnonce" name="closedpostboxesnonce" value="43871405cb"></div>
          </div>
      </div>
      <div class="col-md-3">
          <div id="postbox-container-1" class="postbox-container">
              <div id="submitdiv" class="stuffbox">
                  <h3><span class="hndle">Status</span></h3>
                  <div class="inside">
                      <div class="submitbox" id="submitcomment">
                          <div id="minor-publishing">

                              <div id="minor-publishing-actions">
                                  <div id="preview-action">
                                      <a class="preview button" href="http://ukprintplus.co.uk/uncategorized/business-cards/#comment-284" target="_blank">View Comment</a>
                                  </div>
                                  <div class="clear"></div>
                              </div>

                              <div id="misc-publishing-actions">

                                  <div class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
                                      <label class="approved"><input type="radio" checked="checked" name="comment_status" value="1">Approved</label><br>
                                      <label class="waiting"><input type="radio" name="comment_status" value="0">Pending</label><br>
                                      <label class="spam"><input type="radio" name="comment_status" value="spam">Spam</label>
                                  </div>

                                  <div class="misc-pub-section misc-pub-comment-author-ip">
                                      IP address: <strong><a href="http://whois.arin.net/rest/ip/172.68.126.40">172.68.126.40</a></strong>
                                  </div>

                                  <div class="misc-pub-section curtime misc-pub-curtime">
                                      <span id="timestamp">Submitted on: <b>Oct 16, 2018 @ 11:13</b></span>&nbsp;<a href="#edit_timestamp" class="edit-timestamp hide-if-no-js">Edit</a>
                                      <div id="timestampdiv" class="hide-if-js"><div class="timestamp-wrap"><label for="mm" class="screen-reader-text">Month</label><select id="mm" name="mm">
                                                  <option value="01">01-Jan</option>
                                                  <option value="02">02-Feb</option>
                                                  <option value="03">03-Mar</option>
                                                  <option value="04">04-Apr</option>
                                                  <option value="05">05-May</option>
                                                  <option value="06">06-Jun</option>
                                                  <option value="07">07-Jul</option>
                                                  <option value="08">08-Aug</option>
                                                  <option value="09">09-Sep</option>
                                                  <option value="10" selected="selected">10-Oct</option>
                                                  <option value="11">11-Nov</option>
                                                  <option value="12">12-Dec</option>
                                              </select> <label for="jj" class="screen-reader-text">Day</label><input type="text" id="jj" name="jj" value="16" size="2" maxlength="2" autocomplete="off">, <label for="aa" class="screen-reader-text">Year</label><input type="text" id="aa" name="aa" value="2018" size="4" maxlength="4" autocomplete="off"> @ <label for="hh" class="screen-reader-text">Hour</label><input type="text" id="hh" name="hh" value="11" size="2" maxlength="2" autocomplete="off"> : <label for="mn" class="screen-reader-text">Minute</label><input type="text" id="mn" name="mn" value="13" size="2" maxlength="2" autocomplete="off"></div><input type="hidden" id="ss" name="ss" value="38">

                                          <input type="hidden" id="hidden_mm" name="hidden_mm" value="10">
                                          <input type="hidden" id="cur_mm" name="cur_mm" value="10">
                                          <input type="hidden" id="hidden_jj" name="hidden_jj" value="16">
                                          <input type="hidden" id="cur_jj" name="cur_jj" value="16">
                                          <input type="hidden" id="hidden_aa" name="hidden_aa" value="2018">
                                          <input type="hidden" id="cur_aa" name="cur_aa" value="2018">
                                          <input type="hidden" id="hidden_hh" name="hidden_hh" value="11">
                                          <input type="hidden" id="cur_hh" name="cur_hh" value="11">
                                          <input type="hidden" id="hidden_mn" name="hidden_mn" value="13">
                                          <input type="hidden" id="cur_mn" name="cur_mn" value="25">

                                          <p>
                                              <a href="#edit_timestamp" class="save-timestamp hide-if-no-js button">OK</a>
                                              <a href="#edit_timestamp" class="cancel-timestamp hide-if-no-js button-cancel">Cancel</a>
                                          </p>
                                      </div>
                                  </div>


                                  <div class="misc-pub-section misc-pub-response-to">
                                      In response to: <b><a href="http://ukprintplus.co.uk/wp-admin/post.php?post=8508&amp;action=edit">Business Cards</a></b></div>

                                  <div class="misc-pub-section misc-pub-reply-to">
                                      In reply to: <b><a href="http://ukprintplus.co.uk/uncategorized/business-cards/#comment-133">abokamal</a></b></div>

                              </div> <!-- misc actions -->
                              <div class="clear"></div>
                          </div>

                          <div id="major-publishing-actions">
                              <div id="delete-action">
                                  <a class="submitdelete deletion" href="comment.php?action=trashcomment&amp;c=284&amp;_wp_original_http_referer=http%3A%2F%2Fukprintplus.co.uk%2Fwp-admin%2Fedit-comments.php&amp;_wpnonce=722059a420">Move to Trash</a>
                              </div>
                              <div id="publishing-action">
                                  <input type="submit" name="save" id="save" class="button button-primary" value="Update"></div>
                              <div class="clear"></div>
                          </div>
                      </div>
                  </div>
              </div><!-- /submitdiv -->
          </div>
      </div>
  </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('public/admin_theme/flagstrap/css/flags.css')}}">
    <link rel="stylesheet" href="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.css">
    <link rel="stylesheet" href="{{asset('public/admin_theme/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/custom.css?v='.rand(111,999))}}">
@stop
@section('js')
    <script src="{{asset('public/admin_theme/flagstrap/js/jquery.flagstrap.js')}}"></script>
    <script src="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.js"></script>
    <script src="{{asset('public/admin_theme/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.1.2/tinymce.min.js" integrity="sha256-DdWABQXQvgw5MFqHCMQ34eo2D3GTcL6xA36LVz1sAmQ=" crossorigin="anonymous"></script>
    <script>
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
        /*$('form').submit(function(e) {
            tinymce.get().forEach(item => {
                console.log(item.id)
                let html = item.getBody().innerHTML
                $(`#${item.id}`).val(html)
                console.log($(`#${item.id}`).val())
            })
        // DO STUFF...
            e.preventDefault()
        return false; // return false to cancel form action
        });*/
    </script>
    <script>


    </script>
    <script>
        $(function () {
            $(".sortable-panels").sortable();
            $(".sortable-panels").disableSelection();
        });
    </script>
    <script>
        var userList = null;
        $.ajax({
            url: "/admin/get-categories",
            type: "POST",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $("input[name='_token']").val()
            },
            success: function (data) {
                userList = data;
            }
        });
        $("#input-category").tagsinput({
            maxTags: 5,
            confirmKeys: [13, 32, 44],
            typeaheadjs: {
                // name: "citynames",
                displayKey: "name",
                valueKey: "name",
                source: function (query, processSync, processAsync) {
                    return $.ajax({
                        url: "/admin/get-categories",
                        type: "POST",
                        data: {query: query},
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": $("input[name='_token']").val()
                        },
                        success: function (json) {
                            return processAsync(json);
                        }
                    });
                },
                templates: {
                    empty: ['<div class="empty-message">', "No results", "</div>"].join(
                        "\n"
                    ),
                    header: "<h4>Categoris</h4><hr>",
                    suggestion: function (data) {
                        return `<div class="user-search-result"><span> ${data.name} </span></div>`;
                    }
                }
            }
        });
        $("#input-category").on("beforeItemAdd", function (event) {
            event.cancel = true;
            let valueCatergorayName = $("#category-names").val()
            if (!valueCatergorayName.includes(event.item)) {
                $(".coupon-category-list").append(makeSearchHtml(event.item))
                if ($("#category-names").val().trim()) {
                    let arr = JSON.parse($("#category-names").val())
                    arr.push(event.item)
                    $("#category-names").val(JSON.stringify(arr))

                    console.log(1)
                    return
                }
                console.log(2)
                let elm = [event.item]
                $("#category-names").val(JSON.stringify(elm))
                return

            }
        });

        function makeSearchHtml(data) {

            return `<li><span class="remove-search-tag"><i class="fa fa-minus-circle"></i></span>${data}</li>`

        }

        $("body").on("click", ".remove-search-tag", function () {
            let text = $(this).closest("li").text()
            let arr = JSON.parse($("#category-names").val())
            let index = arr.indexOf(text)
            arr.splice(index, 1)
            $("#category-names").val(JSON.stringify(arr))
            $(this).closest("li").remove()

        })
    </script>
@stop