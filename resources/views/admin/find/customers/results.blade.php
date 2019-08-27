<div class="d-flex flex-wrap">
    @if(count($customers))
        @foreach($customers as $customer)
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
{{--                                <h5 class="card-title">{{ $product->name }}</h5>--}}
                                <p class="card-text">
                                    {!! $customer->name !!}
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
