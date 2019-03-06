@if($model)
    {!! Form::model($model,['url' => route('admin_store_categories_delete')]) !!}
    {!! Form::hidden('id',null) !!}
    <div class="form-group">
        {!! Form::submit('delete',['class' => 'btn btn-danger']) !!}
    </div>
@endif
{!! Form::close() !!}

{!! Form::model($model,['url' => route('admin_store_categories_new_or_update')]) !!}
{!! Form::hidden('id',null) !!}

@if(count(get_languages()))
    <ul class="nav nav-tabs">
    @foreach(get_languages() as $language)
            <li class="@if($loop->first) active @endif"><a data-toggle="tab" href="#{{ strtolower($language->code) }}">
                    <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}</a></li>
    @endforeach
    </ul>
@endif


<div class="tab-content">
    @if(count(get_languages()))
        @foreach(get_languages() as $language)
            <div id="{{ strtolower($language->code) }}" class="tab-pane fade  @if($loop->first) in active @endif">
                <div class="form-group">
                    <label>Category Name</label>
                    {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($model,strtolower($language->code),'name'),['class'=>'form-control','required'=>true]) !!}
                </div>
                <div class="form-group">
                    <label>Description</label>
                    {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($model,strtolower($language->code),'description'),['class'=>'form-control','required'=>true]) !!}
                </div>
            </div>
        @endforeach
    @endif
</div>
<div class="form-group">
    <label>Slug</label>
    {!! Form::text('slug',null,['class'=>'form-control','required'=>true]) !!}
</div>
<div class="form-group">
    <label>Parent</label>
    {!! Form::select('parent_id',[''=>'No Parent'] + get_pluck($allCategories,'id','name'),null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-10">
            <label>Icon</label>
            {!! Form::text('icon',null,['class'=>'form-control icon-picker','required'=>true]) !!}
        </div>
        <div class="col-md-2">
            <i id="font-show-area"></i>
        </div>
    </div>
</div>

<div class="form-group">
    <label>Image</label>
    {!! media_button('image',$model) !!}
</div>
<div class="form-group">
    {!! Form::submit('Save',['class' => 'btn btn-info']) !!}
</div>
{!! Form::close() !!}

@if(is_enabled_media_modal())
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="{!! url('public/admin_theme/media/js/lightbox.js') !!}"></script>
    <script src="{!! url('public/admin_theme/media/js/jstree.min.js') !!}"></script>
    <script src="{!! url('public/admin_theme/media/js/custom.js') !!}"></script>
    <script src="{!! url('public/admin_theme/fileinput/js/fileinput.min.js') !!}"></script>
    <script>
        // $("#input-ru").fileinput({
        //     language: "ru",
        //     uploadUrl: "/api/api-media/upload",
        //     allowedFileExtensions: ["jpg", "png", "gif"]
        // });
//        $(function(){
//       $("#item").fileinput({
//           maxFileCount: 5,
//           uploadUrl: "/api/api-media/upload",
//            allowedFileExtensions: ["jpg", "png", "gif"],
//            uploadExtraData: function(){
//            return {'_token':$("meta[name='csrf-token']").attr('content'), "folder_id": _global_folder_id }
//           }
//       })
//    }).on('fileuploaded', function(event, data, id, index) {
//        // toggleUploadDivs()
//        $(".jstree-clicked").click();
//        $("#jstree_html").jstree('destroy');
//        $("#jstree_html").jstree({
//        core: {
//            data: {
//                type: "POST",
//                url: "/api/api-media/jstree",
//                dataType: "json", // needed only if you do not supply JSON headers
//                data: { folder_id: 1 },
//                headers: {
//                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
//                },
//                success: function(data) {
//                    $(".media-modal-main-content").empty();
//                    listFolders(data.children);
//                    listFiles(data.items);
//                }
//            }
//        }
//    });
//
//
//        function toggleUploadDivs(){
//        $("body").find(".media-modal-main-content").show()
//        $("body").find(".media-modal-content-upload").hide()
//    }
//    $("body").on("click", ".fileinput-remove", function(){
//        retryDrawing()
//
//        toggleUploadDivs()
//    })
//    $("body").on("click", ".file-drop-zone", function() {
//    $(".btn.btn-file>input[type='file']").click();
//});

    </script>
@endif