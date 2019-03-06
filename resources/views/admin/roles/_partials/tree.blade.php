@php
    $permissions=config('permissions');
if(!isset($role))$role=null;
@endphp
@foreach($permissions as $key=>$permission)
    <div class="panel panel-default panel-create-role">
        <div class="panel-heading">
            <div class="user">{!! $key !!}</div>
            <div>
                <input name="has_access[]" value="{!! $key !!}" @if(has_permission($role,$key))checked @endif type="checkbox">
                <label for="has-access">Has access</label>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Create</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permission as $sub=>$item )
                        <tr>

                            <td>{!! $item['name'] !!}</td>
                            <td><input name="permission[]" value="{!! $key.'.'.$sub.'.routes' !!}" type="checkbox" @if(has_permission($role,$key.'.'.$sub.'.routes'))checked @endif></td>
                            <td><input name="permission[]" value="{!! $key.'.'.$sub.'.children.edit.routes' !!}" type="checkbox" @if(has_permission($role,$key.'.'.$sub.'.children.edit.routes'))checked @endif></td>
                            <td><input name="permission[]" value="{!! $key.'.'.$sub.'.children.create.routes' !!}" type="checkbox" @if(has_permission($role,$key.'.'.$sub.'.children.create.routes'))checked @endif></td>
                            <td><input name="permission[]" value="{!! $key.'.'.$sub.'.children.delete.routes' !!} " type="checkbox" @if(has_permission($role,$key.'.'.$sub.'.children.delete.routes'))checked @endif></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endforeach