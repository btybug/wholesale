@php
$brands = \App\Models\Category::where('type','brands')->get();
@endphp
<div class="filter-wall cat-name row">
    <div class="col-12 p-sm-0">
        @if(count($brands))
            @foreach($brands as $brand)
                <div class="single-wrap">
                    <div class="custom-control custom-checkbox custom-control-inline align-items-center">
                        {!! Form::checkbox("brands[]",$brand->id,null,['class' => 'custom-control-input','id' => 'customCheck'."brands".$brand->id]) !!}
                        <label class="custom-control-label text-gray-clr font-15"
                               for="customCheck{{ "brands".$brand->id }}">{{ $brand->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
