<div class="options-form">

        {!! Form::model($model,['url'=>route('admin_tools_stickers_manage',($model?$model->id:null))]) !!}
        {!! Form::hidden('id',null) !!}
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Stickers</span>
            <div>
                @if($model)
                    <a href="javascript:void(0)" data-href="{{ route("admin_tools_stickers_delete") }}"
                       class="delete-button btn btn-danger" data-key="{{ $model->id }}">Delete</a>
                @endif
                {!! Form::submit('Save',['class' => 'btn btn-info']) !!}
            </div>
        </div>
        <div class="card-body">
            @if(count(get_languages()))
                <div class="head-space-between">
                    <ul class="nav nav-tabs">
                        @foreach(get_languages() as $language)
                            <li class="nav-item"><a class="nav-link @if($loop->first) active @endif" data-toggle="tab"
                                                    href="#{{ strtolower($language->code) }}">
                                    <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                                </a></li>
                        @endforeach
                    </ul>

                </div>
            @endif
            <div class="tab-content">
                @if(count(get_languages()))
                    @foreach(get_languages() as $language)
                        <div id="{{ strtolower($language->code) }}"
                             class="tab-pane fade  @if($loop->first) in active show @endif">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-2 col-form-label">Sticker Name</label>
                                    <div class="col-md-10">
                                        {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($model,strtolower($language->code),'name'),['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-2 col-form-label">Sticker Description</label>
                                    <div class="col-md-10">
                                        {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($model,strtolower($language->code),'description'),['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-2 col-form-label">Sticker slug</label>
                    <div class="col-md-10">
                        {!! Form::text('slug',null,['class'=>'form-control','required'=>true]) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-2 col-form-label">Attributes</label>
                    <div class="col-md-10">
                        {!! Form::select('attributes[]',$attributes,($model)?$model->attrs->pluck('id','id')->all():null,['class'=>'form-control sticker_attribute','multiple' => true]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            Image
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <label class="col-md-2 col-form-label">Image</label>
                    <div class="col-md-10">
                        {!! media_button('image',$model) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--        <div class="form-group">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-10">--}}
{{--                    <label>Text color</label>--}}
{{--                    --}}{{--{!! Form::text('color',null,['class'=>'form-control','required'=>true]) !!}--}}
{{--                    <div class="color_select_wall">--}}
{{--                        <select name="color" id="colorselector_2">--}}
{{--                            @foreach(colors() as $name => $hex)--}}
{{--                                <option value="{{ $hex }}" data-color="{{ $hex }}" {!! ($model && $model->color == $hex) ? 'selected' : '' !!}>{{ $name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select> <br />--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-2">--}}
{{--                    <i id="font-show-area"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group">

        </div>

        {!! Form::close() !!}

</div>
