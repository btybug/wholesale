@php
    $permissions=config('permissions');
if(!isset($role))$role=null;
@endphp
@foreach($permissions as $key=>$permission)
    <div class="card panel panel-default panel-create-role mb-2">
        <div class="card-header panel-heading">
            <div class="user">{!! $key !!}</div>
            <div class="d-flex align-items-center flex-wrap align-items-center">
                <label class="d-flex align-items-center"><span>Select All</span><input type="checkbox" class="ml-1 select_all_js"></label>
                <label for="has-access" class="d-flex align-items-center ml-3"><span>Has access</span><input name="has_access[]" value="{!! $key !!}" @if(has_permission($role,$key))checked @endif type="checkbox" class="ml-1 has_access"></label>
            </div>
        </div>
        <div class="card-body panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="d-flex align-items-center"><input type="checkbox" class="mr-2 view_checkbox_all_js select_column_js"><span>View</span></label>
                            </div>
                        </th>
                        <th>
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="d-flex align-items-center"><input type="checkbox" class="mr-2 edit_checkbox_all_js select_column_js"><span>Edit</span></label>
                            </div>
                        </th>
                        <th>
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="d-flex align-items-center"><input type="checkbox" class="mr-2 create_checkbox_all_js select_column_js"><span>Create</span></label>
                            </div>
                        </th>
                        <th>
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="d-flex align-items-center"><input type="checkbox" class="mr-2 delete_checkbox_all_js select_column_js"><span>Delete</span></label>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permission as $sub=>$item )
                        <tr>

                            <td>{!! $item['name'] !!}</td>
                            <td><input name="permission[]" value="{!! $key.'.'.$sub.'.routes' !!}" 
                                type="checkbox" @if(has_permission($role,$key.'.'.$sub.'.routes'))checked @endif class="view_checkbox_js checkbox_js"></td>
                            <td><input name="permission[]" value="{!! $key.'.'.$sub.'.children.edit.routes' !!}" 
                                type="checkbox" @if(has_permission($role,$key.'.'.$sub.'.children.edit.routes'))checked @endif class="edit_checkbox_js checkbox_js"></td>
                            <td><input name="permission[]" value="{!! $key.'.'.$sub.'.children.create.routes' !!}" 
                                type="checkbox" @if(has_permission($role,$key.'.'.$sub.'.children.create.routes'))checked @endif class="create_checkbox_js checkbox_js"></td>
                            <td><input name="permission[]" value="{!! $key.'.'.$sub.'.children.delete.routes' !!}" 
                                type="checkbox" @if(has_permission($role,$key.'.'.$sub.'.children.delete.routes'))checked @endif class="delete_checkbox_js checkbox_js"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endforeach