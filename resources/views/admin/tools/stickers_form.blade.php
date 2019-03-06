<div class="options-form">
    <div class="col-md-8 col-md-offset-1">
        {!! Form::model($model,['url'=>route('admin_tools_stickers_manage',($model?$model->id:null))]) !!}
        {!! Form::hidden('id',null) !!}
        @if(count(get_languages()))
            <div class="head-space-between">
            <ul class="nav nav-tabs">
                @foreach(get_languages() as $language)
                    <li class="@if($loop->first) active @endif"><a data-toggle="tab"
                                                                   href="#{{ strtolower($language->code) }}">
                            <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                        </a></li>
                @endforeach
            </ul>
                @if($model)
                    <a href="javascript:void(0)" data-href="{{ route("admin_tools_stickers_delete") }}"
                    class="delete-button btn btn-danger" data-key="{{ $model->id }}">Delete</a>
                @endif
                {!! Form::submit('Save',['class' => 'btn btn-info']) !!}
            </div>
        @endif
        <div class="tab-content">
            @if(count(get_languages()))
                @foreach(get_languages() as $language)
                    <div id="{{ strtolower($language->code) }}"
                         class="tab-pane fade  @if($loop->first) in active @endif">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10">
                                    <label>Sticker Name</label>
                                    {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($model,strtolower($language->code),'name'),['class'=>'form-control','required'=>true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10">
                                    <label>Sticker Description</label>
                                    {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($model,strtolower($language->code),'description'),['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="form-group">
            <label>Image</label>
            {!! media_button('image',$model) !!}
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-10">
                    <label>Text color</label>
                    {{--{!! Form::text('color',null,['class'=>'form-control','required'=>true]) !!}--}}
                    <div class="color_select_wall">
                        <select name="color" id="colorselector_2">
                            @foreach(colors() as $name => $hex)
                                <option value="{{ $hex }}" data-color="{{ $hex }}" {!! ($model && $model->color == $hex) ? 'selected' : '' !!}>{{ $name }}</option>
                            @endforeach
                        </select> <br />
                    </div>
                </div>
                <div class="col-md-2">
                    <i id="font-show-area"></i>
                </div>
            </div>
        </div>
        <div class="form-group">

        </div>

        {!! Form::close() !!}

    </div>
</div>