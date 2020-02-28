<div class="options-form">

        {!! Form::model($model,['url'=>route('post_admin_stock_statuses_manage',($model?$model->id:null))]) !!}
        {!! Form::hidden('id',null) !!}
        {!! Form::hidden('type',$type) !!}

        @if(count(get_languages()))
            <div class="head-space-between">
                <ul class="nav nav-tabs">
                    @foreach(get_languages() as $language)
                        <li class="nav-item">
                            <a data-toggle="tab" href="#{{ strtolower($language->code) }}" class="nav-link @if($loop->first) active @endif">
                                <span class="flag-icon flag-icon-{{ strtolower($language->code) }}"></span> {{ $language->code }}
                            </a></li>
                    @endforeach
                </ul>
                    {!! Form::submit('Save',['class' => 'btn btn-info']) !!}
            </div>

        @endif
        <div class="tab-content">
            @if(count(get_languages()))
                @foreach(get_languages() as $language)
                    <div id="{{ strtolower($language->code) }}"
                         class="tab-pane @if($loop->first) in active @endif">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Status Name</label>
                                    {!! Form::text('translatable['.strtolower($language->code).'][name]',get_translated($model,strtolower($language->code),'name'),['class'=>'form-control','required'=>(($loop->first)?true:false)]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Description</label>
                                    {!! Form::textarea('translatable['.strtolower($language->code).'][description]',get_translated($model,strtolower($language->code),'description'),['class'=>'form-control','required'=>(($loop->first)?true:false),'rows'=>5]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
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
            <div class="row">
                <div class="col-md-10">
                    <label>Color</label>
                    {{--{!! Form::text('color',null,['class'=>'form-control','required'=>true]) !!}--}}
                    <div class="color_select_wall">
                        <select name="color" id="colorselector_2">
                            <option value="#A0522D"
                                    data-color="#A0522D" {!! ($model && $model->color == '#A0522D') ? 'selected' : '' !!}>
                                sienna
                            </option>
                            <option value="#CD5C5C"
                                    data-color="#CD5C5C" {!! ($model && $model->color == '#CD5C5C') ? 'selected' : '' !!}>
                                indianred
                            </option>
                            <option value="#FF4500"
                                    data-color="#FF4500" {!! ($model && $model->color == '#FF4500') ? 'selected' : '' !!}>
                                orangered
                            </option>
                            <option value="#008B8B"
                                    data-color="#008B8B" {!! ($model && $model->color == '#008B8B') ? 'selected' : '' !!}>
                                darkcyan
                            </option>
                            <option value="#B8860B"
                                    data-color="#B8860B" {!! ($model && $model->color == '#B8860B') ? 'selected' : '' !!}>
                                darkgoldenrod
                            </option>
                            <option value="#32CD32"
                                    data-color="#32CD32" {!! ($model && $model->color == '#32CD32') ? 'selected' : '' !!}>
                                limegreen
                            </option>
                            <option value="#FFD700"
                                    data-color="#FFD700" {!! ($model && $model->color == '#FFD700') ? 'selected' : '' !!}>
                                gold
                            </option>
                            <option value="#48D1CC"
                                    data-color="#48D1CC" {!! ($model && $model->color == '#48D1CC') ? 'selected' : '' !!}>
                                mediumturquoise
                            </option>
                            <option value="#87CEEB"
                                    data-color="#87CEEB" {!! ($model && $model->color == '#87CEEB') ? 'selected' : '' !!}>
                                skyblue
                            </option>
                            <option value="#FF69B4"
                                    data-color="#FF69B4" {!! ($model && $model->color == '#FF69B4') ? 'selected' : '' !!}>
                                hotpink
                            </option>
                            <option value="#87CEFA"
                                    data-color="#87CEFA" {!! ($model && $model->color == '#87CEFA') ? 'selected' : '' !!}>
                                lightskyblue
                            </option>
                            <option value="#6495ED"
                                    data-color="#6495ED" {!! ($model && $model->color == '#6495ED') ? 'selected' : '' !!}>
                                cornflowerblue
                            </option>
                            <option value="#DC143C"
                                    data-color="#DC143C" {!! ($model && $model->color == '#DC143C') ? 'selected' : '' !!}>
                                crimson
                            </option>
                            <option value="#FF8C00"
                                    data-color="#FF8C00" {!! ($model && $model->color == '#FF8C00') ? 'selected' : '' !!}>
                                darkorange
                            </option>
                            <option value="#C71585"
                                    data-color="#C71585" {!! ($model && $model->color == '#C71585') ? 'selected' : '' !!}>
                                mediumvioletred
                            </option>
                            <option value="#000000"
                                    data-color="#000000" {!! ($model && $model->color == '#000000') ? 'selected' : '' !!}>
                                black
                            </option>
                        </select> <br/>
                        {{--<button class="btn" type="button" id="setColor">set by color (#008B8B)</button>--}}
                        {{--<button class="btn" type="button" id="setValue">set by value (18)</button>--}}
                        {{--<input type="text" id="colorValue" />--}}
                        {{--<input type="text" id="colorColor" />--}}
                        {{--<input type="text" id="colorTitle" />--}}
                    </div>
                </div>
                <div class="col-md-2">
                    <i id="font-show-area"></i>
                </div>
            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--<a href="#" class="btn btn-warning pull-right">Create Email</a>--}}
        {{--</div>--}}

        {!! Form::close() !!}
</div>
