
<input type="hidden" id="core-folder" value="{!! $id !!}">
<div class="bestbetter-modal">
    <!-- Trigger the modal with a button -->
    <div class="bestbetter-modal-open">
        @if($multiple)
            @if(isset($model->$name) && (is_array($model->$name) || is_object($model->$name)) )
                <input type="text" data-name="{!! $name !!}[]"
                       data-count="{{ (is_object($model->$name)) ? count($model->$name): count(array_filter($model->$name)) }}"
                       value="{!! (is_object($model->$name)) ? count($model->$name):count(array_filter($model->$name)) !!} selected" placeholder="file count"
                       class="modal-input-path {!! $uniqId !!}" readonly>
                @foreach($model->$name as $image)
                    @if($image)
                        @if(is_object($image))
                            <input type="hidden" name="{!! $name !!}[]"
                               value="{!! $image->url !!}" placeholder="file name"
                               class="modal-input-path multipale-hidden-inputs" readonly>
                        @else
                            <input type="hidden" name="{!! $name !!}[]"
                                   value="{!! $image !!}" placeholder="file name"
                                   class="modal-input-path multipale-hidden-inputs" readonly>
                        @endif
                    @endif
                @endforeach
            @else
                <input type="hidden" data-name="{!! $name !!}[]"
                       value="no selected" placeholder="file count"
                       class="modal-input-path {!! $uniqId !!}" readonly>
            @endif
        @else
            @if($model && is_array($model))
                <input type="text" name="{!! $name !!}"
                       value="{!! (isset($model[$name]))?$model[$name]:null !!}" placeholder="file name"
                       class="modal-input-path {!! $uniqId !!}" readonly>
            @elseif($model && is_object($model))
                <input type="text" name="{!! $name !!}"
                       value="{!! ($model)?((isset($model->$name))?$model->$name:null):null !!}" placeholder="file name"
                       class="modal-input-path {!! $uniqId !!}" readonly>
            @else
                <input type="text" name="{!! $name !!}"
                       value="{!! ($model)?$model:null !!}" placeholder="file name"
                       class="modal-input-path {!! $uniqId !!}" readonly>
            @endif
        @endif
        <button type="button" data-multiple="{!! ($multiple)?'true':'false' !!}" id="{!! $uniqId !!}"
                class="btn btn-lg " data-toggle="modal" data-target="#myModal">
            Update
        </button>
    </div>
    @if($multiple)
        <div class="multiple-image-placeholder multiple-image-box-{!! $uniqId !!}">
            @if(isset($model->$name) && (is_array($model->$name) || is_object($model->$name) ))
                @foreach($model->$name as $image)
                    @if($image)
                        @if(is_object($image))
                            <div class="img-thumb-container" style="margin: 10px;">
                                <div class="inner"><img src="{{ $image->url }}" width=200>
                                    <span data-src="{{ $image->url }}" data-id="{!! $uniqId !!}" class="remove-thumb-img"
                                          data-is-multiple="true">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="img-thumb-container" style="margin: 10px;">
                                <div class="inner"><img src="{{ $image }}" width=200>
                                    <span data-src="{{ $image }}" data-id="{!! $uniqId !!}" class="remove-thumb-img"
                                                                                   data-is-multiple="true">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            @endif
        </div>
    @else
        @if($model && is_array($model))
            @if(isset($model[$name]))
                @php
                    $mi = $model[$name];
                @endphp
                @if($html)
                    @php
                        $html = str_replace('{img_path_for_media}',$mi,$html);
                        $html = str_replace('{data_id}',$uniqId."_media_single_img",$html);
                    @endphp
                    {!! $html !!}
                @else
                    <img src="{{ $mi }}" class="img img-responsive {!! $uniqId."_media_single_img" !!}" width="100px" data-id="{!! $uniqId."_media_single_img" !!}" alt="{{ $mi }}"/>
                @endif
            @endif
        @elseif($model && is_object($model))
            @if(isset($model->$name))
                @php
                    $mi = $model->$name;
                @endphp
                @if($html)
                    @php
                        $html = str_replace('{img_path_for_media}',$mi,$html);
                        $html = str_replace('{data_id}',$uniqId."_media_single_img",$html);
                    @endphp
                    {!! $html !!}
                @else
                    <img src="{{ $mi }}" class="img img-responsive {!! $uniqId."_media_single_img" !!}" width="100px" data-id="{!! $uniqId."_media_single_img" !!}" alt="{{ $mi }}"/>
                @endif
            @endif
        @else
            @if($model)
                @php
                    $mi = $model;
                @endphp
                @if($html)
                    @php
                        $html = str_replace('{img_path_for_media}',$mi,$html);
                        $html = str_replace('{data_id}',$uniqId."_media_single_img",$html);

                    @endphp
                    {!! $html !!}
                @else
                    <img src="{{ $mi }}" class="img img-responsive {!! $uniqId."_media_single_img" !!}" width="100px" data-id="{!! $uniqId."_media_single_img" !!}" alt="{{ $mi }}"/>
                @endif
            @endif
        @endif
    @endif
</div>
