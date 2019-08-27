@php
    $uniqueID = uniqid();

@endphp
<tr class="v-options-list-item location-item">
    <td>
        {!! Form::select("locations[$uniqueID][warehouse_id]",['' => 'Select Warehouse'] + $warehouses,null,['class'=> 'form-control warehouse']) !!}
    </td>
    <td>
        {!! Form::select("locations[$uniqueID][rack_id]",['' => 'Select Rack'],null,['class'=> 'form-control rack']) !!}
    </td>
    <td>
        {!! Form::select("locations[$uniqueID][shelve_id]",['' => 'Select Shelve'], null,['class'=> 'form-control shelve']) !!}
    </td>
    <td>
        {!! Form::number("locations[$uniqueID][qty]",null,['class' => 'form-control']) !!}
    </td>
    <td colspan="2" class="text-right">
        <button type="button" class="btn btn-danger delete-v-option_button"><i
                class="fa fa-minus-circle delete-v-option"></i></button>
    </td>
</tr>




