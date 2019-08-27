<div class="row">
    @if(count($items))
        @foreach($items as $item)
            <div class="col-md-4">
                <img src="{{ $item->image }}" class="img img-responsive" width="200">
                {{ $item->name }}
            </div>

        @endforeach
    @else
        No Items
    @endif
</div>
