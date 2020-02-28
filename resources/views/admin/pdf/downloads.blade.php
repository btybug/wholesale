@foreach($order->items as $item)
    @if($item->stock && $item->stock->downloads && count($item->stock->downloads))
        @foreach($item->stock->downloads as $img)
            <img src="{!! $img !!}" class="img img-responsive" />
        @endforeach
    @endif
@endforeach
