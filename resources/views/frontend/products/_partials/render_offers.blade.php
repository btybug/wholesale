@if(count($variations))
    @foreach($variations as $variation)
        @include("frontend.products._partials.offer_option_box", ['selected' => $variation])
    @endforeach
@endif
