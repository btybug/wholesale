<h4 class="text-center mb-5">Shipping method based on order amount</h4>

@foreach($deliveries as $delivery)
<ul class="row justify-content-center mb-5 pl-0 bg-light py-4">
    <li class="col-md-4">
        <h5>If order is {{ $delivery->min }} - {{ $delivery->max }}</h5>
    </li>
    <li class="col-md-4">
        <table class="table table-bordered">
            @foreach($delivery->options as $key=>$option)
                <tr>
                    <td>{{ $option->courier->name }}</td>
                    <td>{{ $option->time }} @if($option->time >1) days @else day @endif</td>
                    <td>{{ convert_price($option->cost,get_currency()) }}</td>
                </tr>
            @endforeach

        </table>
    </li>
</ul>
@endforeach

{{--second condition--}}
{{--<ul class="row justify-content-center mb-5 pl-0 bg-light py-4">--}}
{{--    <li class="col-md-4">--}}
{{--        <h5>If order is more than 50</h5>--}}
{{--    </li>--}}
{{--    <li class="col-md-4">--}}
{{--        <table class="table table-bordered">--}}
{{--            <tr>--}}
{{--                <td>DHL</td>--}}
{{--                <td>1 day</td>--}}
{{--                <td>free</td>--}}
{{--            </tr>--}}
{{--        </table>--}}
{{--    </li>--}}
{{--</ul>--}}
