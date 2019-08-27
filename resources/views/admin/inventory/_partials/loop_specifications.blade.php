@if(count($data))
    @foreach($data as $selected)
        @include('admin.inventory._partials.specifications')
    @endforeach
@endif
