@php
    $uniqueID = uniqid();
@endphp
<tr class="v-options-list-item">
    <td class="w-20">
        <select data-uid="{{ $uniqueID }}" name="type_attributes[{{ $uniqueID }}][attributes_id]" class="form-control select-attribute" placeholder="Select">
               <option val="">Select</option>

           @foreach($allAttrs as $allAttr)
               <option {{ (isset($selected) && $selected->id == $allAttr->id) ? 'selected' : '' }} value="{{ $allAttr->id }}">{{ $allAttr->name }}</option>
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
                $type_options = (isset($selected) && $selected) ? $selected->stickers->pluck('id')->all() : [];
                $type_optionArray = (isset($selected) && $selected) ? $selected->stickers->pluck('name','id')->all() : [];
            }

        @endphp
        {{--<input  class="tag-input-v v-input-{{ $uniqueID }}" value="{{ $type_options_name }}">--}}
        {!! Form::select("type_attributes[$uniqueID][options][]",$type_optionArray,$type_options,['class' => "tag-input-v input-items-value v-input-$uniqueID form-control",'multiple' => true]) !!}
    </td>
    <td>
        {!! Form::select("type_attributes[$uniqueID][type]",['select' => 'Select','radio' => 'Radio','range' => 'Range','color' => 'Color'],
        (isset($selected) && $selected && $selected->pivot) ? $selected->pivot->type : null,
        ['class' => "form-control"]) !!}
    </td>
    <td colspan="2" class="text-right">
        <button type="button" class="btn btn-danger delete-v-option_button"><i
                    class="fa fa-minus-circle delete-v-option"></i></button>
    </td>
</tr>