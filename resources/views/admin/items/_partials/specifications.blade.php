@php
    $uniqueID = uniqid();
    $name = null;
    $id = null;
@endphp
@foreach($allAttrs as $allAttr)
    @if(isset($model))
        @if(isset($selected) && $selected->attributes_id == $allAttr->id)
            @if($allAttr->name)
                @php
                    $name = $allAttr->name;
                    $id = (isset($selected))?$selected->attributes_id:null;
                @endphp
            @endif
        @endif
    @else
        @if(isset($selected) && $selected->id == $allAttr->id)
            @if($allAttr->name)
                @php
                    $name = $allAttr->name;
                   $id = (isset($selected))?$selected->id:null;
                @endphp
            @endif
        @endif
    @endif
@endforeach
@if($name)
<tr class="v-options-list-item">
    <td class="w-20">
        <div class="form-control">
            {{--@if(isset($model))--}}
                {{--{!! Form::hidden("specifications[$uniqueID ][attributes_id]",(isset($selected))?$selected->attributes_id:null) !!}--}}
            {{--@else--}}
                {{--{!! Form::hidden("specifications[$uniqueID ][attributes_id]",(isset($selected))?$selected->id:null) !!}--}}
            {{--@endif--}}
            {!! $name !!}
            @if($id)
                {!! Form::hidden("specifications[$uniqueID ][attributes_id]",$id) !!}
            @endif
        </div>
        {{--<select readonly="true" data-uid="{{ $uniqueID }}" name="specifications[{{ $uniqueID }}][attributes_id]"--}}
                {{--class="form-control select-specification" placeholder="Select">--}}
            {{--<option val="">Select</option>--}}

            {{--@foreach($allAttrs as $allAttr)--}}
                {{--@if(isset($model))--}}
                    {{--<option--}}
                        {{--{{ (isset($selected) && $selected->attributes_id == $allAttr->id) ? 'selected' : '' }} value="{{ $allAttr->id }}">{{ $allAttr->name }}</option>--}}
                {{--@else--}}
                    {{--<option--}}
                        {{--{{ (isset($selected) && $selected->id == $allAttr->id) ? 'selected' : '' }} value="{{ $allAttr->id }}">{{ $allAttr->name }}</option>--}}
                {{--@endif--}}
            {{--@endforeach--}}
        {{--</select>--}}
    </td>
    <td class="w-50">
        @php
            if(isset($model)){
                $type_options = (isset($selected) && $selected && count($selected->children)) ? $selected->children->pluck('sticker_id')->all() : [];
                $type_optionArray = (isset($selected) && $selected && $selected->attr) ? $selected->attr->stickers->pluck('name','id')->all() : [];
            }else{
                $type_options = [];
                $type_optionArray = (isset($selected) && $selected && count($selected->stickers)) ? $selected->stickers->pluck('name','id')->all() : [];
            }
        @endphp

        @if(isset($selected) && $selected)
            @if(isset($model))
                {!! Form::select("options[$selected->attributes_id][]",$type_optionArray,$type_options,['class' => "tag-input-v input-items-value v-input-$uniqueID form-control",'multiple' => true]) !!}

            @else
                {!! Form::select("options[$selected->id][]",$type_optionArray,$type_options,['class' => "tag-input-v input-items-value v-input-$uniqueID form-control",'multiple' => true]) !!}

            @endif
        @else
            {!! Form::select("options[][]",$type_optionArray,$type_options,['class' => "tag-input-v input-items-value v-input-$uniqueID form-control",'multiple' => true]) !!}
        @endif

    </td>
    <td colspan="2" class="text-right">
        {{--<button type="button" class="btn btn-danger delete-v-option_button"><i--}}
                {{--class="fa fa-minus-circle delete-v-option"></i></button>--}}
    </td>
</tr>
@endif
