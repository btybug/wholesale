<div class="bestbetter-modal">
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <div class="content ">
            <div class="left">
              <div id="jstree_html" class="demo">

              </div>
            </div>
            <div class="media_modal_right_content">
              <div class="content-upload media-modal-content-upload">
                <div class="upload-content">
                  <div class="uploader-container">
                    <input id="uploader" class="file-loading" data-folder-id="{!! 1 !!}" multiple name="item[]"
                           type="file" data-upload-url="{!!route('media_upload') !!}">
                  </div>
                  <!-- <button type="button" class="btn btn-default mb-20" data-role="btnUploader" bb-media-click="show_uploader">Uploader</button> -->
                </div>
              </div>
              <div class="row main-content media-modal-main-content modal_img_container" data-type="main-container">
                <!-- <div class="icon">
                    <i class="fa fa-folder" aria-hidden="true"></i>
                    <ul class="list-unstyled list-inline text-center icons">
                        <li class="text-center"><a href="#"><i class="fa fa-info" aria-hidden="true"></i></a></li>
                        <li class="text-center"><a href="#" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                        <li class="text-center"><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                    </ul>
                </div> -->
                <div class="img">
                  <a href="#">
                    <img src="http://www.apicius.es/wp-content/uploads/2012/07/IMG-20120714-009211.jpg" alt="">
                  </a>
                  <ul class="list-unstyled list-inline text-center icons">
                    <li class="text-center"><a href="#"><i class="fa fa-info" aria-hidden="true"></i></a></li>
                    <li class="text-center">
                      <a href="http://www.apicius.es/wp-content/uploads/2012/07/IMG-20120714-009211.jpg" target="_blank"
                         data-lightbox="folder-set" data-title="Images title">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li class="text-center"><a href="#"><i class="fa fa-remove" aria-hidden="true"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>


          </div>


        </div>
      </div>
      <div class="modal-footer">
        <input type="text" class="pull-left file-realtive-url" placeholder="upload file name" style="display: none">
        <button type="button" class="btn btn-info" bb-media-click="folder_level_up"><i class="fa fa-level-up"
                                                                                       aria-hidden="true"></i></button>
        <button type="button" class="btn btn-success upload-btn __btn_upload" bb-media-click="open_uploader">Upload
        </button>
        <button type="button" class="btn btn-info open-btn" bb-media-click="open_images" data-dismiss="modal">Open
        </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>


<script type="template" id="media-modal-folder">
  <div class="icon">
    <i class="fa fa-folder" aria-hidden="true"></i>
    <span>{name}</span>
    <ul class="list-unstyled list-inline text-center icons ">
      <li class="text-center"><a href="#"><i class="fa fa-info" aria-hidden="true"></i></a></li>
      <li class="text-center"><a href="#" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
      <li class="text-center"><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
    </ul>
  </div>
</script>


@push("javascript")
<script>
  $(document).ready(function () {
    $(".__btn_upload").click(function () {
      $('.media_modal_right_content').animate({
        scrollTop: 0
      }, 1);
    })
  })
</script>

@endpush

{{--upload-content--}}

<!-- <script type="template" id="media-modal-files">
    <div class="img">
        <a href="#" >
            <img src="{url}" alt="">
        </a>
        <ul class="list-unstyled list-inline text-center icons item-for-upload" data-item-id={data-item-id} data-relative-url="{relative_path}">
            <li class="text-center"><a href="#"><i class="fa fa-info" aria-hidden="true"></i></a></li>
            <li class="text-center">
                <a href="{url}" target="_blank" data-lightbox="folder-set" data-title="{name}">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
            </li>
            <li class="text-center"><a href="#" data-item-id={data-item-id} class="remove-item-for-media"><i class="fas fa-exchange-alt"></i></a></li>
        </ul>
    </div>
</script> -->



