{!! Form::model($optionModel,['url' => route('admin_store_attributes_options',$model->id)]) !!}
{!! Form::hidden('id',null) !!}
{!! Form::hidden('parent_id',$model->id) !!}
@if(count(get_languages()))
    <div class="option-edit-form-head">
        <ul class="nav nav-tabs">
            @foreach(get_languages() as $language)
                <li class="@if($loop->first) active @endif"><a data-toggle="tab" href="#{{ strtolower($language->code) }}Option">
                        <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}</a></li>
            @endforeach
        </ul>
        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-trash delete-option" data-item-id="{{ $optionModel->id }}"><i class="fa fa-trash"></i></a>
    </div>
@endif

<div class="tab-content">
    @if(count(get_languages()))
        @foreach(get_languages() as $language)
            <div id="{{ strtolower($language->code) }}Option" class="tab-pane fade  @if($loop->first) in active @endif">
                <div class="form-group">
                    <label>Option Name</label>
                    {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($optionModel,strtolower($language->code),'name'),['class'=>'form-control']) !!}
                </div>
            </div>
        @endforeach
    @endif
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-9">
            <label>Icon</label>
            {!! Form::text('icon',null,['class'=>'form-control icon-picker']) !!}
        </div>
        <div class="col-md-1 text-center font-icon-added">
            <i id="font-show-area"></i>
        </div>
    </div>
</div>
<div class="form-group ">
    <label>Image</label>
    {!! media_button('image',$model) !!}
</div>
<div class="form-group bord-top text-right">
    {!! Form::submit('Save',['class' => 'btn btn-info']) !!}
</div>
{!! Form::close() !!}


