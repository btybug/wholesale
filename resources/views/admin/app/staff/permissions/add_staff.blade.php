@extends('layouts.admin',['activePage'=>'staff'])
@section('content')
{!! Form::open() !!}
<button class="btn btn-success">Save</button>
    <div class="accordion" id="accordionExample">
        @foreach($permissionGrouped as $key=>$permissions)
            <div class="card">
                <div class="card-header" id="heading{!! $key !!}">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapse{!! $key !!}" aria-expanded="true"
                                aria-controls="collapse{!! $key !!}">
                            {!! $key !!}
                        </button>
                    </h2>
                </div>

                <div id="collapse{!! $key !!}" class="collapse show" aria-labelledby="heading{!! $key !!}"
                     data-parent="#accordionExample">
                    <div class="card-body">
                        @foreach($permissions as $permission)
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck{!! $permission->id !!}"
                                           name="permission[]" value="{!! $permission->id !!}" @if(isset($existing[$permission->id])) checked @endif>
                                    <label class="custom-control-label"
                                           for="customCheck{!! $permission->id !!}">{!! $permission->slug !!}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {!! Form::close() !!}
@stop
