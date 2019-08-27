<div class="d-flex flex-wrap">
    @if(count($orders))
        @foreach($orders as $order)
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="row no-gutters h-100">
                        <div class="col-md-4">
{{--                            <img--}}
{{--                                src="{{ $product->image }}"--}}
{{--                                class="card-img" alt="{{ $product->name }}">--}}
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $order->code }}</h5>
                                <p class="card-text">
{{--                                    {!! $product->short_description !!}--}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        No Results
    @endif
</div>
