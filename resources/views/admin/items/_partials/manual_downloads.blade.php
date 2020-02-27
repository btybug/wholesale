@php
    $uniqueID = uniqid();
@endphp
<div class="col-md-12 d-flex flex-wrap manual-code mt-5" data-id="{!! $item->id !!}">
    {!! Form::hidden('manual_codes['.$uniqueID.'][id]',$item->id) !!}
    <div class="col-md-3">
        {!! $item->name !!}
    </div>
    <div class="col-md-6">
        {!! media_button('manual_codes['.$uniqueID.'][image]',null) !!}
    </div>
    <div class="col-md-3">
        <a class="btn btn-danger delete-manual-code" href="javascript:void(0)">Delete</a>
    </div>
</div>

