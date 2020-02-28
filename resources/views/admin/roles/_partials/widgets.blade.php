@php
    $permissions=config('widgets');
if(!isset($role))$role=null;
@endphp
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Give access</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $key => $item )
            <tr>

                <td>{!! $item['name'] !!}</td>
                <td>{!! $item['description'] !!}</td>
                <td>
                    <input name="permission[]" value="{!! $key !!}"
                           type="checkbox" class="widget_checkbox_js"
                           @if(has_permission($role,$key))checked @endif>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>