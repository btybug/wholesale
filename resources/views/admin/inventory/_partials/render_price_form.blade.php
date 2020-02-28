@php
$variations = collect($model->variations()->orderBy('ordering','asc')->required()->get())->groupBy('variation_id');
@endphp

@if(count($variations))
    @foreach($variations as $variation)
        @php
            $vSettings = $variation->first();
        @endphp
        @if($vSettings->type == 'filter')
            @include("frontend.products._partials.variation_types.filter_popup")
        @elseif($vSettings->type == 'single')
            @if(\View::exists("frontend.products._partials.single.$vSettings->display_as"))
                @include("frontend.products._partials.single.$vSettings->display_as")
                {{----}}
                {{--<div class="product-single-info_row options-group">--}}
                    {{--<div class="d-flex flex-wrap align-items-center {{$vSettings->type}}" data-group-id="{{ $vSettings->variation_id }}">--}}
                        {{----}}
                    {{--</div>--}}
                    {{--<div class="product-single-info_row-items">--}}

                    {{--</div>--}}
                {{--</div>--}}
            @endif
        @else
            @if(\View::exists("frontend.products._partials.variation_types.$vSettings->display_as"))
                @include("frontend.products._partials.variation_types.$vSettings->display_as")
            @endif
        @endif
    @endforeach
@endif

{{--<input type="hidden" value="" id="variation_uid">--}}
{{--@if(count($model->promotions))--}}
    {{--@foreach($model->promotions as $pkey => $promotion)--}}
        {{--@include('frontend.products._partials.render_promotion')--}}
    {{--@endforeach--}}
{{--@endif--}}

