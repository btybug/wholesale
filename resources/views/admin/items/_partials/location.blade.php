@php
    $uniqueID = uniqid();

@endphp
<tr class="v-options-list-item location-item">
    <td>
        {!! Form::hidden("locations[$uniqueID][id]",(isset($location))?$location->id : null) !!}
        {!! Form::select("locations[$uniqueID][warehouse_id]",['' => 'Select Warehouse'] + $warehouses,(isset($location))?$location->warehouse_id : null,['class'=> 'form-control warehouse']) !!}
    </td>
    <td>
        @if(isset($location) && $location->warehouse)
            @php
                $racks = $location->warehouse->categories()->whereNull('parent_id')->get()->pluck('name','id')->all();
            @endphp
        @endif
        {!! Form::select("locations[$uniqueID][rack_id]",['' => 'Select Rack']+$racks,(isset($location))?$location->rack_id : null,['class'=> 'form-control rack']) !!}
    </td>
    <td>
        @if(isset($location) && $location->rack)
            @php
                $shelves = $location->rack->children()->get()->pluck('name','id')->all();
            @endphp
        @endif
        {!! Form::select("locations[$uniqueID][shelve_id]",['' => 'Select Shelve']+$shelves,(isset($location))?$location->shelve_id : null,['class'=> 'form-control shelve']) !!}
    </td>
    <td>
        <div class="form-control">
            @if(isset($location))
                {{ $location->qty }}
            @else
                0
            @endif
        </div>
    </td>
    <td colspan="2" class="text-right">
        <button type="button" class="btn btn-danger delete-v-option_button"><i
                class="fa fa-minus-circle delete-v-option"></i></button>
    </td>
</tr>
