<div class="del-save--btn">
    @if($model)
        <div class="form-group m-r-5">
            <a class="btn btn-danger delete-button" data-key="{{ $model->id }}" data-href="{{ route('admin_store_categories_delete',$type) }}">Delete</a>
        </div>
    @endif
        @ok('admin_store_categories_form')
    <div class="form-group">
        {!! Form::submit('Save',['class' => 'btn btn-info btn-submit-form']) !!}
    </div>
    @endok
</div>

{!! Form::model($model,['url' => route('admin_store_categories_new_or_update',$type),'class' => 'updated-form']) !!}
{!! Form::hidden('id',null) !!}
{!! Form::hidden('type',$type) !!}

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
                <div class="form-group row mt-10">
                    <label class="col-md-2 col-xs-12">Category Name</label>
                    <div class="col-md-10">
                        {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($model,strtolower($language->code),'name'),['class'=>'form-control','required'=>true]) !!}
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-xs-12">Description</label>
                    <div class="col-md-10 col-xs-12">
                        {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($model,strtolower($language->code),'description'),['class'=>'form-control','required'=>true]) !!}
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
<div class="form-group row">
    <label class="col-md-2 col-xs-12">Slug</label>
    <div class="col-md-10 col-xs-12">
        {!! Form::text('slug',null,['class'=>'form-control','required'=>true]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2 col-xs-12">Custom classes</label>
    <div class="col-md-10 col-xs-12">
        {!! Form::text('classes',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2 col-xs-12">Parent</label>
    <div class="col-md-10 col-xs-12">
        {!! Form::select('parent_id',[''=>'No Parent'] + get_pluck($allCategories,'id','name'),null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2 col-xs-12">Select stickers</label>
    <div class="col-md-10 col-xs-12">
        {!! Form::select('stickers[]',$stickers,null,['class'=>'form-control','id' => 'select-stickers','multiple' => true]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2 col-xs-12">Icon</label>
        <div class="col-md-10 col-xs-12">
            <div class="row">
                <div class="col-md-10 col-xs-12">
                    {!! Form::text('icon',null,['class'=>'form-control icon-picker','required'=>true]) !!}
                </div>
                <div class="col-md-2 col-xs-12">
                    <i id="font-show-area"></i>
                </div>
            </div>
        </div>
</div>

<div class="form-group row">
    <label class="col-md-2 col-xs-12">Image</label>
    <div class="col-md-10 col-xs-12">
        {!! media_button('image',$model) !!}
    </div>
</div>

{!! Form::close() !!}

@if(is_enabled_media_modal())
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="{!! url('public/admin_theme/media/js/lightbox.js') !!}"></script>
    <script src="{!! url('public/admin_theme/media/js/jstree.min.js') !!}"></script>
    <script src="{!! url('public/admin_theme/media/js/custom.js') !!}"></script>
    <script src="{!! url('public/admin_theme/fileinput/js/fileinput.min.js') !!}"></script>
@endif