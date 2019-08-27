@php
    $uniqueID = uniqid();
@endphp
<tr>
    <td>
        {!! Form::text("packages[$uniqueID][name]",($package) ? $package->name : null,['class' => 'form-control']) !!}
        {!! Form::hidden("packages[$uniqueID][id]",($package) ? $package->id : null) !!}
    </td>
    <td>
        {!! Form::select("packages[$uniqueID][package_item_id]",$items,($package) ? $package->package_item_id : null,['class' => 'form-control']) !!}
    </td>
    <td>
        {!! Form::number("packages[$uniqueID][qty]",($package) ? $package->qty : null,['class' => 'form-control']) !!}
    </td>
    <td>
        <button type="button" class="btn btn-danger delete-v-option delete-v-option_button"><i class="fa fa-trash"></i></button>
    </td>
</tr>
