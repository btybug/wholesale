@php
    $uniqueID = uniqid();
@endphp
<tr class="v-options-list-item">
    <td class="w-20">
        <select data-uid="{{ $uniqueID }}" name="specifications[{{ $uniqueID }}][attributes_id]" class="form-control select-specification" placeholder="Select">
               <option val="">Select</option>

           @foreach($allAttrs as $allAttr)
                @if(isset($model))
                    <option {{ (isset($selected) && $selected->attributes_id == $allAttr->id) ? 'selected' : '' }} value="{{ $allAttr->id }}">{{ $allAttr->name }}</option>
                @else
                    <option {{ (isset($selected) && $selected->id == $allAttr->id) ? 'selected' : '' }} value="{{ $allAttr->id }}">{{ $allAttr->name }}</option>
                @endif
            @endforeach
        </select>
    </td>
    <td class="w-50">
        @php
            $type_options = [];
            $type_optionArray = [];
            if(isset($noAjax)){
                if(isset($selected) && $selected && $model){
                    $type_options = $model->type_attrs_pivot()->with('sticker')->where('attributes_id',$selected->id)->get()->pluck('sticker.id')->all();
                    $type_optionArray = $selected->stickers()->get()->pluck('name','id')->all();
                }
            }else{
                if(isset($model)){
                    $type_options = (isset($selected) && $selected) ? $selected->children->pluck('sticker_id')->all() : [];
                    $type_optionArray = (isset($selected) && $selected && $selected->attr) ? $selected->attr->stickers->pluck('name','id')->all() : [];

                }else{
                     $type_options = (isset($selected) && $selected) ? $selected->stickers->pluck('id')->all() : [];
                     $type_optionArray = (isset($selected) && $selected) ? $selected->stickers->pluck('name','id')->all() : [];
                }
            }

        @endphp
        {{--<input  class="tag-input-v v-input-{{ $uniqueID }}" value="{{ $type_options_name }}">--}}
        @if(isset($selected) && $selected)
            @if(isset($model))
                {!! Form::select("options[$selected->attributes_id][]",$type_optionArray,$type_options,['class' => "tag-input-v input-items-value v-input-$uniqueID form-control",'multiple' => true]) !!}

            @else

                {!! Form::select("options[$selected->id][]",$type_optionArray,
                (isset($by_category)) ? [] :$type_options,
                ['class' => "tag-input-v input-items-value v-input-$uniqueID form-control",'multiple' => true]) !!}

            @endif
        @else
            {!! Form::select("options[][]",$type_optionArray,$type_options,['class' => "tag-input-v input-items-value v-input-$uniqueID form-control",'multiple' => true]) !!}
        @endif
    </td>
    <td colspan="2" class="text-right">
       
    </td>
</tr>
